<?php

  require_once('../data/database.php');

    if (isset($_GET['driverRef'])) {
      getDriver($_GET['driverRef']);
    } else if(isset($_GET['race'])) {
      getDriversForRace($_GET['race']);
    } else {
      getDrivers();
    }
  
    function getDriver($driverRef) {
      $db = getDBObject();
      $sql = "SELECT * FROM drivers 
              INNER JOIN results ON drivers.driverId = results.driverId
              INNER JOIN races ON results.raceId = races.raceId
              WHERE 
                year = 2022 AND
                driverRef = '" . $driverRef . "'";
  
      $result = $db->query($sql);
      $data = [];

      while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
          $data[] = $row;
      }
      echo json_encode($data);

      // Close the database connection
      $db->close(); 
    }
  
    function getDrivers() {
      $db = getDBObject();
      $sql = "SELECT * FROM drivers 
              INNER JOIN results ON drivers.driverId = results.driverId
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

  function getDriversForRace($raceId) {
    $db = getDBObject();

    $sql = "SELECT * FROM drivers 
            INNER JOIN results ON drivers.driverId = results.driverId
            INNER JOIN races ON results.raceId = races.raceId
            WHERE 
              races.raceId = '" . $raceId . "'";

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