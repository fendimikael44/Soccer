<!-- //header -->
<div class="container">
		 <ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li class="active">Promo</li>
		 </ol>
</div>
<!-- events -->
<div class="featured-news">
	 <div class="container">
		 <div class="ftrd-head text-center">
			 <h3>FEATURED PROMO</h3>
			 <!-- <p>Phasellus ultricies magna vitae justo aliquam, cursus bibendum neque tempus.</p> -->
		 </div>
		 <div class="event-grids">
				  <?php for($i=0;$i<count($promo);$i++){ ?>
			 <div class="col-md-4 event-grid-sec">
				 <div class="event-time text-center">
					 <p><?= $promo[$i]['tgl1'] ?></p>
				 </div>
				 <div class="event-grid_pic">
					 <img src="images/e1.jpg" alt=""/>
					 <h3><a href="?menu=promo&action=detail&id=<?= $promo[$i]['id_promo'] ?>"><?= $promo[$i]['judul'] ?></a></h3>
					 <p><?= $promo[$i]['deskripsi'] ?></p>				 
				 </div>
			 </div>
			  <?php
						   if(($i+1) % 3 == 0){
									break;
						   }
				  
			  } ?>
			 <div class="clearfix"></div>
		 </div>
	 </div>
</div>
<!---->
