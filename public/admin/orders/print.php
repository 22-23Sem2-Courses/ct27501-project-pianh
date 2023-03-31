<?php
    if (session_id() === '') {
        session_start();
    }

    if (!isset($_SESSION['kh_tendangnhap_logged'])){
        echo '<script>location.href = "/admin/auth/login.php";</script>';
    }
    require_once '../../../bootstrap.php';

    
    use DientuCT\Project\Customer;
    $customer = new Customer($PDO);
    $customers = $customer->all();

    $dh_ma = isset($_REQUEST['dh_ma']) ?
        filter_var($_REQUEST['dh_ma'], FILTER_SANITIZE_NUMBER_INT) : -1;
    
    use DientuCT\Project\Order;
    $order = new Order($PDO);
    $customerOrder = $order->find($dh_ma);
    $orderDetails = $order->orderDetail($dh_ma);

    $productOrderDetails = $order->productOrderDetail($dh_ma);


    $errors = [];

?>






<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>In đơn đặt hàng</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../assets/admin/css/bootstrap.min.css" type="text/css" />
    <!-- Papper CSS -->
    <link href="../../assets/admin/css/paper.css" rel="stylesheet"/>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../../assets/admin/css/base.css" type="text/css" />
    <link rel="stylesheet" href="../../assets/admin/css/styles.css" type="text/css" />
    <link rel="stylesheet" href="../../assets/admin/css/responsive.css" type="text/css" />
    
    <!-- Định khổ giấy: A5, A4 or A3 -->
    <style>
        @page {
            size: A4 
        }
    </style>
</head>

<body class="A4 landscape">


    <section class="sheet padding-10mm " >
        <!-- Thông tin Cửa hàng -->
        <table border="0" width="100%" cellspacing="0">
            <tbody>
                <tr>
                    <td align="center"><img src="../../assets/admin/imgs/lg-main.jpg" height="70px" /></td>
                    <td align="center">
                        <b style="font-size: 1.5rem;">DientuCanTho.vn - Khởi dậy đam mê, kết nối mọi người</b><br />
                        <small>Cung cấp các sản phẩm về điện thoại và điện máy</small><br />
                        <small>Giúp khách hàng chọn được các sản phẩm ưng ý với giá tốt nhất</small>
                    </td>
                </tr>
            </tbody>
        </table>




        <!-- Thông tin đơn hàng -->
        <p><i><u>Thông tin Đơn hàng</u></i></p>
        <table border="0" width="100%" cellspacing="10">
            <tbody>
                <tr>
                    <td width="20%" >Khách hàng:</td>
                    <td><b>
                        <?php foreach($customers as $customer): ?>
                            <?php if( ($customerOrder->kh_tendangnhap)  == ($customer->kh_tendangnhap) ): ?>
                                <?= ($customer->kh_ten) ?>
                                (<?= ($customer->kh_dienthoai) ?>)
                                <?php endif; ?>
                        <?php endforeach; ?>
                    </b></td>

                </tr>
                <tr >
                    <td>Ngày lập:</td>
                    <td><b><?=htmlspecialchars($customerOrder->dh_thoigiantao)?></b></td>
                </tr>
                <tr>
                    <td>Ngày giao:</td>
                    <td><b><?=htmlspecialchars($customerOrder->dh_ngaygiao)?></b></td>
                </tr>
                
                <tr>
                    <td>Nơi giao:</td>
                    <td><b><?=htmlspecialchars($customerOrder->dh_noigiao)?> </b></td>
                </tr>

                <tr>
                    <td>Tổng thành tiền:</td>
                    <td><b><?=htmlspecialchars(number_format( ($orderDetails->tongthanhtien) , 0, ".", ","). ' vnđ')?></b></td>  
                </tr>
            </tbody>
        </table>

        <!-- Thông tin sản phẩm -->
        <p class="mt-4"><i><u>Chi tiết đơn hàng</u></i></p>
        <table border="1" width="100%" cellspacing="0" cellpadding="5">
            <thead>
                <tr class="text-center">
                    <th>STT</th>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php $stt = 1; ?>
                <?php foreach($productOrderDetails as $productOrderDetail): ?>
                <tr>
                    <td align="center"><?= $stt; ?></td>
                    <td style="padding-left: 5px;">
                        <b><?= htmlspecialchars( $productOrderDetail->sp_ten) ?></b><br />
                        <small><i><?= htmlspecialchars($productOrderDetail->sp_lsp) ?></i></small><br />
                        <small><i><?= htmlspecialchars($productOrderDetail->sp_nsx) ?></i></small>
                    </td>
                    <td align="right" class="text-center"><?= htmlspecialchars($productOrderDetail->sp_dh_soluong) ?></td>
                    <td align="right"><?= htmlspecialchars(number_format( ($productOrderDetail->sp_dh_dongia) , 0, ".", ",")) ?></td>
                    <td align="right"><?= htmlspecialchars(number_format( ($productOrderDetail->sp_dh_soluong) *($productOrderDetail->sp_dh_dongia) , 0, ".", ",")) ?></td>
                    
                </tr>
                <?php $stt++; ?>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" align="right"><b>Tổng thành tiền</b></td>
                    <td align="right"><b><?=htmlspecialchars(number_format( ($orderDetails->tongthanhtien) , 0, ".", ","). ' vnđ')?></b></td>
                </tr>
            </tfoot>
        </table>

        <!-- Thông tin Footer -->
        <br />
        <table border="0" width="100%">
            <tbody>
                <tr>
                    <td align="center">
                        <small>Xin cám ơn Quý khách đã ủng hộ DientuCanTho.vn. Chúc Quý khách An Khang, Thịnh Vượng!</small>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
    <!-- Bootstrap JS -->
    <script src="../../assets/admin/js/bootstrap.min.js"></script>
  
</body>

</html>