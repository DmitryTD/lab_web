<?php

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
include '../share/functions.php';

if (!isset($_GET['century']) || empty($_GET['century'])) {
    echo json_encode(["error" => "Parameter 'century' is missing or empty."]);
    exit;
}

$century = $_GET['century'];

try {
    $conn = db_connect();
    $conn->exec("set names utf8");

    $query = "
        SELECT Title, Era, Year_, Full_name, Direction_Name, Organization_Name, Technic_Name
        FROM Paintings 
        LEFT JOIN Artists ON Paintings.Artist_id = Artists.Artist_id 
        LEFT JOIN Technics ON Paintings.Technic_id = Technics.Technic_id
        LEFT JOIN Directions ON Paintings.Direction_id = Directions.Direction_id 
        LEFT JOIN Organizations ON Paintings.Organization_id = Organizations.Organization_id 
        WHERE Paintings.Century = :century
        ORDER BY Paintings.Title ASC
    ";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':century', $century, PDO::PARAM_STR);
    $stmt->execute();

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($data) === 0) {
        echo json_encode(["result" => "None"]);
    } else {
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    
    db_close_connection($conn);

} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}

?>