<?php

function notesConnect() {
    try {
        $dbUrl = getenv('postgres://lqxwheqfmouasz:abb3d2f0c728b83fe256d4ce9901102b85e403cf4009d22bb026230dce526510@ec2-23-21-109-177.compute-1.amazonaws.com:5432/d9vuclponvi0cc');
        // Get the various parts of the DB Connection from the URL
        $dbopts = parse_url($dbUrl);
        $dbHost = $dbopts["host"];
        $dbPort = $dbopts["port"];
        $dbUser = $dbopts["user"];
        $dbPassword = $dbopts["pass"];
        $dbName = ltrim($dbopts["path"], '/');
        // Create the PDO connection
        $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
        // this line makes PDO give us an exception when there are problems, and can be very helpful in debugging!
        $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $ex) {
        // If this were in production, you would not want to echo
        // the details of the exception.
        echo 'Error!: '.$ex -> getMessage();
        die();
    }
}

notesConnect();



?>