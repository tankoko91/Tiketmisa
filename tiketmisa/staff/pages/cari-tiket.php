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
				<div class="col-md-12">
				<style>
				form.example input[type=text] {
				padding: 10px;
				font-size: 17px;
				border: 1px solid grey;
				float: left;
				width: 80%;
				background: #f1f1f1;
				}
				
				form.example button {
				float: left;
				width: 20%;
				padding: 10px;
				background: #2196F3;
				color: white;
				font-size: 17px;
				border: 1px solid grey;
				border-left: none;
				cursor: pointer;
				}
				
				form.example button:hover {
				background: #0b7dda;
				}
				
				form.example::after {
				content: "";
				clear: both;
				display: table;
				}
				</style>
                <form class="example" action="/action_page.php" style="max-width:450px">
				<input type="text" placeholder="Cari.." name="search2">
				<button type="submit" name="b1" class="btn btn-info"><i class="fa fa-search"></i> Cari</button>
				</form>
				<br><hr>
                </div>
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