<?php

function ubahDataGudang($data) {
	global $conn;

	$id = $data['id_gudang'];
    $stock = $data['stock'];
	$opname = $data['opname'];
	
	$dch = "UPDATE gudang SET 
                stock= '$stock',
				opname= '$opname'
			WHERE id_gudang= '$id'";
	
	mysqli_query($conn, $dch);
	return mysqli_affected_rows($conn);
}

function tambahDataGudang($data) {
	global $conn;

	$stock = $data['stock'];
	$opname = $data['opname'];

	$dch = "INSERT INTO gudang VALUES(NULL, '$stock', '$opname')";
	
	mysqli_query($conn, $dch);
	return mysqli_affected_rows($conn);
}

$jenis_alert = "";
$alert = "";

if (isset($_POST['usernew'])) {
	if(tambahDataGudang($_POST) > 0){
		$_SESSION['sukses'] = true;
		$jenis_alert = "success";
		$alert = "Data Berhasil Di Tambah";
	}else{
		$gagal = true;
		$jenis_alert = "danger";
		$alert = "Data Gagal Di Tambah";
	}
}
if (isset($_POST['useredit'])) {
	if(ubahDataGudang($_POST) > 0){
		$_SESSION['sukses'] = true;
		$jenis_alert = "success";
		$alert = "Data Berhasil Di Ubah";
	}else{
		$gagal = true;
		$jenis_alert = "danger";
		$alert = "Data Gagal Di Ubah";
	}
}
if (isset($_POST['userdelete'])) {
	$dch = "DELETE FROM `gudang` WHERE `id_gudang`='".$_POST['id']."'";
	$hapus = mysqli_query($conn, $dch);
	// echo $dch;
	if($hapus){
		$_SESSION['sukses'] = true;
		$jenis_alert = "success";
		$alert = "Data Berhasil Di Hapus";
	}else{
		$gagal = true;
		$jenis_alert = "danger";
		$alert = "Data Gagal Di Hapus";
	}
}
 ?>
<div class="container-fluid">
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h5 mb-0 text-gray-800">Master Gudang</h1>
		<a href="#" data-target="#exampleModal2"  data-toggle="modal" class="d-none d-sm-inline-block btn btn-sm btn-primary "><i class="fas fa-plus fa-sm text-white-50"></i>  Tambah Gudang</a>
	</div>

	<!-- Content Row -->
	<div class="card  ">
		<div class="card-header py-3">
			<h6 class="font-weight-bold text-primary">List Data Gudang</h6>

			<?php if (isset($_SESSION["sukses"])) : ?>
					<div class="alert alert-success" role="alert">Data Berhasil Ditambahkan</div>
					<?php unset($_SESSION["sukses"]);?>
			<?php endif;?>

			<!-- <?php if (isset($sukses) or isset($gagal)) : ?>
				<div class="alert alert-<?= $jenis_alert ?>" role="alert">
					<?= $alert ?>
				</div>
			<?php endif; ?> -->
		</div>
		<div class="card-body">
			<table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>#</th>
						<th>Stock</th>
						<th>Opname</th>
                        <th>Aksi</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>#</th>
						<th>Stock</th>
						<th>Opname</th>
                        <th>Aksi</th>
					</tr>
				</tfoot>
				<tbody>
					<?php 
						$query = mysqli_query($conn, "SELECT * FROM gudang");

						$no = 1;
													
						foreach($query as $row) : ?>
						<tr>
							<td class="text-center"><?= $no++ ?></td>
							<td><?= $row['stock'] ?></td>
							<td><?= $row['opname'] ?></td>
							<td  class="d-flex justify-content-center">
								<div id="<?= $row['id_gudang'] ?>" data-target="#edit<?= $row['id_gudang'] ?>" data-toggle="modal" class="edit_data btn">
									<i class="fas fa-edit"></i>
								</div>
								<form action="" method="POST">
									<input id="" hidden type="text" class="" value="<?= $row['id_gudang'] ?>" name="id_gudang" placeholder="" required="required">
									<button type="button" class="btn" name="userdelete" data-target="#delete<?= $row['id_gudang'] ?>"  data-toggle="modal">
										<i class="fa fa-trash"></i>
									</button>
								</form>
							</td>
						</tr>

						<div class="modal fade" id="delete<?= $row['id_gudang']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<form action="" method="POST">
										<div class="modal-header">
											<h5 class="modal-title">Perhatian!</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<input id="" hidden type="text" class="" value="<?= $row['id_gudang']; ?>" name="id" placeholder="" required="required">
											<p>Hapus Data ?</p>
                                            <!-- <b class="bg-danger p-2 rounded text-light"><?= $row['nama_pegawai'] ?></b> -->
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
											<button id="" name="userdelete" type="submit" class="btn btn-primary">Hapus</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="" method="POST" onsubmit="return confirm('Are you sure you want to submit?')">
				<div class="modal-header">
					<h5 class="modal-title">Tambah Data Gudang</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Stock</label>
						<input type="number" name="stock" id="stock" class="form-control">
					</div>
					<div class="form-group">
						<label>Opname</label>
						<input type="text" name="opname" id="opname" class="form-control">
					</div>
				</div>
				<div class="modal-footer">
					<button id="" name="usernew" type="submit" class="btn btn-primary">Tambah</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Akhir Modal Tambah -->

<?php foreach ($query as $id) : ?>
<!-- Modal Ubah -->
<div class="modal fade" id="edit<?= $id['id_gudang'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="" method="POST">
            <input id="" hidden type="text" class="" value="<?= $id['id_gudang'] ?>" name="id_gudang">
				<div class="modal-header">
					<h5 class="modal-title">Gudang</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<h6 class="font-weight-bold text-primary">Ubah Data Gudang</h6>
					<div class="form-group">
						<label>Stock</label>
						<input value="<?= $id["stock"]?>" type="text" class="form-control" name="stock">
					</div>
					<div class="form-group">
						<label>Opname</label>
						<input value="<?= $id["opname"]?>" type="text" class="form-control" name="opname">
					</div>
				</div>
				<div class="modal-footer">
					<button id="" name="useredit" type="submit" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Akhir Modal Ubah -->
<?php endforeach; ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
	if ( window.history.replaceState ) {
		window.history.replaceState( null, null, window.location.href );
	}
</script>