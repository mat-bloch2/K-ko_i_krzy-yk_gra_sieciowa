<html>
    <head>
        <title>PHP - Sesje</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <?php
                    if( !empty($authError) )
                        echo '<h1>'.$authError.'</h1>';
                ?>
                <h1 class="col-sm-12">Logowanie do gry:</h1>
                <form method="post" class="col-sm-12">
                    <input placeholder="Give username" type="text" class="col-sm-12" name="username" />
                    <input placeholder="Give password" type="password" class="col-sm-12" name="password" />
                    <input class="col-sm-12" type="submit">
                </form>
                <?php
                    // Start sesji
                    session_start();
                    // Wylogowywanie
                    // Zmienne pomocnicze
                    $authError = '';

                    // Czy przesłano dane autoryzacyjne
                    if( !empty($_POST['username']) and !empty($_POST['password']) ){
                        // Zapisanie danych do zmienny dla ułatwienia pracy
                        $user = $_POST['username'];
                        $pass = $_POST['password'];
                        $serialized_users = file_get_contents('users.bin');
                        $users = unserialize($serialized_users);
                        // Tablica użytkowników
                        foreach ($users as $key => $value) {
                          if($user==$key)
                          {
                            if($users[$key]['pass']==$pass)
                            {
                            $_SESSION['mode']=$users[$key]['mode'];
                            $_SESSION['pass']=$users[$key]['pass'];
                            $_SESSION['login']=$key;
                                  if($_SESSION['mode']=='admin')
                                  header("Location:init_user_base.php");
                                    else
                                  header("Location: gra.php");

                                  return 0;
                            }
                          }
                        }

                        echo "<div class='col-12'>Podany login i hasło nie są Poprawne </div>";
                    }

                ?>
                <a class="col-3"href="change_pass.php"> zapomiałeś hasła</a>
                <div class="col-7"></div>
                <a class="col-2" href="Rejestracja.php">Rejestracja</a>

            </div>
        </div>
    </body>
</html>
