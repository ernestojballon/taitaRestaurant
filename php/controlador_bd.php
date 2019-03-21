<?php
	class Controlar_bd
{
	
	public function __construct()
	{
	}
	public function conectar()
	{
	$host = "localhost";
	$user = "root";
	$pass = "";
	$bd = "Taita";
	$con = mysql_connect($host, $user, $pass);
	//codificacion utf 8 para que se vean bien los tildes y caracteres utf8
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'", $con);
	$resp = mysql_select_db($bd);

	
	}
	public function buscarItems($id)
	{
		if($id==0)
		{
			$sql = "Select id,nombre,descripcion from Item;";
		}
		else
		{
			$sql = sprintf("select i.id ,i.nombre,i.descripcion from Item i,Tag_item t,Tag a
					where t.id_item=i.id and a.id= t.id_tag and a.id=%s
					GROUP BY i.id 
							order by t.peso DESC;",$id);
		}
		$resp = mysql_query($sql);
		return $resp;
		
	}
	public function llenar_items($id)
	{
		$resp = $this->buscarItems($id);
		$data = array();
			
			while($row = mysql_fetch_row($resp))
			{
				$cadena=" ";
				$cadena=$cadena.$row[0].";".$row[1].";".$row[2];
				$data[]= explode(';',trim($cadena));
			}
			return $data;
	}
	public function buscarTags()
	{
		$sql = "Select id,nombre from Tag;";
		$resp = mysql_query($sql);
		return $resp;
		
	}
		public function llenar_Tags()
	{
		$resp = $this->buscarTags();
		$data = array();
			
			while($row = mysql_fetch_row($resp))
			{
				$cadena=" ";
				$cadena=$cadena.$row[0].";".$row[1];
				$data[]= explode(';',trim($cadena));
			}
			return $data;
	}
	public function buscarpeso($idplato,$idtag)
	{
		$sql = sprintf("Select peso from Tag_item where id_tag=%s and id_item=%s;"
			,$idtag,$idplato);
		$resp = mysql_query($sql);
			
			while($row = mysql_fetch_row($resp))
			{
				$cadena=" ";
				$cadena=$cadena.$row[0];
				$data= $row[0];
			}
		return $data;
		
	}
	public function buscarpesototal($idtag)
	{
		$sql = sprintf("Select sum(peso) from Tag_item where id_tag=%s;"
			,$idtag,$idplato);
		$resp = mysql_query($sql);
			
			while($row = mysql_fetch_row($resp))
			{
				$cadena=" ";
				$cadena=$cadena.$row[0];
				$data= $row[0];
			}

		return $data;
		
	}
	public function actualizar_peso($idtag,$iditem,$calificacion)
	{
		$peso = $this->buscarpeso($iditem,$idtag);
		$peso= $peso + $calificacion;
		$sql = sprintf("UPDATE Tag_item
						SET peso = %s
						WHERE id_tag=%s and id_item=%s;"
			,$peso,$idtag,$iditem);
		$resp = mysql_query($sql);

	}public function actualizar_KEnesimo($idtag,$iditem,$calificacion)
	{
		$peso = $this->buscarpeso($iditem,$idtag);
		$peso= $calificacion;
		$sql = sprintf("UPDATE Tag_item
						SET peso = %s
						WHERE id_tag=%s and id_item=%s;"
			,$peso,$idtag,$iditem);
		$resp = mysql_query($sql);

	}

	public function buscarItemPorId($id)
	{
		$sql=sprintf("select * from Item
		where id=%s;",$id);
		$result = mysql_query($sql);
		return $result;
		
	}
	public function obtener_item($id)
	{
		$resp = $this->buscarItemPorId($id);
		$data = array();
			
			while($row = mysql_fetch_row($resp))
			{
				$cadena=" ";
				$cadena=$cadena.$row[0].";".$row[1].";".$row[2].";".$row[3];
				$data[]= explode(';',trim($cadena));
			}
			return $data;
		
	}
	public function borrar_item($iditem)
	{
		$sql =sprintf('DELETE from Orden where id=%s;',$iditem);
		$result = mysql_query($sql);
		return $result;
	}
	public function cambiar_estado($idorden)
	{
		$sql =sprintf("UPDATE Orden SET estado='1' WHERE id=%s;",$idorden);
		$result = mysql_query($sql);
		return $result;
	}
	public function buscarOrdenes($idmesa)
	{
		if($idmesa==0)
		{
			$sql = sprintf("select o.id,i.nombre,m.id,o.restriccion from Item i, Orden o, Mesa m where o.id_item=i.id and o.id_mesa=m.id and o.estado='0' ORDER BY o.id DESC;");

		}
		else
		{
			$sql = sprintf("select o.id,i.nombre from Item i, Orden o where o.id_item=i.id and o.id_mesa='%s' and o.estado='0' ORDER BY o.id DESC;",$idmesa);

		}
		$result = mysql_query($sql);
		return $result;
	}
	public function llenar_ordenes($idmesa)
	{
		$resp = $this->buscarOrdenes($idmesa);
		$data = array();
			
			while($row = mysql_fetch_row($resp))
			{
				$cadena=" ";
				$cadena=$cadena.$row[0].";".$row[1].";".$row[2].";".$row[3];
				$data[]= explode(';',trim($cadena));
			}
			return $data;
	}



	public function login($user,$pass)
	{
		$sql = sprintf("SELECT * FROM mesa WHERE identificador='%s' AND contraseña='%s';",
                       mysql_real_escape_string($user),
                       mysql_real_escape_string($pass));
		$resp = mysql_query($sql);
		return $resp;
	}
	public function NumeroColumnas($result,$numero)
	{
		
		return mysql_num_rows($result) == $numero;
		
	}
	public function ConsultarTipoUsuario($user)
	{
		$sql = sprintf("select tipo.nombre from tipo where 
		(select usuario.tipoid from usuario where usuario.username='%s')=tipo.id;",
                       mysql_real_escape_string($user));
		$resp = mysql_query($sql);
		$row = mysql_fetch_row($resp);
		$data=$row[0];
		return $data;
	}

	public function agregar_pedido($iditem,$mesa,$restriccion)
	{
		$sql =sprintf("INSERT into Orden (estado,id_item,id_mesa,restriccion)
						values('0','%s','%s','%s'); ",$iditem,$mesa,$restriccion);
		$result = mysql_query($sql);
		return $result;
	}

}
?>