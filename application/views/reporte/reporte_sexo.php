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
                text: 'Reporte Adulto Mayor por sexo'
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
                        $sexo_var;
                        foreach($list_sexo->result() as $value)
                        {
                            $sexo_var="";
                            if($value->persona_sexo==0)
                                $sexo_var="Hombres";
                            else
                                $sexo_var="Mujeres";
                            echo "[";
                            echo "'".$sexo_var."',";
                            echo $value->count."],";
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