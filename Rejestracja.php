
<?php
    // Start sesji
    session_start();
?>
<html>
    <head>
        <title>Rejestracja</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <h1>Rejestracja</h1>
                <form method="post" class="col-sm-12">
                    <input placeholder="user" type="text" class="col-sm-12" name="username" />
                    <input placeholder="email" type="email" class="col-sm-12" name="mail" />
                    <input placeholder="password" type="password" class="col-sm-12" name="password" />
                    <input class="col-sm-12" type="submit">
                </form>
                <?php
                if( !empty($_POST['username']) and !empty($_POST['password']) and !empty($_POST['mail']) ){
                    // Zapisanie danych do zmienny dla ułatwienia pracy

                    $user = $_POST['username'];
                    $pass = $_POST['password'];
                    $mail=$_POST['mail'];
                    $serialized_users = file_get_contents('users.bin');
                    $users = unserialize($serialized_users);
                    foreach ($users as $key => $value) {
                      if($user==$key)
                      {
                       echo "<div>dany login jest zajenty</div>";
                        return 0;
                      }
                    }
                    $users += [
                $user=>[
                      'pass'=>$pass,
                      'mail'=>$mail,
                      'mode'=>'user',
                    ],
                  ];
                      $serialized_users = serialize($users);
                      file_put_contents('users.bin',$serialized_users);
                    }
                ?>
                <a href="login.php"> Powrut do logowania</a>
            </div>
        </div>
    </body>
</html>
