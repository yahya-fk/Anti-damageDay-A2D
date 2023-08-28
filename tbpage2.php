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
if(isset($_GET['m']) && isset($_GET['y'])) {
    $ateliers = ['STRUCTURE', 'PEINTURE', 'MONTAGE', 'BTU'];
    $chartData = [];
    $m = $_GET['m'];
    $y = $_GET['y'];
    if(empty($y)){
        $y=NULL;
    }
    foreach ($ateliers as $atelier) {
        $sql = "SELECT zone.zone AS Zone,
                (SUM(IF(reponse.reponse = 'NOK', 1, 0)) / COUNT(*)) * 100 AS NOKPercentage
            FROM audit
            JOIN poste ON audit.id_Poste = poste.id_P
            JOIN module ON poste.id_M = module.id_M
            JOIN zone ON module.id_Z = zone.id_Z
            JOIN atelier ON atelier.id = zone.id_Atelier
            JOIN reponse ON reponse.id_A = audit.id_A
            WHERE atelier.atelier = ? AND reponse.reponse <> 'NA' AND MONTH(date) = ? AND YEAR(date) = ?
            GROUP BY zone.zone";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $atelier);
        $stmt->bindParam(2, $m);
        $stmt->bindParam(3, $y);
        $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $zones = [];
    $nokPercentages = [];

    foreach ($results as $row) {
        $zones[] = $row['Zone'];
        $nokPercentages[] = $row['NOKPercentage'];
    }

    $chartData[$atelier] = [
        'zones' => $zones,
        'nokPercentages' => $nokPercentages
    ];
}
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tableau de Bord Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/menupage.css">
  <link rel="icon" type="image/x-icon" href="img/logo.png"></head>
    <link rel="stylesheet" href="style/tbpage.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
<div class="container text-center">
        <h4 class="custom-title p-5">Pourcentage des NOK pour chaque UEP:</h4>
    </div>
<div class="container">
    <div class="row">
        <?php foreach ($chartData as $atelier => $data) : ?>
            <div class="col-md-6">
                <div class="chart-container p-5">
                    <canvas id="<?php echo $atelier; ?>"></canvas>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    <?php foreach ($chartData as $atelier => $data) : ?>
        var <?php echo $atelier; ?>Data = {
            labels: <?php echo json_encode($data['zones']); ?>,
            datasets: [{
                label: 'NOK Percentage',
                data: <?php echo json_encode($data['nokPercentages']); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        };

        var <?php echo $atelier; ?>Ctx = document.getElementById('<?php echo $atelier; ?>').getContext('2d');
        new Chart(<?php echo $atelier; ?>Ctx, {
            type: 'bar',
            data: <?php echo $atelier; ?>Data,
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
                        text: 'UEP NOK Percentage for Atelier <?php echo $atelier; ?>'
                    }
                }
            }
        });
    <?php endforeach; ?>
</script>
<div class="text-center">
<a href="tbpage3.php?m=<?php echo"$m"; ?>&y=<?php echo"$y"; ?>"  class="btn btn-success w-25 m-5">SUIVANT</a>
<a href="tbpage.php" class="btn btn-danger w-25 m-5">RETOUR</a>

</div>


</body>
</html>
