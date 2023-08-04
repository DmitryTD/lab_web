<link rel="stylesheet" href="share/table_and_search.css">
<link rel="stylesheet" href="share/statistics.css">
<?php
// Здесь представлены функции для работы statistics.php
// Запросы и отображение статистики

function show_statistics()
{
    $conn = db_connect();

    // Запросы и вывод
    // 1 запрос
    $query = $conn->prepare("SELECT COUNT(*) AS val FROM Paintings;");
    $query->execute();

    echo "<p class='statistics'>Количество картин в базе данных: ";
    echo $query->fetchAll(PDO::FETCH_ASSOC)[0]['val'];
    echo "<br>";

    // 2 запрос
    $query = $conn->prepare("SELECT COUNT(*) AS val FROM Artists;");
    $query->execute();

    echo "Количество художников в базе данных: ";
    echo $query->fetchAll(PDO::FETCH_ASSOC)[0]['val'];
    echo "</p>";

    // 3 запрос
    $query = $conn->prepare("SELECT Organizations.Organization_Name AS museum, COUNT(*) AS val 
    FROM Paintings 
    LEFT JOIN Organizations ON Paintings.Organization_id = Organizations.Organization_id 
    GROUP BY Museum 
    ORDER BY Val DESC;");
    $query->execute();

    echo "<table style='margin-top: 0;'>";
    echo "<tr>";
    echo "<th>Музей</th>";
    echo "<th>Количество</th>";
    echo "</tr>";

    echo '<h1 style="text-align:center;">Распределение картин по музеям</h1>';
    foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $row) {
        echo "<tr>";
        echo "<td>" . $row['museum'] . "</td>";
        echo "<td>" . $row['val'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";

    db_close_connection($conn);
}

?>