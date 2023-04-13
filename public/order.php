<?php
    if (session_id() === '') {
        session_start();
    }
    require_once '../bootstrap.php';

    use DientuCT\Project\Order;
    // if (!isset($_SESSION['kh_tendangnhap_logged'])){
    //     echo '<script>location.href = "/auth/login.php";</script>';
    // }
    require_once '../bootstrap.php';
    
// Đã người dùng chưa đăng nhập -> hiển thị thông báo yêu cầu người dùng đăng nhập
if (!isset($_SESSION['kh_tendangnhap_logged']) || empty($_SESSION['kh_tendangnhap_logged'])) {
    echo 'Vui lòng Đăng nhập trước khi Thanh toán! <a href="/user/auth/login.php">Click vào đây để đến trang Đăng nhập</a>';
    die;
} else {
    // Nếu giỏ hàng trong session rỗng, return
    if (!isset($_SESSION['giohangdata']) || empty($_SESSION['giohangdata'])) {
        echo 'Giỏ hàng rỗng. Vui lòng chọn Sản phẩm trước khi Thanh toán!';
        die;
    }
    $kh_tendangnhap = $_SESSION['kh_tendangnhap_logged'];
    // var_dump($kh_tendangnhap);die;
  

    // Thông tin đơn hàng
    $dh_trangthaithanhtoan = 0; // Mặc định là 0 chưa thanh toán
    $order = new Order($PDO);
    $statement = $PDO->prepare(
        'insert into dondathang (dh_trangthaithanhtoan, kh_tendangnhap, dh_thoigiantao, dh_thoigiancapnhat)
            values (:dh_trangthaithanhtoan, :kh_tendangnhap, now(), now())'
    );

            // var_dump($statement);
            // die;
    $result = $statement->execute([
        'dh_trangthaithanhtoan' => $dh_trangthaithanhtoan,
        'kh_tendangnhap' => $kh_tendangnhap
    ]);

    $dh_ma = $PDO->lastInsertId();
    
    // Thông tin các dòng chi tiết đơn hàng
    $giohangdata = $_SESSION['giohangdata'];

    // 4. Duyệt vòng lặp qua mảng các dòng Sản phẩm của chi tiết đơn hàng được gởi đến qua request POST
    foreach ($giohangdata as $item) {
        // 4.1. Chuẩn bị dữ liệu cho câu lệnh INSERT vào table `sanpham_dondathang`
        $sp_ma = $item['sp_ma'];
        $sp_dh_soluong = $item['soluong'];
        $sp_dh_dongia = $item['gia'];


        $statement = $PDO->prepare(
            'insert into sanpham_dondathang (sp_ma, dh_ma, sp_dh_soluong, sp_dh_dongia)
                values (:sp_ma, :dh_ma, :sp_dh_soluong, :sp_dh_dongia)'
        );

                // var_dump($statement);
                // die;
        $result = $statement->execute([
            'sp_ma' => $sp_ma,
            'dh_ma' => $dh_ma,
            'sp_dh_soluong' => $sp_dh_soluong,
            'sp_dh_dongia' => $sp_dh_dongia
        ]);


        
    }

  
    // echo 'Đặt hàng thành công. <a href="index.php">Bấm vào đây để quay về trang chủ</a>';
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Điện tử Cần Thơ | Mua bán điện thoại, Tablet, Laptop</title>
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

    <style>
        .hinhdaidien {
            height: 200px;
        }
    </style>
        
   

</head>
<body>
    <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);     
    ?>

    <?php include_once __DIR__ . '../../partials/user/header.php'; ?>

    <div class="body_container">
        <main role="main row" class="mb-2">   
            <?php
            // Kiểm tra dữ liệu trong session
            $giohangdata = [];
            if (isset($_SESSION['giohangdata'])) {
                $giohangdata = $_SESSION['giohangdata'];
            } else {
                $giohangdata = [];
            }
            ?>

            <div class="col-md-12 col-sm-12 main-column">
                <!-- Vùng ALERT hiển thị thông báo -->
                <div id="alert-container" class="alert alert-warning alert-dismissible fade d-none" role="alert">
                    <div id="thongbao">&nbsp;</div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="card order">
                    <div class="order-title">
                        <h2 class="text-center">Đặt mua thành công</h2>
                    </div>

                    <div class="order-content text-center">
                        <a href="index.php">Bấm vào đây để quay về trang chủ</a>
                        <h3></br>Vui lòng thanh toán phí:
                        <?php
                            foreach ($giohangdata as $item) {
                                echo "   ";
                                echo number_format($item['gia'], 0, ".", ",") . ' vnđ';
                            }
                        ?> </h3>
                        <h5>Qua tài khoản Sacombank: 070117389503 Hoặc thanh toán bằng cách quét mã QR MOMO sau!</h5>
                        <h5>Thông tin thời gian nhận hàng sẽ được gửi ngay sau khi bạn thanh toán!</h5>
                        <div class="qr_nhantien">
                            <img src="/assets/user/imgs/qr_nhantien.jpg" alt="" >
                        </div>

                    </div>
                    
                </div>

                <?
                    // 5. Thực thi hoàn tất, điều hướng về trang Danh sách
                    // Hủy dữ liệu giỏ hàng trong session
                    unset($_SESSION['giohangdata']);
                ?>


            </div>

        </main>

        <!-- Footer top -->
        <div class="footer-top row">
            <div class="col-md-2">
                <h3 class="footer__heading">Chăm sóc khách hàng</h3>
                <div class="footer-list">
                    <div class="footer-item">
                        <a href="" class="footer-item__link">Trung tâm trợ giúp</a>
                    </div>
                    <div class="footer-item">
                        <a href="" class="footer-item__link">Mua hàng và thanh toán Online</a>
                    </div>
                    <div class="footer-item">
                        <a href="" class="footer-item__link">Trung tâm bảo hành chính hãng</a>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <h3 class="footer__heading">Thông tin liên hệ</h3>
                <div class="footer-list">
                    <div class="footer-item">
                        <a href="" class="footer-item__link">Giới thiệu công ty</a>
                    </div>
                    <div class="footer-item">
                        <a href="" class="footer-item__link">Hệ thống cửa hàng</a>
                    </div>
                    <div class="footer-item">
                        <a href="" class="footer-item__link">Chính sách bảo mật</a>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <h3 class="footer__heading">Gọi tư vấn & khiếu nại</h3>
                <div class="footer-list">
                    <div class="footer-item">
                        <a href="" class="footer-item__link">Gọi mua hàng: 085 5100 001 (8h00 - 22h00)</a>
                    </div>
                    <div class="footer-item">
                        <a href="" class="footer-item__link">Hỗ trợ kỹ thuật: 1800 6502 (8h00 - 21h00)</a>
                    </div>
                    <div class="footer-item">
                        <a href="" class="footer-item__link">Hợp tác kinh doanh: 1900 6122</a>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <h3 class="footer__heading">Tuyển dụng</h3>
                <div class="footer-list">
                    <div class="footer-item">
                        <a href="" class="footer-item__link">Thông tin tuyển dụng</a>
                    </div>
                    <div class="footer-item">
                        <a href="" class="footer-item__link">Vị trí ứng tuyển</a>
                    </div>
                    <div class="footer-item">
                        <a href="" class="footer-item__link">Liên hệ nộp CV</a>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <h3 class="footer__heading">Thông tin khác</h3>
                <div class="footer-list">
                    <div class="footer-item">
                        <a href="" class="footer-item__link">Chính sách đổi trả</a>
                    </div>
                    <div class="footer-item">
                        <a href="" class="footer-item__link">Quy chế hoạt động</a>
                    </div>
                    <div class="footer-item">
                        <a href="" class="footer-item__link">Chính sách Bảo hành</a>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <h3 class="footer__heading">Điện tử Cần Thơ trên ứng dụng</h3>
                <div class="footer__download">
                    <img src="/assets/user/imgs/qr_code_app.png" alt="Download QR" class="footer__download-qr">
                    <div class="footer__download-apps">
                        <a href="" class="footer__download-apps-link">
                            <img src="/assets/user/imgs/google_play.png" alt="Google Play" class="footer__download-app-img">
                        </a>
                        <a href="" class="footer__download-apps-link">
                            <img src="/assets/user/imgs/app_store.png" alt="App Store" class="footer__download-app-img">
                        </a>

                    </div>
                </div>
            </div>
        </div>
            
        
    </div>

    <?php include_once __DIR__ . '../../partials/user/footer.php'; ?>
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