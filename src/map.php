<?php
include 'share/functions.php';
?>
<meta charset="UTF-8" />

<!--   -->
<title>БД Картины</title>
<?php
include 'share/navbar.php';
?>

<h1 style=text-align:center>Карта</h1>
<br> <br>

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