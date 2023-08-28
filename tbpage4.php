<?php
session_start();
require("conexion.php");
require("SessionManager.php");
require("tablesaction.php");

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}

$user = $_SESSION['id'];
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
if (!isset($_GET['m']) || empty($_GET['m'])) {
    header("Location: tbpage.php");
    exit;
}
$m = $_GET['m'];
$y = $_GET['y'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tableau de Bord Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/menupage.css">
  <link rel="icon" type="image/x-icon" href="img/logo.png"></head>
    <link rel="stylesheet" href="style/tbpage.css">
</head>
<body class="h-100">
<nav class="navbar navbar-expand-lg navbar-dark custom-color">
    <a class="navbar-brand" href="#"><img class="img" src="img/stellantis-4096.png" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
            <li class="nav-item active">
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
        <span><?php echo "$nom $prenom" ?></span>
        <a href="logout.php"><button class="btn-danger rounded-sm ml-2" id="btn">Se déconnecter</button></a>
    </div>
</nav>

    <div class="container mt-4 menu-section">
        <div class="container text-center">
            <h2 class="custom-title h3">Pourcentage pour chaque Poste:</h2>
        </div>

        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form method="GET">
                    <input hidden name="m" value="<?php echo"$m"?>">
                    <input hidden name="y" value="<?php echo"$y"?>">
                    <div class="row">
                        <div class="p-0 form-group col-4">
                        <label for="Atelier" >ATELIER :</label>
                        <select id="Atelier" onchange="atelierValueSender(<?php echo"$m"; ?>,<?php echo"$y"; ?>)" name="Atelier" required class="form-control" style="color: #243882;">
                            <option value="">Choisissez un atelier</option>
                            <option value="1">STRUCTURE</option>
                            <option value="2">PEINTURE</option>
                            <option value="3">MONTAGE</option>
                            <option value="4">BTU</option>
                        </select>
                        </div>
                        <div class="p-0 form-group col-4">
                            <label for="Zone">UEP :</label>
                            <select id="Zone" name="Zone" onchange="zoneValueSender(<?php echo"$m"; ?>,<?php echo"$y"; ?>)" required class="form-control" style="color: #243882;">
                                <option value="">Choisissez une UEP</option>
                            </select>
                        </div>


                        <div class="form-group col-4">
                        <label for="module">MODULE :</label>
                        <select id="module" name="module"class="form-control" style="color: #243882;">
                            <option value="">Choisissez un Module</option>
                            </select>
                        </div>
                        </div>
                            <div class="row text-center  ">
                            <button class="btn btn-primary w-100" type="submit">afficher le diagramme</button>
                            </div>
                    
                </form>
            </div>
        </div>

        <?php

        if (isset($_GET['module'])) {
            $selectedModule = $_GET['module'];
            $selectedZone = $_GET['Zone'];
            $selectedAtelier = $_GET['Atelier'];

            $sql = "SELECT poste AS poste,
                (SUM(IF(reponse.reponse = 'NOK', 1, 0)) / COUNT(*)) * 100 AS NOKPercentage
                FROM audit
                JOIN poste ON audit.id_Poste = poste.id_P
                JOIN module ON poste.id_M = module.id_M
                JOIN zone ON module.id_Z = zone.id_Z
                JOIN atelier ON atelier.id = zone.id_Atelier
                JOIN reponse ON reponse.id_A = audit.id_A
                WHERE module.id_M = ? AND reponse.reponse <> 'NA' AND MONTH(date) = ? AND YEAR(date) = ?
                GROUP BY poste";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $selectedModule);
            $stmt->bindParam(2, $m);
            $stmt->bindParam(3, $y);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $modules = [];
            $nokPercentages = [];

            foreach ($results as $row) {
                $modules[] = $row['poste'];
                $nokPercentages[] = $row['NOKPercentage'];
            }

            $chartData = [
                'labels' => $modules,
                'datasets' => [
                    [
                        'label' => 'NOK Percentage',
                        'data' => $nokPercentages,
                        'backgroundColor' => 'rgba(54, 162, 235, 0.5)',
                        'borderColor' => 'rgba(54, 162, 235, 1)',
                        'borderWidth' => 1
                    ]
                ]
            ];
            ?>

            <div style="width: 600px; margin: 20px auto;">
                <canvas id="modulechart"></canvas>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                var chartData = <?php echo json_encode($chartData); ?>;
                var ctx = document.getElementById('modulechart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: chartData,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: 100,
                                ticks: {
                                    callback: function(value) {
                                        return value + '%';
                                    }
                                }
                            }
                        },
                        plugins: {
                            title: {
                                display: true,
                                text: 'NOK Percentage for UEP: <?php echo $selectedZone; ?>'
                            }
                        }
                    }
                });
            </script>
        <?php } ?>
    </div>
    <div class="text-center">
<a href="tbpage5.php?m=<?php echo"$m"; ?>&y=<?php echo"$y"; ?>"  class="btn btn-success w-25 m-5">SUIVANT</a>
<a href="tbpage3.php?m=<?php echo"$m"; ?>&y=<?php echo"$y"; ?>" class="btn btn-danger w-25 m-5">RETOUR</a>

</div>
  <script src="js/tbpage3.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
