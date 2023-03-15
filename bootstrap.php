<?php

define('BASE_URL_PATH', '/');
require_once __DIR__ . '/src/functions.php';
require_once __DIR__ . '/libraries/Psr4AutoloaderClass.php';

$loader = new Psr4AutoloaderClass;
$loader->register();

// Các lớp có không gian tên bắt đầu với DientuCT\Project nằm ở src
$loader->addNamespace('DientuCT\Project', __DIR__ .'/src');

try {
    $PDO = (new DientuCT\Project\PDOFactory)->create([
    'dbhost' => 'localhost',
    'dbname' => 'dientuct',
    'dbuser' => 'root',
    'dbpass' => ''
    ]);
    } catch (Exception $ex) {
        echo 'Không thể kết nối đến MySQL, kiểm tra lại username/password đến MySQL.<br>';
    exit("<pre>${ex}</pre>");
    }

//require_once __DIR__ . '/src/functions.php';