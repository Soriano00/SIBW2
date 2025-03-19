<?php
include("model/bd.php");
session_start();

$title = $_POST['title'];
$price = $_POST['price'];
$date = $_POST['date'];
$author = $_POST['author'];
$description = $_POST['description'];

    //Check permits
    if(isset($_SESSION["email"]) && is_array($_SESSION["email"]) && count($_SESSION["email"]) > 1 && $_SESSION["email"][1] !== "SUPER"){
        header("location:../index.php");
        return;
    }
    
if (empty($title) || empty($price) || empty($date)) {
    header('Location: ../all_events.php');
    exit;
}

   // Upload file
   $errors= array();

   if (isset($_FILES['photo']) && ($_FILES['photo']['size'] !== 0)) { 
    $file_name = $_FILES['photo']['name'];
    $file_size = $_FILES['photo']['size'];
    $file_tmp  = $_FILES['photo']['tmp_name'];
    $file_type = $_FILES['photo']['type'];

    // Desglosar el explode en dos pasos para evitar el error
    $temp = explode('.', $_FILES['photo']['name']);
    $file_ext = strtolower(end($temp));

    $extensions = array("jpeg", "jpg", "png");
    
    if (!in_array($file_ext, $extensions)) {
        $errors[] = "Extension no permitida, elige una imagen JPG, JPEG o PNG.";
    }
    
    if ($file_size > 2097152) {
        $errors[] = 'Tamano del fichero demasiado grande';
    }
    }

   // Add event
   if ( empty($errors) ) {
        $photo = "../images/" . $file_name;
    }


$idActividad = addActividad($title, $price, $date, $author, $description, $photo);


header("Location: ../all_events.php");
?>
