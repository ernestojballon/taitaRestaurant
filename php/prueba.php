<?php
session_start();
		require("controlador_bd.php");
		$Controlador=new Controlar_bd();
		$Controlador->conectar();
		$rows=$Controlador->buscarpeso(2,1); 

    	echo "<br>";
    	echo "Actualizado ::::::<br>";
    	
    	$rows = $Controlador->llenar_items(0);
    	foreach ($rows as $row) 
        {   
        	echo '--------------------------------------------<br>';
	        echo 'id de plato:  '.$row[0]." <br>";
	        echo 'nombre : '.$row[1]."<br>";
	        echo 'descripcion : '.$row[2]."<br>";
	        echo 'NUEVO : '.$row[3]."<br>";
	        echo '--------------------------------------------<br>';
    	}
    	echo "lo que se encuentra en e array tag es:::::<br>";
    	for($i = 0; $i < $_SESSION['contadortag']; $i++)
    	{
    		echo "En la pila hay :".$_SESSION['pila'][$i]."<br>";
    	}
		for($i = 0; $i < count($rows); $i++)
		{ 
			$idplato =$rows[$i][0];
			$pesodetag = 0;
			if ($idplato==1)
			{
				$data=array(0 => 55,1 =>"Creadito",
					2 =>"plato creado",3 =>500);

				$rows[$i]=array_replace($rows[$i],$data);

			}

			for($j = 0; $j <$_SESSION['contadortag']; $j++)
			{
				$idtag =$_SESSION['pila'][$j];
				echo "El idplato es::".$idplato."<br>"; 
				echo "El idtag es::".$idtag."<br>"; 
				echo "el peso es::".$Controlador->buscarpeso($idplato,$idtag)."<br>";
				$peso = $Controlador->buscarpeso($idplato,$idtag);
				$pesodetag  = $pesodetag + $peso;
			}
			echo "EL PESO TOTAL ES :::::::". $pesodetag;
			echo "<br>---------------------------------------
			-----------------------------<br>";
			array_push($rows[$i],$pesodetag);
				 
		}
		$peso=array();
		for($i = 0; $i < count($rows); $i++)
		{
    		$id[$i] = $rows[$i][0];
    		$nombre[$i] = $rows[$i][1];
    		$descripcion[$i] = $rows[$i][2];
    		$peso[$i] = $rows[$i][3];
		}
		echo print_r($peso);
		array_multisort($peso, SORT_DESC, $nombre,$descripcion,$id,$rows);

		

    	include "Aconsejador.php";
 		$Consejero=new Aconsejador();
 		$resp = $Consejero->aconsejar_arbol($_SESSION['pila'],$_SESSION['contadortag']);
 		foreach ($resp as $row) 
        {   
        	echo '----------Probado con el algoritmo del arbol -----------------<br>';
	        echo 'id de plato:  '.$row[0]." <br>";
	        echo 'nombre : '.$row[1]."<br>";
	        echo 'descripcion : '.$row[2]."<br>";
	        echo 'NUEVO : '.$row[3]."<br>";
	        echo '--------------------------------------------<br>';
    	}
    	$resp = $Consejero->aconsejar_kEnesimos($_SESSION['pila'],$_SESSION['contadortag']);
 		foreach ($resp as $row) 
        {   
        	echo '----------Probado con el algoritmo del k-enesimos -----------------<br>';
	        echo 'id de plato:  '.$row[0]." <br>";
	        echo 'nombre : '.$row[1]."<br>";
	        echo 'descripcion : '.$row[2]."<br>";
	        echo 'NUEVO : '.$row[3]."<br>";
	        echo '--------------------------------------------<br>';
    	}
    	echo print_r($_SESSION['pila']);
    	echo "<br>".$_SESSION['contadortag'];
    	echo "<br>guardando plato 11 en la base de datos:::::<br>";
    	include "Almacenador.php";
		$Almacenador= new Almacenador();
    	$resp = $Almacenador->almacenar_hechoN($_SESSION['pila'],$_SESSION['contadortag'],11);
    	

?>