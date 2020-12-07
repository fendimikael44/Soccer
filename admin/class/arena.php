<?php

class arena{
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
		
		$id_arena = $_SESSION['id_arena'];
	
		$query = "SELECT
							a.id_arena,
							a.nama nama_arena,
							a.alamat,
							a.telp,
							a.info,
							a.jam_operational,
							a.status,
							b.nama nama_user
						FROM
							t_arena_futsal a
							INNER JOIN t_user b
								ON b.id_user = a.id_owner
						WHERE
							((a.id_arena = ".$id_arena." AND ".$id_arena." <> 0)  OR ".$id_arena." = 0)";
							
		$data = $conn->getRowsPaging($query, $page, $totalPerPage, $paging, "?menu=arena");
		
		ob_get_contents();
		ob_end_clean();
		
		include('pages/arena.php');
	}
	
	private function detail(){
		$conn = new connection(); 
		ob_start(); 
		$msg="";
		$alert="success";
		$type="simpan";
		
		$id_arena = isset($_GET['id']) ? $_GET['id'] : 0;
		$nama_arena = "";
		$id_owner = 0;
		$nama_owner = "";
		$alamat = "";
		$telp = "";
		$info = "";
		$jam_buka = "";
		$jam_tutup = "";
		$status = 0;
		
		if(isset($_POST['save'])){	
			$id_arena = $_POST['id_arena'];
			$nama_arena = $_POST['nama_arena'];
			$nama_owner = $_POST['nama_owner'];
			$alamat = $_POST['alamat'];
			$jam_buka = date('H:i',strtotime($_POST['jam_buka']));
			$jam_tutup = date('H:i',strtotime($_POST['jam_tutup']));
			$telp = $_POST['telp'];
			$info = $_POST['info'];
			$status = $_POST['status'];
			$jam_operational = $jam_buka."-".$jam_tutup;
			
			if($id_arena == 0){
				// INSERT NEW USER
				$query = "INSERT INTO t_user(nama,telp,role,status) VALUES('".$nama_owner."','".$telp."',2,1)";
				if($conn->executeQuery($query)){
					$query = "SELECT MAX(id_user) id FROM t_user";
					$row = $conn->getRow($query);

					$id_owner = $row['id'];
					$username = "admin_".str_replace(' ', '', strtolower($nama_arena));

					// INSERT NEW USER LOGIN
					$query = "INSERT INTO t_user_login(id_user,username,password) VALUES(".$id_owner.",'".$username."',MD5('admin'))";
					$conn->executeQuery($query);

					// INSERT NEW ARENA
					$query = "INSERT INTO t_arena_futsal(nama,alamat,telp,id_owner,jam_operational,info,status)
									VALUES('".$nama_arena."','".$alamat."','".$telp."',".$id_owner.",'".$jam_operational."','".$info."',".$status.")";			
				}

			}
			else{
				$query = "UPDATE t_arena_futsal SET nama = '".$nama_arena."', alamat = '".$alamat."', telp = '".$telp."', jam_operational = '".$jam_operational."', info = '".$info."', status = ".$status." WHERE id_arena = ".$id_arena;
				$type = "ubah";
			}
			// echo $query; die;
			if($conn->executeQuery($query)){
				$msg = "Data arena berhasil di ".$type;
			}
		}
		
		if($id_arena != 0){
			$query = "SELECT
							a.id_arena,
							a.nama nama_arena,
							a.alamat,
							a.telp,
							a.id_owner,
							a.info,
							a.jam_operational,
							a.status,
							b.nama nama_owner
						FROM
							t_arena_futsal a
							INNER JOIN t_user b
								ON b.id_user = a.id_owner
						WHERE
							a.id_arena = ".$id_arena;
							
			$row = $conn->getRow($query);
			
			$id_arena = $row['id_arena'];
			$nama_arena = $row['nama_arena'];
			$nama_owner = $row['nama_owner'];
			$alamat = $row['alamat'];
			$telp = $row['telp'];
			$info = $row['info'];
			$jam_operational = explode('-', $row['jam_operational']);
			$jam_buka = $jam_operational[0];
			$jam_tutup = $jam_operational[1];
			$status = $row['status'];
		}
				
		ob_get_contents();
		ob_end_clean();
		
		include('pages/arena_detail.php');
	}	
}
?>