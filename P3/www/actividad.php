<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";
  include("php/model/bd.php");
  session_start();
  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  

  if (isset($_GET['ev'])) {
    $idAct = $_GET['ev'];
  }
  $activ   = getActividad($idAct);
  $galeria = getGaleria($idAct);
  if ( isset($_SESSION["email"]) ){
    $user = getUsuario($_SESSION["email"][0]);
  }
  

  echo $twig->render('actividad.html',[ 'actividad' => $activ, 'galeria' => $galeria,'user' => $user ]);  

?>