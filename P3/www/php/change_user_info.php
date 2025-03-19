<?php
    include("model/bd.php");
    session_start();

    $uri = $_SERVER['REQUEST_URI'];

    if( $_SERVER['REQUEST_METHOD'] !== 'POST'){
        header('Location:/login');
        exit();
    }

        //Check permits
        if(isset($_SESSION["email"]) && is_array($_SESSION["email"]) && count($_SESSION["email"]) > 1 && $_SESSION["email"][1] !== "SUPER"){
            header("location:../index.php");
            return;
        }
        
    if(isset($_COOKIE['error_update']))
        setcookie('error_update');

    //Get user
    $email = $_SESSION["email"][0];
    $user = getUsuario($email);

    //Get data
    $name = $_POST['name']; 
    $password = $_POST['password'];


    $changePass = !empty($password);

    if ( $changePass ){
        changePass($user['Id_Usuario'], $password );
    }

    if(!$user){
        header('Location:/login.php');
        return;
    }

    //Update
    if(empty($name))
        $name = $user['nombre'];
        
    if(empty($email))
        $email = $user['email'];

    $changingEmail = ($email !== $user['email']);
    $error = false;

    if($changingEmail)
        if(getUsuario($email))
            $error = true;

    if($error)
        setcookie('error_update', "El email no es válido");
    else{
        changeUser($user['Id_Usuario'], $name, $email);
        unset($_SESSION['email']);
        $_SESSION['email'] = array($email,$user['role']);
    }

    
    header('Location: ../profile.php');
?>