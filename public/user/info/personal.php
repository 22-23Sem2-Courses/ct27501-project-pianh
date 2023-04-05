<?php

    if (session_id() === '') {
        session_start();
    }

    if (!isset($_SESSION['kh_tendangnhap_logged'])){
        echo '<script>location.href = "user/auth/login.php";</script>';
    }
    require_once '../../../bootstrap.php';
    
    use DientuCT\Project\Customer;
    $customer = new Customer($PDO);

    $kh_tendangnhap=$_SESSION['kh_tendangnhap_logged'];
    // var_dump($kh_tendangnhap); die;

        if ( ($kh_tendangnhap == "") || !($customer->find($kh_tendangnhap))) {
            redirect(BASE_URL_PATH .'user/auth/login.php');
        }
  
    $errors = [];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // var_dump($customer); die;
        if ($customer->update($_POST)) {
            echo '<script type="text/javascript">
            window.onload = function () { alert("Cập nhật thông tin thành công!"); }
            </script>';
            //redirect(BASE_URL_PATH .'user/info/personal.php');

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
    <title>Trang cá nhân Điện tử Cần Thơ| DientuCanTho.vn</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/assets/user/css/bootstrap.min.css" type="text/css" />
    <!-- Font awesome -->
    <link rel="stylesheet" href="/assets/user/css/font-awesome.min.css" type="text/css" />
    <!-- Datatables CSS -->
    <link href="/assets/user/css/datatables.min.css" rel="stylesheet"/>
    <!-- Animate CSS -->
    <link href="/assets/user/css/animate.css" rel="stylesheet"/>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/assets/user/css/base.css" type="text/css" />
    <link rel="stylesheet" href="/assets/user/css/styles.css" type="text/css" />
    <link rel="stylesheet" href="/assets/user/css/responsive.css" type="text/css" />
    
</head>
<body>

    <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);     
    ?>

    <!-- header -->
    <?php include_once __DIR__ . '../../../../partials/user/header.php'; ?>
    <!-- end header -->
    
    <div class="container-fluid">
        <div id="main_container" class="grid-info row">
            <div class="col-md-4">
                <!-- Start User info-->
                <div class="user-menu-side">
                    <div class="user-name">
                        <img src="/dienmay.vn/assets/frontend/imgs/logo-user.svg" alt="">
                        <div class="name">
                            <h5>Xin chào, <?=$_SESSION['kh_tendangnhap_logged']; ?></h5>
                            <span></span> <!-- Tên user -->
                        </div>
                    </div>

                    <ul>
                        <li class="selected">
                           <a href="/user/info/personal.php">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                Thông tin tài khoản
                           </a> 
                        </li>
                        <li>
                            <a href="/user/info/order-management.php">
                                <i class="fa fa-wpforms" aria-hidden="true"></i>
                                Quản lý đơn hàng
                            </a>
                        </li>
                        <li>
                            <a href="/user/info/change-password.php">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                                Đổi mật khẩu
                            </a>
                        </li>
                        <li>
                            <a href="/user/info/address.php">
                                <i class="fa fa-id-card-o" aria-hidden="true"></i>
                                Sổ địa chỉ
                            </a>
                        </li>
                        <li>
                            <a href="/user/auth/logout.php">
                                <i class="fa fa-power-off" aria-hidden="true"></i>
                                Đăng xuất
                            </a>
                        </li>
                    </ul>

                </div>
                <!-- End User info-->
            </div>

            <div class="col-md-7">
                <!-- Start Content -->
                <div class="user-content-side">
                    <h2 class="member-title">Thông tin tài khoản</h2>
                    <form action="" method="post" name="frmUser" id="frmUser" enctype="multipart/form-data">
                        
                        <!-- Họ tên -->
                        <div class="box-user <?= isset($errors['kh_ten']) ? ' has-error' : '' ?>">
                            <label class="label-input" for="Username">Họ và tên</label>
                            <input type="text" name="kh_ten" class="form-control" id="kh_ten" placeholder="Họ tên" value="<?= htmlspecialchars($customer->kh_ten) ?>" />

                            <?php if (isset($errors['kh_ten'])) : ?>
                                <span class="help-block">
                                    <strong><?= htmlspecialchars($errors['kh_ten']) ?></strong>
                                </span>
                            <?php endif ?>
                        </div>

                        <!-- Email -->
                        <div class="box-user <?= isset($errors['kh_email']) ? ' has-error' : '' ?>">
                            <label class="label-input" for="email">Email</label>
                            <input type="text" name="kh_email" class="form-control" id="kh_email" placeholder="Email" value="<?= htmlspecialchars($customer->kh_email) ?>" />

                            <?php if (isset($errors['kh_email'])) : ?>
                                <span class="help-block">
                                    <strong><?= htmlspecialchars($errors['kh_email']) ?></strong>
                                </span>
                            <?php endif ?>
                        </div>

                        <!-- Điện thoại -->
                        <div class="box-user <?= isset($errors['kh_dienthoai']) ? ' has-error' : '' ?>">
                            <label class="label-input" for="kh_dienthoai">Điện thoại</label>
                            <input type="text" name="kh_dienthoai" class="form-control" id="kh_dienthoai" placeholder="Điện thoại" value="<?= htmlspecialchars($customer->kh_dienthoai) ?>" />

                            <?php if (isset($errors['kh_dienthoai'])) : ?>
                                <span class="help-block">
                                    <strong><?= htmlspecialchars($errors['kh_dienthoai']) ?></strong>
                                </span>
                            <?php endif ?>
                        </div>

                        <!-- Ngày, tháng năm sinh -->
                        <div class="box-user <?= isset($errors['kh_ngaysinh']) ? ' has-error' : '' ?>">
                            <label class="label-input" for="kh_ngaysinh">Ngày sinh</label>
                            <input type="number" name="kh_ngaysinh" class="form-control" id="kh_ngaysinh" placeholder="Ngày sinh" value="<?= htmlspecialchars($customer->kh_ngaysinh) ?>" />

                                <?php if (isset($errors['kh_ngaysinh'])) : ?>
                                    <span class="help-block">
                                        <strong><?= htmlspecialchars($errors['kh_ngaysinh']) ?></strong>
                                    </span>
                                <?php endif ?>
                        </div>

                        <div class="box-user <?= isset($errors['kh_thangsinh']) ? ' has-error' : '' ?>">
                            <label class="label-input" for="kh_thangsinh">Tháng sinh</label>
                            <input type="number" name="kh_thangsinh" class="form-control" id="kh_thangsinh" placeholder="Tháng sinh" value="<?= htmlspecialchars($customer->kh_thangsinh) ?>" />

                                <?php if (isset($errors['kh_thangsinh'])) : ?>
                                    <span class="help-block">
                                        <strong><?= htmlspecialchars($errors['kh_thangsinh']) ?></strong>
                                    </span>
                                <?php endif ?>
                        </div>

                        <div class="box-user <?= isset($errors['kh_namsinh']) ? ' has-error' : '' ?>">
                            <label class="label-input" for="kh_namsinh">Năm sinh</label>
                            <input type="number" name="kh_namsinh" class="form-control" id="kh_namsinh" placeholder="Năm sinh" value="<?= htmlspecialchars($customer->kh_namsinh) ?>" />

                                <?php if (isset($errors['kh_namsinh'])) : ?>
                                    <span class="help-block">
                                        <strong><?= htmlspecialchars($errors['kh_namsinh']) ?></strong>
                                    </span>
                                <?php endif ?>
                        </div>


                       


                        <div class="box-user box-submit ">
                            <button class="submit-btn btn btn-success">Cập nhật</button>
                        </div>
                    </form>
                </div>
                <!-- End Content -->
            </div>

            
        
        </div>
    </div>

    

    <!-- footer -->
    <?php include_once __DIR__ . '../../../../partials/user/footer.php'; ?>
    <!-- end footer -->
    <!-- jQuery JS -->
    <script src="/assets/user/js/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="/assets/user/js/bootstrap.min.js"></script>
    <!-- Wow js -->
    <script src="/assets/user/js/wow.min.js"></script>
    <!-- SweetAlert JS-->
    <script src="/assets/user/js/sweetalert.js"></script>
    <script src="/assets/user/js/sweetalert.min.js"></script>
    <!-- DataTable JS -->
    <script src="/assets/user/js/datatables.min.js"></script>
    <script src="/assets/user/js/buttons.bootstrap4.min.js"></script>
    <script src="/assets/user/js/pdfmake.min.js"></script>
    <script src="/assets/user/js/vfs_fonts.js"></script>
    <!-- Custom JS -->
    <script src="/assets/user/js/app.js"></script>

    
</body>
</html>