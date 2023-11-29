<?php include("../template/cabecera.php");?>

<?php
// // Permitir o imprimir información de la cual se esta enviando
// //POST
// print_r($_POST);
// // Recepcionar archivos
// print_r($_FILES);

//Validar información directamente aquí
// Validación
//isset - Evalua que no este vacio o si tiene algo
//Si tiene algo va a ser igual al elemento, de los contrario vacio
$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
// Imagen de usa $_FILES 
// ['name'] -  Nombre del archivo
$fileImagen=(isset($_FILES['fileImagen']['name']))?$_FILES['fileImagen']['name']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

// echo $txtID."<br/>";
// echo $txtNombre."<br/>";
// echo $fileImagen."<br/>";
// echo $accion."<br/>";

include("../config/bd.php");

// Validar lo que es la acción, identificar que presiono el usuario, 
//determina que acción se hizo en la intrfaz gráfica

//Validar información directamente aquí

switch($accion){
    case"Agregar":
        //Preparar la intrucción sql
        //:nombre... - Parametro
        $sentenciaSQL=$conexion->prepare("INSERT INTO libros (nombre,imagen) VALUES (:nombre,:imagen);");
        //Insertar con un parametro
        $sentenciaSQL->bindParam(':nombre',$txtNombre);
        
        //Agregar imagen
        $fecha=new DateTime(); //Fecha para diferenciar imágenes del mismo nombre, para que no se sobreescriba
        //Nuevo norme del archivo
        $nombreArchivo=($fileImagen!="")?$fecha->getTimestamp()."_".$_FILES["fileImagen"]["name"]:"imagen.png";
        //Imagen temporal 
        $tmpImagen=$_FILES["fileImagen"]["tmp_name"];
        //Validar si esta ocupada o tiene algo o es diferente a vacia
        if($tmpImagen!=""){
            //Se mueve el archivo a la carpeta img
            move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);
        }
        $sentenciaSQL->bindParam(':imagen',$nombreArchivo);

        //Ejecuta la sentencia sql
        $sentenciaSQL->execute();
        //Redireccionar a productos
        header("Location:productos.php");
        // echo "Presinando botón agregar";
        break;
    case"Modificar":
        $sentenciaSQL=$conexion->prepare("UPDATE libros SET nombre=:nombre WHERE id=:id");
        $sentenciaSQL->bindParam(':nombre',$txtNombre);
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        // echo "Presinando botón modificar";

        //Hay que tener cuidado porque si se inserta y despues se selecciona se elimina el actual
        //Primero borramos y despues actualizamos con el nuevo nombre
        if($fileImagen!=""){
            $fecha=new DateTime(); 
            $nombreArchivo=($fileImagen!="")?$fecha->getTimestamp()."_".$_FILES["fileImagen"]["name"]:"imagen.png";
            $tmpImagen=$_FILES["fileImagen"]["tmp_name"];

            move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);

            $sentenciaSQL=$conexion->prepare("SELECT imagen FROM libros WHERE id=:id");
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
            $libro=$sentenciaSQL->fetch(PDO::FETCH_LAZY); 

            if(isset($libro["imagen"]) && ($libro["imagen"]!="imagen.jpg")){ 
                if(file_exists("../../img/".$libro["imagen"])){
                    unlink("../../img/".$libro["imagen"]);
                }
            }
            // Modificar solo lo que es el registro de la imagen
            $sentenciaSQL=$conexion->prepare("UPDATE libros SET imagen=:imagen WHERE id=:id");
            $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
        }
         header("Location:productos.php");
        break;
    case"Cancelar":
        //Redirigir a la personas a la sección de productos
        header("Location:productos.php");
        // echo "Presinando botón cancelar";
        break;
    case"Seleccionar":
        $sentenciaSQL=$conexion->prepare("SELECT * FROM libros WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        //FETCH_LAZY Carga los datos 1 a 1 y se pueda rellenar
        $libro=$sentenciaSQL->fetch(PDO::FETCH_LAZY); 
        // echo "Presinando botón seleccionar";

        //Asigna los valore que se recuperaron d ela base de datos
        $txtNombre=$libro['nombre'];
        $fileImagen=$libro['imagen'];
        break;
    case"Borrar":
        //Buscar la imagen que concida en la carpeta para borrarla
        $sentenciaSQL=$conexion->prepare("SELECT imagen FROM libros WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        //Se recupera en la variable $libro
        $libro=$sentenciaSQL->fetch(PDO::FETCH_LAZY); 
        //Si existe esa imagen y si es diferente a imagen.jpg. 
        if(isset($libro["imagen"]) && ($libro["imagen"]!="imagen.jpg")){ //Si es diferente a ese, Para que no se borre
            //Se busca para ver si existe en la carpeta
            if(file_exists("../../img/".$libro["imagen"])){
                //Si existe se borra
                unlink("../../img/".$libro["imagen"]);
            }
        }
        $sentenciaSQL=$conexion->prepare("DELETE FROM libros WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();

        header("Location:productos.php");
        // echo "Presinando botón borrar";
        break;
}

// Mostrar los datos
$sentenciaSQL=$conexion->prepare("SELECT * FROM libros");
$sentenciaSQL->execute();
// fetchAll --- Recupera todos los regiatros para mostrarlos en a variable
// FETCH_ASSOC --- Hace una asociación entre los datos que vienen de la tabla y los nuevos registros
$listaLibros=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>


<div class="col-md-4">
    <div class="card">
        <div class="card-header">
            Datos de Libro
        </div>
        <div class="card-body">
           <!-- Formulario de agregar libros -->
           <!-- enctype="multipart/form-data   --- Acepte fotografías, archivos, etc 
            Si no se pone solo se recepcionan datos, pero archivos no y demás-->
            <form method="POST" enctype="multipart/form-data">
            <!-- ID -->
            <div class = "form-group">
            <label for="txtID">ID</label>
            <!-- requiredv -requerir el valor
            readonly -  solo lectura -->
            <input type="text" required readonly class="form-control" value="<?php echo $txtID;?>" name="txtID" id="txtID" placeholder="ID">
            </div>
            <!-- Nombre -->
            <div class = "form-group">
            <label for="txtNombre">Nombre</label>
            <input type="text" required class="form-control" value="<?php echo $txtNombre;?>" name="txtNombre" id="txtNombre" placeholder="Nombre del libro">
            </div>
            <!-- Imagen -->
            <div class = "form-group">
            <label for="fileImagen">Imagen:</label>

            <!-- <?php echo $fileImagen;?> -->
            <br>

            <!-- Aparece la imagen seleccionada -->
            <?php if($fileImagen!=""){ ?>
                <img class="img-thumbnail rounded" src="../../img/<?php echo $fileImagen; ?>" width="50" alt="" srcset="">
            <?php }?>

            <input type="file" class="form-control" name="fileImagen" id="fileImagen" placeholder="Foto del libro">
            </div>
            <!-- Botones -->
            <div class="btn-group" role="group" aria-label="">
                <!-- Cuando presiona el botón seleccionar desactivamos y se puede modificar y cancelar-->
                <button type="submit" name="accion" <?php echo($accion=="Seleccionar")?"disabled":""; ?> value="Agregar" class="btn btn-success">Agregar</button>
                <button type="submit" name="accion" <?php echo($accion!="Seleccionar")?"disabled":""; ?>  value="Modificar" class="btn btn-warning">Modificar</button>
                <button type="submit" name="accion" <?php echo($accion!="Seleccionar")?"disabled":""; ?> value="Cancelar" class="btn btn-info">Cancelar</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="col-md-8">
    <!-- Tabla de libros (Mostrar los datos de los libros) -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Acciones</th> <!-- Acciones que se haran sobre cada registro -->
            </tr>
        </thead>
        <tbody>
        <?php foreach($listaLibros as $libro) {?>
            <tr>
                <td><?php echo $libro['id']; ?></td>
                <td><?php echo $libro['nombre']; ?></td>
                <td>
                    <!-- Etiqueta, indicar en donde se encuentra la ruta del libro-->
                    <!-- Ancho que reidmenciona la imagen, pero no física. Solo de forma visual se va
                    a redimencionar con width y fisicamente el tamaño que hemos adjuntado-->
                    <img class="img-thumbnail rounded" src="../../img/<?php echo $libro['imagen']; ?>" width="50" alt="" srcset="">
                </td>

                <td>
                    <form method="POST">
                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $libro['id']; ?>"/>
                        <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary"/>
                        <input type="submit" name="accion" value="Borrar" class="btn btn-danger"/>
                    </form>
                </td>

            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<?php include("../template/pie.php");?>