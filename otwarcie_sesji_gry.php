<?php
session_start();
$serialized_users = file_get_contents('zalogowani_dane_sesji/users.bin');
$users = unserialize($serialized_users);
$serialized_users = file_get_contents('zalogowani_dane_sesji/sesja.bin');
$Sesja= unserialize($serialized_users);
if(empty($Sesja[$_SESSION['login']]['sparowany'])){
        foreach ($users as $key => $value) {
           if($value !==$_SESSION['login'])
                {

                      $Sesja[$users[$key]]['sparowany']=$_SESSION['login'];
                      $Sesja[$users[$key]]['znak']='1';
                      $Sesja[$_SESSION['login']]['sparowany']=$users[$key];
                      $Sesja[$_SESSION['login']]['znak']='2';
                      for ( $j = 0; $j <6; $j++) {
                            for ($i = 0; $i < 6; $i++) {
                                $plansza['plansza'][$j][$i]='0';
                            }
                      }
                            $plansza['kolejak']=$_SESSION['login'];
                            $plansza['win']=null;
                      file_put_contents('zalogowani_dane_sesji/'.$_SESSION['login'].'_'.$users[$key],serialize($plansza));
                      $serialized_users = serialize($Sesja);
                       file_put_contents('zalogowani_dane_sesji/sesja.bin',$serialized_users);
                        $users = \array_diff($users,[$_SESSION['login'],$value]);
                      $serialized_users = serialize($users);
                      file_put_contents('zalogowani_dane_sesji/users.bin',$serialized_users);
                      header('Content-Type: application/json');
                      echo json_encode('0');

               }
              }
        //      header('Content-Type: application/json');
              echo json_encode('null');

}
    else {
      //header('Content-Type: application/json');
      echo json_encode('0');
    }
?>
