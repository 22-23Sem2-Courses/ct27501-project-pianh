<?php
    require_once '../../../../bootstrap.php';
    use DientuCT\Project\Product;
    $product = new Product($PDO);
    $products = $product->all();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Xuất báo cáo đơn đặt hàng</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../../assets/admin/css/bootstrap.min.css" type="text/css" />
    <!-- Font awesome -->
    <link rel="stylesheet" href="../../../assets/admin/css/font-awesome.min.css" type="text/css" />
    <!-- Datatables CSS -->
    <link href="../../../assets/admin/css/datatables.min.css" rel="stylesheet"/>
    <!-- Animate CSS -->
    <link href="../../../assets/admin/css/animate.css" rel="stylesheet"/>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../../../assets/admin/css/base.css" type="text/css" />
    <link rel="stylesheet" href="../../../assets/admin/css/styles.css" type="text/css" />
    <link rel="stylesheet" href="../../../assets/admin/css/responsive.css" type="text/css" />

</head>
<body>

    <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);     
    ?>
    
    <?php include_once __DIR__ . '../../../../../partials/admin/header.php'; ?>

    <div class="container-fluid">
        <div class="main row">
            <?php include_once __DIR__ . '../../../../../partials/admin/sidebar.php'; ?>

            <div class="main__outer">
                <div class="main__inner">
                    <!-- Page Title -->
                    <div class="page-title wow fadeIn" data-wow-delay="0.05s">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading wow fadeIn" data-wow-duration="1s">
                                <div class="page-title-icon"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></div>
                                <div>
                                    Xuất báo cáo đơn đặt hàng
                                    <div class="page-title-subheading wow fadeIn" data-wow-duration="2s">Xuất báo cáo danh sách các đơn đặt hàng của bạn.</div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <!-- Table Content -->
                    <div class="tabs-animation">
                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fa fa-table" aria-hidden="true"></i>
                                Table Xuất báo cáo Đơn đặt hàng
                            </div>
                            <div class="card-body">
                                         
                                <table id="tblOrdersExport" class="table table-bordered table-hover table-responsive-lg table-striped table-sm ">
                                        <thead class="text-center thead-dark">
                                            <tr>
                                                <th>Xuất Excel</th>
                                                <th>Xuất Word</th>
                                                <th>Xuất PDF</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="/admin/reports-export/orders/genexcel.php" class="btn btn-success mt-3" target="_blank">Xuất Excel</a>
                                                    <br /><br />
                                                    <a href="/assets/templates/excels/orders-list.xlsx">Tải File Excel danh sách đơn đặt hàng</a>
                                                </td>
                                                <td>
                                                    <a href="/admin/reports-export/orders/genword.php" class="btn btn-success mt-3" target="_blank">Xuất Word</a>
                                                    <br /><br />
                                                    <a href="/assets/templates/words/orders-list.docx">Tải File Word danh sách đơn đặt hàng</a>
                                                </td>
                                                <td>
                                                    <a href="/admin/reports-export/orders/genpdf.php" class="btn btn-success mt-3" target="_blank">Xuất PDF</a>
                                                    <br /><br />
                                                    <a href="/assets/templates/pdfs/orders-list.pdf" target="_blank">Tải File PDF danh sách đơn đặt hàng</a>
                                                </td>
                                            </tr>

                                        </tbody>
                                </table> 

                            </div>
                        </div>
                    </div>


                </div>
            </div>
            
        </div>

    </div>

    <?php include_once __DIR__ . '../../../../../partials/admin/footer.php'; ?>
    <!-- jQuery JS -->
    <script src="../../../assets/admin/js/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="../../../assets/admin/js/bootstrap.min.js"></script>
    <!-- Wow js -->
    <script src="../../../assets/admin/js/wow.min.js"></script>
    <!-- SweetAlert JS-->
    <script src="../../../assets/admin/js/sweetalert.js"></script>
    <script src="../../../assets/admin/js/sweetalert.min.js"></script>
    <!-- Chart JS-->
    <script src="../../../assets/admin/js/chart.min.js"></script>
    <!-- DataTable JS -->
    <script src="../../../assets/admin/js/datatables.min.js"></script>
    <script src="../../../assets/admin/js/buttons.bootstrap4.min.js"></script>
    <script src="../../../assets/admin/js/pdfmake.min.js"></script>
    <script src="../../../assets/admin/js/vfs_fonts.js"></script>
    <!-- Custom JS -->
    <script src="../../../assets/admin/js/app.js"></script>

    <script>
        
    </script>
</body>
</html>