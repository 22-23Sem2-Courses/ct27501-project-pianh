<?php

    require_once '../../../bootstrap.php';

    use DientuCT\Project\Khachhang;
    $khachhang = new Khachhang($PDO);
    $khachhang = $khachhang->all();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once __DIR__ . '/../layouts/meta.php'; ?>

    <title>Danh sách các khách hàng</title>


    <?php include_once __DIR__ . '/../layouts/styles.php'?>
    
</head>
<body>
    <?php include_once __DIR__ . '/../layouts/partials/header.php' ?>
    
    <div class="container-fluid pb-450">
        <div class="row">
            <?php include_once __DIR__ . '/../layouts/partials/sidebar.php' ?>


            <div class="col-md-10 justify-content-center">
                <?php
                    ini_set('display_errors', 1);
                    ini_set('display_startup_errors', 1);
                    error_reporting(E_ALL);
                    
                ?>
                </br>
                <h2 class="text-center">Danh sách các khách hàng hiện có</h2>
                <a href="create.php" class="btn btn-primary">
                    <i class="fa fa-plus"></i>Thêm mới</a>
                </br>
                </br>
                <table id="tblKhachhang" class="table table-bordered table-hover table-responsive-lg table-striped table-sm">
                        <thead class="text-center">
                            <tr>
                                <th>Tên đăng nhập</th>
                                <th>Tên khách hàng</th>
                                <th>Giới tính</th>
                                <th>Số điện thoại</th>
                                <th>CMND</th>
                                <th>Quản lý</th>
                                <th>Quản trị</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($khachhang as $khachhang): ?>
                                    <tr>
                                        <td><?=htmlspecialchars($khachhang->kh_tendangnhap)?></td>
                                        <td><?=htmlspecialchars($khachhang->kh_ten)?></td>
                                        <td>
                                            <?php 
                                            if (htmlspecialchars($khachhang->kh_gioitinh) == 1)
                                                echo "Nam";
                                            else 
                                                echo "Nữ";
                                            ?>
                                        </td>
                                        <td><?=htmlspecialchars($khachhang->kh_dienthoai)?></td>
                                        <td><?=htmlspecialchars($khachhang->kh_cmnd)?></td>
                                        <td class="text-center">
                                            <?php 
                                                if (htmlspecialchars($khachhang->kh_quanly) == 1)
                                                    echo "X";
                                                else echo "";
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <?php 
                                                if (htmlspecialchars($khachhang->kh_quantri) == 1)
                                                    echo "X";
                                                else echo "";
                                            ?>
                                        </td>                                    
                                        </td>
                                        <td>
                                            <a href="<?=BASE_URL_PATH . 'backend/khachhang/edit.php?id=' . $khachhang->getTendangnhap()?>"
                                                class="btn btn-xs btn-warning">
                                                <i alt="Edit" class="fa fa-pencil"></i> Sửa</a>
                                            <!-- <form class="delete" action="<?=BASE_URL_PATH . 'backend/khachhang/delete.php'?>"
                                                    method="POST" style="display: inline;">
                                                <input type="hidden" name="id"
                                                    value="<?=$khachhang->getTendangnhap()?>">
                                                <button type="submit" class="btn btn-xs btn-danger btnDelete"
                                                    name="delete-khachhang">
                                                    <i alt="Delete" class="fa fa-trash">Xóa</i></button>
                                            </form> -->
                        
                                            <button type="button" class="btn btn-danger btnDelete" data-kh_tendangnhap="<?= $khachhang->getTendangnhap() ?>">
                                                <i alt="Delete" class="fa fa-trash"></i> Xóa
                                            </button>
                                        </td>
                                    </tr>
                            <?php endforeach ?>
                        </tbody>
                </table>    

            </div>
        
        </div>
    </div>

    

    <?php include_once __DIR__ . '/../layouts/partials/footer.php' ?>
    <?php include_once __DIR__ . '/../layouts/scripts.php' ?>
       <!-- SweetAlert -->
    <script>
   $(document).ready(function() {
            // Yêu cầu DataTable quản lý datatable #tblKhachhang

            $('#tblKhachhang').DataTable({
                dom: 'Blfrtip',
                "bProcessing": true,
                "bAutoWidth": false,
                "responsive": true,
                "buttons": [
                    'copy', 'excel', 'csv', 'pdf'
                ]
            });

            // Cảnh báo khi xóa
            // 1. Đăng ký sự kiện click cho các phần tử (element) đang áp dụng class .btnDelete
            $('.btnDelete').click(function() {
                // Click hanlder
                // 2. Sử dụng thư viện SweetAlert để hiện cảnh báo khi bấm nút xóa
                swal({
                        title: "Bạn có chắc chắn muốn xóa?",
                        text: "Một khi đã xóa, không thể phục hồi....",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) { // Nếu đồng ý xóa

                            // 3. Lấy giá trị của thuộc tính (custom attribute HTML) 'dh_ma'
                            // var dh_ma = $(this).attr('data-dh_ma');
                            var kh_tendangnhap = $(this).data('kh_tendangnhap');
                            var url = "delete.php?kh_tendangnhap=" + kh_tendangnhap;

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