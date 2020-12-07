<!-- //header -->
<div class="container">
	<ol class="breadcrumb">
		<li><a href="index.php">Home</a></li>
		<li class="active">Info Arena</li>
	</ol>
</div>

<div class="contact">
	<div class="container">
		 <div class="contact-grids">
			<center><h2>Info Arena</h2></center>	
				<?php if($_SESSION['role'] == "1"){ ?>
				<a href="?menu=arena&action=detail" class="btn btn-info btn-sm">Tambah</a>
				<?php } ?>
				<table class="table" style="width:100%;">
					<thead>
					  <tr>
						<th scope="col" style="width:5%;">#</th>					
						<th scope="col" style="width:15%;">Nama Arena</th>					
						<th scope="col" style="width:25%;">Alamat</th>
						<th scope="col" style="width:10%;">No. Telepon</th>
						<th scope="col" style="width:15%;">Jam Operasional</th>
						<th scope="col" style="width:25%;">Info</th>				
						<th scope="col" style="width:5%;"></th>
					  </tr>
					</thead>
					<tbody>		
						<?php for($i=0;$i<count($data);$i++){ ?>
						<tr <?= $data[$i]['status'] == 1 ? 'class="info"' : '' ?>>
							<td><a href="?menu=arena&action=detail&id=<?= $data[$i]['id_arena'] ?>" ><?= ($i+1) ?></a></td>
							<td><?= $data[$i]['nama_arena'] ?> (<?= $data[$i]['nama_user'] ?>)</td>
							<td><?= $data[$i]['alamat'] ?></td>
							<td><?= $data[$i]['telp'] ?></td>
							<td><?= $data[$i]['jam_operational'] ?></td>
							<td><?= $data[$i]['info'] ?></td>
							<td><?= $data[$i]['status'] == "1" ? '<img src="../images/check.png" style="width:16px; height:16px" />' : '<img src="../images/uncheck.png" style="width:16px; height:16px" />' ?>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			<center><?= $paging ?></center>
		</div>
	</div>
</div>
