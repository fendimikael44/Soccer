<!-- banner -->
<div class="gallery-head">
	 <div class="container">
		 <ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li class="active">Gallery</li>
		 </ol>
	 </div>
	 <?php
	 $i=0;
	 foreach($data as $d){
	 $i++;  
	 ?>
	 <div class="gallery-text">
		 <div class="container">
		 <h2><?= $d['header']['nama_arena'] ?></h2>
		 <p><?= $d['header']['info'] ?></p>
		 <p><?= $d['header']['alamat'] ?> (<?= $d['header']['telp'] ?>)</p>
		  <p>Jam Operasional : <?= $d['header']['jam_operational'] ?></p>
		 </div>
	 </div>
	 
	 <div class="container">	
		 <div class="main">
		 <div class="gallery">	
			  <section>	   
				  <ul class="lb-album">
					<?php foreach($d['detail'] as $detail){ ?>
					  <li>
						 <a href="#image-<?= $detail['id_lapangan'] ?>">
						     <img src="<?= $detail['foto'] ?>" class="img-responsive" alt="">
							 <span> </span>
						 </a>
						  <div class="lb-overlay" id="image-<?= $detail['id_lapangan'] ?>">
							 <img src="<?= $detail['foto'] ?>" class="img-responsive" alt="<?= $detail['nama_lapangan'] ?>">
							 <a href="#page" class="lb-close"> </a>
						 </div>
						 <p>Harga : Rp. <?= number_format($detail['harga'],2,",",".") ?> </p>
					  </li>
					  <?php } ?> 
				 </ul>			
			 </section>
			 <div class="clearfix"> </div>
		  </div>
	 </div>
		 <?php if($i < count($data)){ ?>
			   <hr style="height:1px;border:none;color:#333;background-color:#333;">
		  <?php } ?>
	 </div>
	 
	 <?php } ?>
</div>