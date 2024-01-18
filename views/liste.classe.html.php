
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
      <form action="<?=webRoot?>?page=liste_classe" method="POST">
          <div>
              <label for="nom_prenom">Nom&Prenom</label>
              <select name="nom_prenom" id="nom_prenom">
                <option value="0" <?= ($selectedFilternp === 'Select np') ? 'selected' : '' ?>>Select nom&prenom</option>
                <?php foreach($profs as $prof):?>
                    <option value="<?=$prof["id"]?>" <?= ($selectedFilternp === $prof["nom"].$prof["prenom"]) ? 'selected' : '' ?>><?=$prof["nom"]. " " .$prof["prenom"] ?></option>
                <?php endforeach;?>
              </select>
              <button type="submit" name="page" value="form-filtre-nom-prenom">OK</button>
          </div>
        </form>
        <div>
          <a href="http://localhost:8000?page=add_classe">NOUVEAU</a>
        </div>
      </div>
      <div class="tableContainer">
        <table>
          <thead>
                <tr>
                    <th>Libelle</th>
                    <th>Filiere</th>
                    <th>Niveau</th>
                </tr>
          </thead>
          <tbody>
            <?php
              foreach($classes as $classe):?>
                <tr class="hidden animated">
                  <td><?=$classe["libelle"] ?></td>
                  <td><?=$classe["filliere"] ?></td>
                  <td><?=$classe["niveau"] ?></td>
                </tr>
              <?php endforeach; 
            ?>
          </tbody>
        </table>
      </div>
      <?php if ($nbrOfPageclass > 1):?>
      <div class="pagination">
          <?php
          for($i=1;$i<=$nbrOfPage;$i++){
            if($pageNumber!=$i){
              echo"<a  href='http://localhost:8000?page=liste_classe&liste=liste$i'>$i</a>";

            }else{
              echo "<a class='active' href='http://localhost:8000?page=liste_classe&liste=liste$i'>$i</a>";
            }
          }
          ?>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>












