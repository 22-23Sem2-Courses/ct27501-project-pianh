<?php
    if (session_id() === '') {
        session_start();
    }

    if (!isset($_SESSION['kh_tendangnhap_logged'])){
        echo '<script>location.href = "/admin/auth/login.php";</script>';
    }

    include_once __DIR__ . '../../../../../vendor/autoload.php';
    require_once '../../../../bootstrap.php';
    use DientuCT\Project\Product;
    $product = new Product($PDO);
    $products = $product->viewProducts();
    // var_dump($products); die;

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
        ->setCellValue('A1', "Danh sách sản phẩm");
    $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(22);
    $spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setName('Times New Roman')->setSize(14)->setBold(true);


    //Merge Tiêu đề
    $spreadsheet->getActiveSheet()->mergeCells("A1:F1");
    // set cell alignment
    $spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    //setting column width
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(12);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(50);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(18);
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(18);


    //Header
    $sheet = $spreadsheet->getActiveSheet()
        ->setCellValue('A2', "Mã SP")
        ->setCellValue('B2', "Tên sản phẩm")
        ->setCellValue('C2', "Giá")
        ->setCellValue('D2', "Số lượng")
        ->setCellValue('E2', "Loại sản phẩm")
        ->setCellValue('F2', "Nhà sản xuất");

    //Set font style
    //chuyen vao mang
    // $spreadsheet->getActiveSheet()->getStyle('A2:F2')->getFont()->setName('Times New Roman')->setSize(12);
    // $spreadsheet->getActiveSheet()->getStyle('A2:F2')->getFont()->setBold(true);

    $spreadsheet->getActiveSheet()->getStyle('A2:F2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

    //set font style and background color
    $spreadsheet->getActiveSheet()->getStyle('A2:F2')->applyFromArray($tableHead);


    $contentStartRow = 3;
    $currentContentRow = 3;


    foreach($products as $product):
    {
        //insert a row after current row (before current row +1)
        $spreadsheet->getActiveSheet()->insertNewRowBefore($currentContentRow+1,1);

        //fill the cell with data
        $sheet = $spreadsheet->getActiveSheet()
            ->setCellValue('A'.$currentContentRow, htmlspecialchars($product->sp_ma))
            ->setCellValue('B'.$currentContentRow, htmlspecialchars($product->sp_ten))
            ->setCellValue('C'.$currentContentRow, htmlspecialchars($product->sp_gia))
            ->setCellValue('D'.$currentContentRow, htmlspecialchars($product->sp_soluong))
            ->setCellValue('E'.$currentContentRow, htmlspecialchars($product->sp_lsp))
            ->setCellValue('F'.$currentContentRow, htmlspecialchars($product->sp_nsx));

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
    $filePath = __DIR__ . '/../../../assets/templates/excels/products-list.xlsx';
    $writer->save($filePath);