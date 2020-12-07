<?php

class contact{
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

		ob_get_contents();
		ob_end_clean();
		
		include('pages/contact.php');
	}
}
?>