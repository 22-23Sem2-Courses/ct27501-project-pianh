<?php

    if (session_id() === '') {
        session_start();
    }


    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require_once '../../../bootstrap.php';
    require_once '../../../vendor/autoload.php';

    use DientuCT\Project\RegisterUser;     
 
    $errors = [];
  
    // Chưa đăng nhập -> Xử lý logic/nghiệp vụ kiểm tra Tài khoản và Mật khẩu trong database
    if (isset($_POST['submitRegister']) && ($_SERVER['REQUEST_METHOD'] === 'POST') ) {
        $kh_tendangnhap = addslashes($_POST['kh_tendangnhap']);
        $kh_ten = addslashes($_POST['kh_ten']);
        $kh_email = addslashes($_POST['kh_email']);
        $kh_dienthoai = addslashes($_POST['kh_dienthoai']);

        $customer = new RegisterUser($PDO);
        $customer->fill($_POST);
        // var_dump($customer);// die;
        // var_dump($_POST);die;

        $customerCheck = $customer->checkRegister($kh_tendangnhap);
        
        if ($customerCheck == true) {
            //echo '<h4 style="color: red;">Tên tài khoản đã tồn tại!</h4>';
            echo '<script type="text/javascript">
                window.onload = function () { alert("Tên tài khoản đã tồn tại!"); }
                </script>';
        }
        else {
            if ($customer->validate() && $customer->validatePassword($_POST)) {
                $customer->insertCustomerUser();
                $_SESSION['kh_tendangnhap_logged'] = $kh_tendangnhap;
                echo '<script>location.href = "/index.php";</script>';
                
                // Tiến hành gửi Mail cho khách hàng đăng ký tài khoản thành công
                if (isset($kh_tendangnhap)) {
                    $mail = new PHPMailer(true);
                    $mail->CharSet= 'UTF-8';

                    try {
                        //Server settings
                        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
                        $mail->isSMTP();                                           
                        $mail->Host       = 'smtp.gmail.com';                     
                        $mail->SMTPAuth   = true;                                   
                        $mail->Username   = 'ndanhdev@gmail.com';                     
                        $mail->Password   = 'gjvpglhavaqsfniq';                             
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;           
                        $mail->Port       = 465;                                    
                
                        //Recipients
                        $mail->setFrom('ndanhdev@gmail.com', 'DientuCanTho.vn');
                        $mail->addAddress($kh_email);               //Name is optional

                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = 'Chào mừng bạn đến với DientuCanTho.vn';
                        $mail->Body    = "<p>Chúc mừng bạn ".$kh_ten." đã đăng ký tài khoản thành công tại DientuCanTho.vn</p>
                                            Thông tin tài khoản của bạn như sau: </br>
                                            <ul>
                                                <li>Tên đăng nhập: ".$kh_tendangnhap."</li>
                                                <li>Mật khẩu:</li>
                                                <li>Email:  ".$kh_email."</li>
                                                <li>Số điện thoại:  ".$kh_dienthoai."</li>
                                            </ul>
                                            </br>Chúc bạn lựa chọn được các sản phẩm thật ưng ý tại DientuCanTho.vn!.
                                           ";
                
                
                        $mail->send();
                        
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                }
                                    
            }
            $errors = $customer->getValidationErrors();
        }
    }

?>

<!DOCTYPE html>
<html>

<head>
    <!-- Meta -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tài khoản | DientuCanTho.vn</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/assets/user/css/bootstrap.min.css" type="text/css" />
    <!-- Font awesome -->
    <link rel="stylesheet" href="/assets/user/css/font-awesome.min.css" type="text/css" />
    <!-- Datatables CSS -->
    <link href="/assets/user/css/datatables.min.css" rel="stylesheet"/>
    <!-- Animate CSS -->
    <link href="/assets/user/css/animate.css" rel="stylesheet"/>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/assets/user/css/base.css" type="text/css" />
    <link rel="stylesheet" href="/assets/user/css/styles.css" type="text/css" />
    <link rel="stylesheet" href="/assets/user/css/responsive.css" type="text/css" />
</head>

<body>

    <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);     
    ?>
    
    <!-- header -->
    <?php include_once __DIR__ . '../../../../partials/user/header.php'; ?>
    <!-- end header -->

    <div class="container-fluid pb-150">
        <div id="main_container" class="row" style="padding-top:80px;">
            <div class="col-md-2"></div>
            <div class="col-md-8 col-sm-8 main-column">
                <div class="grid-members row rounded">

                <?php
                    if (isset($_SESSION['kh_tendangnhap_logged']) && !empty($_SESSION['kh_tendangnhap_logged'])) :
                    ?>
                    <h2>Bạn đã đăng nhập rồi. <a href="/index.php">Bấm vào đây để quay về trang chủ.</a></h2>
                <?php else : ?>

                    <!-- left -->
                    <div class="grid-item col-md-6 " style="background-color: #eee; padding:0;">
                        <img src="../../assets/user/imgs/log.svg" alt="" class="img-responsive">
                        <p>Quyền lợi thành viên</p>
                        <ul style="list-style-type: none;" >
                            <li class="pr-4">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.6663 7.38668V8.00001C14.6655 9.43763 14.2 10.8365 13.3392 11.9879C12.4785 13.1393 11.2685 13.9817 9.88991 14.3893C8.51129 14.7969 7.03785 14.7479 5.68932 14.2497C4.3408 13.7515 3.18944 12.8307 2.40698 11.6247C1.62452 10.4187 1.25287 8.99205 1.34746 7.55755C1.44205 6.12305 1.99781 4.75756 2.93186 3.66473C3.86591 2.57189 5.1282 1.81027 6.53047 1.49344C7.93274 1.17662 9.39985 1.32157 10.713 1.90668" stroke="#20863D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M14.6667 2.66669L8 9.34002L6 7.34002" stroke="#20863D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                  Mua hàng khắp thế giới cực dễ dàng, nhanh chóng
                            </li>
                            <li>
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.6663 7.38668V8.00001C14.6655 9.43763 14.2 10.8365 13.3392 11.9879C12.4785 13.1393 11.2685 13.9817 9.88991 14.3893C8.51129 14.7969 7.03785 14.7479 5.68932 14.2497C4.3408 13.7515 3.18944 12.8307 2.40698 11.6247C1.62452 10.4187 1.25287 8.99205 1.34746 7.55755C1.44205 6.12305 1.99781 4.75756 2.93186 3.66473C3.86591 2.57189 5.1282 1.81027 6.53047 1.49344C7.93274 1.17662 9.39985 1.32157 10.713 1.90668" stroke="#20863D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M14.6667 2.66669L8 9.34002L6 7.34002" stroke="#20863D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                  Theo dõi chi tiết đơn hàng, địa chỉ thanh toán dễ dàng
                            </li>
                            <li>
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.6663 7.38668V8.00001C14.6655 9.43763 14.2 10.8365 13.3392 11.9879C12.4785 13.1393 11.2685 13.9817 9.88991 14.3893C8.51129 14.7969 7.03785 14.7479 5.68932 14.2497C4.3408 13.7515 3.18944 12.8307 2.40698 11.6247C1.62452 10.4187 1.25287 8.99205 1.34746 7.55755C1.44205 6.12305 1.99781 4.75756 2.93186 3.66473C3.86591 2.57189 5.1282 1.81027 6.53047 1.49344C7.93274 1.17662 9.39985 1.32157 10.713 1.90668" stroke="#20863D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M14.6667 2.66669L8 9.34002L6 7.34002" stroke="#20863D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                  Nhận nhiều chương trình ưu đãi hấp dẫn từ chúng tôi
                            </li>
                        </ul>
                    </div>
                    <!-- end left -->
                    <!-- right -->
                    <div class="grid-item col-md-6 "style="background-color: #fff;" >
                        <div class="top-title ">
                            <a href="/user/auth/login.php" title="Đăng nhập" class="top-title--login">Đăng nhập</a>
                            <a href="/user/auth/register.php" title="Đăng ký" class="active">Đăng ký</a>
                        </div>
                        
                        <form  method="post" action="" class="frmRegister" id="frmRegister">
                            <div class="box box-username <?= isset($errors['kh_tendangnhap']) ? ' has-error' : '' ?>">
                                <input type="text" name="kh_tendangnhap" id="kh_tendangnhap" maxlen="50"  class="form-control" placeholder="Tên đăng nhập*" value="<?= isset($_POST['kh_tendangnhap']) ? htmlspecialchars($_POST['kh_tendangnhap']) : '' ?>" />
                                <?php if (isset($errors['kh_tendangnhap'])) : ?>
                                    <span class="help-block">
                                        <strong><?= htmlspecialchars($errors['kh_tendangnhap']) ?></strong>
                                    </span>
                                <?php endif ?>
                            </div>

                                    
                            <div class="box box-fullname <?= isset($errors['kh_ten']) ? ' has-error' : '' ?>">
                                <input type="text" name="kh_ten" id="kh_ten" maxlen="100" class="form-control" placeholder="Họ và tên*"  value="<?= isset($_POST['kh_ten']) ? htmlspecialchars($_POST['kh_ten']) : '' ?>" />
                            
                                <?php if (isset($errors['kh_ten'])) : ?>
                                    <span class="help-block">
                                        <strong><?= htmlspecialchars($errors['kh_ten']) ?></strong>
                                    </span>
                                <?php endif ?>
                            </div>

                            <div class="box box-phone-number <?= isset($errors['kh_dienthoai']) ? ' has-error' : '' ?>">
                                <input type="text" name="kh_dienthoai" id="kh_dienthoai" maxlen="50" class="form-control" placeholder="Số điện thoại*" value="<?= isset($_POST['kh_dienthoai']) ? htmlspecialchars($_POST['kh_dienthoai']) : '' ?>" />
                            
                                <?php if (isset($errors['kh_dienthoai'])) : ?>
                                    <span class="help-block">
                                        <strong><?= htmlspecialchars($errors['kh_dienthoai']) ?></strong>
                                    </span>
                                <?php endif ?>
                            </div>

                            <div class="box box-email <?= isset($errors['kh_email']) ? ' has-error' : '' ?>">
                                <input type="email" name="kh_email" id="kh_email" maxlen="100" class="form-control" placeholder="Nhập địa chỉ Email*" value="<?= isset($_POST['kh_email']) ? htmlspecialchars($_POST['kh_email']) : '' ?>" />
                            
                                <?php if (isset($errors['kh_email'])) : ?>
                                    <span class="help-block">
                                        <strong><?= htmlspecialchars($errors['kh_email']) ?></strong>
                                    </span>
                                <?php endif ?>
                            </div>

                            <div class="box box-password <?= isset($errors['kh_matkhau']) ? ' has-error' : '' ?>">
                                <input type="password" name="kh_matkhau" id="kh_matkhau" maxlen="255" class="form-control" placeholder="Mật khẩu*" value="<?= isset($_POST['kh_matkhau']) ? htmlspecialchars($_POST['kh_matkhau']) : '' ?>" />
                                
                                <?php if (isset($errors['kh_matkhau'])) : ?>
                                    <span class="help-block">
                                        <strong><?= htmlspecialchars($errors['kh_matkhau']) ?></strong>
                                    </span>
                                <?php endif ?>
                            
                            </div>

                            <div class="box box-password <?= isset($errors['kh_nhaplaimatkhau']) ? ' has-error' : '' ?>">
                                <input type="password" name="kh_nhaplaimatkhau" id="kh_nhaplaimatkhau" maxlen="255" class="form-control" placeholder="Nhập lại Mật khẩu*" value="<?= isset($_POST['kh_nhaplaimatkhau']) ? htmlspecialchars($_POST['kh_nhaplaimatkhau']) : '' ?>" />
                                
                                <?php if (isset($errors['kh_nhaplaimatkhau'])) : ?>
                                    <span class="help-block">
                                        <strong><?= htmlspecialchars($errors['kh_nhaplaimatkhau']) ?></strong>
                                    </span>
                                <?php endif ?>
                            </div>
                            
                            <div class="box-forgot d-flex justify-content-end">
                                <a href="#" title="Quên mật khẩu?" class="forgot-password  mr-3 mt-0 mb-0">
                                Quên mật khẩu?
                                </a>
                            </div>

                            <div class="box-register">
                                <!-- <a href="" class="submitRegister submit-btn">Tạo tài khoản</a> -->
                                <button type="submit" class="submitRegister submit-btn" name="submitRegister" id="submitRegister">Tạo tài khoản</button>
                               
                            </div>
                        </form>

                        <div class="wrapper">
                            <span></span>
                            Hoặc đăng nhập bằng
                            <span></span>
                        </div>
                        <a href="" class="login-google login-social"><i class="fa fa-google-plus-official" aria-hidden="true"></i>  Google</a>
                        <a href="" class="login-facebook login-social"><i class="fa fa-facebook-square" aria-hidden="true"></i>  Facebook</a>
                    </div>
                    <!-- end right border border-info-->

                    <?php
                        // Kết thúc check Section đã đăng nhập hay chưa
                        endif;
                    ?>

                </div>
            </div>
            <div class="col-md-2"></div>
        </div>

        

    </div>


    <!-- footer -->
    <?php include_once __DIR__ . '../../../../partials/user/footer.php'; ?>
    <!-- end footer -->
    <!-- jQuery JS -->
    <script src="/assets/user/js/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="/assets/user/js/bootstrap.min.js"></script>
    <!-- Wow js -->
    <script src="/assets/user/js/wow.min.js"></script>
    <!-- SweetAlert JS-->
    <script src="/assets/user/js/sweetalert.js"></script>
    <script src="/assets/user/js/sweetalert.min.js"></script>
    <!-- DataTable JS -->
    <script src="/assets/user/js/datatables.min.js"></script>
    <script src="/assets/user/js/buttons.bootstrap4.min.js"></script>
    <script src="/assets/user/js/pdfmake.min.js"></script>
    <script src="/assets/user/js/vfs_fonts.js"></script>
    <!-- Custom JS -->
    <script src="/assets/user/js/app.js"></script>

</body>

</html>