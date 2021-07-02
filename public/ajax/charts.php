<?php 
  require_once("../../db/db.php");
  $db = new Database();
  $json = [];

  if(isset($_GET['pricesOfTypesPie'])){
    $stmt = $db->getDataForChart("pricesOfTypesPie");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      extract($row);
      $json[] = array(
        "name" => $house_type,
        "y" => (int)$price 
      );
    }
  }
  else if(isset($_GET['%ofTypes'])){
    $sum = $db->getSum();
    $sum = $sum["sum"];

    $stmt = $db->getDataForChart("%ofTypes");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      extract($row);
      $json[] = array(
        "name" => $house_type,
        "y" => (int)$count,
        "z" => (int)(($count/$sum)*700)
      );
    }
  }
  else if(isset($_GET['comparison'])){
    $stmt = $db->getDataForChart("comparison");
    $tmp = array('name' => '', 'data' => []);

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      extract($row);

      if($tmp["name"] == ""){
        $tmp["name"] = $name;
        array_push($tmp['data'], (int)$price);
      }
      else if($tmp["name"] == $name)
        array_push($tmp['data'], (int)$price);
      else if($tmp["name"] != $name){
        $json[] = $tmp;
        $tmp = array('name' => '', 'data' => [(int)$price]);
      }
    }
    $tmp["categories"] = $db->getComparisonCategories();
    $json[] = $tmp;
  }
  else if(isset($_GET['analyze'])){
    $stmt = $db->getDataForChart("analyze");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      extract($row);
      
      $json[] = [strtotime($date)*1000, (int)$price];
    }
    
  }



  echo json_encode($json);

?>