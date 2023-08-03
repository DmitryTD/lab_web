<!-- Скрипт для определения времени  -->
<script type="text/javascript">
    function clock() {
        var d = new Date();
        var month_num = d.getMonth()
        var day = d.getDate();
        var hours = d.getHours();
        var minutes = d.getMinutes();
        var seconds = d.getSeconds();

        month = new Array("января", "февраля", "марта", "апреля", "мая", "июня",
            "июля", "августа", "сентября", "октября", "ноября", "декабря");

        if (day <= 9) day = "0" + day;
        if (hours <= 9) hours = "0" + hours;
        if (minutes <= 9) minutes = "0" + minutes;
        if (seconds <= 9) seconds = "0" + seconds;

        date_time = "Сегодня - " + day + " " + month[month_num] + " " + d.getFullYear() +
            " г.<br>Текущее время - " + hours + ":" + minutes + ":" + seconds;
        if (document.layers) {
            document.layers.doc_time.document.write(date_time);
            document.layers.doc_time.document.close();
        }
        else document.getElementById("doc_time").innerHTML = date_time;
        setTimeout("clock()", 1000);
    }
</script>


<?php
include 'share/functions.php';
session_start();
?>

<!--   -->
<!-- Подключаем основной стиль  -->
<link rel="stylesheet" href="share/main.css">
<link rel="stylesheet" href="share/widget_time.css">

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
            <a href="">Статистика</a>
        </div>
    </div>

    <?php
    print_reg_auth();
    ?>
</div>

<br> <br>

<span class="span" id="doc_time">
    Дата и время
</span>
<script type="text/javascript">
    clock();
</script>


<style>
      /* Задаём стили для контейнера карты */
      #map-container {
        height: 400px;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
      }
      /* Задаём стили для карты */
      #map {
        height: 100%;
        width: 50%;
      }
    </style>
        <div id="map-container">
      <div id="map"></div>
    </div>
<script src="https://api-maps.yandex.ru/2.1/?apikey=83a84d76-74f9-45cf-abad-de9a783e68b7&lang=ru_RU" type="text/javascript">
</script>
<script src="share/map.js" type="text/javascript">
</script>

<br> <br>

<footer class="footer">© 2023 Михальченко Дмитрий ИВТ-Б20 ИАТЭ НИЯУ МИФИ</footer>