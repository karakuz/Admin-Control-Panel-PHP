<script>
  $.getJSON('/ajax/charts.php?pricesOfTypesPie', (data) => {
        options.series[0].data = data;
        $('#chart1').highcharts(options);
      });
</script>