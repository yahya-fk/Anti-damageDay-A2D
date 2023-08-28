<h1>Modify User Infos:</h1>
    <form action="modifyuser.php" class="p-5 text-center" method="POST">
        <label for="id">ID:</label>
        <input type="text" name="id" value="<?php echo $user["id_p"] ?>" readonly>
        <div class="row">
        <div class="col-6">
        <label for="nom">Nom:</label>
        <input type="text" name="nom" value="<?php echo $user["nom"] ?>">
        </div>
        <div class="col-6">
        <label for="prenom">Prenom:</label>
        <input type="text" name="prenom" value="<?php echo $user["prenom"] ?>">
        </div>
        </div>
        <label for="is_staff">Is Staff:</label>
        <select name="is_staff" id="is_staff">
            <option value="1" <?php if ($user["is_staff"] == 1) echo "selected"; ?>>True</option>
            <option value="0" <?php if ($user["is_staff"] == 0) echo "selected"; ?>>False</option>
        </select>

        <label for="is_superuser">Is Superuser:</label>
        <select name="is_superuser" id="is_superuser">
            <option value="1" <?php if ($user["is_superuser"] == 1) echo "selected"; ?>>True</option>
            <option value="0" <?php if ($user["is_superuser"] == 0) echo "selected"; ?>>False</option>
        </select>

        
        <div class="row p-2">
            <div class="col-6">
                <input type="submit" class="btn btn-primary btn-block" value="Modify the User">
            </div>
            <div class="col-6">
                <a href="user.php" class="btn btn-danger btn-block">Back</a>
            </div>
        </div>
    </form>