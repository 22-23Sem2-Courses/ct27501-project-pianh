<!DOCTYPE html>
<html>

<head>
    <?php include_once __DIR__ . '/../layouts/meta.php'; ?>
    <title>Đăng ký Backend | dienmay.vn</title>

    <!-- Nhúng file Quản lý các Liên kết CSS dùng chung cho toàn bộ trang web -->
    <?php include_once __DIR__ . '/../layouts/styles.php'?>
</head>

<body>
    <!-- header -->
    <?php include_once __DIR__ . '/../layouts/partials/header.php' ?>
    <!-- end header -->

    <div class="container-fluid pb-150">
        <div id="main_container" class="row" style="padding-top:80px;">
            <div class="col-md-2"></div>
            <div class="col-md-8 col-sm-8 main-column">
                <div class="grid-members row rounded">
                    <!-- left -->
                    <div class="grid-item col-md-6 " style="background-color: #eee; padding:0;">
                        <img src="/../../assets/backend/imgs/log.svg" alt="" class="img-responsive">
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
                            <a href="/dienmay.vn/backend/auth/login.php" title="Đăng nhập" class="top-title--login">Đăng nhập</a>
                            <a href="/dienmay.vn/backend/auth/register.php" title="Đăng ký" class="active">Đăng ký</a>
                        </div>
                        <form method="post" action="" class="frmRegister" id="frmRegister">
                            <div class="box box-username">
                                <input type="text" name="kh_tendangnhap" id="kh_tendangnhap" class="form-control" placeholder="Tài khoản*">
                            </div>
                            <div class="box box-fullname">
                                <input type="text" name="kh_ten" id="kh_ten" class="form-control" placeholder="Họ và tên*">
                            </div>
                            <div class="box box-phone-number">
                                <input type="text" name="kh_dienthoai" id="kh_dienthoai" class="form-control" placeholder="Số điện thoại*">
                            </div>
                            <div class="box box-email">
                                <input type="email" name="kh_email" id="kh_email" class="form-control" placeholder="Nhập địa chỉ Email*">
                            </div>
                            <div class="box box-password">
                                <input type="password" name="kh_matkhau" id="kh_matkhau" class="form-control" placeholder="Mật khẩu*" ></input>
                            </div>
                            <div class="box box-password">
                                <input type="password" name="kh_nhaplaimatkhau" id="kh_nhaplaimatkhau" class="form-control" placeholder="Nhập lại Mật khẩu*" ></input>
                            </div>
                            <div class="box-forgot d-flex justify-content-end">
                                <a href="https://didongthongminh.vn/quen-mat-khau" title="Quên mật khẩu?" class="forgot-password  mr-3 mt-0 mb-0">
                                Quên mật khẩu?
                                </a>
                            </div>
                            <div class="box-register">
                                <!-- <a href="" class="submitRegister submit-btn">Tạo tài khoản</a> -->
                                <button class="submitRegister submit-btn" name="submitRegister">Tạo tài khoản</button>
                            </div>
                        </form>
                        <div class="wrapper">
                            <span></span>
                            Hoặc đăng nhập bằng
                            <span></span>
                        </div>
                        <a href="" class="login-google login-social"><i class="fa-brands fa-google-plus social-icont"></i>  Google</a>
                        <a href="" class="login-facebook login-social"><i class="fa-brands fa-facebook social-icont"></i>  Facebook</a>
                    </div>
                    <!-- end right border border-info-->
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>

        <?php
                    // Hiển thị tất cả lỗi trong PHP
                    // Chỉ nên hiển thị lỗi khi đang trong môi trường Phát triển (Development)
                    // Không nên hiển thị lỗi trên môi trường Triển khai (Production)
                    ini_set('display_errors', 1);
                    ini_set('display_startup_errors', 1);
                    error_reporting(E_ALL);

                    // Truy vấn database
                    // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
                    include_once(__DIR__ . '/../../dbconnect.php');

                    // Chưa đăng nhập -> Xử lý logic/nghiệp vụ kiểm tra Tài khoản và Mật khẩu trong database
                    if (isset($_POST['submitRegister'])) {
                         // Xử lý đăng ký
                        // Lấy dữ liệu người dùng hiệu chỉnh gởi từ REQUEST POST
                        $kh_tendangnhap = htmlentities($_POST['kh_tendangnhap']);
                        $kh_ten = htmlentities($_POST['kh_ten']);
                        $kh_dienthoai = htmlentities($_POST['kh_dienthoai']);
                        $kh_email = htmlentities($_POST['kh_email']);
                        $kh_matkhau = sha1($_POST['kh_matkhau']);
                        $kh_makichhoat = 0;
                        $kh_trangthai = 0; // Mặc định khi đăng ký sẽ chưa kích hoạt tài khoản
                        $kh_quantri = 0; // Mặc định khi đăng ký sẽ không có quyền quản trị
                        $kh_quanly = 0; // Mặc định khi đăng ký sẽ không có quyền quản lý
                          // Câu lệnh INSERT
                        $sql = "INSERT INTO khachhang(kh_tendangnhap, kh_ten, kh_matkhau, kh_dienthoai, kh_email, kh_makichhoat, kh_trangthai, kh_quantri, kh_quanly) VALUES ('$kh_tendangnhap', '$kh_ten', '$kh_matkhau', '$kh_dienthoai', '$kh_email', '$kh_makichhoat', $kh_trangthai, $kh_quantri, $kh_quanly)";
                        // var_dump($sql);
                        // die;
                        // Thực thi SELECT
                        $result = mysqli_query($conn, $sql);

                        // Luu Section
                        $_SESSION['kh_tendangnhap_logged'] = $kh_tendangnhap;

                        echo 'Đăng ký thành công!';
                        // Điều hướng (redirect) về trang chủ
                        echo '<script>location.href = "/dienmay.vn/index.php";</script>';
                    }
                    

                ?>
        
   



    
    </div>






    <!-- footer -->
    <?php include_once __DIR__ . '/../layouts/partials/footer.php' ?>
    <!-- end footer -->
    <?php include_once __DIR__ . '/../layouts/scripts.php' ?>



</body>

</html>