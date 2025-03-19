<?php
include("model/bd.php");

    //Check permits
    if(isset($_SESSION["email"]) && is_array($_SESSION["email"]) && count($_SESSION["email"]) > 1 && $_SESSION["email"][1] !== "SUPER"){
        header("location:../index.php");
        return;
    }
    
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['idActividad'], $_POST['name'], $_POST['email'], $_POST['comment'])) {
        $idAct = $_POST['idActividad'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $comment = $_POST['comment'];
        $date = date('Y-m-d H:i:s');

        $banned = getPalabras_prohibidas();
        $isBanned = false;

        // Dividir el comentario en palabras y verificar cada palabra
        $commentWords = explode(' ', $comment);
        foreach ($commentWords as $word) {
            if (in_array($word, $banned)) {
                $isBanned = true;
                break;
            }
        }

        if (!$isBanned) {
            addComentario($idAct, $comment, $email, $date);
            header("Location: ../actividad.php?ev=$idAct");
            exit();
        } else {
            // Manejo de errores en caso de palabras prohibidas
            echo "Su comentario contiene palabras prohibidas y no puede ser publicado.";
        }
    } else {
        echo "Todos los campos son obligatorios.";
    }
}
?>
