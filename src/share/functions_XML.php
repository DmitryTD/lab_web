<link rel="stylesheet" href="share/table_and_search.css">
<?php
// Здесь представлены функции для работы XML.php
// Генерация XML файла
function createXmlFromQueryResult($rows) {
    $filePath = "./XML/paintings.xml";
    // Создание нового документа XML
    $xmlDoc = new DOMDocument('1.0', 'UTF-8');
    $xmlDoc->formatOutput = true;

    // Создание корневого элемента
    $root = $xmlDoc->createElement('paintings');
    $xmlDoc->appendChild($root);

    foreach ($rows as $row) {
        // Создание элемента 'painting' для каждой записи
        $painting = $xmlDoc->createElement('painting');

        foreach ($row as $key => $value) {
            // Создание элемента для каждого поля
            $field = $xmlDoc->createElement($key, htmlspecialchars($value));
            $painting->appendChild($field);
        }

        // Добавление элемента 'painting' в корневой элемент
        $root->appendChild($painting);
    }

    // Сохранение XML-документа
    $xmlDoc->save($filePath);
}


// Вывод данных
function show_query()
{
    $conn = db_connect();

    // Сам запрос
    $query = $conn->prepare("SELECT Title, Era, Year_, Full_name, Direction_Name, Organization_Name 
    FROM (
        SELECT Title, Era, Year_, Full_name, Direction_Name, Organization_Name, Paintings.id
        FROM Paintings 
        LEFT JOIN Artists ON Paintings.Artist_id = Artists.Artist_id 
        LEFT JOIN Directions ON Paintings.Direction_id = Directions.Direction_id 
        LEFT JOIN Organizations ON Paintings.Organization_id = Organizations.Organization_id 
        ORDER BY Paintings.id DESC
        LIMIT 15
    ) AS Last15 
    ORDER BY Title ASC;");

    $query->execute();

    db_close_connection($conn);

    // Сохраняем результат в массив
    $rows = $query->fetchAll(PDO::FETCH_ASSOC);

    echo '<div style="margin-left: 10%; margin-bottom: 0;"><a href="./XML/paintings.xml" target="_blank">Посмотреть XML-файл</a></div>'; 

    // Вывод данных в таблицу
    echo "<table class=\"table\" style='margin-top: 0;'>";
    echo "<tr>";
    echo "<th>Название</th>";
    echo "<th>Эпоха</th>";
    echo "<th>Год</th>";
    echo "<th>Художник</th>";
    echo "<th>Направление</th>";
    echo "<th>Музей</th>";
    echo "</tr>";

    foreach ($rows as $row) {
        echo "<tr>";
        echo "<td>" . $row['Title'] . "</td>";
        echo "<td>" . $row['Era'] . "</td>";
        echo "<td>" . $row['Year_'] . "</td>";
        echo "<td>" . $row['Full_name'] . "</td>";
        echo "<td>" . $row['Direction_Name'] . "</td>";
        echo "<td>" . $row['Organization_Name'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";

    createXmlFromQueryResult($rows);
}
?>