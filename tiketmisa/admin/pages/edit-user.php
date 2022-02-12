    <div class="content-wrapper">
  <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Edit Jadwal
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="home.php"> Home</a></li>
            <li class="active">Jadwal</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
  <!-- Main row -->
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Form edit Jadwal</h3>
                 
                </div><!-- /.box-header -->
                <div class="box-body">
                <?php 
                            include '../config/koneksi.php';

                            $id= filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING); 

                            if(isset($_POST['b1'])){

                            if(empty($_POST['email']) or empty($_POST['nama'])){

                            echo '<div class="alert alert-warning alert-dismissible fade in" role="alert">
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">×</span></button>
                                  <strong>Error!</strong> Nama dan email tidak boleh kosong.
                                  </div>';

                            }else{
                              
                                // filter data yang diinputkan
                                $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
                            	$nik = filter_input(INPUT_POST, 'nik', FILTER_SANITIZE_STRING);
                                $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
                                $paroki = filter_input(INPUT_POST, 'paroki', FILTER_SANITIZE_STRING);
                                $lingkungan = filter_input(INPUT_POST, 'lingkungan', FILTER_SANITIZE_STRING);
                                $alamat = filter_input(INPUT_POST, 'alamat', FILTER_SANITIZE_STRING);
                                $tempatLahir = filter_input(INPUT_POST, 'tempatLahir', FILTER_SANITIZE_STRING);
                                $tanggalLahir = filter_input(INPUT_POST, 'tanggalLahir', FILTER_SANITIZE_STRING);
                                $noHandphone = filter_input(INPUT_POST, 'noHandphone', FILTER_SANITIZE_STRING);
                                $tanggalLahir = tanggalDB($tanggalLahir);

                                //query untuk ke database
                                $sql = "UPDATE user SET email = :email, nik = :nik, nama = :nama, paroki = :paroki, lingkungan = :lingkungan, alamat = :alamat, tempat_lahir = :tempatLahir, tanggal_lahir = :tanggalLahir, no_handphone = :noHandphone
                                    WHERE userid = '$id'";
                                 $stmt = $db->prepare($sql);
                                
                                // bind parameter ke query
                                $params = array(
                                    ":email" => $email,
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
                                
                                if($saved){
                                    echo '<div class="alert alert-success alert-dismissible fade in" role="alert">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">×</span></button>
                                      <strong>Sukses!</strong> Data berhasil diedit.
                                      </div>';
                                }
                            }
                            }
                            ?>
              <div class="col-lg-6">

                     <form id="contactForm" action="" method="post" enctype="multipart/form-data">
                      <?php
                        $q=mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM user WHERE userid=$id"));
                      ?>
                      <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12">
                                     <label>User ID</label>
                                        <input type="text" name="userid" class="form-control" maxlength="100" value="<?php echo $q['userid']; ?>" placeholder="" readonly>
                                    </div>
                                      
                                </div>
                            </div>
                            <br>
                           
                            <div class="row">
                                <div class="form-group">
                                <div class="col-lg-12 ">
                                <label>Nama</label>
                                   <input type="text" name="nama" class="form-control" maxlength="100" value="<?php echo $q['nama']; ?>" placeholder="Nama" id="nama">
                                      </div>
                                     
                                </div>
                            </div>
							<br>
                            <div class="row">
                                <div class="form-group">
                                <div class="col-lg-12 ">
                                <label>Email</label>
                                   <input type="text" name="email" class="form-control" maxlength="100" value="<?php echo $q['email']; ?>" placeholder="Email" id="email">
                                      </div>
                                     
                                </div>
                            </div>
							<br>
                            <div class="row">
                                <div class="form-group">
                                <div class="col-lg-12 ">
                                <label>NIK</label>
                                   <input type="text" name="nik" class="form-control" maxlength="100" value="<?php echo $q['nik']; ?>" placeholder="NIK" id="nik">
                                      </div>
                                     
                                </div>
                            </div>
							<br>
                            <div class="row">
                                <div class="form-group">
                                <div class="col-lg-12 ">
                                <label>Alamat</label>
                                   <input type="text" name="alamat" class="form-control" maxlength="100" value="<?php echo $q['alamat']; ?>" placeholder="Alamat" id="alamat">
                                      </div>
                                     
                                </div>
                            </div>
							<br>
                            <div class="row">
                                <div class="form-group">
                                <div class="col-lg-12 ">
                                <label>Paroki</label>
                                   <input type="text" name="paroki" class="form-control" maxlength="100" value="<?php echo $q['paroki']; ?>" placeholder="Paroki" id="paroki">
                                      </div>
                                     
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="form-group">
                                <div class="col-lg-12 ">
                                <label>Lingkungan</label>
                                   <input type="text" name="lingkungan" class="form-control" maxlength="100" value="<?php echo $q['lingkungan']; ?>" placeholder="Lingkungan" id="lingkungan">
                                      </div>
                                     
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="form-group">
                                <div class="col-lg-12 ">
                                <label>Tempat Lahir</label>
                                   <input type="text" name="tempatLahir" class="form-control" maxlength="100" value="<?php echo $q['tempat_lahir']; ?>" placeholder="Tempat Lahir" id="tempatLahir">
                                      </div>
                                     
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="form-group">
                                <div class="col-lg-12 ">
                                <label>Tanggal Lahir</label>
                                   <input type="text" name="tanggalLahir" class="form-control" maxlength="100" value="<?php echo $q['tanggal_lahir']; ?>" placeholder="Tanggal Lahir" id="datepicker">
                                      </div>
                                     
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="form-group">
                                <div class="col-lg-12 ">
                                <label>No Hp</label>
                                   <input type="text" name="noHandphone" class="form-control" maxlength="100" value="<?php echo $q['no_handphone']; ?>" placeholder="No Handphone" id="no_handphone">
                                      </div>
                                     
                                </div>
                            </div>
                            <br>

                           <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" name="b1" class="btn btn-success"><i class="fa fa-save"></i> Edit User</button>
                                    <a href="home.php?p=list-user" class="btn btn-info"><i class="fa fa-table"></i> List User</a>
                                </div>
                            </div>
                        </form>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

     </section><!-- /.content -->

   </div>
    <script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!-- Bootstrap 3.3.5 -->
    <script src="../assets/js/bootstrap.min.js"></script>
     <!-- DataTables -->
     
     
     <script src="../assets/js/jQuery.js"></script>
            <script src="../assets/js/moment.js"></script>

     <script src="../assets/js/bootstrap-datetimepicker.min.js"></script>
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