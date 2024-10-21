<?php

  require_once('../data/database.php');

    if (isset($_GET['raceId'])) {
      getQualifying($_GET['raceId']);
    } 
  
    function getQualifying($raceId) {
      $db = getDBObject();

      $sql = "SELECT results.* FROM qualifying 
              INNER JOIN races ON races.raceId = qualifying.raceId 
              INNER JOIN results ON races.raceId = results.raceId  
              WHERE 
                races.raceId = '" . $raceId . "'
              ORDER BY results.position";

      $result = $db->query($sql);
      $data = [];

      while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $data[] = $row;
      }
      echo json_encode($data);

      // Close the database connection
      $db->close(); 
    }
?>