<?php
    if (session_id() === '') {
        session_start();
    }

    if (!isset($_SESSION['kh_tendangnhap_logged'])){
        echo '<script>location.href = "/admin/auth/login.php";</script>';
    }
    require_once '../../../bootstrap.php';

    use DientuCT\Project\Product;

	$errors = [];

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$product = new Product($PDO);
		$product->fill($_POST);
        // var_dump($product);
        // die;
		if ($product->validate()) {
			$product->save() && redirect(BASE_URL_PATH .'admin/products/index.php' );
		} 
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
	<title>Thêm mới sản phẩm</title>
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../assets/admin/css/bootstrap.min.css" type="text/css" />
    <!-- Font awesome -->
    <link rel="stylesheet" href="../../assets/admin/css/font-awesome.min.css" type="text/css" />
    <!-- Datatables CSS -->
    <link href="../../assets/admin/css/datatables.min.css" rel="stylesheet"/>
    <!-- Animate CSS -->
    <link href="../../assets/admin/css/animate.css" rel="stylesheet"/>
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
                                    Thêm mới sản phẩm
                                    <div class="page-title-subheading">Thêm mới sản phẩm vào danh sách của bạn.</div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <!-- Table Content -->
                    <div class="tabs-animation">
                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fa fa-table" aria-hidden="true"></i>
                                Form thêm mới Sản phẩm
                            </div>
                            <div class="card-body">

                                <form name="frmCreate" id="frmCreate" action=""  method="post" class="justify-content-center">
                                
                                    <!-- Tên sản phẩm -->
                                    <div class="form-group<?= isset($errors['sp_ten']) ? ' has-error' : '' ?>">
                                        <label for="sp_ten">Tên sản phẩm</label>
                                        <input type="text" name="sp_ten" class="form-control" maxlen="100" id="sp_ten" placeholder="Tên sản phẩm" value="<?= isset($_POST['sp_ten']) ? htmlspecialchars($_POST['sp_ten']) : '' ?>" />

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
                                            <input type="number" name="sp_soluong" class="form-control" id="sp_soluong" placeholder="Số lượng" value="<?= isset($_POST['sp_soluong']) ? htmlspecialchars($_POST['sp_soluong']) : '' ?>" />

                                            <?php if (isset($errors['sp_soluong'])) : ?>
                                                <span class="help-block">
                                                    <strong><?= htmlspecialchars($errors['sp_soluong']) ?></strong>
                                                </span>
                                            <?php endif ?>
                                        </div>

                                        <div class="col-sm-4 form-group<?= isset($errors['sp_dophangiai']) ? ' has-error' : '' ?>">
                                            <label for="sp_dophangiai">Độ phân giải</label>
                                            <input type="text" name="sp_dophangiai" class="form-control" id="sp_dophangiai" placeholder="Độ phân giải" value="<?= isset($_POST['sp_dophangiai']) ? htmlspecialchars($_POST['sp_dophangiai']) : '' ?>" />

                                            <?php if (isset($errors['sp_dophangiai'])) : ?>
                                                <span class="help-block">
                                                    <strong><?= htmlspecialchars($errors['sp_dophangiai']) ?></strong>
                                                </span>
                                            <?php endif ?>
                                        </div>

                                        <div class="col-sm-4 form-group<?= isset($errors['sp_manhinh']) ? ' has-error' : '' ?>">
                                            <label for="sp_manhinh">Màn hình</label>
                                            <input type="text" name="sp_manhinh" class="form-control" id="sp_manhinh" placeholder="Màn hình" value="<?= isset($_POST['sp_manhinh']) ? htmlspecialchars($_POST['sp_manhinh']) : '' ?>" />

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
                                            <input type="text" name="sp_camera_truoc" class="form-control" id="sp_camera_truoc" placeholder="Camera trước" value="<?= isset($_POST['sp_camera_truoc']) ? htmlspecialchars($_POST['sp_camera_truoc']) : '' ?>" />

                                            <?php if (isset($errors['sp_camera_truoc'])) : ?>
                                                <span class="help-block">
                                                    <strong><?= htmlspecialchars($errors['sp_camera_truoc']) ?></strong>
                                                </span>
                                            <?php endif ?>
                                        </div>

                                        <div class="col-sm-4 form-group<?= isset($errors['sp_camera_sau']) ? ' has-error' : '' ?>">
                                            <label for="sp_camera_sau">Camera sau</label>
                                            <input type="text" name="sp_camera_sau" class="form-control" id="sp_camera_sau" placeholder="Camera sau" value="<?= isset($_POST['sp_camera_sau']) ? htmlspecialchars($_POST['sp_camera_sau']) : '' ?>" />

                                            <?php if (isset($errors['sp_camera_sau'])) : ?>
                                                <span class="help-block">
                                                    <strong><?= htmlspecialchars($errors['sp_camera_sau']) ?></strong>
                                                </span>
                                            <?php endif ?>
                                        </div>

                                        <div class="col-sm-4 form-group<?= isset($errors['sp_hedieuhanh']) ? ' has-error' : '' ?>">
                                            <label for="sp_hedieuhanh">Hệ điều hành</label>
                                            <input type="text" name="sp_hedieuhanh" class="form-control" id="sp_hedieuhanh" placeholder="Hệ điều hành" value="<?= isset($_POST['sp_hedieuhanh']) ? htmlspecialchars($_POST['sp_hedieuhanh']) : '' ?>" />

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
                                            <input type="text" name="sp_chip" class="form-control" id="sp_chip" placeholder="Chip sản phẩm" value="<?= isset($_POST['sp_chip']) ? htmlspecialchars($_POST['sp_chip']) : '' ?>" />

                                            <?php if (isset($errors['sp_chip'])) : ?>
                                                <span class="help-block">
                                                    <strong><?= htmlspecialchars($errors['sp_chip']) ?></strong>
                                                </span>
                                            <?php endif ?>
                                        </div>

                                        <div class="col-sm-4 form-group<?= isset($errors['sp_ram']) ? ' has-error' : '' ?>">
                                            <label for="sp_ram">Ram sản phẩm</label>
                                            <input type="text" name="sp_ram" class="form-control" id="sp_ram" placeholder="Ram sản phẩm" value="<?= isset($_POST['sp_ram']) ? htmlspecialchars($_POST['sp_ram']) : '' ?>" />

                                            <?php if (isset($errors['sp_ram'])) : ?>
                                                <span class="help-block">
                                                    <strong><?= htmlspecialchars($errors['sp_ram']) ?></strong>
                                                </span>
                                            <?php endif ?>
                                        </div>

                                        <div class="col-sm-4 form-group<?= isset($errors['sp_rom']) ? ' has-error' : '' ?>">
                                            <label for="sp_rom">Rom sản phẩm</label>
                                            <input type="text" name="sp_rom" class="form-control" id="sp_rom" placeholder="Rom sản phẩm" value="<?= isset($_POST['sp_rom']) ? htmlspecialchars($_POST['sp_rom']) : '' ?>" />

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
                                            <input type="text" name="sp_pin" class="form-control" id="sp_pin" placeholder="Pin sản phẩm" value="<?= isset($_POST['sp_pin']) ? htmlspecialchars($_POST['sp_pin']) : '' ?>" />

                                            <?php if (isset($errors['sp_pin'])) : ?>
                                                <span class="help-block">
                                                    <strong><?= htmlspecialchars($errors['sp_pin']) ?></strong>
                                                </span>
                                            <?php endif ?>
                                        </div>

                                        <div class="col-sm-4 form-group<?= isset($errors['sp_nsx']) ? ' has-error' : '' ?>">
                                            <label for="sp_nsx">Nhà sản xuất</label>
                                            <input type="text" name="sp_nsx" class="form-control" id="sp_nsx" placeholder="Nhà sản xuất" value="<?= isset($_POST['sp_nsx']) ? htmlspecialchars($_POST['sp_nsx']) : '' ?>" />

                                            <?php if (isset($errors['sp_nsx'])) : ?>
                                                <span class="help-block">
                                                    <strong><?= htmlspecialchars($errors['sp_nsx']) ?></strong>
                                                </span>
                                            <?php endif ?>
                                        </div>

                                        <div class="col-sm-4 form-group<?= isset($errors['sp_lsp']) ? ' has-error' : '' ?>">
                                            <label for="sp_lsp">Loại sản phẩm</label>
                                            <input type="text" name="sp_lsp" class="form-control" id="sp_lsp" placeholder="Loại sản phẩm" value="<?= isset($_POST['sp_lsp']) ? htmlspecialchars($_POST['sp_lsp']) : '' ?>" />

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
                                            <input type="text" name="sp_gia" class="form-control" id="sp_gia" placeholder="Giá sản phẩm" value="<?= isset($_POST['sp_gia']) ? htmlspecialchars($_POST['sp_gia']) : '' ?>" />

                                            <?php if (isset($errors['sp_gia'])) : ?>
                                                <span class="help-block">
                                                    <strong><?= htmlspecialchars($errors['sp_gia']) ?></strong>
                                                </span>
                                            <?php endif ?>
                                        </div>

                                        <div class="col-sm-4 form-group<?= isset($errors['sp_giacu']) ? ' has-error' : '' ?>">
                                            <label for="sp_giacu">Giá cũ (Giá chưa giảm)</label>
                                            <input type="text" name="sp_giacu" class="form-control" id="sp_giacu" placeholder="Giá cũ (Giá chưa giảm)" value="<?= isset($_POST['sp_giacu']) ? htmlspecialchars($_POST['sp_giacu']) : '' ?>" />

                                            <?php if (isset($errors['sp_giacu'])) : ?>
                                                <span class="help-block">
                                                    <strong><?= htmlspecialchars($errors['sp_giacu']) ?></strong>
                                                </span>
                                            <?php endif ?>
                                        </div>

                                        <div class="col-sm-4 form-group<?= isset($errors['sp_km']) ? ' has-error' : '' ?>">
                                            <label for="sp_km">Khuyến mãi</label>
                                            <input type="text" name="sp_km" class="form-control" id="sp_km" placeholder="Khuyến mãi" value="<?= isset($_POST['sp_km']) ? htmlspecialchars($_POST['sp_km']) : '' ?>" />

                                            <?php if (isset($errors['sp_km'])) : ?>
                                                <span class="help-block">
                                                    <strong><?= htmlspecialchars($errors['sp_km']) ?></strong>
                                                </span>
                                            <?php endif ?>
                                        </div>

                                    </div>

                                    <!-- Submit -->
                                    <button type="submit" name="submit" id="submit" class="btn btn-primary mt-3">Thêm mới sản phẩm</button>
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
    <script src="../../assets/admin/js/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="../../assets/admin/js/bootstrap.min.js"></script>
    <!-- Wow js -->
    <script src="../../assets/admin/js/wow.min.js"></script>
    <!-- SweetAlert JS-->
    <script src="../../assets/admin/js/sweetalert.js"></script>
    <script src="../../assets/admin/js/sweetalert.min.js"></script>
    <!-- Chart JS-->
    <script src="../../assets/admin/js/chart.min.js"></script>
    <!-- DataTable JS -->
    <script src="../../assets/admin/js/datatables.min.js"></script>
    <script src="../../assets/admin/js/buttons.bootstrap4.min.js"></script>
    <script src="../../assets/admin/js/pdfmake.min.js"></script>
    <script src="../../assets/admin/js/vfs_fonts.js"></script>
    <!-- Custom JS -->
    <script src="../../assets/admin/js/app.js"></script>

</body>

</html>