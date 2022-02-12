<!-- DIbuat oleh Nopen rianto
Tanggal 08-02-2018 -->

<?php 

include '../../config/koneksi.php';

$id= filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);

 $sql=mysqli_query($koneksi,"DELETE FROM tb_jadwal WHERE kd_jadwal='$id'");
	
	if($sql){
 echo '<script> alert("Data berhasil dihapus."); javascript:history.back(); </script>';
	}else{
echo '<script> alert("Data Gagal dihapus."); javascript:history.back(); </script>';	
	}

  

?>