<?php


$listalabel = [];
$listavalue = [];

$listalabelkey = [];
$listavalueOcc = [];


for ($x = 0; $x < count($listgraph); $x++) {
    array_push($listalabel, $listgraph[$x][0]);
    array_push($listavalue, $listgraph[$x][1]);
}

$occorrenze = array_count_values($listalabel);


foreach ($occorrenze as $key => $value) {
    $tmpval =  $value;
    $tmpkey =  $key;

    array_push($listavalueOcc, $tmpval);
    array_push($listalabelkey, $tmpkey);
}

$listalabelkey = (json_encode($listalabelkey));
$listavalueOcc = (json_encode($listavalueOcc));



?>
<script src="./plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="plugins/chart.js/Chart.min.js"></script>
<script>
    $(document).ready(function() {

        <?php

        echo "var labels = " . $listalabelkey . ";\n";
        echo "var data = " . $listavalueOcc . ";\n";
        ?>

        var salesGraphChartCanvas = $('#line-chart').get(0).getContext('2d')
        // $('#revenue-chart').get(0).getContext('2d');

        var salesGraphChartData = {
            labels: labels,
            datasets: [{
                label: 'Numero prenotazioni',
                fill: false,
                borderWidth: 2,
                lineTension: 0,
                spanGaps: true,
                borderColor: '#212529',
                pointRadius: 3,
                pointHoverRadius: 7,
                pointColor: '#212529',
                pointBackgroundColor: '#212529',
                data: data
            }]
        }

        var salesGraphChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                    ticks: {
                        fontColor: '#212529'
                    },
                    gridLines: {
                        display: false,
                        color: '#212529',
                        drawBorder: false
                    }
                }],
                yAxes: [{
                    ticks: {
                        stepSize: 5000,
                        fontColor: '#212529'
                    },
                    gridLines: {
                        display: true,
                        color: '#212529',
                        drawBorder: false
                    }
                }]
            }
        }

        // This will get the first returned node in the jQuery collection.
        // eslint-disable-next-line no-unused-vars
        var salesGraphChart = new Chart(salesGraphChartCanvas, { // lgtm[js/unused-local-variable]
            type: 'line',
            data: salesGraphChartData,
            options: salesGraphChartOptions
        })
    });
</script>