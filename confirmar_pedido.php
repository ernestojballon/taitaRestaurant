<?php
session_start();
if(!isset($_GET['iditem']))
{
	// redirecciona a la pagina
         $host = $_SERVER["HTTP_HOST"];
         header("Location: http://$host/mesa.php");
         exit;
}

$iditem = $_GET['iditem'];
include "php/controlador_bd.php" ;
 			 $Controlador = new Controlar_bd();
		     $Controlador->conectar();
			 $rows = $Controlador->obtener_item($iditem);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Proyectos III:Confirmar pedido</title>
	<meta name="viewport" content="width=device-width, initial-scale=0.7">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
<?php 
	foreach ($rows as $row) {
?>
		<div class="contenedor_confirmar">
			<div class="contenedor_logo">
				<img class="imagen" src="imagenes/Taita.jpg">
			</div>
			<div class="detalles">
				<h1 class="etiqueta" >Estas a punto de ordenar:</h1>
				<div class="div_titulo">
					<h3><?php echo $row[1] ;?></h3>
					<div class="contenedor_foto">
						<img class="foto" src=<?php echo "'photos/".$row[3]."'";?> alt="">
					</div>
					
				</div>
				<div class="div_descripcion">
					<h3>Descripcion:</h3>
					<p class="descripcion">
						<?php echo $row[2] ;?>
					</p>
				</div>
			</div>	
			<form class="div_restriccion" method = "POST" action = "php/agregarpedido.php">
					<p class="titulo">Si quieres alguna caracteristica especial en tu pedido escribela aqui:</p>
					<textarea name = "restriccion" contenteditable="true" class="restriccion"></textarea>
					<button type = "submit" name = "iditem" value="<?php echo $row[0];?>" 
						class="ordenar">Confirmar pedido</button>
			</form>
		</div>
<?php }?>	
<a href="php/destruirsession.php"><------Volver....</a>
</body>
</html>