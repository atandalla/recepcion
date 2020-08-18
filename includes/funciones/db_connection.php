<?php
    $conn = new mysqli('remotemysql.com','w4FfkaCKuw', 'O8whvhpBEX', 'w4FfkaCKuw'); //direccion ip, passw, bd
    if($conn->connect_error){
        echo $error->$conn->connect_error;
    }


    
?>