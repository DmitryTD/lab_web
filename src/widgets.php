<?php
include 'share/functions.php';
?>
<meta charset="UTF-8" />

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

<!--   -->
<title>БД Картины | Виджеты</title>
<link rel="stylesheet" href="share/widget_time.css">

<?php
include 'share/navbar.php';
?>

<br> <br>

<span class="span" id="doc_time">
    Дата и время
</span>
<script type="text/javascript">
    clock();
</script>

<?php

include 'share/widget_currencyConverter.php';
include 'share/widget_calc.php'
?>

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