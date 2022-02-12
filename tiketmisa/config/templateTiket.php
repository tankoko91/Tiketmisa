
<?php
function buatTiket($qrcode, $passkey, $nama, $hariMisa, $tanggalMisa, $jamMisa, $blok, $kursi, $tema, $romo, $tanggalPesan){
    ob_start();
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
			<th rowspan='9'><img src="<?php echo $qrcode; ?>" width='200'/></th>
			</tr>
            <tr>
                <th width='30'></th>
                <th width='100'>Kode Tiket</th>
                <td width='8'>:</td>
                <td><?php echo $passkey; ?></td>
            </tr>
			<tr>
                <th width='30'></th>
                <th width='100'>Nama Pemesan</th>
                <td width='8'>:</td>
                <td><?php echo $nama; ?></td>
				<td width='100'></td>
            </tr>
			<tr>
                <th width='30'></th>
                <th width='100'>Tanggal Misa</th>
                <td width='8'>:</td>
                <td><?php echo $hariMisa . ', ' . $tanggalMisa; ?></td>
				<td width='100'></td>
            </tr>
			<tr>
                <th width='30'></th>
                <th width='100'>Jam Misa</th>
                <td width='8'>:</td>
                <td><?php echo $jamMisa; ?></td>
				<td width='100'></td>
            </tr>
			<tr>
                <th width='30'></th>
                <th width='100'>Blok Kursi</th>
                <td width='8'>:</td>
                <td><?php echo $blok; ?></td>
				<td width='100'></td>
            </tr>
			<tr>
                <th width='30'></th>
                <th width='100'>Nomor Kursi</th>
                <td width='8'>:</td>
                <td><?php echo $kursi; ?></td>
				<td width='100'></td>
            </tr>
			<tr>
                <th width='30'></th>
                <th width='100'>Tema Misa</th>
                <td width='8'>:</td>
                <td><?php echo $tema; ?></td>
				<td width='100'></td>
            </tr>
			<tr>
                <th width='30'></th>
                <th width='100'>Pemimpin Misa</th>
                <td width='8'>:</td>
                <td><?php echo $romo; ?></td>
				<td width='100'></td>
            </tr>
		</table>
		<br><br><br>
		<i>* Harap menunjukkan Tiket ini kepada petugas berserta Kartu Identitas sesuai dengan nama yang tercantum pada tiket.</i>
		<p style='text-align: right; margin-top: 10px; margin-right: 9px;'><br><br>Yogyakarta, <?php echo $tanggalPesan;?></p>
		<p style='text-align: right; margin-top: 5px; margin-right: 9px;'><b>Gereja St. Antonius Kotabaru</b></p>
	</body>

<?php	
    $html = ob_get_contents();
    ob_end_clean();
    
    return $html;
    
}

function sendpdf($html, $passkey, $email){
    ob_start();
    
    require_once('html2pdf/html2pdf.class.php');
    
    $pdf = new HTML2PDF('P','A4','en');
    $pdf->WriteHTML($html);
    $pdf->Output("bukti_pemesanan-".$passkey.".pdf", "F");
    ob_end_flush();
    
    include "classes/class.phpmailer.php";
    $mail = new PHPMailer;
    $mail->IsSMTP();
    $mail->SMTPSecure = "";
    $mail->Host = "localhost"; //hostname masing-masing provider email
    $mail->SMTPDebug = 0;
    $mail->Port = 587;
    $mail->SMTPAuth = false;
    $mail->Username = "no-reply@segogaring.com"; //user email
    $mail->Password = "Tiket@123"; //password email
    $mail->SetFrom("no-reply@segogaring.com","Gereja St. Antonius Kotabaru"); //set email pengirim
    $mail->Subject = "Pemberitahuan Email dari Website"; //subyek email
    $mail->AddAddress($email,""); //tujuan email
    $mail->addAttachment("bukti_pemesanan-".$passkey.".pdf");
    $mail->MsgHTML("Berikut Tiket Anda…");
    $mail->Send();
    unlink("bukti_pemesanan-".$passkey.".pdf");
}

function downloadpdf($html, $passkey){
    ob_start();    
    require_once('html2pdf/html2pdf.class.php');
    $pdf = new HTML2PDF('P','A4','en');
    $pdf->WriteHTML($html);
    $pdf->Output("bukti_pemesanan-".$passkey.".pdf", "D");
    ob_end_flush();
}

function buatqr($tanggal, $passkey){
    
    include "./../config/phpqrcode/qrlib.php"; 
    
    $tempdir = "temp/".$tanggal."/"; //Nama folder tempat menyimpan file qrcode
    
    if (!file_exists($tempdir)) //Buat folder bername temp
    mkdir($tempdir);
    
    //isi qrcode jika di scan
    $codeContents = "http://segogaring.com/tiketmisa/index.php?p=lihat-pesanan&id=".$passkey;
    //nama file qrcode yang akan disimpan
    $namaFile=$passkey.".png";
    //ECC Level
    $level=QR_ECLEVEL_H;
    //Ukuran pixel
    $UkuranPixel=10;
    //Ukuran frame
    $UkuranFrame=4;
    
    QRcode::png($codeContents, $tempdir.$namaFile, $level, $UkuranPixel, $UkuranFrame);
    
    return $tempdir.$namaFile;
}
?>