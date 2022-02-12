 <?php
 include './config/koneksi.php';
 include './config/ubahHari.php';
 include './config/formatTanggal.php';
 
 
 function fill_tanggal($koneksi)  
 {  
      $output = '';  
      $sql = "SELECT DISTINCT tanggal, DAYNAME(tanggal) FROM jadwal WHERE aktif=1 ORDER BY tanggal DESC";  
      $result = mysqli_query($koneksi, $sql);  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '<option value="'.$row[0].'">'.  ubahHari($row[1]) . ', ' . tanggalOut($row[0]) . '</option>';  
      }  
      return $output;  
 }  
 function fill_jam()  
 {  
      $output .= '<option value="">- Pilih Jam Misa -</option>'; 
       
      return $output;  
 }
 function fill_blok()  
 {  
      $output .= '<option value="">- Pilih Blok Kursi -</option>'; 
       
      return $output;  
 }
 
 if(isset($_POST['b1'])){
  
    $jadwalid = filter_input(INPUT_POST, 'show_jam', FILTER_SANITIZE_STRING);
    $bk = filter_input(INPUT_POST, 'show_blok', FILTER_SANITIZE_STRING);   
    
	$blokdb=mysqli_query($koneksi,"SELECT *  FROM blok WHERE blokid='$bk'");
    $blokPilih=mysqli_fetch_array($blokdb);
    
    header("Location: http://segogaring.com/tiketmisa/index.php?p=" . strtolower($blokPilih['namablok']) . "&jadwalid=" . $jadwalid);
    
 }
 ?>   
 
 <section class="wrapper">
	<div class="slider-wrapper">
		<div class="slider">
			<div class="fs_loader"></div>
			<div class="slide">
            <img src="./assets/images/fraction-slider/base.jpg" width="1920" height="auto" data-in="fade" data-out="fade" />
            <img class="ftm" src="./assets/images/santo/santo1.png" width="300" height="auto" data-position="60,1200" data-in="bottomLeft" data-out="fade" style="width:auto; height:auto" data-delay="500">
            <p class="slide-heading" data-position="130,380" data-in="top"  data-out="left" data-ease-in="easeOutBounce" data-delay="700">Matius 7:7</p>
            <p class="sub-line" style="text-align:left" data-position="230,380" data-in="right" data-out="left" data-delay="1500">Mintalah, maka akan diberikan kepadamu; <br>carilah, maka kamu akan mendapat; <br> ketoklah, maka pintu akan dibukakan bagimu.  </p>
        </div>
        <div class="slide">
            <img src="./assets/images/fraction-slider/base.jpg" width="1920" height="auto" data-in="fade" data-out="fade" />
            <p class="slide-heading" data-position="130,380" data-in="right"  data-out="left" data-ease-in="jswing">Markus 5:36</p>
            <p class="sub-line" style="text-align:left"data-position="225,380" data-in="right" data-out="left"  data-delay="1500">Tetapi Yesus tidak menghiraukan perkataan <br>mereka dan berkata kepada kepala <br>rumah ibadat: <b>"Jangan takut, percaya saja".</b></p>
            <img class="ftm" src="./assets/images/santo/santo2.png" width="300" height="auto" data-position="50,1200" data-in="left" data-out="fade" style="width:auto; height:auto" data-delay="500">
        </div>
        <div class="slide">
            <img src="./assets/images/fraction-slider/base.jpg" width="1920" height="auto" data-in="fade" data-out="fade" />
            <img class="ftm" src="./assets/images/santo/santo1.png" width="300" height="auto" data-position="60,1200" data-in="bottomLeft" data-out="fade" style="width:auto; height:auto" data-delay="500">
            <p class="slide-heading" data-position="130,380" data-in="top"  data-out="left" data-ease-in="easeOutBounce" data-delay="700">Matius 7:7</p>
            <p class="sub-line" style="text-align:left" data-position="230,380" data-in="right" data-out="left" data-delay="1500">Mintalah, maka akan diberikan kepadamu; <br>carilah, maka kamu akan mendapat; <br> ketoklah, maka pintu akan dibukakan bagimu.  </p>
        </div>
        <div class="slide">
            <img src="./assets/images/fraction-slider/base.jpg" width="1920" height="auto" data-in="fade" data-out="fade" />
            <p class="slide-heading" data-position="130,380" data-in="right"  data-out="left" data-ease-in="jswing">Markus 5:36</p>
            <p class="sub-line" style="text-align:left"data-position="225,380" data-in="right" data-out="left"  data-delay="1500">Tetapi Yesus tidak menghiraukan perkataan <br>mereka dan berkata kepada kepala <br>rumah ibadat: <b>"Jangan takut, percaya saja".</b></p>
            <img class="ftm" src="./assets/images/santo/santo2.png" width="300" height="auto" data-position="50,1200" data-in="left" data-out="fade" style="width:auto; height:auto" data-delay="500">
        </div>
		</div>
	</div><!--End Slider-->
	<section class="content contact">
		<div class="container">
			<div class="row sub_content">
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="widget widget_tab">
						<div class="velocity-tab sidebar-tab">
							<ul class="nav nav-tabs">
								<li class="active">
									<a data-toggle="tab" href="#Popular">Pesan Tiket</a>
								</li>
							</ul>
							<div class="tab-content clearfix">
								<div class="tab-pane fade active in" id="Popular">
								<div class="col-md-12">
								<center><strong><a target="_blank" href="assets\files\denah_kursi_kobar.pdf">Lihat Denah Blok Gereja St. Antonius Padua Kota Baru</a></strong></center>
								</div>
								<br>
									<form action="" id="contactForm" method="post" name="contactForm">
										<div class="col-md-4">
											<div class="row">
												<div class="form-group">
													<div class="col-md-12">
														<label>Pilih Tanggal Misa</label>
														<div class="input-group" style="padding-bottom: 5px;">
															<div class="input-group-addon">
																<i class="fa fa-arrow-right"></i>
															</div>
															<select class="form-control" id="tanggal" name="tanggal">
																<option value="">
																	- Pilih Jadwal Misa -
																</option>
																<?php echo fill_tanggal($koneksi); ?>
															</select>
														</div><i>* Tanggal misa anda</i>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="row">
												<div class="form-group">
													<div class="col-md-12">
														<label>Pilih Jam Misa</label>
														<div class="input-group" style="padding-bottom: 5px;">
															<div class="input-group-addon">
																<i class="fa fa-arrow-right"></i>
															</div>
															<select class="form-control" id="show_jam" name="show_jam">
																<?php echo fill_jam();?>  
															</select>
														</div><i>* Jam misa anda</i>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="row">
												<div class="form-group">
													<div class="col-md-12">
														<label>Pilih Blok Kursi</label>
														<div class="input-group" style="padding-bottom: 5px;">
															<div class="input-group-addon">
																<i class="fa fa-arrow-right"></i>
															</div>
															<select class="form-control" id="show_blok" name="show_blok">
                                                                <?php echo fill_blok();?> 
															</select>
														</div><i>* Blok kursi anda</i>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-12">
											<div class="row">
												<div class="col-md-2">
													<a class="btn btn-default btn-lg btn-block" href="index.php"><i class="fa fa-arrow-left"></i> Kembali</a>
												</div>
												<div class="col-md-8"></div>
												<div class="col-md-2">
													<button name="b1" class="btn btn-default btn-lg btn-cari btn-block" data-loading-text="Loading..." type="submit"><i class="fa fa-search"></i> Cari Kursi</button>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--
			<div class="container">
				<div class="row super_sub_content">
					<div class="col-md-3 col-sm-3">
						<div class="serviceBox_2 green">
							<div class="service-icon">
								<i class="fa fa-users"></i>
							</div>
							<div class="service-content">
								<h3>Sopir</h3>
								<p>Sopir Yang berpengalaman.</p>
								<div class="read"></div>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-3">
						<div class="serviceBox_2 purple">
							<div class="service-icon">
								<i class="fa fa-car"></i>
							</div>
							<div class="service-content">
								<h3>Mobil</h3>
								<p>Mobil yang nyaman, model terbaru.</p>
								<div class="read"></div>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-3">
						<div class="serviceBox_2 red">
							<div class="service-icon">
								<i class="fa fa-arrow-right"></i>
							</div>
							<div class="service-content">
								<h3>Tujuan</h3>
								<p>Memiliki beberapa rute tujuan .</p>
								<div class="read"></div>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-3">
						<div class="serviceBox_2 blue">
							<div class="service-icon">
								<i class="fa fa-money"></i>
							</div>
							<div class="service-content">
								<h3>Harga</h3>
								<p>Harga yang bersahabat.</p>
								<div class="read"></div>
							</div>
						</div>
					</div>
				</div>
			</div><br>
			-->
			<br>
		</div>
	</section>
</section>
<script>  
 $(document).ready(function(){  
      $('#tanggal').change(function(){  
           var tanggal = $(this).val();  
           $.ajax({  
                url:"./config/loadJam.php",  
                method:"POST",  
                data:{tanggal:tanggal},  
                success:function(data){  
                     $('#show_jam').html(data);  
                }  
           });  
      });  
 });
 
 $(document).ready(function(){  
      $('#show_jam').change(function(){  
           var jadwalid = $(this).val();
           $.ajax({  
                url:"./config/loadJam.php",  
                method:"POST",  
                data:{jadwalid:jadwalid},  
                success:function(data){  
                     $('#show_blok').html(data);  
                }  
           });  
      });  
 });  
 </script> 