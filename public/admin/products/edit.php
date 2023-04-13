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
    
    use DientuCT\Project\Product;
    $product = new Product($PDO);

    $sp_ma = isset($_REQUEST['sp_ma']) ?
        filter_var($_REQUEST['sp_ma'], FILTER_SANITIZE_NUMBER_INT) : -1;

        if ($sp_ma < 0 || !($product->find($sp_ma))) {
            redirect(BASE_URL_PATH .'admin/products/index.php');
        }

    $errors = [];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($product->update($_POST)) {
            // Cập nhật dữ liệu thành công
            redirect(BASE_URL_PATH .'admin/products/index.php');
        } 
        // Cập nhật dữ liệu không thành công
        $errors = $product->getValidationErrors();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Meta -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật sản phẩm</title>
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
                    <div class="page-title wow fadeIn" data-wow-delay="0.05s">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading wow fadeIn" data-wow-duration="1s">
                                <div class="page-title-icon"><i class="fa fa-briefcase" aria-hidden="true"></i></div>
                                <div>
                                    Chỉnh sửa sản phẩm
                                    <div class="page-title-subheading wow fadeIn" data-wow-duration="2s">Chỉnh sửa thông tin sản phẩm của bạn.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Table Content -->
                    <div class="tabs-animation">
                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fa fa-table" aria-hidden="true"></i>
                                Form chỉnh sửa thông tin Sản phẩm
                            </div>
                            <div class="card-body">

                                <form name="frmEdit" id="frmEdit" action=""  method="post" class="justify-content-center">
                                    
                                    <input type="hidden" name="sp_ma" value="<?= htmlspecialchars($product->getSp_ma()) ?>">
                                        <!-- Tên sản phẩm -->
                                        <div class="form-group<?= isset($errors['sp_ten']) ? ' has-error' : '' ?>">
                                            <label for="sp_ten">Tên sản phẩm</label>
                                            <input type="text" name="sp_ten" class="form-control" maxlen="100" id="sp_ten" placeholder="Tên sản phẩm" value="<?= htmlspecialchars($product->sp_ten) ?>" />

                                            <?php if (isset($errors['sp_ten'])) : ?>
                                                <span class="help-block">
                                                    <strong><?= htmlspecialchars($errors['sp_ten']) ?></strong>
                                                </span>
                                            <?php endif ?>
                                        </div>
                                        
                                        <!-- Số lượng, độ phân giải, màn hình -->
                                        <div class="form-row">
                                            <div class="col-sm-4 form-group<?= isset($errors['sp_soluong']) ? ' has-error' : '' ?>">
                                                <label for="sp_soluong">Số lượng</label>
                                                <input type="number" name="sp_soluong" class="form-control" id="sp_soluong" placeholder="Số lượng" value="<?= htmlspecialchars($product->sp_soluong) ?>" />

                                                <?php if (isset($errors['sp_soluong'])) : ?>
                                                    <span class="help-block">
                                                        <strong><?= htmlspecialchars($errors['sp_soluong']) ?></strong>
                                                    </span>
                                                <?php endif ?>
                                            </div>

                                            <div class="col-sm-4 form-group<?= isset($errors['sp_dophangiai']) ? ' has-error' : '' ?>">
                                                <label for="sp_dophangiai">Độ phân giải</label>
                                                <input type="text" name="sp_dophangiai" class="form-control" id="sp_dophangiai" placeholder="Độ phân giải" value="<?= htmlspecialchars($product->sp_dophangiai) ?>" />

                                                <?php if (isset($errors['sp_dophangiai'])) : ?>
                                                    <span class="help-block">
                                                        <strong><?= htmlspecialchars($errors['sp_dophangiai']) ?></strong>
                                                    </span>
                                                <?php endif ?>
                                            </div>

                                            <div class="col-sm-4 form-group<?= isset($errors['sp_manhinh']) ? ' has-error' : '' ?>">
                                                <label for="sp_manhinh">Màn hình</label>
                                                <input type="text" name="sp_manhinh" class="form-control" id="sp_manhinh" placeholder="Màn hình" value="<?= htmlspecialchars($product->sp_manhinh) ?>" />

                                                <?php if (isset($errors['sp_manhinh'])) : ?>
                                                    <span class="help-block">
                                                        <strong><?= htmlspecialchars($errors['sp_manhinh']) ?></strong>
                                                    </span>
                                                <?php endif ?>
                                            </div>

                                        </div>

                                        <!-- Camera trước, camera sau, hệ điều hành -->
                                        <div class="form-row">
                                            <div class="col-sm-4 form-group<?= isset($errors['sp_camera_truoc']) ? ' has-error' : '' ?>">
                                                <label for="sp_camera_truoc">Camera trước</label>
                                                <input type="text" name="sp_camera_truoc" class="form-control" id="sp_camera_truoc" placeholder="Camera trước" value="<?= htmlspecialchars($product->sp_camera_truoc) ?>" />

                                                <?php if (isset($errors['sp_camera_truoc'])) : ?>
                                                    <span class="help-block">
                                                        <strong><?= htmlspecialchars($errors['sp_camera_truoc']) ?></strong>
                                                    </span>
                                                <?php endif ?>
                                            </div>

                                            <div class="col-sm-4 form-group<?= isset($errors['sp_camera_sau']) ? ' has-error' : '' ?>">
                                                <label for="sp_camera_sau">Camera sau</label>
                                                <input type="text" name="sp_camera_sau" class="form-control" id="sp_camera_sau" placeholder="Camera sau" value="<?= htmlspecialchars($product->sp_camera_sau) ?>" />

                                                <?php if (isset($errors['sp_camera_sau'])) : ?>
                                                    <span class="help-block">
                                                        <strong><?= htmlspecialchars($errors['sp_camera_sau']) ?></strong>
                                                    </span>
                                                <?php endif ?>
                                            </div>

                                            <div class="col-sm-4 form-group<?= isset($errors['sp_hedieuhanh']) ? ' has-error' : '' ?>">
                                                <label for="sp_hedieuhanh">Hệ điều hành</label>
                                                <input type="text" name="sp_hedieuhanh" class="form-control" id="sp_hedieuhanh" placeholder="Hệ điều hành" value="<?= htmlspecialchars($product->sp_hedieuhanh) ?>" />

                                                <?php if (isset($errors['sp_hedieuhanh'])) : ?>
                                                    <span class="help-block">
                                                        <strong><?= htmlspecialchars($errors['sp_hedieuhanh']) ?></strong>
                                                    </span>
                                                <?php endif ?>
                                            </div>

                                        </div>

                                        <!-- Chip, ram, rom  -->
                                        <div class="form-row">
                                            <div class="col-sm-4 form-group<?= isset($errors['sp_chip']) ? ' has-error' : '' ?>">
                                                <label for="sp_chip">Chip sản phẩm</label>
                                                <input type="text" name="sp_chip" class="form-control" id="sp_chip" placeholder="Chip sản phẩm" value="<?= htmlspecialchars($product->sp_chip) ?>" />

                                                <?php if (isset($errors['sp_chip'])) : ?>
                                                    <span class="help-block">
                                                        <strong><?= htmlspecialchars($errors['sp_chip']) ?></strong>
                                                    </span>
                                                <?php endif ?>
                                            </div>

                                            <div class="col-sm-4 form-group<?= isset($errors['sp_ram']) ? ' has-error' : '' ?>">
                                                <label for="sp_ram">Ram sản phẩm</label>
                                                <input type="text" name="sp_ram" class="form-control" id="sp_ram" placeholder="Ram sản phẩm" value="<?= htmlspecialchars($product->sp_ram) ?>" />

                                                <?php if (isset($errors['sp_ram'])) : ?>
                                                    <span class="help-block">
                                                        <strong><?= htmlspecialchars($errors['sp_ram']) ?></strong>
                                                    </span>
                                                <?php endif ?>
                                            </div>

                                            <div class="col-sm-4 form-group<?= isset($errors['sp_rom']) ? ' has-error' : '' ?>">
                                                <label for="sp_rom">Rom sản phẩm</label>
                                                <input type="text" name="sp_rom" class="form-control" id="sp_rom" placeholder="Rom sản phẩm" value="<?= htmlspecialchars($product->sp_rom) ?>" />

                                                <?php if (isset($errors['sp_rom'])) : ?>
                                                    <span class="help-block">
                                                        <strong><?= htmlspecialchars($errors['sp_rom']) ?></strong>
                                                    </span>
                                                <?php endif ?>
                                            </div>

                                        </div>

                                        <!-- Pin, nhà sản xuất, loại sản phẩm -->
                                        <div class="form-row">
                                            <div class="col-sm-4 form-group<?= isset($errors['sp_pin']) ? ' has-error' : '' ?>">
                                                <label for="sp_pin">Pin sản phẩm</label>
                                                <input type="text" name="sp_pin" class="form-control" id="sp_pin" placeholder="Pin sản phẩm" value="<?= htmlspecialchars($product->sp_pin) ?>" />

                                                <?php if (isset($errors['sp_pin'])) : ?>
                                                    <span class="help-block">
                                                        <strong><?= htmlspecialchars($errors['sp_pin']) ?></strong>
                                                    </span>
                                                <?php endif ?>
                                            </div>

                                            <div class="col-sm-4 form-group<?= isset($errors['sp_nsx']) ? ' has-error' : '' ?>">
                                                <label for="sp_nsx">Nhà sản xuất</label>
                                                <input type="text" name="sp_nsx" class="form-control" id="sp_nsx" placeholder="Nhà sản xuất" value="<?= htmlspecialchars($product->sp_nsx) ?>" />

                                                <?php if (isset($errors['sp_nsx'])) : ?>
                                                    <span class="help-block">
                                                        <strong><?= htmlspecialchars($errors['sp_nsx']) ?></strong>
                                                    </span>
                                                <?php endif ?>
                                            </div>

                                            <div class="col-sm-4 form-group<?= isset($errors['sp_lsp']) ? ' has-error' : '' ?>">
                                                <label for="sp_lsp">Loại sản phẩm</label>
                                                <input type="text" name="sp_lsp" class="form-control" id="sp_lsp" placeholder="Loại sản phẩm" value="<?= htmlspecialchars($product->sp_lsp) ?>" />

                                                <?php if (isset($errors['sp_lsp'])) : ?>
                                                    <span class="help-block">
                                                        <strong><?= htmlspecialchars($errors['sp_lsp']) ?></strong>
                                                    </span>
                                                <?php endif ?>
                                            </div>

                                        </div>

                                        <!-- Giá, Giá cũ, Khuyến mãi -->
                                        <div class="form-row">
                                            <div class="col-sm-4 form-group<?= isset($errors['sp_gia']) ? ' has-error' : '' ?>">
                                                <label for="sp_gia">Giá sản phẩm (vnđ)</label>
                                                <input type="text" name="sp_gia" class="form-control" id="sp_gia" placeholder="Giá sản phẩm" value="<?= htmlspecialchars(number_format( ($product->sp_gia) , 0, ".", ",")) ?>" />
                                                                                                                            

                                                <?php if (isset($errors['sp_gia'])) : ?>
                                                    <span class="help-block">
                                                        <strong><?= htmlspecialchars($errors['sp_gia']) ?></strong>
                                                    </span>
                                                <?php endif ?>
                                            </div>

                                            <div class="col-sm-4 form-group<?= isset($errors['sp_giacu']) ? ' has-error' : '' ?>">
                                                <label for="sp_giacu">Giá cũ (Giá chưa giảm)</label>
                                                <input type="text" name="sp_giacu" class="form-control" id="sp_giacu" placeholder="Giá cũ (Giá chưa giảm)" value="<?= htmlspecialchars(number_format( ($product->sp_giacu) , 0, ".", ",")) ?>" />

                                                <?php if (isset($errors['sp_giacu'])) : ?>
                                                    <span class="help-block">
                                                        <strong><?= htmlspecialchars($errors['sp_giacu']) ?></strong>
                                                    </span>
                                                <?php endif ?>
                                            </div>

                                            <div class="col-sm-4 form-group<?= isset($errors['sp_km']) ? ' has-error' : '' ?>">
                                                <label for="sp_km">Khuyến mãi</label>
                                                <input type="text" name="sp_km" class="form-control" id="sp_km" placeholder="Khuyến mãi" value="<?= htmlspecialchars($product->sp_km) ?>" />

                                                <?php if (isset($errors['sp_km'])) : ?>
                                                    <span class="help-block">
                                                        <strong><?= htmlspecialchars($errors['sp_km']) ?></strong>
                                                    </span>
                                                <?php endif ?>
                                            </div>

                                        </div>

                                        <!-- Submit -->
                                        <button type="submit" name="submit" id="submit" class="btn btn-primary mt-3">Cập nhật sản phẩm</button>
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