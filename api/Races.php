<?php

  require_once('../data/database.php');

    if (isset($_GET['raceId'])) {
      getRace($_GET['raceId']);
    } else if(isset($_GET['season'])) {
      getRaces($_GET['season']);
    } else {
      echo "Incorrect API endpoint";
    }
  
    function getRace($raceId) {
      $db = getDBObject();
      $sql = "SELECT races.*, circuits.name, circuits.location, circuits.country FROM races 
              INNER JOIN circuits ON races.circuitId = circuits.circuitId 
              WHERE 
                raceId = '" . $raceId . "'";

      $result = $db->query($sql);
      $data = [];

      while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
          $data[] = $row;
      }
      echo json_encode($data);

      // Close the database connection
      $db->close(); 
    }
  
    function getRaces($season) {
      $db = getDBObject();

      $sql = "SELECT * FROM races 
              INNER JOIN circuits ON races.circuitId = circuits.circuitId 
              WHERE 
                year = " . $season . "
              ORDER BY round DESC";
  
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