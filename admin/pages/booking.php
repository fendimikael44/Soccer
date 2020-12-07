<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style>
	.note{
		font-weight:bold;
		font-style:italic;
	}
</style>

<!-- //header -->
<div class="container">
	<ol class="breadcrumb">
		<li><a href="index.php">Home</a></li>
		<li class="active">Booking</li>
	</ol>
</div>

<div class="contact">
	<div class="container">
		 <div class="contact-grids">
			<center><h2>Booking Maintenance</h2></center>		
				<?php if($finish_message != ""){ ?>
				<div class="alert alert-<?= $finish_alert ?>">
					<center><span><?= $finish_message ?></span></center>
				</div>
				<?php } ?>
				<a href="?menu=booking&action=detail" class="btn btn-info btn-sm">Tambah</a><br/><br/>
				<div class="well">
					<form method="get">
						<div class="row">
							<div class="form-group col-md-6">
								<input type="" name="menu" value="booking" style="display:none;" />
								<input class="form-control" name="customer" id="customer" value="<?= $s_customer ?>" type="" placeholder="Nama Customer ..." />
							</div>
							<div class="col-md-3">	
								<button class="btn btn-success" type="submit" value="search" name="search">Search</button>
							</div>
						</div>						
					</form>
				</div>
				<table class="table table-hover" style="width:100%;">
					<thead>
					  <tr>
						<th scope="col" style="width:5%;">#</th>
						<?php if($_SESSION['role'] == '1'){ ?>
						<th scope="col" style="width:15%;">Nama Arena</th>
						<?php } ?>
						<th scope="col" style="width:15%;">Tanggal / Jam</th>
						<th scope="col" style="width:10%;">Durasi</th>
						<th scope="col" style="width:15%;">Lapangan</th>
						<th scope="col" style="width:25%;">Atas Nama</th>	
						<th scope="col" style="width:15%;">Pembayaran DP</th>			
						<th scope="col" style="width:20%;"></th>
					  </tr>
					</thead>
					<tbody>		
						<?php for($i=0;$i<count($data);$i++){ ?>
						<tr>
							<td><a href="?menu=booking&action=detail&id=<?= $data[$i]['id_booking'] ?>" ><?= $data[$i]['id_booking'] ?></a></td>
							<?php if($_SESSION['role'] == '1'){ ?>
							<td><?= $data[$i]['nama_arena'] ?></td>
							<?php } ?>
							<td><?= $data[$i]['tanggal_main'] ?> <b>/</b> <?= $data[$i]['jam_main'] ?></td>
							<td><?= $data[$i]['durasi'] ?> Jam</td>
							<td><?= $data[$i]['nama_lapangan'] ?></td>
							<td><?= $data[$i]['nama_customer'] != '' ? $data[$i]['nama_customer'] : '' ?> 
								( <?= $data[$i]['telp'] != '' ? $data[$i]['telp'] : 'Bukan Member' ?> )</td>
							<td>
								<?php 
									if($data[$i]['status_pembayaran'] == ""){ 
										echo "-";
									}
									elseif($data[$i]['status_pembayaran'] == 0){ ?>
										<div class="text-center">
								<a href="" class="btn btn-info btn-rounded mb-4 btn-sm" data-toggle="modal" data-target="#pembayaran_<?= $data[$i]['id_booking'] ?>" >View</a>
								<div id="pembayaran_<?= $data[$i]['id_booking'] ?>" class="modal fade in">
									<form method="post" enctype="multipart/form-data">
									<div class="modal-dialog">
										<div class="modal-content">		 
											<div class="modal-header">											
												<h4 class="modal-title">Bukti Pembayaran</h4>
											</div>
											<div class="modal-body">	
												<div class="row">
													<div class="form-group col-md-6 col-md-offset-3">
														<label>No Rekening : </label>
														<?= $data[$i]['no_rek'] ?>
														<input value="<?= $data[$i]['id_pembayaran'] ?>" name="id_pembayaran" class="form-control" style="display:none;">
													</div>	
												</div>
												<div class="row">
													<div class="form-group col-md-6 col-md-offset-3">
														<label>Nama Rekening : </label>
														<?= $data[$i]['atas_nama'] ?>
													</div>	
												</div>	
												<div class="row">
													<div class="form-group col-md-6 col-md-offset-3">
														<label>Nama Bank : </label>
														<span><?= $data[$i]['bank'] ?></span>
													</div>	
												</div>
												<div class="row">
													<div class="form-group col-md-6 col-md-offset-3">
														<img id="preview" src="../<?= $data[$i]['foto_upload'] ?>" alt="your image" style="width:100%; height:100%" />
													</div>	
												</div>												
											</div>
											<div class="modal-footer">
												<div class="row">		
													<div class="col-md-6"> 
														<span style="color: red"> 
															*Mininal pembayaran DP 30 % (Rp. <?=	
																number_format(floor($data[$i]['minimal_dp']),2,",",".") ?>)
														</span>
													</div>
													<div class="col-md-6">	
														<button class="btn btn-warning" data-dismiss="modal">Cancel</button>
														<button class="btn btn-danger" type="submit" name="reject">Reject</button>
														<button class="btn btn-success" type="submit" name="approve">Approve</button>
													</div>	
												</div>

											</div>	 
										</div>
									</div>
									</form>
								</div>
							</div>
									<?php }
									elseif($data[$i]['status_pembayaran'] == 1){
										echo '<span style="color:Green;">Lunas</span>';
									}
								?>
							</td>					
							<td>
								<form method="post"> 
									<input style="display:none;" type="text" name="id_booking" value="<?= $data[$i]['id_booking'] ?>" />
									<?php if($data[$i]['status'] == '0'){ ?>
									<button type="submit" name="finish" class="btn btn-xs btn-success">Finish</button>
									<button type="submit" name="cancel" class="btn btn-xs btn-danger">Cancel</button>
									<?php } elseif($data[$i]['status'] == '1'){ ?>
										<span class="note" style="color:green;">Finished</span>
									<?php } elseif($data[$i]['status'] == '3'){ ?>
										<span class="note" style="color:red;">Canceled</span>
									<?php } ?>
								</form>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			<center><?= $paging ?></center>
		</div>
	</div>
</div>
