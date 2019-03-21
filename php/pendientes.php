<?php
session_start();
	
include "controlador_bd.php" ;
 			 $Controlador = new Controlar_bd();
		     $Controlador->conectar();
			 
if (isset($_GET["idhecho"]))
{
	$rows=$Controlador->cambiar_estado($_GET['idhecho']);
}
$rows = $Controlador->llenar_ordenes(0);


					foreach ($rows as $row)
					{  
				?>
					<article class="item">
						<div class="div_nombre">
							<p class="nombre"><?php echo $row[1];?> </p>
						</div>
						<div class="div_mesa">
							<p>MESA <?php echo $row[2];?></p>
						</div>
						<div class="div_hecho">
							<?php echo "<button class='hecho' value=".$row[0].">Tomado</button>"; ?>
						</div>
						<? if ($row[3]!="")
							{
								echo "<p class ='restriccion' value=".$row[0]."  >".$row[3]."</p>";
							}
						?>	
					</article>
				
				<?php
					}
				?>