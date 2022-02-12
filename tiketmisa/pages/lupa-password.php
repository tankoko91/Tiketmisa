<!--start wrapper-->
    <section class="wrapper">
        <section class="page_head">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="page_title">
                            <h2>Lupa Password</h2>
                        </div>
                        <nav id="breadcrumbs">
                            <ul>
                                <li>You are here:</li>
                                <li><a href="index.php">Home</a></li>
                                <li>Lupa Password</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <section class="content contact">
            <div class="container">
                <div class="row sub_content">
                    <div class="col-lg-8 col-md-8 col-md-offset-2">
                     <div class="lupa-password">
                        <div class="dividerHeading">
                            <h4><span>Lupa Password</span></h4>
                        </div>
                         <?php 
                            include './config/koneksi.php';
                            include './config/classes/class.phpmailer.php';
                            include './config/acak.php';
                            include './config/getTimestamp.php';
                            
                            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
                            $kodeotp=  get_rand_alphanumeric(174);
                            $timestamp = getTimestamp();
                                
                            if(isset($_POST['b1'])){

                                $sql=mysqli_query($koneksi,"SELECT * FROM user where email='$_POST[email]'");
                                $q=mysqli_fetch_array($sql);
                                $cek=mysqli_num_rows($sql);
                                
                            if(empty($_POST['email'])){

                            echo '<div class="alert alert-warning alert-dismissible fade in" role="alert">
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">×</span></button>
                                  <strong>Error!</strong> Email masih kosong.
                                  </div>';
                            }else if(empty($cek)){
                                echo '<div class="alert alert-warning alert-dismissible fade in" role="alert">
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">×</span></button>
                                  <strong>Error!</strong> Email tidak terdaftar.
                                  </div>';
                            }else{
                                
                                $sql=mysqli_query($koneksi,"SELECT * FROM otp where email='$email'");
                                $q=mysqli_fetch_array($sql);
                                $cek=mysqli_num_rows($sql);
                                
                                if(empty($cek)){
                                    $sql = "INSERT INTO otp (email, kodeotp, datecreated)
                            	        VALUES (:email, :kodeotp, :datecreated)";
                                    $stmt = $db->prepare($sql);
    
                                    // bind parameter ke query
                                    $params = array(
                                        ":email" => $email,
                                        ":kodeotp" => $kodeotp,
                                        ":datecreated" => $timestamp);
    
                                    //eksekusi statement
                                    $saved = $stmt->execute($params);
                                    
                                } else{
                                    $sql = "UPDATE otp SET kodeotp = :kodeotp, datecreated = :datecreated
                                        WHERE email = '$email'";
                                     $stmt = $db->prepare($sql);
                                    
                                    // bind parameter ke query
                                    $params = array(
                                        ":kodeotp" => $kodeotp,
                                        ":datecreated" => $timestamp);
                                    
                                    //eksekusi statement
                                    $saved = $stmt->execute($params);
                                }
                                
                                $mail = new PHPMailer();
                                $body = 
                                    "<!DOCTYPE html>
                                        <html>
                                        
                                        <head>
                                            <title></title>
                                            <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
                                            <meta name='viewport' content='width=device-width, initial-scale=1'>
                                            <meta http-equiv='X-UA-Compatible' content='IE=edge' />
                                            <style type='text/css'>
                                                @media screen {
                                                    @font-face {
                                                        font-family: 'Lato';
                                                        font-style: normal;
                                                        font-weight: 400;
                                                        src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
                                                    }
                                        
                                                    @font-face {
                                                        font-family: 'Lato';
                                                        font-style: normal;
                                                        font-weight: 700;
                                                        src: local('Lato Bold'), local('Lato-Bold'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format('woff');
                                                    }
                                        
                                                    @font-face {
                                                        font-family: 'Lato';
                                                        font-style: italic;
                                                        font-weight: 400;
                                                        src: local('Lato Italic'), local('Lato-Italic'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format('woff');
                                                    }
                                        
                                                    @font-face {
                                                        font-family: 'Lato';
                                                        font-style: italic;
                                                        font-weight: 700;
                                                        src: local('Lato Bold Italic'), local('Lato-BoldItalic'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format('woff');
                                                    }
                                                }
                                        
                                                /* CLIENT-SPECIFIC STYLES */
                                                body,
                                                table,
                                                td,
                                                a {
                                                    -webkit-text-size-adjust: 100%;
                                                    -ms-text-size-adjust: 100%;
                                                }
                                        
                                                table,
                                                td {
                                                    mso-table-lspace: 0pt;
                                                    mso-table-rspace: 0pt;
                                                }
                                        
                                                img {
                                                    -ms-interpolation-mode: bicubic;
                                                }
                                        
                                                /* RESET STYLES */
                                                img {
                                                    border: 0;
                                                    height: auto;
                                                    line-height: 100%;
                                                    outline: none;
                                                    text-decoration: none;
                                                }
                                        
                                                table {
                                                    border-collapse: collapse !important;
                                                }
                                        
                                                body {
                                                    height: 100% !important;
                                                    margin: 0 !important;
                                                    padding: 0 !important;
                                                    width: 100% !important;
                                                }
                                        
                                                /* iOS BLUE LINKS */
                                                a[x-apple-data-detectors] {
                                                    color: inherit !important;
                                                    text-decoration: none !important;
                                                    font-size: inherit !important;
                                                    font-family: inherit !important;
                                                    font-weight: inherit !important;
                                                    line-height: inherit !important;
                                                }
                                        
                                                /* MOBILE STYLES */
                                                @media screen and (max-width:600px) {
                                                    h1 {
                                                        font-size: 32px !important;
                                                        line-height: 32px !important;
                                                    }
                                                }
                                        
                                                /* ANDROID CENTER FIX */
                                                div[style*='margin: 16px 0;'] {
                                                    margin: 0 !important;
                                                }
                                            </style>
                                        </head>
                                        
                                        <body style='background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;'>
                                            <!-- HIDDEN PREHEADER TEXT -->
                                            <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                                                <!-- LOGO -->
                                                <tr>
                                                    <td bgcolor='#FFA73B' align='center'>
                                                        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                                                            <tr>
                                                                <td align='center' valign='top' style='padding: 40px 10px 40px 10px;'> </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td bgcolor='#FFA73B' align='center' style='padding: 10px 10px 0px 10px;'>
                                                        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                                                            <tr>
                                                                <td bgcolor='#FFECD1' align='center' valign='top' style='padding: 10px 20px 0px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;'>
                                                                    <h1 style='font-size: 40px; font-weight: 200; margin: 1;'>Reset Password</h1> 
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td bgcolor='#f4f4f4' align='center' style='padding: 0px 10px 0px 10px;'>
                                                        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                                                            <tr>
                                                                <td bgcolor='#f4f4f4' align='left' style='padding: 10px 30px 20px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;'>
                                                                    <p style='margin: 0;'></p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td bgcolor='#ffffff' align='left' style='padding: 20px 30px 40px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;'>
                                                                    <p style='margin: 0;'><br>Kami mendapat laporan jika anda lupa password. Silahkan tekan tombol di bawah untuk melakukan reset password.</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td bgcolor='#ffffff' align='left'>
                                                                    <table width='100%' border='0' cellspacing='0' cellpadding='0'>
                                                                        <tr>
                                                                            <td bgcolor='#ffffff' align='center' style='padding: 20px 30px 60px 30px;'>
                                                                                <table border='0' cellspacing='0' cellpadding='0'>
                                                                                    <tr>
                                                                                        <td align='center' style='border-radius: 3px;' bgcolor='#FFA73B'><a href='http://segogaring.com/tiketmisa/index.php?p=confirm-reset&otp=" . $kodeotp . "' target='_blank' style='font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #FFA73B; display: inline-block;'>Reset Password</a></td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr> <!-- COPY -->
                                                            <tr>
                                                                <td bgcolor='#ffffff' align='left' style='padding: 10px 30px 0px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;'>
                                                                    <p style='margin: 0;'>Apabila tidak berhasil, silahkan buka link berikut :</p>
                                                                </td>
                                                            </tr> <!-- COPY -->
                                                            <tr>
                                                                <td bgcolor='#ffffff' align='left' style='padding: 20px 30px 20px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;'>
                                                                    <p style='margin: 0;'><a href='#' target='_blank' style='color: #FFA73B;'>http://segogaring.com/tiketmisa/index.php?p=confirm-reset&otp=" . $kodeotp . "</a><br></p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td bgcolor='#ffffff' align='left' style='padding: 10px 30px 20px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;'>
                                                                    <p style='margin: 0;'>Link Reset Password ini hanya berlaku selama 24 jam.<br><br></p>
                                                                </td>
                                                            </tr>
                                                            <tr>
																<td bgcolor='#ffffff' align='left' style='padding: 10px 30px 20px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;'>
                                                                    <p style='margin: 0;'></p>
                                                                </td>
															</tr
															<tr>
																<td bgcolor='#ffffff' align='left' style='padding: 10px 30px 20px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;'>
                                                                    <p style='margin: 0;'></p>
                                                                </td>
															</tr>
															<tr>
                                                                <td bgcolor='#ffffff' align='left' style='padding: 10px 30px 40px 30px; border-radius: 0px 0px 4px 40px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;'>
                                                                    <p style='margin: 0;'><br>Berkah Dalem,<br>St. Antonius Padua Kotabaru</p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td bgcolor='#f4f4f4' align='center' style='padding: 0px 10px 0px 10px;'>
                                                        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                                                            <tr>
                                                                <td bgcolor='#FFECD1' align='center' style='padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;'>
                                                                    <h2 style='font-size: 20px; font-weight: 400; color: #111111; margin: 0;'>Sistem Pemesanan Kursi Misa Online</h2>
                                                                    <p style='margin: 0;'><a href='http://segogaring.com/tiketmisa/' target='_blank' style='color: #FFA73B;'>Gereja St. Antonius Padua Kotabaru</a></p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td bgcolor='#f4f4f4' align='center' style='padding: 0px 10px 0px 10px;'>
                                                        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                                                            <tr>
                                                                <td bgcolor='#f4f4f4' align='left' style='padding: 10px 30px 30px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;'> <br>
                                                                    <p style='margin: 0;'><a href='#' target='_blank' style='color: #111111; font-weight: 700;'></a>.</p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </body>
                                        </html>";
                                    
                                    $mail->IsSMTP();  // menggunakan SMTP
                                    $mail->SMTPSecure = "";
                                    $mail->Host = "localhost"; //hostname masing-masing provider email
                                    $mail->SMTPDebug = 0;
                                    $mail->Port = 587;
                                    $mail->SMTPAuth = false;
                                    $mail->Username = "no-reply@segogaring.com"; //user email
                                    $mail->Password = "Tiket@123"; //password email
                                    $mail->SetFrom("no-reply@segogaring.com","Gereja St. Antonius Kotabaru"); //set email pengirim
                                    $mail->Subject = "Konfirmasi Lupa Password"; //subyek email
                                    $mail->AddAddress($email, $q['nama']); //tujuan email
                                    $mail->MsgHTML($body);
                                
                                    if(!$mail->Send()) {

                                         echo '<div class="alert alert-warning alert-dismissible fade in" role="alert">
                                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                              <span aria-hidden="true">×</span></button>
                                                              <strong>Error!</strong> Gagal mengirim Link konfirmasi, cobalah beberapa saat lagi.
                                                              </div>';
                                        
                                    } else {
                                         echo '<div class="alert alert-success alert-dismissible fade in" role="alert">
                                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                              <span aria-hidden="true">×</span></button>
                                                              <strong>Sukses!</strong> Berhasil mengirim link konfirmasi, silahkan buka email anda untuk konfimasi reset password.
                                                              </div>';
                                    }
        
                            }
                            }
                            ?>
                            
                        <form id="contactForm" action="" method="post">
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-lg-12 ">
                                    <label>Email anda</label>
                                        <input type="email" id="name" name="email" class="form-control" maxlength="100" data-msg-required="Please enter your EMail." value="" placeholder="Email" >
                                    </div>
                                   
                                </div>
                            </div>
                          
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="submit" name="b1" data-loading-text="Loading..." class="btn btn-default btn-lg" value="Kirim Konfirmasi">
                                </div>
                            </div>
                        </form>
                        <br>
                        <p>
                    </div>
                    </div>
                    
                </div>
            </div>
        </section>
    </section>
    <!--end wrapper-->