<!-- Подключаем основной стиль  -->
<link rel="stylesheet" href="share/main.css">
<?php
echo <<<HTML
<header class="header">База данных "Картины"</header>
<div class="navbar">
    <a href="index.php">Главная страница</a>
    <a href="XML.php">XML</a>
    <a href="RSS.php">RSS</a>
    <a href="widgets.php">Виджеты</a>
    <a href="partners.php">Партнёры</a>

    <div class="dropdown">
        <button class="dropbtn"> Сервисы
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <a href="widgets.php">Виджеты</a>
            <a href="weather.php">Погода</a>
            <a href="converter.php">Конвертер валют</a>
            <a href="map.php">Карта</a>
        </div>
    </div>

    <div class="dropdown">
        <button class="dropbtn"> База данных
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <a href="about.php">О БД</a>
            <a href="addpainting.php">Добавление данных</a>
            <a href="search.php">Поиск картин по веку и технике</a>
            <a href="statistics.php">Статистика</a>
        </div>
    </div>

HTML;
    
print_reg_auth();
    
echo "</div>";
?>