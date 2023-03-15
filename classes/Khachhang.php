<?php

namespace DientuCT\Project;

class Khachhang
{
	private $db;

	public $kh_tendangnhap="";
	public $kh_matkhau;
	public $kh_ten;
	public $kh_gioitinh;
	public $kh_diachi;
	public $kh_dienthoai;
	public $kh_email;
	public $kh_ngaysinh;
	public $kh_thangsinh;
	public $kh_namsinh;
	public $kh_cmnd;
	public $kh_makichhoat;
	public $kh_trangthai;
	public $kh_quantri;
	public $kh_quanly;
	public $kh_thoigiantao;
	public $kh_thoigiancapnhat;
	private $errors = [];

	public function getKh_tendangnhap()
	{
		return $this->kh_tendangnhap;
	}

	public function __construct($pdo)
	{
		$this->db = $pdo;
	}

	public function fill(array $data)
	{
		if (isset($data['kh_tendangnhap'])) {
			$this->kh_tendangnhap = trim($data['kh_tendangnhap']);
		}
        if (isset($data['kh_matkhau'])) {
			$this->kh_matkhau = trim($data['kh_matkhau']);
		}

		if (isset($data['kh_ten'])) {
			$this->kh_ten = trim($data['kh_ten']);
		}
		
		if (isset($data['kh_gioitinh'])) {
			$this->kh_gioitinh = trim($data['kh_gioitinh']);
		}

		if (isset($data['kh_diachi'])) {
			$this->kh_diachi = trim($data['kh_diachi']);
		}

		if (isset($data['kh_dienthoai'])) {
			$this->kh_dienthoai = preg_replace('/\D+/', '', $data['kh_dienthoai']);
		}

		if (isset($data['kh_email'])) {
			$this->kh_email = trim($data['kh_email']);
		}

		if (isset($data['kh_cmnd'])) {
			$this->kh_cmnd = trim($data['kh_cmnd']);
		}

		if (isset($data['kh_ngaysinh'])) {
			$this->kh_ngaysinh = trim($data['kh_ngaysinh']);
		}

		if (isset($data['kh_thangsinh'])) {
			$this->kh_thangsinh = trim($data['kh_thangsinh']);
		}

		if (isset($data['kh_namsinh'])) {
			$this->kh_namsinh = trim($data['kh_namsinh']);
		}

		if (isset($data['kh_trangthai'])) {
			$this->kh_trangthai = trim($data['kh_trangthai']);
		}

        if (isset($data['kh_quanly'])) {
			$this->kh_quanly = trim($data['kh_quanly']);
		}

		return $this;
	}

	public function getValidationErrors()
	{
		return $this->errors;
	}

	public function validate()
	{
		if (!$this->kh_tendangnhap) {
			$this->errors['kh_tendangnhap'] = 'Tên đăng nhập không hợp lệ.';
		}

		if (!$this->kh_ten) {
			$this->errors['kh_ten'] = 'Tên không hợp lệ.';
		}

        if ( (($this->kh_gioitinh) != 0) && (($this->kh_gioitinh) != 1) ) {
			$this->errors['kh_gioitinh'] = 'Trạng thái không hợp lệ.';
		}

		if (strlen($this->kh_dienthoai) < 10 || strlen($this->kh_dienthoai) > 12) {
			$this->errors['kh_dienthoai'] = 'Số điện thoại không hợp lệ.';
		}

		if ( (strlen($this->kh_cmnd) > 12) || (strlen($this->kh_cmnd) < 9)  ) {
			$this->errors['kh_cmnd'] = 'Chứng minh nhân dân không hợp lệ.';
		}

		// if ( (($this->kh_quantri) != 0) &&  (($this->kh_quantri) != 1) ) {
		// 	$this->errors['kh_quantri'] = 'Quản trị không hợp lệ.';
		// }

        if ( (($this->kh_trangthai) != 0) &&  (($this->kh_trangthai) != 1) ) {
			$this->errors['kh_trangthai'] = 'Trạng thái không hợp lệ.';
		}

        if ( (($this->kh_quanly) != 0) &&  (($this->kh_quanly) != 1) ) {
            $this->errors['kh_quanly'] = 'Quản trị không hợp lệ.';
        }

		return empty($this->errors);
	}

	public function all()
	{
		$dataKhachhang = [];
		
		$statement = $this->db->prepare('select * from khachhang');
		$statement->execute();
		while ($row = $statement->fetch()) {
			$khachhang = new Khachhang($this->db);
			$khachhang->fillFromDB($row);
			$dataKhachhang[] = $khachhang;
		}
	
		return $dataKhachhang;
	}

	

