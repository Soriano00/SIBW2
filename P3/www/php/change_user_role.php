<?php
    include("model/bd.php");
    session_start();
    //Check permits
    if(isset($_SESSION["email"]) && is_array($_SESSION["email"]) && count($_SESSION["email"]) > 1 && $_SESSION["email"][1] !== "SUPER"){
        header("location:../index.php");
        return;
    }
    

    if(isset($_GET['user']) && isset($_GET['role'])){
        $idUser = $_GET['user'];
        $role = $_GET['role'];
    }else{
        header("Location: ../all_users.php");;
        return;
    }
    
    $user = getUsuarioId($idUser);

    //Delete user
    changeRole($idUser, $role);
    header("Location: ../all_users.php");

?>