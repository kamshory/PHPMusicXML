<?php

namespace MusicXML;

use Exception;
use SimpleXMLElement;

// Include composer autoloader for FPDF
require_once dirname(__DIR__, 2) . '/vendor/autoload.php';

class SheetMusicPDF extends \Fpdf\Fpdf
{
    public function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Times', 'I', 8);
        $this->Cell(0, 10, $this->PageNo() . ' of {nb}', 0, 0, 'R');
    }

    // Draw an ellipse (using Bezier curves)
    public function Ellipse($x, $y, $rx, $ry, $style = 'D')
    {
        if ($style == 'F') {
            $op = 'f';
        } elseif ($style == 'FD' || $style == 'DF') {
            $op = 'B';
        } else {
            $op = 'S';
        }
        
        $lx = 4 / 3 * (M_SQRT2 - 1) * $rx;
        $ly = 4 / 3 * (M_SQRT2 - 1) * $ry;
        
        $k = $this->k;
        $h = $this->h;
        
        $this->_out(sprintf(
            '%.2f %.2f m %.2f %.2f %.2f %.2f %.2f %.2f c',
            ($x + $rx) * $k, ($h - $y) * $k,
            ($x + $rx) * $k, ($h - ($y - $ly)) * $k,
            ($x + $lx) * $k, ($h - ($y - $ry)) * $k,
            $x * $k, ($h - ($y - $ry)) * $k
        ));
        $this->_out(sprintf(
            '%.2f %.2f %.2f %.2f %.2f %.2f c',
            ($x - $lx) * $k, ($h - ($y - $ry)) * $k,
            ($x - $rx) * $k, ($h - ($y - $ly)) * $k,
            ($x - $rx) * $k, ($h - $y) * $k
        ));
        $this->_out(sprintf(
            '%.2f %.2f %.2f %.2f %.2f %.2f c',
            ($x - $rx) * $k, ($h - ($y + $ly)) * $k,
            ($x - $lx) * $k, ($h - ($y + $ry)) * $k,
            $x * $k, ($h - ($y + $ry)) * $k
        ));
        $this->_out(sprintf(
            '%.2f %.2f %.2f %.2f %.2f %.2f c %s',
            ($x + $lx) * $k, ($h - ($y + $ry)) * $k,
            ($x + $rx) * $k, ($h - ($y + $ly)) * $k,
            ($x + $rx) * $k, ($h - $y) * $k,
            $op
        ));
    }

    public function Circle($x, $y, $r, $style = 'D')
    {
        $this->Ellipse($x, $y, $r, $r, $style);
    }

    /**
     * Convert SVG Arc to Cubic Bezier segments
     * Standard implementation of elliptical arc to cubic bezier curves conversion.
     */
    private function arcToCubicBezier($x1, $y1, $rx, $ry, $angle, $largeArcFlag, $sweepFlag, $x2, $y2)
    {
        if ($rx == 0 || $ry == 0) {
            return [];
        }

        $rx = abs($rx);
        $ry = abs($ry);

        $phi = deg2rad($angle);
        $cosPhi = cos($phi);
        $sinPhi = sin($phi);

        // Step 1: Translate to origin
        $dx = ($x1 - $x2) / 2.0;
        $dy = ($y1 - $y2) / 2.0;
        $x1p = $cosPhi * $dx + $sinPhi * $dy;
        $y1p = -$sinPhi * $dx + $cosPhi * $dy;

        // Correct radii if necessary
        $prx = $rx * $rx;
        $pry = $ry * $ry;
        $px1p = $x1p * $x1p;
        $py1p = $y1p * $y1p;

        $radiiCheck = $px1p / $prx + $py1p / $pry;
        if ($radiiCheck > 1) {
            $rx = sqrt($radiiCheck) * $rx;
            $ry = sqrt($radiiCheck) * $ry;
            $prx = $rx * $rx;
            $pry = $ry * $ry;
        }

        // Step 2: Compute center
        $sign = ($largeArcFlag == $sweepFlag) ? -1 : 1;
        $sq = (($prx * $pry) - ($prx * $py1p) - ($pry * $px1p)) / (($prx * $py1p) + ($pry * $px1p));
        $sq = max(0, $sq);
        $coef = $sign * sqrt($sq);
        $cxp = $coef * (($rx * $y1p) / $ry);
        $cyp = $coef * (-($ry * $x1p) / $rx);

        $cx = $cosPhi * $cxp - $sinPhi * $cyp + ($x1 + $x2) / 2.0;
        $cy = $sinPhi * $cxp + $cosPhi * $cyp + ($y1 + $y2) / 2.0;

        // Step 3: Compute angles
        $ux = ($x1p - $cxp) / $rx;
        $uy = ($y1p - $cyp) / $ry;
        $vx = (-$x1p - $cxp) / $rx;
        $vy = (-$cyp - $y1p) / $ry;

        $theta1 = atan2($uy, $ux);
        
        $dot = $ux * $vx + $uy * $vy;
        $len = sqrt($ux*$ux + $uy*$uy) * sqrt($vx*$vx + $vy*$vy);
        $dot = max(-1.0, min(1.0, $dot / $len));
        $dTheta = acos($dot);
        if (($ux * $vy - $uy * $vx) < 0) {
            $dTheta = -$dTheta;
        }

        if ($sweepFlag == 0 && $dTheta > 0) {
            $dTheta -= 2.0 * M_PI;
        } elseif ($sweepFlag == 1 && $dTheta < 0) {
            $dTheta += 2.0 * M_PI;
        }

        $segments = ceil(abs($dTheta) / (M_PI / 2.0));
        $curves = [];
        
        $theta = $theta1;
        $delta = $dTheta / $segments;
        
        for ($s = 0; $s < $segments; $s++) {
            $t = $theta;
            $theta += $delta;
            
            $cosT = cos($t);
            $sinT = sin($t);
            $cosTheta = cos($theta);
            $sinTheta = sin($theta);
            
            $sx = $cosPhi * $rx * $cosT - $sinPhi * $ry * $sinT + $cx;
            $sy = $sinPhi * $rx * $cosT + $cosPhi * $ry * $sinT + $cy;
            
            $ex = $cosPhi * $rx * $cosTheta - $sinPhi * $ry * $sinTheta + $cx;
            $ey = $sinPhi * $rx * $cosTheta + $cosPhi * $ry * $sinTheta + $cy;
            
            $alpha = sin($delta) * (sqrt(4.0 + 3.0 * tan($delta / 2.0) * tan($delta / 2.0)) - 1.0) / 3.0;
            
            $dxT = - $cosPhi * $rx * $sinT - $sinPhi * $ry * $cosT;
            $dyT = - $sinPhi * $rx * $sinT + $cosPhi * $ry * $cosT;
            
            $dxTheta = - $cosPhi * $rx * $sinTheta - $sinPhi * $ry * $cosTheta;
            $dyTheta = - $sinPhi * $rx * $sinTheta + $cosPhi * $ry * $cosTheta;
            
            $cp1x = $sx + $alpha * $dxT;
            $cp1y = $sy + $alpha * $dyT;
            
            $cp2x = $ex - $alpha * $dxTheta;
            $cp2y = $ey - $alpha * $dyTheta;
            
            $curves[] = [$cp1x, $cp1y, $cp2x, $cp2y, $ex, $ey];
        }
        
        return $curves;
    }

    /**
     * Draw an SVG path string onto the PDF canvas using raw PDF operators
     */
    public function DrawSVGPath($pathStr, $xOffset, $yOffset, $scaleX, $scaleY, $fill = true)
    {
        // Tokenize numbers and commands (expanded to support Q, q, T, t, H, h, V, v, A, a)
        preg_match_all('/([MLCQHVZTAmlcqhvzta])|(-?\d*\.?\d+)/', $pathStr, $matches);
        $tokens = $matches[0];
        
        $k = $this->k;
        $h = $this->h;
        
        $pdfCmds = "";
        $i = 0;
        $count = count($tokens);
        
        $currentX = 0;
        $currentY = 0;
        $cmd = 'M'; // Default command
        $lastQcpX = 0;
        $lastQcpY = 0;
        $lastCmdWasQ = false;
        
        $xy = function($px, $py) use ($k, $h, $xOffset, $yOffset, $scaleX, $scaleY) {
            $tx = $xOffset + $px * $scaleX;
            $ty = $yOffset + $py * $scaleY;
            return sprintf('%.2f %.2f', $tx * $k, ($h - $ty) * $k);
        };
        
        while ($i < $count) {
            $token = $tokens[$i];
            if (preg_match('/[MLCQHVZTAmlcqhvzta]/', $token)) {
                $cmd = $token;
                $i++;
            }
            
            if ($i >= $count && preg_match('/[Zz]/', $cmd) === 0) {
                break;
            }
            
            $isQ = false;
            switch ($cmd) {
                case 'M':
                    $px = (float)$tokens[$i++];
                    $py = (float)$tokens[$i++];
                    $pdfCmds .= $xy($px, $py) . " m ";
                    $currentX = $px;
                    $currentY = $py;
                    break;
                case 'm':
                    $px = $currentX + (float)$tokens[$i++];
                    $py = $currentY + (float)$tokens[$i++];
                    $pdfCmds .= $xy($px, $py) . " m ";
                    $currentX = $px;
                    $currentY = $py;
                    break;
                case 'L':
                    $px = (float)$tokens[$i++];
                    $py = (float)$tokens[$i++];
                    $pdfCmds .= $xy($px, $py) . " l ";
                    $currentX = $px;
                    $currentY = $py;
                    break;
                case 'l':
                    $px = $currentX + (float)$tokens[$i++];
                    $py = $currentY + (float)$tokens[$i++];
                    $pdfCmds .= $xy($px, $py) . " l ";
                    $currentX = $px;
                    $currentY = $py;
                    break;
                case 'H':
                    $px = (float)$tokens[$i++];
                    $pdfCmds .= $xy($px, $currentY) . " l ";
                    $currentX = $px;
                    break;
                case 'h':
                    $px = $currentX + (float)$tokens[$i++];
                    $pdfCmds .= $xy($px, $currentY) . " l ";
                    $currentX = $px;
                    break;
                case 'V':
                    $py = (float)$tokens[$i++];
                    $pdfCmds .= $xy($currentX, $py) . " l ";
                    $currentY = $py;
                    break;
                case 'v':
                    $py = $currentY + (float)$tokens[$i++];
                    $pdfCmds .= $xy($currentX, $py) . " l ";
                    $currentY = $py;
                    break;
                case 'C':
                    $x1 = (float)$tokens[$i++];
                    $y1 = (float)$tokens[$i++];
                    $x2 = (float)$tokens[$i++];
                    $y2 = (float)$tokens[$i++];
                    $x3 = (float)$tokens[$i++];
                    $y3 = (float)$tokens[$i++];
                    $pdfCmds .= sprintf(
                        '%s %s %s c ',
                        $xy($x1, $y1),
                        $xy($x2, $y2),
                        $xy($x3, $y3)
                    );
                    $currentX = $x3;
                    $currentY = $y3;
                    break;
                case 'c':
                    $x1 = $currentX + (float)$tokens[$i++];
                    $y1 = $currentY + (float)$tokens[$i++];
                    $x2 = $currentX + (float)$tokens[$i++];
                    $y2 = $currentY + (float)$tokens[$i++];
                    $x3 = $currentX + (float)$tokens[$i++];
                    $y3 = $currentY + (float)$tokens[$i++];
                    $pdfCmds .= sprintf(
                        '%s %s %s c ',
                        $xy($x1, $y1),
                        $xy($x2, $y2),
                        $xy($x3, $y3)
                    );
                    $currentX = $x3;
                    $currentY = $y3;
                    break;
                case 'Q':
                    $x1 = (float)$tokens[$i++];
                    $y1 = (float)$tokens[$i++];
                    $x2 = (float)$tokens[$i++];
                    $y2 = (float)$tokens[$i++];
                    // Quadratic to cubic bezier conversion
                    $cx1 = $currentX + (2.0/3.0) * ($x1 - $currentX);
                    $cy1 = $currentY + (2.0/3.0) * ($y1 - $currentY);
                    $cx2 = $x2 + (2.0/3.0) * ($x1 - $x2);
                    $cy2 = $y2 + (2.0/3.0) * ($y1 - $y2);
                    $pdfCmds .= sprintf(
                        '%s %s %s c ',
                        $xy($cx1, $cy1),
                        $xy($cx2, $cy2),
                        $xy($x2, $y2)
                    );
                    $lastQcpX = $x1;
                    $lastQcpY = $y1;
                    $isQ = true;
                    $currentX = $x2;
                    $currentY = $y2;
                    break;
                case 'q':
                    $dx1 = (float)$tokens[$i++];
                    $dy1 = (float)$tokens[$i++];
                    $dx2 = (float)$tokens[$i++];
                    $dy2 = (float)$tokens[$i++];
                    $x1 = $currentX + $dx1;
                    $y1 = $currentY + $dy1;
                    $x2 = $currentX + $dx2;
                    $y2 = $currentY + $dy2;
                    // Quadratic to cubic bezier conversion
                    $cx1 = $currentX + (2.0/3.0) * ($x1 - $currentX);
                    $cy1 = $currentY + (2.0/3.0) * ($y1 - $currentY);
                    $cx2 = $x2 + (2.0/3.0) * ($x1 - $x2);
                    $cy2 = $y2 + (2.0/3.0) * ($y1 - $y2);
                    $pdfCmds .= sprintf(
                        '%s %s %s c ',
                        $xy($cx1, $cy1),
                        $xy($cx2, $cy2),
                        $xy($x2, $y2)
                    );
                    $lastQcpX = $x1;
                    $lastQcpY = $y1;
                    $isQ = true;
                    $currentX = $x2;
                    $currentY = $y2;
                    break;
                case 'T':
                    $x2 = (float)$tokens[$i++];
                    $y2 = (float)$tokens[$i++];
                    if ($lastCmdWasQ) {
                        $x1 = 2.0 * $currentX - $lastQcpX;
                        $y1 = 2.0 * $currentY - $lastQcpY;
                    } else {
                        $x1 = $currentX;
                        $y1 = $currentY;
                    }
                    // Quadratic to cubic bezier conversion
                    $cx1 = $currentX + (2.0/3.0) * ($x1 - $currentX);
                    $cy1 = $currentY + (2.0/3.0) * ($y1 - $currentY);
                    $cx2 = $x2 + (2.0/3.0) * ($x1 - $x2);
                    $cy2 = $y2 + (2.0/3.0) * ($y1 - $y2);
                    $pdfCmds .= sprintf(
                        '%s %s %s c ',
                        $xy($cx1, $cy1),
                        $xy($cx2, $cy2),
                        $xy($x2, $y2)
                    );
                    $lastQcpX = $x1;
                    $lastQcpY = $y1;
                    $isQ = true;
                    $currentX = $x2;
                    $currentY = $y2;
                    break;
                case 't':
                    $dx2 = (float)$tokens[$i++];
                    $dy2 = (float)$tokens[$i++];
                    if ($lastCmdWasQ) {
                        $x1 = 2.0 * $currentX - $lastQcpX;
                        $y1 = 2.0 * $currentY - $lastQcpY;
                    } else {
                        $x1 = $currentX;
                        $y1 = $currentY;
                    }
                    $x2 = $currentX + $dx2;
                    $y2 = $currentY + $dy2;
                    // Quadratic to cubic bezier conversion
                    $cx1 = $currentX + (2.0/3.0) * ($x1 - $currentX);
                    $cy1 = $currentY + (2.0/3.0) * ($y1 - $currentY);
                    $cx2 = $x2 + (2.0/3.0) * ($x1 - $x2);
                    $cy2 = $y2 + (2.0/3.0) * ($y1 - $y2);
                    $pdfCmds .= sprintf(
                        '%s %s %s c ',
                        $xy($cx1, $cy1),
                        $xy($cx2, $cy2),
                        $xy($x2, $y2)
                    );
                    $lastQcpX = $x1;
                    $lastQcpY = $y1;
                    $isQ = true;
                    $currentX = $x2;
                    $currentY = $y2;
                    break;
                case 'A':
                    $rx = (float)$tokens[$i++];
                    $ry = (float)$tokens[$i++];
                    $angle = (float)$tokens[$i++];
                    $largeArcFlag = (int)$tokens[$i++];
                    $sweepFlag = (int)$tokens[$i++];
                    $x2 = (float)$tokens[$i++];
                    $y2 = (float)$tokens[$i++];
                    
                    $curves = $this->arcToCubicBezier($currentX, $currentY, $rx, $ry, $angle, $largeArcFlag, $sweepFlag, $x2, $y2);
                    foreach ($curves as $c) {
                        $pdfCmds .= sprintf(
                            '%s %s %s c ',
                            $xy($c[0], $c[1]),
                            $xy($c[2], $c[3]),
                            $xy($c[4], $c[5])
                        );
                    }
                    $currentX = $x2;
                    $currentY = $y2;
                    break;
                case 'a':
                    $rx = (float)$tokens[$i++];
                    $ry = (float)$tokens[$i++];
                    $angle = (float)$tokens[$i++];
                    $largeArcFlag = (int)$tokens[$i++];
                    $sweepFlag = (int)$tokens[$i++];
                    $dx = (float)$tokens[$i++];
                    $dy = (float)$tokens[$i++];
                    $x2 = $currentX + $dx;
                    $y2 = $currentY + $dy;
                    
                    $curves = $this->arcToCubicBezier($currentX, $currentY, $rx, $ry, $angle, $largeArcFlag, $sweepFlag, $x2, $y2);
                    foreach ($curves as $c) {
                        $pdfCmds .= sprintf(
                            '%s %s %s c ',
                            $xy($c[0], $c[1]),
                            $xy($c[2], $c[3]),
                            $xy($c[4], $c[5])
                        );
                    }
                    $currentX = $x2;
                    $currentY = $y2;
                    break;
                case 'Z':
                case 'z':
                    $pdfCmds .= " h ";
                    break;
            }
            $lastCmdWasQ = $isQ;
        }
        
        if ($fill === 'B') {
            $op = " B "; // Fill and stroke
        } else {
            $op = $fill ? " f " : " S ";
        }
        $pdfCmds .= $op;
        $this->_out($pdfCmds);
    }

    public function DrawTrebleClef($x, $y)
    {
        // High-quality new vector G-Clef path from user
        $path = "M165 177q-24 30-26 60-2 34 19 64 23 32 57 34h21l4 23q3 15 2 26-1 15-9 24-9 10-23 9-6 0-11-3l10-5q9-7 10-19 0-12-6-21-8-9-20-10t-22 9q-7 10-9 22-1 19 14 31 13 11 31 12a52 52 0 0 0 34-9q17-13 18-31 1-15-2-34l-4-29q17-5 28-20 12-15 13-36 3-25-12-46a51 51 0 0 0-46-23l-5-36q20-16 32-42 12-24 14-53 0-17-5-41-7-31-22-33-6 0-12 6a89 89 0 0 0-25 37 167 167 0 0 0-3 89q-31 29-45 45m98 97c0 12-5 31-13 36l-9-63q21 6 22 27m-41-169q1-18 9-37 10-22 16-22h3c5 0 10 2 9 15q-1 17-13 35-10 15-22 25-3-7-2-16m-6 76 3 27q-14 6-23 18-12 13-13 30-1 18 8 31 4 7 12 13c7 5 16 5 18 2q0-4-8-15-4-5-4-13 1-18 16-25l9 70-16 1q-22-2-39-19a48 48 0 0 1-16-38q3-42 53-82";
        
        $this->SetDrawColor(255, 255, 255); // Use white stroke to erode the black fill
        $this->SetLineWidth(0.25); // Control G-clef thinness (higher = thinner, 0.25mm gives a beautiful slim look)
        $this->DrawSVGPath($path, $x - 4.5, $y - 4.0, 0.0415, 0.0415, 'B');
        $this->SetDrawColor(0, 0, 0); // Restore default draw color
        $this->SetLineWidth(0.2); // Restore default line width
    }

    public function DrawPercussionClef($x, $y)
    {
        $this->SetLineWidth(0.8);
        $this->Line($x + 1, $y + 2, $x + 1, $y + 6);
        $this->Line($x + 2.5, $y + 2, $x + 2.5, $y + 6);
        $this->SetLineWidth(0.2);
    }

    public function DrawSharp($x, $y)
    {
        // Custom ultra-thin elegant sharp path with shorter stems
        $path = "M 1.6 0.5 L 2.0 0.5 L 2.0 9.5 L 1.6 9.5 Z M 3.0 2.0 L 3.4 2.0 L 3.4 11.0 L 3.0 11.0 Z M 0 4.0 L 5 2.5 L 5 1.7 L 0 3.2 Z M 0 7.5 L 5 6.0 L 5 5.2 L 0 6.7 Z";
        $this->DrawSVGPath($path, $x - 1.1, $y - 2.1, 0.45, 0.45, true);
    }

    public function DrawFlat($x, $y)
    {
        // Closed loop flat path with defined thin stem thickness (0.4 units) so it fills properly
        $path = "M 1.2 0 L 1.6 0 L 1.6 9 C 4.8 9 4.8 18 1.6 18 L 1.2 18 Z";
        $this->DrawSVGPath($path, $x - 0.63, $y - 6.07, 0.45, 0.45, true);
    }

    public function DrawTie($sx, $sy, $ex, $ey, $direction = 'down')
    {
        $k = $this->k;
        $h_pdf = $this->h;
        
        $dx = $ex - $sx;
        if ($dx <= 0) return;
        
        $bend = max(1.5, min(3.0, $dx * 0.25));
        $thickness = 0.4;
        
        $xy = function($px, $py) use ($k, $h_pdf) {
            return sprintf('%.2f %.2f', $px * $k, ($h_pdf - $py) * $k);
        };
        
        if ($direction === 'up') {
            $cp1x = $sx + $dx * 0.25;
            $cp1y = $sy - $bend;
            $cp2x = $sx + $dx * 0.75;
            $cp2y = $ey - $bend;
            
            $cp3x = $sx + $dx * 0.75;
            $cp3y = $ey - $bend + $thickness;
            $cp4x = $sx + $dx * 0.25;
            $cp4y = $sy - $bend + $thickness;
        } else {
            $cp1x = $sx + $dx * 0.25;
            $cp1y = $sy + $bend;
            $cp2x = $sx + $dx * 0.75;
            $cp2y = $ey + $bend;
            
            $cp3x = $sx + $dx * 0.75;
            $cp3y = $ey + $bend - $thickness;
            $cp4x = $sx + $dx * 0.25;
            $cp4y = $sy + $bend - $thickness;
        }
        
        $pdfCmds = sprintf(
            '%s m %s %s %s c %s %s %s c f',
            $xy($sx, $sy),
            $xy($cp1x, $cp1y),
            $xy($cp2x, $cp2y),
            $xy($ex, $ey),
            $xy($cp3x, $cp3y),
            $xy($cp4x, $cp4y),
            $xy($sx, $sy)
        );
        $this->_out($pdfCmds);
    }
}

