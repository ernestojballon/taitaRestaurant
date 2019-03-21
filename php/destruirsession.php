<?
	session_start();
	unset($_SESSION['pila']);
	unset($_SESSION['contadortag']);
	$host = $_SERVER["HTTP_HOST"];
    $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
    header("Location: http://$host/mesa.php");
?>