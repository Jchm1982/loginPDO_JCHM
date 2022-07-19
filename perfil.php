<?php

	require_once 'db.php';
	ob_start();
	session_start();

	if ($_SESSION['logged_in'] !== true) {
		header("location:index.php");
		exit();
	}else{
		$nombre = $_SESSION['nombre'];
		$apellido = $_SESSION['apellido'];
		$email = $_SESSION['email'];

		$result = $pdo->prepare("SELECT * FROM usuarios WHERE email = :xyz");
		$result->execute(array(":xyz" => $email));
		$row = $result->fetch(PDO::FETCH_ASSOC);
		if($row ===0){
			unset($_SESSION['logged_in']);
			$_SESSION['message'] = 'Debes iniciar sesion antes de poder ver tu perfil';
			header("Location:error.php");
			exit();
		}else{
			$user = $row;
			$activo = $user['activo'];
		}

	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Bienvenido <?= $nombre.' ' .$apellido ?></title>
	<?= include 'css/css.html'; ?>
</head>
<body>
	<div class="form">
		<?php 
		if (!$activo){
			echo "<div class='alert alert-info'>Tu cuenta fue creada ! Te acabamos de enviar un correo, por favor confirma tu cuenta haciendo click en el link que enviamos.<div>";
		}else{
			echo '<h1>Bienvenido</h1>';
			echo '<h2>'.$nombre.' '.$apellido.'</h2>';
		}
		 ?>
		 <a href="logout.php"><button class="button button-block" name="logout">LOG OUT</button></a>

	</div>
</body>
</html>