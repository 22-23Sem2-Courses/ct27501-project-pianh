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

    use DientuCT\Project\Customer;
    $customer = new Customer($PDO);
    $customers = $customer->viewCustomers();

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
        ->setCellValue('A1', "Danh sách khách hàng");
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(22);
    $spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setName('Times New Roman')->setSize(14)->setBold(true);


    //Merge Tiêu đề
    $spreadsheet->getActiveSheet()->mergeCells("A1:F1");
    // set cell alignment
    $spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    //setting column width
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(22);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(15);


    //Header
    $sheet = $spreadsheet->getActiveSheet()
        ->setCellValue('A2', "Tên khách hàng")
        ->setCellValue('B2', "Địa chỉ")
        ->setCellValue('C2', "Điện thoại")
        ->setCellValue('D2', "Email")
        ->setCellValue('E2', "Năm sinh")
        ->setCellValue('F2', "CMND");

    //Set font style
    //chuyen vao mang
    // $spreadsheet->getActiveSheet()->getStyle('A2:F2')->getFont()->setName('Times New Roman')->setSize(12);
    // $spreadsheet->getActiveSheet()->getStyle('A2:F2')->getFont()->setBold(true);

    $spreadsheet->getActiveSheet()->getStyle('A2:F2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

    //set font style and background color
    $spreadsheet->getActiveSheet()->getStyle('A2:F2')->applyFromArray($tableHead);


    $contentStartRow = 3;
    $currentContentRow = 3;


    foreach($customers as $customer):
    {
        //insert a row after current row (before current row +1)
        $spreadsheet->getActiveSheet()->insertNewRowBefore($currentContentRow+1,1);

        //fill the cell with data
        $sheet = $spreadsheet->getActiveSheet()
            ->setCellValue('A'.$currentContentRow, htmlspecialchars($customer->kh_ten))
            ->setCellValue('B'.$currentContentRow, htmlspecialchars($customer->kh_diachi))
            ->setCellValue('C'.$currentContentRow, htmlspecialchars($customer->kh_dienthoai))
            ->setCellValue('D'.$currentContentRow, htmlspecialchars($customer->kh_email))
            ->setCellValue('E'.$currentContentRow, htmlspecialchars($customer->kh_namsinh))
            ->setCellValue('F'.$currentContentRow, htmlspecialchars($customer->kh_cmnd));

        //set row style
        if ($currentContentRow % 2 == 0) {
            //even row
            $spreadsheet->getActiveSheet()->getStyle('A'.$currentContentRow. ':F'.$currentContentRow)->applyFromArray($evenRow);
        } else {
            //odd row
            $spreadsheet->getActiveSheet()->getStyle('A'.$currentContentRow. ':F'.$currentContentRow)->applyFromArray($oddRow);
        }
        $currentContentRow++;
    }
    endforeach;
    //autofilter
    //define first row and last row
    $firstRow=2;
    $lastRow=$currentContentRow-1;
    $spreadsheet->getActiveSheet()->setAutoFilter("A".$firstRow.":F".$lastRow);


    $writer = new Xlsx($spreadsheet);
    $filePath = __DIR__ . '/../../../assets/templates/excels/customers-list.xlsx';
    $writer->save($filePath);