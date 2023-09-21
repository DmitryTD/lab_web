<?php
include 'share/functions.php';
?>

<meta charset="UTF-8">
<title>БД Картины - API Документация</title>
<link rel="stylesheet" href="share/api.css">
<?php include 'share/navbar.php'; ?>

<div class="api-docs">
    <h1>Инструкция по использованию API для работы с картинами</h1>

    <section class="section">
        <h2>Общая информация</h2>
        <p>API предоставляет доступ к данным о картинках из нашей базы данных. В настоящее время доступны два
            метода: для получения всех картин и для фильтрации картин по веку.</p>
    </section>

    <section class="section">
        <h2>1. Получение всех картин</h2>
        <code>g930720y.beget.tech/api/get_paintings.php</code><br>
        <strong>Метод:</strong> <code>GET</code><br>
        <strong>Описание:</strong>
        <p>При вызове этого API возвращается список всех картин в базе данных.</p>
        <strong>Формат ответа:</strong>
        <pre><code>[
{
    "Title": "Название картины",
    "Era": "Эпоха",
    "Year": "Год написания картины",
    "Full_name": "Имя художника",
    "Direction_Name": "Название направления",
    "Organization_Name": "Музей",
    "Technic_Name": "Название техники"
}
]</code></pre>
    </section>

    <section class="section">
        <h2>2. Получение картин по веку</h2>
        <code>g930720y.beget.tech/api/get_paintingsByCentury.php?century={век}</code><br><br>
        <ul>
            <li>Где вместо {век} нужно подставить интересующее вас значение</li>
        </ul>
        <strong>Метод:</strong> <code>GET</code><br>
        <strong>Параметры:</strong>
        <ul>
            <li><code>century</code>: Век картин, который вы хотите отфильтровать. (обязательный)</li>
        </ul>
        <strong>Описание:</strong>
        <p>Этот метод возвращает картину или картины, соответствующие указанному веку.</p>
        <strong>Формат ответа:</strong>
        <pre><code>[
{
    "Title": "Название картины",
    "Era": "Эпоха",
    "Year": "Год написания картины",
    "Full_name": "Имя художника",
    "Direction_Name": "Название направления",
    "Organization_Name": "Музей",
    "Technic_Name": "Название техники"
}
]</code></pre>
        <br>
        <p>Если в базе данных нет картин с указанным веком, то будет выдан ответ:</p>
        <pre><code>{"result":"None"}</code></pre>
    </section>

    <section class="section">
        <h2>Ошибки</h2>
        <p>В случае возникновения ошибки, API вернет следующую структуру:</p>
        <pre><code>{
    "error": "Описание ошибки"
}</code></pre>
    </section>
</div>

<footer class="footer">© 2023 Михальченко Дмитрий ИВТ-Б20 ИАТЭ НИЯУ МИФИ</footer>