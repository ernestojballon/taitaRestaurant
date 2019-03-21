
	<?php 
			
 			 $Controlador=new Controlar_bd();
		     $Controlador->conectar();
			 $rows=$Controlador->llenar_Tags(); 
		?>
		<?php
			foreach ($rows as $row) {   
		?>
				<article class ="tag">
					<?php echo "<button class='boton_tag' value=".$row[0].">".$row[1]."</button>"; ?>
				</article>
			
		<?php } ?>