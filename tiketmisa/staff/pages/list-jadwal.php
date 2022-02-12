    <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            List Jadwal
           
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"> Home</a></li>
            <li class="active">List Jadwal</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
    <!-- Main row -->
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data List Jadwal</h3>  
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">     
                  <table id="example1" class="table table-bordered table-striped">
                      
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Romo</th>
                        <th>Tema</th>
                        <th>Status Pemesanan</th>
                        <th>Antiokhia</th>
                        <th>Efesus</th>
                        <th>Emaus</th>
                        <th>Galilea</th>
                        <th>Tiberias</th>
                        <th>Yerikho</th>
                        <th>Yudea</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        include './../config/koneksi.php';
                        include './../config/formatTanggal.php'; 
                        include './../config/ubahHari.php'; 
                        $no=0;
                        $sql=mysqli_query($koneksi,"SELECT * FROM jadwal");
                        while($q=mysqli_fetch_array($sql)){
                            $no++;
                        ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo ubahHari(date('l', strtotime($q['tanggal']))) . ', ' . tanggalOut($q['tanggal']); ?></td>
                        <td><?php echo substr($q['jam'],0,5); ?></td>
                        <td><?php echo $q['romo']; ?></td>
                        <td><?php echo $q['tema']; ?></td>
                        <td><?php if($q['aktif']==1){
                                        echo 'Open';
                                    } else {
                                        echo 'Closed';
                                    } ?></td>
                        <td><?php if($q['blok1']==1){
                                        echo 'Enabled';
                                    } else {
                                        echo 'Disabled';
                                    } ?></td>
                        <td><?php if($q['blok2']==1){
                                        echo 'Enabled';
                                    } else {
                                        echo 'Disabled';
                                    } ?></td>
                        <td><?php if($q['blok3']==1){
                                        echo 'Enabled';
                                    } else {
                                        echo 'Disabled';
                                    } ?></td>
                        <td><?php if($q['blok4']==1){
                                        echo 'Enabled';
                                    } else {
                                        echo 'Disabled';
                                    } ?></td>
                        <td><?php if($q['blok5']==1){
                                        echo 'Enabled';
                                    } else {
                                        echo 'Disabled';
                                    }; ?></td>
                        <td><?php if($q['blok6']==1){
                                        echo 'Enabled';
                                    } else {
                                        echo 'Disabled';
                                    }; ?></td>
                        <td><?php if($q['blok7']==1){
                                        echo 'Enabled';
                                    } else {
                                        echo 'Disabled';
                                    }; ?></td>
                         <td>
                          <a href="home.php?p=edit-jadwal&id=<?php echo $q['jadwalid']; ?>" class="btn btn-success"><i class="fa fa-pencil"></i></a>
                          <a href="./pages/delete-jadwal.php?id=<?php echo $q['jadwalid']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr>

                  <?php } ?>
                    </tbody>
                  </table>
                </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

            </section><!-- /.content -->
      </div><!-- /.content-wrapper -->