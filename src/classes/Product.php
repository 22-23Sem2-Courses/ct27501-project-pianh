<?php

namespace DientuCT\Project;

class Product
{
	private $db;

	public $sp_ma = -1;
	public $sp_ten;
	public $sp_soluong;
	public $sp_dophangiai;
	public $sp_manhinh;
	public $sp_camera_truoc;
	public $sp_camera_sau;	
	public $sp_hedieuhanh;
	public $sp_chip;
	public $sp_ram;
	public $sp_rom;
	public $sp_pin;
	public $sp_nsx;
	public $sp_lsp;
	public $sp_gia;
	public $sp_giacu;
	public $sp_km;

	public $hsp_tentaptin;
	public $noidungtimkiem;



	public $sp_thoigiantao;
	public $sp_thoigiancapnhat;

	

	private $errors = [];

	public function getSp_ma()
	{
		return $this->sp_ma;
	}

	public function __construct($pdo)
	{
		$this->db = $pdo;
	}

	public function fill(array $data)
	{
		if (isset($data['sp_ten'])) {
			$this->sp_ten = trim($data['sp_ten']);
		}

		if (isset($data['sp_soluong'])) {
			$this->sp_soluong = trim($data['sp_soluong']);
		}
		
		if (isset($data['sp_dophangiai'])) {
			$this->sp_dophangiai = trim($data['sp_dophangiai']);
		}

		if (isset($data['sp_manhinh'])) {
			$this->sp_manhinh = trim($data['sp_manhinh']);
		}

		if (isset($data['sp_camera_truoc'])) {
			$this->sp_camera_truoc = trim($data['sp_camera_truoc']);
		}

		if (isset($data['sp_camera_sau'])) {
			$this->sp_camera_sau = trim($data['sp_camera_sau']);
		}

		if (isset($data['sp_hedieuhanh'])) {
			$this->sp_hedieuhanh = trim($data['sp_hedieuhanh']);
		}

		if (isset($data['sp_chip'])) {
			$this->sp_chip = trim($data['sp_chip']);
		}
		
		if (isset($data['sp_ram'])) {
			$this->sp_ram = trim($data['sp_ram']);
		}

		if (isset($data['sp_rom'])) {
			$this->sp_rom = trim($data['sp_rom']);
		}

		if (isset($data['sp_pin'])) {
			$this->sp_pin = trim($data['sp_pin']);
		}

		if (isset($data['sp_nsx'])) {
			$this->sp_nsx = trim($data['sp_nsx']);
		}

		if (isset($data['sp_lsp'])) {
			$this->sp_lsp = trim($data['sp_lsp']);
		}

		if (isset($data['sp_gia'])) {
			$this->sp_gia = trim($data['sp_gia']);
		}

		if (isset($data['sp_giacu'])) {
			$this->sp_giacu = trim($data['sp_giacu']);
		}

		if (isset($data['sp_km'])) {
			$this->sp_km = trim($data['sp_km']);
		}

		// if (isset($data['noidungtimkiem'])) {
		// 	$this->noidungtimkiem = trim($data['noidungtimkiem']);
		// }

		return $this;
	}

	public function getValidationErrors()
	{
		return $this->errors;
	}

