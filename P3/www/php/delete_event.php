<?php
    include("model/bd.php");
    session_start();

    $uri = $_SERVER['REQUEST_URI'];

        //Check permits
        if(isset($_SESSION["email"]) && is_array($_SESSION["email"]) && count($_SESSION["email"]) > 1 && $_SESSION["email"][1] !== "SUPER"){
            header("location:../index.php");
            return;
        }
        

    if(isset($_GET['ev'])){
        $idEvent = $_GET['ev'];
    }else{
        $idEvent = -1;
    }



    //DELETE
    deleteActividad($idEvent);
    header("Location: ../all_events.php");
?>