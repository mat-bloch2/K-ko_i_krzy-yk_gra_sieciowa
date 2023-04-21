<?php
session_start();
$serialized_users = file_get_contents('zalogowani_dane_sesji/sesja.bin');
$Sesja= unserialize($serialized_users);
  if(file_exists('zalogowani_dane_sesji/'.$_SESSION['login'].'_'.$Sesja[$_SESSION['login']]['sparowany']))
  {
     $plansza=unserialize(file_get_contents('zalogowani_dane_sesji/'.$_SESSION['login'].'_'.$Sesja[$_SESSION['login']]['sparowany']));
     if($plansza['kolejak']==$_SESSION['login'])
     {
          $plansza['plansza'][$_POST['x']][$_POST['y']]=$Sesja[$_SESSION['login']]['znak'];
           $plansza['kolejak']=$Sesja[$_SESSION['login']]['sparowany'];

              include 'sprawdzanie_wygranych.php';
              file_put_contents('zalogowani_dane_sesji/'.$_SESSION['login'].'_'.$Sesja[$_SESSION['login']]['sparowany'],serialize($plansza));
     }
  }
else
{
     $plansza=unserialize(file_get_contents('zalogowani_dane_sesji/'.$Sesja[$_SESSION['login']]['sparowany'].'_'.$_SESSION['login']));
     if($plansza['kolejak']==$_SESSION['login'])
     {
           $plansza['plansza'][$_POST['x']][$_POST['y']]=$Sesja[$_SESSION['login']]['znak'];
           $plansza['kolejak']=$Sesja[$_SESSION['login']]['sparowany'];
          ///sprawdzanie wygranej
          include 'sprawdzanie_wygranych.php';
           file_put_contents('zalogowani_dane_sesji/'.$Sesja[$_SESSION['login']]['sparowany'].'_'.$_SESSION['login'],serialize($plansza));
     }
}

  echo json_encode($plansza['win']);



 ?>
