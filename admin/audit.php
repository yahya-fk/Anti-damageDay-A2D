<?php
require_once "dbaction.php";
require("../tablesaction.php");
session_start();
sessiongest();
$conn = connect();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <title>AUDITS DATA</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <link href="style/styles.css" rel="stylesheet" />
    </head>
    <body>
    <div class="d-flex" id="wrapper">
            <div class="border-end bg-white" id="sidebar-wrapper">
                <div class="sidebar-heading border-bottom bg-light">ANTI-DAMAGE DAY</div>
                <div class="list-group list-group-flush">
                    <a class="list-group-item list-group-item-action  list-group-item-light p-3" href="main.php">MAIN</a>
                    <a class="list-group-item list-group-item-action active list-group-item-light p-3" href="audit.php">Audits</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="user.php">USERS</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="question.php">Questions</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="planning.php">Planning</a>
                </div>
            </div>
            <div id="page-content-wrapper">
                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                    <div class="container-fluid">
                        <button class="btn btn-primary" id="sidebarToggle">Menu</button>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                                <li class="nav-item"><a class="nav-link" href="../index.php">Normal APP</a></li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Account</a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item"><?php echo $_SESSION["id"] ?></a>
                                        <a class="dropdown-item"><?php getUserName($_SESSION["id"]) ?></a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item bg-danger" href="logout.php">Logout</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="container-fluid">
                <div class="container text-center">
      <h1 class="custom-title">AUDITS DATA</h1>
    </div>

    <?php
         $annees = GetAuditsYear($conn);
         $months = GetAuditsMonth($conn);
      if (isset($_GET['mois'])) {
        $selectedMonth = $_GET['mois'];
        $selectedYear = $_GET['annee'];
        if (empty($selectedYear)) {
            $selectedYear = date('Y');
        }

        $audits = getAuditsmy($conn, $selectedMonth, $selectedYear);
    }
    else{
    $audits = getAudits($conn);

    }
    ?>

<form method="GET" class="p-2 filter-form text-center">
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
    </div>
    <button class="btn btn-secondary w-100" type="submit">Filter</button>
    </form>
    <table class=" table w-100 m-auto">
      <thead>
      <tr class="text-center">
        <th>ID</th>
        <th>Date</th>
        <th>ADITEUR</th>
        <th>ATELIER</th>
        <th>UEP</th>
        <th>MODULE</th>
        <th>POSTE</th>
        <th>OPERATEUR</th>
        <th>EQUIPE</th>
        <th>ACTIONS</th>
      </tr>
      </thead>
      <tbody>
      <?php foreach ($audits as $audit) :
        $Poste = GetPosteName($conn, $audit['id_Poste']);
        $Module = GetModuleName2($conn, $audit['id_Poste']);
        $UEP = GetUEPName($conn, $audit['id_Poste']);
        $Atelier = GetAtelierName($conn, $audit['id_Poste']);
        $Equipe = GetEquipeName($conn, $audit['id_E']);
        $Operateur = GetOperateur($conn, $audit['id_E']);
        $Nom = GetNom($conn, $audit['id_P']);
        $Prenom = GetPrenom($conn, $audit['id_P']);
        ?>
        <tr>
          <td ><?php echo $audit['id_A']; ?></td>
          <td><?php echo $audit['Date']; ?></td>
          <td style="font-size:10px; font-weight:bolder;"><?php echo $Nom . ' ' . $Prenom; ?></td>
          <td><?php echo $Atelier; ?></td>
          <td><?php echo $UEP; ?></td>
          <td><?php echo $Module; ?></td>
          <td><?php echo $Poste; ?></td>
          <td><?php echo $Operateur; ?></td>
          <td><?php echo $Equipe; ?></td>
          <td class="container d-flex">
            <a style="font-size:10px;" href="accederaudit.php?id=<?php echo $audit['id_A']; ?>"
               class="W-50 btn btn-success flex-fill me-2">Accéder</a>
            <a style="font-size:10px;" href="deleteAudit.php?id=<?php echo $audit['id_A']; ?>"
               class="w-50 btn btn-danger flex-fill">Supprimer</a>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
