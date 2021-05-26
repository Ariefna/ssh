<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h5 mb-0 text-gray-800">Approve Purchase Order</h1>
	</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card  mb-4">
					<div class="card-header py-3">
						<h6 class="font-weight-bold text-primary">List Approve Purchase Order</h6>
					</div>
					<div class="card-body">
						<form class="" action="?page=approvep" method="post">
							<button class="btn btn-primary" type="submit" name="belum">Belum Approve</button>
							<button class="btn btn-primary" type="submit" name="approve">Approve</button>
						</form>

						<div class="row">
							<div class="col-md-12">
								<div class="table-responsive">
									<table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
										<thead>
											<tr>
												<th>No</th>
												<th>Kode Purchase Order</th>
												<th>Tanggal</th>
												<th>Jumlah Pembelian</th>
												<th>Status</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<?php
										if (isset($_POST['belum'])) {
											$djndn = "SELECT a.id_spp, kode_spp, DATE_FORMAT(tanggal, '%d %M %Y') as tanggal, status, sum(qty) FROM table_spp_detail a join table_spp b on a.id_spp = b.id_spp group by a.id_spp having status=0 order by id_spp desc";
											$dj = mysqli_query($conn, $djndn);
											$i=1;
											while ($jdbvj = mysqli_fetch_array($dj)) {
												if ($jdbvj['status']==0) {
													$sts="Belum Approve";
													$btn="hidden";
												} else {
													$sts="Approved";
													$btn="";
												}
												echo '<tr>
												<td align="center">'.$i.'</td>
												<td align="center">'.$jdbvj['kode_spp'].'</td>
												<td align="center">'.$jdbvj['tanggal'].'</td>
												<td align="center">'.$jdbvj['sum(qty)'].'</td>
												<td align="center">'.$sts.'</td>
												<td class="text-center"><a href="spp.php?kode_spp='.$jdbvj['id_spp'].'" class="" target="_blank" style="margin-right:5px" '.$btn.'><i class="fas fa-fw fa-print"></i></a><a href="?page=createapprovep&spp='.$jdbvj['id_spp'].'" class=""><i class="fas fa-fw fa-eye"></i></a></td>
												</tr>';
												$i++;
											}
										} elseif (isset($_POST['approve'])) {
											$djndn = "SELECT a.id_spp, kode_spp, DATE_FORMAT(tanggal, '%d %M %Y') as tanggal, status, sum(qty) FROM table_spp_detail a join table_spp b on a.id_spp = b.id_spp group by a.id_spp having status=1 order by id_spp desc";
											$dj = mysqli_query($conn, $djndn);
											$i=1;
											while ($jdbvj = mysqli_fetch_array($dj)) {
												if ($jdbvj['status']==0) {
													$sts="Belum Approve";
													$btn="hidden";
												} else {
													$sts="Approved";
													$btn="";
												}
												echo '<tr>
												<td align="center">'.$i.'</td>
												<td align="center">'.$jdbvj['kodepl'].'</td>
												<td align="center">'.$jdbvj['tanggal'].'</td>
												<td align="center">'.$jdbvj['sum(qty)'].'</td>
												<td align="center">'.$sts.'</td>
												<td class="text-center"><a href="spp.php?kode_spp='.$jdbvj['id_spp'].'" class="" target="_blank" style="margin-right:5px" '.$btn.'><i class="fas fa-fw fa-print"></i></a><a href="?page=createapprovep&spp='.$jdbvj['id_spp'].'" class=""><i class="fas fa-fw fa-eye"></i></a></td>
												</tr>';
												$i++;
											}
										} else {
											$djndn = "SELECT a.id_spp, kode_spp, DATE_FORMAT(tanggal, '%d %M %Y') as tanggal, status, sum(qty) FROM table_spp_detail a join table_spp b on a.id_spp = b.id_spp group by a.id_spp order by id_spp desc";
											$dj = mysqli_query($conn, $djndn);
											$i=1;
											while ($jdbvj = mysqli_fetch_array($dj)) {
												if ($jdbvj['status']==0) {
													$sts="Belum Approve";
													$btn="hidden";
												} else {
													$sts="Approved";
													$btn="";
												}
												echo '<tr>
												<td align="center">'.$i.'</td>
												<td align="center">'.$jdbvj['kode_spp'].'</td>
												<td align="center">'.$jdbvj['tanggal'].'</td>
												<td align="center">'.$jdbvj['sum(qty)'].'</td>
												<td align="center">'.$sts.'</td>
												<td class="text-center"><a href="spp.php?kode_spp='.$jdbvj['id_spp'].'" class="" target="_blank" style="margin-right:5px" '.$btn.'><i class="fas fa-fw fa-print"></i></a><a href="?page=createapprovep&spp='.$jdbvj['id_spp'].'" class=""><i class="fas fa-fw fa-eye"></i></a></td>
												</tr>';
												$i++;
											}
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
</div>
