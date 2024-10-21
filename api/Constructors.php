<?php

  require_once('../data/database.php');

    if (isset($_GET['constructorRef'])) {
      getConstructor($_GET['constructorRef']);
    } else {
      getConstructors();
    }
  
    function getConstructor($constructorRef) {
      $db = getDBObject();
      
      $sql = "SELECT * FROM constructors 
              INNER JOIN results ON constructors.constructorId = results.constructorId
              INNER JOIN races ON results.raceId = races.raceId
              WHERE 
                year = 2022 AND
                constructorRef = '" . $constructorRef . "'";
  
      $result = $db->query($sql);
      $data = [];

      while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
          $data[] = $row;
      }
      echo json_encode($data);

      // Close the database connection
      $db->close(); 
    }
  
    function getConstructors() {
      $db = getDBObject();

      $sql = "SELECT * FROM constructors 
              INNER JOIN results ON constructors.constructorId = results.constructorId
              INNER JOIN races ON results.raceId = races.raceId
              WHERE 
                year = 2022;";
  
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