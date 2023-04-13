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
    use DientuCT\Project\Order;
    $order = new Order($PDO);
    $orders = $order->viewOrders();

    $html = "<table border='1' width='100%'>"
    . "<tr>"
        . "<th>Mã đơn</th>"
        . "<th>Ngày lập đơn</th>"
        . "<th>Khách hàng</th>"
    . "</tr>";

    foreach($orders as $order) {
    $html .= "<tr>"
        . "<td>" . htmlspecialchars($order->dh_ma) . "</td>"
        . "<td>" . htmlspecialchars($order->dh_thoigiantao) . "</td>"
        . "<td>" . htmlspecialchars($order->kh_tendangnhap). "</td>"
        . "</tr>";
    }

    $html .= "</table>";
    // $mpdf = new \Mpdf\Mpdf();
    $mpdf = new \Mpdf\Mpdf();

    // $mpdf = new \mPDF('utf-8','A4','');
    //  $mpdf = new mPDF();


    // $mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/../../../assets/templates/pdfs/danhsachkhachhang.pdf']);
    $mpdf->WriteHTML('<h1 style="color: red; text-align: center;"> Danh sách đơn đặt hàng </h1>');
    $mpdf->WriteHTML($html);
    $mpdf->WriteHTML('<h3 style="text-align: center;">Hệ thống cửa hàng điện tử Cần Thơ</h3>');
    $mpdf->WriteHTML('<h2 style="text-align: center;">DientuCanTho.vn</h2>');


    $filePath = __DIR__ . '/../../../assets/templates/pdfs/orders-list.pdf';
    $mpdf->Output($filePath);
    $mpdf->Output();
    //cmd update composer json mpdf v8.1.3
    //Alternatively, you can run Composer with `--ignore-platform-req=ext-gd` to temporarily ignore these required extensions.

    //composer update --ignore-platform-req=ext-gd