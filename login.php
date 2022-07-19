<?php
	$email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
	
	#$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
	#$stmt->execute(array(":email" => $email));
	#$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :xyz");
	$stmt->execute(array(":xyz" => $email));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	#echo '<pre>'.print_r($row,1).'</pre>';
	if($row === false){
		$_SESSION['message'] = 'No existe alguna cuenta registrada con ese correo!';
		header("Location:error.php");
		exit();
	}else{
			$user= $row;			
			
		if( password_verify($_POST['password'], $user['password']) ){
			$_SESSION['email'] = $user['email'];
			$_SESSION['nombre'] = $user['nombre'];
			$_SESSION['apellido'] = $user['apellido'];
			$_SESSION['logged_in'] = true;
			header("Location:perfil.php");
			exit();
		
		}else{
			    
			$_SESSION['message']='La contraseña es incorrecta';
			header("Location:error.php");
			exit();
		}
		
	}
?>