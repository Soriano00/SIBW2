<?php
include("model/bd.php");
session_start();

// Verifica si el ID del evento está en el formulario
if (isset($_POST['id'])) {
    $idEv = $_POST['id'];
} else {
    die('Error: ID del evento no está definido.');
}

    //Check permits
    if(isset($_SESSION["email"]) && is_array($_SESSION["email"]) && count($_SESSION["email"]) > 1 && $_SESSION["email"][1] !== "SUPER"){
        header("location:../index.php");
        return;
    }
    
// Inicializa el array de errores
$errors = array();

// Manejo de la foto principal
if (isset($_FILES['photo']) && ($_FILES['photo']['size'] !== 0)) {
    $file_name = $_FILES['photo']['name'];
    $file_size = $_FILES['photo']['size'];
    $file_tmp = $_FILES['photo']['tmp_name'];
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

    // Actualiza la foto principal
    if (empty($errors)) {
        $photo = "../images/" . $file_name;
        updatePhoto($idEv, $photo);
    }
}

// Manejo de la galería de fotos
if (empty($errors) && isset($_FILES['new_gallery']) && ($_FILES['new_gallery']['size'][0] !== 0)) {
    for ($i = 0; $i < count($_FILES['new_gallery']['name']); $i++) {
        $file_name = $_FILES['new_gallery']['name'][$i];
        $file_size = $_FILES['new_gallery']['size'][$i];
        $file_tmp = $_FILES['new_gallery']['tmp_name'][$i];
        $file_type = $_FILES['new_gallery']['type'][$i];
        
        // Desglosar el explode en dos pasos para evitar el error
        $temp = explode('.', $file_name);
        $file_ext = strtolower(end($temp));

        $extensions = array("jpeg", "jpg", "png");

        if (!in_array($file_ext, $extensions)) {
            $errors[] = "Extension no permitida, elige una imagen JPG, JPEG o PNG.";
        }

        if ($file_size > 2097152) {
            $errors[] = 'Tamano del fichero demasiado grande';
        }

        // Añadir la foto a la galería
        if (empty($errors)) {
            $photo = "../images/" . $file_name;
            addToGaleria($idEv, $photo);
        } else {
            break;
        }
    }
}

// Actualización de la información del evento
if (empty($errors)) {
    $title = $_POST['title'];
    $price = $_POST['price'];
    $date = $_POST['date'];
    $author = $_POST['autor'];
    $description = $_POST['description'];
    $delete_all_gallery = isset($_POST['delete_all_gallery']) ? true : false;
    
    updateActividad($idEv, $title, $price, $date, $author, $description);
    
    if ($delete_all_gallery) {
        deleteAllFromGaleria($idEv);
    } 
} else {
    setcookie('error_update_event', implode('|', $errors));
}

// Redirecciona de nuevo a la página del evento
header("Location: ../actividad.php?ev=$idEv");

?>