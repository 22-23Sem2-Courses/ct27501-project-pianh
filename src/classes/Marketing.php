<?php

namespace DientuCT\Project;

class Marketing
{
	private $db;

	public $mkt_ma = -1;
	public $sp_ten; //marketing join sanpham
	public $mkt_tinhtrang;
	public $mkt_bosanpham;
	public $mkt_baohanh;
	public $mkt_hieunang;
	public $mkt_hienthi;
	public $mkt_trainghiem;	
	public $mkt_tinhnang;
	public $mkt_dungluong;
	public $mkt_diennang;
	public $mkt_quatang;
	public $sp_ma;
	public $mkt_thoigiantao;
	public $mkt_thoigiancapnhat;
	private $errors = [];

	public function getMkt_ma()
	{
		return $this->mkt_ma;
	}

	public function __construct($pdo)
	{
		$this->db = $pdo;
	}

	public function fill(array $data)
	{

		if (isset($data['mkt_tinhtrang'])) {
			$this->mkt_tinhtrang = trim($data['mkt_tinhtrang']);
		}

		if (isset($data['mkt_bosanpham'])) {
			$this->mkt_bosanpham = trim($data['mkt_bosanpham']);
		}
		
		if (isset($data['mkt_baohanh'])) {
			$this->mkt_baohanh = trim($data['mkt_baohanh']);
		}

		if (isset($data['mkt_hieunang'])) {
			$this->mkt_hieunang = trim($data['mkt_hieunang']);
		}

		if (isset($data['mkt_hienthi'])) {
			$this->mkt_hienthi = trim($data['mkt_hienthi']);
		}

		if (isset($data['mkt_trainghiem'])) {
			$this->mkt_trainghiem = trim($data['mkt_trainghiem']);
		}

		if (isset($data['mkt_tinhnang'])) {
			$this->mkt_tinhnang = trim($data['mkt_tinhnang']);
		}

		if (isset($data['mkt_dungluong'])) {
			$this->mkt_dungluong = trim($data['mkt_dungluong']);
		}
		
		if (isset($data['mkt_diennang'])) {
			$this->mkt_diennang = trim($data['mkt_diennang']);
		}

		if (isset($data['mkt_quatang'])) {
			$this->mkt_quatang = trim($data['mkt_quatang']);
		}

		if (isset($data['sp_ma'])) {
			$this->sp_ma = trim($data['sp_ma']);
		}

		return $this;
	}

	public function getValidationErrors()
	{
		return $this->errors;
	}

