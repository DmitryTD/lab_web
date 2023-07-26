<!--   -->
<!-- Подключаем основной стиль  -->
<link rel="stylesheet" href="share/main.css">
<link rel="stylesheet" href="share/reg_oauth.css">

<?php
// Подключаем функции 
include 'share/functions.php';
// Если нажата кнопка авторизации, вызывается функция authentication
if (isset($_POST['login'])){
    authentication();
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
    <a href="">Виджеты</a>
    <a href="partners.php">Партнёры</a>
</div>

<form method="post" action="" name="signin-form">
    <div class="form-element">
        <label>Логин</label>
        <input type="text" name="username" pattern="[a-zA-Z0-9]+" required />
    </div>
    <div class="form-element">
        <label>Пароль</label>
        <input type="password" name="password" required />
    </div>
    <button type="submit" name="login" value="login">Войти</button>
    <br>
    <br>
    <p>
        Если у вас ещё нет аккаунта -
        <a href="reg.php">Регистрация</a>
    </p>
</form>