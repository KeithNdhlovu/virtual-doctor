$(function () {
    $('.js-basic-example').DataTable({
        responsive: true
    });

    //Exportable table
    $('.js-exportable').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        buttons: [
            'copy', 'csv', 'excel', 'print',
            {
                extend: 'pdf',
                text: 'Pdf',
                orientation: 'landscape',
                fontSize: 9,
                exportOptions: {
                    columns: ':visible',
                },
                action: function(e, dt, button, config) {
     
                    // Add code to make changes to table here
                    $('.page-loader-wrapper').fadeIn();
                    $('.hide-on-print').hide();

                    // Call the original action function afterwards to
                    // continue the action.
                    // Otherwise you're just overriding it completely.
                    if ($.fn.dataTable.ext.buttons.pdfHtml5.available( dt, config )) {
                        $.fn.dataTable.ext.buttons.pdfHtml5.action(e, dt, button, config);
                    }

                    $('.page-loader-wrapper').fadeOut();
                    $('.hide-on-print').show();
                }
            }
        ]
    });
});