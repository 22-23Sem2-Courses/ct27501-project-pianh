<?php
    if (session_id() === '') {
        session_start();
    }

    if (!isset($_SESSION['kh_tendangnhap_logged'])){
        echo '<script>location.href = "/admin/auth/login.php";</script>';
    }

    include_once __DIR__ . '../../../../../vendor/autoload.php';
    require_once '../../../../bootstrap.php';

    $kh_tendangnhap_logged=htmlspecialchars($_SESSION['kh_tendangnhap_logged']);

    if ($kh_tendangnhap_logged !='admin' ) {
        $message = "Bạn không phải là thành viên quản trị website! Bạn không được phép truy cập vào trang này!!!!";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo '<script>location.href = "/index.php";</script>';
    }

    use DientuCT\Project\Order;
    $order = new Order($PDO);
    $orders = $order->viewOrders();
// var_dump($orders); die;

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    //call iofactory instead of xlsx writer
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Style\Alignment;
    use PhpOffice\PhpSpreadsheet\Style\Fill;

    //styling arrays <==> $tabeleHead  = arrray();
    $tableHead = [
        'font' => [
            'color' => [
                'rgb' => 'FFFFFF'
            ],
            'bold' => true,
            'size' => 12
        ],
        'fill'=>[
            'fillType' => Fill::FILL_SOLID,
            'startColor' => [
                'rgb' => '0773B8'
            ]
            ],
    ];
    //even row
    $evenRow = [
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => [
                'rgb' => 'CCFFCC'
            ]
        ]
    ];
    //odd row
    $oddRow = [
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => [
                'rgb' => 'CCFFFF'
            ]
        ]
    ];
    //stying arrays end

    $spreadsheet = new Spreadsheet();

    $sheet = $spreadsheet->getActiveSheet();
    //Set default font
    $spreadsheet->getDefaultStyle()
                ->getFont()
                ->setName('Times New Roman')
                ->setSize(11);

    //Dòng Tiêu đề
    $sheet = $spreadsheet->getActiveSheet()
        ->setCellValue('A1', "Danh sách đơn đặt hàng");
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(22);
    $spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setName('Times New Roman')->setSize(14)->setBold(true);


    //Merge Tiêu đề
    $spreadsheet->getActiveSheet()->mergeCells("A1:C1");
    // set cell alignment
    $spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    //setting column width
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(14);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(17);



    //Header
    $sheet = $spreadsheet->getActiveSheet()
        ->setCellValue('A2', "Đơn hàng")
        ->setCellValue('B2', "Ngày lập đơn")
        ->setCellValue('C2', "Khách hàng");

    //Set font style
    //chuyen vao mang
    // $spreadsheet->getActiveSheet()->getStyle('A2:F2')->getFont()->setName('Times New Roman')->setSize(12);
    // $spreadsheet->getActiveSheet()->getStyle('A2:F2')->getFont()->setBold(true);

    $spreadsheet->getActiveSheet()->getStyle('A2:C2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

    //set font style and background color
    $spreadsheet->getActiveSheet()->getStyle('A2:C2')->applyFromArray($tableHead);


    $contentStartRow = 3;
    $currentContentRow = 3;


    foreach($orders as $order):
    {
        //insert a row after current row (before current row +1)
        $spreadsheet->getActiveSheet()->insertNewRowBefore($currentContentRow+1,1);

        //fill the cell with data
        $sheet = $spreadsheet->getActiveSheet()
            ->setCellValue('A'.$currentContentRow, htmlspecialchars($order->dh_ma))
            ->setCellValue('B'.$currentContentRow, htmlspecialchars($order->dh_thoigiantao))
            ->setCellValue('C'.$currentContentRow, htmlspecialchars($order->kh_tendangnhap));
        //set row style
        if ($currentContentRow % 2 == 0) {
            //even row
            $spreadsheet->getActiveSheet()->getStyle('A'.$currentContentRow. ':C'.$currentContentRow)->applyFromArray($evenRow);
        } else {
            //odd row
            $spreadsheet->getActiveSheet()->getStyle('A'.$currentContentRow. ':C'.$currentContentRow)->applyFromArray($oddRow);
        }
        $currentContentRow++;
    }
    endforeach;
    //autofilter
    //define first row and last row
    $firstRow=2;
    $lastRow=$currentContentRow-1;
    $spreadsheet->getActiveSheet()->setAutoFilter("A".$firstRow.":C".$lastRow);


    $writer = new Xlsx($spreadsheet);
    $filePath = __DIR__ . '/../../../assets/templates/excels/orders-list.xlsx';
    $writer->save($filePath);