	public function validate()
	{
		if (!$this->sp_ten) {
			$this->errors['sp_ten'] = 'Tên không hợp lệ.';
		}

		if (($this->sp_soluong) < 0 && (!$this->sp_ten) ) {
			$this->errors['sp_soluong'] = 'Số lượng không hợp lệ.';
		}

		if (strlen($this->sp_dophangiai) > 100) {
			$this->errors['sp_dophangiai'] = 'Ghi chú độ phân giải có tối đa 100 ký tự.';
		}

		if (strlen($this->sp_manhinh) > 100) {
			$this->errors['sp_manhinh'] = 'Ghi chú màn hình có tối đa 100 ký tự.';
		}

		if (strlen($this->sp_camera_truoc) > 100) {
			$this->errors['sp_camera_truoc'] = 'Ghi chú camera trước có tối đa 100 ký tự.';
		}

		if (strlen($this->sp_camera_sau) > 100) {
			$this->errors['sp_camera_sau'] = 'Ghi chú camera sau có tối đa 100 ký tự.';
		}

		if (strlen($this->sp_hedieuhanh) > 100) {
			$this->errors['sp_hedieuhanh'] = 'Ghi chú hệ điều hành sau có tối đa 100 ký tự.';
		}

		if (strlen($this->sp_chip) > 100) {
			$this->errors['sp_chip'] = 'Ghi chú chip có tối đa 100 ký tự.';
		}

		if (strlen($this->sp_ram) > 100) {
			$this->errors['sp_ram'] = 'Ghi chú ram có tối đa 100 ký tự.';
		}

		if (strlen($this->sp_rom) > 100) {
			$this->errors['sp_rom'] = 'Ghi chú rom có tối đa 100 ký tự.';
		}

		if (strlen($this->sp_pin) > 100) {
			$this->errors['sp_pin'] = 'Ghi chú pin có tối đa 100 ký tự.';
		}

		if (strlen($this->sp_nsx) > 100) {
			$this->errors['sp_nsx'] = 'Ghi chú nhà sản xuất có tối đa 100 ký tự.';
		}

		if (strlen($this->sp_lsp) > 100) {
			$this->errors['sp_lsp'] = 'Ghi chú loại sản phẩm có tối đa 100 ký tự.';
		}

		if (strlen($this->sp_gia) < 0) {
			$this->errors['sp_gia'] = 'Giá không hợp lệ.';
		}

		if (strlen($this->sp_giacu) < 0) {
			$this->errors['sp_giacu'] = 'Giá cũ không hợp lệ.';
		}

		if (strlen($this->sp_km) > 100) {
			$this->errors['sp_km'] = 'Ghi chú khuyến mãi có tối đa 100 ký tự.';
		}
		

		return empty($this->errors);
	}
	public function all() //select sanpham
	{
		$products = [];
		
		$statement = $this->db->prepare('SELECT * FROM sanpham');
		$statement->execute();
		while ($row = $statement->fetch()) {
			$product = new Product($this->db);
			$product->fillFromDB($row);
			$products[] = $product;
		}
	
		return $products;
	}

	public function viewProducts()
	{
		$products = [];
		
		$statement = $this->db->prepare('select * from viewDanhSachSanPham');
		$statement->execute();
		while ($row = $statement->fetch()) {
			$product = new Product($this->db);
			$product->fillFromDBViewProducts($row);
			$products[] = $product;
		}
	
		return $products;
	}

	protected function fillFromDBViewProducts(array $row)
	{
		[
			'sp_ma' => $this->sp_ma,
			'sp_ten' => $this->sp_ten,
			'sp_gia' => $this->sp_gia,
			'sp_soluong' => $this->sp_soluong,
			'sp_nsx' => $this->sp_nsx,
			'sp_lsp' => $this->sp_lsp
		] = $row;
		return $this;
	}
	

	protected function fillFromDB(array $row)
	{
		[
			'sp_ma' => $this->sp_ma,
			'sp_ten' => $this->sp_ten,
			'sp_soluong' => $this->sp_soluong,
			'sp_dophangiai' => $this->sp_dophangiai,
			'sp_manhinh' => $this->sp_manhinh,
			'sp_camera_truoc' => $this->sp_camera_truoc,
			'sp_camera_sau' => $this->sp_camera_sau,
			'sp_hedieuhanh' => $this->sp_hedieuhanh,
			'sp_chip' => $this->sp_chip,
			'sp_ram' => $this->sp_ram,
			'sp_rom' => $this->sp_rom,
			'sp_pin' => $this->sp_pin,
			'sp_nsx' => $this->sp_nsx,
			'sp_lsp' => $this->sp_lsp,
			'sp_gia' => $this->sp_gia,
			'sp_giacu' => $this->sp_giacu,
			'sp_km' => $this->sp_km,
			'sp_thoigiantao' => $this->sp_thoigiantao,
			'sp_thoigiancapnhat' => $this->sp_thoigiancapnhat
		] = $row;
		return $this;
	}

