<?php 
include 'share/functions.php';
// Если нажата кнопка регистрации, вызывается функция register
if (isset($_POST['register'])){
    register();
}
?>

<meta charset="UTF-8" />
<!--   -->
<title>БД Картины | Регистрация</title>
<link rel="stylesheet" href="share/reg_oauth.css">

<?php
include 'share/navbar.php';
?>

<form method="post" action="" name="signup-form">
    <div class="form-element">
        <label>Имя</label>
        <input type="text" name="username" required />
    </div>
    <div class="form-element">
        <label>Логин</label>
        <input type="text" name="login" pattern="[a-zA-Z0-9]+" required />
    </div>
    <div class="form-element">
        <label>Пароль</label>
        <input type="password" name="password" required />
    </div>
    <button type="submit" name="register" value="register" class="button">Зарегистрироваться</button>
    <br>
    <br>
    <p>
        У вас уже есть аккаунт? -
        <a href="oauth.php">Войти в аккаунт</a>
    </p>
    <p id="message"></p>
</form>

