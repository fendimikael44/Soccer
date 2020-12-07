<?php

class booking{
	public function action($action){
		if($action == null){
			$this->view();
		}
		elseif($action == "loadData"){
			$this->loadData($_GET['id'], $_GET['tgl'], $_GET['type']);
		}
		else{
			$this->$action();
		}
	}
		
	private function view(){
		$conn = new connection(); 
		ob_start(); 
		$msg = "";
		$stat = "success";
		
		if(!isset($_SESSION['userid'])){
			header("location:index.php?menu=login");
		}
		
		if(isset($_POST['booking'])){
			echo "<pre>";
			print_r($_POST);
			echo "</pre>"; //die;
			
			$arena = $_POST['arena'];
			$lapangan = $_POST['lapangan'];
			$id_customer = $_SESSION['userid'];
			$tgl = $_POST['tgl'];
			$jam = $_POST['jam'];
			$durasi = $_POST['durasi'];
			
			if($arena == 0 || $lapangan == 0 || $durasi == 0){
				$msg = "Data belum lengkap !";
				$stat = "danger";
			}
			
			if($msg == ""){
				$tanggal_booking = date('Y-m-d H:i:s', strtotime($tgl." ".$jam.":00"));
				$durasi = $durasi * 60;
				$query = "INSERT INTO t_booking (tanggal_create, id_lapangan, id_customer, tanggal_booking, durasi)
							VALUES(NOW(), ".$lapangan.", ".$id_customer.", '".$tanggal_booking."', ".$durasi.")";
							
				//echo $query; die;			
				if($conn->executeQuery($query)){
					$msg = "Booking lapangan berhasil dilakukan";
				}
			}
		}
		
		$q_arena = "SELECT id_arena, nama, LEFT(jam_operational, 5) jam_buka, RIGHT(jam_operational, 5) jam_tutup FROM t_arena_futsal WHERE status = 1";
		$d_arena = $conn->getRows($q_arena);
		
		$q_lapangan = "SELECT * FROM t_lapangan WHERE status = 1 AND id_arena = ".$id_arena;
		$d_lapangan = $conn->getRows($q_lapangan);
		
		ob_get_contents();
		ob_end_clean();
		
		include("pages/booking.php");
	}
	
