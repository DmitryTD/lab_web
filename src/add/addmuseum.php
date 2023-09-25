<?php
include '../share/functions.php';
include '../share/functions_addpainting_and_search.php';
session_start();

if (isset($_POST['add_record'])) {
    $Name = $_POST['Organization_Name'];
    $Address = $_POST['Address'];
    $Tel = $_POST['Tel'];
    $Email = $_POST['Email'];

    $temp_query = "INSERT INTO Organizations (Organization_Name, Address, Tel, Email) VALUES ('$Name', '$Address', '$Tel', '$Email');";
    $result = get_sql_result($temp_query);
    
    if(!$result){
        echo "<script>alert('Запись успешно добавлена!');</script>";
    }
}
?>

<!--   -->
<title>БД Картины | Добавление музея</title>
<?php
include 'navbar_add.php';
?>
<h1 style="text-align:center;">Добавить информацию о музее</h1>
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
    // Выводим обычные поля
    echo <<<HTML

<form method="post" action="" name="add_record">
    <div class="add">

        <div class="form-element">
            <label>Название</label> <br>
            <input type="text" name="Organization_Name" required placeholder="Государственный Эрмитаж" />
        </div>

        <div class="form-element">
            <label>Адрес</label> <br>
            <input type="text" name="Address" required placeholder="Санкт-Петербург, Дворцовая наб., 34" />
        </div>

        <div class="form-element">
            <label>Телефон</label> <br>
            <input type="text" name="Tel" required placeholder="+7 (812) 710-90-79" />
        </div>

        <div class="form-element">
            <label>Email</label> <br>
            <input type="text" name="Email" required placeholder="chancery@hermitage.ru"/>
        </div>
HTML;



echo <<<HTML
        <button type="submit" name="add_record" value="">Добавить</button>
    </div>
</form>
HTML;



}

?>
<footer class="footer">© 2023 Михальченко Дмитрий ИВТ-Б20 ИАТЭ НИЯУ МИФИ</footer>