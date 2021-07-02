<script>
      const options2 = JSON.parse(JSON.stringify(options));
      $.getJSON('/ajax/charts.php?%ofTypes', (data) => {
        options2.title.text = "# of houses";
        options2.chart = { type: "variablepie" };
        options2.series = [{ minPointSize: 10, innerSize: '20%', zMin: 0, name: 'House Types', data: [{}] }];
        options2.tooltip.pointFormat += "<br/># of houses: <b>{point.y}</b><br/>";
        options2.series[0].data = data;

        $('#chart2').highcharts(options2);
      });
    </script>