<?php
    if (session_id() === '') {
        session_start();
    }

    if (!isset($_SESSION['kh_tendangnhap_logged'])){
        echo '<script>location.href = "/admin/auth/login.php";</script>';
    }
    require_once '../../../bootstrap.php';
    
    use DientuCT\Project\ProductImage;
    $productImage = new ProductImage($PDO);

    
    $hsp_ma = isset($_REQUEST['hsp_ma']) ?
        filter_var($_REQUEST['hsp_ma'], FILTER_SANITIZE_NUMBER_INT) : -1;

    if ($hsp_ma < 0 || !($productImage->findProductImage($hsp_ma))) {
        redirect(BASE_URL_PATH .'admin/product-images/index.php');
    }

    $productImageDelete = $productImage->findProductImage($hsp_ma);
       
    $errors = [];

?>

<?php
    // Khi người dùng bấm lưu thì tiến hành xử lý
    if (
        $_SERVER['REQUEST_METHOD'] === 'POST'
        && isset($_POST['submit'])
        && isset($_POST['hsp_ma'])
        && ($productImage->find($_POST['hsp_ma'])) !== null
    ) {
        $file_name=$productImage->find($hsp_ma);
        $filePath = __DIR__ . '/../../assets/uploads/' .htmlspecialchars(($file_name->hsp_tentaptin));
        unlink($filePath);

        $productImage->delete();
        echo '<script>location.href = "index.php"; </script>';
    } 
?>


<!DOCTYPE html>
<html lang="en">
<head>

    <?php include_once __DIR__ . '../../layouts/meta.php'; ?>
    <title>Xóa hình ảnh sản phẩm</title>
    <?php include_once __DIR__ . '../../layouts/styles.php'; ?>

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
                                <div class="page-title-icon"><i class="fa fa-picture-o" aria-hidden="true"></i></div>
                                <div>
                                    Xóa Hình ảnh sản phẩm
                                    <div class="page-title-subheading wow fadeIn" data-wow-duration="2s">Xóa Hình ảnh khỏi sản phẩm của bạn.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Table Content -->
                    <div class="tabs-animation">
                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fa fa-table" aria-hidden="true"></i>
                                Table Xóa Hình ảnh sản phẩm
                            </div>
                            <div class="card-body">
                                <!-- Form xóa sản phẩm -->
                                <form name="frmDelete" id="frmDelete" method="post"  action="" >
                                    <input type="hidden" name="hsp_ma" value="<?= htmlspecialchars($productImage->getHsp_ma()) ?>">

                                    <!-- Hiển thị tên sản phẩm -> Gửi mã sản phẩm cho Server -->
                                    <div class="form-group<?= isset($errors['sp_ma']) ? ' has-error' : '' ?>">
                                        <label for="sp_ma">Tên sản phẩm</label>
                                        <option type="text" name="sp_ma" class="form-control" maxlen="11" id="sp_ma" readonly value="<?=htmlspecialchars($productImage->sp_ma)?>"><?=htmlspecialchars($productImage->sp_ten)?></option> 
                                        
                                    </div>

                                    <div class="form-group">
                                        <label for="">Hình Sản phẩm</label>
                                        </br>
                                        <img src="../../assets/uploads/<?=htmlspecialchars($productImageDelete->hsp_tentaptin)?>" class="img-fluid product__img">
                                        
                                    </div>

                                    <button name="submit" id="submit" class="btn btn-danger mt-3">
                                        Xóa hình ảnh
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
    <?php include_once __DIR__ . '../../layouts/scripts.php'; ?>

</body>
</html>