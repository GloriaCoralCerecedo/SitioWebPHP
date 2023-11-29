<?php
// Es obligatorio para poder trabajar con la sseccionesy variables de inicio de sesión
session_start();
// Cuando el usuario presione este botón, se reccesiona y se envia al mismo lugar y 
// redirecciona a una página llamada "inicio.php"
if($_POST){
   //Si ese envio tieene de alguna forma el post
   if(($_POST['usuario']=="sitioweb") && ($_POST['contra']=="sitio")){ //Esta línea se cambia por las búsquedas de base de datos
    //Si existe y esta bien se redirecciona al inicio
    //Hay que crear variables para decirle a la cabecera que nos logueamos
    $_SESSION['usuario']="ok";
    $_SESSION['nombreUsuario']="Sitio Web";
    header('Location:inicio.php');
   }else{
    $mensaje="Error: El usuario o contraseña son incorrectos";
   }
  
  }
   
 // $sentenciaSQL=$conexion->prepare("SELECT * FROM usuarios WHERE usuario=:usuario" AND contraseña=:contraseña);
  // $sentenciaSQL->bindParam(':id',$txtID);
  // $sentenciaSQL->execute();

  //Se hace una culta y luego se pregunta si hay registros que tienen esa información y se deja pasar

  // $libro=$sentenciaSQL->fetch(PDO::FETCH_LAZY); 
 
  // $txtNombre=$libro['nombre'];
  // $fileImagen=$libro['imagen'];
?>

<!-- Acceso y contraseña o búsqueda en la base de datoa -->

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
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                    
            </div>
            <div class="col-md-6">
            <br><br><br><br><br><br>
            <!-- Cabecera del Login -->
               <div class="card">
                <div class="card-header">
                    Login
                </div>
                <!-- Cuerpo del login -->
                <div class="card-body">

                    <?php if(isset($mensaje)) { ?> 
                    <div class="alert alert-danger" role="alert">
                      <?php echo $mensaje;?>
                    </div>
                    <?php } ?> 

                    <form method="POST">
                    <!-- Usuario -->
                    <div class = "form-group">
                    <label>Usuario</label>
                    <input type="text" class="form-control" name="usuario" placeholder="Escribe tu usuario"/>
                    </div>
                    <!-- Contraseña -->
                    <div class="form-group">
                    <label>Contraseña</label>
                    <input type="password" class="form-control" name="contra" placeholder="Escribe tu contraseña"/>
                    </div>
                    <!-- Botón -->
                    <button type="submit" class="btn btn-primary">Entrar al Administrador</button>
                    </form>
                </div>
               </div> 
            </div>   
        </div>
    </div>
  </body>
</html>