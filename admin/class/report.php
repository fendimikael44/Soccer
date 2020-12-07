<?php

class report{
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
		
		$paging = "";
		$page=intval(isset($_GET['halaman']) ? $_GET['halaman'] : 1);
		$totalPerPage = 5;	
		$id_booking=0;
		$id_arena = $_SESSION['id_arena'];
		
		$where = "";
		$search_qs = "";
		$s_tgl_awal = "";
		$s_tgl_akhir = "";
		
		if(isset($_GET['search'])){
			$s_tgl_awal = $_GET['tgl_awal'];
			$s_tgl_akhir = $_GET['tgl_akhir'];
			$tgl_awal = $_GET['tgl_awal'];
			$tgl_akhir = $_GET['tgl_akhir'];	
			$search_qs="&search=".$_GET['search'];
			
			if($s_tgl_awal != "" || $s_tgl_akhir != ""){
				if($s_tgl_awal == ""){
					$s_tgl_awal = "0000-00-00";
				}
				
				if($s_tgl_akhir == ""){
					$s_tgl_akhir = date('Y-m-d', strtotime(date('Y-m-d'). ' + 1000 days'));
				}
				
				$where .= " AND DATE_FORMAT(a.tanggal_booking, '%Y-%m-%d') BETWEEN '".date('Y-m-d', strtotime($s_tgl_awal))."' AND '".date('Y-m-d', strtotime($s_tgl_akhir))."' ";
				
				$search_qs .= "&tgl_awal=".$tgl_awal."&tgl_akhir=".$tgl_akhir;
			}			
		}
		
		$query = "SELECT 
						a.id_booking,
						a.tanggal_create,
						COALESCE(DATE_FORMAT(a.tanggal_booking, '%d-%m-%Y'), '') tanggal_main,
						COALESCE(DATE_FORMAT(a.tanggal_booking, '%H:%i'), '') jam_main,
						COALESCE(DATE_FORMAT(DATE_ADD(a.tanggal_booking, INTERVAL ROUND((COALESCE(a.durasi, 0) / 60), 0) HOUR), '%H:%i'), '') jam_selesai,
						ROUND((COALESCE(a.durasi, 0) / 60), 0) durasi,
						a.status,
						b.id_lapangan,
						b.nama nama_lapangan,
						b.harga harga_lapangan,
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
						((c.id_arena = ".$id_arena." AND ".$id_arena." <> 0)  OR ".$id_arena." = 0) ".$where."
					ORDER BY 
						a.id_booking DESC";
						
		$data = $conn->getRowsPaging($query, $page, $totalPerPage, $paging, "?menu=booking".$search_qs);
		
		ob_get_contents();
		ob_end_clean();
		
		include('pages/report.php');
	}
}
?>