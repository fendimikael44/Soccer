<!-- //header -->
<div class="container">
		 <ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li class="active">Register</li>
		 </ol>
</div>
<!-- //header -->
<div class="contact">
	 <div class="container">
		 <div class="contact-grids">
			 <h2>REGISTER</h2>		 
			<?php if($msg != ""){ ?>
			<div class="alert alert-<?= $stat ?>">
				<center><span><?= $msg ?></span></center>
			</div>
			<?php } ?>
			 <form method="post">
				  <div class="row">
						   <div class="form-group col-md-6 col-md-offset-0">
								    <label for="name">Full Name</label>
								    <input type="" name="name" class="form-control" id="name" placeholder="Enter name" required>
						   </div>
				  </div>
				  <div class="row">
						   <div class="form-group col-md-6 col-md-offset-0">
								    <label for="email">Email address</label>
								    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" required>
								    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
						   </div>
				  </div>
				  <div class="row">
						   <div class="form-group col-md-6 col-md-offset-0">
								    <label for="phone">Phone Number</label>						   
								    <input class="form-control" name="phone" type="" placeholder="Enter phone" id="phone" required>
						   </div>
				  </div>
				  <div class="row">
						   <div class="form-group col-md-6 col-md-offset-0">
								    <label for="password">Password</label>
								    <input type="password" name="password" class="form-control form-control-sm" id="password" placeholder="Password" required>
						   </div>
				  </div>
				  <div class="row">
						   <div class="form-group col-md-6 col-md-offset-0">
								    <label for="confirm_password">Confirm Password</label>
								    <input type="password" name="confirm_password" class="form-control form-control-sm" id="confirm_password" placeholder="Confirm Password" onkeyup='check();' required>
								    <span id='message'></span>
						   </div>
				  </div>

				  <input type="submit" name="register" value="REGISTER" />				  				  
			 </form>
			
		 </div>
	 </div>
</div>

<script>
		 var check = function() {
				  if (document.getElementById('password').value ==
				    document.getElementById('confirm_password').value) {
				    document.getElementById('message').style.color = 'green';
				    document.getElementById('message').innerHTML = '*password matching';
				  } else {
				    document.getElementById('message').style.color = 'red';
				    document.getElementById('message').innerHTML = '*password not matching';
				  }
		 }
</script>
