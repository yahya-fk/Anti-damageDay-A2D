<?php
session_start();
require "../conexion.php";
$conn=conect_bd();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = $_POST["password"];
    $sql_check = "SELECT * FROM personne WHERE id_P = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bindParam(1, $username);
    $stmt_check->execute();

    if ($stmt_check->rowCount() == 1) {
        $row = $stmt_check->fetch(PDO::FETCH_ASSOC);
        $hashedPassword = $row['password'];
        if (password_verify($password, $hashedPassword)) {
            if ($row['is_superuser']==0){
                header("Location: index.php?error=you dont have access");
            }
            else{
                $_SESSION["id"] = $username;
            }
            header("Location: main.php");
            exit;
        } 
        else {
            header("Location: index.php?error=invalid password");
            exit;
        }
    }
    else {
        header("Location: index.php?error=invalid username");
    }
}
else{
    header("Location: index.php");
}
?>
