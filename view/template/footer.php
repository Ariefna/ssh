<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<footer class="sticky-footer bg-white">
	<div class="container my-auto">
		<div class="copyright text-center my-auto">
			<span>Copyright &copy;   <a href="#" target="_blank">PT. Digitama Media Indonesia</a> 2021</span>
		</div>
	</div>
</footer>
</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
	<i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Perhatian!</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">Apakah Anda yakin untuk keluar dari sistem?</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
				<a class="btn btn-primary" href="?page=logout">Logout</a>
			</div>
		</div>
	</div>
</div>
<script>

// function suggest2(inputString){
// 		if(inputString.length == 0) {
// 			$('#suggestions2').fadeOut();
// 		} else {
// 			$('#country2').addClass('load');
// 			$.post("autosuggest.php", {queryString: ""+inputString+""}, function(data){
// 				if(data.length >0) {
// 					$('#suggestions2').fadeIn();
// 					$('#suggestionsList2').html(data);
// 					$('#country2').removeClass('load');
// 				}
// 			});
// 		}
// 	}


	// function fill2(thisValue) {
	// 	$('#kode').val(thisValue);
	// 	setTimeout("$('#suggestions').fadeOut();", 100);
	// }

</script>
<script>
	function alertku(type, message) {
		$("#alert").append("<div class='alert alert-"+type+"' role='alert'>"+message+"<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
		}
	</script>
	<script>
	// document.onkeydown = function(e) {
		// if(event.keyCode == 123) {
		// 	return false;
		// }
		// if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
		// 	return false;
		// }
		// if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
		// 	return false;
		// }
		// if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
		// 	return false;
		// }
		// if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
		// 	return false;
		// }
		// if(e.ctrlKey && e.keyCode == 'C'.charCodeAt(0)) {
		// 	return false;
		// }
	// }
	// $('.input-group').datepicker({
	// 	format: "Y-m-d"
	// });
</script>
<!-- Bootstrap core JavaScript-->

<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.6/b-colvis-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/datatables.min.js"></script>
</body>

</html>
