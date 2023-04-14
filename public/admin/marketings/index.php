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
    
    use DientuCT\Project\Marketing;
    $marketing = new Marketing($PDO);
    $marketings = $marketing->all();
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Meta -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách thông tin Marketing cho sản phẩm</title>
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
                                <div class="page-title-icon"><i class="fa fa-bullhorn" aria-hidden="true"></i></div>
                                <div>
                                    Danh sách thông tin Marketing cho sản phẩm
                                    <div class="page-title-subheading wow fadeIn" data-wow-duration="2s">Hiển thị toàn bộ danh sách thông tin Marketing cho sản phẩm của bạn.</div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <!-- Table Content -->
                    <div class="tabs-animation">
                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fa fa-table" aria-hidden="true"></i>
                                Table Sản phẩm
                            </div>
                            <div class="card-body">
                                <a href="create.php" class="btn btn-primary mb-2">
                                    <i class="fa fa-plus"></i> Thêm mới
                                </a>             
                                
                                <table id="tblMarketings" class="table table-bordered table-hover table-responsive-lg table-striped table-sm ">
                                        <thead class="text-center thead-dark">
                                            <tr>
                                                <th>Tên sản phẩm</th>
                                                <th>Tình trạng</th>
                                                <th>Bộ sản phẩm</th>
                                                <th>Bảo hành</th>
                                                <th>Hiệu năng</th>
                                                <th>Hiển thị</th>
                                                <th>Trải nghiệm</th>
                                                <th>Tính năng</th>
                                                <th>Dung lượng</th>
                                                <th>Điện năng</th>
                                                <th>Quà tặng</th>
                                                <th>Thời gian tạo</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <?php foreach($marketings as $marketing): ?>
                                                    <tr>
                                                        <td><?=htmlspecialchars($marketing->sp_ten)?></td>
                                                        <td><?=($marketing->mkt_tinhtrang)?></td>
                                                        <td><?=htmlspecialchars($marketing->mkt_bosanpham)?></td>
                                                        <td><?=htmlspecialchars($marketing->mkt_baohanh)?></td>
                                                        <td><?=htmlspecialchars($marketing->mkt_hieunang)?></td>
                                                        <td><?=htmlspecialchars($marketing->mkt_hienthi)?></td>
                                                        <td><?=htmlspecialchars($marketing->mkt_trainghiem)?></td>
                                                        <td><?=htmlspecialchars($marketing->mkt_tinhnang)?></td>
                                                        <td><?=htmlspecialchars($marketing->mkt_dungluong)?></td>
                                                        <td><?=htmlspecialchars($marketing->mkt_diennang)?></td>
                                                        <td><?=htmlspecialchars($marketing->mkt_quatang)?></td>
                                                        <td><?=htmlspecialchars($marketing->mkt_thoigiantao)?></td>                                                                          
                                                        </td>
                                                        <td>
                                                            <a href="<?=BASE_URL_PATH . 'admin/marketings/edit.php?mkt_ma=' . $marketing->getMkt_ma()?>"
                                                                class="btn btn-sm btn-warning btnEdit mb-2">
                                                                <i alt="Edit" class="fa fa-pencil"> Sửa</i></a>

                                                                <button type="button" class="btn btn-sm btn-danger btnDelete" data-mkt_ma="<?= $marketing->getMkt_ma() ?>">
                                                                    <i alt="Delete" class="fa fa-trash"> Xóa</i>
                                                                </button>
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

            // Yêu cầu DataTable quản lý datatable #tblProducts
            $('#tblMarketings').DataTable({
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
                scrollY: '600px',
                paging: true  
            });
            
            // Cảnh báo khi xóa với sweetalert
            $('#tblMarketings tbody').on('click', '.btnDelete', function () {
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
                                var mkt_ma = $(this).data('mkt_ma');
                                var url = "delete.php?mkt_ma=" + mkt_ma;
                                // Điều hướng qua trang xóa với REQUEST GET, có tham số mkt_ma=...
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