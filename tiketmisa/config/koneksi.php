<?php

    //Database connection config
    $DBHost="localhost";
    $DBUser="root";
    $DBPass="";
    $DBName="segogaring_TiketMisaNew";
	
	//Create connection
	$koneksi  = mysqli_connect($DBHost, $DBUser, $DBPass, $DBName);
	
	//Message jika gagal
	if (!$koneksi) {
      die("Connection failed: " . mysqli_connect_error());
    }

    try {    
        //create PDO connection 
        $db = new PDO("mysql:host=$DBHost;dbname=$DBName", $DBUser, $DBPass);
    } catch(PDOException $e) {
        //show error
        die("Terjadi masalah: " . $e->getMessage());
    }
?>
