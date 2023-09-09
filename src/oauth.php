<?php
include 'share/functions.php';
// Если нажата кнопка авторизации, вызывается функция authentication
if (isset($_POST['login'])){
    authentication();
}
?>
<!--   -->
<title>БД Картины | Авторизация</title>
<link rel="stylesheet" href="share/reg_oauth.css">

<?php
include 'share/navbar.php';
?>

<form method="post" action="" name="signin-form">
    <div class="form-element">
        <label>Логин</label>
        <input type="text" name="username" pattern="[a-zA-Z0-9]+" required />
    </div>
    <div class="form-element">
        <label>Пароль</label>
        <input type="password" name="password" required />
    </div>
    <button type="submit" name="login" value="login" class="button">Войти</button>
    <br>
    <br>
    <p>
        Если у вас ещё нет аккаунта -
        <a href="reg.php">Регистрация</a>
    </p>
</form>