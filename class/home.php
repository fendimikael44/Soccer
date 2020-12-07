<?php
//include('connection.php');
		
class home{
	public function action($action){
		if($action == null){
			$this->view();
		}
		else{
			$this->$action();
		}
	}
		
	private function view(){
		$conn = new connection(); 
		ob_start(); 
		
		$query = "SELECT * FROM t_promo WHERE status = 1 ORDER BY id_promo DESC limit 4";
		$promo = $conn->getRows($query);
		
		ob_get_contents();
		ob_end_clean();
		
		include('pages/home.php');
		
	}
}
?>