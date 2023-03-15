<?php

namespace DientuCT\Project;

class Khuyenmai
{
	private $db;

	public $km_ma;
	public $km_ten;
	public $km_noidung;
	public $km_tungay;
	public $km_denngay;
	//public $updated_at;
	private $errors = [];

	public function getMa()
	{
		return $this->km_ma;
	}

	public function __construct($pdo)
	{
		$this->db = $pdo;
	}

	public function fill(array $data)
	{
		if (isset($data['km_ten'])) {
			$this->km_ten = trim($data['km_ten']);
		}
        if (isset($data['km_noidung'])) {
			$this->km_ten = trim($data['km_noidung']);
		}
		

		if (isset($data['km_tungay'])) {
			$this->km_tungay = trim($data['km_tungay']);
		}

        if (isset($data['km_denngay'])) {
			$this->km_denngay = trim($data['km_denngay']);
		}

		return $this;
	}

	public function getValidationErrors()
	{
		return $this->errors;
	}

	public function validate()
	{
		if (!$this->km_ten) {
			$this->errors['km_ten'] = 'Invalid tên.';
		}

        
		// if (strlen($this->km_noidung) < 10 || strlen($this->km_noidung) > 11) {
		// 	$this->errors['phone'] = 'Invalid phone number.';
		// }

		if (strlen($this->km_noidung) > 255) {
			$this->errors['km_noidung'] = 'Nội dung must be at most 255 characters.';
		}

		return empty($this->errors);
	}
	public function all()
	{
		$data = [];
		
		$statement = $this->db->prepare('select * from khuyenmai');
		$statement->execute();
		while ($row = $statement->fetch()) {
			$khuyenmai = new Khuyenmai($this->db);
			$khuyenmai->fillFromDB($row);
			$data[] = $khuyenmai;
		}
	
		return $data;
	}

	protected function fillFromDB(array $row)
	{
		[
			'km_ma' => $this->km_ma,
			'km_ten' => $this->km_ten,
			'km_noidung' => $this->km_noidung,
			'km_tungay' => $this->km_tungay,
			'km_denngay' => $this->km_denngay
			//'created_at' => $this->created_at,
			//'updated_at' => $this->updated_at
		] = $row;
		return $this;
	}

	public function save()
	{
		$result = false;
		
		if ($this->km_ma >= 0) {
			$statement = $this->db->prepare(
				'update khuyenmai set
                    km_ten = :km_ten, km_noidung = :km_noidung, km_tungay = :km_tungay, km_denngay = :km_denngay,
					where km_ma = :km_ma'
			);
			$result = $statement->execute([
				'km_ten' => $this->km_ten,
				'km_noidung' => $this->km_noidung,
				'km_tungay' => $this->km_tungay,
				'km_denngay' => $this->km_denngay,
				'km_ma' => $this->km_ma]);
		} else {
			$statement = $this->db->prepare(
				'insert into khuyenmai (km_ten, km_noidung, km_tungay, km_denngay)
					values (:km_ten, :km_noidung, :km_tungay, :km_denngay)'
			);
			$result = $statement->execute([
				'km_ten' => $this->km_ten,
				'km_noidung' => $this->km_noidung,
				'km_tungay' => $this->km_tungay,
				'km_denngay' => $this->km_denngay
			]);
			if ($result) {
				$this->km_ma = $this->db->lastInsertMa();
			}
		} 
		return $result;
	}


	public function find($km_ma)
	{
		$statement = $this->db->prepare('select * from khuyenmai where km_ma = :km_ma');
		$statement->execute(['km_ma' => $km_ma]);

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
		$statement = $this->db->prepare('delete from khuyenmai where km_ma = :km_ma');
		return $statement->execute(['km_ma' => $this->km_ma]);
	}
}
