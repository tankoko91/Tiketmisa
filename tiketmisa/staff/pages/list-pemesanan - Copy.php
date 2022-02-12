<?php
 include './../config/koneksi.php';
 include './../config/ubahHari.php';
 $sql=mysqli_query($koneksi,"SELECT * FROM pemesanan");
 function fill_tanggal($koneksi)  
 {  
      $output = '';  
      $sql = "SELECT DISTINCT tanggal, DAYNAME(tanggal), day(tanggal), month(tanggal), year(tanggal) FROM jadwal";  
      $result = mysqli_query($koneksi, $sql);  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '<option value="'.$row[0].'">'.  ubahHari($row[1]) . ', ' . $row[2]. '-' .$row[3]. '-' .$row[4]. '</option>';  
      }  
      return $output;  
 }  
 function fill_jam()  
 {  
      $output .= '<option value="">- Pilih Jam Misa -</option>'; 

      return $output;  
 }
 
 if(isset($_POST['b1'])){
  
    $tanggal = filter_input(INPUT_POST, 'tanggal', FILTER_SANITIZE_STRING);
    $show_jam = filter_input(INPUT_POST, 'show_jam', FILTER_SANITIZE_STRING);
    $bk = filter_input(INPUT_POST, 'bk', FILTER_SANITIZE_STRING);   
    
    $jadwaldb=mysqli_query($koneksi,"SELECT *  FROM jadwal WHERE tanggal='$tanggal' AND jam='$show_jam'");
    $jadwalPilih=mysqli_fetch_array($jadwaldb);
    $jadwalPilihid=$jadwalPilih['jadwalid'];
    
	if($bk==""){    
        $sql=mysqli_query($koneksi,"SELECT * FROM pemesanan WHERE jadwalid='$jadwalPilihid'");
	}if($jadwalPilihid==""){
	    $sql=mysqli_query($koneksi,"SELECT * FROM pemesanan");
	} else {
	    $sql=mysqli_query($koneksi,"SELECT * FROM pemesanan WHERE jadwalid='$jadwalPilihid' AND blokid='$bk'");
	}
 }
?>
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Data Pemesanan
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"> Home</a></li>
            <li class="active">Pemesanan</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
    <!-- Main row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">   
                <div class="box-body">
				<div class="col-lg-8 col-md-8 col-sm-8">
                        <div class="dividerHeading">
                            <h4><span>Login</span></h4>
                        </div>
                        <?php
                            $id= filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);

                            if($id=='error'){
                                echo '<div class="alert alert-warning alert-dismissible fade in" role="alert">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">×</span></button>
                                      <strong>Error!</strong> Username atau Password salah.
                                      </div>';
                            }
                        ?>
                        <form id="contactForm" action="./login/login.php" method="post">
							<div class="row">
                                <div class="form-group">
                                  
                                    <div class="col-md-12">
                                        <input type="text" id="user" name="user" class="form-control" maxlength="50" data-msg-required="Silahkan isi email anda." value="" placeholder="Email">
                                    </div>
                                
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                  
                                     <div class="col-md-12">
                                        <input type="password" id="pass" name="pass" class="form-control" maxlength="20" data-msg-required="Silahkan konfirmasi password anda." value="" placeholder="Password">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9">
                                    <input type="submit" name="b1" data-loading-text="Loading..." class="btn btn-default btn-lg" value="Login">
									
                                </div>
                                <div class="col-md-3">
                                    <b><a href="index.php?p=lupa-password" class="lp" style="color:#555;">Lupa password ?</a></b>
                                </div>
                            </div>
                        </form>
                    </div>
							<!--
        					<form action="pages/proses_pesanan.php" method="post">
        					<div class="modal-body">
        					    <input type="hidden" id="jadwalid" name="jadwalid" value="' . $jadwalid . '">
        					    <input type="hidden" id="userid" name="userid" value="' . $userid . '">
        					    <input type="hidden" id="blokid" name="blokid" value="' . $blokid . '">
        					    <input type="hidden" id="nokursi" name="nokursi" value="">
        					    <input type="hidden" id="datecreated" name="datecreated" value="' . $timestamp . '">
        					    <input type="hidden" id="passkey" name="passkey" value="' . $passkey . '">
        					    
        					    <label>Rincian Misa</label>
        						<blockquote class="default">
        						Tanggal Misa :
        						<p class="rincian"><b>'
        						. ubahHari($jadwal[2]) . ', ' . tanggalOut($jadwal[0]) . '</b></p>
        						Jam Misa :
        						<p class="rincian"><b>' . substr($jadwal[1], 0, 5) . '</b></p>
        						Dipimpin oleh :
        						<p class="rincian"><b>' . $jadwal[3] . '</b></p>
        						Tema misa :
        						<p class="rincian"><b>' . $jadwal[4] . '</b></p>
        						
        						</blockquote>
        						<label>Rincian Kursi</label>
        						<blockquote class="default">
        						Blok Kursi :
        						<p class="rincian"><b>EFESUS (Sayap Luar)</b></p>
        						Nomor Kursi :
        						<b><p id="rincian-kursi" class="rincian-kursi"></p></b>
        						</blockquote>
        						<div class="modal-footer">
        							<button class="btn btn-default btn-lg btn-info" data-loading-text="Loading..." name="b1" id="simpan" type="submit"><font color="white">Konfirmasi</font></button> 
        						</div>
        					</div>
        					</form>
							-->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

            </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
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
        
        $('#datepicker1').datetimepicker({
                                  
          format: 'YYYY-MM-DD',
            sideBySide: true,
          widgetPositioning: {
              horizontal: 'right',
              vertical: 'bottom'
          }
          
        });
         
      });
    </script>
    
     <script>  
 $(document).ready(function(){  
      $('#tanggal').change(function(){  
           var tanggal = $(this).val();  
           $.ajax({  
                url:"./..//config/loadJam.php",  
                method:"POST",  
                data:{tanggal:tanggal},  
                success:function(data){  
                     $('#show_jam').html(data);  
                }  
           });  
      });  
 });  
 </script> 