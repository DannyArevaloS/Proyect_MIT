<?php require_once 'includes/conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project MIT</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <!-- Header -->
    <header id="cabecera">
        <!-- LOGO -->
        <div id="logo">
            <a href="index.php">
                Blog de videojuegos
            </a>
        </div>

        <!-- Menu -->
        

        <nav id="menu">
            <ul>
                <li>
                    <a href="index.php">Inicio</a>
                </li>
                <?php 
                    $categorias = getCategoria($db); 
                    if(!empty($categoria)):

                    while($categoria = mysqli_fetch_assoc($categorias)) : 
                ?>
                    <li>
                        <a href="categoria.php?id<?=$categoria['id']?>"><?=$categoria['nombre']?></a>
                    </li>
                <?php 
                
                endwhile; 
                endif;
                ?> 
                <li>
                    <a href="index.php">sobre mí</a>
                </li>
                <li>
                    <a href="index.php">Contacto</a>
                </li>
            </ul>
        </nav>
        <!--Esto lo añadimos para que no se sobreponga el menu en el main-->
        <div class="clearfix"></div>
    </header>

    <div id="contenedor">