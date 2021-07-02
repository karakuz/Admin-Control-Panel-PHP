<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/variable-pie.js"></script>
<script>
      const options = {
        chart: {
          plotBackgroundColor: null,
          plotBorderWidth: null,
          plotShadow: false,
          type: 'pie'
        },
        title: {
          text: 'Total prices of house types'
        },
        tooltip: {
          pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b><br>Total: <b>${point.y}</b>'
        },
        accessibility: {
          point: {
            valueSuffix: '%'
          }
        },
        plotOptions: {
          pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
              enabled: true,
              format: '{point.name}: {point.percentage:.1f} %'
            }
          }
        },
        series: [{
          name: 'House Types',
          colorByPoint: true,
          data: [{}]
        }]
      };
</script>
