<?php
    include './../config/koneksi.php';
    include './../config/ubahHari.php';
    include "./../config/formatTanggal.php"; 

 $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);

 if(isset($_POST['b1'])){
    $id= filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
    $hadir=1;
    $confirmedby=$_SESSION['staff']['id'];
    
    $sql = "UPDATE pemesanan SET hadir = :hadir, confirmedby = :confirmedby
            WHERE passkey = '$id'";
    $stmt = $db->prepare($sql);
    
    // bind parameter ke query
    $params = array(
    ":hadir" => $hadir,
    ":confirmedby" => $confirmedby);

    //eksekusi statement
    $saved = $stmt->execute($params);
    
    echo '<div class="alert alert-success alert-dismissible fade in" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span></button>
          <strong>Success!</strong> Data berhasil diubah.
          </div>';
 }
 
 if(isset($_POST['b2'])){
     $id= filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
     header("location:./home.php?p=konfirmasi-tiket&id=".$id);
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
				font-size: 12px;
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
				font-size: 12px;
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
				</style><?php ob_start();?>
                <form class="example" action="" style="max-width:450px" method="POST">
				<input type="text" value="" placeholder="Cari.." name="id" id="id">
				<button type="submit" name="b2" class="btn btn-info"><i class="fa fa-search"></i> Cari</button>
				</form>
				<?php
                    $html2 = ob_get_contents();
                    ob_end_clean();
                    
                    if($id==""){
                        echo $html2;
                }else{
                    $sqla=mysqli_query($koneksi,"SELECT * FROM pemesanan WHERE passkey='$id' AND hadir=0");
                    $a=mysqli_fetch_array($sqla);
                    $cek=mysqli_num_rows($sqla);
                    
                    $jadwal=$a['jadwalid'];
                    $sqlb=mysqli_query($koneksi,"SELECT tanggal, DAYNAME(tanggal), jam, tema, romo FROM jadwal WHERE jadwalid=$jadwal");
                    $b=mysqli_fetch_array($sqlb);
                    
                    $blokid=$a['blokid'];
                    $sqlc=mysqli_query($koneksi,"SELECT * FROM blok WHERE blokid=$blokid");
                    $c=mysqli_fetch_array($sqlc);
                    
                    $userid=$a['userid'];
                    $sqld=mysqli_query($koneksi,"SELECT * FROM user WHERE userid=$userid");
                    $d=mysqli_fetch_array($sqld);
                    
                    $tempdir = "./../config/temp/".$b[0]."/";
                    $namaFile=$a['passkey'].".png";
                }
                
                ?>
					    <?php ob_start();?>
                        <form action="" method="post">
                            <style type='text/css'>
							h3{
							margin-bottom: 1px;
							margin-top: 1px;
							}
							p{
							margin-bottom: 1px;
							margin-top: 1px;
							}
							
							</style>
    							<body style='font-size: 12px;'>
                        		<img src='../assets/images/logo.png' alt='' width='200' height='50'/><br><br><br><br>
                        		
                        		<h3 style='text-align: center; font-size: 16px;'>BUKTI PEMESANAN TIKET</h3>
                        		<h3 style='text-align: center; font-size: 13px;'>GEREJA ST. ANTONIUS PADUA KOTABARU</h3>
                        		<p style='text-align: center;'>Jl. I Dewa Nyoman Oka 18 Yogyakarta 55224 / parantkotabaru@yahoo.co.id / Telp:0274-5891003</p>
                        		<br><br><br>
                        		<table>
                        			<tr>
                        			<th></th>
                        			<th></th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td width='100'></td>
                        			<th rowspan='9'><img src="<?php echo $tempdir.$namaFile; ?>" width='200'/></th>
                        			</tr>
                                    <tr>
                                        <th width='30'></th>
                                        <th width='100'>Kode Tiket</th>
                                        <td width='8'>:</td>
                                        <td><?php echo $a['passkey']; ?></td>
                                    </tr>
                        			<tr>
                                        <th width='30'></th>
                                        <th width='100'>Nama Pemesan</th>
                                        <td width='8'>:</td>
                                        <td><?php echo $d['nama']; ?></td>
                        				<td width='100'></td>
                                    </tr>
                        			<tr>
                                        <th width='30'></th>
                                        <th width='100'>Tanggal Misa</th>
                                        <td width='8'>:</td>
                                        <td><?php echo ubahHari($b[1]) . ', ' . tanggalOut($b[0]); ?></td>
                        				<td width='100'></td>
                                    </tr>
                        			<tr>
                                        <th width='30'></th>
                                        <th width='100'>Jam Misa</th>
                                        <td width='8'>:</td>
                                        <td><?php echo substr($b[2], 0, 5); ?></td>
                        				<td width='100'></td>
                                    </tr>
                        			<tr>
                                        <th width='30'></th>
                                        <th width='100'>Blok Kursi</th>
                                        <td width='8'>:</td>
                                        <td><?php echo $c['namablok']; ?></td>
                        				<td width='100'></td>
                                    </tr>
                        			<tr>
                                        <th width='30'></th>
                                        <th width='100'>Nomor Kursi</th>
                                        <td width='8'>:</td>
                                        <td><?php echo $a['nokursi']; ?></td>
                        				<td width='100'></td>
                                    </tr>
                        			<tr>
                                        <th width='30'></th>
                                        <th width='100'>Tema Misa</th>
                                        <td width='8'>:</td>
                                        <td><?php echo $b[3]; ?></td>
                        				<td width='100'></td>
                                    </tr>
                        			<tr>
                                        <th width='30'></th>
                                        <th width='100'>Pemimpin Misa</th>
                                        <td width='8'>:</td>
                                        <td><?php echo $b[4]; ?></td>
                        				<td width='100'></td>
                                    </tr>
                        		</table>
                        		<br><br><br>
                        		<i>* Harap menunjukkan Tiket ini kepada petugas berserta Kartu Identitas sesuai dengan nama yang tercantum pada tiket.</i>
                        		<p style='text-align: right; margin-top: 10px; margin-right: 9px;'><br><br>Yogyakarta, <?php echo date("d-m-Y (H:i:s)", strtotime($a['datecreated']));?></p>
                        		<p style='text-align: right; margin-top: 5px; margin-right: 9px;'><b>Gereja St. Antonius Kotabaru</b></p>
                        	</body>
							
							<br>
							<hr>
							<div class="col-md-9">
							    <input id="id" type="hidden" class="form-control" name="id" value="<?php echo $id; ?>">
        						<button class="btn btn-default btn-lg btn-info" data-loading-text="Loading..." name="b1" id="simpan" type="submit"><font color="white">Konfirmasi</font></button> 
        					</div>
                        </form>
                        
    <?php
    $html = ob_get_contents();
    ob_end_clean();
    
    if(empty($cek)){
        if($id!=""){
            $sqle=mysqli_query($koneksi,"SELECT * FROM pemesanan WHERE passkey='$id' AND hadir=1");
            $cek2=mysqli_num_rows($sqle);
            if(empty($cek2)){
            echo '<div class="alert alert-warning alert-dismissible fade in" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                  <strong>Error!</strong> Data tidak ditemukan.
                  </div>';
            } else{
            echo '<div class="alert alert-success alert-dismissible fade in" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                  <strong>Selamat!</strong> Data sudah dikonfirmasi.
                  </div>';
            }
            
        }
    } else{
        echo $html;
    }
    ?>
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
 