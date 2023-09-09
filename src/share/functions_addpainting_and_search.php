<?php

if (isset($_POST['request'])) {
    include 'functions.php';
    $result = get_sql_result($_POST['request']);
    //header('Content-Type: application/json');
    echo json_encode($result);
}

// Просто выполняет передаваемый sql запрос и возвращает  результат
function get_sql_result($request)
{
    $conn = db_connect();
    $query = $conn->prepare($request);
    $query->execute();

    if (!$query) {
        return false;
    }

    db_close_connection($conn);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

// Функция для создания формы с выпадающими списками
// Получает название поля в таблице, список элементов (результат get_sql_result)
// и имя, отображаемое на сайте
function create_dropdown($name, $items, $label, $option = true)
{
    $dropdown = "<div class='form-element'>";
    $dropdown .= "<label>$label</label> <br>";
    $dropdown .= "<select id='$name' name='$name' required>";
    if ($option) {
        //$dropdown .= "<option value='any'>Любой</option>";
        $dropdown .= "<option value='' selected disabled>Выберите значение</option>";
    }

    foreach ($items as $item) {
        $value = $item[$name];
        $dropdown .= "<option value=\"$value\">$value</option>";
    }

    $dropdown .= "</select>";
    $dropdown .= "</div>";

    return $dropdown;
}

// Добавление новой записи в бд
function add_record()
{
    $paintingName = $_POST['PaintingName'];
    $era = $_POST['Era'];
    $century = $_POST['Century'];
    $year = $_POST['Year'];
    $status = $_POST['Status'];
    $artist = $_POST['Full_Name'];
    $technic = $_POST['Technic_Name'];
    $direction = $_POST['Direction_Name'];
    $organization = $_POST['Organization_Name'];

    // Для каждого выпадающего поля получим id из соответствующей таблицы
    $artistId = get_id_from_table('Full_Name', $artist, 'Artists', 'Artist_id');
    $technicId = get_id_from_table('Technic_Name', $technic, 'Technics', 'Technic_id');
    $directionId = get_id_from_table('Direction_Name', $direction, 'Directions', 'Direction_id');
    $organizationId = get_id_from_table('Organization_Name', $organization, 'Organizations', 'Organization_id');

    // Добавление новой записи
    $conn = db_connect();
    $query = $conn->prepare("INSERT INTO Paintings (Title, Era, Century, Year_, Status, Artist_id, Technic_id, Direction_id, Organization_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $query->execute([$paintingName, $era, $century, $year, $status, $artistId, $technicId, $directionId, $organizationId]);

    db_close_connection($conn);
}

// Получение id записи
// Предполагается, что сама запись и id существуют
function get_id_from_table($columnName, $value, $tableName, $id)
{
    $conn = db_connect();
    $query = $conn->prepare("SELECT $id FROM $tableName WHERE $columnName = ?");
    $query->execute([$value]);

    $result = $query->fetch(PDO::FETCH_ASSOC);
    db_close_connection($conn);

    return $result[$id];
}
?>