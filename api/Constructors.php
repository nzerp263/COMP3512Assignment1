<?php

  require_once('../config.inc.php');

    if (isset($_GET['constructorRef'])) {
      getConstructor($_GET['constructorRef']);
    } else {
      getConstructors();
    }
  
    function getConstructor($constructorRef) {
      $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "SELECT * FROM constructors 
              INNER JOIN results ON constructors.constructorId = results.constructorId
              INNER JOIN races ON results.raceId = races.raceId
              WHERE 
                year = 2022 AND
                constructorRef = '" . $constructorRef . "'";
  
      $result = $pdo->query($sql);
      echo json_encode($result->fetchAll(PDO::FETCH_ASSOC)); 
    }
  
    function getConstructors() {
      $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "SELECT * FROM constructors 
              INNER JOIN results ON constructors.constructorId = results.constructorId
              INNER JOIN races ON results.raceId = races.raceId
              WHERE 
                year = 2022;";
  
      $result = $pdo->query($sql);
      echo json_encode($result->fetchAll(PDO::FETCH_ASSOC));  
  } 
?>