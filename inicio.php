<?
   
    session_start();
	require("php/controlador_bd.php");
   
    if (isset($_POST["user"]) && isset($_POST["pass"]))
    {
		
		$user=$_POST["user"];
		$pass=$_POST["pass"];
		$Controlador=new Controlar_bd();
		$Controlador->conectar();
		$result =$Controlador->login($user,$pass);

		
         if ($result === false)
            die("password o usuario incorrecto");

        //chekea si se encontro una fila
        if ($Controlador->NumeroColumnas($result,1))
        {   
          //recuerda nombre de usurario y tipo
			   $_SESSION['mesa']=$user;

          // redirecciona a la pagina
			   if ($_SESSION['mesa']=='cocina')
			   {
			   		$host = $_SERVER["HTTP_HOST"];
        			$path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
         			header("Location: http://$host/cocina.php");
         			exit;
			   }else
			   {
			  	 	$host = $_SERVER["HTTP_HOST"];
        		 	$path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
         			header("Location: http://$host/mesa.php");
        			 exit;
			   }
         
        }
		    else
        {
			       ?>
				  <script  language="javascript"> 
                alert("Usuario o Contraseña incorrectos"); 
                </script>
<?php
		    }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Proyectos III:login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
<div class="contenedorlogin">
	<div class="contenedor_logo">
		<div class="logo">
			<img class="imagen" src="imagenes/Taita.jpg">
		</div>
	</div>
	<form action="<?= $_SERVER["PHP_SELF"] ?>" method="post" class="login">
		<p class="etiqueta" >Identificador:</p>
		<input type="text" caption="Usuario" name="user" class="textbox" placeholder="Identificador de mesa aqui">
		<p class="etiqueta">Contraseña:</p>
		<input type="password" caption="Contraseña" name="pass" class="textbox" placeholder="Contraseña aqui">
		<input type="submit" class="boton" value="Ingresar">
	</form>
</div>	
</body>
</html>