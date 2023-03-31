<?php


namespace DientuCT\Project;

class OrderTotal 
{
    private $db;
	public $soluongdonhang; 
	private $errors = [];

	public function __construct($pdo)
	{
		$this->db = $pdo;
	}
	
	public function orderTotal()
	{
		$orderstotal = [];
		
		$statement = $this->db->prepare('SELECT count(*) AS SoLuongDonHang FROM dondathang');
		$statement->execute();
		while ($row = $statement->fetch()) {
			$ordertotal = new OrderTotal($this->db);
			$ordertotal->fillFromDBOrderTotal($row);
			$orderstotal[] = $ordertotal;
		}
		//arry PHP ->JSON
		return json_encode($orderstotal[0]);;
	}

	protected function fillFromDBOrderTotal(array $row)
	{
		[
			'SoLuongDonHang' => $this->soluongdonhang
		] = $row;
		return $this;
	}

}

