<?php 
  session_start();
  require ("conexion.php");
  require("SessionManager.php");

  if (!isset($_SESSION['id'])) {
      header("Location: index.php");
      exit;
  }
  $user=$_SESSION['id'];
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
  <title>Paramètre Page</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="style/menupage.css">
  <link rel="icon" type="image/x-icon" href="img/logo.png"></head>
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
            <li class="nav-item ">
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
    <div class="user-info">
    <span><?php 
    echo"$nom $prenom"?>
    </span>
    <a href="logout.php"><button class="btn-danger rounded-sm ml-2" id="btn">Se déconnecter</button>
    </a>
  </div>
  </nav>

  

  <div class="container mt-4 menu-section">
  <form action="" method="post">
        <div class="container text-center">
            <h1 class="custom-title">Modifier les informations du compte :</h1>
        </div>
        <div class="form-outline mb-4">
            <label class="form-label" for="id">ID :</label>
            <input name="id" type="text" id="id" readonly class="form-control" value="<?php echo $user; ?>" />
        </div>
        <div class="row">
          <div class="form-outline mb-4 col-6">
                    <label class="form-label" for="Name">Nom :</label>
                    <input name="Name" type="text" id="Name" readonly class="form-control" value="<?php echo $nom; ?>" required />
                </div>
                <div class="form-outline mb-4 col-6">
                    <label class="form-label" for="Name">Prenom :</label>
                    <input name="FName" type="text" id="FName" readonly class="form-control" value="<?php echo $prenom; ?>" required />
                </div>
          </div>
        <div class="form-outline mb-4">
            <label class="form-label" for="Oldpassword">Ancien Mot De Passe :</label>
            <input name="Oldpassword" type="password" id="Oldpassword" class="form-control" required />
        </div>
        <div class="form-outline mb-4">
            <label class="form-label" for="Newpassword">Nouveau Mot De Passe :</label>
            <input name="Newpassword" type="password" id="Newpassword" class="form-control" required />
        </div>
        <div class="form-outline mb-4">
            <label class="form-label" for="id">Confirmez le Mot De Passe :</label>
            <input name="cpswd" type="password" id="cpswd" class="form-control" required />
        </div>
        <button id="button" type="submit" class="btn btn-primary btn-block mb-2 w-100">
            Change Password
        </button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if the form is submitted
        $id = $_POST['id'];
        $name = $_POST['Name'];
        $fname = $_POST['FName'];
        $oldPassword = $_POST['Oldpassword'];
        $newPassword = $_POST['Newpassword'];
        $cpswd = $_POST['cpswd'];

        if ($newPassword !== $cpswd) {
            echo "Error: New password and confirm password do not match.";
            exit;
        }

      
            $conn = conect_bd();

            $stmt = $conn->prepare("SELECT password FROM personne WHERE id_P = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $hashedPassword = $result['password'];

                if (password_verify($oldPassword, $hashedPassword)) {
                    // Hash the new password
                    $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                    // Update the password in the database
                    $stmt = $conn->prepare("UPDATE personne SET password = :password WHERE id_P = :id");
                    $stmt->bindParam(':password', $hashedNewPassword);
                    $stmt->bindParam(':id', $id);
                    $stmt->execute();

                } else {
                    echo "Error: Old password is incorrect.";
                }
            } else {
                echo "Error: User not found.";
            }
          }
    ?>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
<footer>
  <div class="text-center " style="height: 20px">
  <p class="txt text-dark">2023©  Yahya FEKRANE</p>
  </div>
</footer>
</html>