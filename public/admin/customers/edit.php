<?php

    if (session_id() === '') {
        session_start();
    }

    if (!isset($_SESSION['kh_tendangnhap_logged'])){
        echo '<script>location.href = "/admin/auth/login.php";</script>';
    }
    require_once '../../../bootstrap.php';

    $kh_tendangnhap_logged=htmlspecialchars($_SESSION['kh_tendangnhap_logged']);

    if ($kh_tendangnhap_logged!='admin' ) {
        $message = "Bạn không phải là thành viên quản trị website! Bạn không được phép truy cập vào trang này!!!!";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo '<script>location.href = "/index.php";</script>';
    }
    
    use DientuCT\Project\Customer;
    $customer = new Customer($PDO);

    $kh_tendangnhap = isset($_REQUEST['kh_tendangnhap']) ?
	    $_GET['kh_tendangnhap'] : "";

    // var_dump($kh_tendangnhap); die;

        if ( ($kh_tendangnhap == "") || !($customer->find($kh_tendangnhap))) {
            redirect(BASE_URL_PATH .'admin/customers/index.php');
        }
  
    $errors = [];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // var_dump($customer); die;
        if ($customer->update($_POST)) {
            // Cập nhật dữ liệu thành công
            redirect(BASE_URL_PATH .'admin/customers/index.php');
        } 
        // Cập nhật dữ liệu không thành công
        $errors = $customer->getValidationErrors();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <!-- Meta -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật khách hàng</title>
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
                                <div class="page-title-icon"><i class="fa fa-users" aria-hidden="true"></i></div>
                                <div>
                                    Chỉnh sửa khách hàng
                                    <div class="page-title-subheading wow fadeIn" data-wow-duration="2s">Chỉnh sửa thông tin khách hàng của bạn.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Table Content -->
                    <div class="tabs-animation">
                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fa fa-table" aria-hidden="true"></i>
                                Form chỉnh sửa thông tin Khách hàng
                            </div>
                            <div class="card-body">   
                                <form name="frmEdit" id="frmEdit" action=""  method="post" class="justify-content-center">
                                 
                                    <input type="hidden" name="kh_tendangnhap" value="<?= htmlspecialchars($customer->getKh_tendangnhap()) ?>">
                                        <!-- Tên đăng nhập -->
                                        <div class="form-group<?= isset($errors['kh_tendangnhap']) ? ' has-error' : '' ?>">
                                            <label for="kh_tendangnhap">Tên đăng nhập</label>
                                            <input type="text" name="kh_tendangnhap" class="form-control" maxlen="100" id="kh_tendangnhap" placeholder="Tên đăng nhập" readonly
                                                value="<?= htmlspecialchars($customer->kh_tendangnhap) ?>" />

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
                                                <input type="text" name="kh_ten" class="form-control" id="kh_ten" placeholder="Họ tên" value="<?= htmlspecialchars($customer->kh_ten) ?>" />

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
                                                <input type="text" name="kh_diachi" class="form-control" id="kh_diachi" placeholder="Địa chỉ" value="<?= htmlspecialchars($customer->kh_diachi) ?>" />

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
                                                <input type="text" name="kh_dienthoai" class="form-control" id="kh_dienthoai" placeholder="Điện thoại" value="<?= htmlspecialchars($customer->kh_dienthoai) ?>" />

                                                <?php if (isset($errors['kh_dienthoai'])) : ?>
                                                    <span class="help-block">
                                                        <strong><?= htmlspecialchars($errors['kh_dienthoai']) ?></strong>
                                                    </span>
                                                <?php endif ?>
                                            </div>

                                            <div class="col-sm-4 form-group<?= isset($errors['kh_email']) ? ' has-error' : '' ?>">
                                                <label for="kh_email">Email</label>
                                                <input type="email" name="kh_email" class="form-control" id="kh_email" placeholder="Email" value="<?= htmlspecialchars($customer->kh_email) ?>" />

                                                <?php if (isset($errors['kh_email'])) : ?>
                                                    <span class="help-block">
                                                        <strong><?= htmlspecialchars($errors['kh_email']) ?></strong>
                                                    </span>
                                                <?php endif ?>
                                            </div>

                                            <div class="col-sm-4 form-group<?= isset($errors['kh_cmnd']) ? ' has-error' : '' ?>">
                                                <label for="kh_cmnd">CMND</label>
                                                <input type="text" name="kh_cmnd" class="form-control" id="kh_cmnd" placeholder="CMND" value="<?= htmlspecialchars($customer->kh_cmnd) ?>" />

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
                                                <input type="number" name="kh_ngaysinh" class="form-control" id="kh_ngaysinh" placeholder="Ngày sinh" value="<?= htmlspecialchars($customer->kh_ngaysinh) ?>" />

                                                <?php if (isset($errors['kh_ngaysinh'])) : ?>
                                                    <span class="help-block">
                                                        <strong><?= htmlspecialchars($errors['kh_ngaysinh']) ?></strong>
                                                    </span>
                                                <?php endif ?>
                                            </div>

                                            <div class="col-sm-4 form-group<?= isset($errors['kh_thangsinh']) ? ' has-error' : '' ?>">
                                                <label for="kh_thangsinh">Tháng sinh</label>
                                                <input type="number" name="kh_thangsinh" class="form-control" id="kh_thangsinh" placeholder="Tháng sinh" value="<?= htmlspecialchars($customer->kh_thangsinh) ?>" />

                                                <?php if (isset($errors['kh_thangsinh'])) : ?>
                                                    <span class="help-block">
                                                        <strong><?= htmlspecialchars($errors['kh_thangsinh']) ?></strong>
                                                    </span>
                                                <?php endif ?>
                                            </div>

                                            <div class="col-sm-4 form-group<?= isset($errors['kh_namsinh']) ? ' has-error' : '' ?>">
                                                <label for="kh_namsinh">Năm sinh</label>
                                                <input type="number" name="kh_namsinh" class="form-control" id="kh_namsinh" placeholder="Năm sinh" value="<?= htmlspecialchars($customer->kh_namsinh) ?>" />

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
                                            <div class="col-sm-4 form-group<?= isset($errors['kh_trangthai']) ? ' has-error' : '' ?>">
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
                                        <!-- Trạng thái,  quản lý -->



                                        <!-- Submit -->
                                        <button type="submit" name="submit" id="submit" class="btn btn-primary mt-3">Cập nhật khách hàng</button>
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