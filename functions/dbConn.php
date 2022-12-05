<?php

    $server = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "tensaidb";

    $db = new mysqli($server, $dbUsername, $dbPassword, $dbName);

    if ($db->connect_error) {
        die("Connection Failed: " . $db->connect_error);
    }