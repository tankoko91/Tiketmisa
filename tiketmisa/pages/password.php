<?php 
    session_start();
    if($_SESSION['user']['hak']!="user"){
        header("location:./index.php?p=login");
    } else {
?>
<section class="wrapper">
        <section class="page_head">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h2>Profil Saya</h2>
                        <nav id="breadcrumbs">
                            <ul>
                                <li>You are here:</li>
                                <li><a href="index.php">Home</a></li>
                                <li>Password</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="content about">
            <div class="container">
                <div class="row sub_content">
                     <div class="eve-tab sidebar-tab">
                                <ul id="myTab" class="nav nav-tabs">
                                    <li class="active"><a href="#Pesanan" data-toggle="tab">Ganti Password</a></li>
                                   
                                </ul>

                                <div id="myTabContent" class="tab-content clearfix">
                                   
                                    
                                  <div class="col-md-12">
                                     <?php 
                                        include './config/koneksi.php';
                                        session_start();
                                        
                                        if(isset($_POST['b1'])){
                                        
                                            if(empty($_POST['passwordbaru1']) or empty($_POST['passwordbaru2']) or empty($_POST['passwordlama'])){
                
                                            echo '<div class="alert alert-warning alert-dismissible fade in" role="alert">
                                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                  <span aria-hidden="true">×</span></button>
                                                  <strong>Error!</strong> Data tidak boleh ada yang kosong.
                                                  </div>';
                
                                            } else if($_POST['passwordbaru1'] != $_POST['passwordbaru2']){
                                            
                                            echo '<div class="alert alert-warning alert-dismissible fade in" role="alert">
                                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                  <span aria-hidden="true">×</span></button>
                                                  <strong>Error!</strong> Password baru tidak sama.
                                                  </div>';
                                                  
                                            } else{
                                                
                                                $email = $_SESSION["user"]["email"];
                                                $passLama = filter_input(INPUT_POST, 'passwordlama', FILTER_SANITIZE_STRING);
                                                $passDB = $_SESSION["user"]["pass"];
                                                
                                                    // verifikasi password
                                                    if(password_verify($passLama, $passDB)){
                                                      
                                                    $passwordBaru = password_hash($_POST["passwordbaru1"],PASSWORD_DEFAULT);
                                                    
                                                    //query untuk ke database
                                                    $sql = "UPDATE user SET pass = :password
                                                        WHERE email = '$email'";
                                                    $stmt = $db->prepare($sql);
                        
                                                    // bind parameter ke query
                                                    $params = array(":password" => $passwordBaru);
                        
                                                    //eksekusi statement
                                                    $saved = $stmt->execute($params);
                                                    
                                                    $_SESSION["user"]["pass"] = $passwordBaru;
                                                    
                                                    echo '<div class="alert alert-success alert-dismissible fade in" role="alert">
                                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                          <span aria-hidden="true">×</span></button>
                                                          <strong>Sukses!</strong> Data berhasil diedit.
                                                          </div>';
                                                          
                                                    } else{
                                                        echo '<div class="alert alert-warning alert-dismissible fade in" role="alert">
                                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                              <span aria-hidden="true">×</span></button>
                                                              <strong>Error!</strong> Password lama salah.'.$username.'
                                                              </div>';  
                                                }
                                            }
                                        }
                                    ?>
                                    <form method="post" action="#" enctype="multipart/form-data">
                                    <div class="col-md-5">
                                      <div class="form-group">
                                        <label for="passwordlama" class="control-label">Password Lama</label>
                                        <input id="passwordlama" type="password" class="form-control" name="passwordlama" value="">
                                      </div>
									  
                                      <div class="form-group">
                                        <label for="passwordbaru1" class="control-label">Password Baru</label>
                                        <input id="passwordbaru1" type="password" class="form-control" name="passwordbaru1" value="">
                                      </div>
									  <div class="form-group">
                                        <label for="passwordbaru2" class="control-label">Konfirmasi Password Baru</label>
                                        <input id="passwordbaru2" type="password" class="form-control" name="passwordbaru2" value="">
                                      </div>
                                    </div>
                                    <div class="col-md-12">
                                      <div class="row">
                                  
                                      <div class="col-md-12">
                                      <button type="submit" name="b1" class="btn btn-default btn-lg ">
                                      <i class="fa fa-edit"></i> Simpan Perubahan
                                      </button>
                                    </div>
                                  </div>
                                    </div>
                                  </form>
                                  </div>
                                </div>
                            </div>
                </div>
            </div>
        </section>
    </section>
<?php
}
?>    