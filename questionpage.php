<?php 
  session_start();
  require ("conexion.php");
  require("tablesaction.php");
  $conn=conect_bd();
  if(isset($_SESSION['page_loaded'])){
    unset($_SESSION['page_loaded']);
    header("location: questionpageaction.php?id=$idAudit");
    exit;
  }
  if (!isset($_SESSION['id'])) {
      header("Location: index.php");
      exit;
  }
  $id=$_SESSION['id'];
  
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
  if(isset($_POST['Atelier']) && isset($_POST['Zone'])  && isset($_POST['Operateur']) && isset($_POST['Equipe']) && $_POST['module']> 0 && $_POST['poste'] > 0){
    $Atelier=$_POST['Atelier'];
    $Zone=$_POST['Zone'];
    $Operateur=$_POST['Operateur'];
    $Equipe=$_POST['Equipe'];
    $idm=$_POST['module'];
    $idp=$_POST['poste'];
    $Module=GetModuleName($conn,$idm);
    $Poste=GetPosteName($conn,$idp);
    }


  
  else{
    header("Location: auditpage.php?error=true");
          exit;
  }


  $ide=ManageTheEquipes($conn,$Equipe,$Operateur);
  $idAudit=IsererAuditData($conn,$ide,$id,$idp);
  $_SESSION['Audit']=$idAudit;
  $_SESSION["Questionnaire"]="questionnaire active";



  $sql = "SELECT atelier,zone FROM atelier join zone on id_Atelier=id WHERE id_z = ?;";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(1, $Zone);
  $stmt->execute();

  if ($stmt->rowCount() > 0) {
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $zoneNom = $row['zone'];
      $atelierNom = $row['atelier'];

  } else {
    header("Location: logout.php");
    exit;
  }

  $stmt = null;


  $sql = "SELECT id_Q,question,id_T FROM questions";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  if ($stmt->rowCount() > 0) {
  function remplirChampsQuestion($divId,$conn){
    $sql = "SELECT id_Q,question,id_T FROM questions";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $c=0;
    foreach ($stmt as $row){
      $nbr=(int)$row['id_T'];
      if($divId==$nbr){
        $c++;
        $txt=$row['question'];
        echo '
                <div class="form-group custom-form  " id="Div'.$row['id_Q'].'">
                  <div class="p-0 form-group">
                    <label for="qst'.$row['id_Q'].'" id="qst'.$row['id_Q'].'">'.$c.'- '.$txt.'</label>
                    <div class="error-message text-center text-danger" style="display: none;">Merci de remplir le champ commentaire en cas de choix "NOK".</div>
                    <select id="qst'.$row['id_Q'].'" name="qst'.$row['id_Q'].'"  class="form-control hidden-select">
                    <option value="NA">N/A</option>  
                    <option value="NOK">NOK</option>
                      <option value="OK">OK</option>
                    </select>
                  </div>  
                    <div class="hidden-div">
                     <label class="h6 hidden-div" for="cmnt'.$row['id_Q'].'">Commentaire (traité, point dur) :</label>
                     <input type="text" name="cmnt'.$row['id_Q'].'" id="cmnt'.$row['id_Q'].'"  placeholder="Votre Commentaire ici" class="form-control hidden-div" style="color: #243882;">
                     </div>
                 </div>

    ';
          }
      }

    }

    }

?>
<!DOCTYPE html>
<html>
<head>
  <title>Questionnaire Page</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="icon" type="image/x-icon" href="img/logo.png"></head>
  <link rel="stylesheet" href="style/questionpage.css">
</head>
<body class="h-100">

  <nav class="navbar navbar-expand-lg navbar-dark custom-color ">
    <a class="navbar-brand" href="#"><img class="img" src="img/stellantis-4096.png" alt=""></a>

    <div class="user-info">
   
    <a href="questionpageaction.php?id=<?php echo $idAudit; ?>">
  <button class="btn btn-danger rounded-sm ml-2" id="btn">Annuler l'audit</button>
