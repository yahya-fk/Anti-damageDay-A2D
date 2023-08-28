<?php
 require_once "dbaction.php";
 session_start();
 sessiongest();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>ADMIN</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <link href="style/styles.css" rel="stylesheet" />
    </head>
    <body>
    <div class="d-flex" id="wrapper">
            <div class="border-end bg-white" id="sidebar-wrapper">
                <div class="sidebar-heading border-bottom bg-light">ANTI-DAMAGE DAY</div>
                <div class="list-group list-group-flush">
                    <a class="list-group-item list-group-item-action active list-group-item-light p-3" href="main.php">MAIN</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="audit.php">Audits</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="user.php">USERS</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="question.php">Questions</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="planning.php">Planning</a>
                </div>
            </div>
            <div id="page-content-wrapper">
                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                    <div class="container-fluid">
                        <button class="btn btn-primary" id="sidebarToggle">Menu</button>
                        <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
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
      <h1 class="custom-title">MAIN PAGE</h1>
      <?php  if (isset($_GET["success"])) { echo "<p class='text-success'>".$_GET["success"]."</p>"; } ?>
    </div>
    <style>

    .card {
      background-color: #fff;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      padding: 20px;
      margin-bottom: 20px;
    }

    .card .title {
      font-size: 1.25rem;
      font-weight: bold;
      color: #3498db;
      margin-bottom: 10px;
    }

    .card .content {
      font-size: 1rem;
    }
  </style>


      <div class="content">
        <div class="page active" data-page="dashboard">
          <div class="card">
            <div class="title">Number of Users</div>
            <div class="content">
              <h2><?php echo getUserCount(); ?></h2>
              <p>Total users in the app</p>
            </div>
          </div>
          <div class="card">
            <div class="title">Number of SuperUsers</div>
            <div class="content">
              <h2><?php echo getSuperUserCount(); ?></h2>
              <p>Total SuperUsers in the app</p>
            </div>
          </div>
          <div class="card">
            <div class="title">Number of StaffUsers</div>
            <div class="content">
              <h2><?php echo getStaffUserCount(); ?></h2>
              <p>Total StaffUsers in the app</p>
            </div>
          </div>
          <div class="card">
            <div class="title">Number of Audits</div>
            <div class="content">
              <h2><?php echo getAuditCount(); ?></h2>
              <p>Total audits recorded</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script  src="js/scripts.js"></script>

</body>
</html>