class MidiToPdf
{
    private $fontFamily = 'Times';
    private $fontSize = 12;

    /**
     * Convert MIDI file to PDF file using pure PHP FPDF renderer
     *
     * @param string $midiData
     * @param string $songTitle Song title for the score
     * @param int|string|null $targetChannelOrPartId Optional specific MIDI channel number (1-16) or MusicXML Part ID to render
     * @return string
     * @throws Exception
     */
    public function convert($midiData, $songTitle = "Untitled", $targetChannelOrPartId = null, $compressEmptyMeasures = false)
    {
        if (empty($midiData)) {
            throw new Exception("Invalid input MIDI data.");
        }

        // 1. Convert MIDI to MusicXML content using the PHP converter
        $converter = new MusicXMLFromMidi();
        $midi = $converter->loadMidiString($midiData);
        $xmlStr = $converter->midiToMusicXml($midi, $songTitle);

        if (empty($xmlStr)) {
            throw new Exception("Failed to convert MIDI to MusicXML content.");
        }

        // 2. Parse the MusicXML content
        $xml = simplexml_load_string($xmlStr);
        if ($xml === false) {
            throw new Exception("Failed to parse generated MusicXML content.");
        }

        // 3. Resolve Part ID from target channel or part ID
        $partId = null;
        if ($targetChannelOrPartId !== null) {
            if (is_numeric($targetChannelOrPartId)) {
                $targetChannel = (int)$targetChannelOrPartId;
                foreach ($xml->{'part-list'}->{'score-part'} as $scorePart) {
                    $partIdVal = (string)$scorePart['id'];
                    foreach ($scorePart->{'midi-instrument'} as $midiInst) {
                        if (isset($midiInst->{'midi-channel'}) && (int)$midiInst->{'midi-channel'} === $targetChannel) {
                            $partId = $partIdVal;
                            break 2;
                        }
                    }
                }
                // Fallback: if not matched inside midi-instrument channels, try P<channel>
                if ($partId === null) {
                    $partId = 'P' . $targetChannel;
                }
            } else {
                $partId = $targetChannelOrPartId;
            }
        }

        if ($partId === null) {
            $partId = $this->detectBestPart($xml);
        }

        // Extract tempo BPM
        $bpm = 120; // Default BPM
        $tempoEvents = $midi->getTempoEvents();
        if (!empty($tempoEvents)) {
            $bpm = round($tempoEvents[0]->bpm);
        } else {
            $tempo = $midi->getTempo();
            if ($tempo > 0) {
                $bpm = round(60000000 / $tempo);
            }
        }

        // 4. Render the part to PDF
        return $this->renderPartToPdf($xml, $partId, $songTitle, $bpm, $compressEmptyMeasures);
    }

