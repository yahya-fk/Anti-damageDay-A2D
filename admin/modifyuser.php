<?php 
  require_once "dbaction.php";
  sessiongest(); 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $id = $_POST["id"];
      $nom = $_POST["nom"];
      $prenom = $_POST["prenom"];
      $is_staff = $_POST["is_staff"];
      $is_superuser = $_POST["is_superuser"];
      updateUserdata($id, $nom, $prenom, $is_staff, $is_superuser);
    header("Location: acceder.php?id_p=$id");
      exit();
    }
    ?>