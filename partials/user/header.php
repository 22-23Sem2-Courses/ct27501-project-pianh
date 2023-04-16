<?php
    if (session_id() === '') {
        session_start();
    }
?>
<div id="header">
  <nav class="navbar navbar-expand-lg navbar-dark background-primary">
    <!-- Khu vực menu Header -->
    <div class="menu-store">
      <div class="logo_site">
        <a href="/index.php" >
            <img src="/assets/user/imgs/logo.png" class="logo" alt="logo" >
        </a>
      </div>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <!-- Start Menu Center -->
      <div class="collapse navbar-collapse menu_center" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            
          <li class="nav-item active cate-btn">
            <button class="cate-btn">
              <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16.6666 0.833332H3.33325C1.95254 0.833332 0.833252 1.95262 0.833252 3.33333V16.6667C0.833252 18.0474 1.95254 19.1667 3.33325 19.1667H16.6666C18.0473 19.1667 19.1666 18.0474 19.1666 16.6667V3.33333C19.1666 1.95262 18.0473 0.833332 16.6666 0.833332Z" stroke="white" stroke-linecap="round" stroke-linejoin="round"></path><path d="M5 5.83333H5.83333" stroke="white" stroke-linecap="round" stroke-linejoin="round"></path><path d="M9.1665 5.83333H14.9998" stroke="white" stroke-linecap="round" stroke-linejoin="round"></path><path d="M5 10H5.83333" stroke="white" stroke-linecap="round" stroke-linejoin="round"></path><path d="M9.1665 10H14.9998" stroke="white" stroke-linecap="round" stroke-linejoin="round"></path><path d="M5 14.1667H5.83333" stroke="white" stroke-linecap="round" stroke-linejoin="round"></path><path d="M9.1665 14.1667H14.9998" stroke="white" stroke-linecap="round" stroke-linejoin="round"></path></svg>
              Danh mục
            </button>
          </li>
  
          <!-- <li class="nav-item address text-center">
            <p>Xem giá tồn kho tại</p>
            <p>Cần Thơ</p>
          </li> -->
          
          <form class="form-inline my-2 my-lg-0" method="get" action="search.php">
            <input class="form-control mr-sm-2 search_form" name="noidungtimkiem" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0 search-btn" type="submit">Search</button>
          </form>

        </ul>
      </div>
      <!-- End Menu Center -->

      <!-- Start Menu Right -->
      <div class="right_menu">
        <a href="tel:085 5100 001" class="hotline_menu">
          <span>Gọi mua hàng</span>
          <span>085 5100 001</span>
        </a>

        <a href="/about.php" class="address">
          Tìm kiếm
          <br>
          Cửa hàng
        </a>

        <a href="/cart.php" class="cart_dd">
          <!-- <span class="nbc">0</span> -->
        </a>



        <ul class="navbar-nav">
          <?php
          // Đã đăng nhập rồi -> hiển thị tên Người dùng và menu Đăng xuất
            if (isset($_SESSION['kh_tendangnhap_logged']) && !empty($_SESSION['kh_tendangnhap_logged'])) :?>
            <li class="nav-item text-nowrap ">
              <a href="/user/info/personal.php" class="member-btn">
                <i class="fa fa-user-o user-login" aria-hidden="true"></i>
              </a>
            </li>
            <li class="nav-item text-nowrap text-hover">
              <a class="nav-link text-white text-capitalize username-logged ">
                <?= $_SESSION['kh_tendangnhap_logged']; ?>
              </a>
            </li>


            <?php else : ?>
            <li class="nav-item text-nowrap text-hover">
              <a href="/user/auth/login.php" class="member-btn">
                <i class="fa fa-user-o user-login" aria-hidden="true"></i>
              </a>
            </li>


          <?php endif; ?>
        </ul>
      </div>
  
      <!-- End Menu Right -->

    </div>
    <!-- End Khu vực menu Header -->

  </nav>

</div>

