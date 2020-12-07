<?php

class login{
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
		$msg = "";
		
		if(isset($_POST['login'])){		
			$username = $_POST['username'];
			$password = $_POST['password'];
			
			$query = "SELECT a.id_user, a.username, b.nama, c.id_role, c.role FROM t_user_login a INNER JOIN t_user b ON b.id_user = a.id_user INNER JOIN t_role c ON c.id_role = b.role WHERE a.username = '".$username."' AND a.password = MD5('".$password."')";
			$row = $conn->getRow($query);
			
			if($row > 0){
				$_SESSION['userid'] = $row['id_user'];
				$_SESSION['username'] = $row['username'];
				$_SESSION['role'] = $row['id_role'];
				$_SESSION['nama_role'] = $row['role'];
				$_SESSION['nama'] = $row['nama'];
				
				if($_POST['hid_menu'] != ""){
					if($_POST['hid_menu'] == 'booking'){
						header("location:index.php?menu=booking&login=success");
					}
				}
				else{
					header("location:index.php?menu=home&login=success");		
				}
			}
			else{
				$msg = "Login Failed";
			}
			
			if($_POST['hid_menu'] != ""){
				$_GET['menu'] = $_POST['hid_menu'];
			}
		}
		
		ob_get_contents();
		ob_end_clean();
		
		include('pages/login.php');
	}
}
?>