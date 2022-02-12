<?php 
    session_start();
    if($_SESSION['user']['hak']!="user"){
		$self = $_SERVER["REUQUEST_URI"];
		$_SESSION['url'] = $self;
        header("location:./index.php?p=login");
    } else {
?>

<?php

 include './config/koneksi.php';
 include './config/ubahHari.php';
 include './config/formatTanggal.php';
 
 $id=$_SESSION['user']['userid'];
 
 $sqlq=mysqli_query($koneksi,"SELECT * FROM pemesanan WHERE userid='$id' ORDER BY datecreated DESC");
 $n=mysqli_num_rows($sqlq);
?>

 <!--start wrapper-->
	<section class="wrapper">
		<section class="page_head">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<div class="page_title">
							<h2>Riwayat Pemesanan</h2>
						</div>
						<nav id="breadcrumbs">
							<ul>
								<li>You are here:</li>
								<li>
									<a href="index.php">Home</a>
								</li>
								<li>Pesan saya</li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</section>
		<section class="content contact">
			<div class="container">
				<div class="row sub_content">
					<div class="eve-tab sidebar-tab">
						<ul class="nav nav-tabs" id="myTab">
							<li class="active">
								<a data-toggle="tab" href="#Pesanan">Riwayat Pemesanan</a>
							</li>
						</ul>
						<div class="tab-content clearfix" id="myTabContent">
							<div class="tab-pane active in" id="Pesanan">
								<div class="table-responsive">
									<table class="table table-hover" id="example1">
										<thead>
											<tr>
												<th>No</th>
												<th>Tanggal Misa</th>
												<th>Jam Misa</th>
												<th>Blok Kursi</th>
												<th>Nomor Kursi</th>
												<th>Cetak</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$no=0;
						                    if($n=="0"){
						                       echo'<tr>
						                        <td colspan="8"><br>Anda tidak memiliki histori pemesanan. <br></td></tr>';
						                    }
						                    
											while($q=mysqli_fetch_array($sqlq)){
											    $jadwal=$q['jadwalid'];
											    $sqlr=mysqli_query($koneksi,"SELECT tanggal, DAYNAME(tanggal), jam FROM jadwal WHERE jadwalid=$jadwal");
											    $r=mysqli_fetch_array($sqlr);
											    $blokid=$q['blokid'];
											    $sqls=mysqli_query($koneksi,"SELECT * FROM blok WHERE blokid=$blokid");
											    $s=mysqli_fetch_array($sqls);
                                            ?>
                                            
											<tr>
												<td>
												<br>
												<?php echo ++$no; ?>
												<br>
												</td>
												<td>
												<br>
												<?php echo ubahHari($r[1]) . ', ' . tanggalOut($r[0]); ?>
												<br>
												</td>
												<td>
												<br>
												<?php echo substr($r[2], 0, 5); ?>
												<p></p>
												</td>
												<td>
												<br>
												<?php echo $s['namablok']; ?>
												<br>
												</td>
												<td><br>
												<?php echo $q['nokursi']; ?>
												</td>
												<td>
													<br>
													<a class="btn btn-warning btn-sm" href="pages/cetak-pesanan.php?id=<?php echo $q['pesananid']?>"><i class="fa fa-print"></i></a><br>
												</td>
											</tr><?php } ?>
											<tr></tr>
										</tbody>
										<tbody></tbody>
									</table>
								</div>
							</div>
						</div><br>
					</div>
				</div>
			</div>
		</section>
	</section><!--end wrapper-->
    <!--end wrapper-->
<?php
}
?>    