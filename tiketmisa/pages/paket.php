<!--start wrapper-->
    <section class="wrapper">
        <section class="page_head">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="page_title">
                            <h2>Reset Password</h2>
                           
                        </div>
                        <nav id="breadcrumbs">
                            <ul>
                                <li>You are here:</li>
                                <li><a href="index.php">Home</a></li>
                                <li>Reset Password</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <section class="content contact">
            <div class="container">
                <div class="row sub_content">
                    <div class="col-lg-8 col-md-8 col-sm-8">
                        <div class="dividerHeading">
                            <div class="alert alert-warning alert-dismissible fade in" role="alert">
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">×</span></button>
                                  <strong>Error!</strong> Data tidak boleh ada yang kosong kecuali Lingkungan.
                             </div>
                        </div>
                       <?php 
                            include './config/koneksi.php';
                            include './config/formatTanggal.php';
                            
                            
                                // filter data yang diinputkan
                                $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
                                $password = password_hash($_POST["password"],PASSWORD_DEFAULT);
                                $nik = filter_input(INPUT_POST, 'nik', FILTER_SANITIZE_STRING);
                                $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
                                $paroki = filter_input(INPUT_POST, 'paroki', FILTER_SANITIZE_STRING);
                                $lingkungan = filter_input(INPUT_POST, 'lingkungan', FILTER_SANITIZE_STRING);
                                $alamat = filter_input(INPUT_POST, 'alamat', FILTER_SANITIZE_STRING);
                                $tempatLahir = filter_input(INPUT_POST, 'tempatLahir', FILTER_SANITIZE_STRING);
                                $tanggalLahir = filter_input(INPUT_POST, 'tanggalLahir', FILTER_SANITIZE_STRING);
                                $noHandphone = filter_input(INPUT_POST, 'noHandphone', FILTER_SANITIZE_STRING);
                                $tanggalLahir = tanggalDB($tanggalLahir);
                                
                                //cek email sudah digunakan
                                $ce=mysqli_query($koneksi,"SELECT * FROM user WHERE email='$email'");
                                $hce=mysqli_num_rows($ce);

                            echo '';
                            
                            ?>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <!--end wrapper-->