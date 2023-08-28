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
        <title>USERS DATA</title>
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
                    <a class="list-group-item list-group-item-action  list-group-item-light p-3" href="user.php">USERS</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="question.php">Questions</a>
                    <a class="list-group-item list-group-item-action active list-group-item-light p-3" href="planning.php">Planning</a>

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
      <h1 class="custom-title">PLANNING DATA</h1>
<form method="POST" action="ppAction.php">
    <div class="">
<?php if(isset($_GET['s'])){
                    if($_GET['s']==2){
                        echo"<p class='text-success'>date enregistrée</p>";

                    }
                    else{
                                    echo"<p class='text-danger'>error</p>";}
                                } ?>
        <label for="date-input">choose a day to add :</label>
        <input type="date" required min="<?php echo $timestamp; ?>" value="<?php echo $timestamp; ?>" id="date-input" name="date-input">
    <button type="submit" class="btn m-2 btn-primary">submit</button>
    </div>

    </form>




    <?php
    $plannings = getPlanning($conn);
    ?>
    <table class="table w-100 m-auto">
    <thead>
    <tr class="text-center">
        <th>Days</th>
        <th>ACTIONS</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($plannings as $planning) : ?>
        <tr>
            <td><?php echo $planning["day"]; ?></td>

          <td class="container d-flex">
            <a style="col-6 font-size:10px;" href="delete.php?id_d=<?php echo $planning["id"]; ?>"
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
