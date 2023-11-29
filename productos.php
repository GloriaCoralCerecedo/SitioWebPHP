<!-- Incluir cabecera -->
<?php include("template/cabecera.php")?>

<?php
include("administrador/config/bd.php");

$sentenciaSQL=$conexion->prepare("SELECT * FROM libros");
$sentenciaSQL->execute();
$listaLibros=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<?php foreach ($listaLibros as $libro) {?>
<!-- Card de los productos -->
<!-- 3 x 4 -->  
<div class="col-md-3"> 
<div class="card">
    <img width="400" height="400" class="card-img-top" src="./img/<?php echo $libro['imagen'];?>" alt="">
    <div class="card-body">
        <h4 class="card-title"><?php echo $libro['nombre']?></h4>
        <a name="" id="" class="btn btn-primary" href="https://www.wizardingworld.com/" role="button">Ver más</a>
    </div>
</div>
</div>
<?php } ?>


<!-- Incluir pie  -->
<?php include("template/pie.php")?>