	private function history(){
		$conn = new connection();
		ob_start(); 
		$msg = "";
		$alert = "success";
		$foto = "";
		
		$root = "";
		$folder = "images/pembayaran/";
		$target_dir = $root.$folder;
		
		if(!isset($_SESSION['userid'])){
			header("location:index.php?menu=login");
		}
		
		$paging = "";
		$page=intval(isset($_GET['halaman']) ? $_GET['halaman'] : 1);
		$totalPerPage = 5;
		$id_customer = $_SESSION['userid'];
		
		if(isset($_POST['payment'])){
			//print_r($_FILES["foto"]["tmp_name"]); die;
			$id_booking = $_POST['id_booking'];
			$norek = $_POST['norek'];
			$atasnama = $_POST['id_booking'];
			$namabank = $_POST['namabank'];
			
			$target_file = $target_dir."pembayaran_".$id_booking.".jpg";
			$foto = $folder."pembayaran_".$id_booking.".jpg";
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			
			// Check if image file is a actual image or fake image
			$check = getimagesize($_FILES["foto"]["tmp_name"]);

			if($check == false) {
				$msg = "File yang di masukan bukan foto";
				$alert="danger";
			}
			
			// Check file size
			if ($_FILES["foto"]["size"] > 5000000) {
				$msg = "Ukuran foto terlalu besar";
				$alert="danger";
			}
			
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "jpeg") {
				$msg = "File harus JPG atau JPEG";
				$alert="danger";
			}		
			if($msg == ""){
				if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
					$foto = $target_file;
					$query = "INSERT INTO t_pembayaran (id_booking,tanggal_bayar,atas_nama,bank,no_rek,foto_upload,status)
										VALUES('".$id_booking."',NOW(),".$atasnama.",'".$namabank."','".$norek."','".$foto."',0)";
					if($conn->executeQuery($query)){
						$msg = "Konfirmasi pembayaran berhasil dilakukan";	
					}				
					else {
						$msg = "Konfirmasi pembayaran gagal dilakukan";
						$alert="danger";
					}
				}	
			}
			
			
									
										
		}
		
		$query = "SELECT 
						a.id_booking,
						a.tanggal_create,
						a.tanggal_booking,
						a.durasi,
						a.status status_booking,
						b.id_lapangan,
						b.nama nama_lapangan,
						b.harga,
						b.foto,
						b.deskripsi,
						b.status status_lapangan,
						c.id_arena, 
						c.nama nama_arena,
						c.alamat, 
						c.telp,
						c.id_owner,
						c.jam_operational, 
						c.info,
						c.status status_arena,
						d.nama nama_owner,
						COALESCE(e.id_pembayaran, '') status_pembayaran,
						((b.harga * (a.durasi / 60)) * 30) / 100 minimal_dp
					FROM 
						t_booking a
						INNER JOIN t_lapangan b
							ON b.id_lapangan = a.id_lapangan
						INNER JOIN t_arena_futsal c
							ON c.id_arena = b.id_arena
						INNER JOIN t_user d
							ON d.id_user = c.id_owner
						LEFT JOIN t_pembayaran e	
							ON e.id_booking = a.id_booking
					WHERE 
						a.id_customer = ".$id_customer;
		//$data = $conn->getRows($query);
		$data = $conn->getRowsPaging($query, $page, $totalPerPage, $paging, "?menu=booking&action=history");
		ob_get_contents();
		ob_end_clean();
		
		include("pages/history.php");
	}
	
	private function loadData($id, $tgl, $type){
		$conn = new connection();
		$_GET['raw'] = 1;
		$arr = array();
		$result = "";
		
		if($type == "1"){
			$result = '<option value="0">.: Select :.</option>';
			$query = "SELECT * FROM t_lapangan WHERE status = 1 AND id_arena = ".$id;
			$data = $conn->getRows($query);
			
			for($i=0;$i<count($data);$i++){ 
				$result .= '<option value="'.$data[$i]['id_lapangan'].'">'.$data[$i]['nama'].'</option>';
			} 
		}
		elseif($type == "2"){
			if($id != "0" && $tgl != ""){
				$query = "SELECT 
								b.id_lapangan, 
								a.id_arena, 
								LEFT(a.jam_operational, 5) jam_buka, 
								RIGHT(a.jam_operational, 5) jam_tutup,
								'".$tgl."' tgl_book,
								COALESCE(DATE_FORMAT(c.tanggal_booking, '%H:%i'), '') jam_main,
								COALESCE(c.durasi, '') durasi,
								COALESCE(DATE_FORMAT(DATE_ADD(c.tanggal_booking, INTERVAL durasi MINUTE), '%H:%i'), '') jam_selesai
							FROM 
								t_arena_futsal a 
								INNER JOIN t_lapangan b
									ON b.id_arena = a.id_arena 
								LEFT JOIN t_booking c
									ON c.id_lapangan = b.id_lapangan
									AND DATE_FORMAT(c.tanggal_booking, '%d-%m-%Y') = '".$tgl."'
									AND c.status = 0
							WHERE 
								b.status = 1 
								AND b.id_lapangan = ".$id;
									
				$data = $conn->getRows($query);
				
				for($i=0;$i<count($data);$i++){
					if($data[$i]['jam_main'] != ""){
						$arr[$i]['jam_main'] = $data[$i]['jam_main'];
						$arr[$i]['durasi'] = $data[$i]['durasi'];
						$arr[$i]['jam_selesai'] = $data[$i]['jam_selesai'];
					}
					
					$jam_buka = $data[$i]['jam_buka'];
					$jam_tutup = $data[$i]['jam_tutup'];
				}
				$result = json_encode($data);
			}
			 
		}
		echo $result;
	}
}
?>