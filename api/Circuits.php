<?php

  require_once('../config.inc.php');

    if (isset($_GET['circuitRef'])) {
      getCircuit($_GET['circuitRef']);
    } else {
      getCircuits();
    }
  
    function getCircuit($circuitRef) {
      $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "SELECT * FROM circuits 
                    INNER JOIN races ON circuits.circuitId = races.circuitId 
                    WHERE 
                      year = 2022 AND
                      circuitRef = '" . $circuitRef . "'";
  
      $result = $pdo->query($sql);
      echo json_encode($result->fetchAll(PDO::FETCH_ASSOC)); 
    }
  
    function getCircuits() {
      
      $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "SELECT * FROM circuits
                    INNER JOIN races ON circuits.circuitId = races.circuitId 
                    WHERE 
                      year = 2022";
  
      $result = $pdo->query($sql);
      echo json_encode($result->fetchAll(PDO::FETCH_ASSOC)); 
  } 
?>