	public function validate()
	{
		
		if (strlen($this->mkt_tinhtrang) > 255) {
			$this->errors['mkt_tinhtrang'] = 'Ghi chú tình trạng có tối đa 255 ký tự.';
		}

		if (strlen($this->mkt_bosanpham) > 255) {
			$this->errors['mkt_bosanpham'] = 'Ghi chú bộ sản phẩm có tối đa 255 ký tự.';
		}

		if (strlen($this->mkt_baohanh) > 255) {
			$this->errors['mkt_baohanh'] = 'Ghi chú bảo hành có tối đa 255 ký tự.';
		}

		if (strlen($this->mkt_hieunang) > 255) {
			$this->errors['mkt_hieunang'] = 'Ghi chú hiệu năng có tối đa 255 ký tự.';
		}

		if (strlen($this->mkt_hienthi) > 255) {
			$this->errors['mkt_hienthi'] = 'Ghi chú hiển thị có tối đa 255 ký tự.';
		}

		if (strlen($this->mkt_trainghiem) > 255) {
			$this->errors['mkt_trainghiem'] = 'Ghi chú trải nghiệm có tối đa 255 ký tự.';
		}

		if (strlen($this->mkt_tinhnang) > 255) {
			$this->errors['mkt_tinhnang'] = 'Ghi chú tính năng có tối đa 255 ký tự.';
		}

		if (strlen($this->mkt_dungluong) > 255) {
			$this->errors['mkt_dungluong'] = 'Ghi chú dung lượng có tối đa 255 ký tự.';
		}

		if (strlen($this->mkt_diennang) > 255) {
			$this->errors['mkt_diennang'] = 'Ghi chú điện năng có tối đa 255 ký tự.';
		}

		if (strlen($this->mkt_quatang) > 255) {
			$this->errors['mkt_quatang'] = 'Ghi chú quà tặng có tối đa 255 ký tự.';
		}

		if ( (!$this->sp_ma) || ($this->sp_ma == "") ) {
			$this->errors['sp_ma'] = 'Sản phẩm không hợp lệ.';
		}


		return empty($this->errors);
	}
	public function all()
	{
		$marketings = [];
		
		$statement = $this->db->prepare('SELECT * FROM marketing mkt 
												INNER JOIN sanpham sp ON sp.sp_ma = mkt.sp_ma 
												GROUP BY mkt_ma ORDER BY mkt_ma ASC');
		$statement->execute();
		while ($row = $statement->fetch()) {
			$marketing = new Marketing($this->db);
			$marketing->fillFromDB($row);
			$marketings[] = $marketing;
		}
	
		return $marketings;
	}



	protected function fillFromDB(array $row)
	{
		[
			'sp_ten' => $this->sp_ten,
			'mkt_ma' => $this->mkt_ma,
			'mkt_tinhtrang' => $this->mkt_tinhtrang,
			'mkt_bosanpham' => $this->mkt_bosanpham,
			'mkt_baohanh' => $this->mkt_baohanh,
			'mkt_hieunang' => $this->mkt_hieunang,
			'mkt_hienthi' => $this->mkt_hienthi,
			'mkt_trainghiem' => $this->mkt_trainghiem,
			'mkt_tinhnang' => $this->mkt_tinhnang,
			'mkt_dungluong' => $this->mkt_dungluong,
			'mkt_diennang' => $this->mkt_diennang,
			'mkt_quatang' => $this->mkt_quatang,
			'sp_ma' => $this->sp_ma,
			'mkt_thoigiantao' => $this->mkt_thoigiantao,
			'mkt_thoigiancapnhat' => $this->mkt_thoigiancapnhat
		] = $row;
		return $this;
	}

	public function save()
	{
		$result = false;
		
		if (( $this->mkt_ma >= 0) ) {
			$statement = $this->db->prepare(
				//Thêm mới thông tin marketing cho sản phẩm
				'update marketing set mkt_tinhtrang = :mkt_tinhtrang, mkt_bosanpham = :mkt_bosanpham, mkt_baohanh = :mkt_baohanh, mkt_hieunang = :mkt_hieunang,
					mkt_hienthi = :mkt_hienthi, mkt_trainghiem = :mkt_trainghiem, mkt_tinhnang = :mkt_tinhnang, 
					mkt_dungluong = :mkt_dungluong, mkt_diennang = :mkt_diennang, mkt_quatang = :mkt_quatang, sp_ma = :sp_ma, 
					mkt_thoigiancapnhat = now()
					where mkt_ma = :mkt_ma'
			);
			$result = $statement->execute([
				'mkt_tinhtrang' => $this->mkt_tinhtrang,
				'mkt_bosanpham' => $this->mkt_bosanpham,
				'mkt_baohanh' => $this->mkt_baohanh,
				'mkt_hieunang' => $this->mkt_hieunang,
				'mkt_hienthi' => $this->mkt_hienthi,
				'mkt_trainghiem' => $this->mkt_trainghiem,
				'mkt_tinhnang' => $this->mkt_tinhnang,
				'mkt_dungluong' => $this->mkt_dungluong,
				'mkt_diennang' => $this->mkt_diennang,
				'mkt_quatang' => $this->mkt_quatang,
				'sp_ma' => $this->sp_ma,
				'mkt_ma' => $this->mkt_ma]);
		} else  {
			//Chưa có thông tin Marketing cho sản phẩm thì thêm mới
			$statement = $this->db->prepare(
				'insert into marketing (mkt_tinhtrang, mkt_bosanpham, mkt_baohanh, mkt_hieunang, mkt_hienthi, mkt_trainghiem, mkt_tinhnang, 
							mkt_dungluong, mkt_diennang, mkt_quatang, sp_ma, mkt_thoigiantao, mkt_thoigiancapnhat)
					values (:mkt_tinhtrang, :mkt_bosanpham, :mkt_baohanh, :mkt_hieunang, :mkt_hienthi, :mkt_trainghiem, :mkt_tinhnang, 
							:mkt_dungluong, :mkt_diennang, :mkt_quatang, :sp_ma, now(), now())'
			);
			 
			$result = $statement->execute([
				'mkt_tinhtrang' => $this->mkt_tinhtrang,
				'mkt_bosanpham' => $this->mkt_bosanpham,
				'mkt_baohanh' => $this->mkt_baohanh,
				'mkt_hieunang' => $this->mkt_hieunang,
				'mkt_hienthi' => $this->mkt_hienthi,
				'mkt_trainghiem' => $this->mkt_trainghiem,
				'mkt_tinhnang' => $this->mkt_tinhnang,
				'mkt_dungluong' => $this->mkt_dungluong,
				'mkt_diennang' => $this->mkt_diennang,
				'mkt_quatang' => $this->mkt_quatang,
				'sp_ma' => $this->sp_ma
			]);
			if ($result) {
				$this->mkt_ma = $this->db->lastInsertId();
			}
			
		}

		
		return $result;
	}

	
	public function find($mkt_ma)
	{
		$statement = $this->db->prepare('select * from marketing mkt join `sanpham` sp ON sp.sp_ma = mkt.sp_ma where mkt_ma = :mkt_ma');
		$statement->execute(['mkt_ma' => $mkt_ma]);

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
		$statement = $this->db->prepare('delete from marketing where mkt_ma = :mkt_ma');
		return $statement->execute(['mkt_ma' => $this->mkt_ma]);
	}



	public function findProductMarketing($sp_ma)
	{
		$statement = $this->db->prepare('select * from marketing mkt join `sanpham` sp ON sp.sp_ma = mkt.sp_ma where mkt.sp_ma = :sp_ma');
		$statement->execute(['sp_ma' => $sp_ma]);

		if ($row = $statement->fetch()) {
			$this->fillFromDB($row);
			return $this;
		} 
		return null;
	}
	
	
	

	

}
