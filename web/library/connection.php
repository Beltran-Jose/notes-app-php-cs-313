<?php

    $connectionFile = '<p class="notice">db file has ran.</p>';

    /*Function for connecting to the database. Rather than needing every page to connect*/
    function connect_db() {
        $db == NULL;
        try {
            $dbUrl = getenv('DATABASE_URL');
            $dbOpts = parse_url($dbUrl);
            $dbHost = $dbOpts["host"];
            $dbPort = $dbOpts["port"];
            $dbUser = $dbOpts["user"];
            $dbPassword = $dbOpts["pass"];
            $dbName = ltrim($dbOpts["path"], '/');
            $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
            //echo $dbHost.$dbPort.$dbUser.$dbName;
            $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            echo 'Error!: '.$ex -> getMessage();
            die();
        }
        return $db;
        $connectionFunction = '<p class="notice">connection function ran</p>';
    } 
?>