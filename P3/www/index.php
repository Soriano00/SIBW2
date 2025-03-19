<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";
  include("php/model/bd.php");
  
  session_start();
  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  $actividades = getActividades();

  if ( isset($_SESSION["email"]) ){
    $user = getUsuario($_SESSION["email"][0]);
  }
  
  echo $twig->render('portada.html',[ 'actividades' => $actividades, 'user' => $user]);  
?>