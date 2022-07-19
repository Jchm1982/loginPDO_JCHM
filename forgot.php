<?php
	require "send_email.php";
	require "db.php";
	ob_start();
	session_start();

	if ($_SERVER['REQUEST_METHOD']== 'POST') {

		$email= htmlentities($_POST['email']);
		$sql = "SELECT * FROM usuarios WHERE email = :mail";
				$stmt = $pdo->prepare($sql);
				$stmt->execute(array(
					':mail' => $email
				));

			$row = $stmt->rowCount();
			
			
			if($row === 0){
				$_SESSION['message'] = "El usuario con ese correo no fue encontrado !";
				header('Location:error.php');
				exit();
			}else{
				$user = $stmt->fetch(PDO::FETCH_ASSOC);
				$email = $user['email'];
				$hash = $user['hash'];
				$nombre = $user['nombre'];

				$_SESSION['message'] = 'Por favor revisa to correo <strong>'.$email.'</strong> por un link de confirmación para completar el cambio de contraseña!';

				$paraUsuario = $email;
				$subject = 'Cambiar password (Juan CH)';
				$message_body = 'Hola '.$nombre.'<br/>Has pedido un cambio de contraseña!
				http://localhost:8888/login_system_master/reset.php?email='.$email.'&hash='.$hash;
				sendEmail($paraUsuario,$subject,$message_body);
				header('Location:success.php');
				exit();
			}

	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Recuperar C ontraseña</title>
	<?php include 'css/css.html'; ?>
</head>
<body>
	<div class="form">
		<h1>Recupera tu contraseña</h1>
		<form action="forgot.php" method="post">
			<div>
				<input class="form-control" type="email" placeholder="Ingresa tu correo" required autocomplete="off" name="email"/>
			</div>
			<br/>
			<button class="button button-block">Enviar</button>
		</form>
	</div>
</body>
</html>