<?php
    require_once '../library/connection.php';
    require_once '../library/function.php';
    require_once '../model/user-model.php';
    require_once '../model/notes-model.php';

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

            $usr = $_SESSION['clientData']['id'];
            $notes = getNotes($usr);

            // Send them to the account view
            include '../view/account.php';
            exit;
            break;


        case 'register':
            // Filter and store the data
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

            $email = checkEmail($email);
            $existingEmail = checkExistingEmail($email);

            // Check for existing email address in the table
            if ($existingEmail) {
                $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
                include '../view/login.php';
                exit;
            }

            // Check for missing data
            if (empty($username) || empty($password) || empty($email)) {
                $message = '<p>Please provide information for all empty form fields.</p>';
                include '../view/registration.php';
                exit;
            }


            // Send the data to the model
            $regOutcome = regClient($username, $password, $email);

            // Check and report the result
            if ($regOutcome === 1) {
                setcookie('firstname', $username, strtotime('+1 year'), '/');
                // $message = "<p>Thanks for registering $username. Please use your email and password to login.</p>";
                $_SESSION['message'] = "Thanks for registering $username. Please use your email and password to login.";
                header('Location: ../home.php');
                // include '../view/login.php';
                exit;
            } else {
                $message = "<p>Sorry $username, but the registration failed. Please try again.</p>";
                include '../view/registration.php';
                exit;
            }
            break;

        default:
            include 'home.php';

    }

?>