<?php
include("model/bd.php");
session_start();
    //Check permits
    if(isset($_SESSION["email"]) && is_array($_SESSION["email"]) && count($_SESSION["email"]) > 1 && $_SESSION["email"][1] !== "SUPER"){
        header("location:../index.php");
        return;
    }
    
if (isset($_GET['user'])) {
    $idUser = $_GET['user'];
} else {
    $idUser = -1;
}

$user = getUsuarioId($idUser);


// DELETE
deleteUsuario($idUser);
header("Location: ../all_users.php");
exit();
?>
