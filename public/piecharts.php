<?php 
  include_once("./components/head.php");
?>

    <title>Chart1</title>
  </head>
  <body>
    <?php
      $pageName = "House Types";
      include_once("./components/topmenu.php");
      include_once("./components/sidebar.php");
    ?>

    <!-- PAGE CONTENT -->
    <div class="pusher">
      <div class="ui grid container page-content">

        <div id="chart1" style="width:100%; height:400px; margin-top: 1rem"></div>
        <div id="chart2" style="width:100%; height:400px; margin-top: 1rem"></div>

      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.js"></script>
    <script src="./js/menu.js"></script>
    <?php require_once("./components/charts/pie-options.php") ?>
    <?php require_once("./components/charts/total-price-pie.php") ?>
    <?php require_once("./components/charts/#of-houses-pie.php") ?>
    
  </body>
</html>