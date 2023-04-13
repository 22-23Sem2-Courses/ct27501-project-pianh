<?php

namespace DientuCT\Project;

class Order
{
	private $db;

	public $dh_ma = -1;
	public $dh_ngaygiao;
	public $dh_noigiao;
	public $dh_trangthaithanhtoan;
	public $dh_ghichu;
	public $kh_tendangnhap;
	public $dh_thoigiantao;
	public $dh_thoigiancapnhat;

	public $sp_ma; //join sanpham
	public $sp_ten; //join sanpham
	public $sp_lsp; //join sanpham
	public $sp_nsx; //join sanpham
	public $sp_dh_soluong; //join sanpham_dondathang
	public $sp_dh_dongia; //join sanpham_dondathang
	public $tongthanhtien; //join sanpham_dondathang

	private $errors = [];

	public function getDh_ma()
	{
		return $this->dh_ma;
	}

	public function __construct($pdo)
	{
		$this->db = $pdo;
	}

	public function fill(array $data)
	{

		if (isset($data['dh_ngaygiao'])) {
			$this->dh_ngaygiao = trim($data['dh_ngaygiao']);
		}
		
		if (isset($data['dh_noigiao'])) {
			$this->dh_noigiao = trim($data['dh_noigiao']);
		}

		if (isset($data['dh_trangthaithanhtoan'])) {
			$this->dh_trangthaithanhtoan = trim($data['dh_trangthaithanhtoan']);
		}


		if (isset($data['dh_ghichu'])) {
			$this->dh_ghichu = trim($data['dh_ghichu']);
		}

		if (isset($data['kh_tendangnhap'])) {
			$this->kh_tendangnhap = trim($data['kh_tendangnhap']);
		}

		// if (isset($data['sp_ma'])) {
		// 	$this->arr_sp_ma = ($data['sp_ma']);
		// }

		// if (isset($data['sp_dh_soluong'])) {
		// 	$this->arr_sp_dh_soluong = ($data['sp_dh_soluong']);
		// }

		// if (isset($data['sp_dh_dongia'])) {
		// 	$this->arr_sp_dh_dongia = ($data['sp_dh_dongia']);
		// }

	
		return $this;
	}

	public function getValidationErrors()
	{
		return $this->errors;
	}

	public function validate()
	{

		if (!($this->dh_ngaygiao) ) {
			$this->errors['dh_ngaygiao'] = 'Ngày giao hàng không hợp lệ.';
		}

		if (strlen($this->dh_noigiao) > 255) {
			$this->errors['dh_noigiao'] = 'Nơi giao hàng có tối đa 255 ký tự.';
		}

        if (!($this->dh_noigiao) ) {
			$this->errors['dh_noigiao'] = 'Nơi giao hàng không hợp lệ.';
		}


		if ( (($this->dh_trangthaithanhtoan) != 0) &&  (($this->dh_trangthaithanhtoan) != 1) ) {
			$this->errors['dh_trangthaithanhtoan'] = 'Trạng thái thanh toán không hợp lệ.';
		}

		if (strlen($this->dh_ghichu) > 2550) {
			$this->errors['dh_ghichu'] = 'Ghi chú có tối đa 100 ký tự.';
		}

        if (!($this->kh_tendangnhap) ) {
			$this->errors['kh_tendangnhap'] = 'Tên đăng nhập không hợp lệ.';
		}


		return empty($this->errors);
	}
	public function all()
	{
		$orders = [];
		
		$statement = $this->db->prepare('select * from dondathang');
		$statement->execute();
		while ($row = $statement->fetch()) {
			$order = new Order($this->db);
			$order->fillFromDB($row);
			$orders[] = $order;
		}
	
		return $orders;
	}

	protected function fillFromDB(array $row)
	{
		[
			'dh_ma' => $this->dh_ma,
			'dh_ngaygiao' => $this->dh_ngaygiao,
			'dh_noigiao' => $this->dh_noigiao,
			'dh_ghichu' => $this->dh_ghichu,
			'dh_trangthaithanhtoan' => $this->dh_trangthaithanhtoan,
			'kh_tendangnhap' => $this->kh_tendangnhap,
			'dh_thoigiantao' => $this->dh_thoigiantao,
			'dh_thoigiancapnhat' => $this->dh_thoigiancapnhat
		] = $row;
		return $this;
	}

	public function viewOrders()
	{
		$orders = [];
		
		$statement = $this->db->prepare('select * from viewdondathang');
		$statement->execute();
		while ($row = $statement->fetch()) {
			$order = new Order($this->db);
			$order->fillFromDBViewOrders($row);
			$orders[] = $order;
		}
	
		return $orders ;
	}

	protected function fillFromDBViewOrders(array $row)
	{
		[
			'dh_ma' => $this->dh_ma,
			'dh_thoigiantao' => $this->dh_thoigiantao,
			'kh_tendangnhap' => $this->kh_tendangnhap,
		] = $row;
		return $this;
	}



