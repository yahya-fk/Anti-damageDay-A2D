<?php 
require("../conexion.php");
$conn=conect_bd();
if(isset($_GET['id'])){
    $sql="DELETE FROM audit WHERE id_A = ?";
    $stmt=$conn->prepare($sql);
    $stmt->bindParam(1,$_GET['id']);
    $stmt->execute();
    header("location: main.php?success=data has been deleted");
    exit;
}
else{
    header("location: main.php");
    exit;
}