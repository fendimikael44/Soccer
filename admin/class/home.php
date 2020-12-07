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
		
		$id_booking=0;
		$id_arena = $_SESSION['id_arena'];
		
		$query = "SELECT 
						a.id_booking,
						a.tanggal_create,
						COALESCE(DATE_FORMAT(a.tanggal_booking, '%d-%m-%Y'), '') tanggal_main,
						COALESCE(DATE_FORMAT(a.tanggal_booking, '%H:%i'), '') jam_main,
						ROUND((COALESCE(a.durasi, 0) / 60), 0) durasi,
						a.status,
						b.id_lapangan,
						b.nama nama_lapangan,
						c.id_arena,
						c.nama nama_arena,
						d.id_user,
						COALESCE(d.nama, '') nama_customer,
						COALESCE(d.telp, '') telp
					FROM 
						t_booking a
						INNER JOIN t_lapangan b
							ON b.id_lapangan = a.id_lapangan
						INNER JOIN t_arena_futsal c
							ON c.id_arena = b.id_arena
						LEFT JOIN t_user d
							ON d.id_user = a.id_customer
					WHERE 
						((c.id_arena = ".$id_arena." AND ".$id_arena." <> 0)  OR ".$id_arena." = 0)
						AND a.status = 0
					ORDER BY 
						a.tanggal_booking ASC";
						
		$data = $conn->getRows($query);
		
		ob_get_contents();
		ob_end_clean();
		
		include('pages/home.php');
		
	}
}
?>