	protected function fillFromDB(array $row)
	{
		[
			'kh_tendangnhap' => $this->kh_tendangnhap,
			'kh_matkhau' => $this->kh_matkhau,
			'kh_ten' => $this->kh_ten,
			'kh_gioitinh' => $this->kh_gioitinh,
			'kh_diachi' => $this->kh_diachi,
			'kh_dienthoai' => $this->kh_dienthoai,
			'kh_email' => $this->kh_email,
			'kh_ngaysinh' => $this->kh_ngaysinh,
			'kh_thangsinh' => $this->kh_thangsinh,
			'kh_namsinh' => $this->kh_namsinh,
			'kh_cmnd' => $this->kh_cmnd,
			'kh_trangthai' => $this->kh_trangthai,
			'kh_quantri' => $this->kh_quantri,
			'kh_quanly' => $this->kh_quanly,
			'kh_thoigiantao' => $this->kh_thoigiantao,
			'kh_thoigiancapnhat' => $this->kh_thoigiancapnhat
		] = $row;
		return $this;
	}

	public function save()
	{
		$result = false;
		
		if ( ($this->kh_tendangnhap) == "" ) {
			$statement = $this->db->prepare(
				'update khachhang set kh_matkhau = :kh_matkhau, kh_ten = :kh_ten, kh_gioitinh = :kh_gioitinh, kh_diachi = :kh_diachi,
                    kh_dienthoai = :kh_dienthoai, kh_email = :kh_email, kh_cmnd = :kh_cmnd, 
					kh_ngaysinh = :kh_ngaysinh, kh_thangsinh = :kh_thangsinh, kh_namsinh = :kh_namsinh,
					kh_trangthai = :kh_trangthai, kh_quanly = :kh_quanly,
                    kh_thoigiancapnhat = now()
				where kh_tendangnhap = :kh_tendangnhap'
			);
			$result = $statement->execute([
				'kh_matkhau' => $this->kh_matkhau,
				'kh_ten' => $this->kh_ten,
				'kh_gioitinh' => $this->kh_gioitinh,
				'kh_diachi' => $this->kh_diachi,
				'kh_dienthoai' => $this->kh_dienthoai,
				'kh_email' => $this->kh_email,
				'kh_cmnd' => $this->kh_cmnd,
				'kh_ngaysinh' => $this->kh_ngaysinh,
				'kh_thangsinh' => $this->kh_thangsinh,
				'kh_namsinh' => $this->kh_namsinh,
				'kh_trangthai' => $this->kh_trangthai,
				'kh_quanly' => $this->kh_quanly,
				'kh_tendangnhap' => $this->kh_tendangnhap
            ]);
		} else {
			$statement = $this->db->prepare(
				'insert into khachhang (kh_tendangnhap, kh_matkhau, kh_ten, kh_gioitinh, kh_diachi, kh_dienthoai, kh_email, kh_cmnd, 
                                        kh_ngaysinh, kh_thangsinh, kh_namsinh, kh_trangthai, kh_quanly, kh_thoigiantao, kh_thoigiancapnhat)
				values (:kh_tendangnhap, :kh_matkhau, :kh_ten, :kh_gioitinh, :kh_diachi, :kh_dienthoai, :kh_email, :kh_cmnd, 
					    :kh_ngaysinh, :kh_thangsinh, :kh_namsinh, :kh_trangthai, :kh_quanly, now(), now())'
			);
			 
			$result = $statement->execute([
				'kh_tendangnhap' => $this->kh_tendangnhap,
				'kh_matkhau' => $this->kh_matkhau,
				'kh_ten' => $this->kh_ten,
				'kh_gioitinh' => $this->kh_gioitinh,
				'kh_diachi' => $this->kh_diachi,
				'kh_dienthoai' => $this->kh_dienthoai,
				'kh_email' => $this->kh_email,
				'kh_cmnd' => $this->kh_cmnd,
				'kh_ngaysinh' => $this->kh_ngaysinh,
				'kh_thangsinh' => $this->kh_thangsinh,
				'kh_namsinh' => $this->kh_namsinh,
				'kh_trangthai' => $this->kh_trangthai,
				'kh_quanly' => $this->kh_quanly
			]);
			
		} 
		return $result;
	}


	public function find($kh_tendangnhap)
	{
		$statement = $this->db->prepare('select * from khachhang where kh_tendangnhap = :kh_tendangnhap');
		$statement->execute(['kh_tendangnhap' => $kh_tendangnhap]);

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
		$statement = $this->db->prepare('delete from khachhang where kh_tendangnhap = :kh_tendangnhap');
		return $statement->execute(['kh_tendangnhap' => $this->kh_tendangnhap]);
	}
}
