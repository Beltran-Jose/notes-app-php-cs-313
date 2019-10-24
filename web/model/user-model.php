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

    function regClient($username, $password, $email) {
        // Create a connection object using the acme connection function
        $db = connect_db();
        // The SQL statement
        $sql = 'INSERT INTO users (username, password, email)
        VALUES(:username,:password,:email)
        ';
        // Create the prepared statement using the acme connection
        $stmt = $db -> prepare($sql);
        // The next four lines replace the placeholders in the SQL
        // statement with the actual values in the variables
        // and tells the database the type of data it is
        $stmt -> bindValue(':username', $username, PDO::PARAM_STR);
        $stmt -> bindValue(':password', $password, PDO::PARAM_STR);
        $stmt -> bindValue(':email', $email, PDO::PARAM_STR);
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
        $db = connect_db();
        $sql = 'SELECT username FROM users WHERE username = :username';
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

    // Check for an existing email address
    function checkExistingEmail($clientEmail) {
        $db = connect_db();
        $sql = 'SELECT email FROM users WHERE email = :email';
        $stmt = $db -> prepare($sql);
        $stmt -> bindValue(':email', $email, PDO::PARAM_STR);
        $stmt -> execute();
        $matchEmail = $stmt -> fetch(PDO::FETCH_NUM);
        $stmt -> closeCursor();
        if (empty($matchEmail)) {
            return 0;
        } else {
            return 1;
        }
    }

?>

