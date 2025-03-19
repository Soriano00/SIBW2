<?php
    include("php/model/bd.php");
    session_start();

    $role = $_SESSION["email"][1];

        //Check permits
        if(isset($_SESSION["email"]) && is_array($_SESSION["email"]) && count($_SESSION["email"]) > 1 && $_SESSION["email"][1] !== "SUPER"){
            header("location:../index.php");
            return;
        }


    $resto = substr($uri, 14);
    $idActividad = intval($resto);
    $actividad = getActividad($idActividad);
    $galeria = getGaleriaCompleta($idActividad);



    if($actividad){
        echo $twig-> render("admin/actividad.html", [
            'actividad' => $actividad,
            'galeria' => $galeria,
            'role' => $role 
        ]);    
    }
    
?>