    /**
     * Detect the best part to render (prefer track with lyrics, then track with most notes)
     *
     * @param SimpleXMLElement $xml
     * @return string Part ID
     */
    private function detectBestPart($xml)
    {
        $bestPartId = 'P1';
        $maxLyrics = -1;
        $maxNotes = -1;
        
        foreach ($xml->part as $part) {
            $partId = (string)$part['id'];
            $lyricsCount = 0;
            $notesCount = 0;
            foreach ($part->measure as $measure) {
                foreach ($measure->note as $note) {
                    if (isset($note->lyric)) {
                        $lyricsCount++;
                    }
                    if (isset($note->pitch) || isset($note->unpitched)) {
                        $notesCount++;
                    }
                }
            }
            
            if ($lyricsCount > $maxLyrics) {
                $maxLyrics = $lyricsCount;
                $bestPartId = $partId;
            }
            if ($lyricsCount == 0 && $notesCount > $maxNotes) {
                $maxNotes = $notesCount;
                if ($maxLyrics <= 0) {
                    $bestPartId = $partId;
                }
            }
        }
        
        return $bestPartId;
    }

    /**
     * Render the selected part to a PDF file
     *
     * @param SimpleXMLElement $xml
     * @param string $partId
     * @param string $songTitle
     * @param int|null $bpm
     * @return string
     * @throws Exception
     */
    private function renderPartToPdf($xml, $partId, $songTitle, $bpm = null, $compressEmptyMeasures = false)
    {
        // Find part element and part name
        $targetPart = null;
        foreach ($xml->part as $part) {
            if ((string)$part['id'] === $partId) {
                $targetPart = $part;
                break;
            }
        }

        if ($targetPart === null) {
            throw new Exception("Part $partId not found in MusicXML.");
        }

        // Get part display name
        $partNameStr = "Score";
        foreach ($xml->{'part-list'}->{'score-part'} as $scorePart) {
            if ((string)$scorePart['id'] === $partId) {
                $partNameStr = (string)$scorePart->{'part-name'};
                break;
            }
        }

        // Initialize PDF renderer
        $pdf = new SheetMusicPDF();
        $pdf->AliasNbPages();
        $pdf->SetAutoPageBreak(false);
        $pdf->AddPage();

        // Draw title section on first page
        $pdf->SetFont($this->fontFamily, 'B', 14);
        $pdf->Cell(0, 8, $songTitle, 0, 1, 'C');
        $pdf->SetFont($this->fontFamily, 'I', 9);
        $pdf->Cell(0, 5, $partNameStr, 0, 1, 'C');
        $pdf->SetFont($this->fontFamily, '', 7);
        $pdf->Cell(0, 4, "Generated by Planetbiru", 0, 1, 'C');
        $pdf->Ln(4);

        // Detect if the target part has lyrics
        $hasLyrics = false;
        foreach ($targetPart->measure as $measure) {
            foreach ($measure->note as $note) {
                if (isset($note->lyric)) {
                    $hasLyrics = true;
                    break 2;
                }
            }
        }

        // Grid parameters
        $systemX = 15;
        $systemY = 40; // vertical start on page 1
        $measuresPerSystem = $hasLyrics ? 2 : 3;
        $printableWidth = 180;
        $lineSpacing = 2; // distance between staff lines in mm

        // Draw Tempo on the first page above the first system
        if ($bpm !== null && $bpm > 0) {
            $pdf->SetFont($this->fontFamily, 'B', 9);
            $pdf->SetXY(15, $systemY - 10.5);
            $pdf->Cell(12, 4, "Tempo: ", 0, 0, 'L');
            
            // Draw a tiny quarter note
            $pdf->Ellipse(28.5, $systemY - 7.5, 1.3, 0.9, 'F');
            $pdf->SetLineWidth(0.2);
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->Line(29.675, $systemY - 7.5, 29.675, $systemY - 11.5);
            
            // Draw the "= 120" text
            $pdf->SetXY(31, $systemY - 10.5);
            $pdf->Cell(30, 4, "= " . $bpm, 0, 0, 'L');
        }

        // Default attributes
        $divisions = 4;
        $fifths = 0;
        $beats = 4;
        $beatType = 4;
        
        // Detect if it is percussion track
        $isPercussion = (stripos($partNameStr, 'drum') !== false || stripos($partNameStr, 'percussion') !== false);

        $measures = $targetPart->measure;
        $totalMeasures = count($measures);

        $measureLayoutIdx = array();
        $collapseCount = array();
        $currLayoutIdx = 0;
        for ($i = 0; $i < $totalMeasures; $i++) {
            $measureLayoutIdx[$i] = $currLayoutIdx;
            
            $c = 1;
            if ($compressEmptyMeasures) {
                // Check if measure $i is blank
                $isBlank = true;
                if (isset($measures[$i]->note)) {
                    foreach ($measures[$i]->note as $note) {
                        if (!isset($note->rest)) {
                            $isBlank = false;
                            break;
                        }
                    }
                }
                
                if ($isBlank) {
                    while ($i + $c < $totalMeasures) {
                        $nextMeasure = $measures[$i + $c];
                        $nextIsBlank = true;
                        if (isset($nextMeasure->note)) {
                            foreach ($nextMeasure->note as $note) {
                                if (!isset($note->rest)) {
                                    $nextIsBlank = false;
                                    break;
                                }
                            }
                        }
                        if (!$nextIsBlank) {
                            break;
                        }
                        if (isset($nextMeasure->attributes)) {
                            break;
                        }
                        $c++;
                    }
                }
            }
            
            if ($c > 1) {
                $collapseCount[$i] = $c;
                for ($j = 0; $j < $c; $j++) {
                    $measureLayoutIdx[$i + $j] = $currLayoutIdx;
                }
                $i += $c - 1;
            } else {
                $collapseCount[$i] = 1;
            }
            $currLayoutIdx++;
        }

        $activeTies = array();

        for ($mIdx = 0; $mIdx < $totalMeasures; $mIdx++) {
            $measure = $measures[$mIdx];
            
            // Check attributes if defined in this measure
            if (isset($measure->attributes)) {
                if (isset($measure->attributes->divisions)) {
                    $divisions = (int)$measure->attributes->divisions;
                }
                if (isset($measure->attributes->key->fifths)) {
                    $fifths = (int)$measure->attributes->key->fifths;
                }
                if (isset($measure->attributes->time->beats)) {
                    $beats = (int)$measure->attributes->time->beats;
                }
                if (isset($measure->attributes->time->{'beat-type'})) {
                    $beatType = (int)$measure->attributes->time->{'beat-type'};
                }
                if (isset($measure->attributes->clef->sign)) {
                    $isPercussion = ((string)$measure->attributes->clef->sign === 'percussion');
                }
            }

            $measureDuration = $beats * $divisions;
            if ($measureDuration <= 0) $measureDuration = 16;

            $layoutIdx = $measureLayoutIdx[$mIdx];

            // Indent for clef and signatures at the start of each system
            $systemStartIndent = ($layoutIdx < $measuresPerSystem) ? 22 : 16;
            $measureWidth = ($printableWidth - $systemStartIndent) / $measuresPerSystem;

            // Start of a new system
            if ($layoutIdx % $measuresPerSystem == 0) {
                // If system goes off-page, start new page
                if ($systemY + 28 > 265) {
                    $pdf->AddPage();
                    $systemY = 20; // reset system Y for subsequent pages
                }

                // Draw 5 staff lines from systemX to systemX + printableWidth
                $pdf->SetDrawColor(180, 180, 180);
                $pdf->SetLineWidth(0.15);
                for ($line = 0; $line < 5; $line++) {
                    $ly = $systemY + $line * $lineSpacing;
                    $pdf->Line($systemX, $ly, $systemX + $printableWidth, $ly);
                }
                $pdf->SetDrawColor(0, 0, 0);
                $pdf->SetLineWidth(0.2);

                // Draw Clef
                if ($isPercussion) {
                    $pdf->DrawPercussionClef($systemX, $systemY);
                } else {
                    $pdf->DrawTrebleClef($systemX, $systemY);
                }

                // Draw Key Signature (flats/sharps)
                if ($fifths == -1 && !$isPercussion) {
                    // 1 flat (Bb4) on middle line
                    $pdf->DrawFlat($systemX + 9, $systemY + 4);
                } elseif ($fifths == 1 && !$isPercussion) {
                    // 1 sharp (F#5) on top line
                    $pdf->DrawSharp($systemX + 9, $systemY);
                }

                // Draw Time Signature (first measure of page or song)
                if ($layoutIdx == 0) {
                    $pdf->SetFont($this->fontFamily, 'B', 10);
                    $pdf->SetXY($systemX + 15, $systemY);
                    $pdf->Cell(6, 4, $beats, 0, 0, 'C');
                    $pdf->SetXY($systemX + 15, $systemY + 4);
                    $pdf->Cell(6, 4, $beatType, 0, 0, 'C');
                }
            }

            // Calculate current measure start coordinate
            $currentMeasureX = $systemX + $systemStartIndent + ($layoutIdx % $measuresPerSystem) * $measureWidth;

            // Draw vertical barlines (slightly longer and darker for better visibility)
            $pdf->SetLineWidth(0.35);
            $pdf->SetDrawColor(0, 0, 0);
            if ($layoutIdx % $measuresPerSystem == 0) {
                // Draw left barline of first measure in system
                $pdf->Line($currentMeasureX, $systemY - 0.5, $currentMeasureX, $systemY + 8.5);
            }
            // Draw right barline of measure
            $pdf->Line($currentMeasureX + $measureWidth, $systemY - 0.5, $currentMeasureX + $measureWidth, $systemY + 8.5);
            $pdf->SetLineWidth(0.2);

            // Handle Multi-measure Rest compression
            $c = isset($collapseCount[$mIdx]) ? $collapseCount[$mIdx] : 1;
            if ($c > 1) {
                // Draw Multi-measure Rest (church rest)
                $pdf->SetLineWidth(1.2);
                $pdf->SetDrawColor(0, 0, 0);
                $restStartY = $systemY + 4.0; // middle staff line (B4)
                $restStartX = $currentMeasureX + 8.0;
                $restEndX = $currentMeasureX + $measureWidth - 8.0;
                
                // Horizontal thick bar
                $pdf->Line($restStartX, $restStartY, $restEndX, $restStartY);
                
                // Vertical end ticks
                $pdf->SetLineWidth(0.4);
                $pdf->Line($restStartX, $restStartY - 1.5, $restStartX, $restStartY + 1.5);
                $pdf->Line($restEndX, $restStartY - 1.5, $restEndX, $restStartY + 1.5);
                
                // Draw the number above the staff
                $pdf->SetFont($this->fontFamily, 'B', 10);
                $pdf->SetXY($currentMeasureX, $systemY - 4.5);
                $pdf->Cell($measureWidth, 4, $c, 0, 0, 'C');

                // Move to next system if we hit measures limit per system
                if ($layoutIdx % $measuresPerSystem == $measuresPerSystem - 1) {
                    $systemY += 28;
                }

                $mIdx += $c - 1; // skip skipped measures in the XML loop
                continue; // skip drawing notes for this group
            }

            // Draw notes in measure
            $currentDiv = 0;
            $lastDuration = 0;

            foreach ($measure->note as $note) {
                $duration = isset($note->duration) ? (int)$note->duration : 0;
                
                // Handle chords: chords align with the start of the previous note
                $isChord = isset($note->chord);
                if ($isChord) {
                    $currentDiv -= $lastDuration;
                }

                // Calculate note X coordinate (with 2mm padding on left/right margins of the measure to avoid barline clashes)
                $padding = 2.0;
                $xRange = $measureWidth - ($padding * 2);
                if ($xRange < 5) $xRange = 5; // prevent division/range anomalies
                $xOffset = $padding + ($currentDiv / $measureDuration) * $xRange;
                $noteX = $currentMeasureX + $xOffset;

                // Draw Rest Note
                if (isset($note->rest)) {
                    $pdf->SetDrawColor(0, 0, 0);
                    if ($duration >= $measureDuration) {
                        // Whole rest: box hanging from line 4 (D5, which is systemY + 6.0)
                        $pdf->Rect($noteX - 2.0, $systemY + 6.0, 4.0, 1.5, 'F');
                    } elseif ($duration >= $measureDuration / 2) {
                        // Half rest: box sitting on line 3 (B4, which is systemY + 4.0)
                        $pdf->Rect($noteX - 2.0, $systemY + 2.5, 4.0, 1.5, 'F');
                    } else {
                        $typeStr = isset($note->type) ? (string)$note->type : 'quarter';
                        if ($typeStr === 'quarter' || $typeStr === '1/4') {
                             // Enhanced vector quarter rest with smooth, untwisted bottom hook
                             $quarterPath = "M 50 10 C 60 40, 30 60, 50 80 C 70 100, 40 120, 60 150 C 65 170, 45 185, 25 180 C 23 180, 24 176, 28 176 C 35 170, 45 155, 50 140 C 30 110, 60 90, 40 70 C 20 50, 40 20, 50 10 Z";
                             $pdf->DrawSVGPath($quarterPath, $noteX - 2.25, $systemY + 0.7, 0.045, 0.033, true);
                        } else {
                            // Eighth, 16th, and 32nd rests with elegant bezier hooks and slanted diagonal stems
                            $pdf->SetLineWidth(0.35);
                            // Prominent, beautiful hook shape to avoid looking straight when printed
                            $hookPath = "M 0 0 C -1.0 -1.5, -2.8 -1.2, -2.8 0.5 C -2.8 2.0, -1.2 1.6, -0.4 0.2 Z";
                            if ($typeStr === 'eighth' || $typeStr === '1/8') {
                                $pdf->Line($noteX + 0.5, $systemY + 5.0, $noteX - 0.5, $systemY + 1.0);
                                $pdf->DrawSVGPath($hookPath, $noteX + 0.5, $systemY + 5.0, 1.0, 1.0, true);
                            } elseif ($typeStr === '16th' || $typeStr === '1/16') {
                                $pdf->Line($noteX + 0.5, $systemY + 5.0, $noteX - 0.7, $systemY + 0.5);
                                $pdf->DrawSVGPath($hookPath, $noteX + 0.5, $systemY + 5.0, 1.0, 1.0, true);
                                $pdf->DrawSVGPath($hookPath, $noteX + 0.0, $systemY + 3.0, 1.0, 1.0, true);
                            } else {
                                // 32nd rest or shorter
                                $pdf->Line($noteX + 0.5, $systemY + 5.0, $noteX - 0.9, $systemY - 0.5);
                                $pdf->DrawSVGPath($hookPath, $noteX + 0.5, $systemY + 5.0, 1.0, 1.0, true);
                                $pdf->DrawSVGPath($hookPath, $noteX + 0.0, $systemY + 3.0, 1.0, 1.0, true);
                                $pdf->DrawSVGPath($hookPath, $noteX - 0.5, $systemY + 1.0, 1.0, 1.0, true);
                            }
                            $pdf->SetLineWidth(0.2);
                        }
                    }
                } 
                // Draw Sound Note (pitched or unpitched)
                else {
                    $pitchVal = 71; // Default middle B4
                    $hasAlter = false;
                    $alterVal = 0;
                    $notehead = 'normal';

                    if (isset($note->pitch)) {
                        $step = (string)$note->pitch->step;
                        $octave = (int)$note->pitch->octave;
                        $pitchVal = $this->getPitchValue($step, $octave);
                        if (isset($note->pitch->alter)) {
                            $hasAlter = true;
                            $alterVal = (int)$note->pitch->alter;
                        }
                    } elseif (isset($note->unpitched)) {
                        $step = (string)$note->unpitched->{'display-step'};
                        $octave = (int)$note->unpitched->{'display-octave'};
                        $pitchVal = $this->getPitchValue($step, $octave);
                    }

                    if (isset($note->notehead)) {
                        $notehead = (string)$note->notehead;
                    }

                    // Get Treble staff diatonic step
                    $stepIndex = $this->getTrebleStep($pitchVal);
                    // notehead center Y coordinate
                    $noteY = $systemY + 8 - ($stepIndex * 1.0);

                    // Draw accidentals if any (sharp/flat)
                    if ($hasAlter && !$isPercussion) {
                        if ($alterVal > 0) {
                            $pdf->DrawSharp($noteX - 2.8, $noteY);
                        } elseif ($alterVal < 0) {
                            $pdf->DrawFlat($noteX - 2.8, $noteY);
                        }
                    }

                    // Draw Ledger Lines
                    if ($stepIndex <= -2) {
                        for ($lineIdx = -2; $lineIdx >= $stepIndex; $lineIdx -= 2) {
                            $ly = $systemY + 8 - ($lineIdx * 1.0);
                            $pdf->Line($noteX - 3, $ly, $noteX + 3, $ly);
                        }
                    } elseif ($stepIndex >= 10) {
                        for ($lineIdx = 10; $lineIdx <= $stepIndex; $lineIdx += 2) {
                            $ly = $systemY + 8 - ($lineIdx * 1.0);
                            $pdf->Line($noteX - 3, $ly, $noteX + 3, $ly);
                        }
                    }

                    // Draw Notehead
                    $typeStr = isset($note->type) ? (string)$note->type : 'quarter';
                    $style = ($typeStr === 'half' || $typeStr === 'whole') ? 'D' : 'F';

                    if ($notehead === 'x') {
                        // Draw 'x' for hi-hats/cymbals
                        $pdf->SetLineWidth(0.35);
                        $pdf->Line($noteX - 1.2, $noteY - 1.2, $noteX + 1.2, $noteY + 1.2);
                        $pdf->Line($noteX - 1.2, $noteY + 1.2, $noteX + 1.2, $noteY - 1.2);
                        $pdf->SetLineWidth(0.2);
                    } elseif ($notehead === 'slash') {
                        // Draw diagonal slash notehead
                        $pdf->SetLineWidth(0.35);
                        $pdf->Line($noteX - 1.2, $noteY + 1.2, $noteX + 1.2, $noteY - 1.2);
                        $pdf->SetLineWidth(0.2);
                    } else {
                        // Draw normal oval/tilted notehead
                        $pdf->Ellipse($noteX, $noteY, 1.6, 1.1, $style);
                    }

                    // Determine stem direction (used for stem drawing and ties)
                    $stemDir = 'up';
                    if (isset($note->stem)) {
                        $stemDir = (string)$note->stem;
                    } else {
                        $stemDir = ($stepIndex >= 4) ? 'down' : 'up';
                    }

                    // Draw Stem (for all types except whole notes)
                    if ($typeStr !== 'whole') {
                        $pdf->SetLineWidth(0.25);
                        if ($stemDir === 'up') {
                            $stemEndY = $noteY - 6.5;
                            $pdf->Line($noteX + 1.5, $noteY, $noteX + 1.5, $stemEndY);
                            
                            // Draw SVG flags as stroke-only curves (fill = false)
                            $flagPath = "M 0 0 C 0.9 0.9, 1.35 1.875, 1.125 3.0";
                            if ($typeStr === 'eighth' || $typeStr === '1/8') {
                                $pdf->DrawSVGPath($flagPath, $noteX + 1.5, $stemEndY, 1.0, 1.0, false);
                            } elseif ($typeStr === '16th' || $typeStr === '1/16') {
                                $pdf->DrawSVGPath($flagPath, $noteX + 1.5, $stemEndY, 1.0, 1.0, false);
                                $pdf->DrawSVGPath($flagPath, $noteX + 1.5, $stemEndY + 1.5, 1.0, 1.0, false);
                            } elseif ($typeStr === '32nd' || $typeStr === '1/32') {
                                $pdf->DrawSVGPath($flagPath, $noteX + 1.5, $stemEndY, 1.0, 1.0, false);
                                $pdf->DrawSVGPath($flagPath, $noteX + 1.5, $stemEndY + 1.5, 1.0, 1.0, false);
                                $pdf->DrawSVGPath($flagPath, $noteX + 1.5, $stemEndY + 3.0, 1.0, 1.0, false);
                            }
                        } else {
                            $stemEndY = $noteY + 6.5;
                            $pdf->Line($noteX - 1.5, $noteY, $noteX - 1.5, $stemEndY);
                            
                            // Draw SVG flags as stroke-only curves (fill = false)
                            $flagPath = "M 0 0 C 0.9 -0.9, 1.35 -1.875, 1.125 -3.0";
                            if ($typeStr === 'eighth' || $typeStr === '1/8') {
                                $pdf->DrawSVGPath($flagPath, $noteX - 1.5, $stemEndY, 1.0, 1.0, false);
                            } elseif ($typeStr === '16th' || $typeStr === '1/16') {
                                $pdf->DrawSVGPath($flagPath, $noteX - 1.5, $stemEndY, 1.0, 1.0, false);
                                $pdf->DrawSVGPath($flagPath, $noteX - 1.5, $stemEndY - 1.5, 1.0, 1.0, false);
                            } elseif ($typeStr === '32nd' || $typeStr === '1/32') {
                                $pdf->DrawSVGPath($flagPath, $noteX - 1.5, $stemEndY, 1.0, 1.0, false);
                                $pdf->DrawSVGPath($flagPath, $noteX - 1.5, $stemEndY - 1.5, 1.0, 1.0, false);
                                $pdf->DrawSVGPath($flagPath, $noteX - 1.5, $stemEndY - 3.0, 1.0, 1.0, false);
                            }
                        }
                        $pdf->SetLineWidth(0.2);
                    }

                    // Draw Tie / Tied Stop
                    $isTieStop = false;
                    if (isset($note->tie)) {
                        foreach ($note->tie as $t) {
                            if ((string)$t['type'] === 'stop') {
                                $isTieStop = true;
                            }
                        }
                    }
                    if (isset($note->notations->tied)) {
                        foreach ($note->notations->tied as $t) {
                            if ((string)$t['type'] === 'stop') {
                                $isTieStop = true;
                            }
                        }
                    }

                    if ($isTieStop && isset($activeTies[$pitchVal])) {
                        $startNote = $activeTies[$pitchVal];
                        unset($activeTies[$pitchVal]); // consumed
                        
                        $startSystemIdx = (int)($measureLayoutIdx[$startNote['measureIdx']] / $measuresPerSystem);
                        $endSystemIdx = (int)($measureLayoutIdx[$mIdx] / $measuresPerSystem);
                        
                        if ($startSystemIdx === $endSystemIdx) {
                            // Same system - draw single tie curve
                            $bendDir = ($startNote['stemDir'] === 'up') ? 'down' : 'up';
                            $sx = $startNote['x'] + 1.2;
                            $ex = $noteX - 1.2;
                            $sy = ($bendDir === 'down') ? ($startNote['y'] + 0.5) : ($startNote['y'] - 0.5);
                            $ey = ($bendDir === 'down') ? ($noteY + 0.5) : ($noteY - 0.5);
                            
                            $pdf->DrawTie($sx, $sy, $ex, $ey, $bendDir);
                        } else {
                            // Different systems - draw the second segment (starts at left edge of the measure)
                            $bendDir = ($stemDir === 'up') ? 'down' : 'up';
                            $ex = $noteX - 1.2;
                            $ey = ($bendDir === 'down') ? ($noteY + 0.5) : ($noteY - 0.5);
                            
                            // Left boundary of the current measure:
                            $leftBoundary = $currentMeasureX;
                            $sx = max($leftBoundary + 1, $noteX - 8);
                            $sy = $ey; // keep it horizontal
                            
                            $pdf->DrawTie($sx, $sy, $ex, $ey, $bendDir);
                        }
                    }

                    // Draw Tie / Tied Start
                    $isTieStart = false;
                    if (isset($note->tie)) {
                        foreach ($note->tie as $t) {
                            if ((string)$t['type'] === 'start') {
                                $isTieStart = true;
                            }
                        }
                    }
                    if (isset($note->notations->tied)) {
                        foreach ($note->notations->tied as $t) {
                            if ((string)$t['type'] === 'start') {
                                $isTieStart = true;
                            }
                        }
                    }

                    if ($isTieStart) {
                        // Store starting tie info
                        $activeTies[$pitchVal] = array(
                            'x' => $noteX,
                            'y' => $noteY,
                            'stemDir' => $stemDir,
                            'measureIdx' => $mIdx
                        );
                        
                        // Find matching stop note to see if they are in different systems
                        $stopMeasureIdx = -1;
                        for ($i = $mIdx + 1; $i < $totalMeasures; $i++) {
                            $meas = $measures[$i];
                            foreach ($meas->note as $n) {
                                $nPitch = 71;
                                if (isset($n->pitch)) {
                                    $nStep = (string)$n->pitch->step;
                                    $nOct = (int)$n->pitch->octave;
                                    $nPitch = $this->getPitchValue($nStep, $nOct);
                                } elseif (isset($n->unpitched)) {
                                    $nStep = (string)$n->unpitched->{'display-step'};
                                    $nOct = (int)$n->unpitched->{'display-octave'};
                                    $nPitch = $this->getPitchValue($nStep, $nOct);
                                }
                                
                                if ($nPitch === $pitchVal) {
                                    $hasStop = false;
                                    if (isset($n->tie)) {
                                        foreach ($n->tie as $t) {
                                            if ((string)$t['type'] === 'stop') $hasStop = true;
                                        }
                                    }
                                    if (isset($n->notations->tied)) {
                                        foreach ($n->notations->tied as $t) {
                                            if ((string)$t['type'] === 'stop') $hasStop = true;
                                        }
                                    }
                                    if ($hasStop) {
                                        $stopMeasureIdx = $i;
                                        break 2;
                                    }
                                }
                            }
                        }
                        
                        if ($stopMeasureIdx !== -1) {
                            $startSystemIdx = (int)($measureLayoutIdx[$mIdx] / $measuresPerSystem);
                            $endSystemIdx = (int)($measureLayoutIdx[$stopMeasureIdx] / $measuresPerSystem);
                            
                            if ($startSystemIdx !== $endSystemIdx) {
                                // Different systems - draw the first segment immediately
                                $bendDir = ($stemDir === 'up') ? 'down' : 'up';
                                $sx = $noteX + 1.2;
                                $sy = ($bendDir === 'down') ? ($noteY + 0.5) : ($noteY - 0.5);
                                
                                $ex = $currentMeasureX + $measureWidth - 1;
                                $ey = $sy; // keep it horizontal
                                
                                $pdf->DrawTie($sx, $sy, $ex, $ey, $bendDir);
                            }
                        }
                    }

                    // Draw Lyric Text below the system (margin increased to 16.5mm to completely avoid notehead overlaps, font size reduced to 6.0 for better spacing)
                    if (isset($note->lyric) && isset($note->lyric->text)) {
                        $lyricText = (string)$note->lyric->text;
                        $pdf->SetFont($this->fontFamily, '', 9.0);
                        $pdf->SetXY($noteX - 15, $systemY + 16.5);
                        $pdf->Cell(30, 3, $lyricText, 0, 0, 'C');
                    }
                }

                $lastDuration = $duration;
                $currentDiv += $duration;
            }

            // Move to next system if we hit measures limit per system
            if ($layoutIdx % $measuresPerSystem == $measuresPerSystem - 1) {
                $systemY += 28;
            }
        }

        return $pdf->Output('S');
    }

