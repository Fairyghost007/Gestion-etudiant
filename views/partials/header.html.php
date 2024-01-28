<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Menu with Profile and Logout</title>
  <link rel="stylesheet" href="<?=webRoot?>/styles.css/style2.css">
</head>
<body>
  <header>
    <div class="menu">
        <div class="space">
          <?php if ($_SESSION['userConnect']['role'] == "ROLE_RP"): ?>
            <a href="<?=webRoot?>?page=liste_classe">Classes</a>
            <a href="<?=webRoot?>?page=liste_prof">Professeurs</a>
          <?php endif; ?>
        </div>
        <div class="profile">
        <?php if ($_SESSION['userConnect']['role'] == "ROLE_ETUDIANT"): ?>
          <img src="<?=webRoot?>/img/face4.jpg" alt="Profile Picture">
        <?php elseif ($_SESSION['userConnect']['role'] == "ROLE_AC"): ?>
          <img src="<?=webRoot?>/img/face3.jpeg" alt="Profile Picture">
        <?php elseif ($_SESSION['userConnect']['role'] == "ROLE_RP"): ?>
          <img src="<?=webRoot?>/img/face2.jpeg" alt="Profile Picture">
        <?php endif; ?>
          
        </div>
        <div class="logout">
          <a href="<?=webRoot?>?page=logout">Logout</a>
        </div>
    </div>
  </header>
</body>
</html>
