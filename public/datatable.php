<?php
  //session_start();
  require_once("../db/db.php");
  include_once("./components/head.php");
  $db = new Database();

  if(isset($_GET["addnew"])):
?>
  <script>
    $(document).ready( () => {
      setTimeout(()=>{
        $('#add-new-modal').modal({autofocus: false}).modal('show');
        $('#add-rooms-dp').dropdown("hide", true);
        $('#add-housetypes-dp').dropdown("hide", true);
      },300);
    })
  </script>
<?php $_GET["addnew"] = null; endif; ?>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/colreorder/1.5.2/js/dataTables.colReorder.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.25/sorting/currency.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.semanticui.min.css">

    <link rel="stylesheet" href="./css/datatable.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Database</title>
  </head>
  <body>
    
    <?php
      $pageName = "Database";
      include_once("./components/topmenu.php");
      include_once("./components/sidebar.php");
    ?>

    <!-- PAGE CONTENT -->
    <div class="pusher dimmable">
      <div class="ui active inverted dimmer" id="loading">
        <div class="ui loader"></div>
      </div>
      <div class="ui grid container page-content datatable-div pos-rel" style="justify-content: center"> <!--  class="ui grid container page-content datatable-div" -->
        <div class="dt-custom-buttons">
          <button class="ui teal button" id="add-new"><i class="plus icon"></i>Add New</button>
          <button class="ui red button" id="delete-selected" style="visibility: hidden"><i class="trash alternate outline icon"></i>Delete</button>
        </div>
        <h2 style="margin-bottom: 0">DATABASE</h2>
        <table id="datatable" class="ui stripe hover row-border" style="display: inline-block; margin: 5rem 0;"><!-- fixed single line table stripe hover row-border -->
          <thead>
            <tr>
              <th style="background: none !important"><input type="checkbox" name="touchbutton" id="top-checkbox"></th>
              <th>ID</th>
              <th>Name</th>
              <th>Address</th>
              <th>Description</th>
              <th>Price</th>
              <th>Rooms</th>
              <th>Type</th>
              <th>Action</th>
            </tr>
          </thead>
        </table>

        <?php 
          include_once("./components/modals/edit-modal.php");
          include_once("./components/modals/add-house-modal.php");
        ?>

      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.js"></script>
    <script src="./js/menu.js"></script>
    <script src="./js/datatable.js"></script>
    
  </body>
</html>