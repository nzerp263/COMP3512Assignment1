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
    </tbody>
  </table>
</div>

<?php

  require_once('footer.php');

?>