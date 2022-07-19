	<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
		//Load Composer's autoloader
	require 'vendor/autoload.php';
	function sendEmail($paraUsuario,$subject,$mesage_body){
		
		//Create an instance; passing `true` enables exceptions
		$mail = new PHPMailer(true);
		try {
	    //Server settings
	    #$mail->SMTPDebug = SMTP::DEBUG_SERVER;     //Enable verbose debug output(Habilitar salida de depuración detallada)
	    $mail->isSMTP();                                  //Send using SMTP(Enviar usando SMTP)
	    $mail->Host       = 'smtp.mail.yahoo.com'; //Set the SMTP server to send through(Configurar el servidor SMTP para enviar a través)
	    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication(Habilitar autenticación SMTP)
	    $mail->Username   = 'jchm1982@yahoo.com';                   //SMTP username
	    $mail->Password   = 'kmzzeclevceqzkmx';                     //SMTP password
	    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;  //Enable implicit TLS encryption(Habilitar el cifrado TLS implícito)
	    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

	    //Recipients
	    $mail->setFrom('jchm1982@yahoo.com', 'Juan CH');
	    $mail->addAddress($paraUsuario);     //Add a recipient
	    #$mail->addAddress('ellen@example.com');               //Name is optional
	    #$mail->addReplyTo('info@example.com', 'Information');
	    #$mail->addCC('cc@example.com');
	    #$mail->addBCC('bcc@example.com');

	    //Attachments(archivos adjuntos)
	    #$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
	    #$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

	    //Content
	    $mail->isHTML(true);                                  //Set email format to HTML->Establecer el formato de correo electrónico en HTML
	    #$mail->Subject = 'Here is the subject';
        $mail->Subject = $subject;
	    #$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        $mail->Body    = $mesage_body;
	    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	    $mail->send();
	    #echo 'Message has been sent';
        echo 'Mensaje fue enviado';
	} catch (Exception $e) {
		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}

	}
	?>