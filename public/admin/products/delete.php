<?php
    if (session_id() === '') {
        session_start();
    }

    if (!isset($_SESSION['kh_tendangnhap_logged'])){
        echo '<script>location.href = "/admin/auth/login.php";</script>';
    }
    require_once '../../../bootstrap.php';
    use DientuCT\Project\Product;
    $product = new Product($PDO);

    $sp_ma = isset($_REQUEST['sp_ma']) ?
        filter_var($_REQUEST['sp_ma'], FILTER_SANITIZE_NUMBER_INT) : -1;

        if ($sp_ma < 0 || !($product->find($sp_ma))) {
            redirect(BASE_URL_PATH .'admin/products/index.php');
        }

    $errors = [];

?>

<?php
    // Khi người dùng bấm lưu thì tiến hành xử lý
    if (
        $_SERVER['REQUEST_METHOD'] === 'POST'
        && isset($_POST['submit'])
        && isset($_POST['sp_ma'])
        && ($product->find($_POST['sp_ma'])) !== null
    ) {
        $product->delete();
        echo '<script>location.href = "index.php"; </script>';
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Meta -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xóa sản phẩm</title>
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
                    <div class="page-title wow fadeIn" data-wow-delay="0.05s">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading wow fadeIn" data-wow-duration="1s">
                                <div class="page-title-icon"><i class="fa fa-users" aria-hidden="true"></i></div>
                                <div>
                                    Xóa sản phẩm
                                    <div class="page-title-subheading wow fadeIn" data-wow-duration="2s">Xóa sản phẩm khỏi danh sách của bạn.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Table Content -->
                    <div class="tabs-animation">
                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fa fa-table" aria-hidden="true"></i>
                                Table Xóa Sản phẩm
                            </div>
                            <div class="card-body">
                                <!-- Form xóa sản phẩm -->
                                <form name="frmDelete" id="frmDelete" method="post"  action="">
                                        <div class="form-row">
                                            <div class="col-sm-2 form-group<?= isset($errors['sp_ma']) ? ' has-error' : '' ?>">
                                                <label for="sp_ma">Mã/ID sản phẩm (*)</label>
                                                <input type="text" name="sp_ma" class="form-control" readonly id="sp_ma" placeholder="Mã/ID sản phẩm" value="<?= $product->getSp_ma() ?>" />
                                            </div>

                                            <div class="col-sm-7 form-group<?= isset($errors['sp_ten']) ? ' has-error' : '' ?>">
                                                <label for="sp_ten">Tên sản phẩm</label>
                                                <input type="text" name="sp_ten" class="form-control" readonly id="sp_ten" placeholder="Tên sản phẩm" value="<?= htmlspecialchars($product->sp_ten) ?>" />
                                            </div>

                                            <div class="col-sm-3 form-group<?= isset($errors['sp_lsp']) ? ' has-error' : '' ?>">
                                                <label for="sp_lsp">Loại sản phẩm</label>
                                                <input type="text" name="sp_lsp" class="form-control" readonly id="sp_lsp" placeholder="Loại sản phẩm" value="<?= htmlspecialchars($product->sp_lsp) ?>" />
                                            </div>
                                            
                                        </div>

                                    <button name="submit" id="submit" class="btn btn-danger mt-3">
                                        Xóa sản phẩm
                                    </button>
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