    /**
     * Map MIDI pitch to staff diatonic step index (E4 = 0)
     *
     * @param int $noteNumber
     * @return int
     */
    private function getTrebleStep($noteNumber)
    {
        $pitchClasses = array(
            0 => 0,  // C
            1 => 0,  // C#
            2 => 1,  // D
            3 => 1,  // D#
            4 => 2,  // E
            5 => 3,  // F
            6 => 3,  // F#
            7 => 4,  // G
            8 => 4,  // G#
            9 => 5,  // A
            10 => 5, // A#
            11 => 6  // B
        );
        
        $pc = $noteNumber % 12;
        $oct = (int) floor($noteNumber / 12);
        
        // E4 (MIDI 64): pc = 4, oct = 5.
        // Let's calculate: (5 * 7) + 2 - 37 = 0.
        return ($oct * 7) + $pitchClasses[$pc] - 37;
    }

    /**
     * Map MIDI Step and Octave to pitch value
     *
     * @param string $step C, D, E, F, G, A, B
     * @param int $octave
     * @return int
     */
    private function getPitchValue($step, $octave)
    {
        $stepMap = array('C' => 0, 'D' => 2, 'E' => 4, 'F' => 5, 'G' => 7, 'A' => 9, 'B' => 11);
        return 12 * ($octave + 1) + $stepMap[strtoupper($step)];
    }
}
