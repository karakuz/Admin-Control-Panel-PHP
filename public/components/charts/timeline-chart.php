<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/data.js"></script>
<script type="text/javascript">
  Highcharts.getJSON('/ajax/charts.php?analyze', function(data) {
  const chart = Highcharts.stockChart('chart1', {
    series: [{
      name: 'penthouse 03',
      tooltip: {
        pointFormat: "Price: <b>${point.y}</b><br/>"
      },
      data
    }]
  });
  // Setting extremes spanning one day actually shows 5 days in the chart
  chart.xAxis[0].setExtremes(new Date('2019-06-01').getTime(), new Date('2021-06-01').getTime());
  });
</script>