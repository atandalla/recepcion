<?php
	
	$mysqli = new mysqli('remotemysql.com','w4FfkaCKuw', 'O8whvhpBEX', 'w4FfkaCKuw');
	
	if($mysqli->connect_error){
		
		die('Error en la conexion' . $mysqli->connect_error);
		
	}
?>