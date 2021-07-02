<?php
  include_once("./components/head.php");
?>
    
		<title>test</title>
	</head>
	<body>
    <?php
      $pageName = "House Types";
      include_once("./components/topmenu.php");
      include_once("./components/sidebar.php");
    ?>
    

    <!-- PAGE CONTENT -->
    <div class="pusher">
      <div class="ui grid container page-content" style="justify-content: center; padding-bottom: 3rem">
        <h1 class="ui header" style="margin-top: 2rem">Penthouse 03 Price History</h1>
        <div id="chart1" style="width:100%; height:400px; margin-top: 1rem"></div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.js"></script>
    <script src="./js/menu.js"></script>
    <?php include_once("./components/charts/timeline-chart.php")?>

	</body>
</html>