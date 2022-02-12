<?php 
                            include '../config/koneksi.php';

                         
                         session_start();

                            if(!empty($_SESSION['us'])){
                               $cekpesan1=mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM tb_pesan where kd_member='$_SESSION[us]' and status='Pending'"));

                               $cekpesan2=mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM tb_pesan where kd_member='$_SESSION[us]' and status='Pengecekan'"));
                            }

                         if($_SESSION['us']==""){
                          echo "
                             <script>
                             alert('Anda Harus Login terlebih dahulu.!');
                             javascript:history.back();
                             </script>
                             ";
                              }else if($cekpesan1 > 0){
                              echo "
                             <script>
                             alert('Anda memiliki pemesanan yang menunggu pembayaran, silahkan selesaikan terlebih dahulu.!');
                             javascript:history.back();
                             </script>
                             ";
                              }else if($cekpesan2 > 0){
                              echo "
                             <script>
                             alert('Anda memiliki pemesanan yang sedang pengecekan, silahkan tunggu terlebih dahulu.!');
                             javascript:history.back();
                             </script>
                             ";
                              
                            }else{
      
                                  $auto=rand(1111,9999);
                                  $idp="KD-P".$auto;

                                  $tglb=date('Y-m-d',strtotime($_GET['tgl']));
                                  $idu=$_SESSION['us'];
                                
                                  $idpk="KD-PK".rand(111,999);
                                  $nmn=$_GET['nmn'];
                                  $nmp=$_GET['nmp'];
                                  $nmpk=$_GET['nmpk'];
                                  $almj=$_GET['almj'];
                                  $alma=$_GET['alma'];
                                  $telp=$_GET['telp'];

                                   $kj=$_GET['kj'];
                                   $kt=$_GET['tj'];
                                    date_default_timezone_set("Asia/Jakarta");
                                  
                                  $tglp=date('Y-m-d H:i:s');

                                  $bts=date('Y-m-d H:i:s',strtotime('+2 Hours',strtotime($tglp)));

                                  $kode=rand(0,999);
                                 

                            
                                $sql=mysqli_query($koneksi,"INSERT INTO `tb_pesan`(`kd_pesan`, `kd_member`, `tgl_berangkat`, `kd_tujuan`, `kd_jadwal`, `status`, `batas_waktu`, `kode`, `jenis`, `tgl_pesan`) VALUES ('$idp','$idu','$tglb','$kt','$kj','pending','$bts','$kode','Paket','$tglp')");

                                $sql2=mysqli_query($koneksi,"INSERT INTO `tb_paket`(`kd_paket`, `kd_pesan`, `nm_paket`, `nm_pengirim`, `nm_penerima`, `alm_jemput`, `alm_antar`, `telp`) VALUES ('$idpk','$idp','$nmpk','$nmn','$nmp','$almj','$alma','$telp')");
                          
                                 
                         echo "
                             <script>
                             alert('Anda berhasil memesan pengiriman paket, silahkan lakukan pembayaran sesuai dengan total bayar.!');
                           
                             </script>
                             ";

                            echo "<meta http-equiv=refresh content=0;url=index.php?p=pesanan-saya>";
                          
                          
                          }
                                
                            
                             
                            ?>