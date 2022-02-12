<?php  
 //load_data.php  
 include 'koneksi.php';  
 $output = '';  
  if(isset($_POST["tanggal"]))  
 {  
      if($_POST["tanggal"] != '')  
      {
           $output .= '<option value="">- Pilih Jam Misa -</option>'; 
           $sql = "SELECT * FROM jadwal WHERE tanggal = '".$_POST["tanggal"]."' AND aktif=1 ORDER BY jam ASC" ;  
      }  
      else  
      {  
           $output .= '<option value="">- Pilih Jam Misa -</option>'; 
      }
      $result = mysqli_query($koneksi, $sql);
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '<option value="'.$row['jadwalid'].'">' . substr($row['jam'], 0, 5) . '</option>';    
      }  
      echo $output;  
 }  
 
   if(isset($_POST["jadwalid"]))  
 {  
      if($_POST["jadwalid"] != '')  
      {  
           $sql = "SELECT * FROM jadwal WHERE jadwalid = '".$_POST["jadwalid"]."'" ; 
           $output .= '<option value="">- Pilih Blok Kursi -</option>'; 
      }  
      else  
      {  
           $output .= '<option value="">- Pilih Blok Kursi -</option>'; 
      }  
      $result = mysqli_query($koneksi, $sql);  
      while($row = mysqli_fetch_array($result))  
      {  
          if($row['blok1']==1){
              $output .= '<option value="1">ANTIOKHIA</option>';    
          }
          if($row['blok2']==1){
              $output .= '<option value="2">EFESUS</option>';    
          }
          if($row['blok3']==1){
              $output .= '<option value="3">EMAUS</option>';    
          }
          if($row['blok4']==1){
              $output .= '<option value="4">GALILEA</option>';    
          }
          if($row['blok5']==1){
              $output .= '<option value="5">TIBERIAS</option>';    
          }
          if($row['blok6']==1){
              $output .= '<option value="6">YERIKHO</option>';    
          }
          if($row['blok7']==1){
              $output .= '<option value="7">YUDEA</option>';    
          }
      }  
      echo $output;  
 }
 
 ?> 