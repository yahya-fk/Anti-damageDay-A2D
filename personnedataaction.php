<?php
require("conexion.php");
session_start();

if (isset($_SESSION['id'])) {
    header("Location: menupage.php");
    exit;
}
$conn = conect_bd();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["id"]) && isset($_POST["Name"]) && isset($_POST["FName"]) && isset($_POST["password"])){
    $id = $_POST["id"];
    $name = $_POST["Name"];
    $fname = $_POST["FName"];
    $password = $_POST["password"];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql_insert = "INSERT INTO personne (id_p, nom, prenom, password,is_staff,is_superuser) VALUES (UPPER(?), UPPER(?), UPPER(?), ?,0,0)";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bindParam(1, $id);
    $stmt_insert->bindParam(2, $name);
    $stmt_insert->bindParam(3, $fname);
    $stmt_insert->bindParam(4, $hashedPassword);
    $stmt_insert->execute();

    $_SESSION["id"] = $id;
    $_SESSION['nom'] = $name;
    $_SESSION['pnom'] = $fname;
    header("Location: menupage.php");
    exit;
    }
    if (isset($_POST["id"]) && !isset($_POST["Name"]) && !isset($_POST["FName"]) && isset($_POST["password"])){
        $id = $_POST["id"];
        $password = $_POST["password"];
    $sql_check = "SELECT * FROM personne WHERE id_P = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bindParam(1, $id);
    $stmt_check->execute();

    if ($stmt_check->rowCount() > 0) {
        $row = $stmt_check->fetch(PDO::FETCH_ASSOC);
        $hashedPassword = $row['password'];

        if (password_verify($password, $hashedPassword)) {
            $_SESSION["id"] = $id;
            $_SESSION['nom'] = $name;
            $_SESSION['pnom'] = $fname;
            header("Location: menupage.php");
            exit;
        } else {
            header("Location: index.php?s=1");
            exit;
        }
    } else {
        header("Location: index.php?s=2");
        exit;
    }
}}

$stmt_check = null;
$stmt_insert = null;

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}
?>
