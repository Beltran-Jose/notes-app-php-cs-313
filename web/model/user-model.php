<?php 

    function getClient($username) {
        $db = connect_db();
        $sql = 'SELECT id, username, password, email
        FROM users
        WHERE username =:username';
        $stmt = $db -> prepare($sql);
        $stmt -> bindValue(':username', $username, PDO::PARAM_STR);
        $stmt -> execute();
        $clientData = $stmt -> fetch(PDO::FETCH_ASSOC);
        $stmt -> closeCursor();
        return $clientData;
    }

    function regClient($clientFirstname, $clientLastname, $username, $clientPassword) {
        // Create a connection object using the acme connection function
        $db = acmeConnect();
        // The SQL statement
        $sql = 'INSERT INTO clients (clientFirstname, clientLastname,username, clientPassword)
        VALUES(: clientFirstname,: clientLastname,: username,: clientPassword)
        ';
        // Create the prepared statement using the acme connection
        $stmt = $db -> prepare($sql);
        // The next four lines replace the placeholders in the SQL
        // statement with the actual values in the variables
        // and tells the database the type of data it is
        $stmt -> bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
        $stmt -> bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
        $stmt -> bindValue(':username', $username, PDO::PARAM_STR);
        $stmt -> bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
        // Insert the data
        $stmt -> execute();
        // Ask how many rows changed as a result of our insert
        $rowsChanged = $stmt -> rowCount();
        // Close the database interaction
        $stmt -> closeCursor();
        // Return the indication of success (rows changed)
        return $rowsChanged;
    }


    // Check for an existing username address
    function checkExistingusername($username) {
        $db = acmeConnect();
        $sql = 'SELECT username FROM clients WHERE username = :username';
        $stmt = $db -> prepare($sql);
        $stmt -> bindValue(':username', $username, PDO::PARAM_STR);
        $stmt -> execute();
        $matchusername = $stmt -> fetch(PDO::FETCH_NUM);
        $stmt -> closeCursor();
        if (empty($matchusername)) {
            return 0;
        } else {
            return 1;
        }
    }


    function checkForDuplicateUpdateusername($username, $clientId) {
        $db = acmeConnect();
        $sql = 'SELECT username FROM clients WHERE username = :username AND clientId != :id';
        $stmt = $db -> prepare($sql);
        $stmt -> bindValue(':username', $username, PDO::PARAM_STR);
        $stmt -> bindValue(':id', $clientId, PDO::PARAM_INT);
        $stmt -> execute();
        $matchusername = $stmt -> fetch(PDO::FETCH_NUM);
        $stmt -> closeCursor();
        if (empty($matchusername)) {
            return 0;
        } else {
            return 1;
        }
    }


?>

