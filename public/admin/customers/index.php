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
    $customers = $customer->all();
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Meta -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách các khách hàng</title>
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
                                    Danh sách khách hàng
                                    <div class="page-title-subheading wow fadeIn" data-wow-duration="2s">Hiển thị toàn bộ danh sách khách hàng của bạn.</div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <!-- Table Content -->
                    <div class="tabs-animation">
                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fa fa-table" aria-hidden="true"></i>
                                Table Khách hàng
                            </div>
                            <div class="card-body">
                                <a href="create.php" class="btn btn-primary mb-2">
                                    <i class="fa fa-plus"></i> Thêm mới
                                </a>             
                                <table id="tblCustomers" class="table table-bordered table-hover table-responsive-lg table-striped table-sm">
                                        <thead class="text-center thead-dark">
                                            <tr>
                                                <th>Tên đăng nhập</th>
                                                <th>Tên khách hàng</th>
                                                <th>Giới tính</th>
                                                <th>Số điện thoại</th>
                                                <th>Email</th>
                                                <th>CMND</th>
                                                <th>Khóa</th>
                                                <th>Quản lý</th>
                                                <th>Quản trị</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($customers as $customer): ?>
                                                    <tr>
                                                        <td><?=htmlspecialchars($customer->kh_tendangnhap)?></td>
                                                        <td><?=htmlspecialchars($customer->kh_ten)?></td>
                                                        <td class="text-center">
                                                            <?php 
                                                            if (htmlspecialchars($customer->kh_gioitinh) == 1)
                                                                echo "Nam";
                                                            else 
                                                                echo "Nữ";
                                                            ?>
                                                        </td>
                                                        <td><?=htmlspecialchars($customer->kh_dienthoai)?></td>
                                                        <td><?=htmlspecialchars($customer->kh_email)?></td>
                                                        <td><?=htmlspecialchars($customer->kh_cmnd)?></td>
                                                        <td class="text-center">
                                                            <?php 
                                                                if (htmlspecialchars($customer->kh_trangthai) == 1)
                                                                    echo "X";
                                                                else echo "";
                                                            ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php 
                                                                if (htmlspecialchars($customer->kh_quanly) == 1)
                                                                    echo "X";
                                                                else echo "";
                                                            ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php 
                                                                if (htmlspecialchars($customer->kh_quantri) == 1)
                                                                    echo "X";
                                                                else echo "";
                                                            ?>
                                                        </td>                                    
                                                        </td>
                                                        <td>
                                                            <a href="<?=BASE_URL_PATH . 'admin/customers/edit.php?kh_tendangnhap=' . $customer->getKh_tendangnhap()?>"
                                                                class="btn btn-sm btn-warning btnEdit">
                                                                <i alt="Edit" class="fa fa-pencil"></i> Sửa</a>

                                                            <form class="delete" action="<?=BASE_URL_PATH . 'admin/customers/delete.php'?>"
                                                                    method="POST" style="display: inline;">
                                                                
                                                                <button type="button" class="btn btn-sm btn-danger btnDelete" data-kh_tendangnhap="<?= $customer->getKh_tendangnhap() ?>">
                                                                    <i alt="Delete" class="fa fa-trash"></i> Xóa
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                </table> 

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
            
            // $('#tblCustomers').DataTable();
            $('#tblCustomers').DataTable({
                dom: 'Blfrtip',
                "bProcessing": true,
                "bAutoWidth": false,
                "responsive": true,
                "buttons": [
                    'copy', 'excel', 'csv', 'pdf','print'
                ],
                lengthMenu: [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, 'All'],
                ],
                pageLength: 10,
                // scrollY: '600px',
                paging: true  
            });
            
            // Cảnh báo khi xóa với sweetalert
            $('#tblCustomers tbody').on('click', '.btnDelete', function () {
                $('.btnDelete').click(function() {
                    swal({
                            title: "Bạn có chắc chắn muốn xóa?",
                            text: "Một khi đã xóa, không thể phục hồi....",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) { // Nếu đồng ý xóa
                                var kh_tendangnhap = $(this).data('kh_tendangnhap');
                                var url = "delete.php?kh_tendangnhap=" + kh_tendangnhap;
                                // Điều hướng qua trang xóa với REQUEST GET, có tham số kh_tendangnhap=...
                                location.href = url;
                            } else { // Nếu không đồng ý xóa
                                swal("Cẩn thận hơn nhé!");
                            }
                        });
                });
            });

        });
    </script>
    
</body>
</html>