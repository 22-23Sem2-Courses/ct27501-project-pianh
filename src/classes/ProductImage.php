<?php

namespace DientuCT\Project;

class ProductImage
{
	private $db;

	public $hsp_ma = -1;
	public $sp_ten; //Hinhsanpham join sanpham
	public $sp_lsp; //Hinhsanpham join sanpham
	public $hsp_tentaptin;
	public $file_name;
	public $sp_ma;
	public $hsp_thoigiantao;
	public $hsp_thoigiancapnhat;
	private $errors = [];

	public function getHsp_ma()
	{
		return $this->hsp_ma;
	}

	public function __construct($pdo)
	{
		$this->db = $pdo;
	}

	public function fill(array $data)
	{
		$this->hsp_tentaptin = $_FILES['hsp_tentaptin']['name'];
		$this->hsp_tentaptin = date('YmdHis') . '_'. $this->hsp_tentaptin;
		// if (isset($data['hsp_tentaptin'])) {
		// 	$this->hsp_tentaptin = date('YmdHis') . '_'. trim($data['hsp_tentaptin']['name']);
		// }

		if (isset($data['sp_ma'])) {
			$this->sp_ma = ($data['sp_ma']);
		}

		return $this;
	}

	public function getValidationErrors()
	{
		return $this->errors;
	}

	public function validate()
	{
		if (!$this->hsp_tentaptin) {
			$this->errors['hsp_tentaptin'] = 'Không tồn tại tập tin.';
		}

		if ( (!$this->sp_ma) || ($this->sp_ma) == "" ) {
			$this->errors['sp_ma'] = 'Vui lòng chọn sản phẩm cần thêm hình ảnh.';
		}

		return empty($this->errors);
	}

