<?php
session_start();

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<!--<meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
	<title>Error</title>
	<?php include 'css/css.html'; ?>
	
</head>
<body>
	<div class="form">
		<h1>Error</h1>
		<p>
		<?php
		$sesion = isset($_SESSION['message']);
		
			if(isset($_SESSION['message']) && !empty($_SESSION['message'])){
				echo "<p class='alert alert-danger'>".$_SESSION['message']."</p>";
			}else{
				header("Location:index.php");
				exit();
			}
		?>
		</p>
		<a href="index.php"><button class="button button-block">HOME</button></a>

	</div>
</body>
</html>