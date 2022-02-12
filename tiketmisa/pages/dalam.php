<!--start wrapper-->
    <section class="wrapper">
        <section class="page_head">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="page_title">
                            <h2>Mendaftar</h2>
                           
                        </div>
                        <nav id="breadcrumbs">
                            <ul>
                                <li>You are here:</li>
                                <li><a href="index.php">Home</a></li>
                                <li>Daftar</li>
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
                            <h4><span>Daftar</span></h4>
                        </div>
                       <?php 
                            include './config/koneksi.php';

                            if(isset($_POST['b1'])){
                                
                                // filter data yang diinputkan
                                $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
                                $password = password_hash($_POST["password"],PASSWORD_DEFAULT);
                                $nik = filter_input(INPUT_POST, 'nik', FILTER_SANITIZE_STRING);
                                $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
                                $alamat = filter_input(INPUT_POST, 'alamat', FILTER_SANITIZE_STRING);
                                $noHandphone = filter_input(INPUT_POST, 'noHandphone', FILTER_SANITIZE_STRING);
                                $lingkungan = filter_input(INPUT_POST, 'lingkunganNama', FILTER_SANITIZE_STRING);
                                $paroki = "KOTABARU";
                                
                                $postDB = mysqli_query($koneksi,"SELECT * FROM umat WHERE nama='$nama'");
							    $post1 = mysqli_fetch_array($postDB);
                                
                                $tempatLahir = $post1["tempat_lahir"];
                                $tanggalLahir = $post1["tanggal_lahir"];           

                                //cek email sudah digunakan
                                $ce=mysqli_query($koneksi,"SELECT * FROM user WHERE email='$email'");
                                $hce=mysqli_num_rows($ce);


                            if(empty($_POST['email']) or empty($_POST['pass']) or empty($_POST['nik']) or empty($_POST['nama']) 
                               or empty($_POST['alamat']) or empty($_POST['noHandphone'])){

                            echo '<div class="alert alert-warning alert-dismissible fade in" role="alert">
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">×</span></button>
                                  <strong>Error!</strong> Data tidak boleh ada yang kosong.
                                  </div>';
                            }
                            else if($hce > 0){

                            echo '<div class="alert alert-warning alert-dismissible fade in" role="alert">
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">×</span></button>
                                  <strong>Error!</strong> Email sudah digunakan,silahkan masukan email lain.
                                  </div>';
                            }
                            
                            else{
       
                                //query untuk ke database
                                    $sql = "INSERT INTO user (email, pass, nik, nama, paroki, lingkungan, alamat, tempat_lahir, tanggal_lahir, no_handphone)
                                	        VALUES (:email, :password, :nik, :nama, :paroki, :lingkungan, :alamat, :tempatLahir, :tanggalLahir, :noHandphone)";
                                    $stmt = $db->prepare($sql);
    
                                    // bind parameter ke query
                                    $params = array(
                                        ":email" => $email,
                                        ":password" => $password,
                                        ":nik" => $nik,
                                        ":nama" => $nama,
                                        ":paroki" => $paroki,
                                        ":lingkungan" => $lingkungan,
                                        ":alamat" => $alamat,
                                        ":tempatLahir" => $tempatLahir,
                                        ":tanggalLahir" => $tanggalLahir,
                                        ":noHandphone" => $noHandphone);
    
                                    //eksekusi statement
                                    $saved = $stmt->execute($params);
    
	                                //hasil yang ditampilkan ketika selesai query
	                                $userdb=mysqli_query($koneksi,"SELECT * FROM user WHERE email='$email'");
                                    $user=mysqli_fetch_array($userdb);
                                    
                                    session_start();
                                    $_SESSION["user"] = $user;
                                    $_SESSION["user"]["hak"] = "user";
                                    
                                    if($saved){
                                    echo '<div class="alert alert-success alert-dismissible fade in" role="alert">
            												  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            												  <span aria-hidden="true">×</span></button>
            												  <strong>Sukses!</strong> Pendaftaran anda berhasil ,Silahkan login dengan email dan password yang anda daftarkan.
            												  </div>';
            												  
                                    header("Location: index.php");
                                    }
                                }
                            }
                        ?>
                        
							
							<div class="row">
                                <div class="form-group">
                                  <form id="contactForm" action="" method="post">
                                    <div class="col-md-12">
                                        <input type="text" id="lingkungan" name="lingkungan" class="form-control" maxlength="50" data-msg-required="Silahkan isi lingkungan anda." value="" placeholder="Passcode">
										<input type="submit" name="b2" data-loading-text="Loading..." class="btn btn-default btn-lg" value="Cek">
                                    </div>
                                  </form>
                                </div>
                            </div>
							<br>
							<form id="contactForm" action="" method="post">
                       <?php 
                            include './config/koneksi.php';

                            if(isset($_POST['b2'])){
                            
							$ling = filter_input(INPUT_POST, 'lingkungan', FILTER_SANITIZE_STRING);
                        
							$lingDB = mysqli_query($koneksi,"SELECT * FROM lingkungan WHERE passcode=$ling");
							$ling1 = mysqli_fetch_array($lingDB);
							$lingID = $ling1["lingkungan_id"];
							
							if(mysqli_num_rows($lingDB)>0) {
							    
                                $umatDB = mysqli_query($koneksi,"SELECT * FROM umat WHERE lingkungan_id=$lingID");
                                
			    				echo "<div class='row'>
                                    <div class='form-group'>
                                       
                                        <div class='col-md-12 '>
                                            <select id='nama' name='nama' class='form-control' maxlength='16' data-msg-required=''>";
                                            
                                 while($data = mysqli_fetch_array($umatDB))  {          
                                            echo "<option value='" . $data['nama'] . "'>" . $data['nama'] . "</option>";
                                 }
                                            
                                echo "          </select>
                                        </div>
                                
                                    </div>
                                </div>
                            
                            <div class='row'>
                                <div class='form-group'>
                                   
                                    <div class='col-md-12 '>
                                        <input type='text' id='lingkunganNama' name='lingkunganNama' class='form-control' maxlength='16' data-msg-required='' value='" . $ling1["lingkungan"] . "' placeholder='' readonly>
                                    </div>
                                
                                </div>
                            </div>
                            
							<div class='row'>
                                <div class='form-group'>
                                   
                                    <div class='col-md-12 '>
                                        <input type='text' id='nik' name='nik' class='form-control' maxlength='16' data-msg-required='Silahkan isi nomor NIK anda.' value='' placeholder='NIK' >
                                    </div>
                                
                                </div>
                            </div>
                             
                            <div class='row'>
                                <div class='form-group'>
                                    <div class='col-md-12'>
										<input type='text' id='noHandphone' name='noHandphone' class='form-control' maxlength='14' data-msg-required='Silahkan isi nomor telepon anda' value='' placeholder='Nomor Telepon'>
                                    </div>
                                     
                                </div>
                            </div>
                            
							<div class='row'>
                                <div class='form-group'>
                                    <div class='col-md-12'>
										<input type='text' id='alamat' name='alamat' class='form-control' maxlength='100' data-msg-required='Silahkan isi alamat anda' value='' placeholder='Alamat'>
                                    </div>
                                     
                                </div>
                            </div>
                              
                            <div class='row'>
                                <div class='form-group'>
                                  
                                    <div class='col-md-12'>
                                        <input type='text' id='email' name='email' class='form-control' maxlength='50' data-msg-required='Silahkan isi email anda.' value='' placeholder='Email'>
                                    </div>
                                
                                </div>
                            </div>
							
                            <div class='row'>
                                <div class='form-group'>
                                  
                                     <div class='col-md-12'>
                                        <input type='password' id='pass' name='pass' class='form-control' maxlength='20' data-msg-required='Please enter the password.' value='' placeholder='Password'>
                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-md-12'>
                                    <input type='submit' name='b1' data-loading-text='Loading...' class='btn btn-default btn-lg' value='Daftar'>
                                </div>
                            </div>";
                            
                                }else{
                                }
                            }
                            ?>
                        </form>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="sidebar">
                            <div class="widget_info">
                                <div class="dividerHeading">
                                    <h4><span>Petunjuk Pendaftaran</span></h4>
                                    </div>
                                <p><i class="fa fa-angle-double-right"></i> Isilah data anda dengan lengkap sesuai dengan data diri anda yang sebenarnya.</p><br>
                                
                                <p><i class="fa fa-angle-double-right"></i> Setelah anda mendaftar anda akan bisa langsung untuk memesan tiket misa</p><br>
                                <p><i class="fa fa-angle-double-right"></i> Jika data anda tidak sesuai dengan yang sebenarnya maka kami tidak akan memproses pemesanan tiket anda.</p><br>
                                 <p><i class="fa fa-angle-double-right"></i> Untuk informasi lebih lanjut silahkan anda hubungi kami lelalui kontak kami,atau anda juga dapat mengunjungi kami melalui alamat kami ,Terimakasih.</p>
                                
                               
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
			<script type="text/javascript">
      $(function () {
        
        $('#datepicker').datetimepicker({
                                  
          format: 'DD/MM/YYYY',
            sideBySide: true,
          widgetPositioning: {
              horizontal: 'right',
              vertical: 'bottom'
          }
          
        });
       
      });
      </script>
        </section>
    </section>
    <!--end wrapper-->
 