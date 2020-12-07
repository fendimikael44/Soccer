<style>
	fieldset.scheduler-border {
		border: solid 1px #DDD !important;
		padding: 0 10px 10px 10px;
		border-bottom: none;
	}

	legend.scheduler-border {
		width: auto !important;
		border: none;
		font-size: 1.2em;
		font-weight: bold;
		color: #ed645c;
	}
</style>
<!-- content-bottom -->
<div class="content-info">
	 <div class="container">
		 <div class="content-bottom-grids">
			 <div class="col-md-8 popular">	
				 <h3>New Booking</h3>
				 <?php if(count($data) > 0){ ?>
				 <ul>
					<?php for($i=0;$i<count($data);$i++){ ?>
						<li>
							<a href="?menu=booking&action=detail&id=<?= $data[$i]['id_booking'] ?>">
								<fieldset class="scheduler-border">
									<legend class="scheduler-border"><?= $data[$i]['nama_lapangan'] ?></legend>
									<div class="control-group">								
										<div class="controls">
											Tanggal : <?= $data[$i]['tanggal_main'] ?> <br/>
											Jam : <?= $data[$i]['jam_main'] ?> <br/>
											Durasi : <?= $data[$i]['durasi'] ?> Jam
										</div>
									</div>
								</fieldset>		
							</a>							
						</li>
					<?php } ?>			 					 
				 </ul>
				 <?php } else { ?>
				 		Tidak ada data		 
				 <?php } ?>
			 </div>		
		 </div>
	 </div>
</div>
<!-- //content-bottom -->