<section class="wrapper">
        <section class="page_head">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h2>Lupa Password</h2>
                        <nav id="breadcrumbs">
                            <ul>
                                <li>You are here:</li>
                                <li><a href="index.php">Home</a></li>
                                <li>Reset - Password</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="content about">
            <div class="container">
                <?php function showHead(){ ?>
                <div class="row sub_content">
                     <div class="eve-tab sidebar-tab">
                                
                                <ul id="myTab" class="nav nav-tabs">
                                    <li class="active"><a href="#Pesanan" data-toggle="tab">Reset Password</a></li>
                                   
                                </ul>
                                
                                <div id="myTabContent" class="tab-content clearfix">
                                   
                                  <div class="col-md-12">
                                    <?php } ?> 
                                    <?php 
                                        include './config/koneksi.php';
                                        include './config/getTimestamp.php';
                                        
                                        $otp = filter_input(INPUT_GET, 'otp', FILTER_SANITIZE_STRING);
                                        
                                        $sql=mysqli_query($koneksi,"SELECT * FROM otp where kodeotp='$otp'");
                                        $q=mysqli_fetch_array($sql);
                                        $email=$q['email'];
                                        $datecreated=strtotime($q['datecreated']);
                                        $datenow=strtotime(getTimestamp());
                                        
                                        
                                        
                                        if((abs($datenow-$datecreated)/(60*60))>=24){
                                            echo '<div class="alert alert-warning alert-dismissible fade in" role="alert">
                                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                  <span aria-hidden="true">×</span></button>
                                                  <strong>Error!</strong> Link sudah tidak berlaku.
                                                  </div>';
                                        } else if(empty($_GET['otp'])){
                                            echo '<div class="alert alert-warning alert-dismissible fade in" role="alert">
                                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                  <span aria-hidden="true">×</span></button>
                                                  <strong>Error!</strong> Link Salah.
                                                  </div>';
                                        } else {
                                            
                                            echo showHead();
                                        
                                            if(isset($_POST['b1'])){
                                        
                    
                                            if($_POST['passwordbaru1'] != $_POST['passwordbaru2']){
                                            
                                                echo '<div class="alert alert-warning alert-dismissible fade in" role="alert">
                                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                      <span aria-hidden="true">×</span></button>
                                                      <strong>Error!</strong> Password baru tidak sama.
                                                      </div>';
                                                  
                                            } else{
                                                
                                                    $passwordBaru = password_hash($_POST["passwordbaru1"],PASSWORD_DEFAULT);
                                                    
                                                    //query untuk ke database
                                                    $sql = "UPDATE user SET pass = :password
                                                        WHERE email = '$email'";
                                                    $stmt = $db->prepare($sql);
                        
                                                    // bind parameter ke query
                                                    $params = array(":password" => $passwordBaru);
                        
                                                    //eksekusi statement
                                                    $saved = $stmt->execute($params);
                                                    
                                                    $delotp=mysqli_query($koneksi,"DELETE FROM otp WHERE email='$email'");
            
                                                    if($saved){
                                                        echo '<div class="alert alert-success alert-dismissible fade in" role="alert">
                                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                              <span aria-hidden="true">×</span></button>
                                                              <strong>Sukses!</strong> Password berhasil direset.
                                                              </div>';
                                                    }  
                                            }
                                        }
                                        
                                        echo showForm();
                                        }
                                        
                                        
                                    ?>
                                    
                                    <?php function showForm(){ ?>
                                    <form method="post" action="#" enctype="multipart/form-data">
                                    <div class="col-md-5">
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
                                  <?php 
                                    }
                                  ?>
                                  </div>
                                </div>
                            </div>
                </div>
            </div>
        </section>
    </section>
