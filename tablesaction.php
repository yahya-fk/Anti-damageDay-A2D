<?php
function ManageTheEquipes($conn,$Equipe,$Operateur){
  
    $sql_check = "SELECT * FROM equipe WHERE UPPER(equipe) = UPPER(?) AND UPPER(operateur) = UPPER(?)";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bindParam(1, $Equipe);
    $stmt_check->bindParam(2, $Operateur);
    $stmt_check->execute();
    
    if ($stmt_check->rowCount() == 0) {
      $sql = "SELECT MAX(id_E + 1) AS next_id FROM equipe";
      $result = $conn->query($sql);
      $row = $result->fetch(PDO::FETCH_ASSOC);
      $nextId = $row['next_id'];
        $sql_insert = "INSERT INTO equipe (equipe, Operateur,id_E) VALUES (UPPER(?), UPPER(?),UPPER(?))";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bindParam(1, $Equipe);
        $stmt_insert->bindParam(2, $Operateur);
        $stmt_insert->bindParam(3, $nextId);

        $stmt_insert->execute();
    }
    
    $sql_check = "SELECT * FROM equipe WHERE UPPER(equipe) = UPPER(?) AND UPPER(operateur) = UPPER(?)";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bindParam(1, $Equipe);
    $stmt_check->bindParam(2, $Operateur);
    $stmt_check->execute();
    
    $row = $stmt_check->fetch(PDO::FETCH_ASSOC);
    $ide = $row['id_E'];
    $stmt_insert=NULL;
   
  return $ide;
}


function IsererAuditData($conn,$ide,$id,$idp){
  date_default_timezone_set('Africa/Casablanca');
  $timestamp = date('dmYHi');
  $auditId = 'audit' . $timestamp;
    $sql_insert = " INSERT INTO audit (`DATE`, `id_P`,  `id_E`, `id_Poste`, `id_A`) VALUES ( CURDATE(), ? , ?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bindParam(1, $id);
        $stmt_insert->bindParam(2, $ide);
        $stmt_insert->bindParam(3, $idp);
        $stmt_insert->bindParam(4, $auditId);

        $stmt_insert->execute();
        $stmt_insert=NULL;
        return $auditId;
}

function GetQuestionNumber($conn){
  $sql_check = "SELECT count(*) as total FROM questions";
  $stmt_check = $conn->prepare($sql_check);
  $stmt_check->execute();
  
  $row = $stmt_check->fetch(PDO::FETCH_ASSOC);
  return $row['total'];
}

function InsertAnswertData($conn,$var,$var1,$i,$id){
    $sql_check = "SELECT * FROM reponse WHERE UPPER(id_A) = UPPER(?)";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bindParam(1, $id);
    $stmt_check->execute();
    if($var1==""){
      $var1=NULL;
    }
    
    if ($stmt_check->rowCount() <= GetQuestionNumber($conn)) {
      

          if($i==20){
            $sql_insert = "INSERT INTO `reponse` ( `Commentaire`, `id_Q`, `id_A`) VALUES ( ?, ?, ?)";
            $stmt_insert = $conn->prepare($sql_insert);
            $stmt_insert->bindParam(1, $var1);
            $stmt_insert->bindParam(2, $i);
            $stmt_insert->bindParam(3, $id);
            $stmt_insert->execute();
          }
          else{
            $sql_insert = "INSERT INTO `reponse` (`Reponse`, `Commentaire`, `id_Q`, `id_A`) VALUES (?, ?, ?, ?)";
            $stmt_insert = $conn->prepare($sql_insert);
            $stmt_insert->bindParam(1, $var);
            $stmt_insert->bindParam(2, $var1);
            $stmt_insert->bindParam(3, $i);
            $stmt_insert->bindParam(4, $id);
            $stmt_insert->execute();
          }

        }

    }

    function GetModuleName($conn,$idm){
      $sql_check = "SELECT module FROM module WHERE UPPER(id_M) = UPPER(?)";
      $stmt_check = $conn->prepare($sql_check);
      $stmt_check->bindParam(1, $idm);
      $stmt_check->execute();
      
      $row = $stmt_check->fetch(PDO::FETCH_ASSOC);
      $Module = $row['module'];
      $stmt_check=NULL;
      return $Module;
    }
    function GetPosteName($conn,$idp){
      $sql_check = "SELECT poste FROM poste WHERE UPPER(id_P) = UPPER(?)";
      $stmt_check = $conn->prepare($sql_check);
      $stmt_check->bindParam(1, $idp);
      $stmt_check->execute();
      
      $row = $stmt_check->fetch(PDO::FETCH_ASSOC);
      $Poste = $row['poste'];
      $stmt_check=NULL;
      return $Poste;
    }


