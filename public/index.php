<?php
// hàm `session_id()` sẽ trả về giá trị SESSION_ID (tên file session do Web Server tự động tạo)
// - Nếu trả về Rỗng hoặc NULL => chưa có file Session tồn tại
if (session_id() === '') {
    // Yêu cầu Web Server tạo file Session để lưu trữ giá trị tương ứng với user (Web Browser đang gởi Request)
    session_start();
}
?>

<?php
    require_once '../bootstrap.php';
    use DientuCT\Project\Customer;
    $customer = new Customer($PDO);
    $customers = $customer->all();
?>

<?php

    // if (!isset($_SESSION['kh_tendangnhap_logged'])){
    //     echo '<script>location.href = "/user/auth/login.php";</script>';
    // }
    use DientuCT\Project\Product;
    $product = new Product($PDO);
    $products = $product->allProductImages();

    $mobiles = $product->allProductImageMobiles();
    $laptops = $product->allProductImageLaptops();
    $tablets = $product->allProductImageTablets();
    $accessorys = $product->allProductImageAccessorys();
    $smartwatchs = $product->allProductImageSmartwatchs();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Điện tử Cần Thơ | Mua bán điện thoại, Tablet, Laptop</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/assets/user/css/bootstrap.min.css" type="text/css" />
    <!-- Font awesome -->
    <link rel="stylesheet" href="/assets/user/css/font-awesome.min.css" type="text/css" />
    <!-- Datatables CSS -->
    <link href="/assets/user/css/datatables.min.css" rel="stylesheet"/>
    <!-- Animate CSS -->
    <link href="/assets/user/css/animate.css" rel="stylesheet"/>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/assets/user/css/base.css" type="text/css" />
    <link rel="stylesheet" href="/assets/user/css/styles.css" type="text/css" />
    <link rel="stylesheet" href="/assets/user/css/responsive.css" type="text/css" />
    
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-X5P6910731"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-X5P6910731');
    </script>

