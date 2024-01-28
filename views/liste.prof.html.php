
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
        <form action="<?=webRoot?>?page=liste_prof" method="POST">
          <div>
              <label for="module">Modules</label>
              <select name="module" id="module">
                <option value="0" <?= ($selectedFiltermod === "0") ? 'selected' : '' ?>>Select module</option>
                <?php foreach($modules as $module):?>
                    <option value="<?=$module["id"] ?>" <?= ($selectedFiltermod === strval($module["id"])) ? 'selected' : '' ?>><?=$module["libelle"] ?></option>
                <?php endforeach;?>
              </select>
              <button type="submit" name="page" value="form-filtre-module">OK</button>
          </div>
        </form>
        <div>
          <a href="http://localhost:8000?page=add_prof">NOUVEAU</a>
        </div>
      </div>
      <div class="tableContainer">
        <table>
          <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Grade</th>
                    <th>Action</th>
                </tr>
          </thead>
          <tbody>
            <?php
              foreach($profs as $prof):?>
                <tr class="hidden animated">
                    <td><?=$prof["nom"] ?></td>
                    <td><?=$prof["prenom"] ?></td>
                    <td><?=$prof["grade"] ?></td>
                    <td>
                        <a href="http://localhost:8000?page=add_class_prof&prof_id=<?=$prof['id']?>">Classe</a>
                        <a href="http://localhost:8000?page=add_module_prof&prof_id=<?=$prof['id']?>">Module</a>
                        <a href="http://localhost:8000?page=detail_prof&prof_id=<?=$prof['id']?>">Details</a>
                    </td>
                </tr>
              <?php endforeach; 
            ?>
          </tbody>
        </table>
      </div>
      <?php if ($nbrOfPagemod > 1):?>
      <div class="pagination">
          <?php
          for($i=1;$i<=$nbrOfPagemod;$i++){
            if($pageNumber!=$i){
              echo"<a  href='http://localhost:8000?page=liste_prof&liste_prof=liste$i'>$i</a>";

            }else{
              echo "<a class='active' href='http://localhost:8000?page=liste_prof&liste_prof=liste$i'>$i</a>";
            }
          }
          ?>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>












