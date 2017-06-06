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
        var sort      = $(this).data("sort");
        var type      = $(this).data("sort-type");
        var paging    = $(this).data("paging");
        var perpage   = $(this).data('perpage');
        var ordering  = $(this).data("ordering");
        var info      = $(this).data("show-info");
        var searching = $(this).data("searching");
        var actions   = $(this).data("actions");
        var scroll    = $(this).data('scroll');

        if (sort == null) {
            sort = 0;
        }

        if (type !== 'asc' && type !== 'desc') {
            type = 'asc';
        }

        if (typeof paging === 'undefined') {
            paging = true;
        }

        if (typeof info === 'undefined') {
            info = true;
        }

        if (typeof ordering === 'undefined') {
            ordering = true;
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

        if (!scroll) {
            scroll = null;
        }
        else {
            scroll = "800px";
        }

        if (!perpage) {
            perpage = 10;
        }

        $(this).DataTable({
            ordering: ordering,
            paging: paging,
            info: info,
            aaSorting: [[sort, type]],
            pageLength: perpage,
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
