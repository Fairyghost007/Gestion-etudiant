
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sidebar Example</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@200;300;400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?=webRoot?>/styles.css/style3.css">
</head>
<body>
  <div class="sidebar">
  <div class="logo">
    <a href="">Demandes</a>
  </div>
    <div class="info">
      <p>Name: <span id="nameField"> <?=$_SESSION['userConnect']['nom']?> </span></p>
      <p>Surname: <span id="surnameField"><?=$_SESSION['userConnect']['prenom'] ?> </span></p>
      <p>Year: <span id="yearField"><?=$_SESSION['anneEncours']['libelle']?> </span></p>
      <?php if ($_SESSION['userConnect']['role'] == "ROLE_ETUDIANT"): ?>
        <p>Class: <span id="classField"><?=$_SESSION['userConnect']['libelle']?> </span></p>
      <?php endif; ?>
      
    </div>
  </div>
</body>
</html>




