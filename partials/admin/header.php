<?php
    if (session_id() === '') {
        session_start();
    }
?>
<div id="header" class="header-shadow fixed-header theme-white">
    <div class="header__logo">
        <a href="/admin/pages/dashboard.php" class="logo-src"></a>
        <a href="/admin/pages/dashboard.php" class="brand">
            <!-- <h2>
                Điện tử Cần Thơ
            </h2> -->
        </a>
    </div>
    <div class="header__toggle-sidebar" onclick="toggleMenuSidebar()">
        <!-- <i class="fa fa-bars" aria-hidden="true"></i> -->
    </div>
    <nav class="header__content">
        <div class="header__content-left">
            <ul id="header__content-menu">
                <li>
                    <a href="#" class="header__content-menu--mega"><i class="fa fa-gift" aria-hidden="true"></i> Mega Menu <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                </li>
                <li>
                    <a href="#" class="header__content-menu--setting"><i class="fa fa-cog" aria-hidden="true"></i> Setting <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                </li>
                <li>
                    <a href="#" class="header__content-menu--message"><i class="fa fa-comments" aria-hidden="true"></i> Message <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                </li>
            </ul>
            <form class="form-inline header__form" action="/action_page.php">
                <input class="form-control mr-sm-2" type="text" placeholder="Search">
                <button class="btn btn-success header__form-search" type="submit">Search</button>
            </form>
        </div>
        <div class="header__content-right">
            <!-- <a href="">Đăng nhập/Đăng ký</a> -->
            <?php
            // Đã đăng nhập rồi -> hiển thị tên Người dùng và menu Đăng xuất
            if (isset($_SESSION['kh_tendangnhap_logged']) && !empty($_SESSION['kh_tendangnhap_logged'])) :
            ?>
                <a class="">Chào <?=$_SESSION['kh_tendangnhap_logged']; ?></a>
                <a class="" href="/admin/auth/logout.php">Đăng xuất</a>
            <?php else : ?>
                <a class="" href="/admin/auth/login.php">Đăng nhập/Đăng ký</a>
              
            <?php endif; ?>
        </div>
    </nav>

    <div id="header__toggle-mobile">
        <i class="fa fa-bars" aria-hidden="true"></i>
    </div>
</div>