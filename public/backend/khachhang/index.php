<?php
    require_once '../../../bootstrap.php';
    use DientuCT\Project\Khachhang;
    $khachhang = new Khachhang($PDO);
    $khachhang = $khachhang->all();
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <?php include_once __DIR__ . '../../layouts/meta.php'; ?>
    <title>Danh sách các khách hàng</title>
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
                <h2 class="text-center mt-3 wow fadeIn" data-wow-delay="0.05s" >Danh sách khách hàng</h2>
                <a href="create.php" class="btn btn-primary mb-2">
                    <i class="fa fa-plus"></i> Thêm mới</a>
                <table id="tblKhachhang" class="table table-bordered table-hover table-responsive-lg table-striped table-sm">
                        <thead class="text-center thead-dark">
                            <tr>
                                <th>Tên đăng nhập</th>
                                <th>Tên khách hàng</th>
                                <th>Giới tính</th>
                                <th>Số điện thoại</th>
                                <th>Email</th>
                                <th>CMND</th>
                                <!-- <th>Tạm khóa</th> -->
                                <th>Quản lý</th>
                                <th>Quản trị</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($khachhang as $kh): ?>
                                    <tr>
                                        <td><?=htmlspecialchars($kh->kh_tendangnhap)?></td>
                                        <td><?=htmlspecialchars($kh->kh_ten)?></td>
                                        <td class="text-center">
                                            <?php 
                                            if (htmlspecialchars($kh->kh_gioitinh) == 1)
                                                echo "Nam";
                                            else 
                                                echo "Nữ";
                                            ?>
                                        </td>
                                        <td><?=htmlspecialchars($kh->kh_dienthoai)?></td>
                                        <td><?=htmlspecialchars($kh->kh_email)?></td>
                                        <td><?=htmlspecialchars($kh->kh_cmnd)?></td>
                                        <!-- <td class="text-center">
                                            <?php 
                                                if (htmlspecialchars($kh->kh_trangthai) == 1)
                                                    echo "X";
                                                else echo "";
                                            ?>
                                        </td> -->
                                        <td class="text-center">
                                            <?php 
                                                if (htmlspecialchars($kh->kh_quanly) == 1)
                                                    echo "X";
                                                else echo "";
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <?php 
                                                if (htmlspecialchars($kh->kh_quantri) == 1)
                                                    echo "X";
                                                else echo "";
                                            ?>
                                        </td>                                    
                                        </td>
                                        <td>
                                            <a href="<?=BASE_URL_PATH . 'backend/khachhang/edit.php?kh_tendangnhap=' . $kh->getKh_tendangnhap()?>"
                                                class="btn btn-sm btn-warning btnEdit">
                                                <i alt="Edit" class="fa fa-pencil"> Sửa</i></a>
                                                 

                                            <form class="delete" action="<?=BASE_URL_PATH . 'backend/khachhang/delete.php'?>"
                                                    method="POST" style="display: inline;">
                                                
                                                <button type="button" class="btn btn-sm btn-danger btnDelete" data-kh_tendangnhap="<?= $kh->getKh_tendangnhap() ?>">
                                                    <i alt="Delete" class="fa fa-trash"> Xóa</i>
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
    <?php include_once __DIR__ . '../../../../partialsBE/footer.php' ?>
    <?php include_once __DIR__ . '../../layouts/scripts.php' ?>

    <script>
        $(document).ready(function() {
            //Gọi wow js
            new WOW().init();
            
            // Yêu cầu DataTable quản lý datatable #tblKhachhang
            $('#tblKhachhang').DataTable({
                dom: 'Blfrtip',
                "bProcessing": true,
                "bAutoWidth": false,
                "responsive": true,
                "buttons": [
                    'copy', 'excel', 'csv', 'pdf',
                    
                ]
            });
            
            // Cảnh báo khi xóa với sweetalert
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
                            // 3. Lấy giá trị của thuộc tính (custom attribute HTML) 'kh_tendangnhap'
                            // var kh_tendangnhap = $(this).attr('data-kh_tendangnhap');
                            var kh_tendangnhap = $(this).data('kh_tendangnhap');
                            var url = "delete.php?kh_tendangnhap=" + kh_tendangnhap;
                            // Điều hướng qua trang xóa với REQUEST GET, có tham số kh_tendangnhap=...
                            location.href = url;
                        } else { // Nếu không đồng ý xóa
                            swal("Hãy cẩn thận hơn nhé!");
                        }
                    });
            });
        });
    </script>
</body>
</html>