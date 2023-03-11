<?php
    require_once '../../../bootstrap.php';
    include "../../../src/Sanpham.php";
    
    use DientuCT\Project\Sanpham;
    $sanpham = new Sanpham($PDO);

    $sp_ma = isset($_REQUEST['sp_ma']) ?
        filter_var($_REQUEST['sp_ma'], FILTER_SANITIZE_NUMBER_INT) : -1;

        if ($sp_ma < 0 || !($sanpham->find($sp_ma))) {
            redirect(BASE_URL_PATH .'backend/sanpham/');
        }

    $errors = [];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($sanpham->update($_POST)) {
            // Cập nhật dữ liệu thành công
            redirect(BASE_URL_PATH .'backend/sanpham/');
        } 
        // Cập nhật dữ liệu không thành công
        $errors = $sanpham->getValidationErrors();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once __DIR__ . '/../layouts/meta.php'; ?>

    <title>Cập nhật sản phẩm</title>


    <?php include_once __DIR__ . '/../layouts/styles.php'?>

</head>
<body>
    <?php include_once __DIR__ . '/../layouts/partials/header.php' ?>
    
    <div class="container-fluid pb-450">
        <div class="row">
            <?php include_once __DIR__ . '/../layouts/partials/sidebar.php' ?>

           
            <form name="frmCreate" id="frmCreate" action=""  method="post" class="col-md-10 justify-content-center">
                <h2 class="text-center">Cập nhật sản phẩm</h2>

                <input type="hidden" name="sp_ma" value="<?= htmlspecialchars($sanpham->getSp_ma()) ?>">
                    <!-- Tên sản phẩm -->
                    <div class="form-group<?= isset($errors['sp_ten']) ? ' has-error' : '' ?>">
                        <label for="sp_ten">Tên sản phẩm</label>
                        <input type="text" name="name" class="form-control" maxlen="100" id="sp_ten" placeholder="Tên sản phẩm" value="<?= htmlspecialchars($sanpham->sp_ten) ?>" />

                        <?php if (isset($errors['sp_ten'])) : ?>
                            <span class="help-block">
                                <strong><?= htmlspecialchars($errors['sp_ten']) ?></strong>
                            </span>
                        <?php endif ?>
					</div>
                    
                    <!-- Số lượng, độ phân giải, màn hình -->
                    <div class="form-row">
                        <div class="col-sm-4 form-group<?= isset($errors['sp_soluong']) ? ' has-error' : '' ?>">
                            <label for="sp_soluong">Số lượng</label>
                            <input type="number" name="sp_soluong" class="form-control" id="sp_soluong" placeholder="Số lượng" value="<?= htmlspecialchars($sanpham->sp_soluong) ?>" />

                            <?php if (isset($errors['sp_soluong'])) : ?>
                                <span class="help-block">
                                    <strong><?= htmlspecialchars($errors['sp_soluong']) ?></strong>
                                </span>
                            <?php endif ?>
                        </div>

                        <div class="col-sm-4 form-group<?= isset($errors['sp_dophangiai']) ? ' has-error' : '' ?>">
                            <label for="sp_dophangiai">Độ phân giải</label>
                            <input type="text" name="sp_dophangiai" class="form-control" id="sp_dophangiai" placeholder="Độ phân giải" value="<?= htmlspecialchars($sanpham->sp_dophangiai) ?>" />

                            <?php if (isset($errors['sp_dophangiai'])) : ?>
                                <span class="help-block">
                                    <strong><?= htmlspecialchars($errors['sp_dophangiai']) ?></strong>
                                </span>
                            <?php endif ?>
                        </div>

                        <div class="col-sm-4 form-group<?= isset($errors['sp_manhinh']) ? ' has-error' : '' ?>">
                            <label for="sp_manhinh">Màn hình</label>
                            <input type="text" name="sp_manhinh" class="form-control" id="sp_manhinh" placeholder="Màn hình" value="<?= htmlspecialchars($sanpham->sp_manhinh) ?>" />

                            <?php if (isset($errors['sp_manhinh'])) : ?>
                                <span class="help-block">
                                    <strong><?= htmlspecialchars($errors['sp_manhinh']) ?></strong>
                                </span>
                            <?php endif ?>
                        </div>

                    </div>

                    <!-- Camera trước, camera sau, hệ điều hành -->
                    <div class="form-row">
                        <div class="col-sm-4 form-group<?= isset($errors['sp_camera_truoc']) ? ' has-error' : '' ?>">
                            <label for="sp_camera_truoc">Camera trước</label>
                            <input type="text" name="sp_camera_truoc" class="form-control" id="sp_camera_truoc" placeholder="Camera trước" value="<?= htmlspecialchars($sanpham->sp_camera_truoc) ?>" />

                            <?php if (isset($errors['sp_camera_truoc'])) : ?>
                                <span class="help-block">
                                    <strong><?= htmlspecialchars($errors['sp_camera_truoc']) ?></strong>
                                </span>
                            <?php endif ?>
                        </div>

                        <div class="col-sm-4 form-group<?= isset($errors['sp_camera_sau']) ? ' has-error' : '' ?>">
                            <label for="sp_camera_sau">Camera sau</label>
                            <input type="text" name="sp_camera_sau" class="form-control" id="sp_camera_sau" placeholder="Camera sau" value="<?= htmlspecialchars($sanpham->sp_camera_sau) ?>" />

                            <?php if (isset($errors['sp_camera_sau'])) : ?>
                                <span class="help-block">
                                    <strong><?= htmlspecialchars($errors['sp_camera_sau']) ?></strong>
                                </span>
                            <?php endif ?>
                        </div>

                        <div class="col-sm-4 form-group<?= isset($errors['sp_hedieuhanh']) ? ' has-error' : '' ?>">
                            <label for="sp_hedieuhanh">Hệ điều hành</label>
                            <input type="text" name="sp_hedieuhanh" class="form-control" id="sp_hedieuhanh" placeholder="Hệ điều hành" value="<?= htmlspecialchars($sanpham->sp_hedieuhanh) ?>" />

                            <?php if (isset($errors['sp_hedieuhanh'])) : ?>
                                <span class="help-block">
                                    <strong><?= htmlspecialchars($errors['sp_hedieuhanh']) ?></strong>
                                </span>
                            <?php endif ?>
                        </div>

                    </div>

                    <!-- Chip, ram, rom  -->
                    <div class="form-row">
                        <div class="col-sm-4 form-group<?= isset($errors['sp_chip']) ? ' has-error' : '' ?>">
                            <label for="sp_chip">Chip sản phẩm</label>
                            <input type="text" name="sp_chip" class="form-control" id="sp_chip" placeholder="Chip sản phẩm" value="<?= htmlspecialchars($sanpham->sp_chip) ?>" />

                            <?php if (isset($errors['sp_chip'])) : ?>
                                <span class="help-block">
                                    <strong><?= htmlspecialchars($errors['sp_chip']) ?></strong>
                                </span>
                            <?php endif ?>
                        </div>

                        <div class="col-sm-4 form-group<?= isset($errors['sp_ram']) ? ' has-error' : '' ?>">
                            <label for="sp_ram">Ram sản phẩm</label>
                            <input type="text" name="sp_ram" class="form-control" id="sp_ram" placeholder="Ram sản phẩm" value="<?= htmlspecialchars($sanpham->sp_ram) ?>" />

                            <?php if (isset($errors['sp_ram'])) : ?>
                                <span class="help-block">
                                    <strong><?= htmlspecialchars($errors['sp_ram']) ?></strong>
                                </span>
                            <?php endif ?>
                        </div>

                        <div class="col-sm-4 form-group<?= isset($errors['sp_rom']) ? ' has-error' : '' ?>">
                            <label for="sp_rom">Rom sản phẩm</label>
                            <input type="text" name="sp_rom" class="form-control" id="sp_rom" placeholder="Rom sản phẩm" value="<?= htmlspecialchars($sanpham->sp_rom) ?>" />

                            <?php if (isset($errors['sp_rom'])) : ?>
                                <span class="help-block">
                                    <strong><?= htmlspecialchars($errors['sp_rom']) ?></strong>
                                </span>
                            <?php endif ?>
                        </div>

                    </div>

                    <!-- Pin, nhà sản xuất, loại sản phẩm -->
                    <div class="form-row">
                        <div class="col-sm-4 form-group<?= isset($errors['sp_pin']) ? ' has-error' : '' ?>">
                            <label for="sp_pin">Pin sản phẩm</label>
                            <input type="text" name="sp_pin" class="form-control" id="sp_pin" placeholder="Pin sản phẩm" value="<?= htmlspecialchars($sanpham->sp_pin) ?>" />

                            <?php if (isset($errors['sp_pin'])) : ?>
                                <span class="help-block">
                                    <strong><?= htmlspecialchars($errors['sp_pin']) ?></strong>
                                </span>
                            <?php endif ?>
                        </div>

                        <div class="col-sm-4 form-group<?= isset($errors['sp_nsx']) ? ' has-error' : '' ?>">
                            <label for="sp_nsx">Nhà sản xuất</label>
                            <input type="text" name="sp_nsx" class="form-control" id="sp_nsx" placeholder="Nhà sản xuất" value="<?= htmlspecialchars($sanpham->sp_nsx) ?>" />

                            <?php if (isset($errors['sp_nsx'])) : ?>
                                <span class="help-block">
                                    <strong><?= htmlspecialchars($errors['sp_nsx']) ?></strong>
                                </span>
                            <?php endif ?>
                        </div>

                        <div class="col-sm-4 form-group<?= isset($errors['sp_lsp']) ? ' has-error' : '' ?>">
                            <label for="sp_lsp">Loại sản phẩm</label>
                            <input type="text" name="sp_lsp" class="form-control" id="sp_lsp" placeholder="Loại sản phẩm" value="<?= htmlspecialchars($sanpham->sp_lsp) ?>" />

                            <?php if (isset($errors['sp_lsp'])) : ?>
                                <span class="help-block">
                                    <strong><?= htmlspecialchars($errors['sp_lsp']) ?></strong>
                                </span>
                            <?php endif ?>
                        </div>

                    </div>

                    <!-- Giá, Giá cũ, Khuyến mãi -->
                    <div class="form-row">
                        <div class="col-sm-4 form-group<?= isset($errors['sp_gia']) ? ' has-error' : '' ?>">
                            <label for="sp_gia">Giá sản phẩm</label>
                            <input type="text" name="sp_gia" class="form-control" id="sp_gia" placeholder="Giá sản phẩm" value="<?= htmlspecialchars($sanpham->sp_gia) ?>" />

                            <?php if (isset($errors['sp_gia'])) : ?>
                                <span class="help-block">
                                    <strong><?= htmlspecialchars($errors['sp_gia']) ?></strong>
                                </span>
                            <?php endif ?>
                        </div>

                        <div class="col-sm-4 form-group<?= isset($errors['sp_giacu']) ? ' has-error' : '' ?>">
                            <label for="sp_giacu">Giá cũ (Giá chưa giảm)</label>
                            <input type="text" name="sp_giacu" class="form-control" id="sp_giacu" placeholder="Giá cũ (Giá chưa giảm)" value="<?= htmlspecialchars($sanpham->sp_giacu) ?>" />

                            <?php if (isset($errors['sp_giacu'])) : ?>
                                <span class="help-block">
                                    <strong><?= htmlspecialchars($errors['sp_giacu']) ?></strong>
                                </span>
                            <?php endif ?>
                        </div>

                        <div class="col-sm-4 form-group<?= isset($errors['sp_km']) ? ' has-error' : '' ?>">
                            <label for="sp_km">Khuyến mãi</label>
                            <input type="text" name="sp_km" class="form-control" id="sp_km" placeholder="Khuyến mãi" value="<?= htmlspecialchars($sanpham->sp_km) ?>" />

                            <?php if (isset($errors['sp_km'])) : ?>
                                <span class="help-block">
                                    <strong><?= htmlspecialchars($errors['sp_km']) ?></strong>
                                </span>
                            <?php endif ?>
                        </div>

                    </div>

                    

                    <!-- Submit -->
                    <button type="submit" name="submit" id="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
                </form>

        
        </div>
    </div>

    

    <?php include_once __DIR__ . '/../layouts/partials/footer.php' ?>
    <?php include_once __DIR__ . '/../layouts/scripts.php' ?>
       <!-- SweetAlert -->
    <script>
   $(document).ready(function() {
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