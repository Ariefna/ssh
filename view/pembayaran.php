<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h5 mb-0 text-gray-800">Tagihan Pembayaran</h1>
	</div>
	<form action="">
		<div class="row">
			<div class="col-md-12">
				<div class="card  mb-4">
					<div class="card-header py-3">
						<h6 class="font-weight-bold text-primary">List Tagihan</h6>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<div class="table-responsive">
									<table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
										<thead>
											<tr>
												<th>No</th>
												<th>Kode Pelanggan</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tfoot>
											<th>No</th>
											<th>Kode Pelanggan</th>
											<th>Aksi</th>
										</tfoot>
										<?php
										$djndn = "SELECT kodepl, tanggal, sum(qty) FROM table_kodesj k join table_sj s on k.id_sj=s.id_sj join table_sj_detail d on s.id_sj=d.id_sj group by kodepl order by kodepl asc";
										$dj = mysqli_query($conn, $djndn);
										$i=1;
										while ($jdbvj = mysqli_fetch_array($dj)) {
											echo '<tr>
											<td align="center">'.$i.'</td>
											<td align="center">'.$jdbvj['kodepl'].'</td>
											<td class="text-center"><a href="?page=form_pembayaran&kodepl='.$jdbvj['kodepl'].'" class="" target="" style="margin-right:5px"><i class="fas fa-fw fa-edit"></i></a></td>
											</tr>';
											$i++;
										}
										?>

									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
