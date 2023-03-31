<?php
    if (session_id() === '') {
        session_start();
    }

    if (!isset($_SESSION['kh_tendangnhap_logged'])){
        echo '<script>location.href = "/admin/auth/login.php";</script>';
    }
    require_once '../../../bootstrap.php';

    use DientuCT\Project\ProductImage;
    use DientuCT\Project\Product;

    $product = new Product($PDO);
    $products = $product->all();

    $productImage = new ProductImage($PDO);
	$errors = [];

?>

                                
<?php
    if ( ($_SERVER['REQUEST_METHOD'] === 'POST') && (isset($_POST['submit']))) { 
        $productImage->fill($_POST);
        if ($productImage->validate()) {
            if( isset($_FILES['hsp_tentaptin'] )) {
                $upload_dir = __DIR__ . '/../../assets/uploads/';

                if ($_FILES['hsp_tentaptin']['error'] > 0) {
                    echo 'File Upload bị lỗi hoặc chưa được chọn'; die;
                } else {
                    $hsp_tentaptin = htmlspecialchars($_FILES['hsp_tentaptin']['name']);
                    $fileName = date('YmdHis') . '_' . $hsp_tentaptin;          
                    // Tiến hành di chuyển file từ thư mục tạm trên server vào thư mục chúng ta muốn chứa các file uploads                
                    move_uploaded_file($_FILES['hsp_tentaptin']['tmp_name'], $upload_dir . $fileName);
                }
            }

            $productImage->save() && redirect(BASE_URL_PATH .'admin/product-images/index.php' );
        } 
        $errors = $productImage->getValidationErrors();        
    }
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once __DIR__ . '../../layouts/meta.php'; ?>
	<title>Thêm mới hình cho sản phẩm</title>
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
                    <div class="page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading wow fadeIn" data-wow-delay="0.05s">
                                <div class="page-title-icon"><i class="fa fa-picture-o" aria-hidden="true"></i></div>
                                <div >
                                    Thêm mới hình cho sản phẩm
                                    <div class="page-title-subheading">Thêm mới hình cho sản phẩm vào danh sách của bạn.</div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <!-- Table Content -->
                    <div class="tabs-animation">
                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fa fa-table" aria-hidden="true"></i>
                                Form thêm mới Hình sản phẩm
                            </div>
                            <div class="card-body">
                                

                                <form name="frmCreate" id="frmCreate" method="post"  action="" enctype="multipart/form-data">

                                    <!-- Tên sản phẩm -> Gửi mã sản phẩm cho Server-->
                                    <div class="form-group<?= isset($errors['sp_ma']) ? ' has-error' : '' ?>">
                                        <label for="sp_ma">Tên sản phẩm</label>
                                        <select  name="sp_ma" id="sp_ma" class="form-control">
                                            <option value="">Vui lòng chọn sản phẩm</option>
                                            <?php foreach($products as $product): ?>
                                                <option  value="<?=htmlspecialchars($product->sp_ma)?>"><?=htmlspecialchars($product->sp_ten)?></option>
                                            <?php endforeach; ?>
                                        </select>

                                        <?php if (isset($errors['sp_ma'])) : ?>
                                            <span class="help-block">
                                                <strong><?= htmlspecialchars($errors['sp_ma']) ?></strong>
                                            </span>
                                        <?php endif ?>
                                    </div>

                                    <div class=" form-group<?= isset($errors['hsp_tentaptin']) ? ' has-error' : '' ?>">
                                        <label for="hsp_tentaptin">Thêm hình cho sản phẩm</label>

                                        <input type="file" name="hsp_tentaptin" class="form-control" id="hsp_tentaptin" />
                                        <?php if (isset($errors['hsp_tentaptin'])) : ?>
                                            <span class="help-block">
                                                <strong><?= htmlspecialchars($errors['hsp_tentaptin']) ?></strong>
                                            </span>
                                        <?php endif ?>
                                    </div>

                                    <button type="submit" name="submit" id="submit" class="btn btn-primary mt-3">Thêm mới hình sản phẩm</button>
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