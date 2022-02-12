<?php 
    session_start();
    if($_SESSION['user']['hak']!="user"){
		$self = $_SERVER["REUQUEST_URI"];
		$_SESSION['url'] = $self;
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
                                <li>Profil</li>
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
                                    <li class="active"><a href="#Pesanan" data-toggle="tab">Biodata</a></li>
                                   
                                </ul>

                                <div id="myTabContent" class="tab-content clearfix">
                                   
                                    
                                  <div class="col-md-12">
                                    <?php 
                                        include './config/koneksi.php';
                                        session_start();
                                        
                                        if(isset($_POST['b1'])){
                                            
                                            if(empty($_POST['alamat']) or empty($_POST['noHandphone'])){

                                            echo '<div class="alert alert-warning alert-dismissible fade in" role="alert">
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                              <span aria-hidden="true">×</span></button>
                                              <strong>Error!</strong> Data tidak boleh ada yang kosong.
                                              </div>';
                                            }
                                            
                                            else{
                                                
                                                $email = $_SESSION["user"]["email"];
                                                $alamat = filter_input(INPUT_POST, 'alamat', FILTER_SANITIZE_STRING);
                                                $noHandphone = filter_input(INPUT_POST, 'noHandphone', FILTER_SANITIZE_STRING);

                                                $sql = "UPDATE user SET alamat = :alamat, no_handphone = :noHandphone
                                                        WHERE email = '$email'";
                                                $stmt = $db->prepare($sql);
                                                
                                                // bind parameter ke query
                                                $params = array(
                                                ":alamat" => $alamat,
                                                ":noHandphone" => $noHandphone);
    
                                                //eksekusi statement
                                                $saved = $stmt->execute($params);
                                                
                                                $_SESSION["user"]["alamat"] = $alamat;
                                                $_SESSION["user"]["no_handphone"] = $noHandphone;
                                                
                                                echo '<div class="alert alert-success alert-dismissible fade in" role="alert">
                                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                      <span aria-hidden="true">×</span></button>
                                                      <strong>Success!</strong> Data berhasil diubah.
                                                      </div>';
                                            }
                                        }
                                    ?>
                                    <form method="post" action="#" enctype="multipart/form-data">
                                   
                                    <div class="col-md-5">
                                      <div class="form-group">
                                        <label for="nama" class="control-label">Nama Lengkap</label>
                                        <input readonly id="nama" type="text" class="form-control" name="nama" value="<?php echo $_SESSION['user']['nama']; ?>">
                                      </div>
                                      
									  <div class="form-group">
                                        <label for="noHandphone" class="control-label">Nomor Handphone</label>
                                        <input id="noHandphone" type="text" class="form-control" name="noHandphone" value="<?php echo $_SESSION['user']['no_handphone']; ?>">
                                      </div>
                                    </div>
                                    
                                    <div class="col-md-5">
                                       <div class="form-group">
                                        <label for="email" class="control-label">Email</label>
                                        <input readonly id="email" type="text" class="form-control" name="email" value="<?php echo $_SESSION['user']['email']; ?>">
                                      </div>
									  <div class="form-group">
                                        <label for="alamat" class="control-label">Alamat</label>
                                        <input id="alamat" type="text" class="form-control" name="alamat" value="<?php echo $_SESSION['user']['alamat']; ?>">
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