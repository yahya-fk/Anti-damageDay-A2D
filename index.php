
<?php
/*
 * Copyright 2023 Yahya FEKRANE
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
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
                        <h2 class="fw-bold mb-5">s'inscrire</h2>
                          <form action="personnedataaction.php" method="post">
                            <?php
                                if(isset($_GET['s'])){
                                    $s=$_GET['s'];
                                    if($s==1){
                                    echo"<p class='text-danger'>password is incorrect</p>";}
                                    else
                                    echo"<p class='text-danger'>user not found</p>";

                                }


?>

                            <div class="form-outline mb-4">
                                <label  class="form-label" for="id">ID : </label>
                                <input name="id"  type="id" id="id" class="form-control" placeholder="Enter your id " required/>
                            </div>
                            <div class="form-outline mb-4">
                                <label  class="form-label" for="password">Mot de passe :</label>
                                <input name="password" type="password" id="password" class="form-control"  placeholder="Entrer votre password" required />
                            </div>
                            <a href="sign up.php" class="link">
vous n'avez pas de compte ?</a>
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
</body>
</html>
