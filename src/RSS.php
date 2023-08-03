<?php
include 'share/functions.php';
include 'share/functions_RSS.php';
session_start();

if (isset($_POST['add_news'])) {
    add_news();
}
?>

<!--   -->
<!-- Подключаем основной стиль  -->
<link rel="stylesheet" href="share/main.css">


<header class="header">База данных "Картины"</header>
<div class="navbar">
    <a href="index.php">Главная страница</a>
    <a href="">XML</a>
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
                <label>Прикрепить медиа-файл</label> <br>
                <input type="file" name="Media" />
                <p>Поддерживаемые форматы: jpg, jpeg, gif</p>
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