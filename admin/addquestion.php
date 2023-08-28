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
    <h1>Add a Question:</h1>
<form action="addaquestion.php" class="p-5" method="POST">
<label for="question">Question:</label>
<input type="text" name="question">
<label for="id_t">Type:</label>
<select required name="id_t" id="id_t">
<option value="">choose a type</option>
<option value="1">Main D'oeuvre</option>
<option value="2" >Moyen</option>
<option value="3">Methode</option>
<option value="4" >Milieu</option>
<option value="5" >Matiere</option>

</select>    
<div class="row p-2">
<div class="col-6">
    <input type="submit" class="btn btn-primary btn-block" value="Add the Question">
</div>
<div class="col-6">
    <a href="question.php" class="btn btn-danger btn-block">Back</a>
</div>
</div>
</form>