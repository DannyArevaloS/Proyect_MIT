<?php


if(isset($_POST)){

    //conexion a la base de datos
    require_once 'includes/conexion.php';
    
    if(!$_SESSION){
        session_start();
    }
    

    //Recoger los valores del formulario de registro
    $nombre = isset( $_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false; //mysqli_real_escape_string($_POST['nombre']) con esto estoy haciendo que pueda soportar elementos que la base de datos no acepta como por ejemplo ` o "
    $apellidos = isset( $_POST['apellidos']) ? $_POST['apellidos'] : false;
    $email = isset( $_POST['email']) ?  mysqli_real_escape_string($db, trim($_POST['email'])) : false;//Aqui aplicamos un trim para que se guarde sin espacios.
    $password = isset( $_POST['password']) ? $_POST['password'] : false;

    //var_dump($_POST);

    //Array de errores
    $errores = array();


    //validar los datos antes de guardarlos en la base de datos

    //validar campo nombre
    if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)){
        $nombre_validado = true;
    }else {
        $nombre_validado = false;
        $errores['nombre'] = "El nombre no es válido";
    }

    //validar apellidos

    if(!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)){
        $apellidos_validado = true;
    }else {
        $apellidos_validado = false;
        $errores['apellidos'] = "Los apellidos no son válidos";
    }

    //validar el email
    if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email_validado = true;
    }else {
        $email_validado = false;
        $errores['email'] = "El email no es válido";
    }

    //validar el password

    if(!empty($password) ){
        $password_validado = true;
    }else {
        $password_validado = false;
        $errores['password'] = "El password está vaciía";
    }

    $guardar_usuario = false;

    if(count($errores) == 0){
        //insertar usuarios en la base de datos
        $guardar_usuario = true;

        //cifrar la contraseña
        $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);

        //var_dump($password);
        //var_dump($password_segura);
        //password_verify la podremos utilizar para verificar si es la misma contraseña luego en el login.
        //var_dump(password_verify("hola2", $password_segura));

        //INSERTAR EL USUARIO EN LA BASE DE DATOS
        $sql = "INSERT INTO usuarios VALUES(null, '$nombre', '$apellidos', '$email', '$password_segura', CURDATE());";
        $guardar = mysqli_query($db, $sql);

        //var_dump(mysqli_error($db));
        //die();

        if($guardar){
            $_SESSION['completado'] = "El registro se ha completado con éxito";
            header('Location: index.php');
        } else {
            $_SESSION['errores']['general'] = "Fallo al guardar el usuario";
        }

    } else {

        $_SESSION['errores'] = $errores;
        header('Location: index.php');
    }


}


?>