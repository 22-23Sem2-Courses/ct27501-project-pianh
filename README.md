# Project học phần Công nghệ Web (CT275)

Học kỳ 2, Năm học 2022-2023

**MSSV 1** : B1700326

**Họ tên SV 1**: Nguyễn Duy Anh

#**MSSV 2**:

#**Họ tên SV 2**:

**Lớp học phần**: Công Nghệ Web - CT27501

**Tên dự án**: Website điện tử Cần Thơ

**Mô tả dự án**: Website kinh doanh điện thoại, laptop, máy tính bảng,...


Sữa lỗi: 
Call to undefined function Gregwar\Captcha\imagecreatetruecolor() in 
C:\...\vendor\gregwar\captcha\src\Gregwar\Captcha\CaptchaBuilder.php:423 trên Localhost

Vào file php.ini
(Bỏ ; để chức năng Capcha có thể hoạt động)
;extension=gd => extension=gd

Sữa lỗi: 
Composer detected issues in your platform: Your Composer dependencies require a PHP version ">= 8.0.2 Trên Hosting
composer update --ignore-platform-reqs