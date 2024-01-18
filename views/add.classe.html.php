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
                <label for="libelle">libelle:</label>
                <input type="text" id="libelle" name="libelle" >
            </div>
            <div class="typeField">
                <label for="filliere">filliere:</label>
                <select name="filliere" id="filliere">
                    <option value="GLRS">GLRS</option>
                    <option value="ETSE">ETSE</option>
                    <option value="TTL">TTL</option>
                </select>
            </div>
            <div class="typeField">
                <label for="niveau">niveau:</label>
                <select name="niveau" id="niveau">
                    <option value="L1">L1</option>
                    <option value="L2">L2</option>
                    <option value="L3">L3</option>
                </select>
            </div>
            <div></div>
            <div class="btnField">
                <button id="a1" type="submit" name="page" value="form-add-classe2">Anuler</button>
                <button type="submit" name="page" value="form-add-classe">Enregistrer</button>
            </div>
        </form>
    </div>
</body>
</html>