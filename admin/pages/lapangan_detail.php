<!-- //header -->
<div class="container">
		 <ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li><a href="index.php?menu=lapangan">Lapangan</a></li>
		  <li class="active">Detail</li>
		 </ol>
</div>
<!-- //header -->
<div class="contact">
	 <div class="container">
		 <div class="contact-grids">
			<h2>Detail Lapangan</h2>		 			 
			<?php if($msg != ""){ ?>
			<div class="alert alert-<?= $alert ?>">
				<center><span><?= $msg ?></span></center>
			</div>
			<?php } ?>
			 <form method="post" enctype="multipart/form-data">					
				<div class="row">
					<div class="form-group col-md-4 col-md-offset-0">
						<label for="nama">Nama Lapangan</label>
						<input class="form-control" type="" value="<?= $id_lapangan ?>" id="id_lapangan" name="id_lapangan" style="display:none;" />
						<input class="form-control" type="" value="<?= $nama ?>" id="nama" name="nama" required />
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
						<label for="harga">Harga per jam</label>						
						<input class="form-control" onkeypress="return isNumber();" type="" value="<?= $harga ?>" id="harga" name="harga" required />
					</div>				
				</div>
				<div class="row">
					<div class="form-group col-md-2 col-md-offset-0">
						<label for="diskon">Foto</label>
						<input type="file" name="foto" accept="image/*" id='foto' >
						<input type="text" name="old_image" value="<?= $foto ?>" style="display: none"/>
						<img id="preview" src="../<?= $foto != "" ? $foto : 'images/no-image.png' ?>" alt="your image" style="width:100%; height:100%" />
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
	function readURL(input) {
	    if (input.files && input.files[0]) {
		  var reader = new FileReader();
		  
		  reader.onload = function (e) {
			$('#preview').attr('src', e.target.result);
		  }
		  
		  reader.readAsDataURL(input.files[0]);
	    }
	}
	
	$("#foto").change(function(){
	    readURL(this);
	});	
</script>
