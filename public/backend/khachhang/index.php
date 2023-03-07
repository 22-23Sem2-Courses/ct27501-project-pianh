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


            <div class="col-md-10">
                </br>
                <h1 class="text-center">Danh sách các khách hàng hiện có</h1>
                <?php
                    // Hiển thị tất cả lỗi trong PHP
                    // Chỉ nên hiển thị lỗi khi đang trong môi trường Phát triển (Development)
                    // Không nên hiển thị lỗi trên môi trường Triển khai (Production)
                    ini_set('display_errors', 1);
                    ini_set('display_startup_errors', 1);
                    error_reporting(E_ALL);
                    //1. Mở kết nối đến database
                    include_once __DIR__ . '/../../dbconnect.php';
                    //2. Chuan bi cau lenh
                    $sql = "SELECT * FROM khachhang;";

                    //3. Thuc thi
                    $result = mysqli_query($conn, $sql);

                    //4. Phân tách thành mảng array
                    $data = [];
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $data[] = array (
                            'kh_tendangnhap' => $row['kh_tendangnhap'],
                            'kh_ten' => $row['kh_ten'],
                            'kh_gioitinh' => $row['kh_gioitinh'],
                            'kh_dienthoai' => $row['kh_dienthoai'],
                            'kh_cmnd' => $row['kh_cmnd'],
                            'kh_quantri' => $row['kh_quantri'],
                            'kh_quanly' => $row['kh_quanly']
                           
                        );
                    }

                    //  var_dump($data);
                    //  die;
                ?>
                
                <a href="create.php" class="btn btn-primary">Thêm mới</a>
                </br>
                </br>
                    <table class="table table-bordered table-hover">
                        <thead class="table-info">
                            <tr>
                                <th>Tên đăng nhập</th>
                                <th>Tên Thành viên</th>
                                <th>Giới Tính</th>
                                <th>Số điện thoại</th>
                                <th>CMND</th>
                                <th>Quản lý</th>
                                <th>Quản trị</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                    <?php foreach($data as $kh): ?>
                        <tr>
                            <td><?= $kh['kh_tendangnhap']  ?>  </td>
                            <td><?php echo $kh['kh_ten']  ?></td>
                            <td><?php 
                            if ($kh['kh_gioitinh'] == 1)
                                echo "Nam";
                            else 
                                echo "Nữ";
                           
                            ?></td>
                            <td><?php echo $kh['kh_dienthoai']  ?></td>
                            <td><?php echo $kh['kh_cmnd']  ?></td>
                            <td><?php 
                            if ($kh['kh_quanly'] == 1)
                                echo "X";
                            else echo "";
                            ?></td>
                            <td><?php 
                            if ($kh['kh_quantri'] == 1)
                                echo "X";
                            else echo "";
                            ?></td>
                            <td>
                                <!-- Nút sửa -->
                                <a href="edit.php?kh_tendangnhap=<?= $kh['kh_tendangnhap']?>" class="btn btn-warning">Sửa</a>
                                <!-- Nút xóa -->
                                <!-- <a href="delete.php?kh_tendangnhap=<?= $kh['kh_tendangnhap']?>" class="btn btn-danger">Xóa</a> -->
                                <button type="button" class="btn btn-danger btnDelete" data-kh_tendangnhap="<?= $kh['kh_tendangnhap'] ?>">
                                    Xóa
                                </button>
                                </form>
                            </td>


                        </tr>
                    <?php endforeach; ?>
                    </table>    

            </div>
        
        </div>
    </div>

    

    <?php include_once __DIR__ . '/../layouts/partials/footer.php' ?>
    <?php include_once __DIR__ . '/../layouts/scripts.php' ?>
       <!-- SweetAlert -->
       <script>
   
   

    </script>
</body>
</html>