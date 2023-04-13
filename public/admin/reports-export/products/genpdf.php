<?php
    if (session_id() === '') {
        session_start();
    }

    if (!isset($_SESSION['kh_tendangnhap_logged'])){
        echo '<script>location.href = "/admin/auth/login.php";</script>';
    }
    include_once __DIR__ . '../../../../../vendor/autoload.php';
    require_once '../../../../bootstrap.php';
    
    $kh_tendangnhap_logged=htmlspecialchars($_SESSION['kh_tendangnhap_logged']);

    if ($kh_tendangnhap_logged !='admin' ) {
        $message = "Bạn không phải là thành viên quản trị website! Bạn không được phép truy cập vào trang này!!!!";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo '<script>location.href = "/index.php";</script>';
    }

    /* Note: any element you append to a document must reside inside of a Section. */

    //Lấy dữ liệu
    use DientuCT\Project\Product;
    $product = new Product($PDO);
    $products = $product->viewProducts(); 

    $html = "<table border='1' width='100%'>"
    . "<tr>"
        . "<th>Mã SP</th>"
        . "<th>Tên sản phẩm</th>"
        . "<th>Giá</th>"
        . "<th>Số lượng</th>"
        . "<th>Loại sản phẩm</th>"
        . "<th>Nhà sản xuất</th>"
    . "</tr>";

    foreach($products as $product) {
    $html .= "<tr>"
        . "<td>" . htmlspecialchars($product->sp_ma) . "</td>"
        . "<td>" . htmlspecialchars($product->sp_ten) . "</td>"
        . "<td>" . htmlspecialchars($product->sp_gia). "</td>"
        . "<td>" . htmlspecialchars($product->sp_soluong). "</td>"
        . "<td>" . htmlspecialchars($product->sp_lsp). "</td>"
        . "<td>" . htmlspecialchars($product->sp_nsx). "</td>"
        . "</tr>";
    }

    $html .= "</table>";
    // $mpdf = new \Mpdf\Mpdf();
    $mpdf = new \Mpdf\Mpdf();

    // $mpdf = new \mPDF('utf-8','A4','');
    //  $mpdf = new mPDF();


    // $mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/../../../assets/templates/pdfs/danhsachkhachhang.pdf']);
    $mpdf->WriteHTML('<h1 style="color: red; text-align: center;"> Danh sách sản phẩm </h1>');
    $mpdf->WriteHTML($html);
    $mpdf->WriteHTML('<h3 style="text-align: center;">Hệ thống cửa hàng điện tử Cần Thơ</h3>');
    $mpdf->WriteHTML('<h2 style="text-align: center;">DientuCanTho.vn</h2>');


    $filePath = __DIR__ . '/../../../assets/templates/pdfs/products-list.pdf';
    $mpdf->Output($filePath);
    $mpdf->Output();
    //cmd update composer json mpdf v8.1.3
    //Alternatively, you can run Composer with `--ignore-platform-req=ext-gd` to temporarily ignore these required extensions.

    //composer update --ignore-platform-req=ext-gd