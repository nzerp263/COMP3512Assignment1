<?php

  require_once('../config.inc.php');

    if (isset($_GET['raceId'])) {
      getResult($_GET['raceId']);
    } 
    
    if (isset($_GET['driverRef'])) {
      getResultsForDriver($_GET['driverRef']);
    }
  
    function getResult($raceId) {
      $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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

      $result = $pdo->query($sql);
      echo json_encode($result->fetchAll(PDO::FETCH_ASSOC)); 
    }
  
    function getResultsForDriver($driverRef) {
      
      $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "SELECT results.*
              FROM drivers 
              INNER JOIN results ON drivers.driverId = results.driverId
              WHERE 
                drivers.driverRef = '" . $driverRef . "'";

      $result = $pdo->query($sql);
      echo json_encode($result->fetchAll(PDO::FETCH_ASSOC)); 
    }
?>