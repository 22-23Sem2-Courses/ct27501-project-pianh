<?php
    require_once '../../../bootstrap.php';

    use DientuCT\Project\Khachhang;

	$errors = [];

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$khachhang = new Khachhang($PDO);
		$khachhang->fill($_POST);
        // var_dump($khachhang);
        // die;
		if ($khachhang->validate()) {
			$khachhang->save() && redirect(BASE_URL_PATH .'backend/khachhang/index.php' );
		} 
		$errors = $khachhang->getValidationErrors();
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
                <h2 class="text-center mt-3 wow fadeIn" data-wow-delay="0.05s">Thêm mới khách hàng</h2>
                <!-- Tên đăng nhập, mật khẩu -->
                <div class="form-row">
                    <div class="col-sm-6 form-group<?= isset($errors['kh_tendangnhap']) ? ' has-error' : '' ?>">
                        <label for="name">Tên đăng nhập</label>
                        <input type="text" name="kh_tendangnhap" class="form-control" maxlen="100" id="kh_tendangnhap" placeholder="Tên đăng nhập" value="<?= isset($_POST['kh_tendangnhap']) ? htmlspecialchars($_POST['kh_tendangnhap']) : '' ?>" />

                        <?php if (isset($errors['kh_tendangnhap'])) : ?>
                            <span class="help-block">
                                <strong><?= htmlspecialchars($errors['kh_tendangnhap']) ?></strong>
                            </span>
                        <?php endif ?>
					</div>

                    <div class="col-sm-6 form-group<?= isset($errors['kh_matkhau']) ? ' has-error' : '' ?>">
                        <label for="password">Mật khẩu</label>
                        <input type="text" name="kh_matkhau" class="form-control" maxlen="100" id="kh_matkhau" placeholder="Mật khẩu" value="<?= isset($_POST['kh_matkhau']) ? htmlspecialchars($_POST['kh_matkhau']) : '' ?>" />

                        <?php if (isset($errors['kh_matkhau'])) : ?>
                            <span class="help-block">
                                <strong><?= htmlspecialchars($errors['kh_matkhau']) ?></strong>
                            </span>
                        <?php endif ?>
					</div>
                </div>
                    
                <!-- Họ tên, Giới tính, Địa chỉ -->
                <div class="form-row">
                    <div class="col-sm-4 form-group<?= isset($errors['kh_ten']) ? ' has-error' : '' ?>">
                        <label for="kh_ten">Họ tên</label>
                        <input type="text" name="kh_ten" class="form-control" id="kh_ten" placeholder="Họ tên" value="<?= isset($_POST['kh_ten']) ? htmlspecialchars($_POST['kh_ten']) : '' ?>" />

                        <?php if (isset($errors['kh_ten'])) : ?>
                            <span class="help-block">
                                <strong><?= htmlspecialchars($errors['kh_ten']) ?></strong>
                            </span>
                        <?php endif ?>
                    </div>

                    <div class="col-sm-4 form-group<?= isset($errors['kh_gioitinh']) ? ' has-error' : '' ?>">
                        <label for="kh_gioitinh">Giới tính</label>
                        <select name="kh_gioitinh" id="kh_gioitinh" class="form-control">
                            <option value="">Vui lòng chọn giới tính</option>
                            <option value="0">Nữ</option>
                            <option value="1">Nam</option>
                        </select>
                        <?php if (isset($errors['kh_gioitinh'])) : ?>
                            <span class="help-block">
                                <strong><?= htmlspecialchars($errors['kh_gioitinh']) ?></strong>
                            </span>
                        <?php endif ?>
                    </div>

                    <div class="col-sm-4 form-group<?= isset($errors['kh_diachi']) ? ' has-error' : '' ?>">
                        <label for="kh_diachi">Địa chỉ</label>
                        <input type="text" name="kh_diachi" class="form-control" id="kh_diachi" placeholder="Địa chỉ" value="<?= isset($_POST['kh_diachi']) ? htmlspecialchars($_POST['kh_diachi']) : '' ?>" />

                        <?php if (isset($errors['kh_diachi'])) : ?>
                            <span class="help-block">
                                <strong><?= htmlspecialchars($errors['kh_diachi']) ?></strong>
                            </span>
                        <?php endif ?>
                    </div>

                </div>

                <!-- Điện thoại, Email, CMND -->
                <div class="form-row">
                    <div class="col-sm-4 form-group<?= isset($errors['kh_dienthoai']) ? ' has-error' : '' ?>">
                        <label for="kh_dienthoai">Điện thoại</label>
                        <input type="text" name="kh_dienthoai" class="form-control" id="kh_dienthoai" placeholder="Điện thoại" value="<?= isset($_POST['kh_dienthoai']) ? htmlspecialchars($_POST['kh_dienthoai']) : '' ?>" />

                        <?php if (isset($errors['kh_dienthoai'])) : ?>
                            <span class="help-block">
                                <strong><?= htmlspecialchars($errors['kh_dienthoai']) ?></strong>
                            </span>
                        <?php endif ?>
                    </div>

                    <div class="col-sm-4 form-group<?= isset($errors['kh_email']) ? ' has-error' : '' ?>">
                        <label for="kh_email">Email</label>
                        <input type="email" name="kh_email" class="form-control" id="kh_email" placeholder="Email" value="<?= isset($_POST['kh_email']) ? htmlspecialchars($_POST['kh_email']) : '' ?>" />

                        <?php if (isset($errors['kh_email'])) : ?>
                            <span class="help-block">
                                <strong><?= htmlspecialchars($errors['kh_email']) ?></strong>
                            </span>
                        <?php endif ?>
                    </div>

                    <div class="col-sm-4 form-group<?= isset($errors['kh_cmnd']) ? ' has-error' : '' ?>">
                        <label for="kh_cmnd">CMND</label>
                        <input type="text" name="kh_cmnd" class="form-control" id="kh_cmnd" placeholder="CMND" value="<?= isset($_POST['kh_cmnd']) ? htmlspecialchars($_POST['kh_cmnd']) : '' ?>" />

                        <?php if (isset($errors['kh_cmnd'])) : ?>
                            <span class="help-block">
                                <strong><?= htmlspecialchars($errors['kh_cmnd']) ?></strong>
                            </span>
                        <?php endif ?>
                    </div>

                </div>

                <!-- Ngày sinh, tháng sinh, năm sinh  -->
                <div class="form-row">
                    <div class="col-sm-4 form-group<?= isset($errors['kh_ngaysinh']) ? ' has-error' : '' ?>">
                        <label for="kh_ngaysinh">Ngày sinh</label>
                        <input type="number" name="kh_ngaysinh" class="form-control" id="kh_ngaysinh" placeholder="Ngày sinh" value="<?= isset($_POST['kh_ngaysinh']) ? htmlspecialchars($_POST['kh_ngaysinh']) : '' ?>" />

                        <?php if (isset($errors['kh_ngaysinh'])) : ?>
                            <span class="help-block">
                                <strong><?= htmlspecialchars($errors['kh_ngaysinh']) ?></strong>
                            </span>
                        <?php endif ?>
                    </div>

                    <div class="col-sm-4 form-group<?= isset($errors['kh_thangsinh']) ? ' has-error' : '' ?>">
                        <label for="kh_thangsinh">Tháng sinh</label>
                        <input type="number" name="kh_thangsinh" class="form-control" id="kh_thangsinh" placeholder="Tháng sinh" value="<?= isset($_POST['kh_thangsinh']) ? htmlspecialchars($_POST['kh_thangsinh']) : '' ?>" />

                        <?php if (isset($errors['kh_thangsinh'])) : ?>
                            <span class="help-block">
                                <strong><?= htmlspecialchars($errors['kh_thangsinh']) ?></strong>
                            </span>
                        <?php endif ?>
                    </div>

                    <div class="col-sm-4 form-group<?= isset($errors['kh_namsinh']) ? ' has-error' : '' ?>">
                        <label for="kh_namsinh">Năm sinh</label>
                        <input type="number" name="kh_namsinh" class="form-control" id="kh_namsinh" placeholder="Năm sinh" value="<?= isset($_POST['kh_namsinh']) ? htmlspecialchars($_POST['kh_namsinh']) : '' ?>" />

                        <?php if (isset($errors['kh_namsinh'])) : ?>
                            <span class="help-block">
                                <strong><?= htmlspecialchars($errors['kh_namsinh']) ?></strong>
                            </span>
                        <?php endif ?>
                    </div>

                </div>

                <!-- Trạng thái, vai trò -->
                <div class="form-row">
                    <div class="col-sm-4 form-group<?= isset($errors['kh_trangthai']) ? ' has-error' : '' ?>">
                        <label for="kh_trangthai">Trạng thái</label>
                        <select name="kh_trangthai" id="kh_trangthai" class="form-control">
                            <option value="">Vui lòng chọn trạng thái</option>
                            <option value="0">Kích hoạt</option>
                            <option value="1">Tạm khóa</option>
                        </select>
                        <?php if (isset($errors['kh_trangthai'])) : ?>
                            <span class="help-block">
                                <strong><?= htmlspecialchars($errors['kh_trangthai']) ?></strong>
                            </span>
                        <?php endif ?>
                    </div>

                    <div class="col-sm-4 form-group<?= isset($errors['kh_quanly']) ? ' has-error' : '' ?>">
                        <label for="kh_quanly">Vai trò</label>
                        <select name="kh_quanly" id="kh_quanly" class="form-control">
                            <option value="">Vui lòng chọn vai trò</option>
                            <option value="0">Khách hàng</option>
                            <option value="1">Quản lý</option>
                        </select>
                        <?php if (isset($errors['kh_quanly'])) : ?>
                            <span class="help-block">
                                <strong><?= htmlspecialchars($errors['kh_quanly']) ?></strong>
                            </span>
                        <?php endif ?>
                    </div>

                </div>

                

                <!-- Submit -->
                <button type="submit" name="submit" id="submit" class="btn btn-primary mt-3">Thêm mới Khách hàng</button>
            </form>
    
        </div>
    </div>
                
    <?php include_once __DIR__ . '../../../../partialsBE/footer.php' ?>
    <?php include_once __DIR__ . '../../layouts/scripts.php' ?>
	<script>
        $(document).ready(function() {
            //Gọi wow js
            new WOW().init();
        });    
    </script>
</body>

</html>