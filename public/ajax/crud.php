<?php
  require_once("../../db/db.php");
  $db = new Database();

  if(isset($_POST['update'])){
    unset($_POST['update']);
    $db->updateHouse($_POST);
    echo "true";
  }
  else if(isset($_POST['add'])){
    unset($_POST['add']);
    $db->addHouse($_POST);
    echo "true";
  }
?>