<?php
    require_once '../../../bootstrap.php';
    use DientuCT\Project\Sanpham;
    $sanpham = new Sanpham($PDO);
    $sanpham = $sanpham->all();
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <?php include_once __DIR__ . '../../layouts/meta.php'; ?>
    <title>Danh sách sản phẩm</title>
    <?php include_once __DIR__ . '../../layouts/styles.php'; ?>

</head>
<body>

    <?php include_once __DIR__ . '../../../../partialsBE/header.php'; ?>
    <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);     
    ?>
    
    <div class="container-fluid">
        <div class="row">
            <?php include_once __DIR__ . '../../../../partialsBE/sidebar.php'; ?>

            <div class="col-md-10 justify-content-center">
                <h2 class="text-center mt-3 wow fadeIn" data-wow-delay="0.05s" >Danh sách sản phẩm</h2>
                <a href="create.php" class="btn btn-primary mb-2">
                    <i class="fa fa-plus"></i> Thêm mới</a>
                <table id="tblSanpham" class="table table-bordered table-hover table-responsive-lg table-striped table-sm ">
                        <thead class="text-center thead-dark">
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Màn hình</th>
                                <th>Camera trước</th>
                                <th>Camera sau</th>
                                <th>Ram</th>
                                <th>Rom</th>
                                <th>Pin</th>
                                <th>Nhà sản xuất</th>
                                <th>Loại sản phẩm</th>
                                <th>Giá (vnđ)</th>
                                <th>Giá cũ</th>
                                <th>Ngày tạo</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($sanpham as $sanpham): ?>
                                    <tr>
                                        <td><?=htmlspecialchars($sanpham->sp_ten)?></td>
                                        <td><?=($sanpham->sp_soluong)?></td>
                                        <td><?=htmlspecialchars($sanpham->sp_manhinh)?></td>
                                        <td><?=htmlspecialchars($sanpham->sp_camera_truoc)?></td>
                                        <td><?=htmlspecialchars($sanpham->sp_camera_sau)?></td>
                                        <td><?=htmlspecialchars($sanpham->sp_ram)?></td>
                                        <td><?=htmlspecialchars($sanpham->sp_rom)?></td>
                                        <td><?=htmlspecialchars($sanpham->sp_pin)?></td>
                                        <td><?=htmlspecialchars($sanpham->sp_nsx)?></td>
                                        <td><?=htmlspecialchars($sanpham->sp_lsp)?></td>
                                        <td><?=htmlspecialchars(number_format( ($sanpham->sp_gia) , 0, ".", ","))?></td>
                                        <td><?=htmlspecialchars(number_format( ($sanpham->sp_giacu) , 0, ".", ","))?></td>
                                        <td><?=htmlspecialchars($sanpham->sp_thoigiantao)?></td>                                                                          
                                        </td>
                                        <td>
                                            <a href="<?=BASE_URL_PATH . 'backend/sanpham/edit.php?sp_ma=' . $sanpham->getSp_ma()?>"
                                                class="btn btn-sm btn-warning btnEdit mb-2">
                                                <i alt="Edit" class="fa fa-pencil"> Sửa</i></a>

                                                <button type="button" class="btn btn-sm btn-danger btnDelete" data-sp_ma="<?= $sanpham->getSp_ma() ?>">
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
    <?php include_once __DIR__ . '../../../../partialsBE/footer.php'; ?>
    <?php include_once __DIR__ . '../../layouts/scripts.php'; ?>

    <script>
        $(document).ready(function() {
            // Gọi wow js
            new WOW().init();
            // Yêu cầu DataTable quản lý datatable #tblKhachhang
            $('#tblSanpham').DataTable({
                dom: 'Blfrtip',
                "bProcessing": true,
                "bAutoWidth": false,
                "responsive": true,
                "buttons": [
                    'copy', 'excel', 'csv', 'pdf'
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
                            var sp_ma = $(this).data('sp_ma');
                            var url = "delete.php?sp_ma=" + sp_ma;
                            // Điều hướng qua trang xóa với REQUEST GET, có tham số km_ma=...
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