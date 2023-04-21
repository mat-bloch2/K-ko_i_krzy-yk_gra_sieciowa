<?php
session_start();
$serialized_users = file_get_contents('zalogowani_dane_sesji/sesja.bin');
$Sesja= unserialize($serialized_users);
  if(file_exists('zalogowani_dane_sesji/'.$_SESSION['login'].'_'.$Sesja[$_SESSION['login']]['sparowany']))
  {
     $plansza=unserialize(file_get_contents('zalogowani_dane_sesji/'.$_SESSION['login'].'_'.$Sesja[$_SESSION['login']]['sparowany']));
  }
else
{
     $plansza=unserialize(file_get_contents('zalogowani_dane_sesji/'.$Sesja[$_SESSION['login']]['sparowany'].'_'.$_SESSION['login']));
}



$plansza['znak']=$Sesja[$_SESSION['login']]['znak'];
echo json_encode($plansza);
 ?>
