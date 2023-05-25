<?php
if($_SESSION['user'])
{
    header("Location:/task");
    exit();
}
?>
    <div class="auth">
        <form class="auth" action="" method="post">
            <h2>Вход/Регистрация</h2>
            <input type="text" placeholder="Логин" name="login">
            <input type="password" placeholder="Пароль" name="pass">
            <input type="submit" value="Войти" name="auth">
            <font color="red"><?=$_SESSION['error']?></font>
            <?php unset($_SESSION['error']);?>
        </form>
    </div>

