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

?>

<!DOCTYPE html>
<html>
<head>
    <title>Tableau de Bord Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/menupage.css">
    <link rel="stylesheet" href="style/tbpage.css">
    <link rel="icon" type="image/x-icon" href="img/logo.png"></head>
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
        <span> <?php echo "$nom $prenom" ?></span>
        <a href="logout.php"><button class="btn-danger rounded-sm ml-2" id="btn">Se déconnecter</button></a>
    </div>
</nav>


<div class=" w-100  menu-section">
    <div class="container text-center">
        <h1 class="custom-title mt-4">TABLEAU DE BORD</h1>
    </div>

    <?php
    $annees = GetAuditsYear($conn);
    $months = GetAuditsMonth($conn);
    ?>



    <script>
        document.getElementById("showMoreButton").addEventListener('click', () => {
            location.href = "auditData.php";
        });
    </script>

    <?php
    if (isset($_GET['mois'])) {
        $selectedMonth = $_GET['mois'];
        $selectedYear = $_GET['annee'];
        if (empty($selectedYear)) {
            $selectedYear = date('Y');
        }

        $results = chartByAtelier($conn, $selectedMonth, $selectedYear);

        $workshops = [];
        $nokPercentages = [];

        foreach ($results as $row) {
            $workshop = $row['Atelier'];
            $nokPercentage = $row['NOKPercentage'];

            $workshops[] = $workshop;
            $nokPercentages[] = $nokPercentage;
        }

        $missingWorkshops = array_diff(['STRUCTURE', 'PEINTURE', 'MONTAGE', 'BTU'], $workshops);
        foreach ($missingWorkshops as $missingWorkshop) {
            $workshops[] = $missingWorkshop;
            $nokPercentages[] = 0;
        }

        array_multisort($workshops, $nokPercentages);
    }

    if(isset($_GET['atelier'])){
        
        echo"<script>
        location.href='tbpage2.php?y=$selectedYear&m=$selectedMonth';
        </script>";


    }


    ?>

<form method="GET" class=" filter-form text-center">
    <h4 class="p-2">Statistiques et chiffres :</h4>
    <div class="d-flex">
        <div class="form-group col-6">
            <select name="annee" id="annee" class="form-control">
                <option value="">ANNÉE</option>
                <?php foreach ($annees as $annee) : ?>
                    <option value="<?php echo $annee; ?>"><?php echo $annee; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group col-6">
            <select name="mois" id="mois" required class="form-control">
                <option value="">MOIS</option>
                <?php foreach ($months as $month) : ?>
                    <option value="<?php echo $month; ?>"><?php echo $month; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div>
    </div>
    <div id="chartContainer" class="h-50 p-5 chart-container">
        <canvas id="barChart"></canvas>
        <div class="d-flex">
            <canvas class="col-6" id="STRUCTURE"></canvas>
            <canvas class="col-6" id="PEINTURE"></canvas>
        </div>
    </div>
    <div class="text-center">
        <h4>Voir Plus :</h4>
        <input type="checkbox" id="at" name="atelier" value="1">
        <label for="at">Check me and click on "Filtrer"</label>
    </div>



    <button type="submit" class="btn w-75 btn-primary">Filtrer</button>
    </form>

<?php
    if (isset($_GET['mois'])) {

        echo "<script>
        let year = document.getElementById('annee').value='$selectedYear';
        let month = document.getElementById('mois').value='$selectedMonth';";

        
    }

    echo"</script>";
?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var workshops = <?php echo json_encode($workshops); ?>;
    var nokPercentages = <?php echo json_encode($nokPercentages); ?>;

</script>
<script src="js/tbpage.js"></script>


<footer>
    <div class="text-center" style="height: 20px">
        <p class="txt text-dark">2023©  Yahya FEKRANE</p>
    </div>
</footer>
</body>
</html>
