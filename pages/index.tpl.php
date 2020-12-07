<!DOCTYPE html>
<html>
<head>
	<title>Futsal</title>
	<!--fonts-->
		<link href='http://fonts.googleapis.com/css?family=Francois+One' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Cabin:400,500,600,700' rel='stylesheet' type='text/css'>	
	   <link href='http://fonts.googleapis.com/css?family=Audiowide' rel='stylesheet' type='text/css'>		
	<!--//fonts-->		
		<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
		<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
		<link rel="stylesheet" href="css/jquery-ui.css">
		<link rel="stylesheet" href="css/jquery.timepicker.min.css">
	<!-- for-mobile-apps -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="soccer Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
		Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!-- //for-mobile-apps -->
	<!-- js -->
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery-ui.js"></script>
		<script src="js/jquery.timepicker.min.js"></script>
	<!-- js -->
</head>
<body>
<!-- header -->
<div class="header">
	 <div class="container">
		 <div class="logo">
			   <h1><a href="index.php">SOCCER</a></h1>
		 </div>	
		 <div class="top-menu">
			 <span class="menu"></span>
			  <ul>
				 <li <?= $class == "home" ? 'class="active"' : '' ?>><a href="?menu=home">HOME</a></li>
				 <li <?= $class == "promo" ? 'class="active"' : '' ?>><a href="?menu=promo">PROMO</a></li>
				 <li <?= $class == "gallery" ? 'class="active"' : '' ?>><a href="?menu=gallery">GALLERY</a></li>
				 <li <?= $class == "booking" ? 'class="active"' : '' ?>><a href="?menu=booking">BOOKING</a></li>
				 <?php if(isset($_SESSION['userid'])){ ?>
					 <li><a href="?logout=1">LOGOUT</a></li>
				 <?php } else{ ?>
					 <li <?= $class == "login" ? 'class="active"' : '' ?>><a href="?menu=login">LOGIN</a></li>
				 <?php } ?>
				
			 </ul>			 
		 </div>			
		 <!-- script-for-menu -->
		 <script>
				$("span.menu").click(function(){
					$(".top-menu ul").slideToggle("slow" , function(){
					});
				});
		 </script>
		 <!-- script-for-menu -->	  	

		 <div class="clearfix"></div>
	 </div>
</div>
<!-- //header -->
<!-- banner -->
<div class="strip">
	 <div class="container">
		<?= isset($_SESSION['nama']) ? '<h4>Welcome, '.$_SESSION['nama'].' </h4>' : '' ?>	
		<!--
	 <div class="search">
		    <form>
		    	<input type="text" value="" placeholder="Search...">
				<input type="submit" value="">
			</form>
     </div>     
	 <div class="social">			 
			 <a href="#"><i class="facebook"></i></a>
			 <a href="#"><i class="twitter"></i></a>
			 <a href="#"><i class="dribble"></i></a>	
			 <a href="#"><i class="google"></i></a>	
			 <a href="#"><i class="youtube"></i></a>	
	 </div>
		<div class="clearfix"></div>
-->
		</div>
</div>
<!-- banner -->

<?php
    echo $content;
?>

<!--footer-->
<div class="footer">
	 <div class="container">
		 <div class="copywrite">
			 <center><p>© 2018 All Rights Reseverd Futsal Mania</p></center>
		 </div>
		 <!--
		 <div class="footer-menu">
			 <ul>
				 <li><a href="?menu=home">HOME</a></li>
				 <li><a href="?menu=promo">PROMO</a></li>
				 <li><a href="?menu=gallery">GALLERY</a></li>
				 <li><a href="?menu=booking">BOOKING</a></li>
				 <li><a href="?menu=login">LOGIN</a></li>
			 </ul>
		 </div>
		 -->
		 <div class="clearfix"></div>
	 </div>
</div>
<!-- //footer -->
</body>
</html>