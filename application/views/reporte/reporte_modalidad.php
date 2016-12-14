
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<style type="text/css">
    ${demo.css}
</style>
<script type="text/javascript">
    $(function () {
        $('#container').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Modalidades'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                type: 'category',
                labels: {
                    rotation: 0,
                    style: {
                        fontSize: '12px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Total'
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
                pointFormat: 'Total ingreso economico: <b>{point.y:.1f}</b>'
            },
            series: [{
                name: 'Centro de acogida',
                data: [
                    <?php
                        foreach($list_modalidad->result() as $value)
                        {
                            echo "[";
                            echo "'".$value->adulto_mayor_modalidad."',";
                            echo $value->cantidad."],";
                        }
                    ?>
                ],
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    format:'{point.y:.1f}', //'{point.y:.1f}', // one decimal
                    y: 12, // 10 pixels down from the top
                    style: {
                        fontSize: '12px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            }]
        });
    });
</script>
</head>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<div id="container" style="min-width: 300px; height: 400px; margin: 0 auto"></div>