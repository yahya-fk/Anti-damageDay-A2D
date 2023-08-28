<?php 
require_once "dbaction.php";
sessiongest(); 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $question = $_POST["question"];
        $id_t = $_POST["id_t"];
        insertQuestiondata($question, $id_t);
        header("Location: main.php?success=the question has been added");
        exit();
    } catch (Exception $e) {
        $errorMessage = $e->getMessage();
    }
}
?>
