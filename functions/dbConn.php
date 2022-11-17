<?php

    $server = "containers-us-west-118.railway.app:5558";
    $dbUsername = "root";
    $dbPassword = "SkdO7uDoL8HLPtYXEnVN";
    $dbName = "railway";

    $db = new mysqli($server, $dbUsername, $dbPassword, $dbName);

    if ($db->connect_error) {
        die("Connection Failed: " . $db->connect_error);
    }