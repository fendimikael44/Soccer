<!-- //header -->
<div class="container">
	<ol class="breadcrumb">
		<li><a href="index.php">Home</a></li>
		<li class="active">Lapangan</li>
	</ol>
</div>

<div class="contact">
	<div class="container">
		 <div class="contact-grids">
			<center><h2>List Lapangan</h2></center>	
				<a href="?menu=lapangan&action=detail" class="btn btn-info btn-sm">Tambah</a>
				<table class="table" style="width:100%;">
					<thead>
					  <tr>
						<th scope="col" style="width:5%;">#</th>
						<?php if($_SESSION['role'] == '1'){ ?>
						<th scope="col" style="width:15%;">Nama Arena</th>
						<?php } ?>
						<th scope="col" style="width:25%;">Nama Lapangan</th>
						<th scope="col" style="width:20%;">Harga</th>
						<th scope="col" style="width:30%;">Keterangan</th>				
						<th scope="col" style="width:20%;">Status</th>
					  </tr>
					</thead>
					<tbody>		
						<?php for($i=0;$i<count($data);$i++){ ?>
						<tr <?= $data[$i]['status'] == 1 ? 'class="info"' : '' ?>>
							<td><a href="?menu=lapangan&action=detail&id=<?= $data[$i]['id_lapangan'] ?>" ><?= ($i+1) ?></a></td>
							<?php if($_SESSION['role'] == '1'){ ?>
							<td><?= $data[$i]['nama_arena'] ?></td>
							<?php } ?>
							<td><?= $data[$i]['nama'] ?></td>
							<td><?= $data[$i]['harga'] ?></td>
							<td><?= $data[$i]['deskripsi'] ?></td>					
							<td><?= $data[$i]['status'] == "1" ? '<img src="../images/check.png" style="width:16px; height:16px" />' : '<img src="../images/uncheck.png" style="width:16px; height:16px" />' ?>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			<center><?= $paging ?></center>
		</div>
	</div>
</div>
