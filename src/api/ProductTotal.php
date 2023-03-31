<?php


namespace DientuCT\Project;

class ProductTotal 
{
    private $db;
	public $soluongsanpham; 
	private $errors = [];

	public function __construct($pdo)
	{
		$this->db = $pdo;
	}
	
	public function productTotal()
	{
		$productstotal = [];
		
		$statement = $this->db->prepare('SELECT count(*) AS SoLuongSanPham FROM sanpham');
		$statement->execute();
		while ($row = $statement->fetch()) {
			$producttotal = new ProductTotal($this->db);
			$producttotal->fillFromDBProductTotal($row);
			$productstotal[] = $producttotal;
		}
		//arry PHP ->JSON
		
		return json_encode($productstotal[0]);
		//echo json_encode($productstotal[0]);
		
	}

	protected function fillFromDBProductTotal(array $row)
	{
		[
			'SoLuongSanPham' => $this->soluongsanpham
		] = $row;
		return $this;
	}

}

