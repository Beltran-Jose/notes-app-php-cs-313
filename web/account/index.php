<?php

    require_once '../library/connection.php';
    require_once '../library/function.php';

    // Create or access a Session
    session_start();

    //variables

    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL) {
        $action = filter_input(INPUT_GET, 'action');
    }


    switch ($action) {
        case 'login':
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            $passwordCheck = checkPassword($password);

            // Run basic checks, return if errors
            if (empty($username) || empty($passwordCheck)) {
                $message = '<p class="notice">Please provide a valid email address and password.</p>';
                include '../index.php';
                exit;
            }

            // A valid password exists, proceed with the login process
            // Query the client data based on the email address
            $clientData = getClient($username);
            // Compare the password just submitted against
            // the hashed password for the matching client
            $hashCheck = password_verify($password, $clientData['password']);
            // If the hashes don't match create an error
            // and return to the login view
            if (!$hashCheck) {
                $message = '<p class="notice">Please check your password and try again.</p>';
                include '../view/login.php';
                exit;
            }
            // A valid user exists, log them in
            $_SESSION['loggedin'] = TRUE;
            // Remove the password from the array
            // the array_pop function removes the last
            // element from an array
            array_pop($clientData);
            // Store the array into the session
            $_SESSION['clientData'] = $clientData;
            setcookie('firstname', '', strtotime('-1 year'), '/');
            // Send them to the admin view
            include '../view/account.php';
            exit;
            break;

        default:
            include 'home.php';

    }

?>