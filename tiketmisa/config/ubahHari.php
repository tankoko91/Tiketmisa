<?php

function ubahHari($hariIn)  
 {  
    $hariOut = '';  

    switch($hariIn){
		case 'Sunday':
			$hariOut = 'Minggu';
		break;
 
		case 'Monday':			
			$hariOut = 'Senin';
		break;
 
		case 'Tuesday':
			$hariOut = 'Selasa';
		break;
 
		case 'Wednesday':
			$hariOut = 'Rabu';
		break;
 
		case 'Thursday':
			$hariOut = 'Kamis';
		break;
 
		case 'Friday':
			$hariOut = 'Jumat';
		break;
 
		case 'Saturday':
			$hariOut = 'Sabtu';
		break;
		
		default:
			$hariOut = 'Tidak di ketahui';		
		break;
	}
	
       return $hariOut;  
 }  
 
?>