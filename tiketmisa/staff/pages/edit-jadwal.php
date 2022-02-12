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

                            // filter data yang diinputkan
                            $tanggal = filter_input(INPUT_POST, 'tanggal', FILTER_SANITIZE_STRING);
                            $jam = filter_input(INPUT_POST, 'jam', FILTER_SANITIZE_STRING);
                            $romo = filter_input(INPUT_POST, 'romo', FILTER_SANITIZE_STRING);
                            $tema = filter_input(INPUT_POST, 'tema', FILTER_SANITIZE_STRING);
                            $aktif = filter_input(INPUT_POST, 'aktif', FILTER_SANITIZE_STRING);
                            $blok1 = filter_input(INPUT_POST, 'blok1', FILTER_SANITIZE_STRING);
                            $blok2 = filter_input(INPUT_POST, 'blok2', FILTER_SANITIZE_STRING);
                            $blok3 = filter_input(INPUT_POST, 'blok3', FILTER_SANITIZE_STRING);
                            $blok4 = filter_input(INPUT_POST, 'blok4', FILTER_SANITIZE_STRING);
                            $blok5 = filter_input(INPUT_POST, 'blok5', FILTER_SANITIZE_STRING);
                            $blok6 = filter_input(INPUT_POST, 'blok6', FILTER_SANITIZE_STRING);
                            $blok7 = filter_input(INPUT_POST, 'blok7', FILTER_SANITIZE_STRING);
                            
                            //cek jadwal sudah digunakan
                            $cj=mysqli_query($koneksi,"SELECT * FROM jadwal WHERE tanggal='$tanggal' AND jam='$jam' AND jadwalid!=$id");
                            $hcj=mysqli_num_rows($cj);
                                
                            if(empty($_POST['tanggal']) or empty($_POST['jam'])){

                            echo '<div class="alert alert-warning alert-dismissible fade in" role="alert">
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">×</span></button>
                                  <strong>Error!</strong> Data tidak boleh ada yang kosong.
                                  </div>';
                            }
                            
                            else if($hcj > 0){

                            echo '<div class="alert alert-warning alert-dismissible fade in" role="alert">
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">×</span></button>
                                  <strong>Error!</strong> Jadwal pada tanggal ' . $_POST['tanggal'] .
                                  ' dan jam ' . $_POST['jam'] . ' sudah ada.
                                  </div>';
                            }
                            
                            else {
                                
                              //query untuk ke database
                                    $sql = "UPDATE jadwal SET tanggal = :tanggal, jam = :jam, romo = :romo, tema = :tema, aktif = :aktif, blok1 = :blok1, blok2 = :blok2, blok3 = :blok3, blok4 = :blok4, blok5 = :blok5, blok6 = :blok6, blok7 = :blok7
                                    WHERE jadwalid = $id";
                                    $stmt = $db->prepare($sql);
        
                                    // bind parameter ke query
                                    $params = array(
                                        ":tanggal" => $tanggal,
                                        ":jam" => $jam,
                                        ":romo" => $romo,
                                        ":tema" => $tema,
                                        ":aktif" => $aktif,
                                        ":blok1" => $blok1,
                                        ":blok2" => $blok2,
                                        ":blok3" => $blok3,
                                        ":blok4" => $blok4,
                                        ":blok5" => $blok5,
                                        ":blok6" => $blok6,
                                        ":blok7" => $blok7);
        
                                    //eksekusi statement
                                    $saved = $stmt->execute($params);
        
                                    //hasil yang ditampilkan ketika selesai query
                                    
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
                        $q=mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM jadwal WHERE jadwalid='$id'"));
                      ?>
                            <div class="row">
                                <div class="form-group">
                                <div class="col-lg-12 ">
                                <label>Tanggal</label>
                                   <input type="text" name="tanggal" class="form-control" maxlength="100" value="<?php echo $q['tanggal']; ?>" placeholder="Tanggal" id="day">
                                      </div>
                                     
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="form-group">
                                <div class="col-lg-12 ">
                                <label>Jam</label>
                                   <input type="text" name="jam" class="form-control" maxlength="100" value="<?php echo $q['jam']; ?>" placeholder="Jam" id="datepicker">
                                      </div>
                                     
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="form-group">
                                <div class="col-lg-12 ">
                                <label>Romo</label>
                                   <input type="text" name="romo" class="form-control" maxlength="100" value="<?php echo $q['romo']; ?>" placeholder="Romo" id="romo">
                                      </div>
                                     
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="form-group">
                                <div class="col-lg-12 ">
                                <label>Tema</label>
                                   <input type="text" name="tema" class="form-control" maxlength="100" value="<?php echo $q['tema']; ?>" placeholder="Tema" id="tema">
                                      </div>
                                     
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="form-group">
                                <div class="col-lg-3">
                                <label>Status Pemesanan</label>
                                </div>
								<div class="col-lg-4">
								<label><input type="radio" name="aktif" value="1" <?php if($q['aktif']==1) echo 'checked';?> > Buka&nbsp;&nbsp;</label>
								<label><input type="radio" name="aktif" value="0" <?php if($q['aktif']==0) echo 'checked';?> > Tutup</label>
                                </div>
                                </div>
                            </div>
							<hr>
                            <br>
                            <div class="row">
                                <div class="form-group">
                                <div class="col-lg-3">
                                <label>BLOK ANTIOKHIA</label>
                                </div>
								<div class="col-lg-4">
								<label><input type="radio" name="blok1" value="1" <?php if($q['blok1']==1) echo 'checked';?> > Ya&nbsp;&nbsp;</label>
								<label><input type="radio" name="blok1" value="0" <?php if($q['blok1']==0) echo 'checked';?> > Tidak</label>
                                </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="form-group">
                                <div class="col-lg-3">
                                <label>BLOK EFESUS</label>
                                </div>
								<div class="col-lg-4">
								<label><input type="radio" name="blok2" value="1" <?php if($q['blok2']==1) echo 'checked';?> > Ya&nbsp;&nbsp;</label>
								<label><input type="radio" name="blok2" value="0" <?php if($q['blok2']==0) echo 'checked';?> > Tidak</label>
                                </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="form-group">
                                <div class="col-lg-3">
                                <label>BLOK EMAUS</label>
								</div>
								<div class="col-lg-4">
								<label><input type="radio" name="blok3" value="1" <?php if($q['blok3']==1) echo 'checked';?> > Ya&nbsp;&nbsp;</label>
								<label><input type="radio" name="blok3" value="0" <?php if($q['blok3']==0) echo 'checked';?> > Tidak</label>
                                </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="form-group">
                                <div class="col-lg-3">
                                <label>BLOK GALILEA</label>
								</div>
								<div class="col-lg-4">
								<label><input type="radio" name="blok4" value="1" <?php if($q['blok4']==1) echo 'checked';?> > Ya&nbsp;&nbsp;</label>
								<label><input type="radio" name="blok4" value="0" <?php if($q['blok4']==0) echo 'checked';?> > Tidak</label>
                                </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="form-group">
                                <div class="col-lg-3">
                                <label>BLOK TIBERIAS</label>
								</div>
								<div class="col-lg-4">
								<label><input type="radio" name="blok5" value="1" <?php if($q['blok5']==1) echo 'checked';?> > Ya&nbsp;&nbsp;</label>
								<label><input type="radio" name="blok5" value="0" <?php if($q['blok5']==0) echo 'checked';?> > Tidak</label>
                                </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="form-group">
                                <div class="col-lg-3">
                                <label>BLOK YERIKHO</label>
								</div>
								<div class="col-lg-4">
								<label><input type="radio" name="blok6" value="1" <?php if($q['blok6']==1) echo 'checked';?> > Ya&nbsp;&nbsp;</label>
								<label><input type="radio" name="blok6" value="0" <?php if($q['blok6']==0) echo 'checked';?> > Tidak</label>
                                </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="form-group">
                                <div class="col-lg-3">
                                <label>BLOK YUDEA</label>
								</div>
								<div class="col-lg-4">
								<label><input type="radio" name="blok7" value="1" <?php if($q['blok7']==1) echo 'checked';?> > Ya&nbsp;&nbsp;</label>
								<label><input type="radio" name="blok7" value="0" <?php if($q['blok7']==0) echo 'checked';?> > Tidak</label>
                                </div>
                                </div>
                            </div>
                            <br>

                           <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" name="b1" class="btn btn-success"><i class="fa fa-save"></i> Edit Jadwal</button>
                                    <a href="home.php?p=list-jadwal" class="btn btn-info"><i class="fa fa-table"></i> List Jadwal</a>
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
                                  
          format: 'HH:mm',
            sideBySide: true,
          widgetPositioning: {
              horizontal: 'right',
              vertical: 'bottom'
          }
          
        });
       
      });
    </script>
	<script type="text/javascript">
      $(function () {
        
        $('#day').datetimepicker({
                                  
          format: 'YYYY-MM-DD',
            sideBySide: true,
          widgetPositioning: {
              horizontal: 'right',
              vertical: 'bottom'
          }
          
        });
       
      });
    </script>