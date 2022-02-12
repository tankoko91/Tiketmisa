<div class="content-wrapper">
 <section class="content-header">
          <h1>
            Profil Admin
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"> Home</a></li>
            <li class="active">Profil</li>
          </ol>
        </section>

    <section class="content">
     

      <div class="row">
            <?php 
            
            include '../config/koneksi.php';
            session_start();
            
            
            if(isset($_POST['b1'])){
                
                if(empty($_POST['alamat']) or empty($_POST['email']) or empty($_POST['nama']) or empty($_POST['noHandphone'])){
    
                    echo '<div class="alert alert-warning alert-dismissible fade in" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">×</span></button>
                          <strong>Error!</strong> Data tidak boleh ada yang kosong.
                          </div>';
    
                } else{
                    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
                    $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
                    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
                    $noHandphone = filter_input(INPUT_POST, 'noHandphone', FILTER_SANITIZE_STRING);
                    $alamat = filter_input(INPUT_POST, 'alamat', FILTER_SANITIZE_STRING);
                     
                    $sql = "UPDATE admin SET alamat = :alamat, no_handphone = :noHandphone, nama = :nama,
                            email = :email WHERE id = '$id'";
                    $stmt = $db->prepare($sql);
                    
                    // bind parameter ke query
                    $params = array(
                    ":alamat" => $alamat,
                    ":noHandphone" => $noHandphone,
                    ":nama" => $nama,
                    ":email" => $email);

                    //eksekusi statement
                    $saved = $stmt->execute($params);
                    
                    $_SESSION["user"]["alamat"] = $alamat;
                    $_SESSION["user"]["no_handphone"] = $noHandphone;
                    $_SESSION["user"]["nama"] = $nama;
                    $_SESSION["user"]["email"] = $email;                            
                                                
                    echo '<div class="alert alert-success alert-dismissible fade in" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">×</span></button>
                      <strong>Sukses!</strong> Data berhasil diedit.
                      </div>';
                }
            }
            ?>
        <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
        <!-- /.col -->
        <div class="col-md-8">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Biodata</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
             
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nama</label>
                    <div class="col-sm-10">
                      <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $_SESSION['user']['id']; ?>" placeholder="Id">
                      <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $_SESSION['user']['nama']; ?>" placeholder="Name">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      
                      <input type="text" class="form-control" name="email" id="email" value="<?php echo $_SESSION['user']['email']; ?>" placeholder="Email">
                     
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nomor Telepon</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="noHandphone" id="noHandphone" value="<?php echo $_SESSION['user']['no_handphone']; ?>" placeholder="Nomor Telepon">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Alamat</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $_SESSION['user']['alamat']; ?>" placeholder="Alamat">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" name="b1" class="btn btn-info">Update</button>
                    </div>
                  </div>
                
              </div>
              
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </form>
      </div>
    
      <!-- /.row -->

    </section>
  </div>
