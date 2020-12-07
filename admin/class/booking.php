<?php

class booking{
	public function action($action){
		if($action == null){
			$this->view();
		}
		elseif($action == "loadData"){
			$this->loadData($_GET['id_booking'], $_GET['id'], $_GET['tgl'], $_GET['type']);
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
		$finish_alert = "";
		$finish_message = "";
		$where = "";
		$search_qs = "";
		$s_customer = "";
		
		if(isset($_GET['search'])){
			//print_r($_GET); die;
			$s_customer = $_GET['customer'];		
			$search_qs="&search=".$_GET['search'];
			
			if($s_customer != ""){
				$where .= " AND d.nama LIKE '%".$s_customer."%'";
				$search_qs .= "&customer=".$s_customer;
			}				
		}
		
		if(isset($_POST['approve'])){
			$id_pembayaran = $_POST['id_pembayaran'];
			$query = "UPDATE t_pembayaran SET status = 1 WHERE id_pembayaran = ".$id_pembayaran;
			$conn->executeQuery($query);
			$finish_alert = "success";
			$finish_message = "Success";
		}

		if(isset($_POST['reject'])){
			$id_pembayaran = $_POST['id_pembayaran'];
			$query = "DELETE FROM t_pembayaran WHERE id_pembayaran = ".$id_pembayaran;
			$conn->executeQuery($query);
			$finish_alert = "success";
			$finish_message = "Success";
		}

		if(isset($_POST['finish'])){
			$id_booking = $_POST['id_booking'];
			$query = "SELECT * FROM t_booking where id_booking = ".$id_booking." 
					AND ((
						DATE_FORMAT(tanggal_booking, '%Y-%m-%d') = DATE_FORMAT(NOW(), '%Y-%m-%d') 
						AND 
						COALESCE(DATE_FORMAT(DATE_ADD(tanggal_booking, INTERVAL durasi MINUTE), '%H:%i'), '') <= DATE_FORMAT(NOW(), '%H:%i')
					)
					OR 
					DATE_FORMAT(tanggal_booking, '%Y-%m-%d') < DATE_FORMAT(NOW(), '%Y-%m-%d') )
					";
					//echo $query; die;
			$data_booking = $conn->getRow($query);
			
			if(count($data_booking) > 0){
				$query = "UPDATE t_booking SET status = 1 WHERE id_booking = ".$id_booking;
				$conn->executeQuery($query);
				$finish_alert = "success";
				$finish_message = "Success";
			}
			else{
				//header("Location:index.php?menu=booking&finish=failed");		
				$finish_alert = "danger";
				$finish_message = "Jam main belum selesai";
			}
		}
		elseif(isset($_POST['cancel'])){
			$id_booking = $_POST['id_booking'];
			$query = "SELECT * FROM t_pembayaran WHERE id_booking = ".$id_booking." AND STATUS = 1";
			$row = $conn->getRow($query);
			if($row['id_booking'] == $id_booking){
				$finish_alert = "danger";
				$finish_message = "Booking tidak dapat dibatalkan";
			}
			else{
				$query = "SELECT TIMESTAMPDIFF(MINUTE, NOW(), tanggal_booking) cek FROM t_booking WHERE id_booking = 6";
				$row = $conn->getRow($query);

				if($row['cek'] <= 30){
					$query = "UPDATE t_booking SET status = 3 WHERE id_booking = ".$id_booking;
					$conn->executeQuery($query);
					$finish_alert = "success";
					$finish_message = "Booking sudah dibatalkan";
				}
				else{
					$finish_alert = "danger";
					$finish_message = "Booking tidak dapat dibatalkan";
				}
			}
			
		}
		
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
						COALESCE(d.telp, '') telp,
						e.id_pembayaran,
						COALESCE(e.status, '') status_pembayaran,
						DATE_FORMAT(e.tanggal_bayar, '%d-%m-%Y') tanggal_bayar,
						e.atas_nama,
						e.bank,
						e.no_rek,
						e.foto_upload,
						((b.harga * (a.durasi / 60)) * 30) / 100 minimal_dp
					FROM 
						t_booking a
						INNER JOIN t_lapangan b
							ON b.id_lapangan = a.id_lapangan
						INNER JOIN t_arena_futsal c
							ON c.id_arena = b.id_arena
						LEFT JOIN t_user d
							ON d.id_user = a.id_customer
						LEFT JOIN t_pembayaran e
							ON e.id_booking = a.id_booking
					WHERE 
						((c.id_arena = ".$id_arena." AND ".$id_arena." <> 0)  OR ".$id_arena." = 0) ".$where."
					ORDER BY 
						a.id_booking DESC";
						
		$data = $conn->getRowsPaging($query, $page, $totalPerPage, $paging, "?menu=booking".$search_qs);
		
		ob_get_contents();
		ob_end_clean();
		
		include('pages/booking.php');
	}
	
	private function detail(){
		$conn = new connection(); 
		ob_start(); 
		$msg="";
		$alert="success";
		$type="simpan";
		
		$id_arena = $_SESSION['id_arena'];
		$id_booking = isset($_GET['id']) ? $_GET['id'] : 0;
		$tanggal = "";
		$jam = "";
		$durasi = 0;
		$lapangan = "";
		$status = 0;
		
		if(isset($_POST['save'])){			
			$tanggal = $_POST['tgl'];	
			$jam = $_POST['jam'];
			$durasi = $_POST['durasi'];
			$lapangan = $_POST['lapangan'];
			$status = $_POST['status'];
			
			$tanggal_booking = date('Y-m-d H:i:s', strtotime($tanggal." ".$jam.":00"));
			$durasi = $durasi * 60;
			
			if($id_booking == 0){
				$query = "INSERT INTO t_booking (tanggal_create, id_lapangan, id_customer, tanggal_booking, durasi)
							VALUES(NOW(), ".$lapangan.", 0, '".$tanggal_booking."', ".$durasi.")";
			}
			else{
				$query = "UPDATE t_booking SET id_lapangan = ".$lapangan.", tanggal_booking = '".$tanggal_booking."', durasi = ".$durasi." WHERE id_booking = ".$id_booking;
				$type = "ubah";
			}
			
			if($conn->executeQuery($query)){
				$msg = "Data Booking berhasil di ".$type;
			}
		}
		
		if($id_booking != 0){
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
						id_booking = ".$id_booking;
						
			$row = $conn->getRow($query);
			
			$id_booking = $row['id_booking'];
			$tanggal = $row['tanggal_main'];
			$jam = $row['jam_main'];
			$durasi = $row['durasi'];
			$lapangan = $row['id_lapangan'];
			$status = $row['status'];
		}
				
		$q_lapangan = "SELECT * FROM t_lapangan WHERE status = 1 AND ((id_arena = ".$id_arena." AND ".$id_arena." <> 0)  OR ".$id_arena." = 0)";
		$d_lapangan = $conn->getRows($q_lapangan);		
				
		ob_get_contents();
		ob_end_clean();
		
		include('pages/booking_detail.php');
	}	
	
	private function loadData($id_booking, $id, $tgl, $type){
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
									AND c.status = 0 "
									.(($id_booking == 0) ? "" : " AND c.id_booking <> ".$id_booking)." 
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