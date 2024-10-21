<?php

  require_once('../data/database.php');

    if (isset($_GET['circuitRef'])) {
      getCircuit($_GET['circuitRef']);
    } else {
      getCircuits();
    }

    function getCircuit($circuitRef) {
      $db = getDBObject();
      $sql = "SELECT * FROM circuits 
                    INNER JOIN races ON circuits.circuitId = races.circuitId 
                    WHERE 
                      year = 2022 AND
                      circuitRef = '" . $circuitRef . "'";
  
      $result = $db->query($sql);
      $data = [];

      while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
          $data[] = $row;
      }
      echo json_encode($data);

      // Close the database connection
      $db->close(); 
    }
  
    function getCircuits() {
      $db = getDBObject();

      $sql = "SELECT * FROM circuits
                    INNER JOIN races ON circuits.circuitId = races.circuitId 
                    WHERE 
                      year = 2022";
  
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