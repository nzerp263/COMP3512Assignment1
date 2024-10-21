<?php

  function getDBObject() {
    $dbFile = __DIR__ . '/f1.db';

    $db = new SQLite3($dbFile);

    if (!$db) {
      die("Connection failed: " . $db->lastErrorMsg());
    }

    return $db;
  }

  getDBObject();
?>