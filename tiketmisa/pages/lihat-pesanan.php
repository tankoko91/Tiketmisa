<?php
    
    include './config/koneksi.php';
    include './config/ubahHari.php';
    include "./config/formatTanggal.php"; 
    session_start();
    
    $id= filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
        
    if($_SESSION['user']['hak']==""){
        $self = $_SERVER["REQUEST_URI"];
        $_SESSION['url'] = $self;
        header("location:../tiketmisa/index.php?p=login");
    } else if($_SESSION['user']['hak']=="staff"){
        //redirect ke halaman konfirmasi
        header("location:../tiketmisa/staff/home.php?p=konfirmasi-tiket&id=".$id);
    } else if($_SESSION['user']['hak']=="admin"){
        //redirect ke halaman konfirmasi
        header("location:../tiketmisa/admin/home.php?p=konfirmasi-tiket&id=".$id);
    } else {
    
        $sqla=mysqli_query($koneksi,"SELECT * FROM pemesanan WHERE passkey='$id'");
        $a=mysqli_fetch_array($sqla);
        
        if($a['userid']!=$_SESSION['user']['userid']){
            header("location:../tiketmisa/index.php");
        }
        
        $jadwal=$a['jadwalid'];
        $sqlb=mysqli_query($koneksi,"SELECT tanggal, DAYNAME(tanggal), jam, tema, romo FROM jadwal WHERE jadwalid=$jadwal");
        $b=mysqli_fetch_array($sqlb);
        
        $blokid=$a['blokid'];
        $sqlc=mysqli_query($koneksi,"SELECT * FROM blok WHERE blokid=$blokid");
        $c=mysqli_fetch_array($sqlc);
        
        $userid=$a['userid'];
        $sqld=mysqli_query($koneksi,"SELECT * FROM user WHERE userid=$userid");
        $d=mysqli_fetch_array($sqld);
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
		<img src='./assets/images/logo.png' alt='' width='200' height='50'/><br><br><br><br>
		
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
			<th rowspan='9'><img src='./config/temp/<?php echo $b[0];?>/<?php echo $id;?>.png'width='200'/></th>
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
		<i>* Syarat dan ketentuan berlaku untuk tiket ini.</i>
		<p style='text-align: right; margin-top: 10px; margin-right: 9px;'><br><br>Yogyakarta, <?php echo date("d-m-Y (H:i:s)", strtotime($a['datecreated']));?></p>
		<p style='text-align: right; margin-top: 5px; margin-right: 9px;'><b>Gereja St. Antonius Kotabaru</b></p>
	</body>
