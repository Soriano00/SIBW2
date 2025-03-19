<?php
    include("model/bd.php");

    if ( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
        header('Location:../register.php');
        exit();
    }

    //Check permits
    if(isset($_SESSION["email"]) && is_array($_SESSION["email"]) && count($_SESSION["email"]) > 1 && $_SESSION["email"][1] !== "SUPER"){
        header("location:../index.php");
        return;
    }
    
   $name = $_POST['name'];
   $email = $_POST['email'];
   $password = $_POST['password'];
   $exists = getUsuario($email);


   if( !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($name) || empty($password) || $exists){
        if($exists)
            setcookie('error_register', "El usuario ya etsá registrado");
            header('Location:../register.php');
            return;
    }

    if(isset($_COOKIE['error_register']))
        setcookie("error_register");

    addUsuario($email, $name, $password);
    session_start();
    $_SESSION['email'] = array($email, "REGISTRADO");
    header('Location:../index.php');

?>