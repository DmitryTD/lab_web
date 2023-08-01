<?php
include 'share/functions.php';
session_start();
?>

<!--   -->
<!-- Подключаем основной стиль  -->
<link rel="stylesheet" href="share/main.css">

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
    
    <?php
    print_reg_auth();
    ?>
</div>

<h1 style=text-align:center>Добро пожаловать в базу данных "Картины"</h1>
<br> <br>

<p class="p">
    Для работы с сайтом воспользуйтесь меню, которое находится сверху сайта.
    На сайте реализована работа с базой данных, а также предоставлена
    информация о БД и
    предметной области.
</p>
<br> <br>
<p class="p">
    Просим обратить внимание, что для добавления данных потребуется авторизоваться
    (войти в учётную запись или зарегистироваться, если у вас её нет).
</p>
<br> <br>
<p class="p">
    Приятной работы!
</p>


<footer class="footer">© 2023 Михальченко Дмитрий ИВТ-Б20 ИАТЭ НИЯУ МИФИ</footer>