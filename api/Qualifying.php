<?php

  require_once('../config.inc.php');

    if (isset($_GET['raceId'])) {
      getQualifying($_GET['raceId']);
    } 
  
    function getQualifying($raceId) {
      $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "SELECT results.* FROM qualifying 
              INNER JOIN races ON races.raceId = qualifying.raceId 
              INNER JOIN results ON races.raceId = results.raceId  
              WHERE 
                races.raceId = '" . $raceId . "'
              ORDER BY results.position";

      $result = $pdo->query($sql);
      echo json_encode($result->fetchAll(PDO::FETCH_ASSOC)); 
    }
?>