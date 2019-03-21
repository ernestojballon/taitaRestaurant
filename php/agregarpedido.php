<?php

session_start();
$mesa = $_SESSION['mesa'];
$restriccion = $_POST["restriccion"];
$iditem = $_POST["iditem"];




include "controlador_bd.php" ;
 	$Controlador = new Controlar_bd();
	$Controlador->conectar();
	$Controlador->agregar_pedido($iditem,$mesa,$restriccion);
include "Almacenador.php";
	$Almacenador= new Almacenador();
	$Almacenador->almacenar_hechoN($_SESSION['pila'],$_SESSION['contadortag'],$iditem);


// redirecciona a la pagina
    $host = $_SERVER["HTTP_HOST"];
    header("Location: http://$host/php/destruirsession.php");
    exit;
?>