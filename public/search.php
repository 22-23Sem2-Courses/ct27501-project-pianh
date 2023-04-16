<?php
// hàm `session_id()` sẽ trả về giá trị SESSION_ID (tên file session do Web Server tự động tạo)
// - Nếu trả về Rỗng hoặc NULL => chưa có file Session tồn tại
if (session_id() === '') {
    // Yêu cầu Web Server tạo file Session để lưu trữ giá trị tương ứng với user (Web Browser đang gởi Request)
    session_start();
}
?>

<?php
    require_once '../bootstrap.php';
    use DientuCT\Project\Customer;
    $customer = new Customer($PDO);
    $customers = $customer->all();
?>

<?php

    // if (!isset($_SESSION['kh_tendangnhap_logged'])){
    //     echo '<script>location.href = "/user/auth/login.php";</script>';
    // }
    require_once '../bootstrap.php';
    $noidungtimkiem = $_GET['noidungtimkiem'];
    use DientuCT\Project\Product;
    $product = new Product($PDO);
    // $products = $product->allProductImages();
    $products = $product->findProductImage($noidungtimkiem);
    // var_dump($products); die;




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
    
    
</head>
<body>
    <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);     
    ?>

    <?php include_once __DIR__ . '../../partials/user/header.php'; ?>

    <div class="body_container">
        <main role="main " class="mb-2">
            
            <div class="col-md-12 col-sm-12 main-column">
                
                <!-- Product Sale -->
                <div class="box-sales">
                    <div class="title_sale">
                        <span>Săn sale giá sốc mỗi ngày</span>
                    </div>
                    <div class="box-sales-items">
                        <!-- Hiển thị sản phẩm Sale -->

                    </div>
                </div>

                <section class="jumbotron text-center form-search">
                    <div class="container">
                        <h1 class="jumbotron-heading">Danh sách sản phẩm đã tìm thấy</h1>
                        <p class="lead text-muted">Chất lượng, uy tín, hàng đầu cả nước.</p>
                    </div>
                </section>
                
                <!-- Sản phẩm tìm được -->
                <section class="products_news">
                    <!-- Tab -->
                    <div id="products_menu_tabs">
                        <div class="nav-tabs">
                            <div class="item_tabs">
                                <a href="#" title="Điện thoại">
                                    <h2>
                                        <img src="/assets/user/imgs/phukien.svg" alt="icon">
                                        <span>Sản phẩm đáng mua nhất</span>
                                    </h2>
                                </a>
                            </div>
                            <div class="right_tab">
                                <div class="list_product">
                                    <div class="item_tabs">
                                        <a class="mshow" href="#">iPad</a>
                                    </div>
                                    <div class="item_tabs">
                                        <a class="mshow" href="#">Samsung</a>
                                    </div>
                                    <div class="item_tabs">
                                        <a class="mshow" href="#">Xiaomi</a>
                                    </div>
                                    <div class="item_tabs">
                                        <a class="mshow" href="#">Huawei</a>
                                    </div>
                                    <div class="item_tabs">
                                        <a class="mshow" href="#">Oppo</a>
                                    </div>
                                    <div class="item_tabs">
                                        <a class="mshow" href="#">Nokia</a>
                                    </div>

                                </div>
                                <!-- <div class="count_product"></div> -->
                            </div>

                        </div>

                    </div>
                    <!-- Product Item -->
                    <div class="products_item_list">
                        <div id="product" class="products_item_content">
                            <div class="row row-cols-5">  <!-- 5 col 1 row -->
                                <?php foreach ($products as $product) :  ?>
                                    <div class="col">
                                        <div class="card mb-4 shadow-sm">
                                            <!-- Header -->
                                            <div class="card-top">
                                                <div class="ribbon-wrapper">
                                                    <div class="product-item__hot">
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                        <span>HOT</span>
                                                    </div>
                                                </div>
                                                <div class="product-item__sale-off">
                                                    <span class="product-item__sale-off-percent"> -10%</span>
                                                </div>
                                                <!-- Nếu có ảnh thì hiển thị -->
                                               
                                                    <div class="container-img">
                                                        <a href="detail.php?sp_ma=<?= htmlspecialchars($product->sp_ma) ?>">
                                                            <img class="bd-placeholder-img card-img-top img-fluid box-effect-img" src="/assets/user/imgs/ingsearch.png" />
                                                        </a>
                                                    </div>
                                            
                                                
                                            </div>
                                            
                                            <!-- Body -->
                                            <div class="card-body">
                                                <a href="detail.php?sp_ma=<?= htmlspecialchars($product->sp_ma) ?>">
                                                    <h6><?= htmlspecialchars($product->sp_ten) ?></h6>
                                                </a>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="btn-group">
                                                        <a class="btn btn-sm btn-outline-secondary" href="detail.php?sp_ma=<?= htmlspecialchars($product->sp_ma) ?>">Xem chi tiết</a>
                                                    </div>
                                                    <small class="text-muted text-right">
                                                        <s><?= htmlspecialchars(number_format( ($product->sp_giacu) , 0, ".", ",")) ?></s>
                                                        <b><?= htmlspecialchars(number_format( ($product->sp_gia) , 0, ".", ","). ' đ') ?></b>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            

                        </div>

                    </div>

                </section>
                


                

                

                

                
                
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