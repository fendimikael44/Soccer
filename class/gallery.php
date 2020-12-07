<?php

class gallery{
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
		$data = array();
		$query = "SELECT
							a.id_arena,
							a.info,
							a.nama nama_arena,
							a.alamat,
							a.jam_operational,
							a.telp						
						FROM
							t_arena_futsal a
						WHERE
							a.status = 1						
						ORDER BY
							a.id_arena";
		
		$rows = $conn->getRows($query);
		
		for($i=0;$i<count($rows);$i++){
			$query = "SELECT			
								id_lapangan,
								nama nama_lapangan,
								foto,
								harga,
								deskripsi							
							FROM
								t_lapangan 	
							WHERE
								status = 1
								AND id_arena = ".$rows[$i]['id_arena']."
							ORDER BY
								id_lapangan";
								
			$rows1 = $conn->getRows($query);
			$data[$i]['header'] = $rows[$i];
			$data[$i]['detail'] = $rows1;
		}
		//echo "<pre>";
		//print_r($data);
		//echo "</pre>"; die;
		ob_get_contents();
		ob_end_clean();
		
		include('pages/gallery.php');
	}
}
?>