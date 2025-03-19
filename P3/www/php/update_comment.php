<?php
    include("model/bd.php");
    session_start();

    $uri = $_SERVER['REQUEST_URI'];
    $last_uri = $_SERVER['HTTP_REFERER'];


    //Check permits
    if(isset($_SESSION["email"]) && is_array($_SESSION["email"]) && count($_SESSION["email"]) > 1 && $_SESSION["email"][1] !== "SUPER"){
        header("location:../index.php");
        return;
    }
    
    if($_SERVER['REQUEST_METHOD'] !== 'POST'){
        header("location:../index.php");
        return;
    }


if (isset($_POST['idComentario']) && isset($_POST['idActividad']) && isset($_POST['comment'])) {
    $index = $_POST['idComentario'];
    $idAct = $_POST['idActividad'];
    $content = $_POST['comment'];

    // Actualizar comentario
    updateComentarios($index, $content);
    
    // Redirección después de actualizar
    header("location:../index.php");
    exit();
}
?>