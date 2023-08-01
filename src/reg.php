<!--   -->
<!-- Подключаем основной стиль  -->
<link rel="stylesheet" href="share/main.css">
<link rel="stylesheet" href="share/reg_oauth.css">

<?php
// Подключаем функции 
include 'share/functions.php';
// Если нажата кнопка регистрации, вызывается функция register
if (isset($_POST['register'])){
    register();
}
?>

<header class="header">База данных "Картины"</header>
<div class="navbar">
    <a href="index.php">Главная страница</a>

    <div class="dropdown">
        <button class="dropbtn"> База данных
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <a href="about.php">О БД</a>
            <a href="">Добавление данных</a>
            <a href="">Поиск1</a>
            <a href="">Поиск2</a>
            <a href="">Поиск3</a>
            <a href="">Статистика</a>
        </div>
    </div>
    <a href="">XML</a>
    <a href="">RSS</a>
    <a href="widgets.php">Виджеты</a>
    <a href="partners.php">Партнёры</a>
</div>

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
    <button type="submit" name="register" value="register">Зарегестрироваться</button>
    <br>
    <br>
    <p>
        У вас уже есть аккаунт? -
        <a href="oauth.php">Войти в аккаунт</a>
    </p>
    <p id="message"></p>
</form>

