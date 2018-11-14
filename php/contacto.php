<?php
require_once '../php/conexion.php';
date_default_timezone_set(America/Lima);
// Replace this with your own email address
$siteOwnersEmail = 'sfpraguirre@gambitocorp.com';


if($_POST) {

    $name = trim(stripslashes($_POST['nombre']));
    $tel = trim(stripslashes($_POST['tel']));
    $email = trim(stripslashes($_POST['correo']));
    $subject = trim(stripslashes($_POST['asunto']));
    $contact_message = trim(stripslashes($_POST['mensaje']));

      // Check Name
    if (strlen($nombre) < 2) {
        $error['name'] = "Porfavor corrija el nombre.";
    }
    // Check Email
    if (!preg_match('/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is', $correo)) {
        $error['email'] = "Porfavor corrija su email.";
    }
    // Check Message
    if (strlen($mensaje) < 15) {
        $error['message'] = "su mensaje es demasiado corto deberia tener al menos una frase para ayudarle con su problema, (15 caracteres minimo).";
    }
    // Subject
    if ($asunto === '') { $asunto = "no podemos atender su problema si no tenemos un asunto, porfavor diganos de que se trata su problema";}


   // Set Message
    $message = "recibiste un mensaje de: " . $nombre . "<br />";
    $message .= "este es su correo: " . $correo . " contactalo pronto<br />";
    $message .= '<br> tambien tienes su telefono '.$tel.' '.'llamalo';
    $message .= "necesita esto... consideraria que es urgente : <br />";
    $message .= $mensaje;
   
    $message .= "<br /> ----- <br /> este correo fue generado automaticamente en su servidor. <br />";

    // Set From: header
    $from =  $name . " <" . $email . ">";

    // Email Headers
    $headers = "From: " . $from . "\r\n";
    $headers .= "Reply-To: ". $email . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    //base de datos
    $nombre = !empty($_POST['nombre']) ? msqli_real_escape_string($bd, $_POST['nombre']) : false;
    $tel = !empty($_POST['tel']) ? msqli_real_escape_string($bd, $_POST['tel']) : false;
    $correo = !empty($_POST['correo']) ? msqli_real_escape_string($bd, $_POST['correo']) : false;
    $asunto = !empty($_POST['asunto']) ? msqli_real_escape_string($bd, $_POST['asunto']) : false;
    $mensaje = !empty($_POST['mensaje']) ? msqli_real_escape_string($bd, $_POST['mensaje']) : false;
    $hora = time(); 
    $hora = date ("Y-m-d H:i:s",$hora);
    $sql = "INSERT INTO contacto VALUES(NULL, '$nombre', '$tel', '$correo', '$asunto', '$mensaje', '$hora');";
    $guardar = mysqli_query($bd, $sql);


    if (!$error) {

        ini_set("sendmail_from", $siteOwnersEmail); // for windows server
        $mail = mail($siteOwnersEmail, $asunto, $message, $headers);

        if ($mail) { echo "OK"; }
        else { echo "algo anda mal tengo que revisar"; }
        
    } # end if - no validation error

    else {

        $response = (isset($error['name'])) ? $error['name'] . "<br /> \n" : null;
        $response .= (isset($error['email'])) ? $error['email'] . "<br /> \n" : null;
        $response .= (isset($error['message'])) ? $error['message'] . "<br />" : null;
        
        echo $response;

    } # end if - there was a validation error

}

?>

