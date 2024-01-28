<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?=webRoot?>/styles.css/style1.css">
</head>
<body>
    <div class="big-container">
        <div class="container_box">
            <form action="<?=webRoot?>?page=liste_ac" method="POST">
                <div>
                    <label for="matricule">Matricule</label>
                    <select name="matricule" id="matricule">
                        <option value="allmatricule" <?= ($selectedFilterac === 'allmatricule') ? 'selected' : '' ?>>allmatricule</option>
                        <?php foreach($etudiants as $etu):?>
                            <option value="<?=$etu["matricule"] ?>" <?= ($selectedFilterac === $etu["matricule"]) ? 'selected' : '' ?>><?=$etu["matricule"] ?></option>
                        <?php endforeach;?>
                    </select>
                    <button type="submit" name="page" value="form-filtre-demandeac">OK</button>
                </div>
            </form>
        </div>
        <div class="tableContainer">
        <table>
            <thead>
                <tr>
                    <th>Matricule</th>
                    <th>Nom-prenom</th>
                    <th>classe</th>
                    <th>Date</th>
                    <th>Type</th>
                    <th>État</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach($demandes as $demande):?>
                <tr class="hidden animated">
                    <td><?=$demande["matricule"] ?></td>
                    <td><?=$demande["nom"]." ".$demande["prenom"] ?></td>
                    <td><?=$demande["libelle"] ?></td>
                    <td><?=$demande["date"] ?></td>
                    <td><?=$demande["type"] ?></td>
                    <td><?=$demande["etat"] ?></td>
                    <td><a href="http://localhost:8000?page=detail&demande_id=<?=$demande['id']?>&classe_id=<?=$demande['classe_id']?>">Detail</a></td>
                </tr>
                <?php endforeach; 
            ?>
            </tbody>
        </table>
        </div>
        <?php if ($nbrOfPageac > 1):?>
        <div class="pagination">
            <?php
            for($i=1;$i<=$nbrOfPageac;$i++){
                if($pageNumber!=$i){
                echo"<a  href='http://localhost:8000?page=liste_ac&liste_ac=liste$i'>$i</a>";

                }else{
                echo "<a class='active' href='http://localhost:8000?page=liste_ac&liste_ac=liste$i'>$i</a>";
                }
            }
            ?>
        </div>
        <?php endif; ?>
        
    </div>
</body>
</html>













