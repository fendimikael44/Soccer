<!-- //header -->
<div class="container">
		 <ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li><a href="index.php?menu=arena">Info Arena</a></li>
		  <li class="active">Detail</li>
		 </ol>
</div>
<!-- //header -->
<div class="contact">
	 <div class="container">
		 <div class="contact-grids">
			<h2>Detail Info</h2>		 			 
			<?php if($msg != ""){ ?>
			<div class="alert alert-<?= $alert ?>">
				<center><span><?= $msg ?></span></center>
			</div>
			<?php } ?>
			 <form method="post">					
				<div class="row">
					<div class="form-group col-md-4 col-md-offset-0">
						<label for="nama_arena">Nama Arena</label>
						<input class="form-control" type="" value="<?= $id_arena ?>" id="id_arena" name="id_arena" style="display:none;" />
						<input class="form-control" type="" value="<?= $nama_arena ?>" id="nama_arena" name="nama_arena" required />
					</div>	
					<div class="form-group col-md-4 col-md-offset-0">
						<label for="nama_arena">Nama Owner</label>					
						<input <?= $nama_owner != "" ? 'disabled' : '' ?> class="form-control" type="" value="<?= $nama_owner ?>" id="nama_owner" name="nama_owner" required />
					</div>					
				</div>
				<div class="row">
					<div class="form-group col-md-6 col-md-offset-0">
						<label for="alamat">Alamat</label>
						<textarea class="form-control" id="alamat" name="alamat" rows="5" required><?= $alamat ?></textarea>					
					</div>					
				</div>
				<div class="row">
					<div class="form-group col-md-2 col-md-offset-0">
						<label for="telp">No. Telepon</label>
						<input onkeypress="return isNumber();" class="form-control" type="" value="<?= $telp ?>" id="telp" name="telp" required />
					</div>					
				</div>
				<div class="row">
					<div class="form-group col-md-3">									
						<label for="tgl">Jam Buka</label>						
						<input onkeypress="return false;" class="form-control" type="" value="<?= $jam_buka ?>" id="jam_buka" name="jam_buka" required />
					</div>
					<div class="form-group col-md-3">									
						<label for="tgl">Jam Tutup</label>						
						<input onkeypress="return false;" class="form-control" type="" value="<?= $jam_tutup ?>"  id="jam_tutup" name="jam_tutup" required />
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-6 col-md-offset-0">
						<label for="info">Info</label>
						<textarea class="form-control" id="info" name="info" rows="5" required><?= $info ?></textarea>					
					</div>					
				</div>
				<div class="row">
					<div class="form-group col-md-3 col-md-offset-0">
						<label for="status">Status</label>
						<select name="status" class="form-control" id="status" >
							<option value="1" <?= $status == "1" ? 'selected' : '' ?>>Aktif</option>
							<option value="0" <?= $status == "0" ? 'selected' : '' ?>>Non-Aktif</option>
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

	$('#jam_buka').timepicker({
		timeFormat: 'H:i',
		step: 60		
	});
	
	$('#jam_tutup').timepicker({
		timeFormat: 'H:i',
		step: 60		
	});

</script>
