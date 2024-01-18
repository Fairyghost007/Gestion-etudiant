<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?=webRoot?>/styles.css/addstyle.css">
</head>
<body>
    <div class="container">
        <form action="<?=webRoot?>" method="POST">
            <div>
                <label for="nom">nom:</label>
                <input type="text" id="nom" name="nom" >
            </div>
            <div>
                <label for="prenom">prenom:</label>
                <input type="text" id="prenom" name="prenom" >
            </div>
            <div class="typeField">
                <label for="grade">grade:</label>
                <select name="grade" id="grade">
                    <option value="ingenieur">ingenieur</option>
                    <option value="developpeur">developpeur</option>
                </select>
            </div>
            <div class="typeField">
                <label for="">Module:</label>
                <div class="modulesfield">
                    <?php foreach($modules as $module):?>
                        <div class="module">
                            <label for="<?=$module["id"] ?>"><?=$module["libelle"]?></label>
                            <input type="checkbox" name="moduleIds[]" value=<?=$module["id"] ?>>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>
            <div class="typeField">
                <label for="">Classe:</label>
                <div class="modulesfield">
                    <?php foreach($classes as $classe):?>
                        <div class="module">
                            <label for="<?=$classe["id"] ?>"><?=$classe["libelle"]?></label>
                            <input type="checkbox" name="classesIds[]" value="<?=$classe["id"] ?>">
                        </div>
                    <?php endforeach;?>
                </div>
            </div>
            <div></div>
            <div class="btnField">
                <button id="a1" type="submit" name="page" value="form-add-prof2">Anuler</button>
                <button type="submit" name="page" value="form-add-prof">Enregistrer</button>
            </div>
        </form>
    </div>
</body>
</html>