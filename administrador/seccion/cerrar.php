<?php
session_start();
// Destruye todas las sesiones y las variables
session_destroy();
header('Location:../index.php');
?>