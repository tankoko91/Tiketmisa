<!--start wrapper-->
<section class="wrapper">
<div class="slider-wrapper">
    <div class="slider">
        <div class="fs_loader"></div>
        <div class="slide">

            <img src="./assets/images/fraction-slider/base.jpg" width="1920" height="auto" data-in="fade" data-out="fade" />

            <img class="ftm" src="./assets/images/kapal/kapal1.jpg" width="500" height="390" data-position="60,1200" data-in="bottomLeft" data-out="fade" style="width:auto; height:auto" data-delay="500">

            <p class="slide-heading" data-position="130,380" data-in="top"  data-out="left" data-ease-in="easeOutBounce" data-delay="700">Keselamatan</p>

            <p class="sub-line" data-position="230,380" data-in="right" data-out="left" data-delay="1500">Kami selalu mengutamakan keselamatan pelanggan kami  </p>

            <p class="sub-line" data-position="330,380" data-in="bottom" data-out="bottom" data-delay="2000">Tanpa terkecuali</p>
        </div>

        <div class="slide">
            <img src="./assets/images/fraction-slider/base_2.jpg" width="1920" height="auto" data-in="fade" data-out="fade" />

            <p class="slide-heading" data-position="130,380" data-in="right"  data-out="left" data-ease-in="jswing">Kenyamanan</p>

            <p class="sub-line" data-position="225,380" data-in="right" data-out="left"  data-delay="1500">Kami akan selalu berusaha membuat pelanggan kami nyaman</p>

            <img class="ftm" src="./assets/images/kapal/kapal2.jpg" width="500" height="400" data-position="50,1200" data-in="left" data-out="fade" style="width:auto; height:auto" data-delay="500">

            <p class="sub-line" data-position="320,380" data-in="bottom" data-out="bottom" data-delay="2000">Bersama Kami</p>
        </div>

    </div>
</div>
<!--End Slider-->
  <section class="content contact">
            <div class="container">
                <div class="row sub_content">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      
          <div class="widget widget_tab">
                                <div class="velocity-tab sidebar-tab">
                                    <ul  class="nav nav-tabs">
                                        <li class="active"><a href="#Popular" data-toggle="tab">Pilih Keberangkatan</a></li>
                                    </ul>

                                    <div  class="tab-content clearfix">
                                        <div class="tab-pane fade active in" id="Popular">
                                          <div class="table-responsive">
                                             <table id="example1" class="table table-hover">
                      
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Tujuan</th>
                        <th>jam Berangkat</th>
                        <th>Sisa</th>
                        <th>Harga Tiket</th>
                        <th></th>
                      </tr>
                    </thead>
                   
                    <tbody>
                     <?php
                    include '../../config/koneksi.php';

                    $tj=$_GET['tanggal'];

                    $tt=$_GET['jam'];
                    
                    $jml=$_GET['bk'];

                    if(empty($tj) or empty($tt) or empty($jml)){

                           echo "
                             <script>
                             alert('Kategori pencarian tiket masih belum lengkap.!');
                             javascript:history.back();
                             </script>
                             ";
                    }else{

                      $no=0;

             
                      $tujuan=mysqli_query($koneksi,"SELECT *  FROM tb_tujuan WHERE kd_tujuan='$tj'");
                      $b=mysqli_fetch_array($tujuan);

                      date_default_timezone_set("Asia/Jakarta");
                      $tgls=date('Y-m-d');
                      $jams=date('H:i:s');

                    $sql=mysqli_query($koneksi,"SELECT * FROM tb_jadwal");
                    $cjd=mysqli_num_rows($sql);
                    

                    if( $cjd > 0){
                        echo'<tr><b style="padding-left:100px; font-size:15px;color: rgb(26, 188, 156);border-right: 2px solid rgb(164, 162, 162);padding-right:10px;"> '.$b['dari'].' <i class="fa fa-arrow-right"></i> '.$b['tujuan'].'</b></tr>';
                      echo'<tr><b style="padding-left:10px; font-size:15px;color: rgb(231, 172, 32);"> <i class="fa fa-calendar"></i> '.date('d F Y',strtotime($tt)).'</h2></tr>';
                      echo'<hr>';
                      while($q=inmysqli_fetch_array($sql)){
                        $no++;

                       $cpesan=mysqli_query($koneksi,"SELECT * FROM tb_pesan where tgl_berangkat='$tb' and kd_tujuan='$tj' and kd_jadwal='$q[kd_jadwal]'");
                      $jpesan=mysqli_num_rows($cpesan);
                    $jmpe=6-$jpesan;

                    $jpo=$jmpe-$_GET['jpp'];

                      echo'<tr>
                        <td><br>'.$no.'<br></td>
                        <td><br>'.$b['dari'] .' - '. $b['tujuan'].'<br></td>
                        <td><br>'.date('H:i',strtotime($q['jadwal'])).'<br></td>
                        <th><br>'.$jmpe.' Tiket<br></th>
                        <td><br><b>Rp '.number_format($b['harga_tiket'],0,".",".").'</b> <br></td>';

                        if($tgls >= $tb and $jams > $q['jadwal'] ){

                          echo '<td><br><a href="#" class="btn btn-info pesan" disabled><i class="fa fa-ticket"></i> Pesan Tiket</a></td>';

                        }elseif($jmpe <= 0){

                            echo '<td><br><a href="#" class="btn btn-info pesan" disabled><i class="fa fa-ticket"></i> Pesan Tiket</a></td>';

                        }elseif($jpo < 0){

                            echo '<td><br><a href="#" class="btn btn-info pesan" disabled><i class="fa fa-ticket"></i> Pesan Tiket</a></td>';

                        }
                        else{

                        echo'<td><br><a href="index.php?p=formulir-pesan&tj='.$tj.'&tb='.$tb.'&jpp='.$_GET['jpp'].'&kj='.$q['kd_jadwal'].'" class="btn btn-success pesan"><i class="fa fa-ticket"></i> Pesan Tiket</a><br></td>';
                        }
                        echo"</td></tr>";
                      }

                    }else{
                 
                      echo'<tr>
                        <td colspan="8"><br><b> <i class="fa fa-info-circle"></i>  Untuk tanggal yang anda cari tiket sudah tak tersedia lagi, silahkan pilih tanggal lain.</b><br></td></tr>';
                      }
                    }
                     ?>
                     <tbody>
                    
                  </table>
                </div>
                  <a href="index.php?p=tiket" class="btn btn-default btn-lg"><i class="fa fa-arrow-left"></i> Kembali</a>
                                        </div>
                                   
                                    </div>
                                </div>
                            </div>
                    </div>
               </div>
          </div>
 </section>