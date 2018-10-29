<?php
ini_set('display_errors', 'On');//DEBUG DE CODIGO  PONER EN On
mb_internal_encoding("UTF-8");//--codificacion para que acepte tildes y eñes--//
date_default_timezone_set('America/Lima');//--hora de servidor para los registros--//
function died($error) {//--funcion de error
	echo 'Lo sentimos, hubo un error en sus datos y el formulario no puede ser enviado en este momento.<br/><br/>'; //----¿este texto podria ser un html?-------
	echo 'Detalle de los errores.<br/><br/>';
	echo $error.'<br/><br/>';
	echo 'Porfavor corrija estos errores e inténtelo de nuevo.<br/><br/>';//POR CADA LINEA UN ECHO
	die();
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST['cf_name'])||isset($_POST['cf_tel'])||isset($_POST['cf_email'])||isset($_POST['cf_message'])){//--variable de recojida de datos
	$flag=true;//VERIFICAR NO MANDE A LANDIG EN CASO DE ERROR
	$bdhost="blue58.dnsmisitio.net";//--DNS DEL HOSTING
	$bduser="vapeoxpr_elite";//-- USUARIO DE LA BD--  -- ANTES EN SQL REMOTO TENGO QUE AGREGAR ADMINISTRADOR REMOTO % PARA QUE FUNE
	$bdpass="C4tntnox";//--PASS DE EL USUARIO DE LA BD
	$conexion=mysql_connect($bdhost, $bduser, $bdpass)or die(mysql_error());//ESTA ES LA VARIABLE DE CONEXION
	mysql_select_db("vapeoxpr_elitemodellook", $conexion);//SELECCIONA LA BASE DE DATOS DESEADA ESTA PREVIAMENTE DE DE EXISTIR
	mysql_set_charset("utf8", $conexion);//CODIFICACION DE LOS CARACTERES UTF-8
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$email_subject='Contacto Web'; //DEVERIA PODER CONCATENARLO ASI //CONTACTO WEB DE LA PAGINA DE IMARKETING AREA DE .$CB//ASUNTO DEL CORREO EL SUBJET DE TO LA VIDA
	$email_subject2='hola';// ESTE DEVERIA SER HOLA . &N NOS MANDASTES UN CORREO PRONTO TE RESPONDEREMOS
	$n=$_POST['cf_name'];//DECLARAMOS EL FORMULARIO EN VARIABLES
    $t=$_POST['cf_tel'];
    $e=$_POST['cf_email'];
    $m=$_POST['cf_message'];
    $f=date('d/m/Y');//DECLARAMOS FECHA Y HORA
    $h=date('H:i:s');
    $error_message = 'Error';//VARIABLE DE MENSAJE DE ERROR
    $email_to='katherine@elitemodellookperu.pe';
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';//VALIDACION DE CORREO
    if(!preg_match($email_exp,$e)) {
	    $error_message.='La dirección de correo proporcionada no es válida.<br/>';//ERROR DE CORREO
	}
	$string_exp="/^[A-Za-z .'-]+$/";
 	if(!preg_match($string_exp,$n)) {
    	$error_message.='El formato del nombre no es válido<br />';
    }
    $telefono_exp='/^[0-9-]*$/';
    if(!preg_match($telefono_exp, $t)){
    	$error_message.='el formato del Telefono no es válido.<br />';
    }
    if(!preg_match($string_exp, $m)) {
    	$error_message .= 'El formato del texto no es válido.<br />';
  	}
  	if(strlen($error_message) < 0) {
	    died($error_message);
	}//-----------------------------------CONTENIDO DE EL EMAIL---------------------------------
	

	$email_message='
	<html lang="es">
	    <head>
	      <title>mensaje recibido</title>
	    </head>
	    <body style="background-color:#F7F7F7;padding:10px;">
	      <header style="padding:8px;" width="100%" border="0" align="center" cellpadding="8" cellspacing="0; background-color:#F7F7F7;border:#d2d2d2 1px solid;border-right:none;padding:10px;">
	        <div class="titulo" style="background-color:#F7F7F7;padding:10px;"><H1>Nuevo Contacto De La Web</H1></div>
	        <!-- <img src="http://s6.postimg.org/3ovnnnno1/EML_2016_PERU.jpg" width="75" height="75" alt="logo de imarketing" align="center !important" style="background-color:#F7F7F7;padding:10px;"> -->
	      </header>
	      <div class="contenido">
	        <p style="background-color:#F7F7F7;border:#d2d2d2 1px solid;border-right:none;padding:10px;color:#737373;font-family:Tahoma, Geneva, sans-serif;font-size:18px;font-weight:400;margin:0px 0px 5px 0px;">
	          Al ATAQUEEEEEE11 <br> 
	          Chicos Llego un nuevo lead y se llama ' .$n. ' <br>
	          A las ' .$h. ' <br>
	          Del día ' .$f. '<br>
	          Indico que lo pueden contactar al E-Mail ' .$e. ' <br>
	          O al telefono: ' .$t. ' <br>
	          Que Tengas un Buen Dia, que digo bueno, <H2>!UN GRAN DIA¡</H2>
	        </p>
	        <footer style="background-color:#F7F7F7;padding:10px;color:#737373;font-family:Tahoma, Geneva, sans-serif;font-size:18px;font-weight:400;margin:0px 0px 5px 0px;">
	          <!-- <img src="http://s6.postimg.org/3ovnnnno1/EML_2016_PERU.jpg" width="75" height="75" alt="logo de imarketing" align="center" style="background-color:#F7F7F7;padding:10px;"> -->
	        </footer>
	      </div>
	    </body>
	    </html>
	    ';
	
	$headers="content-type:text/html;charset=UTF-8"."\r\n".//DECLARO QUE EL CORREO SERA HTML
	'From: '.$e."\r\n".  //SE ENVIA DESDE "USUARIO QUE ENVIO EL CORREO" 
	'Reply-To: '.$e."\r\n".//RESPONDER AL USUARIO QUE ENVIO EL CORREO
	'X-Mailer: PHP/' . phpversion();
	@mail($email_to, $email_subject, $email_message, $headers);//FUNCION QUE ENVIA EL CORREO
//////////////////////////////////////correo del lado cliente//////////////////////////////////////////////////
	$email_message2='
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head><meta content="en-us" http-equiv="Content-Language"><meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<title>Delicious Mail 2</title>
	<style type="text/css">body {
	margin:0;
	padding:0;
	background-color:#eeeeee;
	color:#999999;
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	-webkit-text-size-adjust: none;
}
h1, h2, h3, h4, h5, h6 {
	color:#39434d !important;
	margin-bottom:10px !important;
}
a, a:link, a:visited {
	color:#777777;
	text-decoration:none;
	border-bottom:1px #777777 dotted;
}
a:hover, a:active {
	text-decoration:none;
	color:#0f79aa !important;
	border-bottom:1px #0f79aa dotted !important;
}
img {
	border:0;
}
.highlighted {
	background-color:#FFFFCC;
}
/*Hotmail and Yahoo specific code*/
.ReadMsgBody { width: 100%;}
.ExternalClass {width: 100%;}
.yshortcuts { color: #999999 }
.yshortcuts a span { color: #777777 }
/*Hotmail and Yahoo specific code*/
	</style>
</head>
<body link="#777777" vlink="#777777">
<table align="center" cellpadding="0" cellspacing="0" id="container" style="width: 100%; margin:0; padding:0; background-color:#eeeeee;"><!-- Start of main container -->
	<tbody>
		<tr>
			<td style="padding:0 20px;"><!--Start of Logo and view online | forward links-->
			<table align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; text-align:left; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px; line-height:15pt; color:#999999; margin:0 auto;" width="620">
				<tbody>
					<tr>
						<td style="color:#ffffff; padding:20px 0;"><img align="left" alt="Logo" border="0" hspace="0" width="100" src="http://s6.postimg.org/3ovnnnno1/EML_2016_PERU.jpg" vspace="0" /></td>
					</tr>
				</tbody>
			</table>
			<!--End of Logo and view online | forward links--><!--Start of letter/invitation container - row#1-->

			<table align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; text-align:left; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px; line-height:15pt; color:#999999; margin:0 auto;" width="620">
				<tbody>
					<tr>
						<td bgcolor="#FFFFFF" height="5" style="font-size:2px; line-height:0px;" valign="top">
						<table cellpadding="0" cellspacing="0" style="border-collapse:collapse; border-spacing: 0; margin:0; padding:0; line-height:0px;" width="620">
							<tbody>
								<tr>
									<td bgcolor="#2a8fbd" height="5" style="font-size:2px; line-height:0px;" valign="top" width="5"><img align="right" alt="" border="0" height="5" hspace="0" src="http://s6.postimg.org/v4fhlzdl9/border_Top_Left4.gif" style="display:block;" vspace="0" width="5" /></td>
									<td bgcolor="#2a8fbd" height="5" style="font-size:2px; line-height:0px;" valign="top" width="109">&nbsp;</td>
									<td bgcolor="#2a8fbd" style="font-size:2px; line-height:0px;" valign="top" width="6">&nbsp;</td>
									<td height="5" style="font-size:2px; line-height:0px;" valign="top" width="495">&nbsp;</td>
									<td height="5" style="font-size:2px; line-height:0px;" valign="top" width="5"><img align="right" alt="" border="0" height="5" hspace="0" src="http://s6.postimg.org/5kd7fjs7h/border_Top_Right.gif" style="display:block;" vspace="0" width="5" /></td>
								</tr>
								<tr>
									<td bgcolor="#2a8fbd" style="font-size:2px; line-height:0px;" valign="top" width="5">&nbsp;</td>
									<td bgcolor="#2a8fbd" style="padding:10px 4px 15px 5px; font-family:Arial, Helvetica, sans-serif;  font-size:24px; line-height:24pt; font-weight:bold; color:#ffffff; text-align:center;" valign="top" width="200">Ya estás registrada para el casting del Elite Model Look Perú 2016</td>
									<td bgcolor="#2a8fbd" style="font-size:2px; line-height:0px; padding:15px 0 0 0;" valign="top" width="6"><img alt="image" border="0" height="11" hspace="0" src="http://s6.postimage.org/d2wco6jkd/arrow_Left2.gif" width="6" /></td>
									<td style="padding:10px 15px 15px 20px; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:15pt; color:#999999;" valign="top" width="460">
									<h2 style="padding:0; font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:17pt; color:#39434d; font-weight:lighter; margin-top:0; margin-bottom:10px !important;">Recuerda que debes llevar tus documentos y de ser menor de edad, la autorización firmada de tus padres. <br>
 
CASTING LIMA <br>	
Fecha: 25 de Junio <br>
Hora: 11:00 am - 4:00 pm <br>
Lugar: Centro Comercial Plaza Norte <br>|

 
 
Saludos,
									<table align="right" cellpadding="0" cellspacing="0" style="border-collapse: collapse; border-width: 0; font-size:12px;" width="220">
										<tbody>
											<tr>
												<td style="padding:24px 10px 0 0;" valign="top" width="75"><img align="left" alt="image" border="0" height="90" hspace="0" src="http://s6.postimg.org/3ovnnnno1/EML_2016_PERU.jpg" style="display: block;" width="90" /></td>
												<td style="text-align:center; padding:20px 0 0 0;"><span style="padding:0; font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:17pt; color:#39434d; font-weight:lighter; margin:0;">Katherine Luy</span><br />
												Directora del Elite Model Look Perú</td>
											</tr>
										</tbody>
									</table>
									</td>
									<td style="font-size:2px; line-height:0px;" valign="top" width="5">&nbsp;</td>
								</tr>
								<tr>
									<td bgcolor="#2a8fbd" height="5" style="font-size:2px; line-height:0px;" valign="top" width="5"><img align="right" alt="" border="0" height="5" hspace="0" src="http://s6.postimage.org/4gt33l7kd/border_Bottom_Left4.gif" style="display:block;" vspace="0" width="5" /></td>
									<td bgcolor="#2a8fbd" height="5" style="font-size:2px; line-height:0px;" valign="top" width="109">&nbsp;</td>
									<td bgcolor="#2a8fbd" style="font-size:2px; line-height:0px;" valign="top" width="6">&nbsp;</td>
									<td height="5" style="font-size:2px; line-height:0px;" valign="top" width="495">&nbsp;</td>
									<td height="5" style="font-size:2px; line-height:0px;" valign="top" width="5"><img align="right" alt="" border="0" height="5" hspace="0" src="http://s6.postimg.org/dtto7pbbh/border_Bottom_Right.gif" style="display:block;" vspace="0" width="5" /></td>
								</tr>
							</tbody>
						</table>
						</td>
					</tr>
				</tbody>
			</table>
			<!--End of letter/invitation container - row#1--><!--Start of footer container-->

			<table align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; text-align:left; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px; line-height:15pt; color:#999999; margin:0 auto;" width="620">
				<tbody>
					<tr>
						<td bgcolor="#f4f4f4" height="5" style="font-size:2px; line-height:0px;" valign="top">
						<table cellpadding="0" cellspacing="0" style="border-collapse:collapse; border-spacing: 0; margin:0; padding:0; line-height:0px;" width="620">
							<tbody>
								<tr>
									<td height="5" style="font-size:2px; line-height:0px;" valign="top" width="5"><img align="right" alt="" border="0" height="5" hspace="0" src="http://s6.postimg.org/ao92hhsp9/border_Top_Left2.gif" style="display:block;" vspace="0" width="5" /></td>
									<td height="5" style="font-size:2px; line-height:0px;" valign="top" width="610">&nbsp;</td>
									<td height="5" style="font-size:2px; line-height:0px;" valign="top" width="5"><img align="right" alt="" border="0" height="5" hspace="0" src="http://s6.postimg.org/63mw2k8zx/border_Top_Right2.gif" style="display:block;" vspace="0" width="5" /></td>
								</tr>
							</tbody>
						</table>
						</td>
					</tr>
					<tr>
						<td bgcolor="#f4f4f4" style="padding:12px 20px 12px 20px; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:15pt; color:#999999;">
						<table cellpadding="0" cellspacing="0" style="border-collapse:collapse; border-spacing:0; border-width:0;" width="580">
							<tbody>
								<tr>
									<td style="padding:0 20px 0 0; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:15pt; color:#999999;" valign="top" width="180">
									<table cellpadding="0" cellspacing="0" style="border-collapse:collapse; border-spacing:0; border-width:0;" width="180">
										<tbody>
											<tr>
												<td style="padding:0 0 0 0; line-height:100%;" valign="top" width="20"><img alt="Home:" border="0" height="12" src="http://s6.postimg.org/6ufm8cbd9/home_Icon.gif" width="11" /></td>
												<td style="padding:0 0 10px 0; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:100%; color:#999999;" valign="top" width="160"><a href="http://www.elitemodellook.com/pe/es/home/index.htm" style="border-bottom:1px #777777 dotted; text-decoration:none; color:#777777;">elitemodellook.pe</a></td>
											</tr>
											<tr>
												<td style="padding:2px 0 0 0; line-height:100%;" valign="top" width="20">&nbsp;</td>
												<td style="padding:0; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:100%; color:#999999;" valign="top" width="160">&nbsp;</td>
											</tr>
										</tbody>
									</table>
									</td>
									<td style="padding:0 20px 0 0; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:15pt; color:#999999;" valign="top" width="180">
									<table cellpadding="0" cellspacing="0" style="border-collapse:collapse; border-spacing:0; border-width:0;" width="180">
										<tbody>
											<tr>
												<td style="padding:2px 0 0 0; line-height:100%;" valign="top" width="20"><img alt="Email:" border="0" height="9" src="http://s6.postimg.org/5tfdj7udp/email_Icon.gif" width="12" /></td>
												<td style="padding:0; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:100%; color:#999999;" valign="top" width="160"><a href="mailto:contacto@elitemodellookperu.pe" style="border-bottom:1px #777777 dotted; text-decoration:none; color:#777777;">contacto@elitemodellookperu.pe</a></td>
											</tr>
										</tbody>
									</table>
									</td>
								</tr>
							</tbody>
						</table>
						</td>
					</tr>
					<tr>
						<td height="20" style="font-size:2px; line-height:2px;"><img alt="" border="0" height="20" src="http://s6.postimg.org/deieeope9/shadow620.gif" style="display:block;" width="620" /></td>
					</tr>
				</tbody>
			</table>
			<!--End of footer container--><!--Start of company details and unsubscribe link-->

			<table align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; text-align:center; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px; line-height:15pt; color:#999999; margin:0 auto;" width="620">
				<tbody>
					<tr>
						<td style="color:#999999; padding:0 20px 20px 20px; text-align:center;">Copyright &copy; 2016 Gambito Corp.</td>
					</tr>
				</tbody>
			</table>
			<!--End of company details and unsubscribe link--></td>
		</tr>
		<!-- End of main container -->
	</tbody>
</table>
</body>
</html>
	';

	$headers2="content-type:text/html;charset=UTF-8"."\r\n".//DECLARO QUE EL CORREO SERA HTML
	'From: '.$email_to."\r\n".  //SE ENVIA DESDE "USUARIO QUE ENVIO EL CORREO" 
	'Reply-To: '.$email_to."\r\n".//RESPONDER AL USUARIO QUE ENVIO EL CORREO
	'X-Mailer: PHP/' . phpversion();
	@mail($e, $email_subject2, $email_message2, $headers2);//FUNCION QUE ENVIA EL CORREO
	
//////////////////////////////////////correo del lado cliente//////////////////////////////////////////////////
	
	$resultado=mysql_query("INSERT INTO `modelos` (`nombre`,`telefono`,`email`,`nacimiento`,`fecha`,`hora`) VALUES ('$n','$t','$e','$m','$f','$h')");//BASE DE DATOS 
	mysql_close($conexion);
	
	if(!$resultado){
		$flag=false;
	}
	if($flag){
		header("Location: http://castingelite.pe");//PAGINA DE DESTINO
	}
}
else{
	died('Lo sentimos pero parece haber un problema con los datos enviados.');//ERROR
}
?>