function GetModuleName2($conn,$idm){
  $sql_check = "SELECT m.module
  FROM poste p
  JOIN module m ON m.id_M = p.id_M
  JOIN zone z ON z.id_Z = m.id_Z
  JOIN atelier a ON a.id = z.id_Atelier
  WHERE UPPER(p.id_P) = UPPER(?)";
  $stmt_check = $conn->prepare($sql_check);
  $stmt_check->bindParam(1, $idm);
  $stmt_check->execute();
  
  $row = $stmt_check->fetch(PDO::FETCH_ASSOC);
  $Module = $row['module'];
  $stmt_check=NULL;
  return $Module;
}

function GetUEPName($conn,$idm){
  $sql_check = "SELECT zone
  FROM poste p
  JOIN module m ON m.id_M = p.id_M
  JOIN zone z ON z.id_Z = m.id_Z
  JOIN atelier a ON a.id = z.id_Atelier 
  WHERE UPPER(p.id_P) = UPPER(?)";
  $stmt_check = $conn->prepare($sql_check);
  $stmt_check->bindParam(1, $idm);
  $stmt_check->execute();
  
  $row = $stmt_check->fetch(PDO::FETCH_ASSOC);
  $Module = $row['zone'];
  $stmt_check=NULL;
  return $Module;
}

function GetUEPID($conn,$UEP){
  $sql_check = "SELECT id_Z FROM zone WHERE UPPER(zone) = UPPER(?)";
  $stmt_check = $conn->prepare($sql_check);
  $stmt_check->bindParam(1, $UEP);
  $stmt_check->execute();
  
  $row = $stmt_check->fetch(PDO::FETCH_ASSOC);
  $Module = $row['id_Z'];
  $stmt_check=NULL;
  return $Module;
}

function GetAtelierName($conn,$ide){
  $sql_check = "SELECT atelier
  FROM poste p
  JOIN module m ON m.id_M = p.id_M
  JOIN zone z ON z.id_Z = m.id_Z
  JOIN atelier a ON a.id = z.id_Atelier
  WHERE UPPER(p.id_P) = UPPER(?)";
  $stmt_check = $conn->prepare($sql_check);
  $stmt_check->bindParam(1, $ide);
  $stmt_check->execute();
  
  $row = $stmt_check->fetch(PDO::FETCH_ASSOC);
  $Module = $row['atelier'];
  $stmt_check=NULL;
  return $Module;
}

function GetEquipeName($conn,$idp){
  $sql_check = "SELECT equipe FROM equipe WHERE UPPER(id_E) = UPPER(?)";
  $stmt_check = $conn->prepare($sql_check);
  $stmt_check->bindParam(1, $idp);
  $stmt_check->execute();
  
  $row = $stmt_check->fetch(PDO::FETCH_ASSOC);
  $Module = $row['equipe'];
  $stmt_check=NULL;
  return $Module;
}
function GetOperateur($conn,$idp){
  $sql_check = "SELECT operateur FROM equipe WHERE UPPER(id_E) = UPPER(?)";
  $stmt_check = $conn->prepare($sql_check);
  $stmt_check->bindParam(1, $idp);
  $stmt_check->execute();
  
  $row = $stmt_check->fetch(PDO::FETCH_ASSOC);
  $Module = $row['operateur'];
  $stmt_check=NULL;
  return $Module;
}

function GetNom($conn, $idp){
  $sql_check = "SELECT nom FROM personne WHERE UPPER(id_P) = UPPER(?)";
  $stmt_check = $conn->prepare($sql_check);
  $stmt_check->bindParam(1, $idp);
  $stmt_check->execute();
  
  if ($row = $stmt_check->fetch(PDO::FETCH_ASSOC)) {
    $Module = $row['nom'];
  } else {
    $Module = 'Name Not Found';
  }
  
  $stmt_check = NULL;
  return $Module;
}

