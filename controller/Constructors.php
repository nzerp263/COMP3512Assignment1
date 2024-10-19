<?php

  require_once('config.inc.php');


  class Constructors {
    public $pdo;

    public function __construct() {
      $this->pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function constructor($constructorRef) {
      try {

        if (isset($constructorRef)) {
          $sql = "SELECT * FROM constructors WHERE constructorRef = '" . $constructorRef . "' LIMIT 1";
        }
        
        $result = $this->pdo->query($sql);
        return json_encode($result->fetchAll(PDO::FETCH_ASSOC)); 
      } catch (PDOException $e) {
        $this->pdo = null;
        die( $e->getMessage() );
     } 
    }

    public function getDriversAndRaces($constructorRef) {
      try {
        $sql = "SELECT RA.round, CI.name, DR.forename, DR.surname, RE.position, RE.points, DR.driverRef FROM drivers DR 
          INNER JOIN results RE ON DR.driverId = RE.driverId 
          INNER JOIN races RA ON RE.raceId = RA.raceId 
          INNER JOIN constructors CO ON RE.constructorId = CO.constructorId
          INNER JOIN circuits CI ON RA.circuitId = CI.circuitId
          WHERE CO.constructorRef = '" . $constructorRef . "' AND RA.year = 2022
          ORDER BY RA.round;
        ";
        $result = $this->pdo->query($sql);
        return json_encode($result->fetchAll(PDO::FETCH_ASSOC)); 
      } catch (PDOException $e) {
        $this->pdo = null;
        die( $e->getMessage() );
     } 
    }

    function displayConstructor() {
      $constructor = json_decode($this->constructor($_GET['constructorRef']), true);
      foreach ($constructor as $row) {
        $constructorDetails = array(
          "flag" => $this->getFlag($row['nationality']),
          "name" => $row['name'],
          "nationality" => $row['nationality'],
          "url" => $row['url']
        );
      }

      return $constructorDetails;
    }

    function getFlag($nationality) {
      $countries = require 'countriesWithCode.php'; // Use require instead of require_once
      
      return $countries[$nationality] ?? null; // Return null if nationality not found
    }

  }

?>