<?php
session_start();

if(!$_SESSION['mesa'])
{
	// redirecciona a la pagina
         $host = $_SERVER["HTTP_HOST"];
         header("Location: http://$host/inicio.php");
         exit;
}



include "php/controlador_bd.php" ;
if(!isset($_SESSION['contadortag']))
{
	$_SESSION['contadortag']=0;
}
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Proyectos III:mesa</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/estilo.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/codigo.js"></script>
</head>
<body>
	<div class="contenedor">
		<div class="contenedor1" id="sugerencias">

		</div>
		<div class="contenedor2">
			<div class="reportero">
				<div class="pregunta">
					<h4 class='titulo'> TAG mas seleccionados:</h1>
					<section class="respuestas">
						<?php include "php/tags.php" ?>
					</section>
					<a class = "boton_destruir" href="php/destruirsession.php">Resetear tags</a>
				</div>
			</div>
		</div>
		<div class="contenedor3">
			<div class="orden">
				<h1 class="miorden">Ordenes para esta mesa:</h1>
				<section class= "pedidos" id="orden" >
				</section>

			</div>
		</div>
	</div>
	
</body>
</html>