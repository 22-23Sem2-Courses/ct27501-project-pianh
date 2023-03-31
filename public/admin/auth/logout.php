<?php

    if (session_id() === '') {
        session_start();
    }


    if(isset($_SESSION['kh_tendangnhap_logged'])) {
        unset($_SESSION['kh_tendangnhap_logged']);
        header('location:login.php');
    }
    else {
        echo 'Người dùng chưa đăng nhập. Không thể đăng xuất được!'; die;
    }