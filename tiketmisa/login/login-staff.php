<?php

include "../config/koneksi.php";

    $username = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);

    $sql = "SELECT * FROM staff WHERE email=:email";
    $stmt = $db->prepare($sql);
    
    // bind parameter ke query
    $params = array(
        ":email" => $username
    );

    $stmt->execute($params);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // jika user terdaftar
    if($user){
        // verifikasi password
        if(password_verify($password, $user["pass"])){
            // buat Session
            session_start();
            $_SESSION["staff"] = $user;
            $_SESSION["user"]["hak"] = "staff";
            // login sukses, alihkan ke halaman admin
        header("location:../staff/home.php");
        }else{
            header("location:../staff/index.php?id=error");
        }
    }
    else{
        header("location:../staff/index.php?id=error");
        //echo "<meta http-equiv=refresh content=0;url=../index.php?";
    }
?>