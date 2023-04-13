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

    use DientuCT\Project\Order;
    use DientuCT\Project\Customer;
    $customer = new Customer($PDO);
    $customers = $customer->all();


    use DientuCT\Project\Product;
    $product = new Product($PDO);
    $products = $product->all();

	$errors = [];
    


	// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// 	$order = new Order($PDO);
	// 	$order->fill($_POST);
    //     // var_dump($order);
    //     // die;
	// 	if ($order->validate()) {
	// 		$order->save() && redirect(BASE_URL_PATH .'admin/orders/index.php' );
	// 	} 
	// 	$errors = $order->getValidationErrors();
	// 	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Thêm mới đơn hàng</title>
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
                    <div class="page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading wow fadeIn" data-wow-delay="0.05s">
                                <div class="page-title-icon"><i class="fa fa-briefcase" aria-hidden="true"></i></div>
                                <div >
                                    Thêm mới đơn hàng
                                    <div class="page-title-subheading">Thêm mới đơn hàng vào danh sách đơn hàng của bạn.</div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <!-- Table Content -->
                    <div class="tabs-animation">
                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fa fa-table" aria-hidden="true"></i>
                                Form thêm mới Đơn hàng
                            </div>
                            <div class="card-body">

                                <form name="frmCreate" id="frmCreate" action=""  method="post" class="justify-content-center">
                                
                                    <!-- Tên khách hàng -> Gửi tên đăng nhập cho Server-->
                                    <div class="form-group<?= isset($errors['kh_tendangnhap']) ? ' has-error' : '' ?>">
                                        <label for="kh_tendangnhap">Tên khách hàng</label>
                                        <select  name="kh_tendangnhap" id="kh_tendangnhap" class="form-control">
                                            <option value="">Vui lòng chọn khách hàng</option>
                                            <?php foreach($customers as $customer): ?>
                                                <option value="<?=htmlspecialchars($customer->kh_tendangnhap)?>"> <?= "Tài khoản: " .htmlspecialchars($customer->kh_tendangnhap) ." - Họ tên: ". htmlspecialchars($customer->kh_ten) ." - SĐT: ". htmlspecialchars($customer->kh_dienthoai)  ?>  </option>

                                            <?php endforeach; ?>
                                        </select>

                                        <?php if (isset($errors['kh_tendangnhap'])) : ?>
                                            <span class="help-block">
                                                <strong><?= htmlspecialchars($errors['kh_tendangnhap']) ?></strong>
                                            </span>
                                        <?php endif ?>
                                    </div>

                                    <!-- Nơi giao, ghi chú -->
                                    <div class="form-row">
                        
                                        <div class="col-sm-6 form-group<?= isset($errors['dh_noigiao']) ? ' has-error' : '' ?>">
                                            <label for="dh_noigiao">Nơi giao</label>
                                            <textarea name="dh_noigiao" id="dh_noigiao" class="form-control" maxlen="255" placeholder="Nhập vào nơi giao (Tối đa 255 kí tự)"><?= isset($_POST['dh_noigiao']) ? htmlspecialchars($_POST['dh_noigiao']) : '' ?></textarea>

                                            <?php if (isset($errors['dh_noigiao'])) : ?>
                                                <span class="help-block">
                                                    <strong><?= htmlspecialchars($errors['dh_noigiao']) ?></strong>
                                                </span>
                                            <?php endif ?>
                                        </div>

                                        <div class="col-sm-6 form-group<?= isset($errors['dh_ghichu']) ? ' has-error' : '' ?>">
                                            <label for="dh_ghichu">Ghi chú</label>
                                            <textarea name="dh_ghichu" id="dh_ghichu" class="form-control" maxlen="255" placeholder="Nhập vào ghi chú (Tối đa 255 kí tự)"><?= isset($_POST['dh_ghichu']) ? htmlspecialchars($_POST['dh_ghichu']) : '' ?></textarea>

                                            <?php if (isset($errors['dh_ghichu'])) : ?>
                                                <span class="help-block">
                                                    <strong><?= htmlspecialchars($errors['dh_ghichu']) ?></strong>
                                                </span>
                                            <?php endif ?>
                                        </div>

                                    </div>

                                    <!-- Trạng thái, ngày giao -->
                                    <div class="form-row">
                                        <div class="col-md-6 form-group<?= isset($errors['dh_trangthaithanhtoan']) ? ' has-error' : '' ?>">
                                            <label for="dh_trangthaithanhtoan">Trạng thái thanh toán</label><br />

                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" name="dh_trangthaithanhtoan" id="dh_trangthaithanhtoan-1" class="custom-control-input" value="0" checked>
                                                <label class="custom-control-label" for="dh_trangthaithanhtoan-1">Chưa thanh toán</label>
                                            </div>

                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" name="dh_trangthaithanhtoan" id="dh_trangthaithanhtoan-2" class="custom-control-input" value="1">
                                                <label class="custom-control-label" for="dh_trangthaithanhtoan-2">Đã thanh toán</label>
                                            </div>

                                            <?php if (isset($errors['dh_trangthaithanhtoan'])) : ?>
                                                <span class="help-block">
                                                    <strong><?= htmlspecialchars($errors['dh_trangthaithanhtoan']) ?></strong>
                                                </span>
                                            <?php endif ?>
                                        </div>

                                        
                                        <div class="col-md-6 form-group<?= isset($errors['dh_ngaygiao']) ? ' has-error' : '' ?>">
                                            <label for="dh_ngaygiao">Ngày giao</label>
                                            <input type="datetime-local" name="dh_ngaygiao" id="dh_ngaygiao" class="form-control" />

                                            <?php if (isset($errors['dh_ngaygiao'])) : ?>
                                                <span class="help-block">
                                                    <strong><?= htmlspecialchars($errors['dh_ngaygiao']) ?></strong>
                                                </span>
                                            <?php endif ?>
                                        </div>

                                    </div>

                                    <!-- Sản phẩm, số lượng -->
                                    <fieldset id="orderDetailContainer">
                                        <legend>Thông tin Chi tiết Đơn đặt hàng</legend>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="sp_ma">Sản phẩm</label>
                                                    <select class="form-control" id="sp_ma" name="sp_ma">
                                                        <option value="">Vui lòng chọn sản phẩm</option>
                                                        <?php foreach ($products as $product) : ?>
                                                            <option value="<?=htmlspecialchars($product->sp_ma)?>" data-sp_gia="<?= htmlspecialchars($product->sp_gia) ?>"><?= htmlspecialchars($product->sp_ten) ?></option>
                                                        <?php endforeach; ?>
                                                    </select>

                                                    <?php if (isset($errors['sp_ma'])) : ?>
                                                        <span class="help-block">
                                                            <strong><?= htmlspecialchars($errors['sp_ma']) ?></strong>
                                                        </span>
                                                    <?php endif ?>

                                                </div>
                                            </div>

                                            
                                                
                                            <div class="col-md-3 form-group">
                                                <label for="soluong">Số lượng</label>
                                                <input type="number" name="soluong" class="form-control" id="soluong" placeholder="Nhập vào số lượng" value="<?= isset($_POST['dh_sp_soluong']) ? htmlspecialchars($_POST['dh_sp_soluong']) : '' ?>" />

                                                <!-- <?php if (isset($errors['dh_sp_soluong'])) : ?>
                                                    <span class="help-block">
                                                        <strong><?= htmlspecialchars($errors['dh_sp_soluong']) ?></strong>
                                                    </span>
                                                <?php endif ?> -->
                                            </div>

                                            
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Xử lý</label><br />
                                                    <button type="button" id="btnAddProduct" class="btn btn-secondary">Thêm vào đơn đặt hàng</button>
                                                </div>
                                            </div>

                                        </div>

                                        <table id="tblOrderDetail" class="table table-bordered">
                                            <thead>
                                                <th>Sản phẩm</th>
                                                <th>Số lượng</th>
                                                <th>Đơn giá</th>
                                                <th>Thành tiền</th>
                                                <th>Hành động</th>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </fieldset>
                                    

                                    <!-- Submit -->
                                    <button class="btn btn-primary" name="btnSave">Thêm mới đơn hàng</button>
                                    <a href="index.php" class="btn btn-outline-secondary" name="btnBack" id="btnBack">Quay về</a>
                                </form>           
                                
                            </div>
                        </div>
                    </div>

                    <?php
                        
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            $order = new Order($PDO);

                            $sp_ma = $_POST['sp_ma'];
                            $kh_tendangnhap = $_POST['kh_tendangnhap'];
                           
                            $dh_ngaygiao = $_POST['dh_ngaygiao'];
                            $dh_noigiao = $_POST['dh_noigiao'];
                            $dh_trangthaithanhtoan = $_POST['dh_trangthaithanhtoan'];

                            // Thông tin các dòng chi tiết đơn hàng
                            $arr_sp_ma = $_POST['sp_ma'];                   // mảng array do đặt tên name="sp_ma[]"
                            $arr_sp_dh_soluong = $_POST['sp_dh_soluong'];   // mảng array do đặt tên name="sp_dh_soluong[]"
                            $arr_sp_dh_dongia = $_POST['sp_dh_dongia'];     // mảng array do đặt tên name="sp_dh_dongia[]"
                            // var_dump($sp_ma);die;
                        
                            $statement = $PDO->prepare(
                                'insert into dondathang (dh_ngaygiao, dh_noigiao, dh_trangthaithanhtoan, kh_tendangnhap, dh_thoigiantao, dh_thoigiancapnhat)
                                    values (:dh_ngaygiao, :dh_noigiao, :dh_trangthaithanhtoan, :kh_tendangnhap, now(), now())'
                            );

                                    // var_dump($statement);
                                    // die;
                            $result = $statement->execute([
                                'dh_ngaygiao' => $dh_ngaygiao,
                                'dh_noigiao' => $dh_noigiao,
                                'dh_trangthaithanhtoan' => $dh_trangthaithanhtoan,
                                'kh_tendangnhap' => $kh_tendangnhap
                            ]);
                            
                            
                            $dh_ma = $PDO->lastInsertId();
                            
                            for($i = 0; $i < count($arr_sp_ma); $i++) {
                                $sp_ma = $arr_sp_ma[$i];
                                $sp_dh_soluong = $arr_sp_dh_soluong[$i];
                                $sp_dh_dongia = $arr_sp_dh_dongia[$i];

                            
                            $statement = $PDO->prepare(
                                'insert into sanpham_dondathang (sp_ma, dh_ma, sp_dh_soluong, sp_dh_dongia)
                                    values (:sp_ma, :dh_ma, :sp_dh_soluong, :sp_dh_dongia)'
                            );

                                    // var_dump($statement);
                                    // die;
                            $result = $statement->execute([
                                'sp_ma' => $sp_ma,
                                'dh_ma' => $dh_ma,
                                'sp_dh_soluong' => $sp_dh_soluong,
                                'sp_dh_dongia' => $sp_dh_dongia
                            ]);

                        }
                        echo '<script>location.href ="index.php";</script>';

                    }

                                
                    ?>


                    
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
        // Đăng ký sự kiện Click nút Thêm Sản phẩm
        $('#btnAddProduct').click(function() {
            // debugger;
            // Lấy thông tin Sản phẩm
            var sp_ma = $('#sp_ma').val();
            var sp_gia = $('#sp_ma option:selected').data('sp_gia');
            var sp_ten = $('#sp_ma option:selected').text();
            var soluong = $('#soluong').val();
            var thanhtien = (soluong * sp_gia);
            
            // Tạo mẫu giao diện HTML Table Row
            var htmlTemplate = '<tr>'; 
            htmlTemplate += '<td>' + sp_ten + '<input type="hidden" name="sp_ma[]" value="' + sp_ma + '"/></td>';
            htmlTemplate += '<td>' + soluong + '<input type="hidden" name="sp_dh_soluong[]" value="' + soluong + '"/></td>';
            htmlTemplate += '<td>' + sp_gia + '<input type="hidden" name="sp_dh_dongia[]" value="' + sp_gia + '"/></td>';
            htmlTemplate += '<td>' + thanhtien + '</td>';
            htmlTemplate += '<td><button type="button" class="btn btn-danger btn-delete-row"> <i alt="Delete" class="fa fa-trash"> Xóa</i></button></td>';
            htmlTemplate += '</tr>';

            // Thêm vào TABLE BODY
            $('#tblOrderDetail tbody').append(htmlTemplate);

            // Clear
            $('#sp_ma').val('');
            $('#soluong').val('');
        });

        // Đăng ký sự kiện cho tất cả các nút XÓA có sử dụng class .btn-delete-row
        $('#orderDetailContainer').on('click', '.btn-delete-row', function() {
            $(this).parent().parent()[0].remove();
        });
    </script>
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