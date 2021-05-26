<li class="nav-item">
	<a class="nav-link" href="?">
		<i class="fas fa-fw fa-home" style="color:#01cdfe"></i>
		<span>Home</span></a>
	</li>
	<?php
	if(empty($_SESSION['sts'])){
		echo "gaada";
	} 
	
	?>
	<?php if ($_SESSION['sts']==1) {?>
		<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities1" aria-expanded="true" aria-controls="collapseUtilities">
				<i class="fas fa-fw fa-server" style="color:#ff71ce"></i>
				<span>Data Master</span>
			</a>
			<div id="collapseUtilities1" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<table class="table table-responsive table-borderless text-center">
						<tr>
							<td><a class="collapse-item py-3 m-1 bg-primary" href="?page=nilai"><img src="img/add.png" width="50px"><br><b>Penambah Nilai</b></a></td>
							<td><a class="collapse-item py-3 m-1 bg-primary" href="?page=kas"><img src="img/money.png" width="50px"><br><b>Kas</b></a></td>
							<td><a class="collapse-item py-3 m-1 bg-primary" href="?page=bank"><img src="img/bank.png" width="50px"><br><b>Bank</b></a></td>
							<td><a class="collapse-item py-3 m-1 bg-primary" href="?page=pelanggan"><img src="img/customer.png" width="50px"><br><b>Customer</b></a></td>
							<td><a class="collapse-item py-3 m-1 bg-primary" href="?page=supplier"><img src="img/distribution.png" width="50px"><br><b>Supplier</b></a></td>
						</tr>
						<tr>
							<td><a class="collapse-item py-3 m-1 bg-success" href="?page=satuan"><img src="img/1.png" width="50px"><br><b>Satuan</b></a></td>
							<td><a class="collapse-item py-3 m-1 bg-success" href="?page=produk"><img src="img/new-product.png" width="50px"><br><b>Produk</b></a></td>
							<td><a class="collapse-item py-3 m-1 bg-success" href="?page=harga"><img src="img/dollar.png" width="50px"><br><b>Harga</b></a></td>
							<td><a class="collapse-item py-3 m-1 bg-success" href="?page=stok"><img src="img/box.png" width="50px"><br><b>Stok</b></a></td>
							<td><a class="collapse-item py-3 m-1 bg-success" href="?page=inventory"><img src="img/wholesaler.png" width="50px"><br><b>Inventory</b></a></td>
						</tr>
						<tr>
							<td><a class="collapse-item py-3 m-1 bg-warning" href="?page=userset"><img src="img/employee.png" width="50px"><br><b>Karyawan</b></a></td>
							<td><a class="collapse-item py-3 m-1 bg-warning" href="?page=pegawai"><img src="img/workers.png" width="50px"><br><b>Pegawai</b></a></td>
							<td><a class="collapse-item py-3 m-1 bg-warning" href="?page=gudang"><img src="img/warehouse.png" width="50px"><br><b>Gudang</b></a></td>
							<td><a class="collapse-item py-3 m-1 bg-warning" href="?page=perkiraan"><img src="img/estimate.png" width="50px"><br><b>Kode Akun Perkiraan</b></a></td>
						</tr>
					</table>
				</div>
			</div>
		</li>
	<?php } ?>
	<?php if ($_SESSION['sts']==1||$_SESSION['sts']==2||$_SESSION['sts']==3||$_SESSION['sts']==6) {?>
		<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities0" aria-expanded="true" aria-controls="collapseUtilities">
				<i class="fas fa-fw fa-shopping-cart" style="color:#05ffa1"></i>
				<span>Purchase Order</span>
			</a>
			<div id="collapseUtilities0" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<table class="table table-responsive table-borderless text-center">
						<tr>
							<td><a class="collapse-item py-3 m-1 bg-primary" href="?page=suratpembelian"><img src="img/checklist.png" width="50px"><br><b>Create Purchase Order</b></a></td>
							<td><a class="collapse-item py-3 m-1 bg-primary" href="?page=approvep"><img src="img/approval.png" width="50px"><br><b>Approve Purchase Order</b></a></td>
							<td><a class="collapse-item py-3 m-1 bg-primary" href="?page=penerimaanpembelian"><img src="img/delivery-box (1).png" width="50px"><br><b>Create Penerimaan Produk</b></a></td>
							<td><a class="collapse-item py-3 m-1 bg-primary" href="?page=approvepen"><img src="img/delivery-box.png" width="50px"><br><b>Approve Penerimaan Produk</b></a></td>
						</tr>
					</table>
				</div>
			</div>
		</li>
	<?php } ?>
	<?php if ($_SESSION['sts']==1||$_SESSION['sts']==2||$_SESSION['sts']==4||$_SESSION['sts']==5||$_SESSION['sts']==6) {?>
		<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities3" aria-expanded="true" aria-controls="collapseUtilities">
				<i class="fas fa-fw fa-credit-card" style="color:#b967ff"></i>
				<span>Sales Order</span>
			</a>
			<div id="collapseUtilities3" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<table class="table table-responsive table-borderless text-center">
						<tr>
							<?php if ($_SESSION['sts']==1||$_SESSION['sts']==2||$_SESSION['sts']==4||$_SESSION['sts']==6) {?>
							<td><a class="collapse-item py-3 m-1 bg-primary" href="?page=suratpesanan"><img src="img/order.png" width="50px"><br><b>Create Sales Order</b></a></td>
							<td><a class="collapse-item py-3 m-1 bg-primary" href="?page=approve"><img src="img/approval.png" width="50px"><br><b>Approve Sales Order</b></a></td>
							<?php } ?>
							<td><a class="collapse-item py-3 m-1 bg-primary" href="?page=suratjalan"><img src="img/delivery-box (1).png" width="50px"><br><b>Create Delivery Order</b></a></td>
							<td><a class="collapse-item py-3 m-1 bg-primary" href="?page=approvesj"><img src="img/delivery-box.png" width="50px"><br><b>Approve Delivery Order</b></a></td>
							<?php if ($_SESSION['sts']==1||$_SESSION['sts']==2||$_SESSION['sts']==4) {?>
							<td><a class="collapse-item py-3 m-1 bg-primary" href="?page=invoice"><img src="img/invoice.png" width="50px"><br><b>Invoice</b></a></td>
						</tr>
						<tr>
							<td><a class="collapse-item py-3 m-1 bg-success" href="?page=retur"><img src="img/exchange.png" width="50px"><br><b>Retur Sales Order</b></a></td>
							<td><a class="collapse-item py-3 m-1 bg-success" href="?page=approveretur"><img src="img/box 2.png" width="50px"><br><b>Approve Retur Sales Order</b></a></td>
							<td><a class="collapse-item py-3 m-1 bg-success" href="?page=piutang"><img src="img/debt.png" width="50px"><br><b>Piutang</b></a></td>
							<?php } ?>
							<!-- <a class="collapse-item" href="?page=kuitansi">kuitansi</a> -->
						</tr>
					</table>
				</div>
			</div>
		</li>
	<?php } ?>
	<!-- <li class="nav-item">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities9" aria-expanded="true" aria-controls="collapseUtilities">
			<i class="fas fa-fw fa-book"></i>
			<span>Tugas kerja</span>
		</a>
		<div id="collapseUtilities9" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<h6 class="collapse-header">Tugas kerja:</h6>
					<a class="collapse-item" href="?page=tk">Tugas Kerja</a>
					<a class="collapse-item" href="?page=approvetk">Approve Tugas Kerja</a>
					<a class="collapse-item" href="?page=list_penyesuaian_tk">Penyelesaian Pekerjaan</a>
					<a class="collapse-item" href="?page=approve_penyesuaian_pekerjaan">Approve Penyesuaian</a>
			</div>
		</div>
	</li> -->
	<?php if ($_SESSION['sts']==1||$_SESSION['sts']==2) {?>
		<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2" aria-expanded="true" aria-controls="collapseUtilities">
				<i class="fas fa-fw fa-book" style="color:#ff3d3d"></i>
				<span>Laporan</span>
			</a>
			<div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<table class="table table-responsive table-borderless text-center">
						<tr>
							<td><a class="collapse-item py-3 m-1 bg-primary" href="?page=laporan_jurnal"><img src="img/journal.png" width="50px"><br><b>Jurnal</b></a></td>
							<td><a class="collapse-item py-3 m-1 bg-primary" href="?page=neraca_lajur"><img src="img/trading.png" width="50px"><br><b>Neraca Lajur</b></a></td>
							<td><a class="collapse-item py-3 m-1 bg-primary" href="?page=laporan_rugi_laba"><img src="img/loss.png" width="50px"><br><b>Rugi Laba</b></a></td>
							<td><a class="collapse-item py-3 m-1 bg-primary" href="?page=laporan_neraca"><img src="img/balance-sheet.png" width="50px"><br><b>Neraca</b></a></td>
							<td><a class="collapse-item py-3 m-1 bg-primary" href="?page=laporan_suratjalan"><img src="img/passport.png" width="50px"><br><b>Surat Jalan</b></a></td>
						</tr>
						<tr>
							<td><a class="collapse-item py-3 m-1 bg-success" href="?page=laporan_invoice"><img src="img/invoice.png" width="50px"><br><b>Invoice</b></a></td>
							<td><a class="collapse-item py-3 m-1 bg-success" href="?page=laporan_retur"><img src="img/exchange.png" width="50px"><br><b>Retur</b></a></td>
							<td><a class="collapse-item py-3 m-1 bg-success" href="?page=lap_sp"><img src="img/order.png" width="50px"><br><b>Lap. Sales Order</b></a></td>
							<td><a class="collapse-item py-3 m-1 bg-success" href="?page=lap_sj"><img src="img/delivery-box (1).png" width="50px"><br><b>Lap. Delivery Order</b></a></td>
							<!--<a class="collapse-item py-3 m-1 bg-success" href="?page=lap_piu">L Surat Piutang</a>-->
							<td><a class="collapse-item py-3 m-1 bg-success" href="?page=lap_rt"><img src="img/exchange.png" width="50px"><br><b>Lap. Retur</b></a></td>
						</tr>
						<tr>
							<!--<a class="collapse-item" href="?page=lap_pem">L Pembayaran</a>-->
							<td><a class="collapse-item py-3 m-1 bg-warning" href="?page=l_outsp"><img src="img/report.png" width="50px"><br><b>Lap. Outstanding SP</b></a></td>
							<!--<a class="collapse-item" href="?page=lap_tugas_kerja">L Tugas Kerja</a>-->
							<!--<a class="collapse-item" href="?page=lap_penyelesaian_tk">L Penyelesaian TK</a>-->
							<!--<a class="collapse-item" href="?page=lap_penjualan_tk">L Penjualan TK</a>-->
						</tr>
					</table>
				</div>
			</div>
		</li>
		<!-- <hr class="sidebar-divider">
		<div class="sidebar-heading">
			Transaksi
		</div> -->
		<!-- <li class="nav-item">
			<a class="nav-link active" href="?page=perkiraan">
				<i class="fas fa-fw fa-book"></i>
				<span>Perkiraan</span>
			</a>
		</li> -->
		<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
				<i class="fas fa-fw fa-book" style="color:#cf30c5"></i>
				<span>Jurnal</span>
			</a>
			<div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<table class="table table-responsive table-borderless text-center">
						<tr>
							<td><a class="collapse-item py-3 m-1 bg-primary" href="?page=jurnal"><img src="img/agendas.png" width="50px"><br><b>Jurnal Umum</b></a></td>
							<td><a class="collapse-item py-3 m-1 bg-primary" href="?page=jurnal_memorial"><img src="img/journal.png" width="50px"><br><b>Jurnal Memorial</b></a></td>
							<td><a class="collapse-item py-3 m-1 bg-primary" href="?page=posting"><img src="img/paper-plane.png" width="50px"><br><b>Posting Jurnal</b></a></td>
						</tr>
					</table>
				</div>
			</div>
		</li>
	<?php } ?>


	<!-- <hr class="sidebar-divider d-none d-md-block">
	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div> -->
</ul>
