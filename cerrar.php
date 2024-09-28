<?php


session_start();

if(isset($_SESSION['usuario'])){
    session_destroy(); //esta funcion me borra todas las sesiones que hay abiertas
}

header('Location: index.php');




?>