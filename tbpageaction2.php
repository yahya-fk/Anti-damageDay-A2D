<?php

require ("conexion.php");
$conn=conect_bd();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id=$_GET['id'];
    $m=$_GET['m'];
    $y=$_GET['y'];

    $sql = "SELECT * FROM zone WHERE id_Atelier = UPPER(?)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        
?>
<script>
       <?php
            echo"var tab=[";
            $c=0;
        foreach ($stmt as $row){
            echo "{id:" . $row["id_Z"]. ",nom:'" . $row["zone"]."',idAtelier:".$row["id_Atelier"]."},";
    }
        echo"]\n";
?>
let myjson=JSON.stringify(tab)
//location.href="./auditpage.php?id="+myjson;
<?php
     }
     else {
        echo "DataBase Error !!";
      }
    
    }
    $stmt=NULL;
?>

</script>



<?php
if(isset($_GET['idZ'])  && !isset($_GET['idM'])){
    getZoneValue($conn);
    echo"<script>
   location.href='./tbpage4.php?m=".$m."&y=".$y."&id='+myjson+'&idZ='+myjson1;\n
</script>";
}
if(isset($_GET['idM'])){
    getZoneValue($conn);
    getModuleValue($conn);
    echo"<script>
    location.href='./tbpage4.php?m=".$m."&y=".$y."&id='+myjson+'&idZ='+myjson1+'&idM='+myjson2;\n
</script>";
}
if(!isset($_GET['idZ'])  && !isset($_GET['idM'])){
    echo"<script>
    location.href='./tbpage4.php?m=".$m."&y=".$y."&id='+myjson;\n
    </script>";
}





function getZoneValue($conn){
    $idZ=$_GET['idZ'];
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $sql = "SELECT * FROM module WHERE id_Z = UPPER(?)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $idZ);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {    

                echo"
                <script>var tab1=[";
            foreach ($stmt as $row){
                echo "{id:" . $row["id_M"]. ",nom:'" . $row["module"]."',idAtelier:".$row["id_Z"]."},";
        }
            echo"]\n     myjson1=JSON.stringify(tab1); \n
            //location.href='./auditpage.php?id='+myjson;\n</script>";
    }
    else{
        echo"<script>
        var tab1=[{idAtelier:$idZ}];
        myjson1=JSON.stringify(tab1);
        location.href='./auditpage.php?id='+myjson+'&idZ='+myjson1;\n
        </script>";
    }
}
$stmt=NULL;
}






function getModuleValue($conn){
    $idM=$_GET['idM'];
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $sql = "SELECT * FROM poste WHERE id_M = UPPER(?)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $idM);
        $stmt->execute();
        if ($stmt->rowCount() > 0) { 
                echo"
                <script>var tab2=[";
            foreach ($stmt as $row){
                echo "{id:" . $row["id_P"]. ",nom:'" . $row["poste"]."',idAtelier:".$row["id_M"]."},";
        }
            echo"]\n     myjson2=JSON.stringify(tab2); \n
            //location.href='./auditpage.php?id='+myjson;\n</script>";
    }
    else{
        echo"<script>
        var tab2=[{idAtelier:$idM}];
        myjson2=JSON.stringify(tab2);
        location.href='./auditpage.php?id='+myjson+'&idZ='+myjson1+'&idM='+myjson2;\n
        </script>";

    }
        

    
}
}

?>
