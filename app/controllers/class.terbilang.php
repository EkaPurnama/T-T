<?php
function Terbilang($a) {
    $ambil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    if ($a < 12)
        return " " . $ambil[$a];
    elseif ($a < 20)
        return Terbilang($a - 10) . "belas";
    elseif ($a < 100)
        return Terbilang($a / 10) . " puluh" . Terbilang($a % 10);
    elseif ($a < 200)
        return " seratus" . Terbilang($a - 100);
    elseif ($a < 1000)
        return Terbilang($a / 100) . " ratus" . Terbilang($a % 100);
    elseif ($a < 2000)
        return " seribu" . Terbilang($a - 1000);
    elseif ($a < 1000000)
        return Terbilang($a / 1000) . " ribu" . Terbilang($a % 1000);
    elseif ($a < 1000000000)
        return Terbilang($a / 1000000) . " juta" . Terbilang($a % 1000000);
}
?>