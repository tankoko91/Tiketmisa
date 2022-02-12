<?php

include "../config/koneksi.php";
 
    $username = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);
    $url = $_SESSION['url'];
    
    $sql = "SELECT * FROM user WHERE email=:email";
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
            $_SESSION["user"] = $user;
            $_SESSION["user"]["hak"] = "user";
            // login sukses, alihkan ke halaman user
            $delotp=mysqli_query($koneksi,"DELETE FROM otp WHERE email='$username'");
            if($url==""){
                header("location:../index.php");
            } else {
                header("location:../..".$url);
            }
        }else{
            header("location:../index.php?p=login&id=error");
        }
    }
    else{
        header("location:../index.php?p=login&id=error");
        //echo "<meta http-equiv=refresh content=0;url=../index.php?";
    }

?>