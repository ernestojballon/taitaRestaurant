<?php
	class Aconsejador
{
	private $Controlador;
	public function __construct()
	{
		
	}
	private function utilizar_bd()
	{
		$this->Controlador = new Controlar_bd();
		$this->Controlador->conectar();
	}
	public function aconsejar($pilatag,$contador)
	{
		$resp = " ";
		for($i = 0; $i < $contador; $i++)
		{
			$resp= $resp." elemento ".$i." = ".$pilatag[$i]."<br>";
		}
			
		
		return $resp;
	}
	public function aconsejar_vacio()
	{
		$this->utilizar_bd();
		$resp = $this->Controlador->llenar_items(0);
		return $resp;
	}
	public function aconsejar_uno($idtag)
	{
		$this->utilizar_bd();
		$resp = $this->Controlador->llenar_items($idtag);
		return $resp;

	}
	public function ordenar_menu($rows)
	{
		$peso=array();
		for($i = 0; $i < count($rows); $i++)
		{
    		$id[$i] = $rows[$i][0];
    		$nombre[$i] = $rows[$i][1];
    		$descripcion[$i] = $rows[$i][2];
    		$peso[$i] = $rows[$i][3];
		}
		
			array_multisort($peso, SORT_DESC, $nombre,$descripcion,$id,$rows);
		


		return $rows;
	}
	public function aconsejar_pesos($pilatag,$contador)
	{
		$this->utilizar_bd();
		$rows = $this->Controlador->llenar_items(0);
		for($i = 0; $i < count($rows); $i++)
		{ 
			$idplato = $rows[$i][0];
			$pesodetag = 0;
			for($j = 0; $j < $contador; $j++)
			{
				$idtag = $pilatag[$j];
				$peso = $this->Controlador->buscarpeso($idplato,$idtag);
				$pesodetag  = $pesodetag + $peso;
			}
			array_push($rows[$i],$pesodetag); 
		}
		$rows = $this->ordenar_menu($rows);
		return $rows;
				
	}
	public function aconsejar_arbol($pilatag,$contador)
	{
		$this->utilizar_bd();
		$rows = $this->Controlador->llenar_items(0);
		for($i = 0; $i < count($rows); $i++)
		{ 
			array_push($rows[$i],0); 
					
		}
		for($j = 0; $j < $contador; $j++)
		{
			$idtag = $pilatag[$j];

			for($i = 0; $i < count($rows); $i++)
			{ 
				$idplato = $rows[$i][0];
				$pesodetag = 0;
				echo "buscar arbol peso de idplato: ".$idplato." y el tag: ".$idtag."<br>";

				$peso_id_tag = $this->Controlador->buscarpeso($idplato,$idtag);
				$pesototaltag = $this->Controlador->buscarpesototal($idtag);
				if($peso_id_tag == 0)
				{
						$porcentaje = 0;
				}else
				{
					$porcentaje = $peso_id_tag / $pesototaltag ;
				}
				
				$insertar = $pesototaltag * $porcentaje;
				$rows[$i][3] = $rows[$i][3] + $insertar;
				
			}

			
		}
		$rows = $this->ordenar_menu($rows);
		return $rows;
	}
	public function aconsejar_kEnesimos($pilatag,$contador)
	{
		$this->utilizar_bd();
		$rows = $this->Controlador->llenar_items(0);
		for($i = 0; $i < count($rows); $i++)
		{ 
			array_push($rows[$i],0); 
					
		}
		for($j = 0; $j < $contador; $j++)
		{
			$idtag = $pilatag[$j];
			$sumadecuadrados=0;
			for($i = 0; $i < count($rows); $i++)
			{ 

				$idplato = $rows[$i][0];
				$pesodetag = 0;
				$peso_id_tag = $this->Controlador->buscarpeso($idplato,$idtag);
				$pesototaltag = $this->Controlador->buscarpesototal($idtag);
				if($peso_id_tag == 0)
				{
						$porcentaje = 0;
						$insertar = 0;
				}else
				{
					$porcentaje = $peso_id_tag / $pesototaltag ;
					$insertar = pow(abs($porcentaje - (1 / $contador)),2);
				}
				$rows[$i][3] = $rows[$i][3] + $insertar;
				
			}
			//echo "el peso del plato: ".$rows[$i][1]. "es: ".$rows[$i][3];
			
		}
		for($i = 0; $i < count($rows); $i++)
		{ 
			$rows[$i][3] = sqrt($rows[$i][3]);
					
		}
		$rows = $this->ordenar_kenesimos($rows);
		return $rows;

	}
		public function ordenar_kenesimos($rows)
	{
		$peso=array();
		for($i = 0; $i < count($rows); $i++)
		{
    		$id[$i] = $rows[$i][0];
    		$nombre[$i] = $rows[$i][1];
    		$descripcion[$i] = $rows[$i][2];
    		$peso[$i] = $rows[$i][3];
		}
		
			array_multisort($peso, SORT_ASC, $nombre,$descripcion,$id,$rows);
		


		return $rows;
	}

	

}