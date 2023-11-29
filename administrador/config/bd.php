<?php
//Variables de base de datos
$host="localhost";
$bd="sitioweb";
$user="root";
$password="";

//Validación de la conexión a la base de datos
try {
    //Conexión a la base de datos
    //PDO - comunicar directamente con la base de datos, genera la conexión
    $conexion=new PDO("mysql:host=$host;dbname=$bd",$user,$password);
    // if($conexion){
    //     echo "Conectado...a sistema";
    // }
} catch (Exception $ex) { //Agarrar información en caso de una falla se imprime el error
    echo  $ex->getMessage(); // Muestra el mensaje que se provoco
}
?>