</head>
<body>
    <!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "579167705764126");
      chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v16.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>

    <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);     
    ?>

    <?php include_once __DIR__ . '../../partials/user/header.php'; ?>

    <div class="body_container">
        <main role="main " class="mb-2">
            <a href="#" >
                <img src="/assets/user/imgs/top.png" class="scroll-top" alt="">
            </a>
            <div class="col-md-12 col-sm-12 main-column">
                <div class="slide_banner ">
                    <div class="menu-site">
                        
                        <ul class="menu-product-hover menu-categories">
                            <h4 class="category__heading">
                                <i class="fa fa-list category__heading-icon" aria-hidden="true"></i>
                                Danh mục
                            </h4>
                            <li class="category-item">
                                <a href="#mobile" class="category-item__link"><i class="fa fa-mobile" aria-hidden="true"></i> Điện thoại</a>
                            </li>
                            <li class="category-item">
                                <a href="#tablet" class="category-item__link"><i class="fa fa-tablet" aria-hidden="true"></i> Máy tính bảng</a>
                            </li>
                            <li class="category-item">
                                <a href="#laptop" class="category-item__link"><i class="fa fa-laptop" aria-hidden="true"></i> Laptop</a>
                            </li>
                            <li class="category-item">
                                <a href="#accessory" class="category-item__link"><i class="fa fa-headphones" aria-hidden="true"></i> Âm thanh</a>
                            </li>
                            <li class="category-item">
                                <a href="#" class="category-item__link"><i class="fa fa-clock-o" aria-hidden="true"></i> Smartwatch</a>
                            </li>
                            <li class="category-item">
                                <a href="#accessorys" class="category-item__link"><i class="fa fa-microphone" aria-hidden="true"></i> Phụ kiện</a>
                            </li>
                            <li class="category-item">
                                <a href="#mobile" class="category-item__link"><i class="fa fa-mobile" aria-hidden="true"></i> Hàng cũ</a>
                            </li>
                            <li class="category-item">
                                <a href="#mobile" class="category-item__link"><i class="fa fa-exchange" aria-hidden="true"></i> Thu cũ</a>
                            </li>
                        </ul>
                    </div>

                    <div class="banner-site">
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#myCarousel" data-slide-to="1"></li>
                                <li data-target="#myCarousel" data-slide-to="2"></li>
                                <li data-target="#myCarousel" data-slide-to="3"></li>
                                <li data-target="#myCarousel" data-slide-to="4"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="/assets/user/imgs/banner1.jpg" class="img-fluid homepage-slider-img" />
                                    <div class="container">
                                        <div class="carousel-caption text-left">
                            
                
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="/assets/user/imgs/banner2.jpg" class="img-fluid homepage-slider-img" />
                                    <div class="container">
                                        <div class="carousel-caption">
                                         
                
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="/assets/user/imgs/banner3.jpg" class="img-fluid homepage-slider-img" />
                                    <div class="container">
                                        <div class="carousel-caption text-right">
                                            
                
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="/assets/user/imgs/banner4.jpg" class="img-fluid homepage-slider-img" />
                                    <div class="container">
                                        <div class="carousel-caption text-right">
                                          
                
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="/assets/user/imgs/banner5.jpg" class="img-fluid homepage-slider-img" />
                                    <div class="container">
                                        <div class="carousel-caption text-right">
                                           
                
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>

                    <div class="video-site">
                        <div class="video_clip">
                            <div class="item_video">
                            <a href="https://www.youtube.com/watch?v=uo7w4R7bNwc" class="video1 content_sl" rel="nofollow" target="_blank">
                                <picture>
                                    <source srcset="/assets/user/imgs/gia-iphone-12-pro.webp" type="image/webp">
                                    <source srcset="/assets/user/imgs/gia-iphone-12-pro.png">
                                    <img class="img-responsive img_cap dli" width="170" height="170" src="/assets/user/imgs/gia-iphone-12-pro-rs.png" alt="iPhone 12 Pro cũ">
                                </picture>
                                <img class="icon_play" width="50" height="50" src="/assets/user/imgs/play.svg" alt="play">
                            </a>
                            </div>
                            <div class="item_video">
                            <a href="https://www.youtube.com/watch?v=mVi0CBzYEH0&amp;t=153s" class="video1 content_sl" rel="nofollow" target="_blank">
                                <picture>
                                    <source srcset="/assets/user/imgs/612-thumbail.webp" type="image/webp">
                                    <source srcset="/assets/user/imgs/612-thumbail.jpg">
                                    <img class="img-responsive img_cap dli" width="170" height="170" src="/assets/user/imgs/612-thumbail_14pl.jpg" alt="Review iPhone 14 Plus ">
                                </picture>
                                <img class="icon_play" width="50" height="50" src="/assets/user/imgs/play.svg" alt="play">
                            </a>
                            </div>
                            <div class="item_video">
                            <a href="https://www.tiktok.com/@ndanhdev" class="video1 content_sl" rel="nofollow" target="_blank">
                                <picture>
                                    <source srcset="/assets/user/imgs/z3756934620000.webp" type="image/webp">
                                    <source srcset="/assets/user/imgs/z3756934620000.jpg">
                                    <img class="img-responsive img_cap dli" width="170" height="170" src="/assets/user/imgs/z3756934620000-rs.jpg" alt="Tiktok DientuCanTho">
                                </picture>
                                <img class="icon_play" width="50" height="50" src="/assets/user/imgs/play.svg" alt="play">
                            </a>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Product Sale -->
                <div class="box-sales">
                    <div class="title_sale">
                        <span>Săn sale giá sốc mỗi ngày</span>
                    </div>
                    <div class="box-sales-items">
                        <!-- Hiển thị sản phẩm Sale -->
                    </div>
                </div>

                <!-- Banner home -->
                <div class=" row banners-home">
                    <div class="col-sm-6">
                        <a href="" title="Galaxy A Series">
                            <img src="/assets/user/imgs/banner-home-left.webp" alt="" class="img-fluid banners-home__samsung"> 
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <a href="" title="Macbook">
                            <img src="/assets/user/imgs/banner-home-right.webp" alt="" class="img-fluid banners-home__macbook">
                        </a>
                    </div>
                </div>

                <!-- Product -->
                <!-- Điện thoại đáng mua nhất -->
                <section id="mobile" class="products_news">
                    <!-- Tab -->
                    <div id="products_menu_tabs">
                        <div class="nav-tabs">
                            <div class="item_tabs">
                                <a href="#" title="Điện thoại">
                                    <h2>
                                        <img src="/assets/user/imgs/dienthoai_icon.svg" alt="icon">
                                        <span>Điện thoại đáng mua nhất</span>
                                    </h2>
                                </a>
                            </div>
                            <div class="right_tab">
                                <div class="list_product">
                                    <div class="item_tabs">
                                        <a class="mshow" href="#">iPhone</a>
                                    </div>
                                    <div class="item_tabs">
                                        <a class="mshow" href="#">SamSung</a>
                                    </div>
                                    <div class="item_tabs">
                                        <a class="mshow" href="#">Xiaomi</a>
                                    </div>
                                    <div class="item_tabs">
                                        <a class="mshow" href="#">Redmi</a>
                                    </div>
                                    <div class="item_tabs">
                                        <a class="mshow" href="#">Poco</a>
                                    </div>
                                    <div class="item_tabs">
                                        <a class="mshow" href="#">Nokia</a>
                                    </div>

                                </div>
                                <!-- <div class="count_product"></div> -->
                            </div>

                        </div>

                    </div>
                    <!-- Product Item -->
                    <div class="products_item_list">
                        <div  class="products_item_content">
                            <div class="row row-cols-5">  <!-- 5 col 1 row -->
                                <?php foreach ($mobiles as $mobile) :  ?>
                                    <div class="col">
                                        <div class="card mb-4 shadow-sm">
                                            <!-- Header -->
                                            <div class="card-top">
                                                <div class="ribbon-wrapper">
                                                    <div class="product-item__hot">
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                        <span>HOT</span>
                                                    </div>
                                                </div>
                                                <div class="product-item__sale-off">
                                                    <span class="product-item__sale-off-percent"> -10%</span>
                                                </div>
                                                <!-- Nếu có ảnh thì hiển thị -->
                                                <?php if (!empty($mobile->hsp_tentaptin)) : ?>
                                                    <div class="container-img">
                                                        <a href="detail.php?sp_ma=<?= htmlspecialchars($mobile->sp_ma) ?>">
                                                            <img class="bd-placeholder-img card-img-top img-fluid box-effect-img" src="/assets/uploads/<?= htmlspecialchars($mobile->hsp_tentaptin) ?>" />
                                                        </a>
                                                    </div>
                                                <?php else : ?>
                                                    <div class="container-img">
                                                        <a href="detail.php?sp_ma=<?= htmlspecialchars($mobile->sp_ma) ?>">
                                                            <img class="bd-placeholder-img card-img-top img-fluid" src="/assets/shared/img/default-image.png" />
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            
                                            <!-- Body -->
                                            <div class="card-body">
                                                <a href="detail.php?sp_ma=<?= htmlspecialchars($mobile->sp_ma) ?>">
                                                    <h6><?= htmlspecialchars($mobile->sp_ten) ?></h6>
                                                </a>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="btn-group">
                                                        <a class="btn btn-sm btn-outline-secondary" href="detail.php?sp_ma=<?= htmlspecialchars($mobile->sp_ma) ?>">Xem chi tiết</a>
                                                    </div>
                                                    <small class="text-muted text-right">
                                                        <s><?= htmlspecialchars(number_format( ($mobile->sp_giacu) , 0, ".", ",")) ?></s>
                                                        <b><?= htmlspecialchars(number_format( ($mobile->sp_gia) , 0, ".", ","). ' đ') ?></b>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            

                        </div>

                    </div>

                </section>


                <!-- Laptop đáng mua nhất -->
                <section id="laptop"class="products_news">
                    <!-- Tab -->
                    <div id="products_menu_tabs">
                        <div class="nav-tabs">
                            <div class="item_tabs">
                                <a href="#" title="Điện thoại">
                                    <h2>
                                        <img src="/assets/user/imgs/laptop.svg" alt="icon">
                                        <span>Laptop đáng mua nhất</span>
                                    </h2>
                                </a>
                            </div>
                            <div class="right_tab">
                                <div class="list_product">
                                    <div class="item_tabs">
                                        <a class="mshow" href="#">Macbook</a>
                                    </div>
                                    <div class="item_tabs">
                                        <a class="mshow" href="#">LG</a>
                                    </div>
                                    <div class="item_tabs">
                                        <a class="mshow" href="#">HP</a>
                                    </div>
                                    <div class="item_tabs">
                                        <a class="mshow" href="#">Dell</a>
                                    </div>
                                    <div class="item_tabs">
                                        <a class="mshow" href="#">Toshiba</a>
                                    </div>
                                    <div class="item_tabs">
                                        <a class="mshow" href="#">Lenovo</a>
                                    </div>

                                </div>
                                <!-- <div class="count_product"></div> -->
                            </div>

                        </div>

                    </div>
                    <!-- Product Item -->
                    <div class="products_item_list">
                        <div  class="products_item_content">
                            <div class="row row-cols-5">  <!-- 5 col 1 row -->
                                <?php foreach ($laptops as $laptop) :  ?>
                                    <div class="col">
                                        <div class="card mb-4 shadow-sm">
                                            <!-- Header -->
                                            <div class="card-top">
                                                <div class="ribbon-wrapper">
                                                    <div class="product-item__hot">
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                        <span>HOT</span>
                                                    </div>
                                                </div>
                                                <div class="product-item__sale-off">
                                                    <span class="product-item__sale-off-percent"> -10%</span>
                                                </div>
                                                <!-- Nếu có ảnh thì hiển thị -->
                                                <?php if (!empty($laptop->hsp_tentaptin)) : ?>
                                                    <div class="container-img">
                                                        <a href="detail.php?sp_ma=<?= htmlspecialchars($laptop->sp_ma) ?>">
                                                            <img class="bd-placeholder-img card-img-top img-fluid box-effect-img container-img-laptop" src="/assets/uploads/<?= htmlspecialchars($laptop->hsp_tentaptin) ?>" />
                                                        </a>
                                                    </div>
                                                <?php else : ?>
                                                    <div class="container-img">
                                                        <a href="detail.php?sp_ma=<?= htmlspecialchars($laptop->sp_ma) ?>">
                                                            <img class="bd-placeholder-img card-img-top img-fluid container-img-laptop" src="/assets/shared/img/default-image.png" />
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            
                                            <!-- Body -->
                                            <div class="card-body">
                                                <a href="detail.php?sp_ma=<?= htmlspecialchars($laptop->sp_ma) ?>">
                                                    <h6><?= htmlspecialchars($laptop->sp_ten) ?></h6>
                                                </a>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="btn-group">
                                                        <a class="btn btn-sm btn-outline-secondary" href="detail.php?sp_ma=<?= htmlspecialchars($laptop->sp_ma) ?>">Xem chi tiết</a>
                                                    </div>
                                                    <small class="text-muted text-right">
                                                        <s><?= htmlspecialchars(number_format( ($laptop->sp_giacu) , 0, ".", ",")) ?></s>
                                                        <b><?= htmlspecialchars(number_format( ($laptop->sp_gia) , 0, ".", ","). ' đ') ?></b>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            

                        </div>

                    </div>

                </section>

                <!-- Máy tính bảng đáng mua nhất -->
                <section  id="tablet" class="products_news">
                    <!-- Tab -->
                    <div id="products_menu_tabs">
                        <div class="nav-tabs">
                            <div class="item_tabs">
                                <a href="#" title="Điện thoại">
                                    <h2>
                                        <img src="/assets/user/imgs/dienthoai_icon.svg" alt="icon">
                                        <span>Máy tính bảng đáng mua nhất</span>
                                    </h2>
                                </a>
                            </div>
                            <div class="right_tab">
                                <div class="list_product">
                                    <div class="item_tabs">
                                        <a class="mshow" href="#">iPad</a>
                                    </div>
                                    <div class="item_tabs">
                                        <a class="mshow" href="#">Samsung</a>
                                    </div>
                                    <div class="item_tabs">
                                        <a class="mshow" href="#">Xiaomi</a>
                                    </div>
                                    <div class="item_tabs">
                                        <a class="mshow" href="#">Huawei</a>
                                    </div>
                                    <div class="item_tabs">
                                        <a class="mshow" href="#">Oppo</a>
                                    </div>
                                    <div class="item_tabs">
                                        <a class="mshow" href="#">Nokia</a>
                                    </div>

                                </div>
                                <!-- <div class="count_product"></div> -->
                            </div>

                        </div>

                    </div>
                    <!-- Product Item -->
                    <div class="products_item_list">
                        <div class="products_item_content">
                            <div class="row row-cols-5">  <!-- 5 col 1 row -->
                                <?php foreach ($tablets as $tablet) :  ?>
                                    <div class="col">
                                        <div class="card mb-4 shadow-sm">
                                            <!-- Header -->
                                            <div class="card-top">
                                                <div class="ribbon-wrapper">
                                                    <div class="product-item__hot">
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                        <span>HOT</span>
                                                    </div>
                                                </div>
                                                <div class="product-item__sale-off">
                                                    <span class="product-item__sale-off-percent"> -10%</span>
                                                </div>
                                                <!-- Nếu có ảnh thì hiển thị -->
                                                <?php if (!empty($tablet->hsp_tentaptin)) : ?>
                                                    <div class="container-img">
                                                        <a href="detail.php?sp_ma=<?= htmlspecialchars($tablet->sp_ma) ?>">
                                                            <img class="bd-placeholder-img card-img-top img-fluid box-effect-img" src="/assets/uploads/<?= htmlspecialchars($tablet->hsp_tentaptin) ?>" />
                                                        </a>
                                                    </div>
                                                <?php else : ?>
                                                    <div class="container-img">
                                                        <a href="detail.php?sp_ma=<?= htmlspecialchars($tablet->sp_ma) ?>">
                                                            <img class="bd-placeholder-img card-img-top img-fluid" src="/assets/shared/img/default-image.png" />
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            
                                            <!-- Body -->
                                            <div class="card-body">
                                                <a href="detail.php?sp_ma=<?= htmlspecialchars($tablet->sp_ma) ?>">
                                                    <h6><?= htmlspecialchars($tablet->sp_ten) ?></h6>
                                                </a>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="btn-group">
                                                        <a class="btn btn-sm btn-outline-secondary" href="detail.php?sp_ma=<?= htmlspecialchars($tablet->sp_ma) ?>">Xem chi tiết</a>
                                                    </div>
                                                    <small class="text-muted text-right">
                                                        <s><?= htmlspecialchars(number_format( ($tablet->sp_giacu) , 0, ".", ",")) ?></s>
                                                        <b><?= htmlspecialchars(number_format( ($tablet->sp_gia) , 0, ".", ","). ' đ') ?></b>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            

                        </div>

                    </div>

                </section>

                <!-- Phụ kiện đáng mua nhất -->
                <section id="accessory" class="products_news">
                    <!-- Tab -->
                    <div id="products_menu_tabs">
                        <div class="nav-tabs">
                            <div class="item_tabs">
                                <a href="#" title="Điện thoại">
                                    <h2>
                                        <img src="/assets/user/imgs/phukien.svg" alt="icon">
                                        <span>Phụ kiện đáng mua nhất</span>
                                    </h2>
                                </a>
                            </div>
                            <div class="right_tab">
                                <div class="list_product">
                                    <div class="item_tabs">
                                        <a class="mshow" href="#">iPad</a>
                                    </div>
                                    <div class="item_tabs">
                                        <a class="mshow" href="#">Samsung</a>
                                    </div>
                                    <div class="item_tabs">
                                        <a class="mshow" href="#">Xiaomi</a>
                                    </div>
                                    <div class="item_tabs">
                                        <a class="mshow" href="#">Huawei</a>
                                    </div>
                                    <div class="item_tabs">
                                        <a class="mshow" href="#">Oppo</a>
                                    </div>
                                    <div class="item_tabs">
                                        <a class="mshow" href="#">Nokia</a>
                                    </div>

                                </div>
                                <!-- <div class="count_product"></div> -->
                            </div>

                        </div>

                    </div>
                    <!-- Product Item -->
                    <div class="products_item_list">
                        <div  class="products_item_content">
                            <div class="row row-cols-5">  <!-- 5 col 1 row -->
                                <?php foreach ($accessorys as $accessory) :  ?>
                                    <div class="col">
                                        <div class="card mb-4 shadow-sm">
                                            <!-- Header -->
                                            <div class="card-top">
                                                <div class="ribbon-wrapper">
                                                    <div class="product-item__hot">
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                        <span>HOT</span>
                                                    </div>
                                                </div>
                                                <div class="product-item__sale-off">
                                                    <span class="product-item__sale-off-percent"> -10%</span>
                                                </div>
                                                <!-- Nếu có ảnh thì hiển thị -->
                                                <?php if (!empty($accessory->hsp_tentaptin)) : ?>
                                                    <div class="container-img">
                                                        <a href="detail.php?sp_ma=<?= htmlspecialchars($accessory->sp_ma) ?>">
                                                            <img class="bd-placeholder-img card-img-top img-fluid box-effect-img" src="/assets/uploads/<?= htmlspecialchars($accessory->hsp_tentaptin) ?>" />
                                                        </a>
                                                    </div>
                                                <?php else : ?>
                                                    <div class="container-img">
                                                        <a href="detail.php?sp_ma=<?= htmlspecialchars($accessory->sp_ma) ?>">
                                                            <img class="bd-placeholder-img card-img-top img-fluid" src="/assets/shared/img/default-image.png" />
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            
                                            <!-- Body -->
                                            <div class="card-body">
                                                <a href="detail.php?sp_ma=<?= htmlspecialchars($accessory->sp_ma) ?>">
                                                    <h6><?= htmlspecialchars($accessory->sp_ten) ?></h6>
                                                </a>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="btn-group">
                                                        <a class="btn btn-sm btn-outline-secondary" href="detail.php?sp_ma=<?= htmlspecialchars($accessory->sp_ma) ?>">Xem chi tiết</a>
                                                    </div>
                                                    <small class="text-muted text-right">
                                                        <s><?= htmlspecialchars(number_format( ($accessory->sp_giacu) , 0, ".", ",")) ?></s>
                                                        <b><?= htmlspecialchars(number_format( ($accessory->sp_gia) , 0, ".", ","). ' đ') ?></b>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            

                        </div>

                    </div>

                </section>

                <!-- Đồng hồ thông minh đáng mua nhất -->
                <section id="smartwatch" class="products_news">
                    <!-- Tab -->
                    <div id="products_menu_tabs">
                        <div class="nav-tabs">
                            <div class="item_tabs">
                                <a href="#" title="Điện thoại">
                                    <h2>
                                        <img src="/assets/user/imgs/watch.svg" alt="icon">
                                        <span>Đồng hồ thông minh đáng mua nhất</span>
                                    </h2>
                                </a>
                            </div>
                            <div class="right_tab">
                                <div class="list_product">
                                    <div class="item_tabs">
                                        <a class="mshow" href="#">Apple</a>
                                    </div>
                                    <div class="item_tabs">
                                        <a class="mshow" href="#">Xiaomi</a>
                                    </div>
                                    <div class="item_tabs">
                                        <a class="mshow" href="#">Galaxy</a>
                                    </div>
                                    <div class="item_tabs">
                                        <a class="mshow" href="#">Huawei</a>
                                    </div>
                                    <div class="item_tabs">
                                        <a class="mshow" href="#">Oppo</a>
                                    </div>
                                    <div class="item_tabs">
                                        <a class="mshow" href="#">Nokia</a>
                                    </div>

                                </div>
                                <!-- <div class="count_product"></div> -->
                            </div>

                        </div>

                    </div>
                    <!-- Product Item -->
                    <div class="products_item_list">
                        <div class="products_item_content">
                            <div class="row row-cols-5">  <!-- 5 col 1 row -->
                                <?php foreach ($smartwatchs as $smartwatch) :  ?>
                                    <div class="col">
                                        <div class="card mb-4 shadow-sm">
                                            <!-- Header -->
                                            <div class="card-top">
                                                <div class="ribbon-wrapper">
                                                    <div class="product-item__hot">
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                        <span>HOT</span>
                                                    </div>
                                                </div>
                                                <div class="product-item__sale-off">
                                                    <span class="product-item__sale-off-percent"> -10%</span>
                                                </div>
                                                <!-- Nếu có ảnh thì hiển thị -->
                                                <?php if (!empty($smartwatch->hsp_tentaptin)) : ?>
                                                    <div class="container-img">
                                                        <a href="detail.php?sp_ma=<?= htmlspecialchars($smartwatch->sp_ma) ?>">
                                                            <img class="bd-placeholder-img card-img-top img-fluid box-effect-img" src="/assets/uploads/<?= htmlspecialchars($smartwatch->hsp_tentaptin) ?>" />
                                                        </a>
                                                    </div>
                                                <?php else : ?>
                                                    <div class="container-img">
                                                        <a href="detail.php?sp_ma=<?= htmlspecialchars($smartwatch->sp_ma) ?>">
                                                            <img class="bd-placeholder-img card-img-top img-fluid" src="/assets/shared/img/default-image.png" />
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            
                                            <!-- Body -->
                                            <div class="card-body">
                                                <a href="detail.php?sp_ma=<?= htmlspecialchars($smartwatch->sp_ma) ?>">
                                                    <h6><?= htmlspecialchars($smartwatch->sp_ten) ?></h6>
                                                </a>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="btn-group">
                                                        <a class="btn btn-sm btn-outline-secondary" href="detail.php?sp_ma=<?= htmlspecialchars($smartwatch->sp_ma) ?>">Xem chi tiết</a>
                                                    </div>
                                                    <small class="text-muted text-right">
                                                        <s><?= htmlspecialchars(number_format( ($smartwatch->sp_giacu) , 0, ".", ",")) ?></s>
                                                        <b><?= htmlspecialchars(number_format( ($smartwatch->sp_gia) , 0, ".", ","). ' đ') ?></b>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            

                        </div>

                    </div>

                </section>
                
            </div>

        </main>

        <!-- Footer top -->
        <div class="footer-top row">
            <div class="col-md-2">
                <h3 class="footer__heading">Chăm sóc khách hàng</h3>
                <div class="footer-list">
                    <div class="footer-item">
                        <a href="" class="footer-item__link">Trung tâm trợ giúp</a>
                    </div>
                    <div class="footer-item">
                        <a href="" class="footer-item__link">Mua hàng và thanh toán Online</a>
                    </div>
                    <div class="footer-item">
                        <a href="" class="footer-item__link">Trung tâm bảo hành chính hãng</a>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <h3 class="footer__heading">Thông tin liên hệ</h3>
                <div class="footer-list">
                    <div class="footer-item">
                        <a href="" class="footer-item__link">Giới thiệu công ty</a>
                    </div>
                    <div class="footer-item">
                        <a href="" class="footer-item__link">Hệ thống cửa hàng</a>
                    </div>
                    <div class="footer-item">
                        <a href="" class="footer-item__link">Chính sách bảo mật</a>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <h3 class="footer__heading">Gọi tư vấn & khiếu nại</h3>
                <div class="footer-list">
                    <div class="footer-item">
                        <a href="" class="footer-item__link">Gọi mua hàng: 085 5100 001 (8h00 - 22h00)</a>
                    </div>
                    <div class="footer-item">
                        <a href="" class="footer-item__link">Hỗ trợ kỹ thuật: 1800 6502 (8h00 - 21h00)</a>
                    </div>
                    <div class="footer-item">
                        <a href="" class="footer-item__link">Hợp tác kinh doanh: 1900 6122</a>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <h3 class="footer__heading">Tuyển dụng</h3>
                <div class="footer-list">
                    <div class="footer-item">
                        <a href="" class="footer-item__link">Thông tin tuyển dụng</a>
                    </div>
                    <div class="footer-item">
                        <a href="" class="footer-item__link">Vị trí ứng tuyển</a>
                    </div>
                    <div class="footer-item">
                        <a href="" class="footer-item__link">Liên hệ nộp CV</a>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <h3 class="footer__heading">Thông tin khác</h3>
                <div class="footer-list">
                    <div class="footer-item">
                        <a href="" class="footer-item__link">Chính sách đổi trả</a>
                    </div>
                    <div class="footer-item">
                        <a href="" class="footer-item__link">Quy chế hoạt động</a>
                    </div>
                    <div class="footer-item">
                        <a href="" class="footer-item__link">Chính sách Bảo hành</a>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <h3 class="footer__heading">Điện tử Cần Thơ trên ứng dụng</h3>
                <div class="footer__download">
                    <img src="/assets/user/imgs/qr_code_app.png" alt="Download QR" class="footer__download-qr">
                    <div class="footer__download-apps">
                        <a href="" class="footer__download-apps-link">
                            <img src="/assets/user/imgs/google_play.png" alt="Google Play" class="footer__download-app-img">
                        </a>
                        <a href="" class="footer__download-apps-link">
                            <img src="/assets/user/imgs/app_store.png" alt="App Store" class="footer__download-app-img">
                        </a>

                    </div>
                </div>
            </div>
        </div>
            
        
    </div>

    <?php include_once __DIR__ . '../../partials/user/footer.php'; ?>
    <!-- jQuery JS -->
    <script src="/assets/user/js/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="/assets/user/js/bootstrap.min.js"></script>
    <!-- Wow js -->
    <script src="/assets/user/js/wow.min.js"></script>
    <!-- SweetAlert JS-->
    <script src="/assets/user/js/sweetalert.js"></script>
    <script src="/assets/user/js/sweetalert.min.js"></script>
    <!-- DataTable JS -->
    <script src="/assets/user/js/datatables.min.js"></script>
    <script src="/assets/user/js/buttons.bootstrap4.min.js"></script>
    <script src="/assets/user/js/pdfmake.min.js"></script>
    <script src="/assets/user/js/vfs_fonts.js"></script>
    <!-- Custom JS -->
    <script src="/assets/user/js/app.js"></script>


</body>
</html>