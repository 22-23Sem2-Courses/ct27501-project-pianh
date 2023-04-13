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

    // Creating the new document...
    $phpWord = new \PhpOffice\PhpWord\PhpWord();

    //Lấy dữ liệu
    use DientuCT\Project\Customer;
    $customer = new Customer($PDO);
    $customers = $customer->viewCustomers();

    /* Note: any element you append to a document must reside inside of a Section. */

    // Adding an empty Section to the document...
    $section = $phpWord->addSection();
    // Adding Text element to the Section having font styled by default...
    $section->addText(
        'Danh sách khách hàng',
        array('name' => 'Times New Roman', 'size' => 14, 'align'=>'center', 'bold' => true, )
    );

    foreach($customers as $customer) {
        $section->addText(
            'Họ tên: ' . htmlspecialchars($customer->kh_ten) 
            // . ' - Giới tính: ' .$khachhang['kh_gioitinh']
            . ' - SĐT: ' .htmlspecialchars($customer->kh_dienthoai)
            . ' - Địa chỉ: ' .htmlspecialchars($customer->kh_diachi)
            . ' - Email: ' .htmlspecialchars($customer->kh_email)
            . ' - CMND: ' .htmlspecialchars($customer->kh_namsinh)
            . ' - Năm sinh: ' .htmlspecialchars($customer->kh_cmnd),
            array('name' => 'Times New Roman', 'size' => 10)
        );
    }


    /*
    * Note: it's possible to customize font style of the Text element you add in three ways:
    * - inline;
    * - using named font style (new font style object will be implicitly created);
    * - using explicitly created font style object.
    */

    // Adding Text element with font customized inline...
    $section->addText(
    );
    $section->addText(
        '"Kết thúc file danh sách khách hàng"',
        array('name' => 'Times New Roman', 'size' => 10)
    );

    // Adding Text element with font customized using named font style...
    $fontStyleName = 'oneUserDefinedStyle';
    $phpWord->addFontStyle(
        $fontStyleName,
        array('name' => 'Times New Roman', 'size' => 10, 'color' => '1B2232', 'bold' => true)
    );
    // $section->addText(
    //     '"The greatest accomplishment is not in never falling, '
    //         . 'but in rising again after you fall." '
    //         . '(Vince Lombardi)',
    //     $fontStyleName
    // );

    // Adding Text element with font customized using explicitly created font style object...
    $fontStyle = new \PhpOffice\PhpWord\Style\Font();
    $fontStyle->setBold(true);
    $fontStyle->setName('Tahoma');
    $fontStyle->setSize(10);
    $myTextElement = $section->addText('"Hệ thống cửa hàng điện tử Cần Thơ." (DientuCanTho.vn)');
    $myTextElement->setFontStyle($fontStyle);

    // Saving the document as OOXML file...
    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
    $filePath = __DIR__ . '/../../../assets/templates/words/customers-list.docx';
    $objWriter->save($filePath);

    // Saving the document as ODF file...
    // $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'ODText');
    // $objWriter->save('helloWorld.odt');

    // Saving the document as HTML file...
    // $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
    // $objWriter->save('helloWorld.html');

    /* Note: we skip RTF, because it's not XML-based and requires a different example. */
    /* Note: we skip PDF, because "HTML-to-PDF" approach is used to create PDF documents. */