<?php
include("model/bd.php");
session_start();

$uri = $_SERVER['REQUEST_URI'];

// Verificar que $_SESSION["email"] esté definido y sea un array con al menos dos elementos
if(isset($_SESSION["email"]) && is_array($_SESSION["email"]) && count($_SESSION["email"]) > 1 && $_SESSION["email"][1] !== "SUPER"){
    header("location:../index.php");
    return;
}

// Obtener id del comentario
if(isset($_GET['comm'])){
    $idComment = $_GET['comm']; 
}else{
    $idComment = -1;
}

// Eliminar comentario
deleteComentarios($idComment);
if(isset($_GET['ev'])){
    $idAct = $_GET['ev']; 
}else{
    $idAct = -1;
}

header("location:javascript://history.go(-1)");
return;
?>
