<?php

  require_once('config.inc.php');


  class Drivers {
    public $pdo;

    public function __construct() {
      $this->pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function drivers($driverRef) {
      try {

        if (isset($driverRef)) {
          $sql = "SELECT forename, surname, dob, nationality, url FROM drivers WHERE driverRef = '" . $driverRef . "' LIMIT 1";
        }
        
        $result = $this->pdo->query($sql);
        return json_encode($result->fetchAll(PDO::FETCH_ASSOC)); 
      } catch (PDOException $e) {
        $this->pdo = null;
        die( $e->getMessage() );
     } 
    }

    public function getDriverRaces($surname) {
      try {
        $sql = 
         "SELECT RA.name, RE.position, RE.points 
          FROM drivers DR 
          INNER JOIN results RE ON DR.driverId = RE.driverId 
          INNER JOIN races RA ON RE.raceId = RA.raceId 
          WHERE DR.driverRef = '" . $surname . "' AND RA.year = 2022
          ORDER BY RA.name;
        ";
        $result = $this->pdo->query($sql);
        return json_encode($result->fetchAll(PDO::FETCH_ASSOC)); 
      } catch (PDOException $e) {
        $this->pdo = null;
        die( $e->getMessage() );
     } 
    }
  }

?>