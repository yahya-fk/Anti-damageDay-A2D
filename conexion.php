<?php
function conect_bd()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db= "anti damage day";
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
      }

    return $conn;
}
function end_con($conn){
    $conn=null;
    return $conn;
}

?>
