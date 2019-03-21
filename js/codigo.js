$(document).ready(inicio);


$(document).on("click", '.cancelar', borrarorden);
$(document).on("click", '.hecho', cambiar_estado);
$(document).on("click", '.pedir', confirmarorden);
$(document).on("click", '.boton_tag', actualizar_sugerencias);

function inicio(){

	$("#sugerencias").load("php/menu.php");
	$("#pendientes").load("php/pendientes.php");
	$("#orden").load("php/orden.php");


	setInterval('actualizar_orden()', 1000);
	setInterval('actualizar_pedidos()', 1000);
	
}
function actualizar_sugerencias()
{	
	$(this).toggleClass("tag_activo");
	$("#sugerencias").load("php/menu.php?idtag="+ $(this).val());
}
function actualizar_orden()
{
      $("#orden").load("php/orden.php");
}
  function actualizar_pedidos()
{
     $("#pendientes").load("php/pendientes.php");
}
function anadeorden()
{
	$("#orden").load("php/orden.php?iditem="+ $(this).val());
}
function confirmarorden()
{
	var pagina = "confirmar_pedido.php?iditem="+ $(this).val();
	location.href=pagina;
	
}
function borrarorden()
{
	$("#orden").load("php/orden.php?idborrar="+ $(this).val());
}
function cambiar_estado()
{
	$("#pendientes").load("php/pendientes.php?idhecho="+ $(this).val());
}

function AutoRefresh( t ) {
	setTimeout("location.reload(true);", t);
}