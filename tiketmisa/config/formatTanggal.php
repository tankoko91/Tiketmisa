<?php

function tanggalOut($in){  
    $tanggal = substr($in, 8, 2);
    $bulan = substr($in, 5, 2);
    $tahun = substr($in, 0, 4);
    
    $out = $tanggal.'-'.$bulan.'-'.$tahun;  

	return $out;  
 }  
 
function tanggalDB($in){
    $tanggal = substr($in, 0, 2);
    $bulan = substr($in, 3, 2);
    $tahun = substr($in, 6, 4);
    
    $out = $tahun.'-'.$bulan.'-'.$tanggal;  
    
    return $out;
}
?>