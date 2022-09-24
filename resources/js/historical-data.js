$(document).ready( function () {
    // Datatable initialization
    $('#historical_data').DataTable({
        aaSorting : [[0, 'desc']]
    });

    // get values to populate chart
    // we are using charts.js
    var table = $('#historical_data').DataTable();
    var labels = table
        .column(0)
        .data()
        .toArray();
    var open = table
        .column(1)
        .data()
        .toArray();
    var close = table
        .column(4)
        .data()
        .toArray();

    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'line',
        data: {
            // reverse because we have sorted datatable to desc and on chart latest date should be shown on right most
            // side and similarly values of open and close are also reversed to match there respective dates
            labels: labels.reverse(),
            datasets: [{
                label: 'Close',
                data: close.reverse(),
                backgroundColor: 'transparent',
                borderColor: 'rgb(126,0,0)',
                borderWidth: 1
            },
                {
                    label: 'Open',
                    data: open.reverse(),
                    backgroundColor: 'transparent',
                    borderColor: 'rgb(0,126,82)',
                    borderWidth: 1
                }]
        },
        options: {
            responsive: true,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            stacked: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Chart.js Line Chart - Multi Axis'
                }
            },
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                },
                y1: {
                    type: 'linear',
                    display: true,
                    position: 'right',

                    // grid line settings
                    grid: {
                        drawOnChartArea: false, // only want the grid lines for one axis to show up
                    }
                }
            }
        }
    });
});
