<?php
    if (session_id() === '') {
        session_start();
    }

    if (!isset($_SESSION['kh_tendangnhap_logged'])){
        echo '<script>location.href = "/admin/auth/login.php";</script>';
    }
    require_once '../../../bootstrap.php';
    use DientuCT\Project\OrderTotal;
    $ordertotal = new OrderTotal($PDO);
    $orderstotal = $ordertotal->orderTotal();
    // var_dump($orderstotal); die;
    echo $orderstotal;