<?php

  require_once('../config.inc.php');

    if (isset($_GET['raceId'])) {
      getRace($_GET['raceId']);
    } else if(isset($_GET['season'])) {
      getRaces($_GET['season']);
    } else {
      echo "Incorrect API endpoint";
    }
  
    function getRace($raceId) {
      $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "SELECT races.*, circuits.name, circuits.location, circuits.country FROM races 
              INNER JOIN circuits ON races.circuitId = circuits.circuitId 
              WHERE 
                raceId = '" . $raceId . "'";

      $result = $pdo->query($sql);
      echo json_encode($result->fetchAll(PDO::FETCH_ASSOC)); 
    }
  
    function getRaces($season) {
      
      $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "SELECT * FROM races 
              INNER JOIN circuits ON races.circuitId = circuits.circuitId 
              WHERE 
                year = " . $season . "
              ORDER BY round DESC";
  
      $result = $pdo->query($sql);
      echo json_encode($result->fetchAll(PDO::FETCH_ASSOC)); 
  } 
?>