<?php 
function CheckUserSession($i){
    if (!isset($i)) {
    header("Location: index.php");
    exit;
}
}

function CheckNomPrenom(){
    if (isset($_SESSION['nom'])&&isset($_SESSION['pnom'])){
        $nom[1]=$_SESSION['nom'];
        $nom[2]=$_SESSION['pnom'];
        }
        else{
            header("Location: logout.php");
            exit;
        }
    return $nom;
}
function CheckQuestionnaire($conn){
    if (isset($_SESSION["Questionnaire"])) {
        unset($_SESSION['Questionnaire']);
        $sql="Delete from audit where id_A = ?";
        $stmt_insert = $conn->prepare($sql);
        $stmt_insert->bindParam(1, $_SESSION["Audit"]);
        $stmt_insert->execute();
        header("Location: menupage.php");
        exit;
    }
}
function checkTBState(){
    if(!isset($_SESSION['tbActive'])){
        header('location: tbAcces.php');
        exit;
    }
}


?>