<?php
include 'share/functions.php';
include 'share/functions_addpainting_and_search.php';
session_start();

if (isset($_POST['add_record'])) {
    add_record();
}
?>
<meta charset="UTF-8" />

<!--   -->
<title>БД Картины | Добавить данные</title>
<link rel="stylesheet" href="share/RSS_and_add.css">

<?php
include 'share/navbar.php';
?>

<h1 style="text-align:center;">Добавить информацию о картине</h1>
<br>
<?php
// Если сессия не запущена, просим авторизироваться
if (!$_SESSION) {
    echo <<<HTML
    <div class="add">
        <p>Для добавления данных в БД требуется авторизация</p>
    </div>
HTML;

// Если пользователь авторизирован
// предоставляем форму для добавления записи
} else {
    // Сделаем предварительно все нужные запросы
    $temp_query = "SELECT DISTINCT Status FROM Paintings;";
    $statuses = get_sql_result($temp_query);

    $temp_query = "SELECT DISTINCT Full_Name FROM Artists";
    $artists = get_sql_result($temp_query);

    $temp_query = "SELECT DISTINCT Technic_Name FROM Technics";
    $technics = get_sql_result($temp_query);

    $temp_query = "SELECT DISTINCT Direction_Name FROM Directions";
    $directions = get_sql_result($temp_query);

    $temp_query = "SELECT DISTINCT Organization_Name FROM Organizations";
    $organizations = get_sql_result($temp_query);

    // Выводим обычные поля
    echo <<<HTML

<form method="post" action="" name="add_record">
    <div class="add">

        <div class="form-element">
            <label>Название картины</label> <br>
            <input type="text" name="PaintingName" required />
        </div>

        <div class="form-element">
            <label>Эпоха</label> <br>
            <input type="text" name="Era" required />
        </div>

        <div class="form-element">
            <label>Век</label> <br>
            <input type="text" name="Century" required />
        </div>

        <div class="form-element">
            <label>Год</label> <br>
            <input type="text" name="Year" required />
        </div>
HTML;

$form = create_dropdown('Status', $statuses, 'Статус');

$form .= "<div class='dropdown-wrapper'>";
$form .= create_dropdown('Full_Name', $artists, 'Художник');
$form .= '<a class="add" href="add/addartist.php">Добавить</a>';
$form .= "</div>";

$form .= "<div class='dropdown-wrapper'>";
$form .= create_dropdown('Technic_Name', $technics, 'Техника');
$form .= '<a class="add" href="add/addtechnic.php">Добавить</a>';
$form .= "</div>";

$form .= "<div class='dropdown-wrapper'>";
$form .= create_dropdown('Direction_Name', $directions, 'Направление');
$form .= '<a class="add" href="add/adddirection.php">Добавить</a>';
$form .= "</div>";

$form .= "<div class='dropdown-wrapper'>";
$form .= create_dropdown('Organization_Name', $organizations, 'Музей');
$form .= '<a class="add" href="add/addmuseum.php">Добавить</a>';
$form .= "</div>";


echo $form;

echo <<<HTML
        <button type="submit" name="add_record" value="">Добавить</button>
    </div>
</form>
HTML;



}

?>
<footer class="footer">© 2023 Михальченко Дмитрий ИВТ-Б20 ИАТЭ НИЯУ МИФИ</footer>