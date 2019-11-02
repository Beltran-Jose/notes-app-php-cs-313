
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
    case 'add-note':
        $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT);
        $notes_text = filter_input(INPUT_POST, 'notes_text', FILTER_SANITIZE_STRING);

        if (empty($user_id)) {
            $message = '<p class="form-error">All fields are required.</p>';
            include '../view/account.php';
            exit;
        }

        $newNoteResult = addNote($user_id, $notes_text);

        $message = "<p class='success-message'>The note has been added</p>";

        include '../view/account.php';
        break;

    default:
        include 'home.php';

}

?>

?>