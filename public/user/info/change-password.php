<?php

    if (session_id() === '') {
        session_start();
    }

    if (!isset($_SESSION['kh_tendangnhap_logged'])){
        echo '<script>location.href = "/user/auth/login.php";</script>';
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
            window.onload = function () { alert("Cập nhật mật khẩu mới thành công!"); }
            </script>';
            // redirect(BASE_URL_PATH .'user/info/change-password.php');

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
    <title>Đổi mật khẩu Điện tử Cần Thơ| DientuCanTho.vn</title>
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
                        <li>
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
                        <li class="selected">
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
                    <h2 class="member-title">Đổi mật khẩu</h2>
                    <form action="" method="post" name="frmUser" id="frmUser" enctype="multipart/form-data">
                        

                        <!-- <div class="box-user <?= isset($errors['kh_ten']) ? ' has-error' : '' ?>">
                            <label class="label-input" for="Username">Họ và tên</label>
                            <input type="text" name="kh_ten" class="form-control" id="kh_ten" placeholder="Họ tên" value="<?= htmlspecialchars($customer->kh_ten) ?>" />

                            <?php if (isset($errors['kh_ten'])) : ?>
                                <span class="help-block">
                                    <strong><?= htmlspecialchars($errors['kh_ten']) ?></strong>
                                </span>
                            <?php endif ?>
                        </div> -->

                        <div class="box-user <?= isset($errors['kh_matkhaucu']) ? ' has-error' : '' ?>">
                            <label class="label-input" for="password">Mật khẩu cũ</label>
                            <input type="password" name="kh_matkhaucu" class="form-control" id="kh_matkhaucu" placeholder="Mật khẩu" value="<?= isset($_POST['kh_matkhaucu']) ? htmlspecialchars($_POST['kh_matkhaucu']) : '' ?>" />

                            <?php if (isset($errors['kh_matkhaucu'])) : ?>
                                <span class="help-block">
                                    <strong><?= htmlspecialchars($errors['kh_matkhaucu']) ?></strong>
                                </span>
                            <?php endif ?>
                        </div>

                        <div class="box-user">
                            <label class="label-input" for="kh_matkhau">Mật khẩu mới</label>
                            <input type="password" name="kh_matkhau" class="form-control" id="kh_matkhau" placeholder="Mật khẩu mới" value="<?= isset($_POST['kh_matkhau']) ? htmlspecialchars($_POST['kh_matkhau']) : '' ?>" />

                            <?php if (isset($errors['kh_matkhau'])) : ?>
                                <span class="help-block">
                                    <strong><?= htmlspecialchars($errors['kh_matkhau']) ?></strong>
                                </span>
                            <?php endif ?>
                        
                        </div>

                        <!-- <div class="box-user">
                            <label class="label-input" for="kh_nhaplaimatkhau">Nhập lại mật khẩu mới</label>
                            <input type="password" name="re-kh_matkhau" id="kh_nhaplaimatkhau" value="" placeholder="Nhập lại mật khẩu mới" class="form-control">
                        </div> -->

                        <div class="box-user box-submit ">
                            <button class="submit-btn btn btn-success" name="btnSubmit">Cập nhật</button>
                        </div>
                    </form>
                </div>
                <!-- End Content -->
            </div>

                    <?php
                            

                            
                    ?>
        
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