<?php
	class Almacenador
{
	private $Controlador;
	public function __construct()
	{
		
	}
	public function almacenar_hecho($pilatag,$contador,$iditem)
	{
		$this->utilizar_bd();
		if(count($pilatag)!=0)
		{
			$calificacion = 1/count($pilatag);
			for($i = 0; $i < $contador; $i++)
			{
				$idtag = $pilatag[$i];
				$this->Controlador->actualizar_peso($idtag,$iditem,$calificacion);
			}
		}
	}
	public function almacenar_hechoN($pilatag,$contador,$idplato)
	{
		$this->utilizar_bd();
		
		
		if(count($pilatag)!=0)
		{
			$base = 1 / count($pilatag);
			for($i = 0; $i < $contador; $i++)
			{
				$calificacion = 0;
				$idtag = $pilatag[$i];
				$pesototaltag = $this->Controlador->buscarpesototal($idtag);
				$peso_id_tag = $this->Controlador->buscarpeso($idplato,$idtag);

			
				if($peso_id_tag == 0)
				{
						$porcentaje = 0;
				}else
				{
					$porcentaje = $peso_id_tag / $pesototaltag ;
				}
				
				if ($base <= $porcentaje)
				{
					$calificacion = $peso_id_tag - 
						((abs($porcentaje - $base)/2) * $pesototaltag);
				}
				else
				{
					$calificacion = $peso_id_tag + 
						((abs($porcentaje - $base)/2) * $pesototaltag);
				}
				//problema al actualizar peso revisar calificacion q sale 1 en la prueba

				/*echo "<br>peso del tag       es::: ". $peso_id_tag;
				echo "<br>peso total del tag es::: ". $pesototaltag;
				echo "<br>porcentaje       es::: ". $porcentaje;
				echo "<br>base       es::: ". $base;
				echo "<br>lo que le resto es::: ". ((abs($porcentaje - $base)/2)*$pesototaltag);
				echo "<br>el idtag        es::: ". $idtag;
				echo "<br>el iditem       es::: ". $idplato;
				echo "<br>el calificacion es::: ". $calificacion;
				echo "<br><br>";*/
				$this->Controlador->actualizar_KEnesimo($idtag,$idplato,$calificacion);
			}

		}

	}
	private function utilizar_bd()
	{
		$this->Controlador = new Controlar_bd();
		$this->Controlador->conectar();
	}
}
?>