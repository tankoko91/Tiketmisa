<div class="content-wrapper">
		<section class="content-header">
			<h1>Profil Admin <small></small></h1>
			<ol class="breadcrumb">
				<li>
					<a href="#">Home</a>
				</li>
				<li class="active">Profil</li>
			</ol>
		</section>
		<section class="content">
			<div class="row sub_content">
				<div class="eve-tab sidebar-tab">
					<ul class="nav nav-tabs" id="myTab">
						<li class="active">
							<a data-toggle="tab" href="#Pesanan">Biodata</a>
						</li>
						<li class="">
							<a data-toggle="tab" href="#Transaksi">Ganti Password</a>
						</li>
					</ul>
					<div class="tab-content clearfix" id="myTabContent">
						<div class="tab-pane fade <?php
						if(!isset($_POST['b2'])){
						    echo 'active in';  
						}?>" id="Pesanan">
							<div class="table-responsive">
								<?php 
								            
								            include '../config/koneksi.php';
								            session_start();
								            
								            
								            if(isset($_POST['b1'])){
								                
								                if(empty($_POST['alamat']) or empty($_POST['email']) or empty($_POST['nama']) or empty($_POST['noHandphone'])){
								    
								                    echo '<div class="alert alert-warning alert-dismissible fade in" role="alert">
								                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								                          <span aria-hidden="true">×</span></button>
								                          <strong>Error!</strong> Data tidak boleh ada yang kosong.
								                          </div>';
								    
								                } else{
								                    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
								                    $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
								                    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
								                    $noHandphone = filter_input(INPUT_POST, 'noHandphone', FILTER_SANITIZE_STRING);
								                    $alamat = filter_input(INPUT_POST, 'alamat', FILTER_SANITIZE_STRING);
								                     
								                    $sql = "UPDATE admin SET alamat = :alamat, no_handphone = :noHandphone, nama = :nama,
								                            email = :email WHERE id = '$id'";
								                    $stmt = $db->prepare($sql);
								                    
								                    // bind parameter ke query
								                    $params = array(
								                    ":alamat" => $alamat,
								                    ":noHandphone" => $noHandphone,
								                    ":nama" => $nama,
								                    ":email" => $email);

								                    //eksekusi statement
								                    $saved = $stmt->execute($params);
								                    
								                    $_SESSION['admin']["alamat"] = $alamat;
								                    $_SESSION['admin']["no_handphone"] = $noHandphone;
								                    $_SESSION['admin']["nama"] = $nama;
								                    $_SESSION['admin']["email"] = $email;                            
								                                                
								                    echo '<div class="alert alert-success alert-dismissible fade in" role="alert">
								                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								                      <span aria-hidden="true">×</span></button>
								                      <strong>Sukses!</strong> Data berhasil diedit.
								                      </div>';
								                }
								            }
								            
								            
								            ?>
								
								<br>
								<form action="" class="form-horizontal" enctype="multipart/form-data" method="post">
									<!-- /.col -->
									<div class="col-md-8">
											<div class="tab-content">
												<div class="active tab-pane" id="activity">
													<div class="form-group">
														<label class="col-sm-2 control-label" for="inputName">Nama</label>
														<div class="col-sm-10">
															<input class="form-control" id="id" name="id" placeholder="Id" type="hidden" value="<?php echo $_SESSION['admin']['id']; ?>"> <input class="form-control" id="nama" name="nama" placeholder="Name" type="text" value="<?php echo $_SESSION['admin']['nama']; ?>">
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-2 control-label" for="inputName">Email</label>
														<div class="col-sm-10">
															<input class="form-control" id="email" name="email" placeholder="Email" type="text" value="<?php echo $_SESSION['admin']['email']; ?>">
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-2 control-label" for="inputName">Nomor Telepon</label>
														<div class="col-sm-10">
															<input class="form-control" id="noHandphone" name="noHandphone" placeholder="Nomor Telepon" type="text" value="<?php echo $_SESSION['admin']['no_handphone']; ?>">
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-2 control-label" for="inputSkills">Alamat</label>
														<div class="col-sm-10">
															<input class="form-control" id="alamat" name="alamat" placeholder="Alamat" type="text" value="<?php echo $_SESSION['admin']['alamat']; ?>">
														</div>
													</div>
													<div class="form-group">
														<div class="col-sm-offset-2 col-sm-10">
															<button class="btn btn-info" name="b1" type="submit">Update</button>
														</div>
													</div>
												</div>
											</div><!-- /.tab-content -->
										<!-- /.nav-tabs-custom -->
									</div>
									<!-- /.col -->
								</form>
							</div>
						</div>
						<div class="tab-pane fade <?php
						if(isset($_POST['b2'])){
						    echo 'active in';  
						}?>" id="Transaksi">
							<div class="table-responsive">
							    <?php
    							    if(isset($_POST['b2'])){
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
                                            
                                            $email = $_SESSION["admin"]["email"];
                                            $passLama = filter_input(INPUT_POST, 'passwordlama', FILTER_SANITIZE_STRING);
                                            $passDB = $_SESSION["admin"]["pass"];
                                            
                                                // verifikasi password
                                                if(password_verify($passLama, $passDB)){
                                                  
                                                $passwordBaru = password_hash($_POST["passwordbaru1"],PASSWORD_DEFAULT);
                                                
                                                //query untuk ke database
                                                $sql = "UPDATE admin SET pass = :password
                                                    WHERE email = '$email'";
                                                    $stmt = $db->prepare($sql);
                        
                                                    // bind parameter ke query
                                                    $params = array(":password" => $passwordBaru);
                        
                                                    //eksekusi statement
                                                    $saved = $stmt->execute($params);
                                                    
                                                    $_SESSION["admin"]["pass"] = $passwordBaru;
                                                    
                                                    echo '<div class="alert alert-success alert-dismissible fade in" role="alert">
                                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                          <span aria-hidden="true">×</span></button>
                                                          <strong>Sukses!</strong> Password berhasil diganti.
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
							<br>
							<form action="" class="form-horizontal" enctype="multipart/form-data" method="post">
									<div class="col-md-8">
											<div class="tab-content">
												<div class="active tab-pane" id="activity">
													<div class="form-group">
														<label class="col-sm-2 control-label" for="inputName">Password Lama</label>
														<div class="col-sm-10">
															<input id="passwordlama" type="password" class="form-control" name="passwordlama" value="">
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-2 control-label" for="inputName">Password Baru</label>
														<div class="col-sm-10">
																<input id="passwordbaru1" type="password" class="form-control" name="passwordbaru1" value="">
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-2 control-label" for="inputName">Konfirmasi Password Baru</label>
														<div class="col-sm-10">
															<input id="passwordbaru2" type="password" class="form-control" name="passwordbaru2" value="">	
														</div>
													</div>
													
													<div class="form-group">
														<div class="col-sm-offset-2 col-sm-10">
															<button class="btn btn-info" name="b2" type="submit">Simpan</button>
														</div>
													</div>
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
	</div>