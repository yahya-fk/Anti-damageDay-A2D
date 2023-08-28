<?php

function connect(){
    require_once "../conexion.php";
    $conn=conect_bd();
    return $conn ;
}
function sessiongest(){
    $conn=connect();
    $id=$_SESSION["id"];
    $sql_check = "SELECT is_superuser FROM personne WHERE id_P = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bindParam(1, $id);
    $stmt_check->execute();

    if ($stmt_check->rowCount() == 1) {
        $row = $stmt_check->fetch(PDO::FETCH_ASSOC);
        if ($row['is_superuser']==0){
                $_SESSION = array();
                session_destroy();
                header("Location: index.php?error=you dont have access");
            }
    }
}
function getUserCount(){
    $conn=connect();
    $sql = "SELECT count(*) as nombre FROM personne";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $nbr = $row['nombre'];
    return $nbr;
}
function getSuperUserCount(){
    $conn=connect();
    $sql = "SELECT count(*) as nombre FROM personne where is_superuser = 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $nbr = $row['nombre'];
    return $nbr;
}
function getStaffUserCount(){
    $conn=connect();
    $sql = "SELECT count(*) as nombre FROM personne where is_staff = 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $nbr = $row['nombre'];
    return $nbr;
}
function getAuditCount(){
    $conn=connect();
    $sql = "SELECT count(*) as nombre FROM audit";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $nbr = $row['nombre'];
    return $nbr;
}
function getUserName($id){
    $conn=connect();
    $sql = "SELECT nom, prenom,is_staff FROM personne WHERE id_p = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $id);
    $stmt->execute();
  
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $nom = $row['nom'];
        $prenom = $row['prenom'];
    } else {
      header("Location: logout.php");
      exit;
    }
    echo $nom;
}

function getAuditsmy($conn, $selectedMonth, $selectedYear){
    $sql = "SELECT id_A, DATE_FORMAT(Date, '%d/%m/%Y') AS Date, id_Poste, id_P, id_E FROM audit WHERE Year(Date) = ? AND Month(Date)=? order by Year(Date) desc,Month(Date) desc,Day(Date) desc";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $selectedYear);
    $stmt->bindParam(2, $selectedMonth);
    $stmt->execute();
    $audits = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $audits;
}
function getUsers($conn){
    $sql = "SELECT id_p, nom, prenom, is_staff, is_superuser FROM personne";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $users;
}


function getUser($id){
    $conn=connect();
    $sql = "SELECT id_p, nom, prenom, is_staff, is_superuser FROM personne WHERE id_p = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $users = $stmt->fetch(PDO::FETCH_ASSOC);
    return $users;
}

function updateUserdata($id, $nom, $prenom, $is_staff, $is_superuser){
    $conn = connect();
    $sql = "UPDATE personne SET nom=UPPER(?), prenom=UPPER(?), is_staff=?, is_superuser=? WHERE id_p=?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $nom);
    $stmt->bindParam(2, $prenom);
    $stmt->bindParam(3, $is_staff);
    $stmt->bindParam(4, $is_superuser);
    $stmt->bindParam(5, $id);
    $stmt->execute();  
}

function getQuestions($conn){
    $sql = "SELECT libelle,id_q,question FROM questions join type on questions.id_t=type.id_t";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $users;
}
function getquestion($id){
    $conn=connect();
    $sql = "SELECT * FROM questions join type on questions.id_t=type.id_t WHERE id_Q = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $questions = $stmt->fetch(PDO::FETCH_ASSOC);
    return $questions;
}

function updateQuestiondata($id, $question, $id_t){
    $conn = connect();
    $sql = "UPDATE questions SET  question=?, id_t=? WHERE id_q=?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $question);
    $stmt->bindParam(2, $id_t);
    $stmt->bindParam(3, $id);
    $stmt->execute();  
}

function insertQuestiondata($question, $id_t){
    $conn = connect();
    $sql = "SELECT MAX(id_Q) as max_id FROM questions";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $maxIdResult = $stmt->fetch(PDO::FETCH_ASSOC);
    $maxId = $maxIdResult["max_id"];
    $id = $maxId + 1;
    
    $sql = "INSERT INTO questions(id_Q, Question, id_T) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $id);
    $stmt->bindParam(2, $question);
    $stmt->bindParam(3, $id_t);
    $stmt->execute();    
}

function getPlanning($conn){
    $sql = "SELECT DATE_FORMAT(day, '%d/%m/%Y') as day ,id FROM a2djour order by Year(day) desc, Month(day) desc, Day(day) desc";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $qts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $qts;
}