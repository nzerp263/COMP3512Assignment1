<?php


  class Races {
    public $db;

    public function __construct() {
      $this->db = getDBObject();
    }

    function getRaces() {
      
      $sql = "SELECT * FROM races WHERE year = 2022 ORDER BY name";
  
      $result = $this->db->query($sql);
      $data = [];

      while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
          $data[] = $row;
      }
      return json_encode($data);
    } 

    function displayRaces($races) {
      // I got the inspiration to get the URL of the current page from the below links
      // https://stackoverflow.com/questions/6768793/get-the-full-url-in-php
      // https://stackoverflow.com/questions/9504608/request-string-without-get-arguments
      $uri = $_SERVER['REQUEST_URI'];
      $parsedUrl = parse_url($uri);
      $uriWithoutQuery = $parsedUrl['path'];

      if ($races) {
        echo("<table class='table table-dark table-hover'>");
        echo("<thead>
              <tr>
                <th>Race</th>
                <th>Time</th>
                <th>Results</th>
              </tr>
            </thead>");
        foreach ($races as $race) {
          echo("<tr>");
            echo("<td> " . $race['name'] . " </td>");
            echo("<td> " . $race['time'] . " </td>");
            echo("<td> <a href=" . $uriWithoutQuery ."?raceId=" . $race['raceId'] . "> <button class='btn btn-primary'> Results </button> </a></td>");
          echo("</tr>");
        }
        echo("</table>");
      } else {
        echo "No data available";
      }
    }

    function getRaceResults($raceId) {
      
      $sql = "SELECT * FROM races 
              INNER JOIN results ON results.raceId = races.raceId
              INNER JOIN drivers ON drivers.driverId = results.driverId
              INNER JOIN constructors ON constructors.constructorId = results.constructorId
              WHERE year = 2022 AND races.raceId = " . $raceId;
  
      $result = $this->db->query($sql);
      $data = [];

      while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
          $data[] = $row;
      }
      return json_encode($data);
    } 

    function getRaceQualification($raceId) {
      
      $sql = "SELECT * FROM races 
              INNER JOIN qualifying ON races.raceId = qualifying.raceId
              INNER JOIN drivers ON drivers.driverId = qualifying.driverId
              INNER JOIN constructors ON constructors.constructorId = qualifying.constructorId
              WHERE 
                year = 2022 AND 
                races.raceId = " . $raceId . "
              ORDER BY qualifyId";
  
      $result = $this->db->query($sql);
      $data = [];

      while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
          $data[] = $row;
      }
      return json_encode($data);
    } 

    function displayRacesResult($raceResults) {
      $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
      $host = $_SERVER['HTTP_HOST'];
      $scriptName = dirname($_SERVER['SCRIPT_NAME']);
      
      $root = $protocol . $host . $scriptName . '/';
      if ($raceResults) {
        echo("<table class='table table-dark table-hover'>");
        echo("<thead>
              <tr>
                <th>Pos</th>
                <th>Driver</th>
                <th>Constructor</th>
                <th>Laps</th>
                <th>Points</th>
              </tr>
            </thead>");
        foreach ($raceResults as $result) {
          echo("<tr>");
            echo("<td> " . $result->position . " </td>");
            echo("<td> <a href=" . $root ."drivers.php?driverRef=" . $result->driverRef . "> <button class='btn btn-primary'> " .  $result->driverRef . " </button> </a></td>");
            echo("<td> <a href=" . $root ."constructors.php?constructorRef=" . $result->constructorRef . "> <button class='btn btn-primary'> " .  $result->constructorRef . " </button> </a></td>");
            echo("<td> " . $result->laps . " </td>");
            echo("<td> " . $result->points . " </td>");
          echo("</tr>");
        }
        echo("</table>");
      } else {
        echo "No data available";
      }
    }

    function displayQualifications($qualifications) {
      $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
      $host = $_SERVER['HTTP_HOST'];
      $scriptName = dirname($_SERVER['SCRIPT_NAME']);
      
      $root = $protocol . $host . $scriptName . '/';

      if ($qualifications) {
        echo("<table class='table table-dark table-hover'>");
        echo("<thead>
              <tr>
                <th>Pos</th>
                <th>Driver</th>
                <th>Constructor</th>
                <th>Q1</th>
                <th>Q2</th>
                <th>Q3</th>
              </tr>
            </thead>");
        foreach ($qualifications as $qual) {
          echo("<tr>");
            echo("<td> " . $qual->position . " </td>");
            echo("<td> <a href=" . $root ."drivers.php?driverRef=" . $qual->driverRef . "> <button class='btn btn-primary'> " .  $qual->driverRef . " </button> </a></td>");
            echo("<td> <a href=" . $root ."constructors.php?constructorRef=" . $qual->constructorRef . "> <button class='btn btn-primary'> " .  $qual->constructorRef . " </button> </a></td>");
            echo("<td> " . $qual->q1 . " </td>");
            echo("<td> " . $qual->q2 . " </td>");
            echo("<td> " . $qual->q3 . " </td>");
          echo("</tr>");
        }
        echo("</table>");
      } else {
        echo "No data available";
      }
    }

  }
?>