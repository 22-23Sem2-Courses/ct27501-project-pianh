<?php
    if (session_id() === '') {
        session_start();
    }

    // if (!isset($_SESSION['kh_tendangnhap_logged'])){
    //     echo '<script>location.href = "/auth/login.php";</script>';
    // }
    require_once '../bootstrap.php';
    
    use DientuCT\Project\Product;
    $product = new Product($PDO);


    $sp_ma = isset($_REQUEST['sp_ma']) ?
        filter_var($_REQUEST['sp_ma'], FILTER_SANITIZE_NUMBER_INT) : -1;
    
    $product->find($sp_ma);

    use DientuCT\Project\Marketing;
    use DientuCT\Project\Customer;
    $marketing = new Marketing($PDO);
    $marketing->findProductMarketing($sp_ma);



    //Lấy dữ liệu hình ảnh sản phẩm đầu tiên
    // $productImageFirsts = $product->allProductImageFirst($sp_ma);
    // var_dump($productImageFirsts); die;

    // Lấy dữ liệu tất cả hình sản phẩm
    $productImageAlls = $product->allImageOfProduct($sp_ma);
    // var_dump($productImageAlls); die;


    
    $errors = [];
    // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //     if ($product->update($_POST)) {
    //         // Cập nhật dữ liệu thành công
    //         redirect(BASE_URL_PATH .'admin/products/index.php');
    //     } 
    //     // Cập nhật dữ liệu không thành công
    //     $errors = $product->getValidationErrors();
    // }




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
        <main role="main row" class="mb-2">
            
            <div class="col-md-12 col-sm-12 main-column main-column-detail">
                <!-- Vùng ALERT hiển thị thông báo -->
                <div id="alert-container" class="alert alert-warning alert-dismissible fade d-none" role="alert">
                    <div id="thongbao">&nbsp;</div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                <div class="product mt-5">
                    <!-- Thông tin tên sản phẩm -->
                    <div class="rowtop">
                        <h1 class="pull-left"><?= htmlspecialchars($product->sp_ten) ?></h1>
                        <div class="star-detail" data-rating="4.7" title="gorgeous">
                            <img alt="1" src="/assets/user/imgs/star-fill.png" title="gorgeous">&nbsp;
                            <img alt="2" src="/assets/user/imgs/star-fill.png" title="gorgeous">&nbsp;
                            <img alt="3" src="/assets/user/imgs/star-fill.png" title="gorgeous">&nbsp;
                            <img alt="4" src="/assets/user/imgs/star-fill.png" title="gorgeous">&nbsp;
                            <img alt="5" src="/assets/user/imgs/star-half.png" title="gorgeous">
                            <input id="score" name="score" type="hidden" value="4.7" readonly="">
                        </div>
                        <div class="total_rate">
                            <span>111 đánh giá</span>
                        </div>
                        <span class="installment">
                            Trả góp 0%
                        </span>
                    </div>
                    <!-- Hình sản phẩm và những thông tin liên quan -->
                    <div class="details-product row justify-content-center">
                        <!-- Hình -->
                        <div class="col-md-6">
                            <form name="frmDetailProduct" id="frmDetailProduct" method="post" action="">
                                <?php 
                                    $hinhsanphamdautien = ($productImageAlls[0])->hsp_tentaptin;
                                    // var_dump( $hinhsanphamdautien); die;
                                ?>
                                <input type="hidden" name="sp_ma" id="sp_ma" value="<?= htmlspecialchars($product->sp_ma) ?>" />
                                <input type="hidden" name="sp_ten" id="sp_ten" value="<?= htmlspecialchars($product->sp_ten) ?>" />
                                <input type="hidden" name="sp_soluong" id="sp_soluong" value="<?= htmlspecialchars($product->sp_soluong) ?>" />
                                <input type="hidden" name="sp_gia" id="sp_gia" value="<?= htmlspecialchars($product->sp_gia) ?>" />
                                <input type="hidden" name="hinhdaidien" id="hinhdaidien" value="<?= empty($hinhsanphamdautien) ? '' : $hinhsanphamdautien ?>" />
                                
                                <div class="wrapper row">
                                    <div class="preview col-md-6">
                                        <div class="preview-pic tab-content">
                                            <?php foreach ($productImageAlls as $productImageAll) : ?>
                                                <div class="tab-pane <?= ($productImageAll->hsp_tentaptin == $hinhsanphamdautien) ? 'active' : '' ?>" id="pic-<?= $productImageAll->sp_ma ?>">
                                                    <img src="/assets/uploads/<?= $productImageAll->hsp_tentaptin ?>" style="width: 446px; height: 446px;" />
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <ul class="preview-thumbnail nav nav-tabs">
                                            <?php foreach ($productImageAlls as $productImageAll) : ?>
                                                <li class="<?= ($productImageAll->hsp_tentaptin == $hinhsanphamdautien) ? 'active' : '' ?>">
                                                    <a data-target="#pic-<?= $productImageAll->sp_ma ?>" data-toggle="tab">
                                                        <img src="/assets/uploads/<?= $productImageAll->hsp_tentaptin ?>"  />
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>

                                    </div>
                                </div>
                            </form>

                        </div>

                        <div class="col-md-6 standard-product">
                            <div class="standard-product-title">
                                <span>Bộ sản phẩm chuẩn</span>
                            </div>
                            <ul>
                                <li>Tình trạng: <?= htmlspecialchars($marketing->mkt_tinhtrang) ?></li>
                                <li>Bộ sản phẩm chuẩn: <?= htmlspecialchars($marketing->mkt_bosanpham) ?></li>
                                <li>Bảo hành: <?= htmlspecialchars($marketing->mkt_baohanh) ?></li>
                                <li>Quà tặng: <?= htmlspecialchars($marketing->mkt_quatang) ?></li>
                                <a class="like btn btn-default btn btn-danger" href="#"><span class="fa fa-heart"></span></a>

                            </ul>

                            <div class="form-group">
                                <label for="soluong">Số lượng đặt mua:</label>
                                <input type="number" min="1" class="form-control" id="soluong" name="soluong" >
                            </div>

                            <div class="action">
                                <a class="add-to-cart btn btn-default text-white btn btn-warning" id="btnThemVaoGioHang">Mua ngay</a>
                                
                            </div>
                        </div>

                        
                    </div>

                    <!-- Bộ sản phẩm và đặc điểm nổi bậc-->
                    <div class="row ">
                        <!-- Thông só kỹ thuật -->
                        <div class="col-md-6  ">
                            <div class="characteristic">
                                <div class="product-title">
                                    <img src="/assets/user/imgs/thongso.svg" alt="icon" class="img-responsive icon_cat">
                                    <span>Thông số kỹ thuật </span>
                                </div>
                                <table class="charactestic_table  table table-bordered table-hover table-responsive-lg table-striped" style="margin-bottom: 0;">
                                    <tbody>
                                        <tr>
                                            <td class="charactestic-title" width="40%">Độ phân giải</td>
                                            <td class="charactestic-content"><?= htmlspecialchars($product->sp_dophangiai) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="charactestic-title" width="40%">Màn hình rộng</td>
                                            <td class="charactestic-content"><?= htmlspecialchars($product->sp_manhinh) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="charactestic-title" width="40%">Độ phân giải camera sau</td>
                                            <td class="charactestic-content"><?= htmlspecialchars($product->sp_camera_sau) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="charactestic-title" width="40%">Độ phân giải camera trước</td>
                                            <td class="charactestic-content"><?= htmlspecialchars($product->sp_camera_truoc) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="charactestic-title" width="40%">Hệ điều hành</td>
                                            <td class="charactestic-content"><?= htmlspecialchars($product->sp_hedieuhanh) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="charactestic-title" width="40%">Chip xử lý</td>
                                            <td class="charactestic-content"><?= htmlspecialchars($product->sp_chip) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="charactestic-title" width="40%">RAM</td>
                                            <td class="charactestic-content"><?= htmlspecialchars($product->sp_ram) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="charactestic-title" width="40%">Bộ nhớ trong</td>
                                            <td class="charactestic-content"><?= htmlspecialchars($product->sp_rom) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="charactestic-title" width="40%">Dung lượng pin</td>
                                            <td class="charactestic-content"><?= htmlspecialchars($product->sp_pin) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="charactestic-title" width="40%">Thương hiệu</td>
                                            <td class="charactestic-content"><?= htmlspecialchars($product->sp_nsx) ?></td>
                                        </tr>

                                    </tbody>


                                </table>
                            </div>
                        </div>
                        
                        <div class="col-md-6 outstanding-features">
                            <div class="feature-titile">
                                <span>Đặc điểm nổi bật của <?= htmlspecialchars($product->sp_ten) ?></span>
                            </div>
                            <div class="feature-content">
                                <ul>
                                    <li>
                                        <strong>Hiệu năng vượt trội - </strong> <?= htmlspecialchars($marketing->mkt_hieunang) ?>
                                    </li>
                                    <li>
                                        <strong>Không gian hiển thị sống động -  </strong> <?= htmlspecialchars($marketing->mkt_hienthi) ?>
                                    </li>
                                    <li>
                                        <strong>Trải nghiệm điện ảnh đỉnh cao - </strong> <?= htmlspecialchars($marketing->mkt_trainghiem) ?>
                                    </li>
                                    <li>
                                        <strong>Thiết lập tính năng an toàn - </strong> <?= htmlspecialchars($marketing->mkt_tinhnang) ?>
                                    </li>
                                    <li>
                                        <strong>Tối ưu điện năng - </strong> <?= htmlspecialchars($marketing->mkt_diennang) ?>
                                    </li>
                                    <li>
                                        <strong>Dung lượng - </strong> <?= htmlspecialchars($marketing->mkt_dungluong) ?>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>

                    

                </div>

                <div class="feedback">
                    <div class="card">
                        <form name="frmComment" id="frmComment" method="post" action="">
                                <h5>Góp ý</h5>
                                <h6>Email của bạn sẽ không được hiển thị công khai. </h6>
                                <div class="row form-comment">
                                    <div class="col">
                                    <!-- Nội dung: -->
                                    <textarea name="kh_binhluan" id="kh_binhluan" class="form-control " placeholder="Nội dung góp ý" ></textarea>
                                    </br>
                                    <button name="btnFeedback" id="btnFeedback" class="btn btn-primary btnSave" >
                                    Gửi góp ý
                                    </button>


                                    </div>
                                </div>
                        </form>
                    </div>
                </div>

                <?php
                        
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            $kh_tendangnhap_logged=htmlspecialchars($_SESSION['kh_tendangnhap_logged']);
                            if (!isset($kh_tendangnhap_logged) ) {
                                $message = "Bạn chưa đăng nhập nên không được phép gửi bình luận! Vui lòng đăng nhập!!!";
                                echo "<script type='text/javascript'>alert('$message');</script>";
                                echo '<script>location.href = "/index.php";</script>';
                            } else {
                                
                                $customer = new Customer($PDO);
                                $customer->find($kh_tendangnhap_logged);
		                        $customer->fill($_POST);
                                $customer->update($_POST);
                                
                                $message = "Bình luận thành công và đang chờ kiểm duyệt!";
                                echo "<script type='text/javascript'>alert('$message');</script>";
                                echo '<script>location.href = "/index.php";</script>';

                            }
                            

                        }

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

    <script>
        function addSanPhamVaoGioHang() {
            // Chuẩn bị dữ liệu gởi
            var dulieugoi = {
                sp_ma: $('#sp_ma').val(),
                sp_ten: $('#sp_ten').val(),
                sp_gia: $('#sp_gia').val(),
                hinhdaidien: $('#hinhdaidien').val(),
                soluong: $('#soluong').val(),
            };
            // console.log((dulieugoi));

            // Gọi AJAX đến API ở URL ``
            $.ajax({
                url: '/user/api/CartAddProduct.php',
                method: "POST",
                dataType: 'json',
                data: dulieugoi,
                success: function(data) {
                    console.log(data);
                    var htmlString =
                        `Sản phẩm đã được thêm vào Giỏ hàng. <a href="cart.php">Xem Giỏ hàng</a>.`;
                    $('#thongbao').html(htmlString);
                    // Hiện thông báo
                    $('.alert').removeClass('d-none').addClass('show');
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

        // Đăng ký sự kiện cho nút Thêm vào giỏ hàng
        $('#btnThemVaoGioHang').click(function(event) {
            event.preventDefault();
            addSanPhamVaoGioHang();
        });
    </script>


</body>
</html>