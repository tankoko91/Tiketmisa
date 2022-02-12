
<!--start wrapper-->
    <section class="wrapper">
        <section class="page_head">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="page_title">
                            <h2>Login</h2>
                           
                        </div>
                        <nav id="breadcrumbs">
                            <ul>
                                <li>You are here:</li>
                                <li><a href="index.php">Home</a></li>
                                <li>Login</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <section class="content contact">
            <div class="container">
                <div class="row sub_content">
                    <div class="col-lg-8 col-md-8 col-sm-8">
                        <div class="dividerHeading">
                            <h4><span>Login</span></h4>
                        </div>
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
                        <form id="contactForm" action="./login/login.php" method="post">
							<div class="row">
                                <div class="form-group">
                                  
                                    <div class="col-md-12">
                                        <input type="text" id="user" name="user" class="form-control" maxlength="50" data-msg-required="Silahkan isi email anda." value="" placeholder="Email">
                                    </div>
                                
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                  
                                     <div class="col-md-12">
                                        <input type="password" id="pass" name="pass" class="form-control" maxlength="20" data-msg-required="Silahkan konfirmasi password anda." value="" placeholder="Password">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9">
                                    <input type="submit" name="b1" data-loading-text="Loading..." class="btn btn-default btn-lg" value="Login">
									
                                </div>
                                <div class="col-md-3">
                                    <b><a href="index.php?p=lupa-password" class="lp" style="color:#555;">Lupa password ?</a></b>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="sidebar">
                            <div class="widget_info">
                                <div class="dividerHeading">
                                    <h4><span>Petunjuk Login</span></h4>
                                    </div>
                                <p><i class="fa fa-angle-double-right"></i> Isilah email dan password anda dengan benar</p><br>
                                <p><i class="fa fa-angle-double-right"></i> Setelah mengisikan email password silahkan klik tombol "Login"</p><br>
                                <p><i class="fa fa-angle-double-right"></i> Jika data mengalami kendala login anda bisa melakukan reset password atau menghubungi kami, Terimakasih<p><br>
                                
                               
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
			<script type="text/javascript">
      $(function () {
        
        $('#datepicker').datetimepicker({
                                  
          format: 'YYYY/MM/DD',
            sideBySide: true,
          widgetPositioning: {
              horizontal: 'right',
              vertical: 'bottom'
          }
          
        });
       
      });
    </script>
        </section>
    </section>
    <!--end wrapper-->