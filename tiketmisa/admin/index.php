<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" href="../assets/images/icon.png"/>
    <title>St. Antonius Padua Kotabaru</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/plugins/font awesome/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../assets/plugins/font awesome/ionicons.min.css">
     <!-- DataTables -->
    <link rel="stylesheet" href="../assets/plugins/datatables/dataTables.bootstrap.css">

    <link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/plugins/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../assets/plugins/dist/css/skins/_all-skins.min.css">
   
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="#"><b>Gereja St. Antonius Padua Kota Baru</b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form action="../login/login-admin.php" method="post">
          <?php
                            $id= filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);

                            if($id=='error'){
                                echo '<div class="alert alert-warning alert-dismissible fade in" role="alert">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">×</span></button>
                                      <strong>Error!</strong> Username atau Password salah.
                                      </div>';
                            }
          ?>
          <div class="form-group has-feedback">
            <input type="text" name="user" class="form-control" placeholder="Username" required="">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="pass" class="form-control" placeholder="Password" required="">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-success btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>

        <div class="social-auth-links text-center">
         
        </div><!-- /.social-auth-links -->


      </div><!-- /.login-box-body -->

      <center>
        <br>
      <a href="../index.php"><b> Kembali Kehalaman utama</b></a>
      </center>

    </div><!-- /.login-box -->

    <script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
     <script src="../assets/js/jquery-nopen.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!-- Bootstrap 3.3.5 -->
    <script src="../assets/js/bootstrap.min.js"></script>
     <!-- DataTables -->

     <script src="../assets/js/bootstrap-datetimepicker.min.js"></script>

    <script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../assets/plugins/datatables/dataTables.bootstrap.min.js"></script>

    <!-- Slimscroll -->
    <script src="../assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../assets/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../assets/plugins/dist/js/app.min.js"></script>

  </body>
</html>
