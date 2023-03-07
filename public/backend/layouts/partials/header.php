<nav class="navbar navbar-expand-md navbar-dark background-primary">
  <!-- Brand -->
  <a href="/dienmay.vn/backend/pages/dashboard.php" class="">
    <img src="/dienmay.vn/assets/backend/imgs/lg-main.jpg" class="logo-header" alt="logo">
  </a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item active titlehomepage-header">
        <a class="nav-link" href="/dienmay.vn/backend/pages/dashboard.php">Trang chủ BE</a>
      </li>
    </ul>

    <ul class="navbar-nav px-3 ml-auto">
      <?php
      // Đã đăng nhập rồi -> hiển thị tên Người dùng và menu Đăng xuất
        if (isset($_SESSION['kh_tendangnhap_logged']) && !empty($_SESSION['kh_tendangnhap_logged'])) :
      ?>
        <li class="nav-item text-nowrap text-hover">
          <a class="nav-link text-white text-capitalize username-login ">
            <i class="fa-regular fa-user"></i>
            <?= $_SESSION['kh_tendangnhap_logged']; ?>
          </a>
        </li>
        <li class="nav-item text-nowrap ">
          <a class="nav-link text-white" href="/dienmay.vn/backend/auth/logout.php">Đăng xuất</a>
        </li>

        <?php else : ?>
        <li class="nav-item text-nowrap text-hover">
        
          <a class="nav-link text-white" href="/dienmay.vn/login.php">Đăng nhập / Đăng ký</a>
          
        </li>


      <?php endif; ?>
    </ul>
  </div>
</nav>