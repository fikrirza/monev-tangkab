$(function() {
    // ------------------------------
    // Datatable
    // ------------------------------

    // Setting datatable defaults
    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
        language: {
            search: '<span>Filter:</span> _INPUT_',
            searchPlaceholder: 'Type to filter...',
            lengthMenu: '<span>Show:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
        },
        drawCallback: function () {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        },
        preDrawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
        }
    });


    // Basic datatable
    $('table.datatable').each(function(index) {
        var sort    = $(this).data("sort");
        var type    = $(this).data("sortType");
        var actions = $(this).data("actions");
        if (!sort) {
            sort = 0;
        }

        if (type !== 'asc' && type !== 'desc') {
            type = 'desc';
        }

        if (!actions) {
            actions = [];
        }
        else {
            sets    = actions.split(',');
            actions = [];
            for (var action of sets) {
                actions.push({extend: action});
            }
        }

        $(this).DataTable({
            aaSorting: [[sort, type]],
            buttons: {            
                dom: {
                    button: {
                        className: 'btn btn-default'
                    }
                },
                buttons: actions
            }
        });
    });

    // Add placeholder to the datatable filter option
    $('.dataTables_filter input[type=search]').attr('placeholder','Type to filter...');

    // Enable Select2 select for the length option
    $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity,
        width: 'auto'
    });


    // ------------------------------
    // Styled form components
    // ------------------------------

    // Select 2 component
    $('.select').select2();

    // Date label
    $('.date-label').each(function(index) {
        $(this).text(moment($(this).text()).format('MMMM D, YYYY'));
    });

});
