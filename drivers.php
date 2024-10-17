<?php
  
  require_once('header.php');
  require_once('controller/Drivers.php');
 
 
 function getDriverDetails() {
    $driver = new Drivers();
    $driver = json_decode($driver->drivers($_GET['driverRef']), true);
    foreach ($driver as $row) {
      $driverDetails = array(
        "flag" => getFlag($row['nationality']),
        "forename" => $row['forename'],
        "surname" => $row['surname'],
        "dob" => $row['dob'],
        "age" => getAge($row['dob']),
        "nationality" => $row['nationality'],
        "url" => $row['url']
      );
    }

    return $driverDetails; // Return the flags array if needed
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

  function getDriverRaces() {
    $driver = new Drivers();


    $driverRaces = json_decode($driver->getDriverRaces($_GET['driverRef']), true);

    if ($driverRaces) {
      echo("<table class='table table-dark table-hover'>");
      echo("<thead>
            <tr>
              <th>Circuit</th>
              <th>Position</th>
              <th>Points</th>
            </tr>
          </thead>");
      foreach ($driverRaces as $race) {
        echo("<tr>");
          echo("<td> " . $race['name'] . " </td>");
          echo("<td> " . $race['position'] . " </td>");
          echo("<td> " . $race['points'] . " </td>");
        echo("</tr>");
      }
      echo("</table>");
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
                <h3> Drivers </h3>
                <?php 
                  $driver = getDriverDetails();
                  echo("<br/>Nationality: <img height='100' width='100' src='public/driver1.png'></img>");
                  echo("Forename: " . $driver['forename']);
                  echo("<br/>Surname: ". $driver['surname']);
                  echo("<br/>Age: " . $driver['age']);
                  echo("<br/>Nationality: <img height='100' width='100' src='https://raw.githubusercontent.com/lipis/flag-icons/02b8adceb338125c61f7a1d64d6e5bd9826ae427/flags/1x1/".$driver['flag'].".svg'></img>");
                  echo("<br/>URL: " . $driver['url']);
                ?>
              </div>
              <div class="col-8">
                <?php 
                  getDriverRaces();
                ?>
              </div>
          </div>
      </div>
  </div>
</main>


<?php

  require_once('footer.php');

?>