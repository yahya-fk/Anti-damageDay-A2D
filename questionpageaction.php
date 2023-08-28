<?php 
require("conexion.php");
require("tablesaction.php");
require("SessionManager.php");
session_start();
$conn = null;

try {
    $conn = conect_bd();

    if(isset($_GET['id'])){
        CheckQuestionnaire($conn);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nbr = GetQuestionNumber($conn);
        for($i = 1; $i <= $nbr; $i++){
            $id = $_SESSION['Audit'];
            $var1 = "cmnt$i";
            $var1 = $_POST[$var1];
            if($i == 20){
                InsertAnswertData($conn, NULL, $var1, $i, $id);
                continue;
            }
            else{
                $var = "qst$i";
                $var = $_POST[$var];
            }

            InsertAnswertData($conn, $var, $var1, $i, $id);
        }

        unset($_SESSION['Questionnaire']);
        header("Location: menupage.php?data=valider");
        exit;
    }
    else {
        header("Location: auditpage.php?error=true");
        exit;
    }
} catch (PDOException $e) {
   
    echo "An error occurred: " . $e->getMessage();
} finally {
    if ($conn !== null) {
        $conn = null; 
    }
}
?>
