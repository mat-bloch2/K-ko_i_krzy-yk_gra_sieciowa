<?php
session_start();
$serialized_users = file_get_contents('zalogowani_dane_sesji/sesja.bin');
$Sesja= unserialize($serialized_users);
if(file_exists('zalogowani_dane_sesji/'.$_SESSION['login'].'_'.$Sesja[$_SESSION['login']]['sparowany']))
{
  $scieszka='zalogowani_dane_sesji/'.$_SESSION['login'].'_'.$Sesja[$_SESSION['login']]['sparowany'];
}
else
{
   $scieszka='zalogowani_dane_sesji/'.$Sesja[$_SESSION['login']]['sparowany'].'_'.$_SESSION['login'];
}
unlink($scieszka);
unset($Sesja[$Sesja[$_SESSION['login']]['sparowany']]);
unset($Sesja[$_SESSION['login']]);
$serialized_users = serialize($Sesja);
file_put_contents('zalogowani_dane_sesji/sesja.bin',$serialized_users);










 ?>
