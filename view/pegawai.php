<?php

function ubahDetailPegawai($data) {
	global $conn;

	$id = $data['kode_pegawai'];
    $no_ktp = $data['no_ktp'];
	$nama_pegawai = $data['nama_pegawai'];
	$alamat_pegawai = $data['alamat_pegawai'];
	$id_divisi_pegawai = $data['id_divisi_pegawai'];
	$no_hp = $data['no_hp'];
	$email = $data['email'];

	$dch = "UPDATE pegawai SET 
                no_ktp= '$no_ktp',
				nama_pegawai= '$nama_pegawai',
				alamat_pegawai= '$alamat_pegawai',
				id_divisi_pegawai= '$id_divisi_pegawai',
				handphone= '$no_hp',
				email= '$email'
			WHERE kode_pegawai= '$id'";
	
	mysqli_query($conn, $dch);
	return mysqli_affected_rows($conn);
}

function tambahDetailPegawai($data) {
	global $conn;

	$no_ktp = $data['no_ktp'];
	$nama_pegawai = $data['nama_pegawai'];
	$alamat_pegawai = $data['alamat_pegawai'];
	$id_divisi_pegawai = $data['id_divisi_pegawai'];
	$no_hp = $data['no_hp'];
	$email = $data['email'];

	$dch = "INSERT INTO pegawai VALUES(NULL, '$no_ktp', '$nama_pegawai', '$alamat_pegawai', '$id_divisi_pegawai', '$no_hp', '$email')";
	
	mysqli_query($conn, $dch);
	return mysqli_affected_rows($conn);
}

$divisi = mysqli_query($conn, "SELECT * FROM divisi_pegawai");

$jenis_alert = "";
$alert = "";

if (isset($_POST['usernew'])) {
	if(tambahDetailPegawai($_POST) > 0){
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
	if(ubahDetailPegawai($_POST) > 0){
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
	$dch = "DELETE FROM `pegawai` WHERE `kode_pegawai`='".$_POST['id']."'";
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
		<h1 class="h5 mb-0 text-gray-800">Master Pegawai</h1>
		<a href="#" data-target="#exampleModal2"  data-toggle="modal" class="d-none d-sm-inline-block btn btn-sm btn-primary "><i class="fas fa-plus fa-sm text-white-50"></i>  Tambah Pegawai</a>
	</div>

	<!-- Content Row -->
	<div class="card  ">
		<div class="card-header py-3">
			<h6 class="font-weight-bold text-primary">List Pegawai</h6>

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
						<th>No KTP</th>
						<th>Nama</th>
						<th>Alamat</th>
						<th>Jabatan</th>
						<th>No Hp</th>
						<th>Email</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>#</th>
						<th>No KTP</th>
						<th>Nama</th>
						<th>Alamat</th>
						<th>Jabatan</th>
						<th>No Hp</th>
						<th>Email</th>
						<th>Aksi</th>
					</tr>
				</tfoot>
				<tbody>
					<?php 
						$query = mysqli_query($conn, "SELECT * FROM pegawai LEFT JOIN divisi_pegawai
                                                ON pegawai.id_divisi_pegawai = divisi_pegawai.id_divisi_pegawai");

						$no = 1;
													
						foreach($query as $row) : ?>
						<tr>
							<td class="text-center"><?= $no++ ?></td>
							<td><?= $row['no_ktp'] ?></td>
							<td><?= $row['nama_pegawai'] ?></td>
							<td><?= $row['alamat_pegawai'] ?></td>
							<td><?= $row['divisi'] ?></td>
							<td><?= $row['handphone'] ?></td>
							<td><?= $row['email'] ?></td>
							<td  class="d-flex justify-content-center">
								<div id="<?= $row['kode_pegawai'] ?>" data-target="#edit<?= $row['kode_pegawai'] ?>" data-toggle="modal" class="edit_data btn">
									<i class="fas fa-edit"></i>
								</div>
								<form action="" method="POST">
									<input id="" hidden type="text" class="" value="<?= $row['kode_pegawai'] ?>" name="kode_pegawai" placeholder="" required="required">
									<button type="button" class="btn" name="userdelete" data-target="#delete<?= $row['kode_pegawai'] ?>"  data-toggle="modal">
										<i class="fa fa-trash"></i>
									</button>
								</form>
							</td>
						</tr>

						<div class="modal fade" id="delete<?= $row['kode_pegawai']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
											<input id="" hidden type="text" class="" value="<?= $row['kode_pegawai']; ?>" name="id" placeholder="" required="required">
											<p>Hapus Data <b class="bg-danger p-2 rounded text-light"><?= $row['nama_pegawai'] ?></b> ?</p>
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
					<h5 class="modal-title">Tambah Pegawai</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<div class="form-group">
						<label>No KTP</label>
						<input type="text" name="no_ktp" id="no_ktp" class="form-control">
					</div>
					<div class="form-group">
						<label>Nama Pegawai</label>
						<input type="text" name="nama_pegawai" id="nama_pegawai" class="form-control">
					</div>
                    <div class="form-group">
						<label>Alamat</label>
						<textarea class="form-control" name="alamat_pegawai" id="alamat_pegawai" cols="30" rows="10"></textarea>
					</div>
					<div class="form-group">
						<label>Jabatan</label>
						<div>
							<select class="form-control form-control-line" name="id_divisi_pegawai" id="id_divisi_pegawai" required>
								<option value="">- Pilih -</option>
								<?php foreach ($divisi as $div ) : ?>
									<option value="<?= $div['id_divisi_pegawai'] ?>">
										<?= $div['divisi']?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label>No HP</label>
						<input type="text" name="no_hp" id="no_hp" class="form-control">
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" id="email" class="form-control">
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
<div class="modal fade" id="edit<?= $id['kode_pegawai'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="" method="POST">
				<div class="modal-header">
					<h5 class="modal-title">Pegawai</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<h6 class="font-weight-bold text-primary">Ubah Pegawai</h6>
					<div class="form-group">
						<label>No KTP</label>
						<input value="<?= $id["no_ktp"]?>" type="text" class="form-control" name="no_ktp">
					</div>
					<div class="form-group">
						<label>Nama Pegawai</label>
						<input value="<?= $id["nama_pegawai"]?>" type="text" class="form-control" name="nama_pegawai">
					</div>
                    <div class="form-group">
						<label>Alamat</label>
						<textarea class="form-control" name="alamat_pegawai" id="alamat_pegawai" cols="30" rows="10"><?= $id['alamat_pegawai']?></textarea>
					</div>
					<div class="form-group">
						<input id="" hidden type="text" class="" value="<?= $id['kode_pegawai'] ?>" name="kode_pegawai">
						<label>Jabatan</label>
						<div class="">
							<select class="form-control form-control-line" name="id_divisi_pegawai" id="id_divisi_pegawai" required>
								<option value="<?= $id['id_divisi_pegawai'] ?>">
										Jabatan Saat Ini: <?= $id['divisi']?>
								</option>
								<?php foreach ($divisi as $div ) : ?>
									<option value="<?= $div['id_divisi_pegawai'] ?>">
										<?= $div['divisi']?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="handphone">No HP</label>
						<input value="<?= $id["handphone"]?>" type="text" class="form-control" name="no_hp">
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" id="email" class="form-control" value="<?= $id['email']?>">
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