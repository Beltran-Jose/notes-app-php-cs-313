<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>account</title>
    <link rel="stylesheet" href="/styles/login-styles.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Your notes.</title>
</head>

<body>
    <header></header>
    <main>
        <h3>Welcome <?php echo $_SESSION['clientData']['username']; ?></h3>
        <!-- <?php 

            echo $connectionFunction;
            echo '<p>Welcome '.$_SESSION['clientData']['username'].'</p>';
            echo $_SESSION['clientData'];
            echo '<br>';
            echo $message;
            var_dump($notes);
        ?>  -->

        <main>
            <div class="wrapper fadeInDown">
                <div id="formContent">

                    <div class="fadeIn first">
                        <h2 class="login-title">Your Notas</h2>
                    </div>

                    <form action="/notes/index.php" method="POST">

                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['clientData']['id']; ?>">
                        <textarea type="textarea" id="notes_text" class="fadeIn second" name="notes_text"
                            placeholder="Your note"></textarea>

                        <input type="submit" class="fadeIn fourth" value="Add note">
                        <input type="hidden" name="action" value="add-note">

                    </form>

                        <?php
                            foreach($notes as $note){
                                echo '<form action="/notes/index.php" method="POST">
                                        <textarea name="notes_text">'.$note['notes_text'].'</textarea>
                                        <input type="hidden" name="id" value="'.$note['id'].'">
                                        <input type="submit" class="btn btn-primary" value="Update Note">
                                        <input type="hidden" name="action" value="update-note">
                                      </form>';
                            }
                            // echo include $_SERVER['DOCUMENT_ROOT'].'/common/modal.php';
                        ?>

                    <div id="formFooter">
                        <form action="../index.php" method="POST">
                            <input type="submit" class="fadeIn fourth btn-danger" value="Logout">
                            <input type="hidden" name="action" value="logout">
                        </form>
                    </div>

                </div>
            </div>
         
        </main>
        <footer></footer>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>
        <script>
            $('#myModal').appendTo("body");
        </script>
</body>

</html>