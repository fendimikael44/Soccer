<?php

class register{
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
		$stat = "success";
		
		if(isset($_POST['register'])){
			//print_r($_POST); die;
			$role = 3;
			$name = $_POST['name'];
			$email = $_POST['email'];
			$phone = $_POST['phone'];
			$password = $_POST['password'];
			$confirm_password = $_POST['confirm_password'];
			
			if($password != $confirm_password){
				$msg = "Confirm Password not matching";
			}
			
			$query = "SELECT count(*) cek FROM t_user_login a INNER JOIN t_user b ON b.id_user = a.id_user INNER JOIN t_role c ON c.id_role = b.role WHERE a.username = '".$email."' ";
			$row = $conn->getRow($query);
			
			if($row['cek'] != 0){
				$msg = "Email already exist";
				$stat = "danger";
			}
			
			if($msg == ""){
				$query = "INSERT INTO t_user (nama,telp,role) VALUES('".$name."', '".$phone."',".$role.")";
				if($conn->executeQuery($query)){
					$query = "SELECT MAX(id_user) id FROM t_user";
					$row = $conn->getRow($query);
					$id_user = $row['id'];
					
					$query = "INSERT INTO t_user_login (id_user,username,password) VALUES(".$id_user.", '".$email."',MD5('".$password."'))";
					
					if($conn->executeQuery($query)){
						$msg = "Your account have been registered";
					}
				}
			}

		}
		
		ob_get_contents();
		ob_end_clean();
		
		include('pages/register.php');
	}
}
?>