<?php
  
  require_once('header.php');
  require_once('controller/Races.php');

  if (isset($_GET['raceId'])) {
    $raceId = $_GET['raceId'];
  }
?>

<main>
  <div class="container-fluid mt-3">
      <div class="container-fluid">
          <div class="row g-0">
              <div class="col-4">
                <h3> Season 2022 Races </h3>
                <?php 
                  // Get the current season information
                  // Rank Circuit Result -- These are the columns
                  $races = new Races();
                  $races->displayRaces(json_decode($races->getRaces(), true));
                ?>
              </div>
              <div class="col-4 p-5">
                <?php 
                 echo !isset($_GET['raceId']) ? "<p>Please select a race to see the qualifications.</p>" : $races->displayQualifications(json_decode($races->getRaceQualification($raceId)));
                ?>
              </div>
              <div class="col-4 p-5">
                <?php 
                 echo !isset($_GET['raceId']) ? "<p>Please select a race to see the results.</p>" : $races->displayRacesResult(json_decode($races->getRaceResults($raceId)));;
                ?>
              </div>
          </div>
      </div>
  </div>
</main>


<?php

  require_once('footer.php');

?>