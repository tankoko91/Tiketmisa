<?php ob_start();?>
<?php
    
    include './../config/koneksi.php';
    include './../config/ubahHari.php';
    include "./../config/phpqrcode/qrlib.php"; 
    include "./../config/formatTanggal.php"; 
    
    $jadwalid = filter_input(INPUT_POST, 'jadwalid', FILTER_SANITIZE_STRING);
    $userid = filter_input(INPUT_POST, 'userid', FILTER_SANITIZE_STRING);
    $blokid = filter_input(INPUT_POST, 'blokid', FILTER_SANITIZE_STRING);
    $nokursi = filter_input(INPUT_POST, 'nokursi', FILTER_SANITIZE_STRING);
    $datecreated = filter_input(INPUT_POST, 'datecreated', FILTER_SANITIZE_STRING);
    $passkey = filter_input(INPUT_POST, 'passkey', FILTER_SANITIZE_STRING);
    
    $cj = mysqli_query($koneksi,"SELECT * FROM pemesanan WHERE jadwalid='$jadwalid' AND aktif='0'");
    $hcj=mysqli_num_rows($cj);
    
    $ck = mysqli_query($koneksi,"SELECT * FROM pemesanan WHERE jadwalid='$jadwalid' AND blokid= '$blokid' AND nokursi='$nokursi'");
    $hck=mysqli_num_rows($ck);
    
    $cp = mysqli_query($koneksi,"SELECT * FROM pemesanan WHERE jadwalid='$jadwalid' AND userid='$userid'");
    $hcp=mysqli_num_rows($cp);
    
    if($hck > 0){

        echo "<script>
            alert('Maaf, kursi sudah dipesan orang lain saat anda melakukan pemesanan');
            </script>";
        
        echo "<meta http-equiv=refresh content=0;url=../index.php?p=antiokhia&jadwalid=" . $jadwalid . ">";
    } else if($hcp > 0){

        echo "<script>
            alert('Maaf, anda hanya bisa memesan satu kursi per jadwal misa');
            </script>";
        
        echo "<meta http-equiv=refresh content=0;url=../index.php?p=antiokhia&jadwalid=" . $jadwalid . ">";
    } else if($hcj > 0){

        echo "<script>
            alert('Maaf, Jadwal misa ini tidak aktif');
            </script>";
        
        echo "<meta http-equiv=refresh content=0;url=../index.php?p=antiokhia&jadwalid=" . $jadwalid . ">";
    }
    else {
        $sql = "INSERT INTO pemesanan (jadwalid, userid, blokid, nokursi, datecreated, passkey)
    	        VALUES (:jadwalid, :userid, :blokid, :nokursi, :datecreated, :passkey)";
        $stmt = $db->prepare($sql);

        // bind parameter ke query
        $params = array(
            ":jadwalid" => $jadwalid,
            ":userid" => $userid,
            ":blokid" => $blokid,
            ":nokursi" => $nokursi,
            ":datecreated" => $datecreated,
            ":passkey" => $passkey);
        
        //eksekusi statement
        $saved = $stmt->execute($params);
        
        //hasil yang ditampilkan ketika selesai query
        if($saved){
        
            $sqlb=mysqli_query($koneksi,"SELECT tanggal, DAYNAME(tanggal), jam, tema, romo FROM jadwal WHERE jadwalid=$jadwalid");
            $b=mysqli_fetch_array($sqlb);
            
            $sqlc=mysqli_query($koneksi,"SELECT * FROM blok WHERE blokid=$blokid");
            $c=mysqli_fetch_array($sqlc);
            
            $sqld=mysqli_query($koneksi,"SELECT * FROM user WHERE userid=$userid");
            $d=mysqli_fetch_array($sqld);
            
            $tempdir = "./../config/temp/".$b[0]."/"; //Nama folder tempat menyimpan file qrcode
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
                    <td><?php echo $passkey; ?></td>
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
                    <td><?php echo $nokursi; ?></td>
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
    		<p style='text-align: right; margin-top: 10px; margin-right: 9px;'><br><br>Yogyakarta, <?php echo date("d-m-Y (H:i:s)", strtotime($datecreated));?></p>
    		<p style='text-align: right; margin-top: 5px; margin-right: 9px;'><b>Gereja St. Antonius Kotabaru</b></p>
    	</body>
    <?php
            $html = ob_get_contents();
            ob_end_clean();
                    
            require_once('html2pdf/html2pdf.class.php');
            $pdf = new HTML2PDF('P','A4','en');
            $pdf->WriteHTML($html);
            $pdf->Output("bukti_pemesanan-".$passkey.".pdf", "F");
            
            
            include "./../config/classes/class.phpmailer.php";
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
            $mail->Subject = "E-Tiket - " . $passkey; //subyek email
            $mail->AddAddress($d['email'],""); //tujuan email
            $mail->addAttachment("bukti_pemesanan-".$passkey.".pdf");
            $mail->MsgHTML("Berikut Tiket Anda…");
            $mail->Send();
            unlink("bukti_pemesanan-".$passkey.".pdf");
    
            echo "<script>
                alert('Pemesanan Berhasil');
                </script>";
    	    							  
            header("location:./../index.php?p=pesanan-saya");
        
        }
            
    }
?>