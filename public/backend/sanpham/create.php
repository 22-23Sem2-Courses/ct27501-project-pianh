<?php
    require_once '../../../bootstrap.php';

    use DientuCT\Project\Sanpham;

	$errors = [];

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$sanpham = new Sanpham($PDO);
		$sanpham->fill($_POST);
        // var_dump($sanpham);
        // die;
		if ($sanpham->validate()) {
			$sanpham->save() && redirect(BASE_URL_PATH .'backend/sanpham/index.php' );
		} 
		$errors = $sanpham->getValidationErrors();
		}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once __DIR__ . '../../layouts/meta.php'; ?>
	<title>Thêm mới sản phẩm</title>
	<?php include_once __DIR__ . '../../layouts/styles.php'; ?>
</head>

<body>
    <?php include_once __DIR__ . '../../../../partialsBE/header.php'; ?>
    <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);     
    ?>

    <div class="container-fluid">
        <div class="row">
            <?php include_once __DIR__ . '../../../../partialsBE/sidebar.php'; ?>
            
            <form name="frmCreate" id="frmCreate" action=""  method="post" class="col-md-10 justify-content-center">
                <h2 class="text-center mt-3 wow fadeIn" data-wow-delay="0.05s">Thêm mới sản phẩm</h2>
                    <!-- Tên sản phẩm -->
                    <div class="form-group<?= isset($errors['sp_ten']) ? ' has-error' : '' ?>">
                        <label for="name">Tên sản phẩm</label>
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
                            <label for="sp_gia">Giá sản phẩm</label>
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
                
    <?php include_once __DIR__ . '../../../../partialsBE/footer.php'; ?>
    <?php include_once __DIR__ . '../../layouts/scripts.php'; ?>
	<script>
        $(document).ready(function() {
            //Gọi wow js
            new WOW().init();
        });    
    </script>
</body>

</html>