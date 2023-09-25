<?php
include '../share/functions.php';
include '../share/functions_addpainting_and_search.php';
session_start();

if (isset($_POST['add_record'])) {
    $Name = $_POST['Artist_Name'];

    $birthdayInput = $_POST['Birthday'];
    $date = DateTime::createFromFormat('d-m-Y', $birthdayInput);
    $Birthday = $date->format('Y-m-d');

    $Country = $_POST['Country'];

    $temp_query = "INSERT INTO Artists (Full_name, Birthday, Artist_country) VALUES ('$Name', '$Birthday', '$Country');";
    $result = get_sql_result($temp_query);
    
    if(!$result){
        echo "<script>alert('Запись успешно добавлена!');</script>";
    }
}
?>

<!--   -->
<title>БД Картины | Добавление художника</title>
<?php
include 'navbar_add.php';
?>

<h1 style="text-align:center;">Добавить информацию о художнике</h1>
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
            <label>Имя</label> <br>
            <input type="text" name="Artist_Name" required placeholder="Васнецов Виктор Михайлович" />
        </div>

        <div class="form-element">
            <label>Дата рождения</label> <br>
            <input type="text" name="Birthday" id="birthdayInput" required placeholder="дд-мм-гггг" />
            <span class="error-message" id="birthdayError" style="color: red;"></span>
        </div>


        <div class="form-element">
            <label>Страна</label> <br>
            <input type="text" name="Country" required />
        </div>
HTML;



    echo <<<HTML
        <button type="submit" name="add_record" value="">Добавить</button>
    </div>
</form>
HTML;



}

?>

<script>
    document.getElementById('birthdayInput').addEventListener('blur', function () {
        const regex = /^\d{2}-\d{2}-\d{4}$/;
        const errorElem = document.getElementById('birthdayError');
        if (!regex.test(this.value)) {
            errorElem.textContent = 'Формат даты должен быть дд-мм-гггг';
        } else {
            errorElem.textContent = ''; // очистить сообщение об ошибке, если формат верный
        }
    });
</script>

<footer class="footer">© 2023 Михальченко Дмитрий ИВТ-Б20 ИАТЭ НИЯУ МИФИ</footer>