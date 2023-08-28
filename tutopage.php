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
  <title>Tutoriel Page</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="icon" type="image/x-icon" href="img/logo.png"></head>
  <link rel="stylesheet" href="style/menupage.css">
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
            <li class="nav-item active">
                <a class="nav-link " href="tutopage.php">Tutoriel</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="conceptpage.php">Concept</a>
            </li>
        </ul>
    </div>
    <div class="user-info">
    <span> <?php 
    echo"$nom $prenom"?>
    </span>
    <a href="logout.php"><button class="btn-danger rounded-sm ml-2" id="btn">Se déconnecter</button>
    </a>
  </div>
  </nav>
<style>
  p span{
    font-weight: bolder;
    font-size: 17px;

  }
  p{
    font-size: 14px;
  }
</style>
  <div class="container mt-4 menu-section">
  <div class="container text-center">
          <h1 class="custom-title " >TUTORIEL</h1>
            <div class="container text-left w-100">
            <H3 class="text-center pb-3">Page d'Audit - Instructions</H3>
              <div class="row ">
                <div class="col-md-6">
                  <iframe class="w-100" height="300" src="https://www.youtube.com/embed/aJ70j8hk5HA" frameborder="0" allowfullscreen></iframe>
                </div>
                <div class="col-md-6">

                  <p>
                      <span>1-Remplissez vos informations :</span> Commencez par fournir vos informations sur la première page. Une fois que vous aurez terminé, l'application vous dirigera automatiquement vers le "Questionnaire".
                      <br>
                     <span>2-Questionnaire :</span> Lorsque vous accédez à cette page, veuillez noter que vous ne pouvez pas actualiser la page ni naviguer à une autre page. </BR>Si vous souhaitez annuler l'audit en cours, cliquez sur le bouton en haut à droite de la page dédié à cet effet.
                      <br>
                      <span>3-Questionnaire Complet :</span> Assurez-vous de remplir tous les champs du questionnaire, répartis en plusieurs sections : "Main d'Œuvre", "Moyens", "Milieu", "Méthode", "Matières", et éventuellement l'autre section optionnel.
                      <br>
                      <span>4-Répondre aux Questions NOK :</span> Si vous répondez (NOK) à une question, il est obligatoire de fournir un commentaire expliquant pourquoi. <br>Sans ce commentaire, vous ne pourrez pas soumettre vos réponses.
                      <br>
                      <span>5-Soumission du Questionnaire :</span> Après avoir rempli le questionnaire, l'application vous redirigera automatiquement vers la page "MENU".
                      <br>
                      <span>6-Validation dans la Page MENU :</span> Soyez attentif au message de validation affiché dans la page MENU.
                  </p>
                </div>
              </div>
            </div>
  </div>
  <div class="container mt-4 menu-section">
  <div class="container text-center">
            <div class="container text-left w-100">
            <H3 class="text-center pb-3">Page Tableau de bord - Instructions</H3>
              <div class="row ">
                <div class="col-md-6">
                  <iframe class="w-100" height="300" src="https://www.youtube.com/embed/FjJBpXJ6qcA" frameborder="0" allowfullscreen></iframe>
                </div>
                <div class="col-md-6">
                  <p>
                    <span>1-Choisir le Mois et l'Année :</span> Allez sur la page d'accueil du tableau de bord. Sélectionnez d'abord le mois et l'année que vous voulez examiner.
                    <br>
                    <span>2-Filtrer les Données :</span> Une fois les mois et l'année choisis, appuyez sur le bouton "Filtrer" pour appliquer les filtres aux données.
                    <br>
                    <span>3-Graphique Global des NOK :</span> Après le filtrage, l'application vous montrera un graphique global illustrant le pourcentage de défauts (NOK) pour chaque atelier.
                    <br>
                    <span>4-Accéder aux Détails :</span> Si vous voulez plonger davantage dans les détails, cochez la case "Cocher moi et cliquez sur "Filtrer"" pour accéder aux graphiques détaillés.
                    <br>
                    <span>5-Graphiques Détaillés :</span> Après avoir coché la case, assurez-vous de cliquer sur le bouton "Filtrer". L'application générera alors des graphiques détaillés, allant progressivement du général au spécifique : atelier, module, UEP et poste. Vous pourrez naviguer entre les niveaux en utilisant les boutons "Suivant" et "Retour" en bas de la page.
                    <br>
                    <span>6-Explorer les Graphiques :</span> Plongez dans chaque niveau de détail pour obtenir des informations spécifiques sur les pourcentages de NOK dans chaque segment.
                  </p>
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
  <p hidden class="txt text-dark">2023©  Yahya FEKRANE</p>
  </div>
</footer>
</html>