	public function save()
	{
		$result = false;
		
		if ($this->dh_ma >= 0) {
			$statement = $this->db->prepare(
				'update dondathang set dh_ngaygiao = :dh_ngaygiao, dh_noigiao = :dh_noigiao, dh_trangthaithanhtoan = :dh_trangthaithanhtoan,
					dh_ghichu = :dh_ghichu, 
					kh_tendangnhap = :kh_tendangnhap,
					dh_thoigiancapnhat = now()
					where dh_ma = :dh_ma'
			);
			$result = $statement->execute([
				'dh_ngaygiao' => $this->dh_ngaygiao,
				'dh_noigiao' => $this->dh_noigiao,
				'dh_trangthaithanhtoan' => $this->dh_trangthaithanhtoan,
				'dh_ghichu' => $this->dh_ghichu,
				'kh_tendangnhap' => $this->kh_tendangnhap,
				'dh_ma' => $this->dh_ma

				]);
		} else {
			$statement = $this->db->prepare(
				'insert into dondathang (dh_ngaygiao, dh_noigiao, dh_trangthaithanhtoan, dh_ghichu, 
					kh_tendangnhap, sp_thoigiantao, sp_thoigiancapnhat)
					values (:dh_ngaygiao, :dh_noigiao, :dh_trangthaithanhtoan, :dh_ghichu, 
						:kh_tendangnhap, now(), now())'
			);
			 
			$result = $statement->execute([
				'dh_ngaygiao' => $this->dh_ngaygiao,
				'dh_noigiao' => $this->dh_noigiao,
				'dh_trangthaithanhtoan' => $this->dh_trangthaithanhtoan,
				'dh_ghichu' => $this->dh_ghichu,
				'kh_tendangnhap' => $this->kh_tendangnhap
			]);
			if ($result) {
				$this->dh_ma = $this->db->lastInsertId();
			}
			
		} 
		return $result;
	}

	// Truy vấn dữ liệu đơn hàng
	public function find($dh_ma)
	{
		$statement = $this->db->prepare('select * from dondathang where dh_ma = :dh_ma');
		$statement->execute(['dh_ma' => $dh_ma]);

		if ($row = $statement->fetch()) {
			$this->fillFromDB($row);
			return $this;
		} 
		return null;
	} 

	// public function priceProductOrder($dh_ma)
	// {
	// 	$statement = $this->db->prepare('SELECT SUM(spddh.sp_dh_soluong * spddh.sp_dh_dongia) AS TongThanhTien  FROM dondathang dh JOIN sanpham_dondathang spddh ON dh.dh_ma = spddh.dh_ma WHERE dh.dh_ma = :dh_ma GROUP BY dh.dh_ma');
	// 	$statement->execute(['dh_ma' => $dh_ma]);

	// 	if ($row = $statement->fetch()) {
	// 		$this->fillFromDBProductOrder($row);
	// 		return $this;
	// 	} 
	// 	return null;
	// } 

	// protected function fillFromDBProductOrder(array $row)
	// {
	// 	[
	// 		'TongThanhTien' => $this->tongthanhtien
	// 	] = $row;
	// 	return $this;
	// }


	// Truy vấn dữ liệu chi tiết đơn hàng
	public function orderDetail($dh_ma)
	{
		$statement = $this->db->prepare('SELECT spddh.sp_dh_soluong AS SoLuong, spddh.sp_dh_dongia AS DonGia,
						SUM(spddh.sp_dh_soluong * spddh.sp_dh_dongia) AS TongThanhTien FROM dondathang dh 
					JOIN sanpham_dondathang spddh ON dh.dh_ma = spddh.dh_ma
					WHERE dh.dh_ma = :dh_ma 
					GROUP BY dh.dh_ma');
		$statement->execute(['dh_ma' => $dh_ma]);

		if ($row = $statement->fetch()) {
			$this->fillFromDBOrderDetail($row);
			return $this;
		} 
		return null;
	} 

	protected function fillFromDBOrderDetail(array $row)
	{
		[
			'SoLuong' => $this->sp_dh_soluong,
			'DonGia' => $this->sp_dh_dongia,
			'TongThanhTien' => $this->tongthanhtien
		] = $row;
		return $this;
	}


	public function productOrderDetail($dh_ma)
	{
		$productOrderDetails = [];
		
		$statement = $this->db->prepare('SELECT sp.sp_ma, sp.sp_ten, sp.sp_lsp, sp.sp_nsx, spddh.sp_dh_dongia, spddh.sp_dh_soluong
										FROM sanpham_dondathang spddh 
										JOIN sanpham sp ON sp.sp_ma = spddh.sp_ma
										WHERE spddh.dh_ma = :dh_ma');
		$statement->execute(['dh_ma' => $dh_ma]);
		while ($row = $statement->fetch()) {
			$productOrderDetail = new Order($this->db);
			$productOrderDetail->fillFromDBProductOrderDetail($row);
			$productOrderDetails[] = $productOrderDetail;
		}
	
		return $productOrderDetails;
	}


	protected function fillFromDBProductOrderDetail(array $row)
	{
		[
			'sp_ma' => $this->sp_ma,
			'sp_ten' => $this->sp_ten,
			'sp_lsp' => $this->sp_lsp,
			'sp_nsx' => $this->sp_nsx,
			'sp_dh_dongia' => $this->sp_dh_dongia,
			'sp_dh_soluong' => $this->sp_dh_soluong
		] = $row;
		return $this;
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
		$result = false;
		
		if ($this->dh_ma >= 0) {

			$statement = $this->db->prepare('delete from sanpham_dondathang where dh_ma = :dh_ma');
			$result = $statement->execute(['dh_ma' => $this->dh_ma]);

			$statement = $this->db->prepare('delete from dondathang where dh_ma = :dh_ma');
			$result = $statement->execute(['dh_ma' => $this->dh_ma]);
		} 
			
		return $result;
	}






}
