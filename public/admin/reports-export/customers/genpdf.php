<?php
    if (session_id() === '') {
        session_start();
    }

    if (!isset($_SESSION['kh_tendangnhap_logged'])){
        echo '<script>location.href = "/admin/auth/login.php";</script>';
    }

    include_once __DIR__ . '../../../../../vendor/autoload.php';
    require_once '../../../../bootstrap.php';


    /* Note: any element you append to a document must reside inside of a Section. */

    //Lấy dữ liệu
    use DientuCT\Project\Customer;
    $customer = new Customer($PDO);
    $customers = $customer->viewCustomers(); 

    $html = "<table border='1' width='100%'>"
    . "<tr>"
        . "<th>Họ tên</th>"
        . "<th>Điện thoại</th>"
        . "<th>Địa chỉ</th>"
        . "<th>Email</th>"
        . "<th>Năm sinh</th>"
        . "<th>CMND</th>"
    . "</tr>";

    foreach($customers as $customer) {
    $html .= "<tr>"
        . "<td>" . htmlspecialchars($customer->kh_ten) . "</td>"
        . "<td>" . htmlspecialchars($customer->kh_dienthoai) . "</td>"
        . "<td>" . htmlspecialchars($customer->kh_diachi). "</td>"
        . "<td>" . htmlspecialchars($customer->kh_email). "</td>"
        . "<td>" . htmlspecialchars($customer->kh_namsinh). "</td>"
        . "<td>" . htmlspecialchars($customer->kh_cmnd). "</td>"
        . "</tr>";
    }

    $html .= "</table>";
    // $mpdf = new \Mpdf\Mpdf();
    $mpdf = new \Mpdf\Mpdf();

    // $mpdf = new \mPDF('utf-8','A4','');
    //  $mpdf = new mPDF();


    // $mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/../../../assets/templates/pdfs/danhsachkhachhang.pdf']);
    $mpdf->WriteHTML('<h1 style="color: red; text-align: center;"> Danh sách khách hàng </h1>');
    $mpdf->WriteHTML($html);
    $mpdf->WriteHTML('<h3 style="text-align: center;">Hệ thống cửa hàng điện tử Cần Thơ</h3>');
    $mpdf->WriteHTML('<h2 style="text-align: center;">DientuCanTho.vn</h2>');


    $filePath = __DIR__ . '/../../../assets/templates/pdfs/customers-list.pdf';
    $mpdf->Output($filePath);
    $mpdf->Output();
    //cmd update composer json mpdf v8.1.3
    //Alternatively, you can run Composer with `--ignore-platform-req=ext-gd` to temporarily ignore these required extensions.

    //composer update --ignore-platform-req=ext-gd