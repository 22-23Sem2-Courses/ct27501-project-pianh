<?php
    require_once '../../../bootstrap.php';
    use DientuCT\Project\Sanpham;

    $sanpham = new Sanpham($PDO);
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <?php include_once __DIR__ . '../../layouts/meta.php'; ?>
    <title>Xóa sản phẩm</title>
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
                <h2 class="text-center mt-3 mb-4 wow fadeIn" data-wow-delay="0.05s">Xóa sản phẩm</h2>
                <?php
                    // Hiển thị tất cả lỗi trong PHP
                    // Chỉ nên hiển thị lỗi khi đang trong môi trường Phát triển (Development)
                    // Không nên hiển thị lỗi trên môi trường Triển khai (Production)
                    ini_set('display_errors', 1);
                    ini_set('display_startup_errors', 1);
                    error_reporting(E_ALL);
                    $maMuonXoa = $_GET['sp_ma'];
                    $data = [];
                    $statement = $PDO->query("SELECT * FROM sanpham where sp_ma = $maMuonXoa");
                    while ($row = $statement->fetch()) {
                        $data[] = array(
                            'sp_ten' => $row['sp_ten'],
                            'sp_lsp' => $row['sp_lsp'],
                        );
                    }
                ?>

            <form name="frmDelete" id="frmDelete" method="post"  action="">
                    <div class="form-row">
                        <div class="col-sm-2 form-group">
                            <label for="sp_ma">Mã/ID sản phẩm (*)</label>
                            <input type="text" name="sp_ma" id="sp_ma" class="form-control" readonly
                                value="<?= $maMuonXoa ?>"/>
                        </div>
                        <div class="col-sm-7 form-group">
                            <label for="sp_ten" >Tên sản phẩm</label>
                            <?php foreach($data as $sp): ?>
                                <input type="text" name="sp_ten" class="form-control" id="sp_ten" readonly 
                                    placeholder="Tên sản phẩm" value="<?= $sp['sp_ten'] ?>" />
                            <?php endforeach; ?>
                        </div>

                        <div class="col-sm-3 form-group">
                            <label for="sp_lsp">Loại sản phẩm</label>
                            <?php foreach($data as $sp): ?>
                                <input type="text" name="sp_ten" class="form-control" id="sp_ten" readonly 
                                    placeholder="Loại sản phẩm" value="<?= $sp['sp_lsp'] ?>" />
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <button name="btnSave" id="btnSave" class="btn btn-danger mt-3">
                        Xóa sản phẩm
                    </button>
            </form>
                <?php
                // Khi người dùng bấm lưu thì tiến hành xử lý
                if (
                    $_SERVER['REQUEST_METHOD'] === 'POST'
                    && isset($_POST['btnSave'])
                    && isset($_POST['sp_ma'])
                    && ($sanpham->find($_POST['sp_ma'])) !== null
                ) {
                    $sanpham->delete();
                    echo '<script>location.href = "index.php"; </script>';
                } 
                ?>
            </div>
        
        </div>
    </div>

    <?php include_once __DIR__ . '../../../../partialsBE/footer.php'; ?>
    <?php include_once __DIR__ . '../../layouts/scripts.php'; ?>

    <script>
        $(document).ready(function() {
            //Gọi wow js
            new WOW().init();
        });    
    </script>
</body>
</html>