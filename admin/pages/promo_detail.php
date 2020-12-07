<!-- //header -->
<div class="container">
		 <ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li><a href="index.php?menu=promo">Promo</a></li>
		  <li class="active">Detail</li>
		 </ol>
</div>
<!-- //header -->
<div class="contact">
	 <div class="container">
		 <div class="contact-grids">
			<h2>Detail Promo</h2>		 			 
			<?php if($msg != ""){ ?>
			<div class="alert alert-<?= $alert ?>">
				<center><span><?= $msg ?></span></center>
			</div>
			<?php } ?>
			 <form method="post">					
				<div class="row">
					<div class="form-group col-md-4 col-md-offset-0">
						<label for="judul">Judul Promo</label>
						<input class="form-control" type="" value="<?= $id_promo ?>" id="id_promo" name="id_promo" style="display:none;" />
						<input class="form-control" type="" value="<?= $judul ?>" id="judul" name="judul" required />
					</div>					
				</div>
				<div class="row">
					<div class="form-group col-md-6 col-md-offset-0">
						<label for="desc">Keterangan</label>
						<textarea class="form-control" id="desc" name="desc" rows="5" required><?= $desc ?></textarea>					
					</div>					
				</div>
				<div class="row">
					<div class="form-group col-md-3">									
						<label for="tgl">Periode Promosi</label>						
						<input class="form-control" type="" value="<?= $periode_awal ?>" id="periode_awal" name="periode_awal" required />
					</div>
					<div class="form-group col-md-3">									
						<label for="tgl"></label>						
						<input class="form-control" type="" value="<?= $periode_akhir ?>"  id="periode_akhir" name="periode_akhir" required />
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-2 col-md-offset-0">
						<label for="diskon">Diskon (%)</label>
						<input onkeypress="return isNumber();" class="form-control" type="" value="<?= $diskon ?>" id="diskon" name="diskon" required />
					</div>					
				</div>
				<div class="row">
					<div class="form-group col-md-3 col-md-offset-0">
						<label for="status">Status</label>
						<select name="status" class="form-control" id="status" >
							<option value="1" <?= $status == "1" ? 'selected' : '' ?>>Posting</option>
							<option value="0" <?= $status == "0" ? 'selected' : '' ?>>Unposting</option>
						</select>
					</div>					
				</div>				
				<input type="submit" name="save" value="SUBMIT" />				  				  
			</form>		
		 </div>
	 </div>
</div>

<script>
	$("#periode_awal").datepicker({
		defaultDate: new Date(),
		changeMonth: true,
		changeYear: true,
		minDate: new Date(),
		numberOfMonths: 1,
		dateFormat: "dd-mm-yy",
		onClose: function(selectedDate) {
			$("#to").datepicker("option", "minDate", selectedDate);
		}
	});	
	
	$("#periode_akhir").datepicker({
		defaultDate: new Date(),
		changeMonth: true,
		changeYear: true,
		minDate: new Date(),
		numberOfMonths: 1,
		dateFormat: "dd-mm-yy",
		onClose: function(selectedDate) {
			$("#to").datepicker("option", "minDate", selectedDate);
		}
	});	

	
</script>
