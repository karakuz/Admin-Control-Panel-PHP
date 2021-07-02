<?php 
  require_once("../../db/db.php");
  $db = new Database();


  if(isset($_POST["id"]))
    $db->removeHouse($_POST["id"]);
  else if(isset($_POST["ids"])){
    foreach($_POST["ids"] as $id)
      $db->removeHouse($id);
  }
    
  echo "deleted";
  exit;
?>