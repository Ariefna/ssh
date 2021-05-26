<?php

function tambahAdmin($data) {
	global $conn;

	$nama = $data['nama'];
	$username = $data['username'];
	$password = $data['password'];
	$id_hak_akses = $data['id_hak_akses'];

	$dch = "INSERT INTO tabel_admin VALUES(NULL, '$nama', '$username', '$password', NULL, '$id_hak_akses')";
	
	mysqli_query($conn, $dch);
	return mysqli_affected_rows($conn);
}

if (isset($_POST['usernew'])) {
	// $dch = "INSERT INTO `tabel_admin` (`id_admin`, `nama`, `username`, `password`, `id_hak_akses`) VALUES (NULL, '".$_POST['nama']."', '".$_POST['username']."', '".md5($_POST['password'])."', '".$_POST['id_hak_akses']."')";
	// $query = mysqli_query($conn, $dch);
	// // echo $dch;
	if(tambahAdmin($_POST) > 0){
		$_SESSION['sukses'] = true;
		$jenis_alert = "success";
		$alert = "Data Berhasil Di Tambah";
	}else{
		$jenis_alert = "danger";
		echo mysqli_error($conn);
	}
}
if (isset($_POST['useredit'])) {
	if ($_POST['password']=="") {
		$dch = "UPDATE `tabel_admin` SET `nama`='".$_POST['nama']."',`username`='".$_POST['username']."',`id_hak_akses`='".$_POST['id_hak_akses']."' WHERE `id_admin`='".$_POST['id']."'";
	} else {
		$dch = "UPDATE `tabel_admin` SET `nama`='".$_POST['nama']."',`username`='".$_POST['username']."',`password`='".md5($_POST['password'])."',`id_hak_akses`='".$_POST['id_hak_akses']."' WHERE `id_admin`='".$_POST['id']."'";
	}
	$query = mysqli_query($conn, $dch);
	if($query){
		$jenis_alert = "success";
		$alert = "Sukses Edit Data";
	}else{
		$jenis_alert = "danger";
		$alert = mysqli_error($conn);
	}
	echo "<script>alertku('$jenis_alert', '$alert')</script>";
}
if (isset($_POST['userdelete'])) {
	$dch = "DELETE FROM `tabel_admin` WHERE `id_admin`='".$_POST['id']."'";
	$query = mysqli_query($conn, $dch);
	// echo $dch;
	if($query){
		$jenis_alert = "success";
		$alert = "Sukses Delete Data";
	}else{
		$jenis_alert = "danger";
		$alert = mysqli_error($conn);
	}
	echo "<script>alertku('$jenis_alert', '$alert')</script>";
}
 ?>
<div class="container-fluid">
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h5 mb-0 text-gray-800">Master Karyawan</h1>
		<a href="#" data-target="#exampleModal2"  data-toggle="modal" class="d-none d-sm-inline-block btn btn-sm btn-primary "><i class="fas fa-plus fa-sm text-white-50"></i>  Tambah Karyawan</a>
	</div>

	<!-- Content Row -->
	<div class="card  ">
		<div class="card-header py-3">
			<h6 class="font-weight-bold text-primary">List Data Karyawan</h6>
			<?php if (isset($_SESSION["sukses"])) : ?>
					<div class="alert alert-success" role="alert">Data Berhasil Ditambahkan</div>
					<?php unset($_SESSION["sukses"]);?>
			<?php endif;?>
		</div>
		<div class="card-body">
			<table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Username</th>
						<th>Akses</th>
						<th>Last Visit Date</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Username</th>
						<th>Akses</th>
						<th>Last Visit Date</th>
						<th>Aksi</th>
					</tr>
				</tfoot>
				<tbody>
					<?php
					$query = mysqli_query($conn, "SELECT * FROM tabel_admin INNER JOIN hak_akses ON tabel_admin.id_hak_akses = hak_akses.id_hak_akses");
					$hak_akses = mysqli_query($conn, "SELECT * FROM hak_akses");
					$no = 1; ?>
					<?php foreach($query as $row) : ?>
						<tr>
							<td style="text-align: center;"><?= $no ?></td>
							<td><?= $row['nama'] ?></td>
							<td><?= $row['username'] ?></td>
							<td><?= $row['hak_akses'] ?></td>
							<td style="text-align: center;"><?= $row['tanggal'] ?></td>
							<td class="d-flex justify-content-center">
								<div id="<?= $row['id_admin'] ?>" data-target="#edit<?= $row['id_admin'] ?>" data-toggle="modal" class="btn edit_data">
									<i class="fas fa-edit"></i>
								</div>
								<form action="" method="POST">
									<input id="" hidden type="text" class="" value="<?= $row['id_admin'] ?>" name="id" placeholder="" required="required">
										<button type="button" name="userdelete" data-target="#delete<?= $row['id_admin'] ?>"  data-toggle="modal" class="btn">
											<i class="Danger fa fa-trash"></i>
										</button>
								</form>
							</td>
						</tr>

						<div class="modal fade" id="delete<?= $row['id_admin']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
											<input id="" hidden type="text" class="" value="<?= $row['id_admin']; ?>" name="id" placeholder="" required="required">
											<p>Apakah Anda yakin untuk menghapus data?</p>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
											<button id="" name="userdelete" type="submit" class="btn btn-primary">Delete</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<?php $no++;?>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>


