<?php
    include 'controllers/db.php';
    
    if($_SESSION['user'])
    {
        header("Location:/task");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <title>Вход</title>
</head>
<body>
    <div class="auth">
        <form class="auth" action="controllers/auth_reg.php" method="post">
            <h2>Вход/Регистрация</h2>
            <input type="text" placeholder="Логин" name="login">
            <input type="password" placeholder="Пароль" name="pass">
            <input type="submit" value="Войти" name="auth">
            <font color="red"><?=$_SESSION['error']?></font>
        </form>
    </div>
</body>
</html>