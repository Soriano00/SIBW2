<?php
    include("model/bd.php");

    if ( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
        header('Location:../login.php');
        exit();
    }

    $email = $_POST['email'];
    $password = $_POST['password'];
    $user = getUsuario($email);

    if( !filter_var($email, FILTER_VALIDATE_EMAIL)
        || empty($password)
        || !$user
    ){
        if ( !$user )
            setcookie('error_login', "El usuario no existe" );

        header('Location:../login.php');
        return;
    }
   
   
    if (isset($_COOKIE['error_login']))
        setcookie( 'error_login' ); 


    session_start();
    $_SESSION["email"] = array($user['email']);
    header('Location:../index.php');
?>