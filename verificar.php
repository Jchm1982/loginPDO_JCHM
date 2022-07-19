	<?php
	 require_once "db.php";
	 session_start();
	 if (isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])) {
	 	$email =htmlentities($_GET['email']);
	 	$hash =htmlentities($_GET['hash']);

	 	$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :mail AND hash=:hash AND activo= '0'");

		$stmt->execute(array(
			":mail" => $email,
			":hash" => $hash
		));
		
		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		if($result===0){
			$_SESSION['message']='Tu cuenta ya fue activa o la URL es incorrecta!';
			header("Location:error.php");
			exit();
		}else{
			$stmt = $pdo->prepare("UPDATE usuarios SET activo='1' WHERE email=:email");
			$stmt->execute(array(
				":email" => $email
			));
			$_SESSION['message'] = 'Tu cuenta ha sido <strong>activada<strong>!';
			header("Location:success.php");
			exit();
		}

	 }else{
	 	$_SESSION['message'] = 'La URL contiene información incorrecta !';
	 	header("Location:error.php");
	 	exit();
	 }
	?>