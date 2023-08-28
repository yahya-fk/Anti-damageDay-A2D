<?php
require("dbaction.php");
require("../tablesaction.php");


if (isset($_POST['date-input'])) {
    $conn = connect();
    $sql = "SELECT MAX(id) as max_id FROM a2djour";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $maxIdResult = $stmt->fetch(PDO::FETCH_ASSOC);
    $maxId = $maxIdResult["max_id"];
    $id = $maxId + 1;

    $date = $_POST['date-input'];
    $sql_insert = "INSERT INTO a2djour(day,id) VALUES (DATE_FORMAT(?, '%Y-%m-%d'),?) ";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bindParam(1, $date);
    $stmt_insert->bindParam(2, $id);
    $stmt_insert->execute();
    header("Location: planning.php?s=2");
    exit;
} 
else {
    header("location: planning.php?s=1");
    exit;
}
?>
