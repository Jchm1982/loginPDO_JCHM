<?php
$host = 'localhost';
$user = 'root';
$pass = 'root';
$db = 'inventorio';
#$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);

	#$pdo = new PDO("mysql:host=localhost;port=8889;dbname=$db", $user, $pass);
	$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
	//PDO::ERRMODE_EXCEPTION Significa que cuando las cosas explotan muestre todo
	
	/*
	if($pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION)){
		printf("Error de conexion: %s\n",$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		exit();
	}else{
		echo "conectado";
	}
	*/
	
	/*
	try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    #foreach($mbd->query('SELECT * from usuarios') as $fila) {
        #print_r($fila);
     #   echo "Conectado";
    #}
    #$pdo = null;
    echo "conectado";
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}
	
*/
