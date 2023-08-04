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
    <a href="xml.php">XML</a>
    <a href="RSS.php">RSS</a>
    <a href="widgets.php">Виджеты</a>
    <a href="partners.php">Партнёры</a>
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
            <a href="statistics.php">Статистика</a>
        </div>
    </div>

    <?php
    print_reg_auth();
    ?>
</div>

<h1 style=text-align:center>Наши партнёры</h1>
<br> <br>

<p class="p">
    <img width=500px, src="./images/logo1.png"> <br>
    Государственная Третьяковская галерея <br>
    Адрес: Россия, Москва, улица Крымский Вал, 10 <br>
    Телефон: +7 991 298-21-21, +7 495 957-07-27, +7 495 951-36-66 <br>
    Сайт: <a target="_blank" href="https://www.tretyakovgallery.ru/">tretyakovgallery.ru</a> <br>
</p>

<p class="p">
    <img width=500px, src="./images/logo2.png"> <br>
    Эрмитаж <br>
    Адрес: Россия, Санкт-Петербург, Дворцовая набережная, 38 <br>
    Телефон: +7 812 710-90-79 <br>
    Сайт: <a target="_blank" href="https://www.hermitagemuseum.org">hermitagemuseum.org</a> <br>
</p>

<footer class="footer">© 2023 Михальченко Дмитрий ИВТ-Б20 ИАТЭ НИЯУ МИФИ</footer>