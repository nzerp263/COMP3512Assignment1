<?php

  require_once('../config.inc.php');

    if (isset($_GET['driverRef'])) {
      getDriver($_GET['driverRef']);
    } else if(isset($_GET['race'])) {
      getDriversForRace($_GET['race']);
    } else {
      getDrivers();
    }
  
    function getDriver($driverRef) {
      $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "SELECT * FROM drivers 
              INNER JOIN results ON drivers.driverId = results.driverId
              INNER JOIN races ON results.raceId = races.raceId
              WHERE 
                year = 2022 AND
                driverRef = '" . $driverRef . "'";
  
      $result = $pdo->query($sql);
      echo json_encode($result->fetchAll(PDO::FETCH_ASSOC)); 
    }
  
    function getDrivers() {
      $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "SELECT * FROM drivers 
              INNER JOIN results ON drivers.driverId = results.driverId
              INNER JOIN races ON results.raceId = races.raceId
              WHERE 
                year = 2022;";
  
      $result = $pdo->query($sql);
      echo json_encode($result->fetchAll(PDO::FETCH_ASSOC));  
  } 

  function getDriversForRace($raceId) {
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM drivers 
            INNER JOIN results ON drivers.driverId = results.driverId
            INNER JOIN races ON results.raceId = races.raceId
            WHERE 
              races.raceId = '" . $raceId . "'";

    $result = $pdo->query($sql);
    echo json_encode($result->fetchAll(PDO::FETCH_ASSOC)); 
  }
?>