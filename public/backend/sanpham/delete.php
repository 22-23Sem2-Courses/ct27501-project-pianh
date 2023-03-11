<?php
    require_once '../../../bootstrap.php';
    use DientuCT\Project\Sanpham;

    $sanpham = new Sanpham($PDO);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once __DIR__ . '/../layouts/meta.php'; ?>

    <title>Xóa sản phẩm</title>

    <?php include_once __DIR__ . '/../layouts/styles.php'?>
    <style>
    </style>
</head>
<body>
    <?php include_once __DIR__ . '/../layouts/partials/header.php' ?>
    
    <div class="container-fluid pb-450">
        <div class="row">
            <?php include_once __DIR__ . '/../layouts/partials/sidebar.php' ?>


            <div class="col-md-10">

            

                </br>
                <h2 class="text-center">Xóa sản phẩm</h2>
                <?php
                    $maMuonXoa = $_GET['sp_ma'];
                    $data = [];
                    $statement = $PDO->query("SELECT * FROM sanpham where sp_ma = $maMuonXoa ");
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
                    <button name="btnSave" id="btnSave" class="btn btn-danger">
                        Xóa sản phẩm
                    </button>
            </form>

               

                <?php
                // Hiển thị tất cả lỗi trong PHP
                // Chỉ nên hiển thị lỗi khi đang trong môi trường Phát triển (Development)
                // Không nên hiển thị lỗi trên môi trường Triển khai (Production)
                ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);
                // Khi người dùng bấm lưu thì xử lý
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

    

    <?php include_once __DIR__ . '/../layouts/partials/footer.php' ?>
    <?php include_once __DIR__ . '/../layouts/scripts.php' ?>
</body>
</html>