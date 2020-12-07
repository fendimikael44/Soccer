<?php

class promo{
	public function action($action){
		if($action == null){
			$this->view();
		}
		elseif($action == "detail"){
			$this->detail($_GET['id']);
		}
		else{
			$this->$action();
		}
	}
		
	private function view(){
		$conn = new connection(); 
		ob_start(); 

		$query = "SELECT *, DATE_FORMAT(tanggal_created, '%d') tgl, DATE_FORMAT(tanggal_created, '%m/%Y') tgl1 FROM t_promo WHERE status = 1 ORDER BY id_promo DESC";
		$promo = $conn->getRows($query);
		$promo_row = ceil(count($promo) / 3);
		
		ob_get_contents();
		ob_end_clean();
		
		include('pages/promo.php');
	}
	
	private function detail($id){
		$conn = new connection(); 
		ob_start();
		
		$query = "SELECT * FROM t_promo WHERE status = 1 AND id_promo = ".$id;
		$promo = $conn->getRow($query);
		
		ob_get_contents();
		ob_end_clean();
		
		include('pages/promo_detail.php');
	}
}
?>