<?php 
  session_start();
  require ("conexion.php");
  require("SessionManager.php");
  if(isset($_SESSION['tbActive'])){
    unset($_SESSION['tbActive']);
}
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
  $stmt = null;
  $conn = null;
  $_SESSION['nom']=$nom;
  $_SESSION['pnom']=$prenom;

?>
<!DOCTYPE html>
<html>
<head>
  <title>Main Page</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="icon" type="image/x-icon" href="img/logo.png"></head>
<link rel="stylesheet" href="style/menupage.css">
<body class="h-100">
<nav class="navbar navbar-expand-lg navbar-dark custom-color ">
    <a class="navbar-brand" href="menupage.php"><img class="img" src="img/stellantis-4096.png" alt=""></a>
    <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link active" href="menupage.php">Menu</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="auditpage.php">Audit</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="tbpage.php">Tableau de bord</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="planningpage.php">Planning</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="tutopage.php">Tutoriel</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="conceptpage.php">Concept</a>
            </li>
        </ul>
    </div>
    <div class="user-info">
    <span><?php 
    echo"$nom $prenom"?>
    </span>
    <a href="logout.php"><button class="btn-danger rounded-sm ml-2" id="btn">Se déconnecter</button>
    </a>
  </div>
  </nav>

  <div class="container mt-4 menu-section">
  <div class="container text-center">
          <h1 class="custom-title " >MENU</h1>
          <?php
           if (isset($_GET['data'])) {
            echo"<p class='text-success'>Les données sont bien sauvegardées</p>";
        }
          ?>
        </div>
    
    <div class="card-container mt-4">
      <div class="card" >
        <a href="auditpage.php">
        <img src="img/audit.png" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="text-dark card-title">AUDIT</h5>
          <p class="card-text"></p>
          <a href="auditpage.php" class="btn btn-primary">Aller vers page AUDIT</a>
        </div></a>
      </div>
      <div class="card" >
        <a href="tbpage.php">
        <img src="img/tableau de bord.png" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="text-dark card-title">TABLEAU DE BORD</h5>
          <p class="card-text"></p>
          <a href="tbpage.php" class="btn btn-primary">Aller vers TABLEAU DE BORD</a>
        </div></a>
      </div>

    
<div class="card">
    <a href="planningpage.php">
        <img src="img/plannning.png" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="text-dark card-title">PLANNING</h5>
            <p class="card-text"></p>
            <a href="planningpage.php" class="btn btn-primary">Aller vers la page PLANNING</a>
        </div>
    </a>
</div>

<div class="w-100"></div>

<div class="card">
    <a href="tutopage.php">
        <img src="img/Tutoriel.png" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="text-dark card-title">TUTORIEL</h5>
            <p class="card-text"></p>
            <a href="tutopage.php" class="btn btn-primary">Aller vers la page TUTORIEL</a>
        </div>
    </a>
</div>

<div class="card">
    <a href="conceptpage.php">
        <img src="img/concept.png" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="text-dark card-title">CONCEPT</h5>
            <p class="card-text"></p>
            <a href="conceptpage.php" class="btn btn-primary">Aller vers la page CONCEPT</a>
        </div>
    </a>
</div>

<div class="card">
    <a href="settingpage.php">
        <img src="img/parametre.png" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="text-dark card-title">PARAMÈTRES</h5>
            <p class="card-text"></p>
            <a href="settingpage.php" class="btn btn-primary">Aller vers la page PARAMÈTRES</a>
        </div>
    </a>
</div>
    </div>
</div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
<footer>
  <div class="text-center " style="height: 20px">
  <p class="txt text-dark">2023©  Yahya FEKRANE</p>
  </div>
</footer>
</html>