<?php
function calculos ($id_prov, $costo) {
    if ($id_prov != 13 && $id_prov != 16 && $id_prov != 24) 
        {
            $a = (30 * $costo) / 100;
            $docena = $costo + $a;
            $f = $costo / 12;
            $g = (55 * $f) / 100;
            $oferta = $f + $g;
            return array($docena, $oferta);
        } elseif ($id_prov == 13)
            {
                $a = (25 * $costo)/ 100;
                $b = $costo - $a;
                $c = (12 * $b)/ 100;
                $d = $b + $c;
                $e = (26 * $d)/ 100;
                $docena = $d + $e;
                $f = $d / 12;
                $g = (55 * $f)/ 100;
                $oferta = $f + $g;
                return array($docena, $oferta);
            } elseif ($id_prov == 16 || $id_prov == 24)
                {
                    $a = (20 * $costo) / 100;
                    $b = $costo - $a;
                    $c = (7 * $b) / 100;
                    $d = $b + $c;
                    $doce = $d * 12;
                    $e = (30 * $doce) / 100;
                    $docena = $doce + $e;
                    $f = (50 * $d) / 100;
                    $oferta = $f + $d;
                    return array($docena, $oferta);
                } else {
                    $a = (22 * $costo) / 100;
                    $docena = $costo + $a;
                    $f = $costo / 12;
                    $g = (55 * $f) / 100;
                    $oferta = $f + $g;
                    return array($docena, $oferta);
                    }
                    
}
?>