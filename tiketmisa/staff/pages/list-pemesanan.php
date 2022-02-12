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
                <div class="box-header">
                  <h3 class="box-title">Data Pemesanan</h3>  
                </div><!-- /.box-header -->
                    
                <div class="box-body">
                 <div class="table-responsive">     
                  <table id="example1" class="table table-bordered table-striped">
                      
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>User ID</th>
                        <th>Tanggal</th>
                        <th>Blok ID</th>
                        <th>Nomor Kursi</th>
                        <th>Passkey</th>
                        <th>Status Kehadiran</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                       <?php
                       include './config/koneksi.php';
                       include './config/ubahHari.php';
                       include './../config/formatTanggal.php';
                      $no=0;
                    
                      while($q=mysqli_fetch_array($sql)){
                        $no++;

                     ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php $userid = $q['userid'];
                            $sqluser=mysqli_query($koneksi,"SELECT * FROM user WHERE userid=$userid");
                            $hasil=mysqli_fetch_array($sqluser);
                            echo $hasil['nama']; ?></td>
                        <td><?php $jadwal = $q['jadwalid'];
                            $sqljadwal=mysqli_query($koneksi,"SELECT tanggal, DAYNAME(tanggal) FROM jadwal WHERE jadwalid=$jadwal");
                            $hasil=mysqli_fetch_array($sqljadwal);
                            echo ubahHari($hasil[1]) . ', ' . tanggalOut($hasil[0]); ?></td>
                        <td><?php $blok = $q['blokid'];
                            $sqlblok=mysqli_query($koneksi,"SELECT * FROM blok WHERE blokid=$blok");
                            $hasil=mysqli_fetch_array($sqlblok);
                            echo $hasil['namablok']; ?></td>
                        <td><?php echo $q['nokursi']; ?></td>
                        <td><?php echo $q['passkey']; ?></td>
                        <td><?php if($q['hadir']==0){
                            echo 'Tidak';
                        } else {
                            echo 'Hadir';
                        } ?></td>
                         <td>
						 <!--
                          <a href="home.php?p=edit-pesanan&id=<?php echo $q['kd_jadwal']; ?>" class="btn btn-success"><i class="fa fa-pencil"></i></a>
						  -->
                          <a href="./pages/delete-pesanan.php?id=<?php echo $q['kd_jadwal']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr>

                  <?php } ?>
                    </tbody>
                   </table>
                </div>
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