	public function all()
	{
		$product_images = [];
		
		$statement = $this->db->prepare('SELECT * FROM hinhsanpham hsp
										INNER JOIN sanpham sp ON sp.sp_ma = hsp.sp_ma
										GROUP BY hsp_ma ORDER BY hsp_ma ASC');
		$statement->execute();
		while ($row = $statement->fetch()) {
			$product_image = new ProductImage($this->db);
			$product_image->fillFromDB($row);
			$product_images[] = $product_image;
		}
	
		return $product_images;
	}


	protected function fillFromDB(array $row)
	{
		[
			'sp_ten' => $this->sp_ten,
			'sp_lsp' => $this->sp_lsp,
			'hsp_ma' => $this->hsp_ma,
			'hsp_tentaptin' => $this->hsp_tentaptin,
			'sp_ma' => $this->sp_ma,
			'hsp_thoigiantao' => $this->hsp_thoigiantao,
			'hsp_thoigiancapnhat' => $this->hsp_thoigiancapnhat
		] = $row;
		return $this;
	}




	public function save()
	{
		$result = false;

		if ($this->hsp_ma >= 0) {
			$statement = $this->db->prepare(
				'update hinhsanpham set hsp_tentaptin = :hsp_tentaptin,
                    sp_ma = :sp_ma,
					hsp_thoigiancapnhat = now()
					where hsp_ma = :hsp_ma'
			);
			$result = $statement->execute([
				'hsp_tentaptin' => $this->hsp_tentaptin,
				'sp_ma' => $this->sp_ma,
				'hsp_ma' => $this->hsp_ma
            ]);
            
		} else {
			$statement = $this->db->prepare(
				'insert into hinhsanpham (hsp_tentaptin, sp_ma, hsp_thoigiantao, hsp_thoigiancapnhat)
					values (:hsp_tentaptin, :sp_ma, now(), now())'
			);
			$result = $statement->execute([
				'hsp_tentaptin' => $this->hsp_tentaptin,
				'sp_ma' => $this->sp_ma
			]);
			if ($result) {
				$this->hsp_ma = $this->db->lastInsertId();
			}
			
		} 
		return $result;
	}

	protected function fillProductImage(array $row)
	{
		[
			'sp_ten' => $this->sp_ten,
			'sp_lsp' => $this->sp_lsp,
			'hsp_ma' => $this->hsp_ma,
			'hsp_tentaptin' => $this->hsp_tentaptin,
			'sp_ma' => $this->sp_ma,
			'hsp_thoigiantao' => $this->hsp_thoigiantao,
			'hsp_thoigiancapnhat' => $this->hsp_thoigiancapnhat
		] = $row;
		return $this;
	}

	// Tìm các hình sản phẩm dựa vào hsp_ma
	public function findProductImage($hsp_ma)
	{
		$statement = $this->db->prepare('select * from `hinhsanpham` hsp join `sanpham` sp ON sp.sp_ma = hsp.sp_ma where hsp_ma = :hsp_ma');
		// $statement = $this->db->prepare('select * from hinhsanpham where hsp_ma = :hsp_ma');
		$statement->execute(['hsp_ma' => $hsp_ma]);

		if ($row = $statement->fetch()) {
			$this->fillProductImage($row);
			return $this;
		} 
		return null;
	}


	protected function fillFromDBFind(array $row)
	{
		[
			'hsp_ma' => $this->hsp_ma,
			'hsp_tentaptin' => $this->hsp_tentaptin,
			'sp_ma' => $this->sp_ma,
			'hsp_thoigiantao' => $this->hsp_thoigiantao,
			'hsp_thoigiancapnhat' => $this->hsp_thoigiancapnhat
		] = $row;
		return $this;
	}



	public function find($hsp_ma)
	{
		$statement = $this->db->prepare('select * from hinhsanpham where hsp_ma = :hsp_ma');
		$statement->execute(['hsp_ma' => $hsp_ma]);

		if ($row = $statement->fetch()) {
			$this->fillFromDBFind($row);
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

	public function delete()
	{
		$statement = $this->db->prepare('delete from hinhsanpham where hsp_ma = :hsp_ma');
		return $statement->execute(['hsp_ma' => $this->hsp_ma]);
	}

	// Tìm hình sản phẩm đầu tiên dựa vào sp_ma
	public function findFirstProductImageByProduct($sp_ma)
	{
		$statement = $this->db->prepare('SELECT hsp.hsp_ma, sp.sp_ten, sp.sp_lsp, sp.sp_ma, hsp.hsp_tentaptin, hsp.hsp_thoigiantao, hsp.hsp_thoigiancapnhat, MIN(hsp.hsp_tentaptin) FROM `hinhsanpham` hsp 
										JOIN `sanpham` sp ON sp.sp_ma = hsp.sp_ma where hsp.sp_ma = :sp_ma
										LIMIT 1');
		// $statement = $this->db->prepare('select * from hinhsanpham where hsp_ma = :hsp_ma');
		$statement->execute(['sp_ma' => $sp_ma]);

		if ($row = $statement->fetch()) {
			$this->fillProductImage($row);
			return $this;
		} 
		return null;
	}

	// Tìm các hình sản phẩm dựa vào sp_ma
	public function findProductImageByProduct($sp_ma)
	{
		$statement = $this->db->prepare('select * from `hinhsanpham` hsp join `sanpham` sp ON sp.sp_ma = hsp.sp_ma where hsp.sp_ma = :sp_ma');
		// $statement = $this->db->prepare('select * from hinhsanpham where hsp_ma = :hsp_ma');
		$statement->execute(['sp_ma' => $sp_ma]);

		if ($row = $statement->fetch()) {
			$this->fillProductImage($row);
			return $this;
		} 
		return null;
	}

	public function findFirstImage($sp_ma)
	{
		$statement = $this->db->prepare('SELECT hsp_ma, hsp_tentaptin, sp_ma, hsp_thoigiantao, hsp_thoigiancapnhat, MIN (hsp_tentaptin) 
										FROM hinhsanpham 
										WHERE sp_ma = :sp_ma 
										LIMIT 1');
		$statement->execute(['sp_ma' => $sp_ma]);

		if ($row = $statement->fetch()) {
			$this->fillFromDBFind($row);
			return $this;
		} 
		return null;
	} 


}
