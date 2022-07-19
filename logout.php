<?php
	session_start();
	session_unset();
	session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Logout</title>
	<?= include 'css/css.html'; ?>
</head>
<body>
	<div class="form">
		<h1>Haz cerrado tu sesion</h1>
		<a href="index.php"><button class="button button-block">Home</button></a>

	</div>
</body>
</html>