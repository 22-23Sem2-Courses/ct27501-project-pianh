<?php


namespace DientuCT\Project;

class CustomerTotal 
{
    private $db;
	public $soluongkhachhang; 
	private $errors = [];

	public function __construct($pdo)
	{
		$this->db = $pdo;
	}
	
	public function customerTotal()
	{
		$customerstotal = [];
		
		$statement = $this->db->prepare('SELECT count(*) AS SoLuongKhachHang FROM khachhang');
		$statement->execute();
		while ($row = $statement->fetch()) {
			$customertotal = new CustomerTotal($this->db);
			$customertotal->fillFromDBCustomerTotal($row);
			$customerstotal[] = $customertotal;
		}
		//arry PHP ->JSON
		return json_encode($customerstotal[0]);;
	}

	protected function fillFromDBCustomerTotal(array $row)
	{
		[
			'SoLuongKhachHang' => $this->soluongkhachhang
		] = $row;
		return $this;
	}

}

