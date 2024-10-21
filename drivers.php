<?php
  
  require_once('header.php');
  require_once('controller/Drivers.php');
 
  $driver = new Drivers();

  function getDriverRaces() {
    $driver = new Drivers();

    $driverRaces = json_decode($driver->getDriverRaces($_GET['driverRef']), true);

    if ($driverRaces) {
      echo("<table class='table table-dark table-hover'>");
      echo("<thead>
            <tr>
              <th>Race</th>
              <th>Constructor</th>
              <th>Circuit</th>
              <th>Country</th>
              <th>Final Position</th>
              <th>Grid</th>
              <th>Points</th>
              <th>Fastest Lap Time</th>
              <th>Fastest Lap Speed</th>
            </tr>
          </thead>");
      foreach ($driverRaces as $race) {
        echo("<tr>");
          echo("<td> " . $race['race_name'] . " </td>");
          echo("<td> " . $race['co_name'] . " </td>");
          echo("<td> " . $race['ci_name'] . " </td>");
          echo("<td> " . $race['country'] . " </td>");
          echo("<td> " . $race['position'] . " </td>");
          echo("<td> " . $race['grid'] . " </td>");
          echo("<td> " . $race['points'] . " </td>");
          echo("<td> " . $race['fastestLapTime'] . " </td>");
          echo("<td> " . $race['fastestLapSpeed'] . " </td>");
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
              <?php

                if(isset($_GET['driverRef'])) {
                  $driver = $driver->getDriverDetails();
                  echo 
                  "<div class='card' style='max-width:80%'>
                    <img src='public/driver1.png' class='card-img-top' alt='...'>
                    <div class='card-body'>
                      <h5 class='card-title'>" . $driver['forename'] . " " . $driver['surname'] . "</h5>
                    </div>
                    <ul class='list-group list-group-flush'>
                      <li class='list-group-item'>" . $driver['age'] . " Years Old </li>
                      <li class='list-group-item'>" . $driver['code'] . " </li>
                      <li class='list-group-item'>
                          <img title='".$driver['nationality']."' alt='".$driver['nationality']."' class='mx-auto d-block img-fluid' style='border: 1px solid black;' height='100' width='100' src='https://raw.githubusercontent.com/lipis/flag-icons/02b8adceb338125c61f7a1d64d6e5bd9826ae427/flags/1x1/" . $driver['flag'] . ".svg' />
                      </li>

                    </ul>
                    <div class='card-body'>
                      <a href='" . $driver['url'] . "' class='card-link'>Click ME For More</a>
                    </div>
                  </div>";
                } else {
                  echo "<p>Driver reference is not passed in the URL</p>";
                }
                
                ?>
              </div>
              <div class="col-8">
                <?php 
                if(isset($_GET['driverRef'])) {
                  getDriverRaces();
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