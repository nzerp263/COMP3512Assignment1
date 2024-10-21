<?php  
require_once('./data/database.php');

?>

<!DOCTYPE html>
<html lang=en>
<head>
    <title>Assignment</title>
    <meta charset=utf-8>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/7.2.3/css/flag-icons.min.css" integrity="sha512-bZBu2H0+FGFz/stDN/L0k8J0G8qVsAL0ht1qg5kTwtAheiXwiRKyCq1frwfbSFSJN3jooR5kauE0YjtPzhZtJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body >  
    <header>
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Assignment #1 for COMP3512 at Mount Royal University</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mynavbar">
                <div class="navbar-nav me-auto"></div>
                <div class="d-flex btn-group">
                    <button class="btn btn-primary" type="button">
                        <a class="dropdown-item" href="index.php">Home</a>
                    </button>
                    <button class="btn btn-primary" type="button">
                        <a class="dropdown-item" href="browse.php">Browse</a>
                    </button>
                    <button class="btn btn-primary" type="button">
                        <a class="dropdown-item" href="api.php">APIs</a>
                    </button>
                </div>
            </div>
        </nav>
    </header>