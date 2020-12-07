<style>
	.note{
		font-weight:bold;
		font-style:italic;
	}
	
	@media print{
		.container{width:100%}		
		.header, .footer, .strip, .breadcrumb, .well, .btn{
			display: none;
		}
	}
</style>

<!-- //header -->
<div class="container">
	<ol class="breadcrumb">
		<li><a href="index.php">Home</a></li>
		<li class="active">Report</li>
	</ol>
</div>

<div class="contact">
	<div class="container">
		 <div class="contact-grids">
			<center><h2>Report Booking</h2></center>					
				<div class="well">
					<form method="get">
						<div class="row">
							<div class="form-group col-md-3">
								<input type="" name="menu" value="report" style="display:none;" />
								<input class="form-control" name="tgl_awal" id="tgl_awal" value="<?= $s_tgl_awal ?>" type="" placeholder="From ..." />							
							</div>
							<div class="form-group col-md-3">							
								<input class="form-control" name="tgl_akhir" id="tgl_akhir" value="<?= $s_tgl_akhir ?>" type="" placeholder="To ..." />							
							</div>
							<div class="col-md-3">	
								<button class="btn btn-success" type="submit" value="search" name="search">Search</button>
							</div>
						</div>						
					</form>				
				</div>
				<button class="btn btn-info pull-right" onclick="window.print();">Print</button>
				<table class="table table-responsive" style="width:100%;">
					<thead>
					  <tr>					
						<?php if($_SESSION['role'] == '1'){ ?>
						<th scope="col">Nama Arena</th>
						<?php } ?>
						<th scope="col">Tanggal / Jam</th>
						<th scope="col">Atas Nama</th>							
						<th scope="col">Lapangan</th>	
						<th scope="col">Invoice</th>	
						<!--<th scope="col"></th>-->
					  </tr>
					</thead>
					<tbody>		
						<?php 
						$invoice = 0;
						$total_invoice = 0;
						for($i=0;$i<count($data);$i++){ 
							$invoice = intval($data[$i]['harga_lapangan']) * intval($data[$i]['durasi']);
							$total_invoice += $invoice;
						?>
						<tr>							
							<?php if($_SESSION['role'] == '1'){ ?>
							<td><?= $data[$i]['nama_arena'] ?></td>
							<?php } ?>
							<td><?= $data[$i]['tanggal_main'] ?> <br/>
							( <?= $data[$i]['jam_main']." - ".$data[$i]['jam_selesai'] ?> )</td>
							<td><?= $data[$i]['nama_customer'] != '' ? $data[$i]['nama_customer'] : '' ?> 
								<br/>
								( <?= $data[$i]['telp'] != '' ? $data[$i]['telp'] : 'Bukan Member' ?> )</td>				
							<td><?= $data[$i]['nama_lapangan'] ?> <br/> ( Rp. <?= number_format($data[$i]['harga_lapangan'],2,',','.') ?> )</td>
							<td>Rp. <?= number_format($invoice,2,',','.') ?></td>
							<!--
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
							-->
						</tr>		
						<?php } ?>
						<tr>
							<th colspan="<?= $_SESSION['role'] == '1' ? 4 : 3 ?>" style="text-align:right;">Total Invoice</th>
							<th>Rp. <?= number_format($total_invoice,2,',','.') ?></th>
						</tr>
					</tbody>
				</table>	
		</div>
	</div>
</div>

<script>
	$("#tgl_awal").datepicker({
		defaultDate: new Date(),
		changeMonth: true,
		changeYear: true,
		//minDate: new Date(),
		numberOfMonths: 1,
		dateFormat: "dd-mm-yy",
		onClose: function(selectedDate) {
			$("#to").datepicker("option", "minDate", selectedDate);
		}
	});	
	
	$("#tgl_akhir").datepicker({
		defaultDate: new Date(),
		changeMonth: true,
		changeYear: true,
		//minDate: new Date(),
		numberOfMonths: 1,
		dateFormat: "dd-mm-yy",
		onClose: function(selectedDate) {
			$("#to").datepicker("option", "minDate", selectedDate);
		}
	});	
</script>
