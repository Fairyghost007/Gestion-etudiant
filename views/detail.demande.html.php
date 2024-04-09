<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?=webRoot?>/styles.css/detailstyle.css">
</head>
<body>
    <div class="container">
        <div class="imgProfile">
            <img src="<?=webRoot?>/img/face4.jpg" alt="Profile photo" >
        </div>
        <div class="info1">
            <div class="info2">
                <?php if ($_SESSION['userConnect']['role'] == "ROLE_AC"): ?>
                    <div class="type">
                        <p>Nom:<span id="typeField"><?=$demande['nom'] ?></span></p>
                    </div>
                    <div class="Date">
                        <p>Prenom:<span id="dateField"><?=$demande['prenom'] ?></span></p>
                    </div>
                    <div class="Date">
                        <p>Classe:<span id="dateField"><?=$classe['libelle'] ?></span></p>
                    </div>
                    <div class="Date">
                        <p>Date:<span id="dateField"><?=$demande['date']?></span></p>
                    </div> 
                <?php elseif ($_SESSION['userConnect']['role'] == "ROLE_ETUDIANT"): ?>
                    <div class="anne">
                        <p>Année:<span id="anneField"><?=$_SESSION["anneEncours"]['libelle'] ?></span></p>
                    </div>
                    <div class="type">
                        <p>Type:<span id="typeField"><?=$demande['type'] ?></span></p>
                    </div>
                    <div class="Date">
                        <p>Date:<span id="dateField"><?=$demande['date']?></span></p>
                    </div>
                <?php endif; ?>
                
            </div>
            <div class="Motif">
                <p>Motif:<p> 
                <textarea name="" id="motifField" cols="80" rows="7"><?=$demande['motif']?></textarea>
            </div>
            <?php if ($_SESSION['userConnect']['role'] == "ROLE_AC"): ?>
                <div class="btnField">
                    <a id="a1" href="http://localhost:8000?page=liste_ac">Rejeter</a>
                    <a  href="http://localhost:8000?page=liste_ac">Accepter</a>
                </div>
            <?php elseif ($_SESSION['userConnect']['role'] == "ROLE_ETUDIANT"): ?>
                <div class="btnField">
                    <a  href="http://localhost:8000?page=liste">OK</a>
                </div>
            <?php endif; ?>
            
        </div>
            
    </div>
</body>
</html>