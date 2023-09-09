<!-- Подключаем основной стиль  -->
<link rel="stylesheet" href="../share/main.css">
<link rel="stylesheet" href="../share/RSS_and_add.css">
<?php
echo <<<HTML
<header class="header">База данных "Картины"</header>
<div class="navbar">
    <a href="../index.php">Главная страница</a>
    <a href="../xml.php">XML</a>
    <a href="../RSS.php">RSS</a>
    <a href="../widgets.php">Виджеты</a>
    <a href="../partners.php">Партнёры</a>
    <div class="dropdown">
        <button class="dropbtn"> База данных
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <a href="../about.php">О БД</a>
            <a href="../addpainting.php">Добавление данных</a>
            <a href="../search.php">Поиск картин по музею и веку написания</a>
            <a href="../statistics.php">Статистика</a>
        </div>
    </div>
    
HTML;
    
print_reg_auth();
    
echo "</div>";
?>