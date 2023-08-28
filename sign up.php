<?php
require ("conexion.php");

session_start();
if (isset($_SESSION['id'])) {
    header("Location: menupage.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ANTI DAMAGE DAY</title>
    <link rel="shortcut icon" href="logo.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <link rel="icon" type="image/x-icon" href="img/logo.png"></head>
    <link rel="stylesheet" href="style/index.css">
</head>
<body>
<section class="text-center text-lg-start">
    <div class="container py-4">
        <div class="row g-0 align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="card cascading-right" style="
            background: hsla(0, 0%, 100%, 0.55);
            backdrop-filter: blur(30px);
            ">
                    <div class="card-body p-5 shadow-5 text-center">
                        <h2 class="fw-bold mb-5">Inscrivez-vous</h2>
                          <form action="personnedataaction.php" id="registrationForm" method="post">
                          <div class="form-outline mb-4">
                                <label  class="form-label" for="Name">Nom :</label>
                                <input name="Name" type="Name" id="Name" class="form-control"  placeholder="Entrer votre Nom" required />
                            </div>
                            <div class="form-outline mb-4">
                                <label  class="form-label" for="Name">Prenom :</label>
                                <input name="FName" type="FName" id="FName" class="form-control"  placeholder="Entrer votre Prenom" required />
                            </div>
                            <div class="form-outline mb-4">
                                <label  class="form-label" for="id">ID : </label>
                                <input name="id"  type="id" id="id" class="form-control" placeholder="Enter your id " required/>
                                <div id="idError" class="text-danger error-message"></div>
                            </div>
                            <div class="form-outline mb-4">
                                <label  class="form-label" for="password">Mot de Passe :</label>
                                 <input name="password" type="password" id="password" class="form-control"  placeholder="Entrer votre password" required />
                                 <div id="passwordError" class="text-danger error-message"></div>
                            </div>
                            <a href="index.php" class="link">tu as deja un compte ?</a>
                            <button id="button" type="submit" class="btn btn-primary btn-block mb-2 m-3 w-100">
                                Valider
                            </button>


                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-5 mb-lg-0">
                <img src="img/index.gif" class="w-100 rounded-4 shadow-4" alt="" />
            </div>
        </div>
    </div>
</section>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const registrationForm = document.getElementById("registrationForm");
    const idInput = document.getElementById("id");
    const passwordInput = document.getElementById("password");

    idInput.addEventListener("input", function () {
        validateId(this.value);
    });

    passwordInput.addEventListener("input", function () {
        validatePassword(this.value);
    });

    registrationForm.addEventListener("submit", function (event) {
        if (!isFormValid()) {
            event.preventDefault(); 
        }
    });
});

function isFormValid() {
    const idInput = document.getElementById("id");
    const passwordInput = document.getElementById("password");

    const idIsValid = /^[a-zA-Z]+\d+$/.test(idInput.value);
    const passwordIsValid = validatePassword(passwordInput.value);

    return idIsValid && passwordIsValid;
}

function validateId(idValue) {
    const idError = document.getElementById("idError");
    const idInput = document.getElementById("id");
    if (/^[a-zA-Z]+\d+$/.test(idValue)) {
        idError.textContent = "";
        idInput.style.borderColor = "green";
    } else {
        idError.textContent = "ID doit commencer par des lettres et se terminer par des chiffres.";
        idInput.style.borderColor = "red";
    }
}

function validatePassword(passwordValue) {
    const passwordError = document.getElementById("passwordError");
    const passwordInput = document.getElementById("password");

    const hasUpperCase = /[A-Z]/.test(passwordValue);
    const hasNumber = /\d/.test(passwordValue);
    const isLengthValid = passwordValue.length >= 8;

    if (hasUpperCase && hasNumber && isLengthValid) {
        passwordError.textContent = "";
        passwordInput.style.borderColor = "Green";
        return true;
    } else {
        passwordError.textContent = "Mot de passe doit comporter au moins 8 caractères et contenir une lettre majuscule et un chiffre.";
        passwordInput.style.borderColor = "red";
        return false;
    }
}
</script>
</body>
</html>
