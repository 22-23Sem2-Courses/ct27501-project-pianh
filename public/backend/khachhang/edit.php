<?php
    require_once '../../../bootstrap.php';
    
    use DientuCT\Project\Khachhang;
    $khachhang = new Khachhang($PDO);

    $kh_tendangnhap = isset($_REQUEST['kh_tendangnhap']) ?
	    $_GET['kh_tendangnhap'] : "";

    // var_dump($kh_tendangnhap); die;

        if ( ($kh_tendangnhap == "") || !($khachhang->find($kh_tendangnhap))) {
            redirect(BASE_URL_PATH .'backend/khachhang/index.php');
        }
  
    $errors = [];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // var_dump($khachhang); die;
        if ($khachhang->update($_POST)) {
            // Cập nhật dữ liệu thành công
            redirect(BASE_URL_PATH .'backend/khachhang/index.php');
        } 
        // Cập nhật dữ liệu không thành công
        $errors = $khachhang->getValidationErrors();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once __DIR__ . '../../layouts/meta.php'; ?>
    <title>Cập nhật khách hàng</title>
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

            <form name="frmEdit" id="frmEdit" action=""  method="post" class="col-md-10 justify-content-center">
                <h2 class="text-center mt-3 wow fadeIn" data-wow-delay="0.05s">Cập nhật khách hàng</h2>

                <input type="hidden" name="kh_tendangnhap" value="<?= htmlspecialchars($khachhang->getKh_tendangnhap()) ?>">
                    <!-- Tên đăng nhập -->
                    <div class="form-group<?= isset($errors['kh_tendangnhap']) ? ' has-error' : '' ?>">
                        <label for="kh_tendangnhap">Tên đăng nhập</label>
                        <input type="text" name="name" class="form-control" maxlen="100" id="kh_tendangnhap" placeholder="Tên đăng nhập" readonly
                            value="<?= htmlspecialchars($khachhang->kh_tendangnhap) ?>" />

                        <?php if (isset($errors['kh_tendangnhap'])) : ?>
                            <span class="help-block">
                                <strong><?= htmlspecialchars($errors['kh_tendangnhap']) ?></strong>
                            </span>
                        <?php endif ?>
					</div>
                    
                    <!-- Họ tên, Giới tính, Địa chỉ -->
                    <div class="form-row">
                        <div class="col-sm-4 form-group<?= isset($errors['kh_ten']) ? ' has-error' : '' ?>">
                            <label for="kh_ten">Họ tên</label>
                            <input type="text" name="kh_ten" class="form-control" id="kh_ten" placeholder="Họ tên" value="<?= htmlspecialchars($khachhang->kh_ten) ?>" />

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
                            <input type="text" name="kh_diachi" class="form-control" id="kh_diachi" placeholder="Địa chỉ" value="<?= htmlspecialchars($khachhang->kh_diachi) ?>" />

                            <?php if (isset($errors['kh_diachi'])) : ?>
                                <span class="help-block">
                                    <strong><?= htmlspecialchars($errors['kh_diachi']) ?></strong>
                                </span>
                            <?php endif ?>
                        </div>

                    </div>
                    <!-- End Họ tên, Giới tính, Địa chỉ -->

                    <!-- Điện thoại, Email, Cmnd -->
                    <div class="form-row">
                        <div class="col-sm-4 form-group<?= isset($errors['kh_dienthoai']) ? ' has-error' : '' ?>">
                            <label for="kh_dienthoai">Điện thoại</label>
                            <input type="text" name="kh_dienthoai" class="form-control" id="kh_dienthoai" placeholder="Điện thoại" value="<?= htmlspecialchars($khachhang->kh_dienthoai) ?>" />

                            <?php if (isset($errors['kh_dienthoai'])) : ?>
                                <span class="help-block">
                                    <strong><?= htmlspecialchars($errors['kh_dienthoai']) ?></strong>
                                </span>
                            <?php endif ?>
                        </div>

                        <div class="col-sm-4 form-group<?= isset($errors['kh_email']) ? ' has-error' : '' ?>">
                            <label for="kh_email">Email</label>
                            <input type="email" name="kh_email" class="form-control" id="kh_email" placeholder="Email" value="<?= htmlspecialchars($khachhang->kh_email) ?>" />

                            <?php if (isset($errors['kh_email'])) : ?>
                                <span class="help-block">
                                    <strong><?= htmlspecialchars($errors['kh_email']) ?></strong>
                                </span>
                            <?php endif ?>
                        </div>

                        <div class="col-sm-4 form-group<?= isset($errors['kh_cmnd']) ? ' has-error' : '' ?>">
                            <label for="kh_cmnd">CMND</label>
                            <input type="text" name="kh_cmnd" class="form-control" id="kh_cmnd" placeholder="CMND" value="<?= htmlspecialchars($khachhang->kh_cmnd) ?>" />

                            <?php if (isset($errors['kh_cmnd'])) : ?>
                                <span class="help-block">
                                    <strong><?= htmlspecialchars($errors['kh_cmnd']) ?></strong>
                                </span>
                            <?php endif ?>
                        </div>

                    </div>
                    <!-- End Điện thoại, Email, Cmnd -->

                    <!-- Ngày, tháng, Năm sinh -->
                    <div class="form-row">
                        <div class="col-sm-4 form-group<?= isset($errors['kh_ngaysinh']) ? ' has-error' : '' ?>">
                            <label for="kh_ngaysinh">Ngày sinh</label>
                            <input type="number" name="kh_ngaysinh" class="form-control" id="kh_ngaysinh" placeholder="Ngày sinh" value="<?= htmlspecialchars($khachhang->kh_ngaysinh) ?>" />

                            <?php if (isset($errors['kh_ngaysinh'])) : ?>
                                <span class="help-block">
                                    <strong><?= htmlspecialchars($errors['kh_ngaysinh']) ?></strong>
                                </span>
                            <?php endif ?>
                        </div>

                        <div class="col-sm-4 form-group<?= isset($errors['kh_thangsinh']) ? ' has-error' : '' ?>">
                            <label for="kh_thangsinh">Tháng sinh</label>
                            <input type="number" name="kh_thangsinh" class="form-control" id="kh_thangsinh" placeholder="Tháng sinh" value="<?= htmlspecialchars($khachhang->kh_thangsinh) ?>" />

                            <?php if (isset($errors['kh_thangsinh'])) : ?>
                                <span class="help-block">
                                    <strong><?= htmlspecialchars($errors['kh_thangsinh']) ?></strong>
                                </span>
                            <?php endif ?>
                        </div>

                        <div class="col-sm-4 form-group<?= isset($errors['kh_namsinh']) ? ' has-error' : '' ?>">
                            <label for="kh_namsinh">Năm sinh</label>
                            <input type="number" name="kh_namsinh" class="form-control" id="kh_namsinh" placeholder="Năm sinh" value="<?= htmlspecialchars($khachhang->kh_namsinh) ?>" />

                            <?php if (isset($errors['kh_namsinh'])) : ?>
                                <span class="help-block">
                                    <strong><?= htmlspecialchars($errors['kh_namsinh']) ?></strong>
                                </span>
                            <?php endif ?>
                        </div>

                    </div>
                    <!-- End Ngày, tháng, Năm sinh -->
                    
                    <!-- Trạng thái, quản lý -->
                    <div class="form-row">
                        <div class="col-sm-6 form-group<?= isset($errors['kh_trangthai']) ? ' has-error' : '' ?>">
                            <label for="kh_trangthai">Trạng thái</label>
                            <select name="kh_trangthai" id="kh_trangthai" class="form-control">
                                <option value="">Vui lòng chọn trạng thái cho tài khoản</option>
                                <option value="0">Kích hoạt</option>
                                <option value="1">Tạm khóa</option>
                            </select>

                            <?php if (isset($errors['kh_trangthai'])) : ?>
                                <span class="help-block">
                                    <strong><?= htmlspecialchars($errors['kh_trangthai']) ?></strong>
                                </span>
                            <?php endif ?>
                        </div>

                        <div class="col-sm-6 form-group<?= isset($errors['kh_quanly']) ? ' has-error' : '' ?>">
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
                    <!-- Trạng thái,  quản lý -->



                    <!-- Submit -->
                    <button type="submit" name="submit" id="submit" class="btn btn-primary mt-3">Cập nhật khách hàng</button>
                </form>
                
        
        </div>
    </div>

    <?php include_once __DIR__ . '../../../../partialsBE/footer.php' ?>
    <?php include_once __DIR__ . '../../layouts/scripts.php' ?>

    <script>
        $(document).ready(function() {
            // Gọi wow js
            new WOW().init();
        });
    </script>
</body>
</html>