	public function save()
	{
		$result = false;
		
		if ($this->sp_ma >= 0) {
			$statement = $this->db->prepare(
				'update sanpham set sp_ten = :sp_ten, sp_soluong = :sp_soluong, sp_dophangiai = :sp_dophangiai, sp_manhinh = :sp_manhinh,
					sp_camera_truoc = :sp_camera_truoc, sp_camera_sau = :sp_camera_sau, sp_hedieuhanh = :sp_hedieuhanh, 
					sp_chip = :sp_chip, sp_ram = :sp_ram, sp_rom = :sp_rom,
					sp_pin = :sp_pin, sp_nsx = :sp_nsx, sp_lsp = :sp_lsp,
					sp_gia = :sp_gia, sp_giacu = :sp_giacu, sp_km = :sp_km,
					sp_thoigiancapnhat = now()
					where sp_ma = :sp_ma'
			);
			$result = $statement->execute([
				'sp_ten' => $this->sp_ten,
				'sp_soluong' => $this->sp_soluong,
				'sp_dophangiai' => $this->sp_dophangiai,
				'sp_manhinh' => $this->sp_manhinh,
				'sp_camera_truoc' => $this->sp_camera_truoc,
				'sp_camera_sau' => $this->sp_camera_sau,
				'sp_hedieuhanh' => $this->sp_hedieuhanh,
				'sp_chip' => $this->sp_chip,
				'sp_ram' => $this->sp_ram,
				'sp_rom' => $this->sp_rom,
				'sp_pin' => $this->sp_pin,
				'sp_nsx' => $this->sp_nsx,
				'sp_lsp' => $this->sp_lsp,
				'sp_gia' => $this->sp_gia,
				'sp_giacu' => $this->sp_giacu,
				'sp_km' => $this->sp_km,
				'sp_ma' => $this->sp_ma]);
		} else {
			$statement = $this->db->prepare(
				'insert into sanpham (sp_ten, sp_soluong, sp_dophangiai, sp_manhinh, sp_camera_truoc, sp_camera_sau, sp_hedieuhanh, 
					sp_chip, sp_ram, sp_rom, sp_pin, sp_nsx, sp_lsp, sp_gia, sp_giacu, sp_km, sp_thoigiantao, sp_thoigiancapnhat)
					values (:sp_ten, :sp_soluong, :sp_dophangiai, :sp_manhinh, :sp_camera_truoc, :sp_camera_sau, :sp_hedieuhanh, 
						:sp_chip, :sp_ram, :sp_rom, :sp_pin, :sp_nsx, :sp_lsp, :sp_gia, :sp_giacu, :sp_km, now(), now())'
			);
			 
			$result = $statement->execute([
				'sp_ten' => $this->sp_ten,
				'sp_soluong' => $this->sp_soluong,
				'sp_dophangiai' => $this->sp_dophangiai,
				'sp_manhinh' => $this->sp_manhinh,
				'sp_camera_truoc' => $this->sp_camera_truoc,
				'sp_camera_sau' => $this->sp_camera_sau,
				'sp_hedieuhanh' => $this->sp_hedieuhanh,
				'sp_chip' => $this->sp_chip,
				'sp_ram' => $this->sp_ram,
				'sp_rom' => $this->sp_rom,
				'sp_pin' => $this->sp_pin,
				'sp_nsx' => $this->sp_nsx,
				'sp_lsp' => $this->sp_lsp,
				'sp_gia' => $this->sp_gia,
				'sp_giacu' => $this->sp_giacu,
				'sp_km' => $this->sp_km
			]);
			if ($result) {
				$this->sp_ma = $this->db->lastInsertId();
			}
			
		} 
		return $result;
	}


	public function find($sp_ma)
	{
		$statement = $this->db->prepare('select * from sanpham where sp_ma = :sp_ma');
		$statement->execute(['sp_ma' => $sp_ma]);

		if ($row = $statement->fetch()) {
			$this->fillFromDB($row);
			return $this;
		} 
		return null;
	} 

	public function update(array $data)
	{
		$this->fill($data);
		if ($this->validate()) {
			return $this->save();
		} 
		return false;
	}

	// public function delete()
	// {
	// 	$statement = $this->db->prepare('delete from sanpham where sp_ma = :sp_ma');
	// 	return $statement->execute(['sp_ma' => $this->sp_ma]);
	// }

	public function delete()
	{
		$result = false;
		
		if ($this->sp_ma >= 0) {

			$statement = $this->db->prepare('delete from marketing where sp_ma = :sp_ma');
			$result = $statement->execute(['sp_ma' => $this->sp_ma]);

			$statement = $this->db->prepare('delete from hinhsanpham where sp_ma = :sp_ma');
			$result = $statement->execute(['sp_ma' => $this->sp_ma]);

			$statement = $this->db->prepare('delete from sanpham where sp_ma = :sp_ma');
			$result = $statement->execute(['sp_ma' => $this->sp_ma]);
		} 
			
		return $result;
	}


	// Truy vấn tất cả dữ liệu sản phẩm nối kết table hình sản phẩm
	public function allProductImages()
	{
		$products = [];
		
		$statement = $this->db->prepare('SELECT sp.sp_ma, sp.sp_ten, sp.sp_soluong, sp.sp_dophangiai, sp.sp_manhinh,
											sp.sp_camera_truoc, sp.sp_camera_sau, sp.sp_hedieuhanh, sp.sp_chip,
											sp.sp_ram, sp.sp_rom, sp.sp_pin, sp.sp_nsx, sp.sp_lsp, sp.sp_gia, sp.sp_giacu,
											sp.sp_km,  MIN(hsp.hsp_tentaptin) AS hsp_tentaptin
										FROM sanpham sp JOIN hinhsanpham hsp ON hsp.sp_ma=sp.sp_ma
										GROUP BY sp.sp_ma, sp.sp_ten, sp.sp_soluong, sp.sp_dophangiai, sp.sp_manhinh,
											sp.sp_camera_truoc, sp.sp_camera_sau, sp.sp_hedieuhanh, sp.sp_chip,
											sp.sp_ram, sp.sp_rom, sp.sp_pin, sp.sp_nsx, sp.sp_lsp, sp.sp_gia, sp.sp_giacu,
											sp.sp_km');
		$statement->execute();
		while ($row = $statement->fetch()) {
			$product = new Product($this->db);
			$product->fillFromDBProductImages($row);
			$products[] = $product;
		}
	
		return $products;
	}

	protected function fillFromDBProductImages(array $row)
	{
		[
			'sp_ma' => $this->sp_ma,
			'sp_ten' => $this->sp_ten,
			'sp_soluong' => $this->sp_soluong,
			'sp_dophangiai' => $this->sp_dophangiai,
			'sp_manhinh' => $this->sp_manhinh,
			'sp_camera_truoc' => $this->sp_camera_truoc,
			'sp_camera_sau' => $this->sp_camera_sau,
			'sp_hedieuhanh' => $this->sp_hedieuhanh,
			'sp_chip' => $this->sp_chip,
			'sp_ram' => $this->sp_ram,
			'sp_rom' => $this->sp_rom,
			'sp_pin' => $this->sp_pin,
			'sp_nsx' => $this->sp_nsx,
			'sp_lsp' => $this->sp_lsp,
			'sp_gia' => $this->sp_gia,
			'sp_giacu' => $this->sp_giacu,
			'sp_km' => $this->sp_km,
			'hsp_tentaptin' => $this->hsp_tentaptin,
		] = $row;
		return $this;
	}

	// Truy vấn tất cả dữ liệu điện thoại
	public function allProductImageMobiles()
	{
		$products = [];
		
		$statement = $this->db->prepare('SELECT sp.sp_ma, sp.sp_ten, sp.sp_soluong, sp.sp_dophangiai, sp.sp_manhinh,
											sp.sp_camera_truoc, sp.sp_camera_sau, sp.sp_hedieuhanh, sp.sp_chip,
											sp.sp_ram, sp.sp_rom, sp.sp_pin, sp.sp_nsx, sp.sp_lsp, sp.sp_gia, sp.sp_giacu,
											sp.sp_km,  MIN(hsp.hsp_tentaptin) AS hsp_tentaptin
										FROM sanpham sp JOIN hinhsanpham hsp ON hsp.sp_ma=sp.sp_ma
										WHERE (sp.sp_lsp="Điện thoại" OR sp.sp_lsp="Mobile" )
										GROUP BY sp.sp_ma, sp.sp_ten, sp.sp_soluong, sp.sp_dophangiai, sp.sp_manhinh,
											sp.sp_camera_truoc, sp.sp_camera_sau, sp.sp_hedieuhanh, sp.sp_chip,
											sp.sp_ram, sp.sp_rom, sp.sp_pin, sp.sp_nsx, sp.sp_lsp, sp.sp_gia, sp.sp_giacu,
											sp.sp_km
										LIMIT 15');
		$statement->execute();
		while ($row = $statement->fetch()) {
			$product = new Product($this->db);
			$product->fillFromDBProductImages($row);
			$products[] = $product;
		}
	
		return $products;
	}

	// Truy vấn tất cả dữ liệu laptop
	public function allProductImageLaptops()
	{
		$products = [];
		
		$statement = $this->db->prepare('SELECT sp.sp_ma, sp.sp_ten, sp.sp_soluong, sp.sp_dophangiai, sp.sp_manhinh,
											sp.sp_camera_truoc, sp.sp_camera_sau, sp.sp_hedieuhanh, sp.sp_chip,
											sp.sp_ram, sp.sp_rom, sp.sp_pin, sp.sp_nsx, sp.sp_lsp, sp.sp_gia, sp.sp_giacu,
											sp.sp_km,  MIN(hsp.hsp_tentaptin) AS hsp_tentaptin
										FROM sanpham sp JOIN hinhsanpham hsp ON hsp.sp_ma=sp.sp_ma
										WHERE (sp.sp_lsp="Laptop")
										GROUP BY sp.sp_ma, sp.sp_ten, sp.sp_soluong, sp.sp_dophangiai, sp.sp_manhinh,
											sp.sp_camera_truoc, sp.sp_camera_sau, sp.sp_hedieuhanh, sp.sp_chip,
											sp.sp_ram, sp.sp_rom, sp.sp_pin, sp.sp_nsx, sp.sp_lsp, sp.sp_gia, sp.sp_giacu,
											sp.sp_km
										LIMIT 5');
		$statement->execute();
		while ($row = $statement->fetch()) {
			$product = new Product($this->db);
			$product->fillFromDBProductImages($row);
			$products[] = $product;
		}
	
		return $products;
	}

	// Truy vấn tất cả dữ liệu tablet
	public function allProductImageTablets()
	{
		$products = [];
		
		$statement = $this->db->prepare('SELECT sp.sp_ma, sp.sp_ten, sp.sp_soluong, sp.sp_dophangiai, sp.sp_manhinh,
											sp.sp_camera_truoc, sp.sp_camera_sau, sp.sp_hedieuhanh, sp.sp_chip,
											sp.sp_ram, sp.sp_rom, sp.sp_pin, sp.sp_nsx, sp.sp_lsp, sp.sp_gia, sp.sp_giacu,
											sp.sp_km,  MIN(hsp.hsp_tentaptin) AS hsp_tentaptin
										FROM sanpham sp JOIN hinhsanpham hsp ON hsp.sp_ma=sp.sp_ma
										WHERE (sp.sp_lsp="Tablet" OR sp.sp_lsp="Máy tính bảng")
										GROUP BY sp.sp_ma, sp.sp_ten, sp.sp_soluong, sp.sp_dophangiai, sp.sp_manhinh,
											sp.sp_camera_truoc, sp.sp_camera_sau, sp.sp_hedieuhanh, sp.sp_chip,
											sp.sp_ram, sp.sp_rom, sp.sp_pin, sp.sp_nsx, sp.sp_lsp, sp.sp_gia, sp.sp_giacu,
											sp.sp_km 
										LIMIT 5') ;
		$statement->execute();
		while ($row = $statement->fetch()) {
			$product = new Product($this->db);
			$product->fillFromDBProductImages($row);
			$products[] = $product;
		}
	
		return $products;
	}

	// Truy vấn tất cả dữ liệu Accessory
	public function allProductImageAccessorys()
	{
		$products = [];
		
		$statement = $this->db->prepare('SELECT sp.sp_ma, sp.sp_ten, sp.sp_soluong, sp.sp_dophangiai, sp.sp_manhinh,
											sp.sp_camera_truoc, sp.sp_camera_sau, sp.sp_hedieuhanh, sp.sp_chip,
											sp.sp_ram, sp.sp_rom, sp.sp_pin, sp.sp_nsx, sp.sp_lsp, sp.sp_gia, sp.sp_giacu,
											sp.sp_km,  MIN(hsp.hsp_tentaptin) AS hsp_tentaptin
										FROM sanpham sp JOIN hinhsanpham hsp ON hsp.sp_ma=sp.sp_ma
										WHERE (sp.sp_lsp="Accessory" OR sp.sp_lsp="Phụ kiện")
										GROUP BY sp.sp_ma, sp.sp_ten, sp.sp_soluong, sp.sp_dophangiai, sp.sp_manhinh,
											sp.sp_camera_truoc, sp.sp_camera_sau, sp.sp_hedieuhanh, sp.sp_chip,
											sp.sp_ram, sp.sp_rom, sp.sp_pin, sp.sp_nsx, sp.sp_lsp, sp.sp_gia, sp.sp_giacu,
											sp.sp_km 
										LIMIT 5') ;
		$statement->execute();
		while ($row = $statement->fetch()) {
			$product = new Product($this->db);
			$product->fillFromDBProductImages($row);
			$products[] = $product;
		}
	
		return $products;
	}

		// Truy vấn tất cả dữ liệu Smartwatchs
		public function allProductImageSmartwatchs()
		{
			$products = [];
			
			$statement = $this->db->prepare('SELECT sp.sp_ma, sp.sp_ten, sp.sp_soluong, sp.sp_dophangiai, sp.sp_manhinh,
												sp.sp_camera_truoc, sp.sp_camera_sau, sp.sp_hedieuhanh, sp.sp_chip,
												sp.sp_ram, sp.sp_rom, sp.sp_pin, sp.sp_nsx, sp.sp_lsp, sp.sp_gia, sp.sp_giacu,
												sp.sp_km,  MIN(hsp.hsp_tentaptin) AS hsp_tentaptin
											FROM sanpham sp JOIN hinhsanpham hsp ON hsp.sp_ma=sp.sp_ma
											WHERE (sp.sp_lsp="Smartwatch" OR sp.sp_lsp="Đồng hồ thông minh")
											GROUP BY sp.sp_ma, sp.sp_ten, sp.sp_soluong, sp.sp_dophangiai, sp.sp_manhinh,
												sp.sp_camera_truoc, sp.sp_camera_sau, sp.sp_hedieuhanh, sp.sp_chip,
												sp.sp_ram, sp.sp_rom, sp.sp_pin, sp.sp_nsx, sp.sp_lsp, sp.sp_gia, sp.sp_giacu,
												sp.sp_km 
											LIMIT 5') ;
			$statement->execute();
			while ($row = $statement->fetch()) {
				$product = new Product($this->db);
				$product->fillFromDBProductImages($row);
				$products[] = $product;
			}
		
			return $products;
		}

		// Tất cả hình ảnh của một sản phâm
		public function allImageOfProduct($sp_ma)
		{
			$products = [];
			
			$statement = $this->db->prepare('SELECT sp.sp_ma, sp.sp_ten, sp.sp_soluong, sp.sp_dophangiai, sp.sp_manhinh,
												sp.sp_camera_truoc, sp.sp_camera_sau, sp.sp_hedieuhanh, sp.sp_chip,
												sp.sp_ram, sp.sp_rom, sp.sp_pin, sp.sp_nsx, sp.sp_lsp, sp.sp_gia, sp.sp_giacu,
												sp.sp_km, hsp.hsp_tentaptin
											FROM sanpham sp JOIN hinhsanpham hsp ON hsp.sp_ma=sp.sp_ma
											WHERE sp.sp_ma = :sp_ma
											');
			$statement->execute(['sp_ma' => $sp_ma]);
			while ($row = $statement->fetch()) {
				$product = new Product($this->db);
				$product->fillFromDBProductImages($row);
				$products[] = $product;
			}
		
			return $products;
		}

	// Tìm kiếm sản phẩm
	// public function findProductImage($noidungtimkiem)
	// {
	// 	$products = [];
		
	// 	$statement = $this->db->prepare('SELECT DISTINCT sp.sp_ma, sp.sp_ten, sp.sp_soluong, sp.sp_dophangiai, sp.sp_manhinh,
	// 										sp.sp_camera_truoc, sp.sp_camera_sau, sp.sp_hedieuhanh, sp.sp_chip,
	// 										sp.sp_ram, sp.sp_rom, sp.sp_pin, sp.sp_nsx, sp.sp_lsp, sp.sp_gia, sp.sp_giacu,
	// 										sp.sp_km, hsp.hsp_tentaptin
	// 									FROM sanpham sp JOIN hinhsanpham hsp ON hsp.sp_ma=sp.sp_ma
	// 									WHERE ((sp.sp_ten LIKE :noidungtimkiem) OR (sp.sp_lsp LIKE :noidungtimkiem) 
	// 									)
	// 									') ;
										
	// 	$statement->execute(['noidungtimkiem' => '%' . $noidungtimkiem . '%']);
	// 	while ($row = $statement->fetch()) {
	// 		$product = new Product($this->db);
	// 		$product->fillFromDBProductImages($row);
	// 		$products[] = $product;
	// 	}
	
	// 	return $products;
	// }

	public function findProductImage($noidungtimkiem)
	{
		$products = [];
		
		$statement = $this->db->prepare('SELECT DISTINCT sp_ma, sp_ten, sp_soluong, sp_dophangiai, sp_manhinh,
											sp_camera_truoc, sp_camera_sau, sp_hedieuhanh, sp_chip,
											sp_ram, sp_rom, sp_pin, sp_nsx, sp_lsp, sp_gia, sp_giacu,
											sp_km
										FROM sanpham 
										WHERE (
											(sp_ten LIKE :noidungtimkiem) OR (sp_lsp LIKE :noidungtimkiem) OR (sp_hedieuhanh LIKE :noidungtimkiem)
										)
										') ;
										
		$statement->execute(['noidungtimkiem' => '%' . $noidungtimkiem . '%']);
		while ($row = $statement->fetch()) {
			$product = new Product($this->db);
			$product->fillFromDBProductSearch($row);
			$products[] = $product;
		}
	
		return $products;
	}


	protected function fillFromDBProductSearch(array $row)
	{
		[
			'sp_ma' => $this->sp_ma,
			'sp_ten' => $this->sp_ten,
			'sp_soluong' => $this->sp_soluong,
			'sp_dophangiai' => $this->sp_dophangiai,
			'sp_manhinh' => $this->sp_manhinh,
			'sp_camera_truoc' => $this->sp_camera_truoc,
			'sp_camera_sau' => $this->sp_camera_sau,
			'sp_hedieuhanh' => $this->sp_hedieuhanh,
			'sp_chip' => $this->sp_chip,
			'sp_ram' => $this->sp_ram,
			'sp_rom' => $this->sp_rom,
			'sp_pin' => $this->sp_pin,
			'sp_nsx' => $this->sp_nsx,
			'sp_lsp' => $this->sp_lsp,
			'sp_gia' => $this->sp_gia,
			'sp_giacu' => $this->sp_giacu,
			'sp_km' => $this->sp_km,
		] = $row;
		return $this;
	}
	


}