<?php foreach ($query as $id) : ?>
<!-- Modal Ubah -->
<div class="modal fade" id="edit<?= $id['id_admin'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="" method="POST">
				<div class="modal-header">
					<h5 class="modal-title">Detail Karyawan</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<h6 class="font-weight-bold text-primary">Detail Karyawan</h6>
					<div class="form-group">
						<label>Nama</label>
						<input id="" type="text" hidden class="form-control" value="<?= $id['id_admin'] ?>" name="id" placeholder="" required="required">
						<input id="" type="text" class="form-control" placeholder="" value="<?= $id['nama'] ?>" name="nama" required="required">
					</div>
					<div class="form-group">
						<label>Username</label>
						<input id="" type="text" class="form-control" name="username" value="<?= $id['username'] ?>" required="required">
					</div>
					<div class="form-group">
						<label>New Password</label>
						<input id="" type="Password" class="form-control" name="password">
					</div>
					<div class="form-group">
						<label>Hak Akses</label>
						<select name="id_hak_akses" id="akses" class="form-control" required="required">
							<option value="<?= $id['id_hak_akses'] ?>">
								Hak Akses Saat Ini: <?= $id['hak_akses'] ?>
							</option>
							<?php foreach ($hak_akses as $akses) : ?>
								<option value="<?= $akses['id_hak_akses'] ?>"><?= $akses['hak_akses'] ?></option>
							<?php endforeach; ?> 
						</select>
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

<!-- start modal new user -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="" method="POST" onsubmit="return confirm('Are you sure you want to submit?')">
				<div class="modal-header">
					<h5 class="modal-title">Tambah Karyawan</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<div class="form-group">
						<label>Nama</label>
						<input id="" type="text" class="form-control" placeholder="" name="nama" required="required">
					</div>
					<div class="form-group">
						<label>Username</label>
						<input id="" type="text" class="form-control" name="username" required="required">
					</div>
					<div class="form-group">
						<label>Password</label>
						<input id="" type="Password" class="form-control" name="password" placeholder="" required="required">
					</div>
					<div class="form-group">
						<label>Confirm Password</label>
						<input type="Password" class="form-control" placeholder="" required="required">
					</div>
					<div class="form-group">
						<label>Hak Akses</label>
						<select name="id_hak_akses" id="akses" class="form-control" required="required">
							<option value="">- Pilih -</option>
							<?php foreach ($hak_akses as $akses) : ?>
								<option value="<?= $akses['id_hak_akses'] ?>"><?= $akses['hak_akses'] ?></option>
							<?php endforeach; ?> 
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button id="" name="usernew" type="submit" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
	if ( window.history.replaceState ) {
		window.history.replaceState( null, null, window.location.href );
	}
</script>
