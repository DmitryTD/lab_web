<?php
include '../share/functions.php';
include '../share/functions_addpainting_and_search.php';
session_start();

if (isset($_POST['add_record'])) {
    $Name = $_POST['Technic_Name'];
    $Description = $_POST['Description'];

    $temp_query = "INSERT INTO Technics (Technic_Name, Technic_Description) VALUES ('$Name', '$Description');";
    $result = get_sql_result($temp_query);
    
    if(!$result){
        echo "<script>alert('Запись успешно добавлена!');</script>";
    }
}
?>
<!--   -->
<title>БД Картины | Добавление техники</title>
<?php
include 'navbar_add.php';
?>

<h1 style="text-align:center;">Добавить информацию о направлении в искусстве</h1>
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
            <label>Название техники</label> <br>
            <input type="text" name="Technic_Name" required />
        </div>

        <div class="form-element">
            <label>Описание</label> <br>
            <textarea name="Description" rows="5" cols="50" required></textarea>
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