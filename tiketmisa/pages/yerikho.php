<?php
include './config/koneksi.php';
include './config/ubahHari.php';
include './config/getTimestamp.php';
include './config/acak.php';
include './config/formatTanggal.php';

session_start();

    $kursipakai = array();
    $jadwalid = filter_input(INPUT_GET, 'jadwalid', FILTER_SANITIZE_STRING);
    $userid = $_SESSION["user"]["userid"];
    $blokid = 6;
    $timestamp = getTimestamp();
    $passkey =  get_rand_letters(6);
    
    $jadwaldb=mysqli_query($koneksi,"SELECT tanggal, jam, DAYNAME(tanggal), romo, tema, aktif FROM jadwal WHERE jadwalid='$jadwalid' AND aktif=1");
    $jadwal=mysqli_fetch_array($jadwaldb);
    
    if ($jadwal[5]==1){
        $kursidb=mysqli_query($koneksi,"SELECT nokursi FROM pemesanan WHERE jadwalid=$jadwalid AND blokid=$blokid");
        while($row = mysqli_fetch_array($kursidb))  
              {  
                   array_push($kursipakai,$row[0]);  
                   
              }
    } else{
        for($row=1;$row<1000;$row++)  
          {  
               array_push($kursipakai,$row);  
               
          }
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
            <p class="sub-line" style="text-align:left" data-position="225,380" data-in="right" data-out="left"  data-delay="1500">Tetapi Yesus tidak menghiraukan perkataan <br>mereka dan berkata kepada kepala <br>rumah ibadat: <b>"Jangan takut, percaya saja".</b></p>
            <img class="ftm" src="./assets/images/santo/santo2.png" width="300" height="auto" data-position="50,1200" data-in="left" data-out="fade" style="width:auto; height:auto" data-delay="500">
        </div>
    </div>
	</div>
	<!--End Slider-->
	<section class="content contact">
		<link href="./assets/css/style.css" rel="stylesheet">
		<div class="container">
			<div class="row sub_content">
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="widget widget_tab">
						<div class="velocity-tab sidebar-tab">
							<ul class="nav nav-tabs">
								<li class="active">
									<a data-toggle="tab" href="#Popular">Pilih Kursi</a>
								</li>
							</ul>
							<div class="tab-content clearfix">
								<div class="tab-pane fade active in" id="Popular">
										<div class="col-md-12">
											<div class="penumpang">
												<div class="row">
													<div class="col-md-12">
													<div class="col-md-5">
														<blockquote class="default">
														Tanggal Misa :
														<p class="rincian"><b><?php echo ubahHari($jadwal[2]) . ", " . tanggalOut($jadwal[0]); ?></b></p>
														Jam Misa :
														<p class="rincian"><b><?php echo substr($jadwal[1], 0, 5); ?></b></p>
														Blok Kursi :
														<p class="rincian"><b>YERIKHO (Halaman Utara)</b></p>
														</blockquote>
														
													</div>
													<div class="col-md-6">
														<center><img src="assets/images/denah/yerikho.png" width="80%"><br>
														<i>* Lihat denah lengkapnya <strong><a href="assets/files/denah_kursi_kobar.pdf" target="_blank">DISINI</a></strong></i></center>
														<br>
														<table>
															<tr style="font-size:12px"><td style="color:green">Warna hijau masih kosong</td></tr>
															<tr style="font-size:12px"><td style="color:red">Warna merah sudah terpesan</td></tr>
														</table>
														<br><br>
													</div>
													</div>
													
													<div class="col-md-2">
													</div>
													<div class="col-md-8">
														<table class="table table-responsive-sm table-sm mb-0 no-border" width="100%">
															<tbody>
																<tr>
																	<td></td>
																	<td></td>
																	<?php
																    for($x = 523; $x <= 526; $x++) {
                                                                      echo '<td>';
                                                                          if (in_array($x,$kursipakai))
                                                                            {
                                                                                
                                                                            } else{
                                                                            echo '<a href="#modal-kursi" data-toggle="modal" data-target="#modal-kursi" id="0">';
                                                                            }
                                                                        echo '<button id="kursi" class="';
                                                                        if (in_array($x,$kursipakai))
                                                                        {
                                                                            echo 'btn btn-danger btn-xs disabled';
                                                                        } else{
                                                                        echo 'btn btn-success btn-xs';
                                                                            
                                                                        }
                                                                        echo '" value="' . $x . '" onclick="myFunction(' . $x . ')">' . $x . '</button>';
                                                                        if (in_array($x,$kursipakai)){
                                                                            
                                                                        } else{
                                                                        echo '</a>';
                                                                        }
																	    echo '</td>';
                                                                    }?>
																</tr>
																<tr>
																	<td></td>
																	<?php
																    for($x = 532; $x <= 536; $x++) {
                                                                      echo '<td>';
                                                                          if (in_array($x,$kursipakai))
                                                                            {
                                                                                
                                                                            } else{
                                                                            echo '<a href="#modal-kursi" data-toggle="modal" data-target="#modal-kursi" id="0">';
                                                                            }
                                                                        echo '<button id="kursi" class="';
                                                                        if (in_array($x,$kursipakai))
                                                                        {
                                                                            echo 'btn btn-danger btn-xs disabled';
                                                                        } else{
                                                                        echo 'btn btn-success btn-xs';
                                                                            
                                                                        }
                                                                        echo '" value="' . $x . '" onclick="myFunction(' . $x . ')">' . $x . '</button>';
                                                                        if (in_array($x,$kursipakai)){
                                                                            
                                                                        } else{
                                                                        echo '</a>';
                                                                        }
																	    echo '</td>';
                                                                    }?>
																</tr>
																<tr>
																	<?php
																    for($x = 541; $x <= 546; $x++) {
                                                                      echo '<td>';
                                                                          if (in_array($x,$kursipakai))
                                                                            {
                                                                                
                                                                            } else{
                                                                            echo '<a href="#modal-kursi" data-toggle="modal" data-target="#modal-kursi" id="0">';
                                                                            }
                                                                        echo '<button id="kursi" class="';
                                                                        if (in_array($x,$kursipakai))
                                                                        {
                                                                            echo 'btn btn-danger btn-xs disabled';
                                                                        } else{
                                                                        echo 'btn btn-success btn-xs';
                                                                            
                                                                        }
                                                                        echo '" value="' . $x . '" onclick="myFunction(' . $x . ')">' . $x . '</button>';
                                                                        if (in_array($x,$kursipakai)){
                                                                            
                                                                        } else{
                                                                        echo '</a>';
                                                                        }
																	    echo '</td>';
                                                                    }?>
																</tr>
																<tr>
																	<?php
																    for($x = 551; $x <= 556; $x++) {
                                                                      echo '<td>';
                                                                          if (in_array($x,$kursipakai))
                                                                            {
                                                                                
                                                                            } else{
                                                                            echo '<a href="#modal-kursi" data-toggle="modal" data-target="#modal-kursi" id="0">';
                                                                            }
                                                                        echo '<button id="kursi" class="';
                                                                        if (in_array($x,$kursipakai))
                                                                        {
                                                                            echo 'btn btn-danger btn-xs disabled';
                                                                        } else{
                                                                        echo 'btn btn-success btn-xs';
                                                                            
                                                                        }
                                                                        echo '" value="' . $x . '" onclick="myFunction(' . $x . ')">' . $x . '</button>';
                                                                        if (in_array($x,$kursipakai)){
                                                                            
                                                                        } else{
                                                                        echo '</a>';
                                                                        }
																	    echo '</td>';
                                                                    }?>
																</tr>
																<tr>
																	<?php
																    for($x = 561; $x <= 566; $x++) {
                                                                      echo '<td>';
                                                                          if (in_array($x,$kursipakai))
                                                                            {
                                                                                
                                                                            } else{
                                                                            echo '<a href="#modal-kursi" data-toggle="modal" data-target="#modal-kursi" id="0">';
                                                                            }
                                                                        echo '<button id="kursi" class="';
                                                                        if (in_array($x,$kursipakai))
                                                                        {
                                                                            echo 'btn btn-danger btn-xs disabled';
                                                                        } else{
                                                                        echo 'btn btn-success btn-xs';
                                                                            
                                                                        }
                                                                        echo '" value="' . $x . '" onclick="myFunction(' . $x . ')">' . $x . '</button>';
                                                                        if (in_array($x,$kursipakai)){
                                                                            
                                                                        } else{
                                                                        echo '</a>';
                                                                        }
																	    echo '</td>';
                                                                    }?>
																</tr>
																<tr>
																	<?php
																    for($x = 571; $x <= 576; $x++) {
                                                                      echo '<td>';
                                                                          if (in_array($x,$kursipakai))
                                                                            {
                                                                                
                                                                            } else{
                                                                            echo '<a href="#modal-kursi" data-toggle="modal" data-target="#modal-kursi" id="0">';
                                                                            }
                                                                        echo '<button id="kursi" class="';
                                                                        if (in_array($x,$kursipakai))
                                                                        {
                                                                            echo 'btn btn-danger btn-xs disabled';
                                                                        } else{
                                                                        echo 'btn btn-success btn-xs';
                                                                            
                                                                        }
                                                                        echo '" value="' . $x . '" onclick="myFunction(' . $x . ')">' . $x . '</button>';
                                                                        if (in_array($x,$kursipakai)){
                                                                            
                                                                        } else{
                                                                        echo '</a>';
                                                                        }
																	    echo '</td>';
                                                                    }?>
																</tr>
																<tr>
																	<?php
																    for($x = 581; $x <= 586; $x++) {
                                                                      echo '<td>';
                                                                          if (in_array($x,$kursipakai))
                                                                            {
                                                                                
                                                                            } else{
                                                                            echo '<a href="#modal-kursi" data-toggle="modal" data-target="#modal-kursi" id="0">';
                                                                            }
                                                                        echo '<button id="kursi" class="';
                                                                        if (in_array($x,$kursipakai))
                                                                        {
                                                                            echo 'btn btn-danger btn-xs disabled';
                                                                        } else{
                                                                        echo 'btn btn-success btn-xs';
                                                                            
                                                                        }
                                                                        echo '" value="' . $x . '" onclick="myFunction(' . $x . ')">' . $x . '</button>';
                                                                        if (in_array($x,$kursipakai)){
                                                                            
                                                                        } else{
                                                                        echo '</a>';
                                                                        }
																	    echo '</td>';
                                                                    }?>
																</tr>
																<tr>
																	<?php
																    for($x = 591; $x <= 593; $x++) {
                                                                      echo '<td>';
                                                                          if (in_array($x,$kursipakai))
                                                                            {
                                                                                
                                                                            } else{
                                                                            echo '<a href="#modal-kursi" data-toggle="modal" data-target="#modal-kursi" id="0">';
                                                                            }
                                                                        echo '<button id="kursi" class="';
                                                                        if (in_array($x,$kursipakai))
                                                                        {
                                                                            echo 'btn btn-danger btn-xs disabled';
                                                                        } else{
                                                                        echo 'btn btn-success btn-xs';
                                                                            
                                                                        }
                                                                        echo '" value="' . $x . '" onclick="myFunction(' . $x . ')">' . $x . '</button>';
                                                                        if (in_array($x,$kursipakai)){
                                                                            
                                                                        } else{
                                                                        echo '</a>';
                                                                        }
																	    echo '</td>';
                                                                    }?>
																	<td></td>
																	<td></td>
																	<td></td>
																</tr>
															</tbody>
														</table>
													</div>
													<div class="col-md-2">
													</div>
												</div>
											</div>
										</div><br>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div aria-labelledby="myModalLabel" class="modal fade" id="modal-kursi" role="dialog" tabindex="-1">
        			<div class="modal-dialog" role="document">
        				<div class="modal-content modal-login">
        					
        					<?php if($_SESSION['user']==""){
        					    
        					$self = $_SERVER["REQUEST_URI"];
                            $_SESSION['url'] = $self;
                            
        					    echo '
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel" style="color: #1ABC9C;">Login</h4>
                            </div>
                            <form action="login/login.php" method="post">
                            <div class="modal-body">
                            
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="text" name="user" class="form-control" id="exampleInputEmail1" placeholder="Email">
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" name="pass" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                  </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-default btn-lg btn-login" id="login" data-loading-text="Loading...">Login</button>
                                <a href="index.php?p=lupa-password" class="lp" style="color:#555;">Lupa password ?</a>
                                  
                            </div> 
                            </form>';
        					}
                            else{
                                echo '<div class="modal-header">
        						<h4 class="modal-title" id="myModalLabel" style="color: #1ABC9C;">Detail Pemesanan</h4>
        					</div>
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
        						<p class="rincian"><b>YERIKHO (Halaman Utara)</b></p>
        						Nomor Kursi :
        						<b><p id="rincian-kursi" class="rincian-kursi"></p></b>
        						</blockquote>
        						<div class="modal-footer">
        							<button class="btn btn-danger btn-lg btn-danger" data-dismiss="modal" type="button">Kembali</button> 
        							<button class="btn btn-default btn-lg btn-login" data-loading-text="Loading..." name="b1" id="simpan" type="submit">Konfirmasi</button> 
        						</div>
        					</div>
        					</form>';
                            }
        					?>
        				</div>
        			</div>
        		</div>
		</div>
		<script>
		 $(document).ready(function(){
		         // paket sesuai yang diambil dari name pada input
		     $("input[name='kursi']").change(function() {
		         // variable untuk jumlah limit sesuaikan saja dengan keinginan 
		                     var maxpil = 1;
		                     // variable untuk jumlah data yang dipilih atau di checklist 
		         // jika melebihi dari variable limit maka akan diberikan warning
		                     var jml = $("input[name='kursi']:checked").length;
		         if(jml > maxpil){
		             $(this).prop("checked","");
		         alert('Anda dapat memilih maksimal '+ maxpil +' kursi');
		     }
		     });
		 });
		</script> 
		<script>
		 function checkbox(){
		 
		 var checkboxes = document.getElementsByName('kursi');
		 var checkboxesChecked = [];
		 // loop over them all
		 for (var i=0; i<checkboxes.length; i++) {
		     // And stick the checked ones onto an array...
		     if (checkboxes[i].checked) {
		         checkboxesChecked.push(checkboxes[i].value);
		     }
		 }
		 document.getElementById("show").value = checkboxesChecked;
		 
		 }
		</script>
		<script>
		function myFunction(key) {
		document.getElementById("rincian-kursi").innerHTML = key;
		document.getElementById("nokursi").value=key;
		}
		</script>
		
	</section>
</section>