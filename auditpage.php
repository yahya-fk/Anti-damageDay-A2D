<?php 
session_start();
require("conexion.php");
require("SessionManager.php");

try {
  CheckQuestionnaire(conect_bd());
  CheckUserSession($_SESSION['id']);
  $n = CheckNomPrenom();
  $nom = $n[1];
  $prenom = $n[2];
} catch (Exception $e) {
echo "<script>document.getElementByID('error').innerHTML='<p>$e</p>';</script>";
}
if (isset($_GET["error"])){
  echo "<script>document.getElementByID('error').innerHTML='<p>OUUPS UN CHAMP INACCESSIBLE !</p>';</script>";

}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Audit Page</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="icon" type="image/x-icon" href="img/logo.png"></head>
  <link rel="stylesheet" href="style/questionpage.css">
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
            <li class="nav-item active">
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
  </nav>

  <div class="user-info">
    <span><?php 
    echo"$nom $prenom"?>
    </span>
    <a href="logout.php"><button class="btn-danger rounded-sm ml-2" id="btn">Se déconnecter</button>
  </div></a>

  <div class="container mt-4 menu-section">
        <div class="container text-center">
          <h1 class="custom-title" >AUDIT</h1>
        </div>
        <div id="error" class="text-danger">
        </div>
  <form action="questionpage.php" method="POST">
    <div class="container">
      <div class=" d-flex justify-content-between">
        <div class="p-0 form-group col-6">
          <label for="Atelier" >ATELIER :</label>
          <select id="Atelier" onchange="atelierValueSender()" name="Atelier" required class="form-control" style="color: #243882;">
            <option value="">Choisissez un atelier</option>
            <option value="1">STRUCTURE</option>
            <option value="2">PEINTURE</option>
            <option value="3">MONTAGE</option>
            <option value="4">BTU</option>
          </select>
        </div>
        <div class="p-0 form-group col-6">
          <label for="Zone">UEP :</label>
          <select id="Zone" name="Zone" onchange="zoneValueSender()" required class="form-control" style="color: #243882;">
            <option value="">Choisissez une UEP</option>
          </select>
        </div>
      </div>


    <div class="form-group">
      <label for="module">MODULE :</label>
      <select id="module" name="module" onchange="moduleValueSender()"  class="form-control" style="color: #243882;">
          <option value="">Choisissez un Module</option>
        </select>
    </div>
    <div class="form-group">
      <label for="Poste">POSTE :</label>
      <select id="poste" name="poste"  class="form-control" style="color: #243882;">
          <option value="">Choisissez un Post</option>
        </select>
    </div>
    <div class="form-group">
      <label for="Operateur">OPERATEUR :</label>
      <input type="text" name="Operateur" id="Operateur" required placeholder="Votre opérateur ici" class=" required form-control" style="color: #243882;">
    </div>
    <div class="form-group">
      <label for="Equipe">EQUIPE :</label>
      <select id="Equipe" name="Equipe" required class="required form-control" style="color: #243882;">
        <option value="">Choisissez un équipe</option>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="N">N</option>
      </select>
    </div>
    
  </div>
    <button type="submit" id="submitBtn" class="btn w-100 btn-primary">valider</button>
  </div>
</form>


    </div>
</div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="js/auditpage.js"></script>
  <script>
<?PHP
  if(isset($_GET['id'])){
        $id=$_GET['id'];
    echo"const Tab=JSON.parse('$id')\n";
    
?>
    let html=""
    Tab.forEach(e => {
    html+="<option value="+e.id+">"+e.nom+"</option>"
    });
    document.getElementById("Zone").innerHTML+=html;
    document.getElementById("Atelier").value=Tab[0].idAtelier
<?php
  }
  if(isset($_GET['idZ'])){
    $id=$_GET['idZ'];
echo"const Tab1=JSON.parse('$id')\n";

?>
html=""
Tab1.forEach(e => {
html+="<option value="+e.id+">"+e.nom+"</option>"
});
document.getElementById("module").innerHTML+=html;
document.getElementById("Atelier").value=Tab[0].idAtelier
document.getElementById("Zone").value=Tab1[0].idAtelier

<?php
}
if(isset($_GET['idM'])){
  $id=$_GET['idM'];
echo"const Tab2=JSON.parse('$id')\n";

?>
html=""
Tab2.forEach(e => {
html+="<option value="+e.id+">"+e.nom+"</option>"
});
document.getElementById("poste").innerHTML+=html;
document.getElementById("Atelier").value=Tab[0].idAtelier
document.getElementById("Zone").value=Tab1[0].idAtelier
document.getElementById("module").value=Tab2[0].idAtelier


<?php
}

?>

</script>
</body>
<footer>
  <div class="text-center " style="height: 20px">
  <p class="txt text-dark">2023©  Yahya FEKRANE</p>
  </div>
</footer>
</html>