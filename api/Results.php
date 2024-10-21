<?php

  require_once('../data/database.php');

    if (isset($_GET['raceId'])) {
      getResult($_GET['raceId']);
    } 
    
    if (isset($_GET['driverRef'])) {
      getResultsForDriver($_GET['driverRef']);
    }
  
    function getResult($raceId) {
      $db = getDBObject();

      $sql = "SELECT drivers.driverRef, drivers.code, drivers.forename, drivers.surname,  
              races.name, races.round, races.year, races.date, 
              constructors.name, constructors.constructorRef, constructors.nationality
              FROM drivers 
              INNER JOIN results ON drivers.driverId = results.driverId
              INNER JOIN races ON results.raceId = races.raceId
              INNER JOIN constructors ON results.constructorId = constructors.constructorId
              WHERE 
                races.raceId = '" . $raceId . "'
              ORDER BY grid";

      $result = $db->query($sql);
      $data = [];

      while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $data[] = $row;
      }
      echo json_encode($data);

      // Close the database connection
      $db->close();  
    }
  
    function getResultsForDriver($driverRef) {
      $db = getDBObject();

      $sql = "SELECT results.*
              FROM drivers 
              INNER JOIN results ON drivers.driverId = results.driverId
              WHERE 
                drivers.driverRef = '" . $driverRef . "'";

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