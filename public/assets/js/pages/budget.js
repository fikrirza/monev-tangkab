$(function() {
    // ------------------------------
    // Chart budget composition
    // ------------------------------

   if (typeof graphData !== 'undefined') {
        var graph = c3.generate({
            bindto: '#graph',
            size: { height: 400 },
            data: {
                columns: graphData,
                type: 'pie'
            },
            legend: {
                show: false
            }
        });

        $(".sidebar-control").on('click', function() {
            graph.resize();
        });
    }
});