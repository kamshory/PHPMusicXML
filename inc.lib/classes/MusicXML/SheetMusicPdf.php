<?php

namespace MusicXML;

/**
 * SheetMusicPDF class extending FPDF to draw music notation elements
 */
class SheetMusicPDF extends \Fpdf\Fpdf
{
    /**
     * Composer name
     *
     * @var string
     */
    public $composer = 'Unknown';

    /**
     * Copyright year
     *
     * @var string
     */
    public $year = '';

    /**
     * Draw page footer with copyright and page number
     *
     * @return void
     */
    public function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Times', 'I', 8);
        
        $yearStr = !empty($this->year) ? $this->year : date('Y');
        $copyrightText = chr(169) . ' ' . $this->composer . ' ' . $yearStr;
        
        $this->SetX(12);
        $this->Cell(0, 10, $copyrightText, 0, 0, 'L');
        
        $this->SetX(12);
        $this->Cell(0, 10, $this->PageNo() . ' of {nb}', 0, 0, 'R');
    }

    /**
     * Draw an ellipse using Bezier curves
     *
     * @param float $x Center X coordinate
     * @param float $y Center Y coordinate
     * @param float $rx Semi-major axis radius
     * @param float $ry Semi-minor axis radius
     * @param string $style Border/Fill style ('D', 'F', 'FD', 'DF')
     * @return void
     */
    public function Ellipse($x, $y, $rx, $ry, $style = 'D', $rotation = 0)
    {
        $op = match ($style) {
            'F' => 'f',          // fill saja
            'FD', 'DF' => 'B',   // fill + stroke
            'D' => 'S',          // stroke saja
        };

        $k = $this->k;
        $h = $this->h;
        $c = 0.5522847498;

        $lx = $rx * $c;
        $ly = $ry * $c;

        // Simpan transformasi lama
        $this->_out('q');

        // Rotasi sistem koordinat di sekitar titik pusat
        $rot = deg2rad($rotation);
        $cosR = cos($rot);
        $sinR = sin($rot);
        $this->_out(sprintf('%.5f %.5f %.5f %.5f %.5f %.5f cm',
            $cosR, $sinR, -$sinR, $cosR, $x * $k, ($h - $y) * $k));

        // Gambar elips di koordinat lokal (tanpa rotasi)
        $this->_out(sprintf(
            '%.2f %.2f m %.2f %.2f %.2f %.2f %.2f %.2f c',
            $rx * $k, 0,
            $rx * $k, -$ly * $k,
            $lx * $k, -$ry * $k,
            0, -$ry * $k
        ));
        $this->_out(sprintf(
            '%.2f %.2f %.2f %.2f %.2f %.2f c',
            -$lx * $k, -$ry * $k,
            -$rx * $k, -$ly * $k,
            -$rx * $k, 0
        ));
        $this->_out(sprintf(
            '%.2f %.2f %.2f %.2f %.2f %.2f c',
            -$rx * $k, $ly * $k,
            -$lx * $k, $ry * $k,
            0, $ry * $k
        ));
        $this->_out(sprintf(
            '%.2f %.2f %.2f %.2f %.2f %.2f c %s',
            $lx * $k, $ry * $k,
            $rx * $k, $ly * $k,
            $rx * $k, 0,
            $op
        ));

        // Kembalikan transformasi
        $this->_out('Q');
    }

    /**
     * Draw a note flag (eighth, sixteenth, thirty-second) at the specified position and direction
     * 
     * @param float $x X coordinate
     * @param float $y Y coordinate
     * @param string $direction 'up' or 'down'
     * @param string $type 'eighth', '16th', or '32nd'
     */
    public function DrawNoteFlag($x, $y, $direction = 'up', $type = 'eighth')
    {
        // Path SVG daun not ramping dan tajam di ujung
        $flagPathUp = "M -0.112 3.631 
                    C -0.112 0 -0.3031 0 0 0 
                    C 0.28 0.1911 0 0 0 0 
                    C 0.42 0.6879 0.512 0.7834 0.531 0.898 
                    C 1.4 2.8 1.4 2.8 2.327 4.051 
                    C 4.028 5.943 4.525 7.071 4.525 8.581 
                    C 4.506 9.994 3.263 13.014 2.996 12.899 
                    C 3.378 11.829 3.913 10.682 4.047 9.727 
                    C 4.219 8.561 3.741 6.879 1.831 5.16 
                    C 0.779 4.294 0 4.2 -0.112 3.631 Z";

        $flagPathDown = "M -0.112 -3.631 
                        C -0.112 0 -0.3031 0 0 0 
                        C 0.28 -0.1911 0 0 0 0 
                        C 0.42 -0.6879 0.512 -0.7834 0.531 -0.898 
                        C 1.4 -2.8 1.4 -2.8 2.327 -4.051 
                        C 4.028 -5.943 4.525 -7.071 4.525 -8.581 
                        C 4.506 -9.994 3.263 -13.014 2.996 -12.899 
                        C 3.378 -11.829 3.913 -10.682 4.047 -9.727 
                        C 4.219 -8.561 3.741 -6.879 1.831 -5.16 
                        C 0.779 -4.294 0 -4.2 -0.112 -3.631 Z";

        $path = ($direction === 'up') ? $flagPathUp : $flagPathDown;

        // Skala proporsional (lebih kecil agar ramping)
        $scale = 0.42;

        // Gambar sesuai tipe not
        if ($type === 'eighth' || $type === '1/8') {
            $this->DrawSVGPath($path, $x, $y, $scale, $scale, true);
        } elseif ($type === '16th' || $type === '1/16') {
            $this->DrawSVGPath($path, $x, $y, $scale, $scale, true);
            $this->DrawSVGPath($path, $x, $y + (($direction === 'up') ? 1.7 : -1.7), $scale, $scale, true);
        } elseif ($type === '32nd' || $type === '1/32') {
            $this->DrawSVGPath($path, $x, $y, $scale, $scale, true);
            $this->DrawSVGPath($path, $x, $y + (($direction === 'up') ? 1.7 : -1.7), $scale, $scale, true);
            $this->DrawSVGPath($path, $x, $y + (($direction === 'up') ? 3.4 : -3.4), $scale, $scale, true);
        }
    }

    /**
     * Draw a circle using Ellipse
     *
     * @param float $x Center X coordinate
     * @param float $y Center Y coordinate
     * @param float $r Radius
     * @param string $style Border/Fill style ('D', 'F', 'FD', 'DF')
     * @return void
     */
    public function Circle($x, $y, $r, $style = 'D')
    {
        $this->Ellipse($x, $y, $r, $r, $style);
    }

    /**
     * Convert SVG Arc to Cubic Bezier segments
     * Standard implementation of elliptical arc to cubic bezier curves conversion.
     *
     * @param float $x1 Start X coordinate
     * @param float $y1 Start Y coordinate
     * @param float $rx X radius
     * @param float $ry Y radius
     * @param float $angle Rotation angle in degrees
     * @param int $largeArcFlag Large arc flag (0 or 1)
     * @param int $sweepFlag Sweep direction flag (0 or 1)
     * @param float $x2 End X coordinate
     * @param float $y2 End Y coordinate
     * @return array List of bezier control/end points
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
     *
     * @param string $pathStr SVG path string
     * @param float $xOffset X placement offset
     * @param float $yOffset Y placement offset
     * @param float $scaleX X scaling factor
     * @param float $scaleY Y scaling factor
     * @param bool|string $fill Fill flag or fill/stroke style indicator ('B', true, false)
     * @return void
     */
    public function DrawSVGPath($pathStr, $xOffset, $yOffset, $scaleX, $scaleY, $fill = true, $stroke = 'solid')
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
        
        // Tentukan operator akhir berdasarkan fill dan stroke
        if ($stroke === 'none') {
            $op = $fill ? " f* " : ""; // gunakan even‑odd fill rule
        } elseif ($stroke === 'solid') {
            $op = $fill ? " f* " : " S ";
        } elseif ($stroke === 'B') {
            $op = " B ";
        } else {
            $op = $fill ? " f* " : " S ";
        }


        $pdfCmds .= $op;
        $this->_out($pdfCmds);

    }

    /**
     * Draw the treble clef (G-clef)
     *
     * @param float $x Placement X coordinate
     * @param float $y Placement Y coordinate
     * @return void
     */
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

    /**
     * Draw the percussion clef (neutral clef)
     *
     * @param float $x Placement X coordinate
     * @param float $y Placement Y coordinate
     * @return void
     */
    public function DrawPercussionClef($x, $y)
    {
        $this->SetLineWidth(0.8);
        $this->Line($x + 1, $y + 2, $x + 1, $y + 6);
        $this->Line($x + 2.5, $y + 2, $x + 2.5, $y + 6);
        $this->SetLineWidth(0.2);
    }

    /**
     * Draw the sharp accidental symbol
     *
     * @param float $x Placement X coordinate
     * @param float $y Placement Y coordinate
     * @return void
     */
    public function DrawSharp($x, $y)
    {
        // Custom ultra-thin elegant sharp path with shorter stems
        $path = "M1.2 0 L1.6 0 L1.6 10 L1.2 10 Z
              M3.0 0 L3.4 0 L3.4 10 L3.0 10 Z
              M0 3.5 L5 2.5 L5 3.0 L0 4.0 Z
              M0 6.5 L5 5.5 L5 6.0 L0 7.0 Z";
        $this->DrawSVGPath($path, $x - 1.1, $y - 2.1, 0.45, 0.45, true, 'B');
    }

    /**
     * Draw the flat accidental symbol
     *
     * @param float $x Placement X coordinate
     * @param float $y Placement Y coordinate
     * @return void
     */
    public function DrawFlat($x, $y)
    {
        // Closed loop flat path with defined thin stem thickness (0.4 units) so it fills properly
        $path = "M 1.2 0 L 1.6 0 L 1.6 9 C 4.8 9 4.8 18 1.6 18 L 1.2 18 Z";
        $this->DrawSVGPath($path, $x - 0.63, $y - 6.07, 0.45, 0.45, true, 'none');
    }

    /**
     * Draw a tie curve between two notes
     *
     * @param float $sx Start X coordinate
     * @param float $sy Start Y coordinate
     * @param float $ex End X coordinate
     * @param float $ey End Y coordinate
     * @param string $direction Bend direction ('up' or 'down')
     * @return void
     */
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