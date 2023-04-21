<?php

    $serialized_users = file_get_contents('users.bin');

    $users = unserialize($serialized_users);

    echo 'Users table <pre>';
    var_dump($users);
    echo '</pre>';

?>
