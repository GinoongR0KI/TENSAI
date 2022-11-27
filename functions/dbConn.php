<?php

    $server = "localhost";
    $dbUsername = "u774227372_TENSAI";
    $dbPassword = "Tensai2022";
    $dbName = "u774227372_TENSAI";

    $db = new mysqli($server, $dbUsername, $dbPassword, $dbName);

    if ($db->connect_error) {
        die("Connection Failed: " . $db->connect_error);
    }