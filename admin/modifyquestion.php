<?php 
  require_once "dbaction.php";
  sessiongest(); 


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
      $id = $_POST["id"];
      $question = $_POST["question"];
      $id_t = $_POST["id_t"];
      updateQuestiondata($id, $question, $id_t);
      header("Location: acceder.php?id_q=$id");
      exit();
    } catch (Exception $e) {
          }      $errorMessage = $e->getMessage();
    }
    ?>