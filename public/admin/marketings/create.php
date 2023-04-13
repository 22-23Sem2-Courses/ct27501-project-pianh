<?php

    if (session_id() === '') {
        session_start();
    }

    if (!isset($_SESSION['kh_tendangnhap_logged'])){
        echo '<script>location.href = "/admin/auth/login.php";</script>';
    }
    require_once '../../../bootstrap.php';

    $kh_tendangnhap_logged=htmlspecialchars($_SESSION['kh_tendangnhap_logged']);

    if ($kh_tendangnhap_logged !='admin' ) {
        $message = "Bạn không phải là thành viên quản trị website! Bạn không được phép truy cập vào trang này!!!!";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo '<script>location.href = "/index.php";</script>';
    }

    use DientuCT\Project\Marketing;
    use DientuCT\Project\Product;

    $product = new Product($PDO);
    $products = $product->all();

	$errors = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $marketing = new Marketing($PDO);
        $marketing->fill($_POST);
        // var_dump($marketing);
        // die;
        if ($marketing->validate()) {
            $marketing->save() && redirect(BASE_URL_PATH .'admin/marketings/index.php' );
        } 
        $errors = $marketing->getValidationErrors();
        }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Thêm mới Marketing cho sản phẩm</title>
	    <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?= BASE_URL_PATH . "assets/admin/css/bootstrap.min.css" ?>" type="text/css" />
    <!-- Font awesome -->
    <link rel="stylesheet" href="<?= BASE_URL_PATH . "assets/admin/css/font-awesome.min.css" ?>" type="text/css" />
    <!-- Datatables CSS -->
    <link rel="stylesheet" href="<?= BASE_URL_PATH . "assets/admin/css/datatables.min.css" ?>" type="text/css" />
    <!-- Animate CSS -->
    <link rel="stylesheet" href="<?= BASE_URL_PATH . "assets/admin/css/animate.css" ?>" type="text/css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= BASE_URL_PATH . "assets/admin/css/base.css" ?>" type="text/css" />
    <link rel="stylesheet" href="<?= BASE_URL_PATH . "assets/admin/css/styles.css" ?>" type="text/css" />
    <link rel="stylesheet" href="<?= BASE_URL_PATH . "assets/admin/css/responsive.css" ?>" type="text/css" />
</head>

