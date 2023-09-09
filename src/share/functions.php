<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session'));
session_start();
/*
https://www.internet-technologies.ru/articles/sozdanie-form-registracii-i-avtorizacii-na-php.html
https://phpabstract.ru/php/19
*/
// Подключение к базе данных
function db_connect()
{
    $USER = 'root';
    $PASSWORD = '';
    $HOST = 'localhost';
    $DATABASE = 'web_site';

    try {
        $conn = new PDO("mysql:host=" . $HOST . ";dbname=" . $DATABASE, $USER, $PASSWORD);
    } catch (PDOException $e) {
        exit("Error: " . $e->getMessage());
    }
    return $conn;
}

// Закрытие соединения с базой данных
function db_close_connection($conn)
{
    $conn = NULL;
}


// Регистрация пользователя
function register()
{
    $conn = db_connect();

    // Проверка регистрации
    // Работа с таблицей Users
    // Получение данных из формы
    $username = $_POST['username'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    // Сама проверка
    $query = $conn->prepare("SELECT * FROM Users WHERE login=:login");
    $query->bindParam("login", $login, PDO::PARAM_STR);
    $query->execute();
    if ($query->rowCount() > 0) {
        echo '<script language="javascript">';
        echo 'alert("Этот пользователь уже зарегестрирован")';
        echo '</script>';
        db_close_connection($conn);
    }
    // Если пользователь не зарегестрирован, добавляем запись о нем в бд
    if ($query->rowCount() == 0) {
        $query = $conn->prepare("INSERT INTO Users(Name,password,login) VALUES (:username,:password,:login)");
        $query->bindParam("username", $username, PDO::PARAM_STR);
        $query->bindParam("password", $password, PDO::PARAM_STR);
        $query->bindParam("login", $login, PDO::PARAM_STR);
        $result = $query->execute();
        // Проверка успешности операции
        if ($result) {
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo '<script>';
            echo 'window.onload = function() {';
            echo '  Swal.fire("Успешно!", "Регистрация прошла успешно", "success").then(function() {';
            echo '    window.location.href = "oauth.php";';
            echo '  });';
            echo '}';
            echo '</script>';
            db_close_connection($conn);
        } else {
            echo '<script language="javascript">';
            echo 'alert("Неверные данные")';
            echo '</script>';
            db_close_connection($conn);
        }
    }
}

// Вход
function authentication()
{
    $conn = db_connect();
    // Проверка существования пользователя в бд
    // Работа с таблицей Users
    // Получение данных из формы 
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Сама проверка
    $query = $conn->prepare("SELECT * FROM Users WHERE login=:username AND password=:password");
    $query->bindParam("username", $username, PDO::PARAM_STR);
    $query->bindParam("password", $password, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    // Ошибка если запись не найдена
    if (!$result) {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script>';
        echo 'window.onload = function() {';
        echo '  Swal.fire("Ошибка!", "Неверные данные. Проверьте правильность введенных данных или зарегестрируйтесь", "error").then(function() {';
        echo '  });';
        echo '}';
        echo '</script>';
        db_close_connection($conn);
        // Перенаправление на главную страницу, если авторизация успешна
    } else {
        //Открытие сессии (для сохранения имени пользователя)
        // Сохраняем в сессию имя пользователя
        $_SESSION['name'] = $result['Name'];
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script>';
        echo 'window.onload = function() {';
        echo '  Swal.fire("Успешно!", "Авторизация успешно пройдена", "success").then(function() {';
        echo '    window.location.href = "index.php";';
        echo '  });';
        echo '}';
        echo '</script>';
        db_close_connection($conn);
    }
}

// Отображения регистрации и входа в навигационной панели 
// Если пользователь авторизирован, отображается кнопка выхода
// Также обработка кнопки выхода
function print_reg_auth()
{
    // Если нажата кнопка выхода, завершаем сессию
    if (isset($_POST['exit'])) {
        session_destroy();
        header("Refresh:0");
    }


    if (!isset($_SESSION['name'])) {
        echo '<a href="oauth.php" , style=float:right>Вход</a>';
        echo '<a href="reg.php" , style=float:right>Регистрация</a>';
    } else {
        echo '<form id="exit-form" method="post" action="" style="display: none;">';
        echo '<input type="hidden" name="exit" value="exit">';
        echo '</form>';
        echo '<a href="#" onclick="document.getElementById(\'exit-form\').submit();" style="float:right">Выход</a>';

        echo '<a style=float:right>';
        echo $_SESSION['name'];
        echo '</a>';
    }
}
?>