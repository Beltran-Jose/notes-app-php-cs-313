<?php

    require_once '../library/connection.php';
    require_once '../library/function.php';
    require_once '../model/user-model.php';

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
            // $passwordCheck = checkPassword($password);

            // Run basic checks, return if errors
            if (empty($username) || empty($password)) {
                $message = '<p class="notice">Please provide a valid email address and password.</p>';
                include '../index.php';
                exit;
            }

            // A valid password exists, proceed with the login process
            // Query the client data based on the email address
            $clientData = getClient($username);

            if ($password != $clientData['password']) {
                $message = '<p class="notice">Please check your password and try again.</p>';
                include '../home.php';
                exit;
            }

            // A valid user exists, log them in
            $_SESSION['loggedin'] = TRUE;

            // Store the array into the session
            $_SESSION['clientData'] = $clientData;

            setcookie('firstname', '', strtotime('-1 year'), '/');

            // Send them to the account view
            include '../view/account.php';
            exit;
            break;

        default:
            include 'home.php';

    }

?>