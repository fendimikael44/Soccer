<style>
	.login-page {
		width: 360px;
		padding: 8% 0 0;
		margin: auto;
	}
	.form {
		position: relative;
		z-index: 1;
		background: #FFFFFF;
		max-width: 360px;
		margin: 0 auto 100px;
		padding: 45px;
		text-align: center;
		box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
	}
	.form input {
		font-family: "Roboto", sans-serif;
		outline: 0;
		background: #f2f2f2;
		width: 100%;
		border: 0;
		margin: 0 0 15px;
		padding: 15px;
		box-sizing: border-box;
		font-size: 14px;
	}
	.form button {
		font-family: "Roboto", sans-serif;
		text-transform: uppercase;
		outline: 0;
		background: #ed645c;
		width: 100%;
		border: 0;
		padding: 15px;
		color: #FFFFFF;
		font-size: 14px;
		-webkit-transition: all 0.3 ease;
		transition: all 0.3 ease;
		cursor: pointer;
	}
	.form button:hover,.form button:active,.form button:focus {
		background: #ed645c;
	}
	.form .message {
		margin: 15px 0 0;
		color: #b3b3b3;
		font-size: 12px;
	}
	.form .message a {
		color: #ed645c;
		text-decoration: none;
	}

</style>
<div class="login-page">
	<?php if($msg != ""){ ?>
	<div class="alert alert-danger">
		<center><span><?= $msg ?></span></center>
	</div>
	<?php } ?>
	
	<div class="form">	
		<form class="login-form" method="post">
			<input type="text" placeholder="username" name="username" />
			<input type="password" placeholder="password" name="password" />
			<button type="submit" name="login">login</button>
			<p class="message">Not registered? <a href="?menu=register">Create an account</a></p>
		</form>
	</div>
</div>