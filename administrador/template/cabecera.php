<?php
//Variable de sesión
//Session start - Nos permite manejar el login
session_start();
//Preguntar si hay un usuario logueado, si no existe
// isset — Determina si una variable está definida y no es null
// !isset -  si es nulo
  if (!isset($_SESSION['usuario'])) {
    //Si  tiene información o es vació se redirecciona
    //Si no hay usuario logueado redirecciona a index.php
    header("Location:../index.php");
  }else{
    //Preguntar si ese usuario tiene un valor, si existe
    if($_SESSION['usuario']=="ok"){
      //Me deja entrar
      $nombreUsuario=$_SESSION["nombreUsuario"];
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Administrador</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <!-- Redirección -->
    <!-- Información del Host donde estoy = $_SERVER -->
    <!-- Host = localhost o al publucar por ejemplo mitienda.com -->
    <!-- Cuando yo presione el botón, me va a permitir mandar al usuario a esa url -->
    <?php
    $url="http://".$_SERVER['HTTP_HOST']."/sitioweb"
    ?>
    <!-- Cabecera -->
    <nav class="navbar navbar-expand navbar-light bg-light">
        <div class="nav navbar-nav">
            <a class="nav-item nav-link active" href="#">Administrador del Sitio Web<span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="<?php echo $url;?>/administrador/inicio.php">Inicio</a>
            <a class="nav-item nav-link" href="<?php echo $url;?>/administrador/seccion/productos.php">Libros</a>
            <a class="nav-item nav-link" href="<?php echo $url;?>">Ver Sitio Web</a>
            <a class="nav-item nav-link" href="<?php echo $url;?>/administrador/seccion/cerrar.php">Cerrar Sesión</a>
        </div>
    </nav>
   <div class="container">
    <br>
    <div class="row">