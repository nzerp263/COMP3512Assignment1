<?php

  require_once('header.php');
  $baseUrl = dirname($_SERVER['SCRIPT_NAME']).'/api';



?>

<div class="container mt-3">
  <h2>API List</h2>
  <table class="table table-dark table-hover">
    <thead>
      <tr>
        <th>URL - Endpoint</th>
        <th>Description</th>
      </tr>
    </thead>
    <tbody>
      <!-- Circuits -->
      <tr>
        <td>
          <a target="_blank" href="<?php echo $baseUrl . '/circuits.php'?>">/api/circuits.php</a>
        </td>
        <td>Returns all the circuits for the season</td>
      </tr>
      <tr>
        <td>
          <a target="_blank" href="<?php echo $baseUrl . '/circuits.php?circuitRef=monaco'?>">/api/circuits.php?circuitRef=monaco</a>
        </td>
        <td>Returns just the specified circuit (use the circuitRef field), e.g., /api/circuits.php?ref=monaco</td>
      </tr>

      <!-- Constructors -->
      <tr>
        <td>
          <a target="_blank" href="<?php echo $baseUrl . '/constructors.php'?>">/api/constructors.php</a>
        </td>
        <td>Returns all the constructors for the season</td>
      </tr>
      <tr>
        <td>
          <a target="_blank" href="<?php echo $baseUrl . '/constructors.php?constructorRef=mclaren'?>">/api/constructors.php?constructorRef=mclaren</a>
        </td>
        <td>Returns just the specified circuit (use the circuitRef field), e.g., /api/circuits.php?ref=monaco</td>
      </tr>

      <!-- Drivers -->
      <tr>
        <td>
          <a target="_blank" href="<?php echo $baseUrl . '/drivers.php'?>">/api/drivers.php</a>
        </td>
        <td>Returns all the drivers for the season</td>
      </tr>
      <tr>
        <td>
          <a target="_blank" href="<?php echo $baseUrl . '/drivers.php?driverRef=hamilton'?>">/api/drivers.php?driverRef=hamilton</a>
        </td>
        <td>Returns just the specified driver (use the driverRef field), e.g., /api/drivers/hamilton</td>
      </tr>
      <tr>
        <td>
          <a target="_blank" href="<?php echo $baseUrl . '/drivers.php?race=1106'?>">/api/drivers.php?race=1106</a>
        </td>
        <td>Returns the drivers within a given race, e.g., /api/drivers/race/1106</td>
      </tr>

      <!-- Races -->
      <tr>
        <td>
          <a target="_blank" href="<?php echo $baseUrl . '/races.php?raceId=1106'?>">/api/drivers.php?raceId=1106</a>
        </td>
        <td>Returns just the specified race. Don’t provide the foreign key for the circuit; instead provide the circuit name, location, and country.</td>
      </tr>
      <tr>
        <td>
          <a target="_blank" href="<?php echo $baseUrl . '/races.php?season=2022'?>">/races.php</a>
        </td>
        <td>Returns the races within the 2022 season ordered by round, e.g., /api/races/season/2022</td>
      </tr>

      <!-- Qualifying -->
      <tr>
        <td>
          <a target="_blank" href="<?php echo $baseUrl . '/qualifying.php?raceId=1106'?>">/api/qualifying.php?raceId=1106</a>
        </td>
        <td>Returns the qualifying results for the specified race, e.g., /api/qualifying/1106 Provide the same fields as with results for the foreign keys. Sort by the field position in ascending order.</td>
      </tr>

      <!-- Results -->
      <tr>
        <td>
          <a target="_blank" href="<?php echo $baseUrl . '/results.php?raceId=1106'?>">/api/results.php?raceId=1106</a>
        </td>
        <td>Returns the results for the specified race, e.g., /api/results/1106 Don’t provide the foreign keys for the race, driver, and constructor; instead provide the following fields: driver (driverRef, code, forename, surname), race (name, round, year, date), constructor (name, constructorRef, nationality). Sort by the field grid in ascending order (1st place first, 2nd place second, etc). 
        </td>
      </tr>
      <tr>
        <td>
          <a target="_blank" href="<?php echo $baseUrl . '/results.php?driverRef=max_verstappen'?>">api/results.php?driverRef=max_verstappen</a>
        </td>
        <td>Returns all the results for a given driver, e.g., /api/results/driver/max_verstappen</td>
      </tr>

    </tbody>
  </table>
</div>

<?php

  require_once('footer.php');

?>