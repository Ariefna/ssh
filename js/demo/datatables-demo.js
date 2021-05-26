$(document).ready(function() {

    $('#dataTable').DataTable( {
       dom: 'Bfrtip',
       buttons: [
       [ 'pageLength' ], 'copy', 'excel', 'pdf', 'print'
       ],
       "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
       "footerCallback": function ( row, data, start, end, display ) {
           var api = this.api();
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
            	return typeof i === 'string' ?
            	i.replace(/[\$,]/g, '')*1 :
            	typeof i === 'number' ?
            	i : 0;
            };

            // Total over all pages
            var total4 = api
            .column( 4 )
            .data()
            .reduce( function (a, b) {
            	return intVal(a) + intVal(b);
            } );

            // Total over this page
            var pageTotal4 = api
            .column( 4, { page: 'current'} )
            .data()
            .reduce( function (a, b) {
            	return intVal(a) + intVal(b);
            } );
            var total3 = api
            .column( 3 )
            .data()
            .reduce( function (a, b) {
            	return intVal(a) + intVal(b);
            } );

            // Total over this page
            var pageTotal3 = api
            .column( 3, { page: 'current'} )
            .data()
            .reduce( function (a, b) {
            	return intVal(a) + intVal(b);
            } );
            var total5 = api
            .column( 5 )
            .data()
            .reduce( function (a, b) {
            	return intVal(a) + intVal(b);
            } );

            // Total over this page
            var pageTotal5 = api
            .column( 5, { page: 'current'} )
            .data()
            .reduce( function (a, b) {
            	return intVal(a) + intVal(b);
            } );

            // Update footer
            $( api.column( 1 ).footer() ).html(
            	'Debet Rp.'+pageTotal3+' Kredit Rp.'+pageTotal4+' Saldo Rp. '+(pageTotal3-pageTotal4)
            	);
        },
        "aaSorting": [],
        "columnDefs": [
        { "orderable": false, "targets": 0 }
        ]
    } );

    $('#dataTable1').DataTable( {
       dom: 'Bfrtip',
       buttons: [
       [ 'pageLength' ], 'copy', 'excel', 'pdf', 'print'
       ],
       "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
       "aaSorting": []
   } );
} );
