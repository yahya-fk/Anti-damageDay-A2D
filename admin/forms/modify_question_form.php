<h1>Modify Question Infos:</h1>
<form action="modifyquestion.php" class="p-5" method="POST">
    <label for="id">ID:</label>
    <input type="text" name="id" value="<?php echo $question["id_Q"] ?>" readonly>
    <label for="question">Question:</label>
    <input type="text" name="question" value="<?php echo $question["Question"] ?>">
    <label for="id_t">Type:</label>
    <select name="id_t" id="id_t">
        <option value="1" <?php if ($question["id_T"] == 1) echo "selected"; ?>>Main D'oeuvre</option>
        <option value="2" <?php if ($question["id_T"] == 2) echo "selected"; ?>>Moyen</option>
        <option value="3" <?php if ($question["id_T"] == 3) echo "selected"; ?>>Methode</option>
        <option value="4" <?php if ($question["id_T"] == 4) echo "selected"; ?>>Milieu</option>
        <option value="5" <?php if ($question["id_T"] == 5) echo "selected"; ?>>Matiere</option>

    </select>    
    <div class="row p-2">
        <div class="col-6">
            <input type="submit" class="btn btn-primary btn-block" value="Modify the User">
        </div>
        <div class="col-6">
            <a href="question.php" class="btn btn-danger btn-block">Back</a>
        </div>
    </div>
</form>