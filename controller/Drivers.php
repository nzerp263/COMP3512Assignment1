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
          $sql = "SELECT forename, surname, dob, nationality, url, code FROM drivers WHERE driverRef = '" . $driverRef . "' LIMIT 1";
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
        $sql = "SELECT RA.date as date, RA.name as race_name, CO.name as co_name, CI.name as ci_name, CI.country, RE.position, RE.number, RE.grid, RE.points, RE.time, RE.fastestLapTime, RE.fastestLapSpeed FROM drivers DR 
          INNER JOIN results RE ON DR.driverId = RE.driverId 
          INNER JOIN races RA ON RE.raceId = RA.raceId 
          INNER JOIN constructors CO ON RE.constructorId = CO.constructorId
          INNER JOIN circuits CI ON RA.circuitId = CI.circuitId
          WHERE DR.driverRef = '" . $surname . "' AND RA.year = 2022
          ORDER BY RA.round;
        ";
        $result = $this->pdo->query($sql);
        return json_encode($result->fetchAll(PDO::FETCH_ASSOC)); 
      } catch (PDOException $e) {
        $this->pdo = null;
        die( $e->getMessage() );
     } 
    }

    function getDriverDetails() {
      $driver = new Drivers();
      $driver = json_decode($driver->drivers($_GET['driverRef']), true);
      foreach ($driver as $row) {
        $driverDetails = array(
          "flag" => $this->getFlag($row['nationality']),
          "forename" => $row['forename'],
          "surname" => $row['surname'],
          "dob" => $row['dob'],
          "age" => $this->getAge($row['dob']),
          "nationality" => $row['nationality'],
          "url" => $row['url'],
          "code" => $row['code']
        );
      }

      return $driverDetails;
    }

    function getAge($dob) {
      if(isset($dob)) {
        $dob = new DateTime($dob);
        $current = new DateTime(date("Y-m-d H:i:s"));
        $age = $current->diff($dob)->y;
      } else {
        $age = "Unknown";
      }

      return $age;
    }

    function getFlag($nationality) {
      $countries = require 'countriesWithCode.php'; // Use require instead of require_once
      
      return $countries[$nationality] ?? null; // Return null if nationality not found
    }

  }

?>