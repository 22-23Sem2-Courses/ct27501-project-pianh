<?php


namespace DientuCT\Project;

class ProductStatistics 
{
    private $db;
	public $tensanpham; 
	public $soluongdon; 
	private $errors = [];

	public function __construct($pdo)
	{
		$this->db = $pdo;
	}
	
	public function productStatistics()
	{
		$productstatistics = [];
		
        $statement = $this->db->prepare('SELECT sp.sp_ten AS TenSanPham, COUNT(*) AS SoLuongDon
											FROM sanpham sp
                                            JOIN dondathang ddh ON ddh.sp_ma = sp.sp_ma
                                            GROUP BY sp.sp_ma');

		$statement->execute();
		while ($row = $statement->fetch()) {
			$productstatistics = new ProductStatistics($this->db);
			$productstatistics->fillFromDBProductStatistics($row);
			$productsstatistics[] = $productstatistics;
			
		}
		//arry PHP ->JSON
		return json_encode($productsstatistics);
	}

	protected function fillFromDBProductStatistics(array $row)
	{
		[
            'TenSanPham' => $this->tensanpham,
			'SoLuongDon' => $this->soluongdon
		] = $row;
		return $this;
	}

}

