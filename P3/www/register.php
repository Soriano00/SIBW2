<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
   
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);
    session_start();
    unset($_SESSION['email']);
    echo $twig->render('register.html',[] );
?>