<?php 
require("../conexion.php");
$conn=conect_bd();
if(isset($_GET['id_p'])){
    $sql="DELETE FROM personne WHERE id_P = ?";
    $stmt=$conn->prepare($sql);
    $stmt->bindParam(1,$_GET['id_p']);
    $stmt->execute();
    header("location: main.php?success=User has been deleted");
    exit;
}
elseif(isset($_GET['id_q'])){
    $sql="DELETE FROM questions WHERE id_Q = ?";
    $stmt=$conn->prepare($sql);
    $stmt->bindParam(1,$_GET['id_q']);
    $stmt->execute();
    header("location: main.php?success=question has been deleted");
    exit;
}
elseif(isset($_GET['id_d'])){
    $sql="DELETE FROM a2djour WHERE id = ?";
    $stmt=$conn->prepare($sql);
    $stmt->bindParam(1,$_GET['id_d']);
    $stmt->execute();
    header("location: main.php?success=day has been deleted");
    exit;
}
else{
    header("location: main.php");
    exit;
}