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
		  <li><a href="index.php?menu=booking">Booking</a></li>
		  <li class="active">Detail</li>
		 </ol>
</div>
<!-- //header -->
<div class="contact">
	 <div class="container">
		 <div class="contact-grids">
			<h2>Detail Booking <?= $status == 2 ? '<span class="note" style="color:green;">(Canceled)</span>' : ($status == 1 ? '<span class="note" style="color:green;">(Finished)</span>' : '') ?></h2>		 
			<?php if($msg != ""){ ?>
			<div class="alert alert-<?= $alert ?>">
				<center><span><?= $msg ?></span></center>
			</div>
			<?php } ?>
			 <form method="post">					
				<div class="row">
					<div class="form-group col-md-4 col-md-offset-0">
						<label for="lapangan">Lapangan</label>
						<input class="form-control" type="" value="<?= $id_booking ?>" id="id_booking" name="id_booking" style="display:none;" />
						<input class="form-control" type="" value="<?= $status ?>" id="status" name="status" style="display:none;" />
						<select name="lapangan" <?= $status == 0 ? '' : 'disabled' ?> class="form-control" id="lapangan" onchange="loadData(this.value, '2')">
							<option value="0">.: Select :.</option>
							<?php for($i=0;$i<count($d_lapangan);$i++){ ?>
								<option <?= $d_lapangan[$i]['id_lapangan'] == $lapangan ? 'selected' : '' ?> value="<?= $d_lapangan[$i]['id_lapangan'] ?>">
									<?= $d_lapangan[$i]['nama'] ?>
								</option>
							<?php } ?>
						</select>
					</div>					
				</div>
				<div class="row">
					<div class="form-group col-md-3">									
						<label for="tgl">Tanggal</label>						
						<input class="form-control" <?= $status == 0 ? '' : 'disabled' ?> value="<?= $tanggal ?>"  type="" id="tgl" name="tgl" onchange="loadData(this.value, '2')" required />
					</div>
					<div class="form-group col-md-2">
						<label for="jam" id="jam_div">Jam</label>
						<input class="form-control" <?= $status == 0 ? '' : 'disabled' ?> value="<?= $jam ?>"  type="" id="jam" name="jam" onchange="loadData(this.value, '3')" required />							
					</div>
				</div>	
				<div class="row">				
					<div class="form-group col-md-2">
						<label for="durasi">Durasi Main</label>
						<select name="durasi" <?= $status == 0 ? '' : 'disabled' ?> class="form-control" id="durasi">
							<option>.: Select :.</option>
							<?php if($durasi != 0){ ?>
								<option selected value="<?= $durasi ?>"><?= $durasi ?> Jam</option>
							<?php } ?>
						</select>
					</div>
				</div>
				<!--
				<div class="row">						
					<div class="form-group col-md-6">			
						<label for="note">Note</label>						
						<textarea class="form-control" rows="3" name="note" id="note"></textarea>						
					</div>							
				</div>	
				-->
				<input type="submit" name="save" value="SUBMIT" />				  				  
			</form>	
		 </div>
	 </div>
</div>

<script>
	var disableTime = [];
	var jam_buka;
	var jam_tutup;
	
	function reset(){
		document.getElementById("tgl").value = "";	
		document.getElementById("jam").value = "";
		document.getElementById("durasi").innerHTML = "";	
		$('#jam').timepicker('remove');
	}
	
	$("#tgl").datepicker({
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

	function loadData(val, type){	
		var status = 0;
		var message = "";
		var target = "";
		var link = "booking";  
		var id = "";
		var tgl = "";
		var id_booking = document.getElementById("id_booking").value;	
		
		if (type == "1") {
            target = "lapangan";
			id = val;
			reset();
			
			//if(id != "0" && id != ""){
				status = 1;			
			//}
        }
		else if (type == "2") {
            target = "jam_div";
			id = document.getElementById("lapangan").value;
			tgl = document.getElementById("tgl").value;
			
			disableTime = [];
			jam_buka = "";
			jam_tutup = "";
			$('#jam').timepicker('remove');
			document.getElementById("jam").value = "";
			
			if((id != "0" && id != "") && tgl != "") {
				status = 1;
			}		
        }
		else if(type == "3"){
			target = "durasi";	
			if(jam_buka != "" || jam_tutup != ""){
				var jam = val.substring(0, 2);
				var max_durasi = 24;
				var sisa = 0;
				for(var i=0; i<disableTime.length; i++){
					if((disableTime[i][0] / 3600) > jam){
						sisa = ((disableTime[i][0] / 3600) - jam);
						if(max_durasi > sisa){
							max_durasi = sisa;
						}						
					}
				}
				
				if(max_durasi == 24){
					max_durasi = ((jam_tutup.substring(0, 2)) - jam);
				}

				var result = '<option value="0">.: Select :.</option>';
				for(var i=0; i<max_durasi; i++){
					result += '<option value="' + (i+1) + '">' + (i+1) + ' Jam</option>';
				}				
				document.getElementById(target).innerHTML = result;
			}		
		}
		
		if(status == 1){
			if (window.XMLHttpRequest) {
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp = new XMLHttpRequest();
			} else {
				// code for IE6, IE5
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					if(type == "2"){
						var data = JSON.parse(this.responseText);
						changeHour(data);
					}	
					else{
						document.getElementById(target).innerHTML = this.responseText;
					}				
				}
			};
			
			xmlhttp.open("GET","index.php?menu=" + link + "&action=loadData&id_booking=" + id_booking + "&id=" + id + "&tgl=" + tgl + "&type=" + type,true);
			xmlhttp.send(null);   
		}		  
	}
	
	function changeHour(data){	
		console.log(data);
		var counter = data.length;		
		var jam_main;
		var jam_selesai;
		var jam_today = dateValidation(data[0].tgl_book);	
			
		for(var i=0; i<counter; i++){
			jam_buka = data[i].jam_buka;
			jam_tutup = data[i].jam_tutup;
			jam_main = data[i].jam_main;
			jam_selesai = data[i].jam_selesai;
			disableTime[i] = [data[i].jam_main, data[i].jam_selesai];
		}
		
		if(jam_today != 0){
			jam_buka = jam_today + ":00";
		}
		
		$('#jam').timepicker({
			timeFormat: 'H:i',
			step: 60,
			minTime: jam_buka,
			maxTime: jam_tutup,
			disableTimeRanges: disableTime			
		});
	}
	
	function dateValidation(dateInput){
		var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth()+1; //January is 0!
		var yyyy = today.getFullYear();
		var hh = today.getHours();
		if(dd<10) {
			dd = '0'+dd
		} 

		if(mm<10) {
			mm = '0'+mm
		} 

		today = dd + '-' + mm + '-' + yyyy;
		if(today == dateInput){
			return (hh + 1); 
		}
		else{
			return 0;
		}
	}
</script>
