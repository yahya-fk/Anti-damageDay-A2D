<?php 
  session_start();
  require_once "dbaction.php";
  sessiongest();  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify User Infos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

        form {
            width: 75%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            color: #333;
        }

        input,select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <?php 
    if(isset($_GET["id_p"])){
            $user = getUser($_GET["id_p"]);
            include "forms/modify_user_form.php"; 
    }
    elseif(isset($_GET["id_q"])){

        $question = getquestion($_GET["id_q"]);
        include "forms/modify_question_form.php"; 

    }
    else{
        header("Location: main.php");
    }
    ?>
</body>
</html>


