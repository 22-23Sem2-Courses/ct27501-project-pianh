<?php
    if (session_id() === '') {
        session_start();
    }

    if (!isset($_SESSION['kh_tendangnhap_logged'])){
        echo '<script>location.href = "/admin/auth/login.php";</script>';
    }

    require_once '../../../bootstrap.php';

    $kh_tendangnhap_logged=htmlspecialchars($_SESSION['kh_tendangnhap_logged']);

    if ($kh_tendangnhap_logged !='admin' ) {
        $message = "Bạn không phải là thành viên quản trị website! Bạn không được phép truy cập vào trang này!!!!";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo '<script>location.href = "/index.php";</script>';
    }

    use DientuCT\Project\Customer;
    $customer = new Customer($PDO);

    $kh_tendangnhap = isset($_REQUEST['kh_tendangnhap']) ?
        trim(($_REQUEST['kh_tendangnhap']) ) : "";

        if (!($customer->find($kh_tendangnhap))) {
            redirect(BASE_URL_PATH .'admin/customers/index.php');
        }

    $errors = [];

?>

<?php
    // Khi người dùng bấm lưu thì tiến hành xử lý
    if (
        $_SERVER['REQUEST_METHOD'] === 'POST'
        && isset($_POST['submit'])
        && isset($_POST['kh_tendangnhap'])
        && ($customer->find($_POST['kh_tendangnhap'])) !== null
    ) {
        $customer->delete();
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
    <title>Xóa khách hàng</title>
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
                                    Xóa khách hàng
                                    <div class="page-title-subheading wow fadeIn" data-wow-duration="2s">Xóa khách hàng khỏi danh sách của bạn.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Table Content -->
                    <div class="tabs-animation">
                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fa fa-table" aria-hidden="true"></i>
                                Table Xóa Khách hàng
                            </div>
                            <div class="card-body">
                                <!-- Form xóa khách hàng -->
                                <form name="frmDelete" id="frmDelete" method="post"  action="">
                                        <div class="form-row">
                                            <div class="col-sm-3 form-group<?= isset($errors['kh_tendangnhap']) ? ' has-error' : '' ?>">
                                                <label for="kh_tendangnhap">Tên đăng nhập (*)</label>
                                                <input type="text" name="kh_tendangnhap" class="form-control" readonly id="kh_tendangnhap" placeholder="Tên đăng nhập" value="<?= $customer->getKh_tendangnhap() ?>" />
                                            </div>

                                            <div class="col-sm-3 form-group<?= isset($errors['kh_ten']) ? ' has-error' : '' ?>">
                                                <label for="kh_ten">Tên khách hàng</label>
                                                <input type="text" name="kh_ten" class="form-control" readonly id="kh_ten" placeholder="Tên khách hàng" value="<?= htmlspecialchars($customer->kh_ten) ?>" />
                                            </div>

                                            <div class="col-sm-3 form-group<?= isset($errors['kh_dienthoai']) ? ' has-error' : '' ?>">
                                                <label for="kh_dienthoai">Số điện thoại</label>
                                                <input type="text" name="kh_dienthoai" class="form-control" readonly id="kh_dienthoai" placeholder="Số điện thoại" value="<?= htmlspecialchars($customer->kh_dienthoai) ?>" />
                                            </div>

                                            <div class="col-sm-3 form-group<?= isset($errors['kh_email']) ? ' has-error' : '' ?>">
                                                <label for="kh_email">Email</label>
                                                <input type="text" name="kh_email" class="form-control" readonly id="kh_email" placeholder="Email" value="<?= htmlspecialchars($customer->kh_email) ?>" />
                                            </div>

                                        </div>

                                    <button name="submit" id="submit" class="btn btn-danger mt-3">
                                        Xóa khách hàng
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>


</body>
</html>