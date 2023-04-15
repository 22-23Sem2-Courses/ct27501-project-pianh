<?php

namespace DientuCT\Project;

class RegisterUser
{
	private $db;

	public $kh_tendangnhap;
	public $kh_matkhau;
	public $kh_nhaplaimatkhau;
	public $kh_ten;
	
	public $kh_dienthoai;
	public $kh_email;
	public $kh_thoigiantao;
	public $kh_thoigiancapnhat;

	private $errors = [];



	public function __construct($pdo)
	{
		$this->db = $pdo;
	}

	public function fill(array $data)
	{
		if (isset($data['kh_tendangnhap'])) {
			$this->kh_tendangnhap = trim($data['kh_tendangnhap']);
		}
        

		if (isset($data['kh_ten'])) {
			$this->kh_ten = trim($data['kh_ten']);
		}

		if (isset($data['kh_matkhau'])) {
			$this->kh_matkhau = (trim($data['kh_matkhau']));
		}

		if (isset($data['kh_dienthoai'])) {
			$this->kh_dienthoai = preg_replace('/\D+/', '', $data['kh_dienthoai']);
		}

		if (isset($data['kh_email'])) {
			$this->kh_email = trim($data['kh_email']);
		}

		return $this;
	}

	public function validatePassword(array $data)
	{
	
		
		if ( ($data['kh_matkhau'])  != ($data['kh_nhaplaimatkhau']) )  {
			$this->errors['kh_nhaplaimatkhau'] = 'Mật khẩu không trùng khớp.';
		}

		return empty($this->errors);
	}

	public function getValidationErrors()
	{
		return $this->errors;
	}

	public function validate()
	{
		if ( (!$this->kh_tendangnhap) || (strlen($this->kh_tendangnhap) >50)  ) {
			$this->errors['kh_tendangnhap'] = 'Tên đăng nhập không hợp lệ.';
		}

		if ( (!$this->kh_matkhau) || (strlen($this->kh_matkhau) >255) ) {
			$this->errors['kh_matkhau'] = 'Mật khẩu không hợp lệ.';
		}

		if ( (strlen($this->kh_matkhau) < 6) ) {
			$this->errors['kh_matkhau'] = 'Mật khẩu phải trên 6 ký tự.';
		}

		// if ( (strlen($this->kh_nhaplaimatkhau) < 6) ) {
		// 	$this->errors['kh_nhaplaimatkhau'] = 'Mật khẩu không trùng khớp.';
		// }

		if  ( (!$this->kh_email) || (strlen($this->kh_email) >100) ) {
			$this->errors['kh_email'] = 'Email không hợp lệ.';
		}

		if ( (!$this->kh_ten) || (strlen($this->kh_ten) >100) ) {
			$this->errors['kh_ten'] = 'Tên không hợp lệ.';
		}

		if (strlen($this->kh_dienthoai) < 10 || strlen($this->kh_dienthoai) > 12) {
			$this->errors['kh_dienthoai'] = 'Số điện thoại không hợp lệ.';
		}

		return empty($this->errors);
	}




	public function insertCustomerUser()
	{
		$result = false;
		
		$statement = $this->db->prepare(
			'insert into khachhang (kh_tendangnhap, kh_matkhau, kh_ten, kh_dienthoai, kh_email, 
									kh_thoigiantao, kh_thoigiancapnhat)
			values (:kh_tendangnhap, :kh_matkhau, :kh_ten, :kh_dienthoai, :kh_email,
					now(), now())'
		);
			
		$result = $statement->execute([
			'kh_tendangnhap' => $this->kh_tendangnhap,
			'kh_matkhau' => sha1($this->kh_matkhau),
			'kh_ten' => $this->kh_ten,
			'kh_dienthoai' => $this->kh_dienthoai,
			'kh_email' => $this->kh_email
		]);
		
			
		return $result;
	}

	public function checkRegister($kh_tendangnhap)
	{
		$result = false;
		$statement = $this->db->prepare('SELECT * FROM khachhang WHERE (kh_tendangnhap = :kh_tendangnhap) LIMIT 1');
		$statement->execute([
            'kh_tendangnhap' => $kh_tendangnhap,
        ]);

		if ($row = $statement->fetch()) {
			$this->fillFromCheckRegister($row);
			$result = true;
			return $result;
		} 
		return $result;
	} 

	protected function fillFromCheckRegister(array $row)
	{
		[
			'kh_tendangnhap' => $this->kh_tendangnhap,
		] = $row;
		return $this;
	}


}
