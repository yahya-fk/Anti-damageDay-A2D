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
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>QUESTIONS DATA</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link href="style/styles.css" rel="stylesheet" />
    </head>
    <body>
                <div class="d-flex" id="wrapper">
            <div class="border-end bg-white" id="sidebar-wrapper">
                <div class="sidebar-heading border-bottom bg-light">ANTI-DAMAGE DAY</div>
                <div class="list-group list-group-flush">
                    <a class="list-group-item list-group-item-action  list-group-item-light p-3" href="main.php">MAIN</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="audit.php">Audits</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="user.php">USERS</a>
                    <a class="list-group-item list-group-item-action active list-group-item-light p-3" href="question.php">Questions</a>
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
                                <li class="nav-item active"><a class="nav-link text-light rounded-3 bg-success" href="addquestion.php">Add a Question</a></li>
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
      <h1 class="custom-title">QUESTIONS DATA</h1>



    <?php
    $questions = getQuestions($conn);
    ?>
    <table class="table w-100 m-auto">
    <thead>
    <tr class="text-center">
        <th>Questions</th>
        <th>Type</th>
        <th>ACTIONS</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($questions as $question) : ?>
        <tr>
            <td style="text-align:left; font-size: 13px;"><?php echo $question["question"]; ?></td>
            <td style="white-space: nowrap;"><?php echo $question["libelle"]; ?></td>

          <td class="container d-flex">
            <a style="col-6 font-size:10px;" href="acceder.php?id_q=<?php echo $question["id_q"]; ?>"
               class="W-50 btn btn-success flex-fill me-2">Modify</a>
            <a style="col-6 font-size:10px;" href="delete.php?id_q=<?php echo $question["id_q"]; ?>"
               class="w-50 btn btn-danger flex-fill">Delete</a>
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
