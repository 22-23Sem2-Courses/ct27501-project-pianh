<?php
    
    require_once __DIR__ . '../../../../vendor/autoload.php';
    require_once '../../../bootstrap.php';
    if (session_id() === '') {
        session_start();
    }
    use Gregwar\Captcha\CaptchaBuilder;
    use Gregwar\Captcha\PhraseBuilder;
    
    $builder = new CaptchaBuilder();
    $builder->build();

    use DientuCT\Project\Customer;
    $customer = new Customer($PDO);
   
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Meta -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Admin | DientuCanTho.vn</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../assets/admin/css/bootstrap.min.css" type="text/css" />
    <!-- Font awesome-->
    <link rel="stylesheet" href="../../assets/admin/css/font-awesome.min.css" type="text/css" />
    <!-- Datatables CSS -->
    <link href="../../../assets/admin/css/datatables.min.css" rel="stylesheet"/>
    <!-- Animate CSS -->
    <link href="../../../assets/admin/css/animate.css" rel="stylesheet"/>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../../assets/admin/css/base.css" type="text/css" />
    <link rel="stylesheet" href="../../assets/admin/css/styles.css" type="text/css" />
    <link rel="stylesheet" href="../../assets/admin/css/responsive.css" type="text/css" />

</head>

<body>
    <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);     
    ?>

    <!-- header -->
    <?php include_once __DIR__ . '../../../../partials/admin/header.php'; ?>
    <!-- Block content -->

    
    <div class="container-fluid pb-150">
        
        <div id="main_container" class="row" style="padding-top:80px;">
            <div class="col-md-2"></div>
            <div class="col-md-8 col-sm-8 main-column">

                <div class="grid-members row rounded">

                <?php
                    if (isset($_SESSION['kh_tendangnhap_logged']) && !empty($_SESSION['kh_tendangnhap_logged'])) :
                    ?>
                        <h2>Bạn đã đăng nhập rồi. <a href="/admin/pages/dashboard.php">Bấm vào đây để quay về trang chủ.</a></h2>
                    <?php else : ?>

                    <!-- left -->
                    <div class="grid-item col-md-6 " style="background-color: #eee; padding:0;">
                        <img src="../../assets/admin/imgs/log.svg" alt="img log login" class="img-responsive">
                        <!-- <img src="/../dientucantho.vn/public/assets/backend/imgs/log.svg" alt="" class="img-responsive"> -->
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
                            <a href="/admin/auth/login.php" title="Đăng nhập" class="active">Đăng nhập</a>
                            <a href="/admin/auth/register.php" title="Đăng ký" class="top-title--register">Đăng ký</a>
                        </div>
                        <form  class="frmLogin mb-4" id="frmLogin" method="post" action="">
                            <div class="box box-email">
                                <input type="text"  name="kh_tendangnhap" class="form-control" placeholder="Tên đăng nhập*">
                            </div>
                            <div class="box box-password">
                                <input type="password"  name="kh_matkhau" class="form-control" placeholder="Mật khẩu*" ></input>
                            </div>
                            <div class="box-forgot">
                                <div class="box-remember">
                                    <input type="checkbox" id="remember-me" class="ml-3">
                                    <label for="remember-me" >Ghi nhớ tôi</label> 
                                </div>
                                <a href="#" title="Quên mật khẩu?" class="forgot-password mr-3">
                                Quên mật khẩu?
                                </a>
                            </div>

                            <div>
                                <img src="<?=$builder->inline()?>" alt="Captcha" class="ml-3" style="width:60%;">
                                <br>
                                <div class="capcha-input ml-3">
                                    Captcha: <input type="text" class="mt-2" name="captcha">
                                </div>
                                  
                            </div>
                            <div class="box-login" >
                                <button class="submitLogin submit-btn" name="btnLogin" id="btnLogin">
                                    Đăng nhập
                                </button>
                                <!-- <a  class="submitLogin submit-btn" name="btnLogin" id="btnLogin" >Đăng nhập</a> -->
                            </div>
                        </form>

                        <?php
                            // Chưa đăng nhập -> Xử lý logic/nghiệp vụ kiểm tra Tài khoản và Mật khẩu trong database
                            if (isset($_POST['btnLogin']) && ($_SERVER['REQUEST_METHOD'] === 'POST') ) {
                                if (
                                    isset($_SESSION['phrase']) &&
                                    PhraseBuilder::comparePhrases(
                                        $_SESSION['phrase'],
                                        $_POST['captcha']
                                    )
                                ) {
                                   
                                    $kh_tendangnhap = addslashes($_POST['kh_tendangnhap']);
                                    $kh_matkhau = addslashes(sha1($_POST['kh_matkhau']));
                                    $customerCheck=$customer->checkLogin($kh_tendangnhap, $kh_matkhau);
    
                                    if ($customerCheck > 0) {
                                        // Cập nhật dữ liệu thành công
                                        $_SESSION['kh_tendangnhap_logged'] = $kh_tendangnhap;
                                    
                                        //echo 'Đăng nhập thành công!';
                                        // Điều hướng (redirect) về trang chủ backend
                                        echo '<script>location.href = "/admin/pages/dashboard.php";</script>';
                                    }
                                    else {
                                        echo '<h4 style="color: red; margin: auto;">Sai tên tài khoản hoặc mật khẩu!</h4>';
                                    }       
                                } else {
                                    echo '<h5 style="color: red; margin: auto;"> Captcha không chính xác!</h5>';
                                }

                            }
                            $_SESSION['phrase'] = $builder->getPhrase();
                        ?>

                        <div class="wrapper">
                            <span></span>
                            Hoặc đăng nhập bằng
                            <span></span>
                        </div>
                        <a href="" class="login-google login-social"><i class="fa fa-google-plus-official" aria-hidden="true"></i>  Google</a>
                        <a href="" class="login-facebook login-social"><i class="fa fa-facebook-square" aria-hidden="true"></i>  Facebook</a>
                        <div class="note text-center">
                            <p>Điện máy Cần Thơ cam kết bảo mật và sẽ không bao giờ đăng hay chia sẻ thông tin mà chưa có được sự đồng ý của bạn!</p>
                        </div>
                    </div>
                    <!-- end right border border-info-->
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>

                <?php
                    endif;
                ?>
    
    </div>


    <!-- footer -->
    <?php include_once __DIR__ . '../../../../partials/admin/footer.php'; ?>
    <!-- end footer -->
    <!-- jQuery JS -->
    <script src="../../../assets/admin/js/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="../../../assets/admin/js/bootstrap.min.js"></script>
    <!-- Wow js -->
    <script src="../../../assets/admin/js/wow.min.js"></script>
    <!-- SweetAlert JS-->
    <script src="../../../assets/admin/js/sweetalert.js"></script>
    <script src="../../../assets/admin/js/sweetalert.min.js"></script>
    <!-- Chart JS-->
    <script src="../../../assets/admin/js/chart.min.js"></script>
    <!-- DataTable JS -->
    <script src="../../../assets/admin/js/datatables.min.js"></script>
    <script src="../../../assets/admin/js/buttons.bootstrap4.min.js"></script>
    <script src="../../../assets/admin/js/pdfmake.min.js"></script>
    <script src="../../../assets/admin/js/vfs_fonts.js"></script>
    <!-- Custom JS -->
    <script src="../../../assets/admin/js/app.js"></script>



</body>

</html>