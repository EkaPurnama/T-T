<?php
function Nipin($nipon) {
    $na = chunk_split($nipon, 15, " ");
    $nb = chunk_split($na, 14, " ");
    $nc = chunk_split($nb, 8, " ");
    return $nc;
    }
function Tglin($tglon) {
	$tglout = date_format(date_create($tglon),"d-F-Y");
	return $tglout;
	}
function Tglan($tglon) {
	$tglout = date_format(date_create($tglon),"d-m-Y");
	return $tglout;
	}
?>