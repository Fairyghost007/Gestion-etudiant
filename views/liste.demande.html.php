
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
        <form action="<?=webRoot?>?page=liste" method="POST">
          <div>
              <label for="etat">Etat</label>
              <select name="etat" id="etat">
                  <option value="Select Etat" <?= ($selectedFilter === 'Select Etat') ? 'selected' : '' ?>>Select Etat</option>
                  <option value="En cours" <?= ($selectedFilter === 'En cours') ? 'selected' : '' ?>>En cours</option>
                  <option value="Accepter" <?= ($selectedFilter === 'Accepter') ? 'selected' : '' ?>>Accepter</option>
                  <option value="Rejetter" <?= ($selectedFilter === 'Rejetter') ? 'selected' : '' ?>>Rejetter</option>
              </select>
              <button type="submit" name="page" value="form-filtre-demande">OK</button>
          </div>
        </form>
        <div>
          <a href="http://localhost:8000?page=add_demande">NOUVEAU</a>
        </div>
      </div>
      <div class="tableContainer">
        <table>
          <thead>
                <tr>
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
                  <td><?=$demande["date"] ?></td>
                  <td><?=$demande["type"] ?></td>
                  <td><?=$demande["etat"] ?></td>
                  <td><a href="http://localhost:8000?page=detail&demande_id=<?=$demande['id']?>">Detail</a></td>
                </tr>
              <?php endforeach; 
            ?>
          </tbody>
        </table>
      </div>
      <?php if ($nbrOfPage > 1):?>
      <div class="pagination">
          <?php
          for($i=1;$i<=$nbrOfPage;$i++){
            if($pageNumber!=$i){
              echo"<a  href='http://localhost:8000?page=liste&liste=liste$i'>$i</a>";

            }else{
              echo "<a class='active' href='http://localhost:8000?page=liste&liste=liste$i'>$i</a>";
            }
          }
          ?>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>












