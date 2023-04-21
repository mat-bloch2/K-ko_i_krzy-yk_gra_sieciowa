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

$dane=unserialize(file_get_contents($scieszka));
if(empty($dane['wiadomosci']))
{
  $dane['wiadomosci']='<b>'.$_SESSION['login'].':</b><br>'.$_POST['send-mail'];
}
else
{
  $dane['wiadomosci']=$dane['wiadomosci'].'<br><b>'.$_SESSION['login'].':</b><br>'.$_POST['send-mail'];
}
file_put_contents($scieszka,serialize($dane));
return 0;
 ?>
