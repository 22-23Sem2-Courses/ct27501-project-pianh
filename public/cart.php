<?php
    if (session_id() === '') {
        session_start();
    }

    if (!isset($_SESSION['kh_tendangnhap_logged'])){
        echo '<script>location.href = "/user/auth/login.php";</script>';
    }
    require_once '../bootstrap.php';
    

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

                <div class="list-products">
                    <h2 class="text-center">Sản phẩm chờ thanh toán</h2>

                    <div class="row">
                        <div class="col col-md-12">
                            <?php if (!empty($giohangdata)) : ?>
                                <table id="tblGioHang" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Ảnh đại diện</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Số lượng</th>
                                            <th>Đơn giá</th>
                                            <th>Thành tiền</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody id="datarow">
                                        <?php $stt = 1; ?>
                                        <?php foreach ($giohangdata as $sanpham) : ?>
                                            <tr>
                                                <td><?= $stt ?></td>
                                                <td>
                                                    <?php if (empty($sanpham['hinhdaidien'])) : ?>
                                                        <img src="/assets/shared/img/default-image.png" class="img-fluid hinhdaidien" />
                                                    <?php else : ?>
                                                        <img src="/assets/uploads/<?= $sanpham['hinhdaidien'] ?>" class="img-fluid hinhdaidien" />
                                                    <?php endif; ?>
                                                </td>
                                                <td><?= $sanpham['sp_ten'] ?></td>
                                                <td>
                                                    <input type="number" min="1" class="form-control" id="soluong_<?= $sanpham['sp_ma'] ?>" name="soluong" value="<?= $sanpham['soluong'] ?>" style="width: 100px;"/>
                                                    
                                                </td>
                                                <td><?= number_format($sanpham['gia'], 0, ".", ",")?> vnđ</td>
                                                <td><?= number_format($sanpham['soluong'] * $sanpham['gia'], 0, ".", ",")?> vnđ</td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm btn-capnhat-soluong" data-sp-ma="<?= $sanpham['sp_ma'] ?>" style="padding: 7px 5px">
                                                    <i class="fa fa-refresh" aria-hidden="true"></i>Cập nhật</button>
                                                    <!-- Nút xóa, bấm vào sẽ xóa thông tin dựa vào khóa chính `sp_ma` -->
                                                    <a id="delete_<?= $stt ?>" data-sp-ma="<?= $sanpham['sp_ma'] ?>" class="btn btn-danger btn-delete-sanpham">
                                                        <i class="fa fa-trash" aria-hidden="true"></i> Xóa
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php else : ?>
                                <h3 class="text-center" style="margin: 40px 0;">Bạn chưa chọn sản phẩm, vui lòng chọn sản phẩm tại trang chủ nhé!!!</h3>
                            <?php endif; ?>
                            <a href="index.php" class="btn btn-warning btn-md btn-back"><i class="fa fa-arrow-left" aria-hidden="true"></i> Quay
                                về trang chủ</a>
                            <a href="order.php" class="btn btn-primary btn-md"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Thanh toán</a>
                        </div>
                    </div>




                </div>

        




  
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

    <script>
        $(document).ready(function() {
            function removeSanPhamVaoGioHang(id) {
                // Dữ liệu gởi
                var dulieugoi = {
                    sp_ma: id
                };

                // AJAX đến API xóa sản phẩm khỏi Giỏ hàng trong Session
                $.ajax({
                    url: '/user/api/CartDeleteProduct.php',
                    method: "POST",
                    dataType: 'json',
                    data: dulieugoi,
                    success: function(data) {
                        // Refresh lại trang
                        location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                        var htmlString = `<h1>Không thể xử lý</h1>`;
                        $('#thongbao').html(htmlString);
                        // Hiện thông báo
                        $('.alert').removeClass('d-none').addClass('show');
                    }
                });
            };

            // Đăng ký sự kiện cho các nút đang sử dụng class .btn-delete-sanpham
            $('#tblGioHang').on('click', '.btn-delete-sanpham', function(event) {
                // debugger;
                event.preventDefault();
                var id = $(this).data('sp-ma');

                console.log(id);
                removeSanPhamVaoGioHang(id);
            });

            // Cập nhật số lượng trong Giỏ hảng
            function capnhatSanPhamTrongGioHang(id, soluong) {
                // Dữ liệu gởi
                var dulieugoi = {
                    sp_ma: id,
                    soluong: soluong
                };

                $.ajax({
                    url: '/user/api/CartUpdateProduct.php',
                    method: "POST",
                    dataType: 'json',
                    data: dulieugoi,
                    success: function(data) {
                        // Refresh lại trang
                        location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                        var htmlString = `<h1>Không thể xử lý</h1>`;
                        $('#thongbao').html(htmlString);
                        // Hiện thông báo
                        $('.alert').removeClass('d-none').addClass('show');
                    }
                });
            };
            $('#tblGioHang').on('click', '.btn-capnhat-soluong', function(event) {
                // debugger;
                event.preventDefault();
                var id = $(this).data('sp-ma');
                var soluongmoi = $('#soluong_' + id).val();
                capnhatSanPhamTrongGioHang(id, soluongmoi);
            });
        });
    </script>

</body>
</html>