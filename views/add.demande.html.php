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
            <div class="typeField">
                <label for="type">Type:</label>
                <select name="type" id="type">
                    <option value="Suspension">Suspension</option>
                    <option value="Annulation">Annulation</option>
                </select>
            </div>
            <div></div>
           <div class="motifField">
                <label for="textarea">Motif:</label>
                <textarea name="motif" id="textarea" cols="79" rows="20"></textarea>
            </div>
            <div class="btnField">
                <button id="a1" type="submit" name="page" value="form-add-demande2">Anuler</button>
                <button type="submit" name="page" value="form-add-demande">Enregistrer</button>
            </div>
        </form>
    </div>
</body>
</html>