<?php


namespace DientuCT\Project;

class ImageStatistics 
{
    private $db;
	public $tensanpham; 
	public $soluong; 
	private $errors = [];

	public function __construct($pdo)
	{
		$this->db = $pdo;
	}
	
	public function imageStatistics()
	{
		$productsimagestatistics = [];
		
		$statement = $this->db->prepare('SELECT hsp.hsp_tentaptin, sp.sp_ten AS TenSanPham, COUNT(*) AS SoLuongHinhAnh FROM sanpham sp 
                                            JOIN hinhsanpham hsp ON hsp.sp_ma=sp.sp_ma
                                            GROUP BY hsp.sp_ma');
		$statement->execute();
		while ($row = $statement->fetch()) {
			$imagestatistics = new ImageStatistics($this->db);
			$imagestatistics->fillFromDBImageStatistics($row);
			$imagesstatistics[] = $imagestatistics;
		}
		//arry PHP ->JSON
		return json_encode($imagesstatistics);;
	}

	protected function fillFromDBImageStatistics(array $row)
	{
		[
            'TenSanPham' => $this->tensanpham,
			'SoLuongHinhAnh' => $this->soluong
		] = $row;
		return $this;
	}

}

