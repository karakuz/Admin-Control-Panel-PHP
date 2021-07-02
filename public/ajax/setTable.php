<?php

require_once("../../db/db.php");
require('../../db/ssp.class.php');
$db = new Database();

$req = $db->getTableRequirements();

echo json_encode(
  SSP::simple($_GET, $req[0], $req[1], $req[2], $req[3])
);