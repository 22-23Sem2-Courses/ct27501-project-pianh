<?php
    if (session_id() === '') {
        session_start();
    }

    if (!isset($_SESSION['kh_tendangnhap_logged'])){
        echo '<script>location.href = "/admin/auth/login.php";</script>';
    }
    require_once '../../../bootstrap.php';
    
    use DientuCT\Project\Order;
    $order = new Order($PDO);
    // $orders = $order->all();

    use DientuCT\Project\Customer;
    $customer = new Customer($PDO);
    $customers = $customer->all();


    $dh_ma = isset($_REQUEST['dh_ma']) ?
        filter_var($_REQUEST['dh_ma'], FILTER_SANITIZE_NUMBER_INT) : -1;

        if ($dh_ma < 0 || !($order->find($dh_ma))) {
            redirect(BASE_URL_PATH .'admin/orders/index.php');
        }

    $customerOrder = $order->find($dh_ma);
    
    $errors = [];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // var_dump($order); die;
        if ($order->update($_POST)) {
            // Cập nhật dữ liệu thành công
            redirect(BASE_URL_PATH .'admin/orders/index.php');
        } 
        // Cập nhật dữ liệu không thành công
        $errors = $order->getValidationErrors();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Meta -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật đơn hàng</title>
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
                                <div class="page-title-icon"><i class="fa fa-briefcase" aria-hidden="true"></i></div>
                                <div>
                                    Chỉnh sửa đơn hàng
                                    <div class="page-title-subheading wow fadeIn" data-wow-duration="2s">Chỉnh sửa thông tin đơn hàng trong danh sách của bạn.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Table Content -->
                    <div class="tabs-animation">
                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fa fa-table" aria-hidden="true"></i>
                                Form chỉnh sửa thông tin Đơn hàng
                            </div>
                            <div class="card-body">

                                <form name="frmEdit" id="frmEdit" action=""  method="post" class="justify-content-center">
                                    
                                    <!-- <input type="hidden" name="sp_ma" value="<?= htmlspecialchars($order->getDh_ma()) ?>"> -->
                                        <!-- Mã đơn hàng -->
                                        <div class="form-group<?= isset($errors['dh_ma']) ? ' has-error' : '' ?>">
                                            <label for="dh_ma">Mã đơn hàng</label>
                                            <input type="text" name="dh_ma" class="form-control" maxlen="100" id="dh_ma" placeholder="Mã đơn hàng" readonly value="<?= htmlspecialchars($order->getDh_ma()) ?>" />

                                            <?php if (isset($errors['dh_ma'])) : ?>
                                                <span class="help-block">
                                                    <strong><?= htmlspecialchars($errors['dh_ma']) ?></strong>
                                                </span>
                                            <?php endif ?>
                                        </div>
                                        
                                        
                                        <!-- Ngày giao, Trạng thái -->
                                        <div class="form-row">

                                            <div class="col-md-6 form-group<?= isset($errors['dh_ngaygiao']) ? ' has-error' : '' ?>">
                                                <label for="dh_ngaygiao">Ngày giao</label>
                                                <input type="datetime-local" name="dh_ngaygiao" id="dh_ngaygiao" class="form-control" value="<?= htmlspecialchars($order->dh_ngaygiao) ?>"/>

                                                <?php if (isset($errors['dh_ngaygiao'])) : ?>
                                                    <span class="help-block">
                                                        <strong><?= htmlspecialchars($errors['dh_ngaygiao']) ?></strong>
                                                    </span>
                                                <?php endif ?>
                                            </div>

                                            <div class="col-sm-6 form-group<?= isset($errors['dh_trangthaithanhtoan']) ? ' has-error' : '' ?>">
                                                <label for="dh_trangthaithanhtoan">Trạng thái thanh toán</label>
                                               

                                                <select name="dh_trangthaithanhtoan" id="dh_trangthaithanhtoan" class="form-control">
                                                    <option value="">Chọn trạng thái cho đơn hàng</option>
                                                    <option value="1">Đã giao hàng</option>
                                                    <option value="0">Chưa xử lý</option>
                                                </select> 

                                                <?php if (isset($errors['dh_trangthaithanhtoan'])) : ?>
                                                    <span class="help-block">
                                                        <strong><?= htmlspecialchars($errors['dh_trangthaithanhtoan']) ?></strong>
                                                    </span>
                                                <?php endif ?>
                                            </div>

                                        </div>


                                        <!-- Nơi giao, ghi chú -->
                                        <div class="form-row">
                                            
                                            <div class="col-sm-6 form-group<?= isset($errors['dh_noigiao']) ? ' has-error' : '' ?>">
                                                <label for="dh_noigiao">Nơi giao</label>
                                                <input type="text" name="dh_noigiao" class="form-control" id="dh_noigiao"  maxlen="255" placeholder="Nhập vào nơi giao (Tối đa 255 kí tự)" value="<?= htmlspecialchars($order->dh_noigiao) ?>" />

                                                <?php if (isset($errors['dh_noigiao'])) : ?>
                                                    <span class="help-block">
                                                        <strong><?= htmlspecialchars($errors['dh_noigiao']) ?></strong>
                                                    </span>
                                                <?php endif ?>
                                            </div>

                                            <div class="col-sm-6 form-group<?= isset($errors['dh_ghichu']) ? ' has-error' : '' ?>">
                                                <label for="dh_ghichu">Ghi chú</label>
                                                <input type="text" name="dh_ghichu" class="form-control" id="dh_ghichu"  maxlen="255" placeholder="Nhập vào ghi chú (Tối đa 255 kí tự)" value="<?= htmlspecialchars($order->dh_ghichu) ?>" />

                                                <?php if (isset($errors['dh_ghichu'])) : ?>
                                                    <span class="help-block">
                                                        <strong><?= htmlspecialchars($errors['dh_ghichu']) ?></strong>
                                                    </span>
                                                <?php endif ?>
                                            </div>

                                        </div>

                                        <div class="form-row">
                                            <!-- Hiển thị tên khách hàng -> Gửi tên đăng nhập cho Server -->
                                            <div class="col-sm-6 form-group<?= isset($errors['kh_tendangnhap']) ? ' has-error' : '' ?>">
                                                <label for="kh_tendangnhap">Tên khách hàng</label>
                                                <select name="kh_tendangnhap" id="kh_tendangnhap" class="form-control">
                                                    <?php foreach($customers as $customer): ?>
                                                        <?php if( ($customerOrder->kh_tendangnhap)  == ($customer->kh_tendangnhap) ): ?>
                                                            <option selected value="<?= ($customer->kh_tendangnhap) ?>"><?= ($customer->kh_ten) ?></option>
                                                        <?php else: ?>
                                                            <option value="<?= ($customer->kh_tendangnhap) ?>"><?= ($customer->kh_ten) ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>   

                                                <?php if (isset($errors['kh_tendangnhap'])) : ?>
                                                    <span class="help-block">
                                                        <strong><?= htmlspecialchars($errors['kh_tendangnhap']) ?></strong>
                                                    </span>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <!-- Submit -->
                                        <button type="submit" name="submit" id="submit" class="btn btn-primary mt-3">Cập nhật đơn hàng</button>
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

    <script>
        $(document).ready(function() {
            // Gọi wow js
            new WOW().init();
        });
    </script>
</body>
</html>