<?php
    if (session_id() === '') {
        session_start();
    }

    if (!isset($_SESSION['kh_tendangnhap_logged'])){
        echo '<script>location.href = "/admin/auth/login.php";</script>';
    }
    
    require_once '../../../bootstrap.php';
    use DientuCT\Project\CustomerTotal;
    $customertotal = new CustomerTotal($PDO);
    $customerstotal = $customertotal->customerTotal();
    echo $customerstotal;