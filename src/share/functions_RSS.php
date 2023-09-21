<link rel="stylesheet" href="share/RSS_and_add.css">
<?php
/*
Здесь представлены функции для работы с RSS лентой
*/

// Добавление новости
function add_news()
{
    $conn = db_connect();
    // Берем данные из формы на сайте
    $title = $_POST['Title'];
    $source = $_POST['Source'] ?: NULL; // Если пусто присваиваем NULL
    $text = $_POST['Text'];

    $author = $_SESSION["name"];
    $date = date('d.m.Y H:i:s');

    // Если загружен файл, переносим его в директорию и сохраняем путь
    if (is_uploaded_file($_FILES['Media']['tmp_name'])) {
        // Проверяем файл на соответсвие формату
        $allowed_mime_types = ['image/jpeg', 'image/png', 'image/gif', 'audio/mpeg'];
        $mime_type = mime_content_type($_FILES['Media']['tmp_name']);
        if (!in_array($mime_type, $allowed_mime_types)) {
            die('Недопустимый тип файла: ' . $mime_type);
        }

        $media = "./RSS/media/" . basename($_FILES['Media']['name']);
        move_uploaded_file($_FILES['Media']['tmp_name'], $media);
    } else {
        $media = NULL;
    }

    // Запрос на добавление записи
    $query = $conn->prepare("INSERT INTO RSS(Title,Author,Source,Date,Text,Media) VALUES (:title,:author,:source,:date,:text,:media)");
    $query->bindParam("title", $title, PDO::PARAM_STR);
    $query->bindParam("author", $author, PDO::PARAM_STR);
    $query->bindParam("source", $source, PDO::PARAM_STR);
    $query->bindParam("date", $date, PDO::PARAM_STR);
    $query->bindParam("text", $text, PDO::PARAM_STR);
    $query->bindParam("media", $media, PDO::PARAM_STR);
    $result = $query->execute();
    // Обрабатываем результат
    if ($result) {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script>';
        echo 'window.onload = function() {';
        echo '  Swal.fire("Успешно!", "Новость добавлена", "success").then(function() {';
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

// Генерация xml файла
function generate_xml()
{
    $conn = db_connect();
    // Выбрать данные из таблицы
    $sql = "SELECT * FROM RSS ORDER BY Date DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Создать новый документ XML
    $dom = new DOMDocument('1.0', 'UTF-8');
    $rss = $dom->createElement('rss');
    $rssNode = $dom->appendChild($rss);
    $rssNode->setAttribute('version', '2.0');
    $channel = $dom->createElement('channel');
    $channelNode = $rssNode->appendChild($channel);

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $item = $dom->createElement('item');

        $title = $dom->createElement('title', $row['Title']);
        $item->appendChild($title);

        $author = $dom->createElement('author', $row['Author']);
        $item->appendChild($author);

        if (!empty($row['Source'])) {
            $source = $dom->createElement('source', $row['Source']);
            $item->appendChild($source);
        }

        $date = $dom->createElement('pubDate', $row['Date']);
        $item->appendChild($date);

        if (!empty($row['Media'])) {
            $description = $dom->createElement('media');
            // Получим расширение файла
            $file_extension = pathinfo($row['Media'], PATHINFO_EXTENSION);

            if ($file_extension == 'mp3') {
                // Если это аудиофайл, создаём аудиоплеер
                $cdata = $dom->createCDATASection('<audio controls><source src="' . $row['Media'] . '" type="audio/mpeg">Ваш браузер не поддерживает аудио элемент.</audio>');
            } else {
                // В противном случае, считаем, что это изображение
                $cdata = $dom->createCDATASection('<img width=450px src="' . $row['Media'] . '" />');
            }
            $description->appendChild($cdata);
            $item->appendChild($description);
        }

        $text = $dom->createElement('description', $row['Text']);
        $item->appendChild($text);

        $channelNode->appendChild($item);
    }

    // Сохранить RSS ленту в файл
    $dom->save('./RSS/rss.xml');
    db_close_connection($conn);
}

// Отображаем ленту на сайте
function displayRSS()
{
    $rss = simplexml_load_file('./RSS/rss.xml');

    echo "<div class='RSS'>";
    echo "<h1 style='text-align: center;'> Новости проекта </h1>";
    foreach ($rss->channel->item as $item) {
        echo "<div class='item'>";
        echo "<h1>" . $item->title . "</h1>";
        echo "<p>" . $item->media . "</p>";
        echo "<p>" . $item->description . "</p>";
        echo "<p>Автор: " . $item->author . "</p>";
        if ((string)$item->source !== '') {
            echo "<p>Источник: " . $item->source . "</p>";
        }
        echo "<p>Новость от " . $item->pubDate . "</p>";
        echo "</div>";
    }
    echo "</div>";
}

// Для получения новостей из другой RSS ленты
// По итогу не используется, но оставил на всякий случай
// UPD: Все же пришлось доработать и использовать :)
function getFeeds()
{
    $conn = db_connect();

    // Выполните SQL-запрос для выборки данных из таблицы
    $query = $conn->query("SELECT * FROM extern_RSS LIMIT 1");

    // Проверьте, есть ли записи
    if ($query->rowCount() > 0) {
        $row = $query->fetch(PDO::FETCH_ASSOC);
        $RSS_Name = $row['name'];
        $url = $row['URL'];

        $content = file_get_contents($url);
        $items = new SimpleXmlElement($content);

        echo "<div class='RSS'>";
        echo "<h1 style='text-align: center;'>" . $RSS_Name . "</h1>";
        $count = 0;

        // Массив исключений
        $exclusions = ['guid'];
        foreach ($items->channel->item as $item) {
            if ($count >= 10) {
                break;
            }

            echo "<div class='item'>";

            foreach ($item as $key => $value) {
                if (in_array($key, $exclusions)) {
                    continue;
                }

                if ($key === 'link') {
                    echo "<p><a href='" . $value . "'>" . $value . "</a></p>";
                } else if ($key === 'title') {
                    echo "<h1>" . $value . "</h1>";
                } else {
                    echo "<p>" . ucfirst($key) . ": " . $value . "</p>";
                }
            }

            echo "</div>";

            $count++;
        }

        echo "</div>";
    }

    db_close_connection($conn);
}



function add_RSS()
{
    $conn = db_connect();
    // Берем данные из формы на сайте
    $RSS_Name = $_POST['RSS_Name'];
    $RSS_URL = $_POST['RSS_URL'];

    // Удаляем все записи в таблице
    $conn->exec("DELETE FROM extern_RSS");

    // Запрос на добавление записи
    $query = $conn->prepare("INSERT INTO extern_RSS(name,URL) VALUES (:RSS_Name,:RSS_URL)");
    $query->bindParam("RSS_Name", $RSS_Name, PDO::PARAM_STR);
    $query->bindParam("RSS_URL", $RSS_URL, PDO::PARAM_STR);

    $result = $query->execute();
    // Обрабатываем результат
    if ($result) {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script>';
        echo 'window.onload = function() {';
        echo '  Swal.fire("Успешно!", "Лента добавлена", "success").then(function() {';
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

?>