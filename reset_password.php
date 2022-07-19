<?php
require 'db.php';
session_start();
if ($_SERVER['REQUEST_METHOD']=='POST') {
	if ($_POST['nuevopassword']===$_POST['confirmarpassword']) {
		$nuevo_password = password_hash($_POST['nuevopassword'],PASSWORD_BCRYPT);
		$email = htmlentities($_POST['email']);
		$hash = htmlentities($_POST['hash']);

		$stmt = $pdo->prepare("UPDATE usuarios SET password = :newmail, hash=:hasch WHERE email = :mail");
		$stmt->execute(array(
			":newmail" => $nuevo_password,
			":hasch" => $hash,
			":mail" => $email
		));
		#$result = $stmt->fetch(PDO::FETCH_ASSOC);
		/*errorCode() esta funcion valida si esta lista la consulta para ser ejecutada, dependiendo lo que devuelva
		si es 0 es por que no hay error,si es un codigo distinto es por que hay un error
		con intval->Se convierte a entero
		errorInfo()->Da la infromacion del error puntual
		*/		
		if(intval($stmt->errorCode())===0) {
			$_SESSION['message'] = "Tu contraseña ha sido actualizada!";
			header('Location:success.php');
			exit();
		}else{
			$_SESSION['message'] = "Las contraseñas ingresadas no coinciden!";
			header('Location:error.php');
			exit();
		}
	}
}
?>