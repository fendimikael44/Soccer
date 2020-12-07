<!-- //header -->
<div class="container">
	<ol class="breadcrumb">
		<li><a href="index.php">Home</a></li>
		<li class="active">Promo</li>
	</ol>
</div>

<div class="contact">
	<div class="container">
		 <div class="contact-grids">
			<center><h2>List Promo</h2></center>	
				<a href="?menu=promo&action=detail" class="btn btn-info btn-sm">Tambah</a>
				<table class="table" style="width:100%;">
					<thead>
					  <tr>
						<th scope="col" style="width:5%;">#</th>
						<?php if($_SESSION['role'] == '1'){ ?>
						<th scope="col" style="width:10%;">Nama Arena</th>
						<?php } ?>
						<th scope="col" style="width:25%;">Periode Promosi</th>
						<th scope="col" style="width:20%;">Title</th>
						<th scope="col" style="width:30%;">Description</th>				
						<th scope="col" style="width:20%;"></th>
					  </tr>
					</thead>
					<tbody>		
						<?php for($i=0;$i<count($data);$i++){ ?>
						<tr <?= $data[$i]['status'] == 1 ? 'class="info"' : '' ?>>
							<td><a href="?menu=promo&action=detail&id=<?= $data[$i]['id_promo'] ?>" ><?= ($i+1) ?></a></td>
							<?php if($_SESSION['role'] == '1'){ ?>
							<td><?= $data[$i]['nama_arena'] ?></td>
							<?php } ?>
							<td><?= $data[$i]['periode_awal'] ?> <b>s/d</b> <?= $data[$i]['periode_akhir'] ?></td>
							<td><?= $data[$i]['judul'] ?></td>
							<td><?= $data[$i]['deskripsi'] ?></td>					
							<td>
								<form method="post"> 
									<input style="display:none;" type="text" name="id_promo" value="<?= $data[$i]['id_promo'] ?>" />
									<button type="submit" name="posting" <?= $data[$i]['status'] == 1 ? 'disabled' : '' ?> class="btn btn-xs btn-success">Posting</button>
									<button type="submit" name="unposting" <?= $data[$i]['status'] == 0 ? 'disabled' : '' ?> class="btn btn-xs btn-danger">Unposting</button>
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
