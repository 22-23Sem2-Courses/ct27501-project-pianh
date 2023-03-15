<?php
    require_once '../../../bootstrap.php';
    use DientuCT\Project\Khachhang;

    $khachhang = new Khachhang($PDO);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once __DIR__ . '../../layouts/meta.php'; ?>
    <title>Xóa khách hàng</title>
    <?php include_once __DIR__ . '../../layouts/styles.php'; ?>
</head>
<body>
    <?php include_once __DIR__ . '../../../../partialsBE/header.php'; ?>
    <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);     
    ?>

    <div class="container-fluid pb-450">
        <div class="row">
            <?php include_once __DIR__ . '../../../../partialsBE/sidebar.php'; ?>

            <div class="col-md-10">
                <h2 class="text-center mt-3 mb-4 wow fadeIn" data-wow-delay="0.05s">Xóa khách hàng</h2>
                <?php
                    $khachhangMuonXoa = $_GET['kh_tendangnhap'];
                    $data = [];
                    $statement = $PDO->query("SELECT * FROM khachhang where kh_tendangnhap = '$khachhangMuonXoa'");
                    while ($row = $statement->fetch()) {
                        $data[] = array(
                            'kh_tendangnhap' => $row['kh_tendangnhap'],
                            'kh_ten' => $row['kh_ten'],
                            'kh_dienthoai' => $row['kh_dienthoai'],
                            'kh_email' => $row['kh_email']
                        );
                    }
                ?>

                <form name="frmDelete" id="frmDelete" method="post"  action="">
                        <div class="form-row">
                            <div class="col-sm-3 form-group">
                                <label for="kh_tendangnhap">Tên đăng nhập (*)</label>
                                <input type="text" name="kh_tendangnhap" id="kh_tendangnhap" class="form-control" readonly
                                    value="<?= $khachhangMuonXoa ?>"/>
                            </div>
                            <div class="col-sm-3 form-group">
                                <label for="kh_ten" >Tên khách hàng</label>
                                <?php foreach($data as $kh): ?>
                                    <input type="text" name="kh_ten" class="form-control" id="kh_ten" readonly 
                                        placeholder="Tên khách hàng" value="<?= $kh['kh_ten'] ?>" />
                                <?php endforeach; ?>
                            </div>

                            <div class="col-sm-3 form-group">
                                <label for="kh_dienthoai">Số điện thoại</label>
                                <?php foreach($data as $kh): ?>
                                    <input type="text" name="kh_dienthoai" class="form-control" id="kh_dienthoai" readonly 
                                        placeholder="Số điện thoại" value="<?= $kh['kh_dienthoai'] ?>" />
                                <?php endforeach; ?>
                            </div>

                            <div class="col-sm-3 form-group">
                                <label for="kh_email">Email</label>
                                <?php foreach($data as $kh): ?>
                                    <input type="text" name="kh_email" class="form-control" id="kh_email" readonly 
                                        placeholder="Email" value="<?= $kh['kh_email'] ?>" />
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <button name="btnSave" id="btnSave" class="btn btn-danger mt-3">
                            Xóa khách hàng
                        </button>
                </form>

               

                <?php
                    // Khi người dùng bấm lưu thì xử lý
                    if (
                        $_SERVER['REQUEST_METHOD'] === 'POST'
                        && isset($_POST['btnSave'])
                        && isset($_POST['kh_tendangnhap'])
                        && ($khachhang->find($_POST['kh_tendangnhap'])) !== null
                    ) {
                        $khachhang->delete();
                        
                        echo '<script>location.href = "index.php"; </script>';
                    } 
                
                ?>
            </div>
        </div>
    </div>

    <?php include_once __DIR__ . '../../../../partialsBE/footer.php' ?>
    <?php include_once __DIR__ . '../../layouts/scripts.php' ?>

    <script>
        $(document).ready(function() {
            //Gọi wow js
            new WOW().init();
        });    
    </script>
</body>
</html>