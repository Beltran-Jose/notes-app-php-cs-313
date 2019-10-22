<?php

// Create or access a Session
session_start();

//variables

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}


switch ($action) {
    case 'login':
          header('Location: /view/account.php');
        break;

    default:
        include 'home.php';

}

?>