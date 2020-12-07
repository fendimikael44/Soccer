<?php
	$msg = "";
	
	
	if(isset($_POST['username'])){	
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$query = "SELECT 
							a.id_user,
							a.nama nama_user,
							b.username,
							c.id_role,
							c.role nama_role,
							COALESCE(d.id_arena, '0') id_arena,
							COALESCE(d.nama, '') nama_arena
						FROM
							t_user a
							INNER JOIN t_user_login b
								ON b.id_user = a.id_user
							INNER JOIN t_role c
								ON c.id_role = a.role
							LEFT JOIN t_arena_futsal d
								ON d.id_owner = a.id_user
						WHERE
							a.status = 1
							AND b.username = '".$username."'
							AND b.password = MD5('".$password."')
							AND c.id_role in (1,2)";
		//echo $query;
		$row = $conn->getRow($query);
		//echo $query;
		if(count($row) > 0){  
			$_SESSION['userid'] = $row['id_user'];
			$_SESSION['username'] = $row['username'];
			$_SESSION['nama'] = $row['nama_user'];
			$_SESSION['role'] = $row['id_role'];
			$_SESSION['id_arena'] = $row['id_arena'];
			$_SESSION['nama_arena'] = $row['nama_arena'];
			
			header("location:index.php");    
		}
		else{
			$msg = "Login gagal";      
		}
	}
?>

<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<style>
body {font-family: Arial, Helvetica, sans-serif;}
/*form {border: 3px solid #f1f1f1;}*/

input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    opacity: 0.8;
}

.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

img.avatar {
    width: 40%;
    border-radius: 50%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
.border-div{
    border-style: solid;
    padding: 3%;
    border-width: thin;
}
</style>

<div style="margin-bottom:60px"></div>
<?php if($msg != ""){ ?>
	<center>
		<div class="alert alert-danger col-md-4 col col-md-offset-4" role="alert">
			<?= $msg ?> 
		</div>
	</center>
<?php } ?>
<form method="post">
  <div class="container">
	<div class="col-md-6 col-md-offset-3 border-div">
		<label for="uname"><b>Username</b></label>
		<input type="text" placeholder="Enter Username" name="username" required>
	
		<label for="psw"><b>Password</b></label>
		<input type="password" placeholder="Enter Password" name="password" required>
			
		<button class="btn-danger" type="submit"/>Login</button>
		<!--
		<label>
		  <input type="checkbox" checked="checked" name="remember"> Remember me
		</label>
		-->
		<span class="psw">Forgot <a href="#">password?</a></span>
	</div>
  </div>
<!--
	<div class="container">
		<div class="col-md-6 col-md-offset-3"  style="background-color:#f1f1f1">
			<button type="button" class="cancelbtn">Cancel</button>
			<span class="psw">Forgot <a href="#">password?</a></span>
		</div>
	</div>
-->
</form>