</a>
  </div>
  </nav>




  <div class=" container-fluid ">
    <div class=" row container-fluid">
        <div class="container text-center">
          <h1 class="custom-title" >QUESTIONNAIRE</h1>
          <div class="container justify-space-between">
            <div class="row">
              <div class="col">
                <div class="card">
                  <h2 class="card-title">ATELIER </h2>
                  <h3 class="card-subtitle"><?php echo"$atelierNom"; ?></h3>
                </div>
              </div>
              <div class="col">
                <div class="card">
                  <h2 class="card-title">UEP </h2>
                  <h3 class="card-subtitle"><?php echo"$zoneNom"; ?></h3>
                </div>
              </div>
              <div class="col">
                <div class="card">
                  <h2 class="card-title">MODULE </h2>
                  <h3 class="card-subtitle"><?php echo"$Module"; ?></h3>
                </div>
              </div>
              <div class="col">
                <div class="card">
                  <h2 class="card-title">POSTE </h2>
                  <h3 class="card-subtitle"><?php echo"$Poste"; ?></h3>
                </div>
              </div>
              <div class="col">
                <div class="card">
                  <h2 class="card-title">OPERATEUR </h2>
                  <h3 class="card-subtitle"><?php echo"$Operateur"; ?></h3>
                </div>
              </div>
              <div class="col">
                <div class="card">
                  <h2 class="card-title">EQUIPE </h2>
                  <h3 class="card-subtitle"><?php echo"$Equipe"; ?></h3>
                </div>
              </div>
            </div>
          </div>


        </div>
    </div >
    <div class="row d-flex p-0">

      <div class="col-2 flex-item sidebar p-0 custom-color">
        <ul class="nav flex-column p-0" style="height: fit-content;">


        <li class="nav-item ">
            <div class="nav-div">
            <a class="navsideLink div-link nav-link text-light text-sm  text-center" data-target="1">
            <img src="img/icons/main.png" alt="Icon 2" class="icone" width="50%" height="20%"> 
            <h4 class="navsideTitle ">MAIN D'OEUVRE</h4>
            </a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link div-link text-light navsideLink text-center" data-target="2">
            <img src="img/icons/moy.png" alt="Icon 2" class="icone" width="50%" height="20%"> 
            <h4 class="navsideTitle">MOYEN</h4>
            </a>
          <li class="nav-item">
            <a class="nav-link div-link text-light navsideLink text-center" data-target="3">
            <img src="img/icons/METHOD.png" alt="Icon 2" class="icone" width="50%" height="20%"> 
            <h4 class="navsideTitle">METHODE</h4>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link div-link text-light navsideLink text-center" data-target="4">
            <img src="img/icons/milieu.png" alt="Icon 2" class="icone" width="50%" height="20%"> 
            <h4 class="navsideTitle">MILIEU</h4>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link div-link text-light navsideLink text-center" data-target="5">
            <img src="img/icons/matiere.png" alt="Icon 2" class="icone" width="50%" height="20%"> 
            <h4 class="navsideTitle">MATIERE</h4>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link div-link text-light navsideLink text-center" data-target="6">
            <img src="img/icons/add-button.png" alt="Icon 2" class="icone" width="50%" height="20%"> 
            <h4 class="navsideTitle">AUTRE</h4>
            </a>
          </li>
        </ul>
      </div>



      <div class="flex-item  col-10 menu-section">
        <form  action="questionpageaction.php" method="POST" onsubmit="return validateForm();">


        <div class="div-container div-container1" id="1">
              <div class="text-center">
                <h3>MAIN D'OEUVRE</h3>
              </div>
                <?php
                remplirChampsQuestion(1,$conn)?>



        </div> 
        <div class="div-container" id="2">
              <div class="text-center">
              <h3>MOYEN :</h3>


              </div>
              <?php
                remplirChampsQuestion(2,$conn)?>

        </div>
       <div class="div-container" id="3">
              <div class="text-center">
              <h3>METHODE :</h3>


                </div>
              <?php
                remplirChampsQuestion(3,$conn)?>
        </div>
        <div class="div-container" id="4">
            <div class="text-center">

              <h3>MILIEU :</h3>
              </div>

              <?php
                remplirChampsQuestion(4,$conn)?>

              </div>
              <div class="div-container" id="5">
              <div class="text-center">
              <h3>MATIERE :</h3>

                </div>

              <?php
                remplirChampsQuestion(5,$conn)?>

              </div> 
              <div class="div div-container h-50" id="6">
              <label class="h6" for="cmnt20">Autre Remarque :</label>
                        <input type="text" name="cmnt20" id="cmnt20"  placeholder="Votre Commentaire ici" class="form-control" style="color: #243882; ">

        </div>
        <hr>
        <hr>
        <div class="text-center">
        <p class="text-danger text-center">ne soumettez pas tant que vous n'avez pas répondu à toutes les questions pour tous les 5 M</p>
        </div>
        <button type="submit" id="submitBtn" class="btn w-100 btn-primary">valider</button>
        <script>
            if (performance.navigation.type === 1) {
                      alert('merci de ne pas actualiser cette page');
              }
    function validateForm() {
        const selectElements = document.querySelectorAll('select[id^="qst"]');
        for (let i = 0; i < selectElements.length; i++) {
            const selectElement = selectElements[i];
            if (selectElement.value === "NOK") {
                const commentInput = document.getElementById("cmnt" + selectElement.id.slice(3));
                const commentValue = commentInput.value.trim();
                const questionDiv = document.getElementById("Div" + selectElement.id.slice(3));
                if (commentValue === "") {
                    alert("manque de commentaire !!");
                    questionDiv.querySelector('.error-message').style.display = "block";
                    selectElement.value = "NOK"
                    return false;
                }
                else{
                  questionDiv.querySelector('.error-message').style.display = "none";
                }
            }
        }
        return true;
    }
</script>

        </form>
    
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="js/questionpage.js"></script>
  </body>
  <footer>
    <div class="text-center " style="height: 20px">
      <p class="txt text-dark">2023©  Yahya FEKRANE</p>
    </div>
  </footer>
</html>
<?php

    $_SESSION['page_loaded'] = true;
    ?>