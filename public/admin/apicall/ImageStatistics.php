<?php
    if (session_id() === '') {
        session_start();
    }

    if (!isset($_SESSION['kh_tendangnhap_logged'])){
        echo '<script>location.href = "/admin/auth/login.php";</script>';
    }

    require_once '../../../bootstrap.php';
    use DientuCT\Project\ImageStatistics;
    $imagestatistics = new ImageStatistics($PDO);
    $imagesstatistics = $imagestatistics->imageStatistics();
    // var_dump($imagesstatistics); die;
    echo $imagesstatistics;