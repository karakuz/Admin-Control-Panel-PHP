<script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
      const options = {
        chart:{
          renderTo: "chart1",
          type: 'line'
        },
        title: {
          text: 'Penthouse Price Comparison'
        },
        tooltip: {
          pointFormat: "Price: <b>${point.y}</b><br/>"
        },
        xAxis: {
          categories: [],
        },
        series:[]
      }

      $(document).ready( () => {
        $.getJSON('/ajax/charts.php?comparison', (data) => {
          options.xAxis.categories = data[data.length-1]["categories"];
          delete data[data.length-1].categories;

          console.log(data);
          options.series = data;
          $('#chart1').highcharts(options);
        });
      })

    </script>