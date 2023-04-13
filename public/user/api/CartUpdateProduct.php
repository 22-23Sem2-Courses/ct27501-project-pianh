<?php
// hàm `session_id()` sẽ trả về giá trị SESSION_ID (tên file session do Web Server tự động tạo)
// - Nếu trả về Rỗng hoặc NULL => chưa có file Session tồn tại
if (session_id() === '') {
    // Yêu cầu Web Server tạo file Session để lưu trữ giá trị tương ứng với CLIENT (Web Browser đang gởi Request)
    session_start();
}

// Truy vấn database để lấy danh sách
// 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
require_once '../../../bootstrap.php';

$kh_tendangnhap_logged=htmlspecialchars($_SESSION['kh_tendangnhap_logged']);
// Giải thuật ngăn chặn người dùng truy cập vào trang api CartUpdateProduct
if ($kh_tendangnhap_logged !='admin') {
    $message = "Bạn không được phép truy cập vào trang này!";
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo '<script>location.href = "/index.php";</script>';
}

// 2. Lấy thông tin người dùng gởi đến
$sp_ma = $_POST['sp_ma'];
$soluong = $_POST['soluong'];

// 3. Lưu trữ giỏ hàng trong session
// Nếu khách hàng đặt hàng cùng sản phẩm đã có trong giỏ hàng => cập nhật lại Số lượng, Thành tiền
if (isset($_SESSION['giohangdata'])) {
    $data = $_SESSION['giohangdata'];
    $sanphamcu = $data[$sp_ma];
    
    $data[$sp_ma] = array(
        'sp_ma' => $sanphamcu['sp_ma'],
        'sp_ten' => $sanphamcu['sp_ten'],
        'soluong' => $soluong,
        'gia' => $sanphamcu['gia'],
        'thanhtien' => ($soluong * $sanphamcu['gia']),
        'hinhdaidien' => $sanphamcu['hinhdaidien']
    );

    // lưu dữ liệu giỏ hàng vào session
    $_SESSION['giohangdata'] = $data;
}

// 4. Chuyển đổi dữ liệu về định dạng JSON
// Dữ liệu JSON, từ array PHP -> JSON 
echo json_encode($_SESSION['giohangdata']);