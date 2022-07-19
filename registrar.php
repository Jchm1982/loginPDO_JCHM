	<?php
	require "send_email.php";
		$_SESSION['nombre'] = $_POST['nombre'];
		$_SESSION['apellido'] = $_POST['apellido'];
		$_SESSION['email'] = $_POST['email'];
		//Podemos utilizar filtros de saneamiento
		//Documentacion -> https://www.php.net/manual/es/filter.filters.sanitize.php ; https://www.baulphp.com/prevenir-la-inyeccion-sql-en-php-ejemplo-completo/
		$nombre = filter_var($_POST['nombre'],FILTER_SANITIZE_SPECIAL_CHARS);
		
		$apellido = filter_var($_POST['apellido'],FILTER_SANITIZE_SPECIAL_CHARS);
		
		$email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
		//SE ESTA ENCRIPTANDO LA CLAVE
		$password = filter_var(password_hash($_POST['password'],PASSWORD_BCRYPT),FILTER_SANITIZE_SPECIAL_CHARS);

		$hash = filter_var(md5(rand(1,1000)),FILTER_SANITIZE_NUMBER_INT);
		/*
		$sql = "SELECT * FROM usuarios WHERE email = :email";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array(
				':email' => $email
			));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
	*/
	//VERIFICAMOS EL CORREO QUE NO SE ENCUENTRE EN LA BD
	$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
	$stmt->execute(array(":email" => $email));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);

	/*
	if($row>1){
		echo "es mayor que uno";
	}else{
		echo "NO es mayor que uno";
	}
	die();
	*/

		if($row>=1){
			$_SESSION['message'] = 'El usuario ya existe !';
			header('Location:error.php');
			exit();
		
		}else{
			
				$sql = "INSERT INTO usuarios (nombre,apellido,email,password,hash) VALUES (:nom,:apel,:email,:pass,:has)";
				$stmt = $pdo->prepare($sql);
				$stmt->execute(array(
					':nom' => $nombre,
					':apel' => $apellido,
					':email' => $email,
					':pass' => $password,
					':has' => $hash,
				));

				#$row = $stmt->fetch(PDO::FETCH_ASSOC);
				//https://es.stackoverflow.com/questions/515039/fatal-error-uncaught-pdoexception-sqlstatehy000-general-error-in-c-xampp-ht Solucion de error de las fulas afectadas
				$row = $stmt->rowCount();
				
				if($row >= 1){
					$_SESSION['logged_in'] = true;
					#echo "1";
					$paraUsuario=$email;
					$subject= 'Verifica tu cuenta (jchm.com)';
					$message_body='
					Hola'.$nombre.', Gracias por registrarte
					Por favor confirma tu cuenta haciendo clicken este link:
					http://localhost:8888/login_system_master/verificar.php?email='.$email.'&hash='.$hash;
					sendEmail($paraUsuario,$subject,$message_body);
					header("Location:perfil.php");
					exit();
				}else{
					$_SESSION['message'] = 'Ocurrio un error!';
					header('Location:error.php');
					exit();	
					#echo "2";
				}
				
			
			
			/*
			$sql = "INSERT INTO usuarios (nombre,apellido,email,password,hash) VALUES (:nom,:apel,:email,:pass,:has)";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(array(
				':nom' => $nombre,
				':apel' => $apellido,
				':email' => $email,
				':pass' => $password,
				':has' => $hash,
			));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
					
			if(isset($row) && $apellido){
				echo "es falsa";
				#$_SESSION['message'] = 'Ocurrio un error!';
				#header('Location:error.php');
				#exit();
			}else{
				echo "verdadero";
				#$_SESSION['logged_in'] = true;
			}
			*/
			

		}

	?>