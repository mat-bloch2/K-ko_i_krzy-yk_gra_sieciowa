<?php
session_start();
$serialized_users = file_get_contents('zalogowani_dane_sesji/sesja.bin');
$Sesja= unserialize($serialized_users);
if(empty($Sesja[$_SESSION['login']]['sparowany']))
{
		$serialized_users = file_get_contents('zalogowani_dane_sesji/users.bin');
		$users = unserialize($serialized_users);
		if(!empty($users))
			array_push($users, $_SESSION['login']);
		else
		{
			$users=array($_SESSION['login']);
		}
		$serialized_users = serialize($users);
		file_put_contents('zalogowani_dane_sesji/users.bin',$serialized_users);
}

?>
<!doctype html>
<html lang="pl">
	<head>
		<meta charset="utf-8">
		<title>gra Kułko i Krzyżyk</title>
		<link href="jquery-ui.min.css" rel="stylesheet">



		<style>
			body,html {
				margin: 0px;
				padding: 0px;
				background-color: #f0f0f0;
			}
			#bar {
				position: fixed;
				bottom: 2px;
				left: 50%;
				margin-left: -237px;
				width: 460px;
				padding: 7px;
				text-align: center;
				opacity: 0.3;
			}
			#bar:hover {
				opacity: 1;
			}
			#controls {
				text-align: center;
			}
			#step {
				display: inline-block;
				width: 40px;
				background-color: #222;
			}

			.kafel{
				color:red;
				float: left;
				background-color:yellow;
				width: 13vw;
				height: 10vh;
				text-align: center;
				vertical-align: middle;
				border: 1px solid black;
				font-size: 4vw;
				white-space: nowrap;
			}
			#plansza{
				margin-top: 20vh;
				width: 80vw;
				height: 50vh;
				margin-left: 10vw;
				white-space: nowrap;

			}
			.wiersz{
				white-space: nowrap;
			}
			#wiadomosci
			{
				height: 30vh;
				overflow: scroll;
				background-color: #ffffff;
				color: black;
				align:left;
			}
			#wygrana
			{
			 text-align: center;
			}
		</style>
	</head>
	<body>
		<!-- Okienko panelu kontrolnego -->


		<div id="otwarcie_sesji_gry">
<h1>Czekaj aż otworzy się sesja dla tej rozgryfki</h1>
<h2>Sesja otworzy się jak bendą dostempni gracze</h2>
		</div>
		<div id="controls">
			<div id="row ">
		<div id="wiadomosci" class="form-control col-4 form-control-lg "  >
		</div>
		</div>
				<div id="row">
		<input type="text" id="send-mail" placeholder="messenge">
		<input id="wyslij_wiadomosc" type="submit">

      </div>
		</div>
		<div id="wygrana">
<div id="wynik">

</div>
<button class="wyloguj">wyloguj</button>
		</div>
		<!-- plansza -->
		<div id="plansza" >
		</div>
		<!-- Pasek narzędziowy -->
		<div id="bar" class="ui-widget ui-widget-content ui-corner-all">
			<button class="wyloguj">wyloguj</button>
			<button id="show-panel-button">Czat</button>
		</div>
		<!-- Import biblioteki -->
		<script src="jquery.js"></script>
		<script src="jquery-ui.min.js"></script>
		<!-- Skrypty JS -->
		<script>
			/* Funkcja inicjująca */
			var plansza=[];
			var ymax=6;
			var xmax=6;
function wyswietl_plansze() {

var i,j;
	for( i=0;i< ymax;i++)
	{

		 for( j=0;j<xmax;j++)
		 {
					 if(plansza['plansza'][i][j]==0)
					 {
						 var string="#_" +i+ "_"+ j;
						 string.toString()
						 $(string).html(" ");
					 }
					 else
					 if(plansza['plansza'][i][j]==1)
					{
						var string="#_" +i+ "_"+ j;
						string.toString()
						$(string).html("O");
					}
					else
					if(plansza['plansza'][i][j]==2)
					{
						var string="#_" +i+ "_"+ j;
						string.toString()
						$(string).html("X");
					}
		 }
}
}
function 	tworzenie_planszy() {
var dane=$('#plansza');
dane.html('');
var i,j;
			for( i=0;i< ymax;i++)
			{
				var wiersz=$('<div>');
				wiersz.addClass("wiersz");
				 for( j=0;j<xmax;j++)
				 {
								 var element=$('<div>');
								 element.addClass("kafel");
								 var string="_"+ i+ "_"+ j;
                 string.toString();
								 element.attr('id',string);
								 element.html(" ");
								 wiersz.append(element);

				 }
				 dane.append(wiersz);
			}
}
			function simulatorInit(){
				/* Utworzenie okna dialogowego z obiektu o id=controls  */
			  $('#controls').dialog({
					title: "Panel wiadomości",
					width: $('body').width()/2,
					autoOpen: false,
				});
				$('#otwarcie_sesji_gry').dialog({
			 	 modal: true,
			 	 title: "czekaj na rozgryfke",
			 	 width: $('body').width()/2,
			  });
				$('#wygrana').dialog({
					title: "Zwyciensca",
					width: $('body').width()/2,
					autoOpen: false,
				});

					$('#otwarcie_sesji_gry').dialog();
					var dane;
					 var interwal=setInterval(function () {
						$.post('otwarcie_sesji_gry.php',dane,function(data){
					 if(data==0)
					  {
								 $('#otwarcie_sesji_gry').dialog('close');
                 	console.log("sesja start!!");
									clearInterval(interwal);
						}
						      },'json');
					}, 1000);
				}
			$(document).ready(function () {
				tworzenie_planszy();
						simulatorInit();
				$('#show-panel-button').click( function(){
             var tmp=$('body').width()/25;
						 tmp.toString();
						$('#wiadomości').attr('cols',tmp);
						$('#controls').dialog('open');
				})
				$('#wyslij_wiadomosc').click(function () {
         var wiadomosci={
					   'send-mail': $('#send-mail').val()
					}
					console.log(wiadomosci['send-mail']);
					$.post('wiadomosci.php',wiadomosci);
				});

				$('.wyloguj').click(function () {

					$.post('zamykanie_sesji.php');
						location.href="login.php";

				});
				$('.kafel').on( "click", function zmiana_planszy() {
         var id=this.id;
				var out1={
					 'x':id[1],
					 'y':id[3],
				 };
				 $.post('zmiana_planszy.php',out1,function(dane){
             if(dane!=null)
						 {
					 $('#wynik').html('<h1>'+dane+'</h1>');
					 $('#wygrana').dialog('open');
				 }
				 },'json');
		     });
				var out;
				setInterval(function () {
					   out={
						 'plansza':plansza['plansza'],
						 'status':plansza['status'],
              'znak': plansza['znak'],
					 };
					$.post('plansza.php',out,function (dane) {
						plansza=dane;
            if(plansza['plansza']==null)
						{
							$('#wynik').html(<?php echo $_SESSION['login'];?>);
 						 $('#wygrana').dialog('open');
						}

						wyswietl_plansze();
						$('#wiadomosci').html(plansza['wiadomosci']);
					},'json');
		 }, 100);
			});
		</script>
	</body>
</html>
