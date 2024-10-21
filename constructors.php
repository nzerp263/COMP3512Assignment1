<?php
  
  require_once('header.php');
  require_once('controller/Constructors.php');
 
 
 function getDriverDetails() {
    $constructor = new Constructors();
    $constructor = json_decode($constructor->constructor($_GET['constructorRef']), true);
    foreach ($constructor as $row) {
      $constructorDetails = array(
        "flag" => getFlag($row['nationality']),
        "name" => $row['name'],
        "nationality" => $row['nationality'],
        "url" => $row['url']
      );
    }

    return $constructorDetails; // Return the flags array if needed
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

  function displayConstructor($constructor) {
    if ($constructor) {
      
      echo "<div class='card' style='width: 18rem;'>
        <img src='https://raw.githubusercontent.com/lipis/flag-icons/02b8adceb338125c61f7a1d64d6e5bd9826ae427/flags/1x1/".$constructor['flag'].".svg' class='card-img-top' title='" . $constructor['nationality'] . "' alt='" . $constructor['nationality'] . " '>
        <div class='card-body'>
          <h5 class='card-title'>" . $constructor['name'] . " </h5>
          <a href='" . $constructor['url'] . "' class='btn btn-primary'>Read More</a>
        </div>
      </div>";
      
      echo("</table>");
    } else {
      echo "No data available";
    }
  }

  function displayDriversAndRaces($driversRaces) {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
    $host = $_SERVER['HTTP_HOST'];
    $scriptName = dirname($_SERVER['SCRIPT_NAME']);
    
    $root = $protocol . $host . $scriptName . '/';

    if ($driversRaces) {
      echo("<table class='table table-dark table-hover'>");
      echo("<thead>
            <tr>
              <th>Round</th>
              <th>Circuit</th>
              <th>Driver</th>
              <th>Position</th>
              <th>Points</th>
            </tr>
          </thead>");
      foreach ($driversRaces as $race) {
        echo("<tr>");
        echo("<td> " . $race['round'] . " </td>");
        echo("<td> " . $race['name'] . " </td>");
        echo("<td> <a href=" . $root ."drivers.php?driverRef=" . $race['driverRef'] . "> <button class='btn btn-primary'> " .  $race['forename'] . " " . $race['surname'] . " </button> </a></td>");
        echo("<td> " . $race['position'] . " </td>");
        echo("<td> " . $race['points'] . " </td>");
      echo("</tr>"); 
      }echo("</table>");
    } else {
      echo "No data available";
    }
  }

?>

<main>
  <div class="container-fluid mt-3">
      <div class="container-fluid">
          <div class="row g-0">
              <div class="col-4">
                <h3> Constructor Details </h3>
                <?php
                if(isset($_GET['constructorRef'])) {
                  $constructor = new Constructors();
                  displayConstructor($constructor->displayConstructor());
                } else {
                  echo "<p>Constructor reference is not passed in the URL</p>";
                }
                ?>
              </div>
              <div class="col-8">
                <?php 
                if(isset($_GET['constructorRef'])) {
                  displayDriversAndRaces(json_decode($constructor->getDriversAndRaces($_GET['constructorRef']), true));
                }
                ?>
              </div>
          </div>
      </div>
  </div>
</main>


<?php

  require_once('footer.php');

?>