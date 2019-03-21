<?php 
 			 session_start();
//----------------------------------
			 include "controlador_bd.php";
 			 $Controlador = new Controlar_bd();
		     $Controlador->conectar();
		     include "Aconsejador.php";
 			 $Consejero = new Aconsejador();
 			 if (!isset($_SESSION['pila']))
 			 {
 			 	$_SESSION['pila'] = array();	
 			 }
		    $borrado = 0;
 			if(isset($_GET['idtag']))
		     {
 				for($i = 0; $i < $_SESSION['contadortag']; $i++)
				{
					$idtag = $_SESSION['pila'][$i];
					if($_GET['idtag'] == $idtag)
					{
						array_splice($_SESSION['pila'], $i, 1);
						$_SESSION['contadortag']--;
						$borrado = 1;
					}
				}
				if($borrado == 0 )
				{
					array_push($_SESSION['pila'],$_GET['idtag']);
		     		$_SESSION['contadortag']++;
				}
		     	
		     }
		     if($_SESSION['contadortag']>0)
		     {
		     	$rows = $Consejero
		     		->aconsejar_kEnesimos($_SESSION['pila'],$_SESSION['contadortag']);
		     }	
		     else
		     {
		     	$rows = $Consejero->aconsejar_vacio(); 
		     }
//-----------------------------------
		    
		     
			 
		?>

			<h1 class="menutitulo">
				Sugerencias Taita:
			</h1>
			<section class="menu">
		<?php
			foreach ($rows as $row) {   
		?>
				<article class="item">
					<span class="nombre"><?php echo $row[1]; ?></span>
					<?php echo "<button class='pedir' value=".$row[0].">!</button>"; ?>
				</article>
			
		<?php } ?>
			</section>