<?php
include 'share/functions.php';
include 'share/functions_RSS.php';

if (isset($_POST['add_news'])) {
    add_news();
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
                <label>Заголовок</label> <br>
                <input type="text" name="Title" required />
            </div>

            <div class="form-element">
                <label>Ссылка на источник (необязательно)</label> <br>
                <input type="text" name="Source"/>
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
}

generate_xml();
displayRSS();
?>


<footer class="footer">© 2023 Михальченко Дмитрий ИВТ-Б20 ИАТЭ НИЯУ МИФИ</footer>