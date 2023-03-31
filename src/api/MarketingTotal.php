<?php


namespace DientuCT\Project;

class MarketingTotal 
{
    private $db;
	public $soluongmarketing; 
	private $errors = [];

	public function __construct($pdo)
	{
		$this->db = $pdo;
	}
	
	public function marketingTotal()
	{
		$marketingstotal = [];
		
		$statement = $this->db->prepare('SELECT count(*) AS SoLuongMarketing FROM marketing');
		$statement->execute();
		while ($row = $statement->fetch()) {
			$marketingtotal = new MarketingTotal($this->db);
			$marketingtotal->fillFromDBMarketingTotal($row);
			$marketingstotal[] = $marketingtotal;
		}
		//arry PHP ->JSON
		return json_encode($marketingstotal[0]);;
	}

	protected function fillFromDBMarketingTotal(array $row)
	{
		[
			'SoLuongMarketing' => $this->soluongmarketing
		] = $row;
		return $this;
	}

}

