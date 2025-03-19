<?php
require_once "/usr/local/lib/php/vendor/autoload.php";
include("php/model/bd.php");
session_start();

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

if (isset($_GET['comm'])) {
    $idComm = $_GET['comm'];
    if (isset($_SESSION["email"])) {
        $user = getUsuario($_SESSION["email"][0]);
    }
    $comment = getComentario($idComm);

    echo $twig->render('edit_comment.html', ['comm' => $comment, 'user' => $user]);
}

?>