function GetPrenom($conn, $idp){
  $sql_check = "SELECT Prenom FROM personne WHERE UPPER(id_P) = UPPER(?)";
  $stmt_check = $conn->prepare($sql_check);
  $stmt_check->bindParam(1, $idp);
  $stmt_check->execute();
  
  if ($row = $stmt_check->fetch(PDO::FETCH_ASSOC)) {
    $Module = $row['Prenom'];
  } else {
    $Module = 'First Name Not Found';
  }
  
  $stmt_check = NULL;
  return $Module;
}

function GetAuditsYear($conn){
  $sql = "SELECT DISTINCT YEAR(Date) AS annee FROM audit";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $annees = $stmt->fetchAll(PDO::FETCH_COLUMN);
  return $annees;
}
function GetAuditsMonth($conn){
  $sql = "SELECT DISTINCT MONTH(Date) AS month FROM audit";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $months = $stmt->fetchAll(PDO::FETCH_COLUMN);
  return $months;
}
function getAudits($conn) {
  $sql = "SELECT id_A, DATE_FORMAT(Date, '%d/%m/%Y') AS Date, id_Poste, id_P, id_E FROM audit order by Year(Date) desc,Month(Date) desc,Day(Date) desc";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $audits = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $audits;
}
function chartByAtelier($conn,$M,$Y){
  $sql = "SELECT atelier.atelier AS Atelier,  
  (SUM(IF(reponse.reponse = 'NOK', 1, 0)) / COUNT(*)) * 100 AS NOKPercentage
  FROM audit
  JOIN poste ON audit.id_Poste = poste.id_P
  JOIN module ON poste.id_M = module.id_M
  JOIN zone ON module.id_Z = zone.id_Z
  JOIN atelier ON atelier.id = zone.id_Atelier
  JOIN reponse ON reponse.id_A = audit.id_A
  WHERE Reponse NOT LIKE 'NA' and MONTH(date) = ? and YEAR(date)= ?
  GROUP BY atelier.atelier";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(1, $M);
  $stmt->bindParam(2, $Y);
  $stmt->execute();
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $results;
}





function chartByUEP($conn,$M,$Y,$Atelier){
$sql = "  SELECT zone.zone AS Zone,
(SUM(IF(reponse.reponse = 'NOK', 1, 0)) / COUNT(*)) * 100 AS NOKPercentage
FROM audit
JOIN poste ON audit.id_Poste = poste.id_P
JOIN module ON poste.id_M = module.id_M
JOIN zone ON module.id_Z = zone.id_Z
JOIN atelier ON atelier.id = zone.id_Atelier
JOIN reponse ON reponse.id_A = audit.id_A
WHERE atelier.atelier = ? AND reponse.reponse <> 'NA' and MONTH(date) = ? and YEAR(date)= ?
GROUP BY zone.zone";
$stmt = $conn->prepare($sql);
$stmt->bindParam(1, $Atelier);
$stmt->bindParam(2, $M);
$stmt->bindParam(3, $Y);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
$zones = [];
$nokPercentages = [];

foreach ($results as $row) {
    $zones[] = $row['Zone'];
    $nokPercentages[] = $row['NOKPercentage'];
}

// Chart configuration
$chartData = [
    'labels' => $zones,
    'datasets' => [
        [
            'label' => 'NOK Percentage',
            'data' => $nokPercentages,
            'backgroundColor' => 'rgba(54, 162, 235, 0.5)',
            'borderColor' => 'rgba(54, 162, 235, 1)',
            'borderWidth' => 1
        ]
    ]
];
}
function getTheNext($conn){
  $sql_check = "SELECT MIN(day) as date FROM a2djour where day >= curdate()";
  $stmt_check = $conn->prepare($sql_check);
  $stmt_check->execute();
  $row = $stmt_check->fetch(PDO::FETCH_ASSOC);
  $Poste = $row['date'];
  $stmt_check=NULL;
  return $Poste;
}

?>




