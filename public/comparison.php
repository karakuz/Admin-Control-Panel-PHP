<?php 
  include_once("./components/head.php");
?>
    
    <title>Comparison</title>
  </head>
  <body>
    <?php
      $pageName = "Comparison";
      include_once("./components/topmenu.php");
      include_once("./components/sidebar.php");
    ?>

    <!-- PAGE CONTENT -->
    <div class="pusher">
      <div class="ui grid container page-content" style="padding-bottom: 2rem">
        <div id="chart1" style="width:100%; height:400px; margin-top: 5rem"></div>
      </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.js"></script>
    <script src="./js/menu.js"></script>
    <?php require_once("./components/charts/comparison.php") ?>
    
  </body>
</html>