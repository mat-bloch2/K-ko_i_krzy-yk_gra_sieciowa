<?php

$wygrana=0;
for ( $i = 0; $i <6; $i++)
{
   if($plansza['plansza'][$i][$i]==$Sesja[$_SESSION['login']]['znak'])
   {
   $wygrana=1+$wygrana;

   }
}
   if($wygrana==6)
   {
     $plansza['win']=$_SESSION['login'];
   }
   $wygrana=0;
 for ( $i = 0; $i <6; $i++)
 {
      if($plansza['plansza'][(5-$i)][(5-$i)]==$Sesja[$_SESSION['login']]['znak'])
      {
        $wygrana=1+$wygrana;
      }
 }

   if($wygrana==6)
   {
     $plansza['win']=$_SESSION['login'];
   }
   $wygrana=0;
   for ( $j = 0; $j <6; $j++)
   {
       for ( $i = 0; $i <6; $i++)
       {
             if($plansza['plansza'][$j][$i]==$Sesja[$_SESSION['login']]['znak'])
             {
               $wygrana=1+$wygrana;

             }
       }
       if($wygrana==6)
       {
         $plansza['win']=$_SESSION['login'];
       }
       $wygrana=0;
   }

   for ( $j = 0; $j <6; $j++)
   {
       for ( $i = 0; $i <6; $i++)
       {
             if($plansza['plansza'][$i][$j]==$Sesja[$_SESSION['login']]['znak'])
             {
               $wygrana=1+$wygrana;

             }
       }
       if($wygrana==6)
       {
         $plansza['win']=$_SESSION['login'];
       }
       $wygrana=0;
   }
?>
