<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
<!-- //header -->
<div class="container">
		 <ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li><a href="?menu=booking">Booking</a></li>
		  <li class="active">History</li>
		 </ol>
</div>
<!-- //header -->
<div class="contact">
	<div class="container">
		 <div class="contact-grids">
			<h2>History Booking</h2>		
			<?php if($msg != ""){ ?>
			<div class="alert alert-<?= $alert ?>">
				<center><span><?= $msg ?></span></center>
			</div>
			<?php } ?>			
			<table class="table">
				<thead>
				  <tr>
					<th>#</th>
					<th>Tanggal / Jam</th>
					<th>Durasi Main</th>
					<th>Arena Futsal</th>
					<th>Lapangan</th>
					<th>Pembayaran DP</th>
					<th>Status</th>
				  </tr>
				</thead>
				<tbody>		
					<?php for($i=0;$i<count($data);$i++){ ?>
					<tr <?= $i%2 == 0 ? 'class="active"' : '' ?>>
						<td><?= ($i+1) ?></td>
						<td><?= $data[$i]['tanggal_booking'] ?></td>
						<td><?= ($data[$i]['durasi'] / 60) . ' Jam' ?></td>
						<td><?= $data[$i]['nama_arena'] ?></td>
						<td><?= $data[$i]['nama_lapangan'] ?></td>
						<td align="center">
							<?php if($data[$i]['status_pembayaran'] == ''){ ?>
							<div class="text-center">
								<a href="" class="btn btn-info btn-rounded mb-4 btn-sm" data-toggle="modal" data-target="#pembayaran_<?= $data[$i]['id_booking'] ?>" >Upload</a>
								<div id="pembayaran_<?= $data[$i]['id_booking'] ?>" class="modal fade in">
									<form method="post" enctype="multipart/form-data">
									<div class="modal-dialog">
										<div class="modal-content">		 
											<div class="modal-header">											
												<h4 class="modal-title">Konfirmasi Pembayaran</h4>
											</div>
											<div class="modal-body">	
												<div class="row">
													<div class="form-group col-md-3">
														<label>No Rekening</label>
													</div>	
													<div class="form-group col-md-7">
													<input value="<?= $data[$i]['id_booking'] ?>" name="id_booking" class="form-control" style="display:none;">
													<input type="" name="norek" class="form-control" required>
													</div>	
												</div>
												<div class="row">
													<div class="form-group col-md-3">
														<label>Nama Rekening</label>
													</div>	
													<div class="form-group col-md-7">
													<input type="" name="atasnama" class="form-control" required>
													</div>	
												</div>	
												<div class="row">
													<div class="form-group col-md-3">
														<label>Nama Bank</label>
													</div>	
													<div class="form-group col-md-5">
													<input type="" name="namabank" class="form-control" required>
													</div>	
												</div>
												<div class="row">
													<div class="form-group col-md-3">
														<label>Foto</label>
													</div>	
													<div class="form-group col-md-5">
														<input type="file" name="foto" accept="image/*" id='foto' required>
														<input type="text" name="old_image" value="<?= $foto ?>" style="display: none"/>
														<img id="preview" src="<?= $foto != "" ? $foto : 'images/no-image.png' ?>" alt="your image" style="width:100%; height:100%" />
													</div>	
												</div>												
											</div>
										<div class="modal-footer">
											<div class="row">
												<div class="col-md-8"> 
													<span style="color: red"> 
														*Mininal pembayaran DP 30 % (Rp. <?=	
															number_format(floor($data[$i]['minimal_dp']),2,",",".") ?>)
													</span>
												</div>
												<div class="col-md-4">		
													<button class="btn btn-danger" data-dismiss="modal">Cancel</button>
													<button class="btn btn-success" type="submit" name="payment">Save</button>												
												</div>	 
											</div>
										</div>
									</div>
									</form>
								</div>
							</div>
							<?php } else {
								echo ($data[$i]['status_pembayaran'] == 0 ? '<span style="color:red;">Pending</span>' : '<span style="color:Green;">Lunas</span>');
							} ?>						
						</td>
						<td><?= $data[$i]['status_booking'] == 0 ? '<span style="color:red;">New</span>' : '<span style="color:Green;">Finish</span>' ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			 <center><?= $paging ?></center>
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
