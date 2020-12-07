<?php

class lapangan{
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
		
		$query = "SELECT a.*, b.nama nama_arena FROM t_lapangan a INNER JOIN t_arena_futsal b ON b.id_arena = a.id_arena
						WHERE ((a.id_arena = ".$id_arena." AND ".$id_arena." <> 0)  OR ".$id_arena." = 0) ORDER BY nama ASC";
		
		$data = $conn->getRowsPaging($query, $page, $totalPerPage, $paging, "?menu=lapangan");
		
		ob_get_contents();
		ob_end_clean();
		
		include('pages/lapangan.php');
	}
	
	private function detail(){
		$conn = new connection(); 
		ob_start(); 
		$msg="";
		$alert="success";
		$type="simpan";
		
		$root = "../";
		$folder = "images/lapangan/";
		$target_dir = $root.$folder;		
		
		$id_lapangan = isset($_GET['id']) ? $_GET['id'] : 0;
		$nama = "";
		$desc = "";		
		$harga = "";
		$foto = "";
		$status = 0;
		
		if(isset($_POST['save'])){	
			$id_arena = $_SESSION['id_arena'];
			$nama = $_POST['nama'];
			$desc = $_POST['desc'];		
			$harga = $_POST['harga'];
			$foto = $_POST['old_image'];
			$status = $_POST['status'];
				
			if($_FILES["foto"]["tmp_name"] != ""){
				if($id_lapangan == 0){
					$query = "SELECT MAX(id_lapangan) + 1 id FROM t_lapangan";
					$row = $conn->getRow($query);
					$tmp_id_lapangan = $row['id'];
					$target_file = $target_dir."lapangan_".$tmp_id_lapangan.".jpg";
					$foto = $folder."lapangan_".$id_lapangan.".jpg";
				}
				else{
					$target_file = $target_dir."lapangan_".$id_lapangan.".jpg";
					$foto = $folder."lapangan_".$id_lapangan.".jpg";
				}
				
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
							
				// Check if image file is a actual image or fake image
				$check = getimagesize($_FILES["foto"]["tmp_name"]);

				if($check == false) {
					$msg = "File yang di masukan bukan foto";
					$alert="danger";
				}
				
				// Check file size
				if ($_FILES["foto"]["size"] > 500000) {
					$msg = "Ukuran foto terlalu besar";
					$alert="danger";
				}
				
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "jpeg") {
					$msg = "File harus JPG atau JPEG";
					$alert="danger";
				}					
			}	
				
			if($id_lapangan == 0){
				$query = "INSERT INTO t_lapangan (nama,id_arena,harga,foto,deskripsi,status)
									VALUES('".$nama."',".$id_arena.",".$harga.",'".$foto."','".$desc."',".$status.")";
			}
			else{
				$query = "UPDATE t_lapangan SET nama = '".$nama."', deskripsi = '".$desc."', harga = ".$harga.", foto = '".$foto."', status = ".$status." WHERE id_lapangan = ".$id_lapangan;
				$type = "ubah";
			}

			if($conn->executeQuery($query)){
				if($msg == ""){
					if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
						$foto = $target_file;
						$msg = "Data lapangan berhasil di ".$type;
					} else {
						$msg = "Data lapangan gagal di ".$type;
					}
				}		
			}				
		}
		
		if($id_lapangan != 0){
			$query = "SELECT * FROM t_lapangan WHERE id_lapangan = ".$id_lapangan." ORDER BY nama ASC";
			$row = $conn->getRow($query);
			
			$id_lapangan = $row['id_lapangan'];
			$nama = $row['nama'];
			$desc = $row['deskripsi'];
			$harga = $row['harga'];
			$foto = $row['foto'];		
			$status = $row['status'];
		}
				
		ob_get_contents();
		ob_end_clean();
		
		include('pages/lapangan_detail.php');
	}	
}
?>