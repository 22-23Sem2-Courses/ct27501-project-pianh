<?php

namespace DientuCT\Project;

class Sanpham
{
	private $db;

	private $sp_ma = -1;
	public $sp_ten;
	public $sp_soluong;
	public $sp_dophangiai;
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
		
		
		if (isset($data['sp_dophangiai'])) {
			$this->sp_dophangiai = trim($data['sp_dophangiai']);
		}
		
		if (isset($data['sp_hedieuhanh'])) {
			$this->sp_hedieuhanh = trim($data['sp_hedieuhanh']);
		}


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

		if (strlen($this->sp_dophangiai) > 255) {
			$this->errors['sp_dophangiai'] = 'Ghi chú độ phân giải có tối đa 255 ký tự.';
		}
		if (strlen($this->sp_hedieuhanh) > 255) {
			$this->errors['sp_hedieuhanh'] = 'Ghi chú hệ điều hành có tối đa 255 ký tự.';
		}

		return empty($this->errors);
	}
	public function all()
	{
		$dataSanpham = [];
		
		$statement = $this->db->prepare('select * from sanpham');
		$statement->execute();
		while ($row = $statement->fetch()) {
			$sanpham = new Sanpham($this->db);
			$sanpham->fillFromDB($row);
			$dataSanpham[] = $sanpham;
		}
	
		return $dataSanpham;
	}

	protected function fillFromDB(array $row)
	{
		[
			'sp_ma' => $this->sp_ma,
			'sp_ten' => $this->sp_ten,
			'sp_dophangiai' => $this->sp_dophangiai,
			'sp_hedieuhanh' => $this->sp_hedieuhanh,
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
				'update sanpham set sp_ten = :sp_ten,
					sp_dophangiai = :sp_dophangiai, sp_hedieuhanh = :sp_hedieuhanh, sp_thoigiancapnhat = now()
					where sp_ma = :sp_ma'
			);
			$result = $statement->execute([
				'sp_ten' => $this->sp_ten,
				'sp_dophangiai' => $this->sp_dophangiai,
				'sp_hedieuhanh' => $this->sp_hedieuhanh,
				'sp_ma' => $this->sp_ma]);
		} else {
			$statement = $this->db->prepare(
				'insert into sanpham (sp_ten, sp_dophangiai, sp_hedieuhanh, sp_thoigiantao, sp_thoigiancapnhat)
					values (:sp_ten, :sp_dophangiai, :sp_hedieuhanh, now(), now())'
			);
			 
			$result = $statement->execute([
				'sp_ten' => $this->sp_ten,
				'sp_dophangiai' => $this->sp_dophangiai,
				'sp_hedieuhanh' => $this->sp_hedieuhanh
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

	public function delete()
	{
		$statement = $this->db->prepare('delete from sanpham where sp_ma = :sp_ma');
		return $statement->execute(['sp_ma' => $this->sp_ma]);
	}
}
