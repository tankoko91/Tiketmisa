<?php 
    session_start();
    if($_SESSION['user']==""){
		$self = $_SERVER["REUQUEST_URI"];
		$_SESSION['url'] = $self;
        header("location:./index.php?p=login");
    } else {
?>
<?php ob_start();?>

<?php
    
    include './../config/koneksi.php';
    include './../config/ubahHari.php';
    include "./../config/phpqrcode/qrlib.php"; 
    include "./../config/formatTanggal.php"; 
    session_start();
    
    $id= filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
    $sql=mysqli_query($koneksi,"SELECT * FROM pemesanan WHERE pesananid=$id");
    $sessid=mysqli_fetch_array($sql);
    
 if($_SESSION['user']['userid']==$sessid['userid']){
     
    $sqla=mysqli_query($koneksi,"SELECT * FROM pemesanan WHERE pesananid=$id");
    $a=mysqli_fetch_array($sqla);
    
    $jadwal=$a['jadwalid'];
    $sqlb=mysqli_query($koneksi,"SELECT tanggal, DAYNAME(tanggal), jam, tema, romo FROM jadwal WHERE jadwalid=$jadwal");
    $b=mysqli_fetch_array($sqlb);
    
    $blokid=$a['blokid'];
    $sqlc=mysqli_query($koneksi,"SELECT * FROM blok WHERE blokid=$blokid");
    $c=mysqli_fetch_array($sqlc);
    
    $userid=$a['userid'];
    $sqld=mysqli_query($koneksi,"SELECT * FROM user WHERE userid=$userid");
    $d=mysqli_fetch_array($sqld);
    
    
    $tempdir = "./../config/temp/".$b[0]."/"; //Nama folder tempat menyimpan file qrcode
    if (!file_exists($tempdir)) //Buat folder bername temp
    mkdir($tempdir);

    //isi qrcode jika di scan
    $codeContents = "http://segogaring.com/tiketmisa/index.php?p=lihat-pesanan&id=".$a['passkey'];
    //nama file qrcode yang akan disimpan
    $namaFile=$a['passkey'].".png";
    //ECC Level
    $level=QR_ECLEVEL_H;
    //Ukuran pixel
    $UkuranPixel=10;
    //Ukuran frame
    $UkuranFrame=4;

    QRcode::png($codeContents, $tempdir.$namaFile, $level, $UkuranPixel, $UkuranFrame); 

}
 
  
?>


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
<?php
$html = ob_get_contents();
ob_end_clean();      
    require_once('html2pdf/html2pdf.class.php');
    $pdf = new HTML2PDF('P','A4','en');
    $pdf->WriteHTML($html);
    $pdf->Output('Bukti_pemesanan-'.$a['passkey'].'.pdf', 'D');
?>
                  


<?php 
	}
?>

