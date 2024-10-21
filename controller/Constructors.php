<?php

  class Constructors {
    public $db;

    public function __construct() {
      $this->db = getDBObject();
    }

    public function constructor($constructorRef) {
      try {

        if (isset($constructorRef)) {
          $sql = "SELECT * FROM constructors WHERE constructorRef = '" . $constructorRef . "' LIMIT 1";
        }
        
        $result = $this->db->query($sql);
        $data = [];

        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $data[] = $row;
        }
        return json_encode($data);
      } catch (PDOException $e) {
        $this->db->close();
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
        $result = $this->db->query($sql);
        $data = [];

        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $data[] = $row;
        }
        return json_encode($data);
      } catch (PDOException $e) {
        $this->db->close();
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