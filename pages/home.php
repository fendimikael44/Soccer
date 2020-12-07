<!-- banner -->
<div class="banner">
		<script src="js/responsiveslides.min.js"></script>
  <script>
    $(function () {
      $("#slider").responsiveSlides({
      	auto: true,
      	speed: 300,
        manualControls: '#slider3-pager',
      });
    });
  </script>

 <div class="slider">
	  <div class="callbacks_container">
	     <ul class="rslides" id="slider">
	         <li>
				  <img src="images/bnr3.jpg" alt="">
				  <!--
				  <div class="banner-info">
				  <h3>Sed ultricies elementum.</h3>
				  <p>Lorem Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec a odio quam. Aenean ipsum arcu, 
				  luctus vel ultricies ut, commodo sed turpis. Phasellus tristique lorem sit amet tellus dignissim hendrerit.
				  In hac habitasse platea dictumst. Sed vehicula volutpat varius elit. consectetur adipiscing elit.</p>
				  </div>
				  -->
	         </li>
	         <li>
				 <img src="images/bnr2.jpg" alt="">
				 <!--
	        	 <div class="banner-info">
				  <h3>Curabitur turpis posuere rutrum.</h3>
				  <p>Lorem Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec a odio quam. Aenean ipsum arcu, 
				  luctus vel ultricies ut, commodo sed turpis. Phasellus tristique lorem sit amet tellus dignissim hendrerit.
				  In hac habitasse platea dictumst. Sed vehicula volutpat varius elit. consectetur adipiscing elit.</p>
				  </div>
				  -->
			 </li>
	         <li>
	             <img src="images/bnr1.jpg" alt="">
				 <!--
	        	 <div class="banner-info">
				  <h3>Sed ultricies elementum.</h3>
				  <p>Lorem Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec a odio quam. Aenean ipsum arcu, 
				  luctus vel ultricies ut, commodo sed turpis. Phasellus tristique lorem sit amet tellus dignissim hendrerit.
				  In hac habitasse platea dictumst. Sed vehicula volutpat varius elit. consectetur adipiscing elit.</p>
				  </div>
				  -->
	         </li>
	      </ul>
	  </div>
  </div>
<!---->
				
<!---start-content----->
<div class="banner-bottom-grids">
	<div class="container">
		<div class="contact-grids">
		 <h2>Latest Promo</h2>
			<?php 
				if(count($promo) > 0){
					for($i=0;$i<count($promo);$i++){ ?>
					<a href="?menu=promo&action=detail&id=<?= $promo[$i]['id_promo'] ?>">
						<div class="col-md-6 banner-text-info clr<?= ($i+1) ?> btm">	
							<i class="icon3"></i>
							<div class="bnr-text">
								<h3><?= $promo[$i]['judul'] ?></h3>
								<p><?= $promo[$i]['deskripsi'] ?></p>
							</div>
						</div>
					</a>
			<?php 	} 
				}
				else{ 
					echo "No Promo";
				} ?>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<!-- //banner -->

<!-- content -->
<!--
<div class="content">
	 <div class="container">
		 <div class="content-grids">
			 <div class="col-md-4 content-grid1">
				 <img src="images/c1.jpg" alt=""/>
				 <h3>Champion's League</h3>
				 <p>Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus 
				 Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker.</p>
				 <a href="#">Read More..</a>
			 </div>
			 <div class="col-md-4 content-grid1">
				 <img src="images/c2.jpg" alt=""/>
				 <h3>Women's Cup</h3>
				 <p>Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus 
				 Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker.</p>
				 <a href="#">Read More..</a>
			 </div>
			 <div class="col-md-4 content-grid1">
				 <img src="images/c3.jpg" alt=""/>
				 <h3>Final Tournment</h3>
				 <p>Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus 
				 Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker.</p>
				 <a href="#">Read More..</a>
			 </div>
			 <div class="clearfix"></div>
		 </div>
	 </div>
</div>

<!--- //content--->
<!-- content-bottom 
<div class="content-info">
	 <div class="container">
		 <div class="content-bottom-grids">
			 <div class="col-md-4 popular">	
				 <h3>POPULAR TAGS</h3>
				 <ul>
					 <li><a href="#">Ut vehicula nisl ut purus tempus aliquet.</a></li>
					 <li><a href="#">Nullam a risus pharetra nisi commodo auctor.</a></li>
					 <li><a href="#">Proin venenatis velit a fringilla rutrum.</a></li>
					 <li><a href="#">Nunc facilisis dolor ac suscipit volutpat.</a></li>
					 <li><a href="#">Cras tempor justo ac mauris laoreet lacus efficitur.</a></li>
					 <li><a href="#">Sed tincidunt enim ac elit tempor erat consequat.</a></li>
					 <li><a href="#">Proin venenatis velit a fringilla rutrum.</a></li>
					 <li><a href="#"> Aliquam vulputate mi vestibulum mauris ultrices.</a></li>
				 </ul>
			 </div>
			 <div class="col-md-4 welcome-pic">
				 <h3>ABOUT</h3>
				 <h4>Morbi sed arcu mollis, elementum erat venenatis, tincidunt tellus.</h4>
				 <img src="images/cnt.ab.jpg" alt=""/>
				 <p>Aenean ut condimentum magna, mattis pretium massa. Sed sollicitudin ullamcorper auctor. Duis vestibulum velit id augue pulvinar egestas. 
				 Morbi sed orci auctor, feugiat felis at, fermentum magna. In ac egestas lectus.</p>
			</div>
			<div class="col-md-4 coach">
				 <h3>OUR COACHES</h3>
				 <div class="coch-grid chr">
					 <div class="coach-pic">
						 <img src="images/ch1.jpg" alt=""/>
					 </div>
					 <div class="coach-pic-info">
						 <h4><a href="#">Phasellus at Tellus</a></h4>
						 <h5>Aenean vestibulum </h5>
						 <p>Donec ornare massa at velit fringilla, condimentum magna ornare tincidunt nulla dignissim.</p>
					 </div>
					 <div class="clearfix"></div>
				 </div>
				 <div class="coch-grid">
					 <div class="coach-pic">
						 <img src="images/ch2.jpg" alt=""/>
					 </div>
					 <div class="coach-pic-info">
						 <h4><a href="#">Phasellus at Tellus</a></h4>
						 <h5>Aenean vestibulum </h5>
						 <p>Donec ornare massa at velit fringilla, condimentum magna ornare tincidunt nulla dignissim.</p>
					 </div>
					 <div class="clearfix"></div>
				 </div>
			</div>
			<div class="clearfix"></div>
		 </div>
	 </div>
</div>
-->
<!-- //content-bottom -->