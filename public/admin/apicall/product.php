<?php
    if (session_id() === '') {
        session_start();
    }

    if (!isset($_SESSION['kh_tendangnhap_logged'])){
        echo '<script>location.href = "/admin/auth/login.php";</script>';
    }
    require_once '../../../bootstrap.php';

    $kh_tendangnhap_logged=htmlspecialchars($_SESSION['kh_tendangnhap_logged']);
    
    // Giải thuật ngăn chặn người dùng truy cập vào trang call api
    if ($kh_tendangnhap_logged !='admin') {
        $message = "Bạn không được phép truy cập vào trang này!";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo '<script>location.href = "/index.php";</script>';
    }

    use DientuCT\Project\ProductTotal;
    $producttotal = new ProductTotal($PDO);
    $productstotal = $producttotal->productTotal();
    echo $productstotal;
