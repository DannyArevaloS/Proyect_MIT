<?php

//iniciar la sesion y la conexion a bd
require_once 'includes/conexion.php';

//recoger los datos del formulario
if(isset($_POST)){
    //borrar error antiguo
    if(isset($_SESSION['erro_login'])){
        session_unset($_SESSION['error_login']);
    }

    //recojo datos del formulario
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    //comprobar la contraseña / o cifrarla de nuevo

    //consulta para generar las credenciales del usuario
    $sql = "SELECT * FROM usuarios WHERE email = '$email' LIMIT 1";
    $login = mysqli_query($db, $sql);

    if(!$login) {
        // manejar el error de la consulta, por ejemplo:
        die("Error en la consulta: " . mysqli_error($db));
    }

    if($login && mysqli_num_rows($login) ==1){ //mysqli_num_rows() es para que me cuente el numero de filas si coincide con la condicion entra en el bucle.

        $usuario = mysqli_fetch_assoc($login);

        //comprobar la contraseña
        $verify = password_verify($password, $usuario['password']);

        if($verify){
            //utilizar una sesion para guardar los datos del usaurio logeado
            $_SESSION['usuario']= $usuario;

            
        } else {
            //si algo falla enviar una sesion con el fallo
            $_SESSION['erro_login']= "Login incorrecto";
        }
    } else {
        //mensaje de error
        $_SESSION['erro_login'] = "Login incorrecto";
    }

    
   

    

}

 //redirigir al index.php
 header('Location: index.php');









?>