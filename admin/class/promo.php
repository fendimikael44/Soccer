<?php

class promo{
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
		$id_promo=0;
		$id_arena = $_SESSION['id_arena'];
		
		if(isset($_POST['posting'])){
			$id_promo = $_POST['id_promo'];
			$query = "UPDATE t_promo SET status = 1 WHERE id_promo = ".$id_promo;
			$conn->executeQuery($query);
		}
		elseif(isset($_POST['unposting'])){
			$id_promo = $_POST['id_promo'];
			$query = "UPDATE t_promo SET status = 0 WHERE id_promo = ".$id_promo;
			$conn->executeQuery($query);
		}
		
		$query = "SELECT 
						a.id_promo,
						a.id_arena,
						a.judul,
						a.deskripsi,
						DATE_FORMAT(a.tanggal_created, '%d-%m-%Y') tgl_create,
						DATE_FORMAT(a.periode_awal, '%d-%m-%Y') periode_awal,
						DATE_FORMAT(a.periode_akhir, '%d-%m-%Y') periode_akhir,
						a.diskon,
						a.status,
						b.nama nama_arena
					FROM 
						t_promo a
						INNER JOIN t_arena_futsal b
							ON b.id_arena = a.id_arena
					WHERE 
						((a.id_arena = ".$id_arena." AND ".$id_arena." <> 0)  OR ".$id_arena." = 0)
					ORDER BY 
						id_promo DESC";
					
		$data = $conn->getRowsPaging($query, $page, $totalPerPage, $paging, "?menu=promo");
		
		ob_get_contents();
		ob_end_clean();
		
		include('pages/promo.php');
	}
	
	private function detail(){
		$conn = new connection(); 
		ob_start(); 
		$msg="";
		$alert="success";
		$type="simpan";
		
		$id_promo = isset($_GET['id']) ? $_GET['id'] : 0;
		$judul = "";
		$desc = "";
		$periode_awal = "";
		$periode_akhir = "";
		$diskon = 0;
		$status = 0;
		
		if(isset($_POST['save'])){	
			$id_arena = $_SESSION['id_arena'];
			$judul = $_POST['judul'];
			$desc = $_POST['desc'];
			$periode_awal = date('Y-m-d',strtotime($_POST['periode_awal']));
			$periode_akhir = date('Y-m-d',strtotime($_POST['periode_akhir']));
			$diskon = $_POST['diskon'];
			$status = $_POST['status'];
			
			if($id_promo == 0){
				$query = "INSERT INTO t_promo (id_arena,judul,deskripsi,tanggal_created,periode_awal,periode_akhir,diskon,status)
									VALUES(".$id_arena.",'".$judul."','".$desc."',NOW(),'".$periode_awal."','".$periode_akhir."',".$diskon.",".$status.")";
			}
			else{
				$query = "UPDATE t_promo SET judul = '".$judul."', deskripsi = '".$desc."', periode_awal = '".$periode_awal."', periode_akhir = '".$periode_akhir."', diskon = ".$diskon.", status = ".$status." WHERE id_promo = ".$id_promo;
				$type = "ubah";
			}
			//echo $query; die;
			if($conn->executeQuery($query)){
				$msg = "Data Promo berhasil di ".$type;
			}
		}
		
		if($id_promo != 0){
			$query = "SELECT 
						a.id_promo,
						a.id_arena,
						a.judul,
						a.deskripsi,
						DATE_FORMAT(a.tanggal_created, '%d-%m-%Y') tgl_create,
						DATE_FORMAT(a.periode_awal, '%d-%m-%Y') periode_awal,
						DATE_FORMAT(a.periode_akhir, '%d-%m-%Y') periode_akhir,
						a.diskon,
						a.status
					FROM 
						t_promo a
					WHERE 
						id_promo = ".$id_promo;
			$row = $conn->getRow($query);
			
			$id_promo = $row['id_promo'];
			$judul = $row['judul'];
			$desc = $row['deskripsi'];
			$periode_awal = $row['periode_awal'];
			$periode_akhir = $row['periode_akhir'];
			$diskon = $row['diskon'];
			$status = $row['status'];
		}
				
		ob_get_contents();
		ob_end_clean();
		
		include('pages/promo_detail.php');
	}	
}
?>