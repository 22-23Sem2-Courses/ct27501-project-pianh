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


?>

<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Meta -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bản tin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../assets/admin/css/bootstrap.min.css" type="text/css" />
    <!-- Font awesome -->
    <link rel="stylesheet" href="../../assets/admin/css/font-awesome.min.css" type="text/css" />
    <!-- Chart JS -->
    <link rel="stylesheet" href="../../assets/admin/css/Chart.min.css" type="text/css" />
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
                                <div class="page-title-icon"><i class="fa fa-rocket" aria-hidden="true"></i></div>
                                <div>
                                    Trang Bản tin Dashboard
                                    <div class="page-title-subheading wow fadeIn" data-wow-duration="2s">Hiển thị toàn bộ thông tin thống kê trên trang web của bạn.</div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <!-- Thống kê -->
                    <div class="tabs-animation">
                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fa fa-table" aria-hidden="true"></i>
                                Thống kê Tổng quan
                            </div>
                            <div class="card-body" style="background-color:#f1f2f3;">
                            
                                <div class="row" >

                                    <div class="col-md-3">
                                        <div class="card card__dashboard text-dark mb-3 border border-light" style="max-width: 18rem;">
                                            <div class="card-header text-center">Tổng số Sản phẩm</div>
                                            <div class="card-body">
                                                <div id="productQuantityReport" class="text-center"></div> 
                                            </div>

                                            <button type="button" class="btn btn-primary" id="btnRefeshProductQuantity">
                                                Refesh dữ liệu
                                            </button>
                                        </div>                           
                                    </div>

                                    <div class="col-md-3">
                                        <div class="card card__dashboard text-dark mb-3 border border-light" style="max-width: 18rem;">
                                            <div class="card-header text-center">Tổng số Khách hàng</div>
                                            <div class="card-body">
                                                <div id="customerQuantityReport" class="text-center"></div> 
                                            </div>
                                            
                                            <button type="button" class="btn btn-primary" id="btnRefeshCustomerQuantity">
                                                Refesh dữ liệu
                                            </button>
                                        </div>                           
                                    </div>

                                    
                                    <div class="col-md-3">
                                        <div class="card card__dashboard text-dark mb-3 border border-light" style="max-width: 18rem;">
                                            <div class="card-header text-center">Tổng số Đơn hàng</div>
                                            <div class="card-body">
                                                <div id="orderQuantityReport" class="text-center"></div> 
                                            </div>
                                            
                                            <button type="button" class="btn btn-primary" id="btnRefeshOrderQuantity">
                                                Refesh dữ liệu
                                            </button>
                                        </div>                           
                                    </div>

                                    <div class="col-md-3">
                                        <div class="card card__dashboard text-dark mb-3 border border-light" style="max-width: 18rem;">
                                            <div class="card-header text-center">Tổng số chương trinh Marketing</div>
                                            <div class="card-body">
                                                <div id="marketingQuantityReport" class="text-center"></div> 
                                            </div>
                                            
                                            <button type="button" class="btn btn-primary" id="btnRefeshMarketingQuantity">
                                                Refesh dữ liệu
                                            </button>
                                        </div>                           
                                    </div>
                                </div>
                            

                            </div>
                        </div>
                    </div>
                    </br></br>
                    <!-- Biểu đồ -->
                    <div class="tabs-animation">
                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fa fa-table" aria-hidden="true"></i>
                                Biểu đồ
                            </div>
                            <div class="card-body" >
                            
                                <div class="row" >
                                    <div class="col-md-12">
                                        <canvas id="chartOfobjChartProductImageStatistics"></canvas>
                                        </br>
                                        <div class="btnRefreshBarchart">
                                            <button id="refreshProductImageStatistics" class="btn btn-primary">
                                                Refresh biểu đồ hình sản phẩm
                                            </button>

                                        </div>
                                    </div>

                                    <!-- <div class="col-md-6">
                                        <canvas id="chartOfobjChartProductStatistics"></canvas>
                                        </br>
                                        <button id="refreshProductStatistics" class="btn btn-primary ">
                                            Refresh biểu đồ đặt hàng-sản phẩm
                                        </button>
                                    </div> -->
                                </div>

                            </div>
                        </div>
                    </div>
                    </br></br>

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
        $(function() {
            $('#btnRefeshProductQuantity').click(function() {
                //Nhờ AJAX gởi request đến APT
                $.ajax('/admin/apicall/product.php', {
                    success: function(data) {
                        var dataObj = JSON.parse(data);
                        var htmlString = `<h1>${(dataObj.soluongsanpham)}</h1>`;
                        $('#productQuantityReport').html(htmlString);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        var htmlString = '<h1>Không thể xử lý. Lỗi ${errorThrown}</h1>';
                        $('#productQuantityReport').html(htmlString);
                    }
                });
            });

            $('#btnRefeshCustomerQuantity').click(function() {
                //Nhờ AJAX gởi request đến APT
                $.ajax('/admin/apicall/customer.php', {
                    success: function(data) {
                        var dataObj = JSON.parse(data);
                        var htmlString = `<h1>${(dataObj.soluongkhachhang)}</h1>`;
                        $('#customerQuantityReport').html(htmlString);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        var htmlString = '<h1>Không thể xử lý. Lỗi ${errorThrown}</h1>';
                        $('#customerQuantityReport').html(htmlString);
                    }
                });
            });

            $('#btnRefeshOrderQuantity').click(function() {
                //Nhờ AJAX gởi request đến APT
                $.ajax('/admin/apicall/order.php', {
                    success: function(data) {
                        var dataObj = JSON.parse(data);
                        var htmlString = `<h1>${(dataObj.soluongdonhang)}</h1>`;
                        $('#orderQuantityReport').html(htmlString);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        var htmlString = '<h1>Không thể xử lý. Lỗi ${errorThrown}</h1>';
                        $('#orderQuantityReport').html(htmlString);
                    }
                });
            });

            $('#btnRefeshMarketingQuantity').click(function() {
                //Nhờ AJAX gởi request đến APT
                $.ajax('/admin/apicall/marketing.php', {
                    success: function(data) {
                        var dataObj = JSON.parse(data);
                        var htmlString = `<h1>${(dataObj.soluongmarketing)}</h1>`;
                        $('#marketingQuantityReport').html(htmlString);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        var htmlString = '<h1>Không thể xử lý. Lỗi ${errorThrown}</h1>';
                        $('#marketingQuantityReport').html(htmlString);
                    }
                });
            });

            


            //Vẽ biểu đồ thống kê hình sản phẩm sử dụng ChartJS
            
            var $objChartProductImageStatistics;
            var $chartOfobjChartProductImageStatistics =
            document.getElementById("chartOfobjChartProductImageStatistics").getContext("2d");

                $('#refreshProductImageStatistics').click(function() {
                    $.ajax('/admin/apicall/ImageStatistics.php', {
                        success: function(response) {
                            var data = JSON.parse(response);
                            var myLabels = [];
                            var myData = [];
                            $(data).each(function() {
                                myLabels.push((this.tensanpham));  // Giống dữ liệu API trả về
                                myData.push(this.soluong);
                            });
                            myData.push(0); // tạo dòng số liệu 0
                            if (typeof $objChartProductImageStatistics !== "undefined") {
                                $objChartProductImageStatistics.destroy();
                            }
                            $objChartProductImageStatistics = new Chart($chartOfobjChartProductImageStatistics, {
                            // Kiểu biểu đồ muốn vẽ. Các bạn xem thêm trên trang ChartJS
                            type: "bar",
                            data: {
                                labels: myLabels,
                                datasets: [{
                                data: myData,
                                borderColor: "#7BD1D1",
                                backgroundColor: "#D7ECFB",
                                borderWidth: 1
                                }]
                            },
                            // Cấu hình dành cho biểu đồ của ChartJS
                            options: {
                                legend: {
                                    display: false
                                },
                                plugins: {
                                    title: {
                                        display: true,
                                        text: "Thống kê số lượng hình của sản phẩm"
                                    },
                                    subtitle: {
                                        display: true,
                                        text: "Biểu đồ thống kê hình sản phẩm tại DientuCanTho.vn"
                                    }
                                },
                                responsive: true
                            }
                            });


                        }
                    });
                });


             //Vẽ biểu đồ thống kê Nhóm khóa học sử dụng ChartJS
             var $objChartProductStatistics;
            var $chartOfobjChartProductStatistics =
            document.getElementById("chartOfobjChartProductStatistics").getContext("2d");

                $('#refreshProductStatistics').click(function() {
                    $.ajax('/admin/apicall/ProductStatistics.php', {
                        success: function(response) {
                            var data = JSON.parse(response);
                            var myLabels = [];
                            var myData = [];
                            $(data).each(function() {
                                myLabels.push((this.tensanpham));  // Giống dữ liệu API trả về
                                myData.push(this.soluongdon);
                            });
                            myData.push(0); // tạo dòng số liệu 0
                            if (typeof $objChartProductStatistics !== "undefined") {
                                $objChartProductStatistics.destroy();
                            }
                            $objChartProductStatistics = new Chart($chartOfobjChartProductStatistics, {
                            // Kiểu biểu đồ muốn vẽ. Các bạn xem thêm trên trang ChartJS
                            type: "bar",
                            data: {
                                labels: myLabels,
                                datasets: [{
                                data: myData,
                                borderColor: "#7BD1D1",
                                backgroundColor: "#DBF2F2",
                                borderWidth: 1
                                }]
                            },
                            // Cấu hình dành cho biểu đồ của ChartJS
                            options: {
                                legend: {
                                    display: false
                                },
                                plugins: {
                                    title: {
                                        display: true,
                                        text: "Thống kê đơn đặt hàng theo sản phẩm"
                                    },
                                    subtitle: {
                                        display: true,
                                        text: "Biểu đồ thống kê đơn đặt hàng theo sản phẩm tại DientuCanTho.vn"
                                    }
                                },
                                responsive: true
                            }
                            });


                        }
                    });
                });


            



        });
    </script>
</body>
</html>