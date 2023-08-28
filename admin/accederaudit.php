<?php 
  session_start();
  require ("../conexion.php");
  require("../tablesaction.php");
  require_once "dbaction.php";
  sessiongest();
  $conn=conect_bd();
  if(isset($_GET["id"])){
      $sql1 = "SELECT DISTINCT equipe, operateur, atelier, zone, module, poste
      FROM audit
      JOIN poste ON audit.id_Poste = poste.id_P
      JOIN module ON poste.id_M = module.id_M
      JOIN zone ON module.id_Z = zone.id_Z
      JOIN atelier ON atelier.id = zone.id_Atelier
      JOIN reponse ON reponse.id_A = audit.id_A
      JOIN personne ON personne.id_P = audit.id_P
      JOIN equipe ON audit.id_E = equipe.id_E
      WHERE audit.id_A = ?";

    $stmt1 = $conn->prepare($sql1);
    $stmt1->bindParam(1, $_GET['id']);
    $stmt1->execute();
    $result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result1 as $row) {
    $Atelier = $row['atelier'];
    $NomOp = $row['operateur'];
    $UEP = $row['zone'];
    $Module = $row['module'];
    $Poste = $row['poste'];
    $Equipe = $row['equipe'];
    }


      $stmt = null;


  }
  else{
    header("Location: audit.php");
  }
  
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>AUDITS DATA</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
    <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">ATELIER</h5>
                                            <p class="card-text"><?php echo $Atelier; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">UEP</h5>
                                            <p class="card-text"><?php echo $UEP; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">MODULE</h5>
                                            <p class="card-text"><?php echo $Module; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">POSTE</h5>
                                            <p class="card-text"><?php echo $Poste; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">OPERATEUR</h5>
                                            <p class="card-text"><?php echo $NomOp; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">EQUIPE</h5>
                                            <p class="card-text"><?php echo $Equipe; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>

<?php
          $sql2 = "SELECT DISTINCT question, reponse, commentaire
            FROM audit
            JOIN reponse ON reponse.id_A = audit.id_A
            JOIN questions ON reponse.id_Q = questions.id_Q
            where reponse.id_A=?
            ";

            $stmt2 = $conn->prepare($sql2);
            $stmt2->bindParam(1, $_GET['id']);
            $stmt2->execute();
            $result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

            $html = '<div class="p-5  table-container  row">
            ';
            $html .= '<table border="1" cellpadding="5" cellspacing="0">';
            $html .= '<tr class="text-center"><th>Question</th><th>Response</th><th>Comment</th></tr>';
            foreach ($result2 as $row) {
                $html .= '<tr>';
                $html .= '<td>' . $row['question'] . '</td>';
                $html .= '<td>' . $row['reponse'] . '</td>';
                $html .= '<td>' . $row['commentaire'] . '</td>';
                $html .= '</tr>';
            }
            $html .= '</table></div>';
            echo $html;
?>
                    </div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script  src="js/scripts.js"></script>
  <style>
    /* Adjusted table style */
    .table-container {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 10px;
        overflow: hidden;
    }

    .table {
        width: 100%;
        margin-bottom: 0;
        background-color: #ffffff;
    }

    .table th,
    .table td {
        padding: 12px;
        text-align: left;
        border: 1px solid #dee2e6;
        border-bottom: 1px solid #dee2e6;
    }

    /* Adjusted card style */
    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s;
    }

    .card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .card-body {
        padding: 20px;
    }

    .card-title {
        font-size: 18px;
        font-weight: bold;
    }

    .card-subtitle {
        font-size: 15px;
    }

    /* Adjusted custom title */
    .custom-title {
        margin-top: 20px;
        margin-bottom: 30px;
        font-size: 24px;
        font-weight: bold;
    }
</style>
</html>
