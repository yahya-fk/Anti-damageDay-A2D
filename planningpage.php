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

$date=getTheNext($conn);
$stmt = null;
$_SESSION['nom'] = $nom;
$_SESSION['pnom'] = $prenom;
$timestamp = date('Y-m-d');
$sql = "SELECT DISTINCT day FROM a2djour where day >= CURDATE()  ";
$stmt = $conn->prepare($sql);
$stmt->execute();
$auditDates = $stmt->fetchAll(PDO::FETCH_COLUMN);
?>
<!DOCTYPE html>
<html>
<head>
    <title>planning Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/menupage.css">
    <link rel="stylesheet" href="style/tbpage.css">
    <link rel="stylesheet" href="style/planingpage.css">
    <link rel="icon" type="image/x-icon" href="img/logo.png"></head>

</head>
<body class="h-100 w-100">

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
            <li class="nav-item ">
                <a class="nav-link" href="tbpage.php">Tableau de bord</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link " href="planningpage.php">Planning</a>
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
        <h1 class="custom-title p-3">PLANNING </h1>
    </div>
<div class="">
    <h3 class="text-center text ">PROCHAIN ​​JOUR D'AUDIT :</h3>
    <p class="text text-danger font-weight-bold"><?php echo"$date" ?></p>
</div>
<?php
    $monthNames = [
        'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
    ];

    $currentMonth = date('n') - 1;
    $currentYear = date('Y');

    $nextMonth = ($currentMonth + 1) % 12;
    ?>
<div class="container-fluid">
        <div class="row ">
            <div class="col-md-6">
                <h4 class="text-center"><?php echo $monthNames[$currentMonth]; ?> <?php echo $currentYear; ?></h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th>DIM</th>
                            <th>LUN</th>
                            <th>MAR</th>
                            <th>MER</th>
                            <th>JEU</th>
                            <th>VEN</th>
                            <th>SAM</th>
                        </tr>
                    </thead>
                    <tbody id="calendar-body"></tbody>
                </table>
            </div>
            <div class="col-md-6">
                <h4 class="text-center"><?php echo $monthNames[$nextMonth]; ?> <?php echo $currentYear; ?></h4>
                <table class="table">
                <thead>
        <tr>
            <th>DIM</th>
            <th>LUN</th>
            <th>MAR</th>
            <th>MER</th>
            <th>JEU</th>
            <th>VEN</th>
            <th>SAM</th>
        </tr>
    </thead>
    <tbody id="calendar-body2"></tbody>
</table>
</div>
</div>
</div>

<script>
    var currentDate = new Date();
    var currentMonth = currentDate.getMonth();
    var currentYear = currentDate.getFullYear();

    var calendarBody = document.getElementById("calendar-body2");

    function generateCalendar(year, month) {
        calendarBody.innerHTML = "";

        var firstDay = new Date(year, month, 1);
        var startingDay = firstDay.getDay();

        var totalDays = new Date(year, month + 1, 0).getDate();
        var c=1;
        var date = 1;
        for (var i = 0; i < 6; i++) {
            var row = document.createElement("tr");
            row.classList.add("next-month"); // Changed 'next' to 'next-month'
            for (var j = 0; j < 7; j++) {
                if (i === 0 && j < startingDay) {
                    var cell = document.createElement("td");
                    row.appendChild(cell);
                } else if (date > totalDays) {
                    break;
                } else {
                    var cell = document.createElement("td");
                    cell.textContent = date;
                    row.appendChild(cell);
                    cell.id=c;
                    c++;
                    date++;
                }
            }

            calendarBody.appendChild(row);

            if (date > totalDays) {
                break;
            }
        }
    }

    generateCalendar(currentYear, currentMonth);
    generateCalendar(currentMonth === 11 ? currentYear + 1 : currentYear, (currentMonth + 1) % 12);

</script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<script>
    var currentDate = new Date();
    var currentMonth = currentDate.getMonth();
    var currentYear = currentDate.getFullYear();

    var calendarBody = document.getElementById("calendar-body");

    function generateCalendar(year, month) {
        calendarBody.innerHTML = "";

        var firstDay = new Date(year, month, 1);
        var startingDay = firstDay.getDay();

        var totalDays = new Date(year, month + 1, 0).getDate();

        var date = 1;
        for (var i = 0; i < 6; i++) {
            var row = document.createElement("tr");

            for (var j = 0; j < 7; j++) {
                if (i === 0 && j < startingDay) {
                    var cell = document.createElement("td");
                    row.appendChild(cell);
                } else if (date > totalDays) {
                    break;
                } else {
                    var cell = document.createElement("td");
                    cell.textContent = date;
                    row.appendChild(cell);

                    date++;
                }
            }

            calendarBody.appendChild(row);

            if (date > totalDays) {
                break;
            }
        }
    }

    function highlightSelectedDay(selectedDate) {
        var selectedDate = new Date(/*document.getElementById("date-input").value*/selectedDate);

        if (!isNaN(selectedDate.getTime())) {
            var selectedDay = selectedDate.getDate();

            var cells = calendarBody.getElementsByTagName("td");
            for (var i = 0; i < cells.length; i++) {
                if (parseInt(cells[i].textContent) === selectedDay) {
                    cells[i].classList.add("highlight");
                } 

            }
        }
    }



    for (var i = 0; i < 12; i++) {
        generateCalendar(currentYear, i);
    }


</script>



<?php 
        $sql = "SELECT DISTINCT day FROM a2djour";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $auditDates = $stmt->fetchAll(PDO::FETCH_COLUMN);
        sort($auditDates);
        foreach ($auditDates as $date) {
        $givenMonth = date('m', strtotime($date));
        $currentMonth = date('m');
        if ($givenMonth == $currentMonth) {
                echo"<script>
            // document.getElementById('date-input').value='$date';
            highlightSelectedDay('$date')        
                </script>";}
        } 
        $sql="SELECT day FROM a2djour
        WHERE day BETWEEN DATE_FORMAT(NOW() + INTERVAL 1 MONTH, '%Y-%m-01')
        AND LAST_DAY(NOW() + INTERVAL 1 MONTH)";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $auditDates2 = $stmt->fetchAll(PDO::FETCH_COLUMN);
        sort($auditDates2);
        foreach ($auditDates2 as $date) {
        $givenMonth = date('m', strtotime($date));
        $currentMonth = date('m');
        $givenDay  = date('d', strtotime($date));
        if ($givenMonth == $currentMonth+1) {
                echo"<script>
            // document.getElementById('date-input').value='$date';
            document.getElementById($givenDay).classList.add('highlight');      
                </script>";}
        } 
?>
</body>
</html>
