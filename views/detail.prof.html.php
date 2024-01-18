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
            <img src="<?=webRoot?>/img/face.png" alt="Profile photo" >
        </div>
        <div class="info1">
            <div class="info2">
                <div class="type">
                    <p>Nom:<span id="typeField"><?=$prof['nom'] ?></span></p>
                </div>
                <div class="Date">
                    <p>Prenom:<span id="dateField"><?=$prof['prenom']?></span></p>
                </div>
                <div class="Date">
                    <p>Grade:<span id="dateField"><?=$prof['grade']?></span></p>
                </div>
            </div>
            <p class="special">Module:</p>
            <div class="modules">
                <?php if ($nbrOfModules < 1): ?>
                    <div>
                        <span>N/A</span>
                    </div>
                <?php else:?>
                    <?php for ($i = 0; $i < $nbrOfModules; $i++) {?>
                        <div>
                            <span><?= $prof['modules'][$i]['libelle'] ?></span>
                        </div>
                    <?php }?>
                <?php endif; ?>
            </div>
            <p class="special">Classe:</p>
            <div class="modules">
                <?php if ($nbrOfClasses < 1): ?>
                    <div>
                        <span>N/A</span>
                    </div>
                <?php else:?>
                    <?php for ($i = 0; $i < $nbrOfClasses; $i++) {?>
                        <div>
                            <span><?= $prof['classes'][$i]['libelle'] ?></span>
                        </div>
                    <?php }?>
                <?php endif; ?>
            </div>
            
        </div>
            
    </div>
</body>
</html>