<body>

    <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);     
    ?>

    <?php include_once __DIR__ . '../../../../partials/admin/header.php'; ?>

    <div class="container-fluid">

        <div class="main row">
            <?php include_once __DIR__ . '../../../../partials/admin/sidebar.php'; ?>

            <div class="main__outer">
                <div class="main__inner">
                    <!-- Page Title -->
                    <div class="page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading wow fadeIn" data-wow-delay="0.05s">
                                <div class="page-title-icon"><i class="fa fa-briefcase" aria-hidden="true"></i></div>
                                <div >
                                    Thêm mới Marketing cho sản phẩm
                                    <div class="page-title-subheading">Thêm mới Marketing cho sản phẩm của bạn.</div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                    <!-- Table Content -->
                    <div class="tabs-animation">
                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fa fa-table" aria-hidden="true"></i>
                                Form thêm mới Marketing cho sản phẩm
                            </div>
                            <div class="card-body">

                                <form name="frmCreate" id="frmCreate" action=""  method="post" class="justify-content-center">
                                
                                    <!-- Tên sản phẩm -> Gửi mã sản phẩm cho Server-->
                                    <div class="form-group<?= isset($errors['sp_ma']) ? ' has-error' : '' ?>">
                                        <label for="sp_ma">Tên sản phẩm</label>
                                        <select name="sp_ma" id="sp_ma" class="form-control">
                                            <option value="">Vui lòng chọn sản phẩm</option>
                                            <?php foreach($products as $product): ?>
                                                <option value="<?=htmlspecialchars($product->sp_ma)?>"><?=htmlspecialchars($product->sp_ten)?></option>
                                            <?php endforeach; ?>
                                        </select>

                                        <?php if (isset($errors['sp_ma'])) : ?>
                                            <span class="help-block">
                                                <strong><?= htmlspecialchars($errors['sp_ma']) ?></strong>
                                            </span>
                                        <?php endif ?>
                                    </div>

                                    <!-- Tình trạng, bộ sản phẩm -->
                                    <div class="form-row">
                                        <div class="col-sm-6 form-group<?= isset($errors['mkt_tinhtrang']) ? ' has-error' : '' ?>">
                                            <label for="mkt_tinhtrang">Tình trạng</label>
                                            <textarea name="mkt_tinhtrang" id="mkt_tinhtrang" class="form-control" maxlen="255" placeholder="Nhập vào tình trạng (Tối đa 255 kí tự)"><?= isset($_POST['mkt_tinhtrang']) ? htmlspecialchars($_POST['mkt_tinhtrang']) : '' ?></textarea>
                                            
                                            <?php if (isset($errors['mkt_tinhtrang'])) : ?>
                                                <span class="help-block">
                                                    <strong><?= htmlspecialchars($errors['mkt_tinhtrang']) ?></strong>
                                                </span>
                                            <?php endif ?>
                                        </div>

                                        <div class="col-sm-6 form-group<?= isset($errors['mkt_bosanpham']) ? ' has-error' : '' ?>">
                                            <label for="mkt_bosanpham">Bộ sản phẩm</label>
                                            <textarea name="mkt_bosanpham" id="mkt_bosanpham" class="form-control" maxlen="255" placeholder="Nhập vào bộ sản phẩm (Tối đa 255 kí tự)"><?= isset($_POST['mkt_bosanpham']) ? htmlspecialchars($_POST['mkt_bosanpham']) : '' ?></textarea>

                                            <?php if (isset($errors['mkt_bosanpham'])) : ?>
                                                <span class="help-block">
                                                    <strong><?= htmlspecialchars($errors['mkt_bosanpham']) ?></strong>
                                                </span>
                                            <?php endif ?>
                                        </div>
                                    </div>

                                    <!-- Bảo hành, hiệu năng -->
                                    <div class="form-row">
                                        <div class="col-sm-6 form-group<?= isset($errors['mkt_baohanh']) ? ' has-error' : '' ?>">
                                            <label for="mkt_baohanh">Bảo hành</label>
                                            <textarea name="mkt_baohanh" id="mkt_baohanh" class="form-control" maxlen="255" placeholder="Nhập vào thông tin bảo hành (Tối đa 255 kí tự)"><?= isset($_POST['mkt_baohanh']) ? htmlspecialchars($_POST['mkt_baohanh']) : '' ?></textarea>

                                            <?php if (isset($errors['mkt_baohanh'])) : ?>
                                                <span class="help-block">
                                                    <strong><?= htmlspecialchars($errors['mkt_baohanh']) ?></strong>
                                                </span>
                                            <?php endif ?>
                                        </div>

                                        <div class="col-sm-6 form-group<?= isset($errors['mkt_hieunang']) ? ' has-error' : '' ?>">
                                            <label for="mkt_hieunang">Hiệu năng</label>
                                            <textarea name="mkt_hieunang" id="mkt_hieunang" class="form-control" maxlen="255" placeholder="Nhập vào thông tin hiệu năng (Tối đa 255 kí tự)"><?= isset($_POST['mkt_hieunang']) ? htmlspecialchars($_POST['mkt_hieunang']) : '' ?></textarea>

                                            <?php if (isset($errors['mkt_hieunang'])) : ?>
                                                <span class="help-block">
                                                    <strong><?= htmlspecialchars($errors['mkt_hieunang']) ?></strong>
                                                </span>
                                            <?php endif ?>
                                        </div>
                                    </div>

                                    <!-- Hiển thị, Trải nghiệm -->
                                    <div class="form-row">
                                        <div class="col-sm-6 form-group<?= isset($errors['mkt_hienthi']) ? ' has-error' : '' ?>">
                                            <label for="mkt_hienthi">Không gian hiển thị</label>
                                            <!-- <input type="text" name="mkt_hienthi" class="form-control" maxlen="255" id="mkt_hienthi" placeholder="Hiển thị" value="<?= isset($_POST['mkt_hienthi']) ? htmlspecialchars($_POST['mkt_hienthi']) : '' ?>" /> -->
                                            <textarea name="mkt_hienthi" id="mkt_hienthi" class="form-control" maxlen="255" placeholder="Nhập vào thông tin hiển thị (Tối đa 255 kí tự)"><?= isset($_POST['mkt_hienthi']) ? htmlspecialchars($_POST['mkt_hienthi']) : '' ?></textarea>

                                            <?php if (isset($errors['mkt_hienthi'])) : ?>
                                                <span class="help-block">
                                                    <strong><?= htmlspecialchars($errors['mkt_hienthi']) ?></strong>
                                                </span>
                                            <?php endif ?>
                                        </div>

                                        <div class="col-sm-6 form-group<?= isset($errors['mkt_trainghiem']) ? ' has-error' : '' ?>">
                                            <label for="mkt_trainghiem">Trải nghiệm</label>
                                            <!-- <input type="text" name="mkt_trainghiem" class="form-control"  maxlen="255" id="mkt_trainghiem" placeholder="Trải nghiệm" value="<?= isset($_POST['mkt_trainghiem']) ? htmlspecialchars($_POST['mkt_trainghiem']) : '' ?>" /> -->
                                            <textarea name="mkt_trainghiem" id="mkt_trainghiem" class="form-control" maxlen="255" placeholder="Nhập vào thông tin trải nghiệm (Tối đa 255 kí tự)"><?= isset($_POST['mkt_trainghiem']) ? htmlspecialchars($_POST['mkt_trainghiem']) : '' ?></textarea>

                                            <?php if (isset($errors['mkt_trainghiem'])) : ?>
                                                <span class="help-block">
                                                    <strong><?= htmlspecialchars($errors['mkt_trainghiem']) ?></strong>
                                                </span>
                                            <?php endif ?>
                                        </div>
                                    </div>

                                    <!-- Điện năng, Dung lượng  -->
                                    <div class="form-row">
                                        <div class="col-sm-6 form-group<?= isset($errors['mkt_diennang']) ? ' has-error' : '' ?>">
                                            <label for="mkt_diennang">Điện năng</label>
                                            <textarea name="mkt_diennang" id="mkt_diennang" class="form-control" maxlen="255" placeholder="Nhập vào thông tin điện năng (Tối đa 255 kí tự)"><?= isset($_POST['mkt_diennang']) ? htmlspecialchars($_POST['mkt_diennang']) : '' ?></textarea>

                                            <?php if (isset($errors['mkt_diennang'])) : ?>
                                                <span class="help-block">
                                                    <strong><?= htmlspecialchars($errors['mkt_diennang']) ?></strong>
                                                </span>
                                            <?php endif ?>
                                        </div>

                                        <div class="col-sm-6 form-group<?= isset($errors['mkt_dungluong']) ? ' has-error' : '' ?>">
                                            <label for="mkt_dungluong">Dung lượng</label>
                                            <textarea name="mkt_dungluong" id="mkt_dungluong" class="form-control" maxlen="255" placeholder="Nhập vào thông tin dung lượng (Tối đa 255 kí tự)"><?= isset($_POST['mkt_dungluong']) ? htmlspecialchars($_POST['mkt_dungluong']) : '' ?></textarea>

                                            <?php if (isset($errors['mkt_dungluong'])) : ?>
                                                <span class="help-block">
                                                    <strong><?= htmlspecialchars($errors['mkt_dungluong']) ?></strong>
                                                </span>
                                            <?php endif ?>
                                        </div>
                                    </div>

                                    <!-- Tính năng, Quà tặng -->
                                    <div class="form-row">
                                        <div class="col-sm-6 form-group<?= isset($errors['mkt_tinhnang']) ? ' has-error' : '' ?>">
                                            <label for="mkt_tinhnang">Tính năng</label>
                                            <textarea name="mkt_tinhnang" id="mkt_tinhnang" class="form-control" maxlen="255" placeholder="Nhập vào thông tin tính năng (Tối đa 255 kí tự)"><?= isset($_POST['mkt_tinhnang']) ? htmlspecialchars($_POST['mkt_tinhnang']) : '' ?></textarea>

                                            <?php if (isset($errors['mkt_tinhnang'])) : ?>
                                                <span class="help-block">
                                                    <strong><?= htmlspecialchars($errors['mkt_tinhnang']) ?></strong>
                                                </span>
                                            <?php endif ?>
                                        </div>

                                        <div class="col-sm-6 form-group<?= isset($errors['mkt_quatang']) ? ' has-error' : '' ?>">
                                            <label for="mkt_quatang">Quà tặng</label>
                                            <textarea type="textarea" name="mkt_quatang" class="form-control" maxlen="255" id="mkt_quatang" placeholder="Nhập vào thông tin quà tặng (Tối đa 255 kí tự)"><?= isset($_POST['mkt_quatang']) ? htmlspecialchars($_POST['mkt_quatang']) : '' ?></textarea>
                                            <?php if (isset($errors['mkt_quatang'])) : ?>
                                                <span class="help-block">
                                                    <strong><?= htmlspecialchars($errors['mkt_quatang']) ?></strong>
                                                </span>
                                            <?php endif ?>
                                        </div>
                                    </div>

                                    <!-- Submit -->
                                    <button type="submit" name="submit" id="submit" class="btn btn-primary mt-3">Thêm mới Marketing cho sản phẩm</button>
                                </form>   
                                

                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
        </div>
    </div>
                
    <?php include_once __DIR__ . '../../../../partials/admin/footer.php'; ?>
    <!-- jQuery JS -->
    <script src="<?= BASE_URL_PATH . "assets/admin/js/jquery.min.js" ?>"></script>
    <!-- Bootstrap JS -->
    <script src="<?= BASE_URL_PATH . "assets/admin/js/bootstrap.min.js" ?>"></script>
    <!-- Wow js -->
    <script src="<?= BASE_URL_PATH . "assets/admin/js/wow.min.js" ?>"></script>
    <!-- SweetAlert JS-->
    <script src="<?= BASE_URL_PATH . "assets/admin/js/sweetalert.js" ?>"></script>
    <script src="<?= BASE_URL_PATH . "assets/admin/js/sweetalert.min.js" ?>"></script>
    <!-- Chart JS-->
    <script src="<?= BASE_URL_PATH . "assets/admin/js/chart.min.js" ?>"></script>
    <!-- DataTable JS -->   
   <script src="<?= BASE_URL_PATH . "assets/admin/js/datatables.min.js" ?>"></script>
   <script src="<?= BASE_URL_PATH . "assets/admin/js/buttons.bootstrap4.min.js" ?>"></script>
   <script src="<?= BASE_URL_PATH . "assets/admin/js/pdfmake.min.js" ?>"></script>
   <script src="<?= BASE_URL_PATH . "assets/admin/js/vfs_fonts.js" ?>"></script>
    <!-- Custom JS -->
    <script src="<?= BASE_URL_PATH . "assets/admin/js/app.js" ?>"></script>

    <script>
        $(document).ready(function() {
            //Gọi wow js
            new WOW().init();

            //Header toggle-mobile click
            $('#header__toggle-mobile').click(function() {
                // alert('ok');
                $('.header__content').slideToggle();
            })
            
        });
    </script>

</body>

</html>