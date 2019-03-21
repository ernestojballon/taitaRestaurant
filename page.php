<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<!-- <meta http-equiv="Page-Exit" content="revealTrans(Duration=2,Transition=1)">-->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SISTEMA WEB UAP</title>
<base href="http://uap.egrades.net/">
</head>
 
<script language="JavaScript"> 
var nave = navigator.appName 
if (nave == "Microsoft Internet Explorer"){
//direccion=("explorer.htm"); 
}else{

}
</script>
 
<script type="text/javascript" src="java/ajax.js"></script>
 
<link rel="stylesheet" type="text/css" href="css/css1.css">
 
 
<style> 
html,body,form
{
 margin:0;
 padding:0;
}
</style>
 
 
 
 
<script type="text/JavaScript"> 
 
function pulsar(e) { 
  tecla = (document.all) ? e.keyCode :e.which; 
  return (tecla!=13); 
} 
 
 
function checkEnter(e){
  var characterCode
  characterCode = (document.all) ? e.keyCode :e.which; 
 
    if (characterCode == 13) {
        return true;
    }
}
 
 
 
</script>
 
 
<body>

<form name="frmlogin" action="http://uap.egrades.net/interfaz2.php" method="post" >
 
 
<table>
<tr><td align="center">
</td></tr>
 
 
 
 
 
<tr>
<td style="text-align:center;">

</td>
</tr>
 
 
 
<tr>
<td>

<input type="hidden" name="pascodprivilegio" value="pri000000007">
<input type="hidden" name="pascodfacultad" value="">
<input type="hidden" name="pascodescuela" value="">
<input type="hidden" name="pascodfilial" value="">
<input type="hidden" name="pascodtperiodo" value="">
<input type="hidden" name="coordenada" value="C1">

Codigo<input type="text" name="usunombre" value="2010184684"/>
 
Clave<input type="password" name="usuclave" value="sgkm23" onkeypress="if(checkEnter(event)==true && this.value!=''){frmlogin.submit();};return pulsar(event);">

<input style="display:none;" type="button" name="btnautentificar" value="Autenticar">

<td>
</tr>

</table>
</form>
</body>
</html>