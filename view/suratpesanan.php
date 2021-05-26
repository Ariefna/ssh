<script>
	function suggest(inputString){
		if(inputString.length == 0) {
			$('#suggestions').fadeOut();
		} else {
			$('#country').addClass('load');
			$.post("autosuggest.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').fadeIn();
					$('#suggestionsList').html(data);
					$('#country').removeClass('load');
				}
			});
		}
	}
	function fill(thisValue) {
		$('#country').val(thisValue);
		setTimeout("$('#suggestions').fadeOut();", 100);
	}
</script>
<?php
date_default_timezone_set("Asia/Jakarta");
$tanggal = date("Y-m-d");


if (isset($_POST['submit'])) {
	$sql = 'SELECT count(*) FROM table_sp WHERE DATE_FORMAT(tanggal,"%Y")='.date("Y");
	$query = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($query);
	$hitung = $row['count(*)'];
	$hitung = $hitung+1;
	$bulan = date('n', strtotime($_POST['tanggal']));
	if ($bulan==1) {
		$romawi="I";
	} elseif ($bulan==2) {
		$romawi="II";
	} elseif ($bulan==3) {
		$romawi="III";
	} elseif ($bulan==4) {
		$romawi="IV";
	} elseif ($bulan==5) {
		$romawi="V";
	} elseif ($bulan==6) {
		$romawi="VI";
	} elseif ($bulan==7) {
		$romawi="VII";
	} elseif ($bulan==8) {
		$romawi="VIII";
	} elseif ($bulan==9) {
		$romawi="IX";
	} elseif ($bulan==10) {
		$romawi="X";
	} elseif ($bulan==11) {
		$romawi="XI";
	} elseif ($bulan==12) {
		$romawi="XII";
	}
	$tahun = date('Y', strtotime($_POST['tanggal']));
	if ($hitung>=1&&$hitung<=9) {
		$kode = "00".$hitung."/SH-SO/".$romawi."/".$tahun;
	} else if ($hitung>=10&&$hitung<=99) {
		$kode = "0".$hitung."/SH-SO/".$romawi."/".$tahun;
	} else if ($hitung>=100&&$hitung<=999) {
		$kode = $hitung."/SH-SO/".$romawi."/".$tahun;
	}

	$number = count($_POST['id_produk'])-1;
	$number2 = count($_POST['koderekening'])-1;
	$dch = "INSERT INTO `table_sp` (kode_sp, kodepl, nopo, diskon, tanggal, tempo, keterangan, status, ppn) VALUES ('".$kode."','".$_POST['kodeplku']."','".$_POST['nopo']."', '".$_POST['diskon']."', '".$_POST['tanggal']."', '".$_POST['tempo']."', '".$_POST['keterangan']."', 0, '".$_POST['valuetambahan0']."')";
	$query = mysqli_query($conn, $dch);
	$last_id = mysqli_insert_id($conn);
	for ($i=0; $i <= $number; $i++) {
		$dch = "INSERT INTO `table_sp_detail` (`id_sp_detail`, `id_produk`, `id_sp`, `harga`, `qty`, `total`, `kode_rekening`) VALUES (NULL, '".$_POST['id_produk'][$i]."', '".$last_id."', '".$_POST['harga'][$i]."', '".$_POST['qty'][$i]."', '".$_POST['total'][$i]."', '".$_POST['akun'][$i]."')";
		$query = mysqli_query($conn, $dch);
		$sql = "INSERT INTO `history_sp_detail` (`id_sp_detail`, `id_produk`, `id_sp`, `harga`, `qty`, `total`, `kode_rekening`) VALUES (NULL, '".$_POST['id_produk'][$i]."', '".$last_id."', '".$_POST['harga'][$i]."', '".$_POST['qty'][$i]."', '".$_POST['total'][$i]."', '".$_POST['akun'][$i]."')";
		mysqli_query($conn, $sql);
	}
	for ($i=0; $i <= $number2; $i++) {
		$sql = "INSERT INTO `tabel_sp_acccount` (`id_sp_account`, `kode_rekening`, `id_sp`, `nominal`) VALUES (NULL, '".$_POST['koderekening'][$i]."', '".$last_id."', '".$_POST['nominal'][$i]."')";
		mysqli_query($conn, $sql);
	}
	if($query){
		$jenis_alert = "success";
		$alert = "Sukses Insert Data";
	}else{
		$jenis_alert = "danger";
		$alert = mysqli_error($conn);
	}
	// echo $jenis_alert;
	echo "<script>alertku('$jenis_alert', '$alert')</script>";
	echo '<script language="javascript">window.location.assign("?page=approve")</script>';
}else {
	$dch = "SELECT AUTO_INCREMENT FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'akutansi_db' AND   TABLE_NAME   = 'table_sp';";
	$query = mysqli_query($conn, $dch);
	$id = mysqli_fetch_array($query);
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h5 mb-0 text-gray-800">Create Sales Order</h1>
	</div>
	<form action="" method="POST" id="suratpesanan" onsubmit="return confirm('Are you sure you want to submit?')">
		<div class="row">
			<div class="col-md-12">
				<div class="card  mb-4">
					<div class="card-header py-3">
						<h6 class="font-weight-bold text-primary">Input Sales Order</h6>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-6">
								<label for="inputAddress">Tanggal</label>
								<input type="date" class="form-control" name="tanggal" onchange="myFunction(this.value)" required>
								<label for="inputAddress">Diskon</label>
								<input type="number" step="0.01" min="0" value="0" max="100" oninput="disk()" class="form-control" id="disks" name="diskon" required>
								<label for="inputAddress">Nama Pelanggan</label>
								<div class="form-row">
									<div class="form-group col-md-12">
										<input autocomplete="off" type="text" class="form-control" onKeyUp="suggest2(this.value);" name="nama"  onBlur="fill2();" id="nama" required>
										<div class="suggestionsBox col-md-12" id="suggestions" style="display: none;">
											<div class="suggestionList" id="suggestionsList" style="cursor: pointer;">&nbsp;</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<!-- <label for="inputAddress">Kode Sales Order</label>
								<input type="text" class="form-control" name="spku" value="
								readonly> -->
								<input type="hidden" class="form-control" id="idsp" name="" value="<?php echo $id[0]; ?>" readonly>
								<label for="inputAddress">Kode Pelanggan</label>
								<input type="text" class="form-control" id="kodepl" name="kodeplku" readonly required>
								<label for="inputAddress">Alamat</label>
								<input type="text" class="form-control" id="alamat" name="Kode_Pelanggan" readonly required>
								<label for="inputAddress">Saldo</label>
								<input type="text" class="form-control" id="saldo" name="saldo" readonly required>
							</div>
							<div class="col-md-12">
								<label for="inputAddress">Nomor PO Customer</label>
								<input type="text" class="form-control" id="" name="nopo" required>
								<label for="inputAddress" style="">Jatuh Tempo (Hari)</label>
								<input style="" class="form-control" name="tempo" type="number" value="0"></input>
								<label for="inputAddress">Keterangan</label>
								<textarea class="form-control" name="keterangan"></textarea>
							</div>
							<div class="col-md-12">
								<br>
								<button type="button" name="add2" id="add2" class="btn btn-success btn-sm">Tambah Akun</button>
								<div class="table-responsive">
									<table class="table bordered" id="dynamic_field2" width="100%" cellspacing="0">
										<thead>
											<tr>
												<th>Kode Akun</th>
												<th>Nama Akun</th>
												<th>Nominal (Rp)</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th colspan="2" style="text-align: right;">Total</th>
												<th colspan="1" id="totalnya">0</th>
												<th></th>
												<th></th>
											</tr>
										</tfoot>

									</table>
								</div>
							</div>
							<div class="col-md-12">
								<br>
								<button type="button" name="add" id="add" class="btn btn-success btn-sm">Tambah Produk</button>
								<div class="table-responsive">
									<table class="table bordered" id="dynamic_field" width="100%" cellspacing="0">
										<thead>
											<tr>
												<th>Kode Produk</th>
												<th>Nama Produk</th>
												<th>Akun Perkiraan</th>
												<th>Harga (Rp)</th>
												<th>Jumlah Pembelian</th>
												<th>Total (Rp)</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th colspan="3" style="text-align:right">Total</th>
												<th id="totqty">0</th>
												<th id="totrp">0</th>
												<th></th>
												<th></th>
											</tr>
											<tr>
												<th colspan="4" style="text-align:right">Diskon</th>
												<th id="disk">0</th>
												<th></th>
												<th></th>
											</tr>
											<?php
											$i=0;
											$query = mysqli_query($conn, "select * from table_tambahan WHERE id_tambahan=2");
											while ($row = mysqli_fetch_array($query)) {
												?>
												<tr>
												<th colspan="4" style="text-align:right"><?php echo $row['nama_tbh']; ?></th>
												<input type="hidden" id="tambahan<?php echo $i; ?>" value="<?php echo $row['persen_tbh']; ?>">
												<input type="hidden" id="valuetambahan<?php echo $i; ?>" name="valuetambahan<?php echo $i++; ?>" value="0">
												<th id="nilai<?php echo $row['id_tambahan']; ?>">0</th>
												<th></th>
												<th></th>
											</tr>
												<?php
											}
											 ?>

											<tr>
												<th colspan="4" style="text-align:right">Netto</th>
												<th id="net">0</th>
												<th></th>
												<th></th>
											</tr>
										</tfoot>
										<?php
										?>
									</table>
								</div>
							</div>
						</div>
						<center><button name="submit" type="submit" class="col-md-3 btn btn-primary" onclick="document.getElementById('suratpesanan').submit();">Simpan</button></center>
					</div>
				</div>
			</div>
		</div>

	</form>
</div>

<script>
	function convertToRupiah(angka)
	{
		var rupiah = '';
		var angkarev = angka.toString().split('').reverse().join('');
		for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
		return rupiah.split('',rupiah.length-1).reverse().join('');
	}
	var c = 0;
	var i=0;
	var c2 = 0;
	var i2=0;
	$('#add2').click(function(){
		i2++;
		$('#dynamic_field2').append('<tr id="row'+i2+'"><td align="center"><input class="text-center" name="koderekening[]" id="kodes'+i2+'" style="width: 100%;border: none;" readonly></td><td align="center"><input type="text" id="nama'+i2+'" style="width: 100%;border: none;background: #fff;" list="browsers2" onchange="sjsj'+i2+'(value);"><datalist id="browsers2"><?php $rdcjn = mysqli_query($conn, "SELECT * FROM `tabel_master` where nama_rekening like 'Kas%' OR nama_rekening like 'Bank%'");while ($rdjc = mysqli_fetch_array($rdcjn)) { echo '<option value="'.$rdjc['kode_rekening']." ".$rdjc['nama_rekening'].'">'; } ?></datalist></td><td align="center"><input type="number" id="nama'+i2+'" name="nominal[]" class="text-center totalsubnya" oninput="disk2'+i2+'()" min="0" style="width: 100%;border: none;background: #fff;" ></td><td align="center"><button type="button" name="remove" id="'+i2+'" class="btn btn-danger btn-sm btn_remove">hapus</button></td></tr>');
		c2=i2;
	});
	$('#add').click(function(){
		i++;
		$('#dynamic_field').append('<tr id="row'+i+'"><td align="center"><input class="text-center" style="width: 100%;border: none;background: #fff;" id="kode_produk'+i+'" name="kode_produk[]" type="text" readonly><input class="text-center" style="width: 100%;border: none;background: #fff;" id="kode'+i+'" name="id_produk[]" type="hidden" readonly></td><td><input onchange="produk'+i+'(value);" list="browsers" style="width: 100%;border: none;"><datalist id="browsers"><?php $rdcjn = mysqli_query($conn, "SELECT * FROM `produk`");while ($rdjc = mysqli_fetch_array($rdcjn)) { echo '<option value="'.$rdjc['nama_produk'].'">'; } ?></datalist></td><td><input type="hidden" name="akun[]" id="kodereknya'+i+'"> <input   id="namanya'+i+'" onchange="koderek1(this.value, '+i+')" list="akun" style="width: 100%;border: none;"/><datalist id="akun"><?php $rdcjn = mysqli_query($conn, "SELECT * FROM `akun_perkiraan`");while ($rdjc = mysqli_fetch_array($rdcjn)) { echo '<option value="'.$rdjc['kode_perkiraan'].': '.$rdjc['uraian'].'">'; } ?></datalist></td><td><input class="text-center" style="width: 100%;border: none;background: #fff;" id="harga'+i+'" name="harga[]" type="text" readonly></td><td><input class=" text-center qty" min="0" value="0" style="width: 100%;border: none;" type="number" id="qty'+i+'" name="qty[]" oninput="sum'+i+'();"></td><td><input class="text-center tot" style="width: 100%;border: none;background: #fff;" id="total'+i+'" name="total[]" type="text" readonly></td><td align="center"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn-sm btn_remove">hapus</button></td></tr>');
		c=i;
	});

	$(document).on('click', '.btn_remove', function(){
		var button_id = $(this).attr("id");
		$('#row'+button_id+'').remove();
	});
	function suggest2(inputString){
		if(inputString.length == 0) {
			$('#suggestions').fadeOut();
		} else {
			$('#country').addClass('load');
			$.post("autosuggest.php", {pelanggan: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').fadeIn();
					$('#suggestionsList').html(data);
					$('#country').removeClass('load');
				}
			});
		}
	}

	function disk(){
		var sum2 = $('#totrp').text();
		disk = $('#disks').val();
		disk = sum2/100*disk;
		$('#disk').text(disk);
		var tot = sum2-disk;
		$('#net').text(tot);
	}

	<?php
	for ($i=1; $i <= 1000; $i++) {
		?>
		function produk<?php echo $i; ?>(value){
			$.ajax({
				type: "POST",
				url: "autosuggest.php",
				data: {
					produk: value
				},
				success: function (data) {
					var json = JSON.parse(data);
					$('#harga<?php echo $i; ?>').val(json.harga_produk);
					$('#kode<?php echo $i; ?>').val(json.id_produk);
					$('#kode_produk<?php echo $i; ?>').val(json.kode_produk);
				}
			});
		}
		function sum<?php echo $i; ?>(value){
			var harga = $('#harga<?php echo $i; ?>').val();
			var qty = $('#qty<?php echo $i; ?>').val();
			$('#total<?php echo $i; ?>').val(harga*qty);
			var sum = 0;
			var sum2 = 0;
			$('.qty').each(function(){
				var input = $(this).val();
				if($.isNumeric(input)){
					sum += parseFloat(input);
				}
			});
			$('.tot').each(function(){
				var input = $(this).val();
				if($.isNumeric(input)){
					sum2 += parseFloat(input);
				}
			});
			$('#totqty').text(sum);
			$('#totrp').text(convertToRupiah(sum2));
			disk = $('#disks').val();
			disk = sum2/100*disk;
			$('#disk').text(convertToRupiah(disk));
			var tot = sum2-disk;
			var ppn;
			ppn = $('#tambahan0').val();
			$('#nilai2').text(convertToRupiah(tot*(ppn/100)));
			$('#valuetambahan0').val(tot*(ppn/100));
			$('#net').text(convertToRupiah(tot+(tot*(ppn/100))));
		}
		function disk2<?php echo $i; ?>(value){
			var jumlahk = 0;
			$('.totalsubnya').each(function(){
				var input = $(this).val();
				if($.isNumeric(input)){
					jumlahk += parseFloat(input);
				}
			});
			$('#totalnya').text(convertToRupiah(jumlahk));

		}
		<?php
	}
	?>
	function pelanggan(nama, saldo, alamat, kodepl) {
		$('#nama').val(nama);
		$('#kodepl').val(kodepl);
		$('#saldo').val(saldo);
		$('#alamat').val(alamat);
		setTimeout("$('#suggestions').fadeOut();", 100);
	}
	function koderek1(value, int) {
		$.ajax({
				type: "POST",
				url: "autosuggest.php?koderek1=1",
				data: {
					rek: value
				},
				success: function (data) {
					var json = JSON.parse(data);
					$("#kodereknya"+int).val(json.kode);
					$("#namanya"+int).val(json.nama);
				}
			});
	}
	<?php
	for ($i=1; $i <= 1000; $i++) {
		?>
		function sjsj<?php echo $i; ?>(value){
			$.ajax({
				type: "POST",
				url: "autosuggest.php?koderek=1",
				data: {
					rek: value
				},
				success: function (data) {
					var json = JSON.parse(data);
					$('#kodes<?php echo $i; ?>').val(json.kode);
					$('#nama<?php echo $i; ?>').val(json.nama);
				}
			});
		}
	<?php } ?>

</script>
