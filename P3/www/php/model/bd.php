<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";



  $mysqli = null;

  
  function startMySqli() {
    global $mysqli;

    $mysqli =  new mysqli ("database", "alex", "alex", "SIBW");

    if ( $mysqli->connect_errno) {
      echo ("Fallo al conectar: " . $mysqli->connect_errno);
      return null;
    } 

    return $mysqli;
  }
    // Actividades
    function getActividad($idActividad) {
      global $mysqli;
      
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }      
      
      $stmt = $mysqli->prepare("SELECT Id_Actividad, photo, title, price, date, autor, descr FROM Actividad WHERE Id_Actividad=?");
      $stmt->bind_param("i", $idActividad);
      $stmt->execute();
      $actividad = $stmt->get_result()->fetch_assoc();
      $stmt->close();

      return $actividad;
    }

    function getActividades() {
      global $mysqli;
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }    
      
      $stmt = $mysqli->prepare("SELECT Id_Actividad, photo, title, price, date FROM Actividad");
      $stmt->execute();
      $actividades = $stmt->get_result()->fetch_all();
      $stmt->close();
      
      return $actividades;
    }


    function getActividadBasicInfo() {
      global $mysqli;
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      } 
      
      $stmt = $mysqli->prepare("SELECT Id_Actividad, title, price, date FROM Actividad");
      $stmt->execute();
      $actividades = $stmt->get_result()->fetch_all();
      $stmt->close();
      
      return $actividades;

    }

    function deleteActividad($idActividad) {
      global $mysqli;
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }      
      
      $stmt = $mysqli->prepare("DELETE FROM Actividad WHERE Id_Actividad=?");
      $stmt->bind_param("i", $idActividad);
      $stmt->execute();
      $stmt->close();
    }

    function getGaleria ($idActividad) {
      global $mysqli;
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }   
      
      $stmt = $mysqli->prepare("SELECT photo FROM Galeria WHERE Id_Actividad=?");
      $stmt->bind_param("i", $idActividad);
      $stmt->execute();
      $gallery = $stmt->get_result()->fetch_all();
      $stmt->close();

      $gallery = array_map(function($image) {return $image[0];}, $gallery);
      return $gallery;
    }

    function getGaleriaCompleta ($idActividad) {
      global $mysqli;
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }   
      
      $stmt = $mysqli->prepare("SELECT photo, Id FROM Galeria WHERE Id_Actividad=?");
      $stmt->bind_param("i", $idActividad);
      $stmt->execute();
      $gallery = $stmt->get_result()->fetch_all();
      $stmt->close();

      return $gallery;
    }

    function addToGaleria($idActividad, $photo) {
      global $mysqli;
      if (!$mysqli) {
          if (!($mysqli = startMySqli())) return;
      }
  
      // Verifica si el ID de la actividad existe
      $stmt = $mysqli->prepare("SELECT COUNT(*) FROM Actividad WHERE Id_Actividad = ?");
      $stmt->bind_param("i", $idActividad);
      $stmt->execute();
      $stmt->bind_result($count);
      $stmt->fetch();
      $stmt->close();
  
      if ($count == 0) {
          die('Error: El ID de la actividad no existe.');
      }
  
      $stmt = $mysqli->prepare("INSERT INTO Galeria (Id_Actividad, photo) VALUES (?, ?)");
      $stmt->bind_param("is", $idActividad, $photo);
      if (!$stmt->execute()) {
          die('Error: ' . $stmt->error);
      }
      $stmt->close();
  }

  
    function deleteAllFromGaleria($idActividad) {
      global $mysqli;
      if (!$mysqli) {
          if (!($mysqli = startMySqli())) return;
      }
  
      // Delete all images for the activity
      $stmt = $mysqli->prepare("DELETE FROM Galeria WHERE Id_Actividad=?");
      $stmt->bind_param("i", $idActividad);
      $stmt->execute();
      $stmt->close();
  }

    function addActividad( $title, $price, $date, $author, $description, $photo ){
      global $mysqli;
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }   
      $stmt = $mysqli->prepare("INSERT INTO Actividad 
                                ( title, price, date, autor, descr, photo) 
                                VALUES ( ?, ?, ?, ?, ?, ?)"
      );
      $stmt->bind_param("sdssss", $title, $price, $date, $author, $description, $photo );
      $stmt->execute();
      $stmt->close();
      $mysqli->next_result();

    }


    function searchActividades ( $query ) {
      global $mysqli;
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }    
      $query = '%' . $query . '%';
      
      $stmt = $mysqli->prepare("SELECT Id_Actividad, title FROM Actividad
                               WHERE title LIKE ?
                               OR description LIKE ?"); 
      $stmt->bind_param("ss", $query, $query );
      $stmt->execute();
      $actividades = $stmt->get_result()->fetch_all();
      $stmt->close();
      
      return $actividades;
    }


    function updateActividad($idActividad, $title, $price, $date, $author, $description) {
      global $mysqli;
      if (!$mysqli) {
          if (!($mysqli = startMySqli())) return;
      }
  
      $stmt = $mysqli->prepare("UPDATE Actividad SET title=?, price=?, date=?, autor=?, descr=? WHERE Id_Actividad=?");
      $stmt->bind_param("sdsssi", $title, $price, $date, $author, $description, $idActividad);
      $stmt->execute();

  
      $stmt->close();
  }
  

    function updatePhoto($idActividad, $photo){
      global $mysqli;
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }  
      $stmt = $mysqli->prepare ("UPDATE Actividad SET photo=? WHERE Id_Actividad=?");
      $stmt->bind_param("si",$photo, $idActividad);
      $stmt->execute();
      $stmt->close();
    }




    // Comments
    function getComentarios($idActividad) {
      global $mysqli;
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }     
      
      $stmt = $mysqli->prepare("SELECT author, date, comment, Id_Comentario FROM Comentarios WHERE Id_Actividad=?");
      $stmt->bind_param("i", $idActividad);
      $stmt->execute();
      $comments = $stmt->get_result()->fetch_all();
      $stmt->close();

      return $comments;
    }

    function getComentario($idComentario) {
      global $mysqli;
      if (!$mysqli) {
          if (!($mysqli = startMySqli())) return;
      }
  
      $stmt = $mysqli->prepare("SELECT author, date, comment, Id_Comentario FROM Comentarios WHERE Id_Comentario=?");
      $stmt->bind_param("i", $idComentario);
      $stmt->execute();
      $comment = $stmt->get_result()->fetch_assoc();
      $stmt->close();
  
      return $comment;
  }
    function getAllComentarios () {
      global $mysqli;
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }     
      
      // Get all events
      $stmt = $mysqli->prepare("SELECT Id_Actividad, title FROM Actividad");
      $stmt->execute();
      $actividades = $stmt->get_result()->fetch_all();
      $stmt->close();

      // Get all comments
      for ( $i = 0; $i < count($actividades); $i++) {
        array_push($actividades[$i], getComentarios($actividades[$i][0]) );
      }

      return $actividades;
    }

    function addComentario($idActividad, $comment, $author, $date){
      global $mysqli;
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }  
      
      $stmt = $mysqli->prepare("INSERT INTO Comentarios (Id_Actividad, comment, author, date) VALUES (?, ?, ?, ?)");
      $stmt->bind_param("isss", $idActividad, $comment, $author, $date);

    $stmt->execute();

    $stmt->close();
    }

    function deleteComentarios ( $idComment ) {
      global $mysqli;
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }      

      $stmt = $mysqli->prepare("DELETE FROM Comentarios WHERE Id_Comentario=?");
      $stmt->bind_param("i", $idComment );
      $stmt->execute();
      $stmt->close();
    }

    
    function updateComentarios ( $idComment, $comment ) {
      global $mysqli;
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }      

      $stmt = $mysqli->prepare("UPDATE Comentarios SET comment=? WHERE Id_Comentario=?");
      $stmt->bind_param("si", $comment, $idComment );
      $stmt->execute();
      $stmt->close();
    }

    // Banned words
    function getPalabras_prohibidas() {
      global $mysqli;
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }   
      
      $stmt = $mysqli->prepare("SELECT palabra FROM Palabras_prohibidas");
      $stmt->execute();
      $banned = $stmt->get_result()->fetch_all();
      $stmt->close();

      $banned = array_map(function($word) {return $word[0];}, $banned);
      return $banned;
    }

    // Users
    function getUsuarios() {
      global $mysqli;
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }    
      
      $stmt = $mysqli->prepare("SELECT Id_Usuario, email ,role FROM Usuarios");
      $stmt->execute();
      $usuarios = $stmt->get_result()->fetch_all();
      $stmt->close();
      
      return $usuarios;
    }

    function getUsuario($email) {
      global $mysqli;
      if (!$mysqli) {
          if (!($mysqli = startMySqli())) return;
      }
  
      $stmt = $mysqli->prepare("SELECT nombre, email, contrasea, Id_Usuario, role FROM Usuarios WHERE email=?");
      if ($stmt) {
          $stmt->bind_param("s", $email);
          $stmt->execute();
          $result = $stmt->get_result();
          if ($result) {
              $usuario = $result->fetch_assoc();
          } else {
              $usuario = null;
          }
          $stmt->close();
          return $usuario;
      } else {
          return null;
      }
    }
  
  

    function getUsuarioId($idUsuario) {
      global $mysqli;
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }      
      
      $stmt = $mysqli->prepare("SELECT nombre, email, contrasea, Id_Usuario FROM Usuarios WHERE Id_Usuario=?");
      $stmt->bind_param("i", $idUsuario);
      $stmt->execute();
      $usuario = $stmt->get_result()->fetch_assoc();
      $stmt->close();

      return $usuario;
    }

    function addUsuario($email, $nombre, $password) {
      global $mysqli;
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }  
      $encryptedPass = password_hash( $password, PASSWORD_DEFAULT );

      $stmt = $mysqli->prepare("INSERT INTO Usuarios (email, nombre, contrasea) VALUES (?,?,?)");
      $stmt->bind_param("sss", $email, $nombre, $encryptedPass);
      $stmt->execute();
      $stmt->close();
      $mysqli->next_result();
    }

    function deleteUsuario($idUser){
      global $mysqli;
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }      
      
      $stmt = $mysqli->prepare("DELETE FROM Usuarios WHERE Id_Usuario=?");
      $stmt->bind_param("i", $idUser);
      $stmt->execute();
      $stmt->close();
    }


    
    function changeRole($idUser, $role){
      global $mysqli;
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }      
      
      $stmt = $mysqli->prepare("UPDATE Usuarios SET role=? WHERE Id_Usuario=?");
      $stmt->bind_param("si", $role, $idUser);
      $stmt->execute();
      $stmt->close();
    }


    function changeUser($idUser, $name, $email){
      global $mysqli;
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }      
      
      $stmt = $mysqli->prepare("UPDATE Usuarios SET nombre=?, email=? WHERE Id_Usuario=?");
      $stmt->bind_param("ssi", $name, $email, $idUser);
      $stmt->execute();
      $stmt->close();

    }


    function changePass($idUser, $password){
      global $mysqli;
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }   
      $encryptedPass = password_hash($password, PASSWORD_DEFAULT);

      $stmt = $mysqli->prepare("UPDATE Usuarios SET contrasea=? WHERE Id_Usuario=?");
      $stmt->bind_param("si", $encryptedPass, $idUser);
      $stmt->execute();
      $stmt->close();
    }
?>