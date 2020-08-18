<?php  
 require_once('includes/funciones/db_connection.php');
?>

<?php
function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_Rand($keys)];
    }

    return $key;
}

?>

<?php
 
$radioVal = $_POST["estado"];

if($radioVal == "1")
{
$cod=random_string(15);
$tipo=1;

}
else if ($radioVal == "2")
{
$cod=random_string(15);
$tipo=2;
}


$radioVal2 = $_POST["option2"];

if($radioVal2 == "empresa")
{
$entidad=$_POST['emp-nombre'];
}
else if ($radioVal2 == "particular")
{

$entidad="particular";

}


?>

<?php
$target_dir = "imagenes/"; //directorio en el que se subira
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);//se añade el directorio y el nombre del archivo
$uploadOk = 1;//se añade un valor determinado en 1
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Comprueba si el archivo de imagen es una imagen real o una imagen falsa
if(isset($_POST["submit"])) {//detecta el boton
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {//si es falso es una imagen y si no lanza error
        echo "Archivo es una imagen- " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "El archivo no es una imagen";
        $uploadOk = 0;
    }
}
// Comprobar si el archivo ya existe
if (file_exists($target_file)) {
    echo "El archivo ya existe";
    $uploadOk = 0;//si existe lanza un valor en 0
}
// Comprueba el peso
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Perdon pero el archivo es muy pesado";
    $uploadOk = 0;
}
// Permitir ciertos formatos de archivo
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Perdon solo, JPG, JPEG, PNG & GIF Estan soportados";
    $uploadOk = 0;
}
//Comprueba si $ uploadOk se establece en 0 por un error
if ($uploadOk == 0) {
    echo "Perdon, pero el archivo no se subio";
// si todo está bien, intenta subir el archivo
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "El archivo ". basename( $_FILES["fileToUpload"]["name"]). " Se subio correctamente";
    } else {
        echo "Error al cargar el archivo";
    }
}
?>

<?php
////////
 $fecha = date('Y-m-d');
 $nombre=$_POST['nombre'];
 $cedula=$_POST['cedula'];
 $direccion=$_POST['direccion'];
 $celular=$_POST['phone'];
 $correo=$_POST['correo'];
 $correo_face=$_POST['correo-face'];
 $imagen=$_FILES["fileToUpload"]["name"];
 $estado="donado";
 
 /*
 var_dump($tipo);
 var_dump($nombre);
 var_dump($cedula);
 var_dump($direccion);
 var_dump($celular);
 var_dump($correo);
 var_dump($correo_face);
 var_dump($imagen);
 var_dump($cod);
 var_dump($entidad);
 var_dump($fecha);
 var_dump($estado);
*/
?>


<?php
    //Previene ataques 
    try{

    $stmt = $conn->prepare('INSERT INTO actarecepcion (id_tipodispositivo, nombre, cedula, email, facebook, direccion, celular, entidad, imagen, codigo_dispositivo, fecha, estado) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)');
    $stmt-> bind_param('ssssssssssss', $tipo, $nombre, $cedula, $correo, $correo_face, $direccion, $celular, $entidad, $imagen, $cod, $fecha, $estado);//manejar los datos, formato de los datos cada s es el formato de los datos
    $stmt->execute();
    $stmt->close();
    $conn->close();
    
    
    header("Location:enviado.php?correo=".$correo."");

    

}catch(\Exception $e){
    echo $e->getMessage();
}

  ?>