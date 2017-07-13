$(function() {
    // ------------------------------
    // Chart realization
    // ------------------------------

   if (typeof graphData !== 'undefined') {
        var graph = c3.generate({
            bindto: '#graph',
            point: { 
                r: 4   
            },
            size: { height: 400 },
            color: {
                pattern: ['#34B8F5', '#AE50BE', '#66BB6A', '#FEAB32']
            },
            data: {
                columns: graphData,
                type: 'line',
                types: {
                    'Realisasi Keuangan': 'bar',
                    'Realisasi Fisik'   : 'bar'
                }
            },
            axis: {
                x: {
                    type: 'category',
                    categories: ['Triwulan I', 'Triwulan II', 'Triwulan III', 'Triwulan IV']
                },
                y: {
                    max: 100,
                    tick: {
                        format: function(value) {
                            return d3.format('.1f')(value) + "%";
                        }
                    }
                },
            },
            grid: {
                x: {
                    show: true
                }
            }
        });

        $(".sidebar-control").on('click', function() {
            graph.resize();
        });
    }
});