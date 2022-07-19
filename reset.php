<?php
	require 'db.php';
	session_start();

	if (isset($_GET['email']) && !empty($_GET['email']) and isset($_GET['hash']) && !empty($_GET['hash'])) {
		$email=htmlentities($_GET['email']);
		$hash=htmlentities($_GET['email']);

		$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :mail AND hash=:hash");
		$stmt->execute(array(
			":mail" => $email,
			":hash" => $hash
		));
		
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($result ===0) {
			$_SESSION['message'] ='Haz ingresado a una URL invalida para cambiar contraseña!';
			header('Location:error.php');
			exit();
			
		} else {
			
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cambiar Contraseña</title>
	<?php include 'css/css.html'; ?>
</head>
<body>
	<div class="form">
		<h1>Escoge tu contraseña</h1>
		<form action="reset_password.php" method="post">
			<div class="field-wrap">
				<input type="password" class="form-control" name="nuevopassword" placeholder="Nueva Contraseña" required>
				<br/>
			</div>
			<div class="field-wrap">
				<input type="password" class="form-control" name="confirmarpassword" placeholder="Confirmar Contraseña" required>
				<br/>
			</div>
			<input type="hidden" name="email" value="<?= $email ?>">
			<input type="hidden" name="hash" value="<?= $hash ?>"><br/>

			<button class="button button-block">Actualizar</button>
		</form>
	</div>
	
</body>
</html>