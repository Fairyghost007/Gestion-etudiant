<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?=webRoot?>/styles.css/login.css">
</head>
<body>
    <div class="login-container">
    <h2>Login</h2>
    <form id="login-form" action="<?=webRoot?>" method="post">
        <div class="input-group">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required placeholder="Enter email">
            </div>
            <div class="input-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required placeholder="Enter password"> 
            </div>
            <div class="input-group">
            <button type="submit"  name="page" value="form-login">Login</button>
        </div>
    </form>
</div>
</body>
</html>
