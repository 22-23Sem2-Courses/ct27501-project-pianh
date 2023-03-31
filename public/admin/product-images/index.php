<?php
    if (session_id() === '') {
        session_start();
    }

    if (!isset($_SESSION['kh_tendangnhap_logged'])){
        echo '<script>location.href = "/admin/auth/login.php";</script>';
    }
    require_once '../../../bootstrap.php';
    use DientuCT\Project\ProductImage;


    $productImage = new ProductImage($PDO);
    $productImages = $productImage->all();

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <?php include_once __DIR__ . '../../layouts/meta.php'; ?>
    <title>Danh sách các hình sản phẩm</title>
    <?php include_once __DIR__ . '../../layouts/styles.php'; ?>
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
                                <div class="page-title-icon"><i class="fa fa-picture-o" aria-hidden="true"></i></div>
                                <div>
                                    Danh sách hình sản phẩm
                                    <div class="page-title-subheading wow fadeIn" data-wow-duration="2s">Hiển thị toàn bộ danh sách hình sản phẩm của bạn.</div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <!-- Table Content -->
                    <div class="tabs-animation">
                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fa fa-table" aria-hidden="true"></i>
                                Table Hình sản phẩm
                            </div>
                            <div class="card-body">
                                <a href="create.php" class="btn btn-primary mb-2">
                                    <i class="fa fa-plus"></i> Thêm mới
                                </a>             
                                
                                <table id="tblProduct_images" class="table table-bordered table-hover table-responsive-lg table-striped table-sm ">
                                        <thead class="text-center thead-dark">
                                            <tr>
                                                <th>Mã hình ảnh</th>
                                                <th>Tập tin hình</th>
                                                <th>Sản phẩm</th>
                                                <th>Loại sản phẩm</th>
                                                <th>Thời gian tạo</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <?php foreach($productImages as $productImage): ?>
                                                    <tr>
                                                        <td><?=($productImage->hsp_ma)?></td>
                                                        <td>
                                                            <img src="../../assets/uploads/<?=htmlspecialchars($productImage->hsp_tentaptin)?>" class="product__img img-fluid">
                                                        </td>
                                                        <td><?=htmlspecialchars($productImage->sp_ten)?></td>
                                                        <td><?=htmlspecialchars($productImage->sp_lsp)?></td>
                                                        <td><?=htmlspecialchars($productImage ->hsp_thoigiantao)?></td>                                                                          
                                                        </td>
                                                        <td>
                                                            <a href="<?=BASE_URL_PATH . 'admin/product-images/edit.php?hsp_ma=' . $productImage->getHsp_ma()?>"
                                                                class="btn btn-sm btn-warning btnEdit mb-2 mt-2">
                                                                <i alt="Edit" class="fa fa-pencil"> Sửa</i></a>

                                                                <button type="button" class="btn btn-sm btn-danger btnDelete" data-hsp_ma="<?= $productImage->getHsp_ma() ?>">
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
    <?php include_once __DIR__ . '../../layouts/scripts.php'; ?>
    <script>
        $(document).ready(function() {
            //Gọi wow js
            new WOW().init();

            // //Header toggle-mobile click
            // $('#header__toggle-mobile').click(function() {
            //     // alert('ok');
            //     $('.header__content').slideToggle();
            // })
            
            // Yêu cầu DataTable quản lý datatable #tblHinhsanpham
            $('#tblProduct_images').DataTable({
                dom: 'Blfrtip',
                "bProcessing": true,
                "bAutoWidth": false,
                "responsive": true,
                "buttons": [
                    'copy', 'excel', 'csv', 'pdf','print'
                ]  
            });
            
            // Cảnh báo khi xóa với sweetalert
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
                            var hsp_ma = $(this).data('hsp_ma');
                            var url = "delete.php?hsp_ma=" + hsp_ma;
                            location.href = url;
                        } else { // Nếu không đồng ý xóa
                            swal("Cẩn thận hơn nhé!");
                        }
                    });
            });
        });
    </script>
   
</body>
</html>