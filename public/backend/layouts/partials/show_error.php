<?php

$error_message ??= 'Đã có lỗi xảy ra';
$error = "<p class=\"error\">$error_message";
$error .= isset($reason) ? " vì:<br>$reason</p>" : "</p>";
$error .= isset($query) ? "<p>Câu truy vấn là: {$query}</p>" : '';
echo $error;
