<!-- DIbuat oleh Nopen rianto
Tanggal 08-02-2018 -->

<?php 

include '../../config/koneksi.php';

$id=$_GET['id'];

 $sql1=mysqli_query($koneksi,"DELETE FROM tb_pesan WHERE kd_pesan='$id'");
 $sql2=mysqli_query($koneksi,"DELETE FROM tb_paket WHERE kd_pesan='$id'");
	
	if($sql2){
 echo '<script> alert("Data berhasil dihapus."); javascript:history.back(); </script>';
	}else{
echo '<script> alert("Data Gagal dihapus."); javascript:history.back(); </script>';	
	}

  

?>