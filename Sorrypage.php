<?php 
  session_start();
  require ("conexion.php");
  require("SessionManager.php");

  if (!isset($_SESSION['id'])) {
      header("Location: index.php");
      exit;
  }
  $user=$_SESSION['id'];
  $conn = conect_bd();


  CheckQuestionnaire($conn);
  $sql = "SELECT nom, prenom,is_staff FROM personne WHERE id_p = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(1, $user);
  $stmt->execute();

  if ($stmt->rowCount() > 0) {
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $nom = $row['nom'];
      $prenom = $row['prenom'];
      $access=$row['is_staff'];
  } else {
    header("Location: logout.php");
    exit;
  }
  if ($access==0){
    session_destroy();
    header("Location: Sorrypage.php");
  }

?>
<!DOCTYPE html>
<html>
<head>
  <title>Main Page</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="icon" type="image/x-icon" href="img/logo.png"></head>
<link rel="stylesheet" href="style/menupage.css">
<body class="h-100">


  <div class="container mt-4 menu-section">
  <div class="container text-center">
          <h1 class="custom-title " >veuillez attendre que votre compte soit approuvé !!!</h1>
          <h4>votre compte a besoin d'etre approuvé de la part de l'administrateur pour que vous puissiez utiliser l'application</h4>
  </div>
</div>
</body>
</html>