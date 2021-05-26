<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
	</div>

	<!-- Content Row -->
	<div class="row">

		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-4 col-md-6 mb-4">
			<div class="card border-left-primary  h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Purchase Order</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?php
							$sql = 'SELECT * FROM table_spp WHERE status=1';
							$query = mysqli_query($conn, $sql);
							echo mysqli_num_rows($query);
							 ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-shopping-cart fa-2x" style="color:#05ffa1"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-4 col-md-6 mb-4">
			<div class="card border-left-success  h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Sales Order</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?php
							$sql = 'SELECT * FROM table_sp WHERE status=1';
							$query = mysqli_query($conn, $sql);
							echo mysqli_num_rows($query);
							 ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-credit-card fa-2x" style="color:#b967ff"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-4 col-md-6 mb-4">
			<div class="card border-left-info  h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Omset</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?php
							$sqla = 'SELECT sum(total) as beli FROM table_spp_detail tpp join table_spp spp on tpp.id_spp=spp.id_spp WHERE status=1';
							$querya = mysqli_query($conn, $sqla);
							$rowa = mysqli_fetch_assoc($querya);

							$sqlb = 'SELECT sum(total) as jual FROM table_sp_detail tp join table_sp sp on tp.id_sp=sp.id_sp WHERE status=1';
							$queryb = mysqli_query($conn, $sqlb);
							$rowb = mysqli_fetch_assoc($queryb);

							echo "Rp. ".number_format(($rowb['jual']-$rowa['beli']),0,',','.');
							 ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-dollar-sign fa-2x" style="color:#ff3d3d"></i>
						</div>
					</div>
				</div>
			</div>
		</div>


	</div>

</div>
