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
  <title>Concept Page</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="style/menupage.css">
  <link rel="icon" type="image/x-icon" href="img/logo.png"></head>
  <link rel="stylesheet" href="style/conceptpage.css">
</head>
<body class="h-100">

  <nav class="navbar navbar-expand-lg navbar-dark custom-color ">
    <a class="navbar-brand" href="#"><img class="img" src="img/stellantis-4096.png" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
            <li class="nav-item ">
                <a class="nav-link" href="menupage.php">Menu</a>
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
            <li class="nav-item active">
                <a class="nav-link" href="conceptpage.php">Concept</a>
            </li>
        </ul>
    </div>
    <div class="user-info">
    <span><?php 
    echo"$nom $prenom"?>
    </span>
    <a href="logout.php"><button class="btn-danger rounded-sm ml-2" id="btn">
Se déconnecter</button>
    </a>
  </div>
  </nav>

  <div class="container mt-4 menu-section">
        <div class="container text-center">
            <h1 class="custom-title">CONCEPT</h1>
        </div>
        <div class="image">
            <img src="img/stellantis-2.png" alt="">
        </div>
        <!-- Use Bootstrap grid system to make elements smaller and responsive -->
        <div class="container p-5">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                    <img src="img/concept-1.png" class="img-fluid" alt="...">
                </div>
                <div class="col-12 col-md-6 col-lg-8 d-flex align-items-center">
                    <div>
                        <h2 class="">QUI ?</h2>
                        <p>« ANTI-DAMAGE DAY » est une journée dédiée à la prévention contre les dégradations du véhicule (Tôle & Pièces)</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container p-5">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-8 d-flex align-items-center">
                    <div>
                        <h2 class="">QUOI ?</h2>
                        <p>10 participants par journée, faisant partie des différents entités : Fab, Ing, Stq, Projet, Kaizen, Spw, Qcp,Utee,Cpl…
                            <br>La liste des participants sera communiquée et validée une semaine avant chaque journée.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <img src="img/concept-2.png" class="img-fluid" alt="...">
                </div>
            </div>
        </div>

        <div class="container p-5">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                    <img src="img/concept-3.png" class="img-fluid" alt="...">
                </div>
                <div class="col-12 col-md-6 col-lg-8 d-flex align-items-center">
                    <div>
                        <h2 class="">COMMENT ?</h2>
                        <p>« ANTI-DAMAGE DAY » se déroulera selon le programme annoncé en Kick-Off.
                            <br>2 UEP à auditer par journée
                            <br>Les participants sont amenés à utiliser cette plateforme lors de leurs audits.
                            <br>La plateforme comporte des check-listes avec des items à suivre par Famille (5M).
                            <span class="text-danger"><a class="text-danger" href="tutopage.php">voir Tuto</a> </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container p-5">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-8 d-flex align-items-center">
                    <div>
                        <h2 class="">QUAND ?</h2>
                        <p>« ANTI-DAMAGE DAY » dure une journée de 9h à 17h et sera organisée une fois par mois selon le planning fixé.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <img src="img/concept-1.png" class="img-fluid" alt="...">
                </div>
            </div>
        </div>

        <div class="container p-5">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                    <img src="img/concept-2.png" class="img-fluid" alt="...">
                </div>
                <div class="col-12 col-md-6 col-lg-8 d-flex align-items-center">
                    <div>
                        <h2 class="">OU ?</h2>
                        <p>Les postes de travail dans les UR :</p>
                        <p>STRUCTURE</p>
                        <p>PEINTURE</p>
                        <p>MONTAGE</p>
                        <p>BTU</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container p-5">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-8 d-flex align-items-center">
                    <div>
                        <h2 class="">POURQUOI ?</h2>
                        <p>Le but des journées anti-dégradation est :</p>
                        <p>L’identification des risques potentiels de dégradation du véhicule (Tôle & Pièce).</p>
                        <p>Proposition et implémentation des actions correctives et préventives.</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <img src="img/concept-3.png" class="img-fluid" alt="...">
                </div>
            </div>
        </div>
    </div>
          

        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <footer>
  <div class="text-center " style="height: 20px">
  <p class="txt text-dark">2023©  Yahya FEKRANE</p>
  </div>
</footer>
</html>