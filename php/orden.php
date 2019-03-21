<?php 
session_start();

include "controlador_bd.php" ;
$Controlador=new Controlar_bd();
$Controlador->conectar();
if (isset($_GET["idborrar"]))
{
	$rows=$Controlador->borrar_item($_GET['idborrar']);
}
$rows = $Controlador->llenar_ordenes($_SESSION['mesa']);

	foreach ($rows as $row) 
	{   
				?>
				<article class="pedido">
					<span class="nombre">
						<? echo $row[1]; ?>
					</span>
					<?php echo "<button class='cancelar' value=".$row[0].">Cancelar</button>"; ?>
				</article>
					
<?php } ?>
									
			
			
		