<?php
include 'share/functions.php';
include 'share/functions_RSS.php';

if (isset($_POST['add_news'])) {
    add_news();
}

if (isset($_POST['add_RSS'])) {
    add_RSS();
}
?>

<meta charset="UTF-8" />

<!--   -->
<title>БД Картины | RSS</title>
<link rel="stylesheet" href="share/RSS_and_add.css">

<?php
include 'share/navbar.php';
?>

<h1 style=text-align:center>Новости</h1>
<br> <br>

<?php
// Если сессия не запущена, просим авторизироваться
if (!$_SESSION) {
    echo <<<HTML
    <div class="add">
        <p>Авторизируйтесь для добавления новых новостей</p>
    </div>
		

HTML;

    // Если пользователь авторизирован
    // предоставляем форму для добавления новости
} else {
    echo <<<HTML
    <form method="post" action="" name="add_news" enctype="multipart/form-data">
        <div class="add">

            <div class="form-element">
                <label>Добавить новость<label> <br>
                <label>Заголовок</label> <br>
                <input type="text" name="Title" required />
            </div>

            <div class="form-element">
                <label>Текст новости</label> <br>
                <input type="text" name="Text" required />
            </div>
            <div class="form-element">
                <label>Прикрепить медиа-файл (необязательно)</label> <br>
                <input type="file" name="Media" />
                <p>Поддерживаемые форматы: jpg, jpeg, png, gif</p>
            </div>
        
        <button type="submit" name="add_news" value="">Добавить</button>
        </div>
    </form>
    HTML;

    //Форма для добавления сторонней RSS ленты
    echo <<<HTML
    <br>
    <form method="post" action="" name="add_RSS" enctype="multipart/form-data">
        <div class="add">

            <div class="form-element">
                <label>Добавить стороннюю RSS ленту<label> <br>
                <label>Название ленты</label> <br>
                <input type="text" name="RSS_Name" required />
            </div>
            
            <div class="form-element">
                <label>URL</label> <br>
                <input type="url" name="RSS_URL" required pattern="https?://.+" title="Введите корректный URL">
            </div>
        
        <button type="submit" name="add_RSS" value="">Добавить</button>
        </div>
    </form>
    HTML;
}

generate_xml();
displayRSS();
getFeeds();
?>


<footer class="footer">© 2023 Михальченко Дмитрий ИВТ-Б20 ИАТЭ НИЯУ МИФИ</footer>