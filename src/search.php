<?php
include 'share/functions.php';
include 'share/functions_addpainting_and_search.php';
?>
<meta charset="UTF-8" />
<!--   -->
<title>БД Картины | Поиск</title>
<link rel="stylesheet" href="share/RSS_and_add.css">
<link rel="stylesheet" href="share/table_and_search.css">

<?php
include 'share/navbar.php';
?>

<h1 style="text-align:center;">Поиск по веку и технике</h1>
<br>
<?php
// предоставляем форму для поиска
//
$temp_query = "SELECT DISTINCT Century FROM Paintings ORDER BY Century ASC;";
$century = get_sql_result($temp_query);
//$temp_query = "SELECT DISTINCT Technic_Name FROM Technics;";
//$technic = get_sql_result($temp_query);
$technic = [];

$form = '<div class="add">';
$form .= create_dropdown('Century', $century, 'Век');
$form .= create_dropdown('Technic_Name', $technic, 'Техника', false);
$form .= '</div>';
echo $form;



?>



<style>
    #yourTableId thead {
        display: none;
    }
</style>


<table id="yourTableId">
    <thead>
        <tr>
            <th>Название</th>
            <th>Эпоха</th>
            <th>Год</th>
            <th>Художник</th>
            <th>Техника</th>
            <th>Музей</th>
        </tr>
    </thead>
    <tbody>
        <!-- Здесь будут выводиться строки с данными -->
    </tbody>
</table>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        async function fetchData(url, data) {
            return $.ajax({
                url: url,
                type: 'post',
                data: data
            });
        }

        $('#Century, #Technic_Name').change(async function () {
            var century = document.getElementById("Century").value;
            var select = document.getElementById("Technic_Name");

            if (this.id == "Century") {
                // Очищаем второй список
                while (select.options.length) {
                    select.options[0] = null;
                }

                var response = await fetchData('share/functions_addpainting_and_search.php', {
                    request: "SELECT DISTINCT Technic_name FROM Technics \
                LEFT JOIN Paintings ON Paintings.Technic_id = Technics.Technic_id \
                WHERE Century = " + century
                });

                var options = JSON.parse(response);
                technic = options[0]['Technic_name'];
                /*
                            // Добавляем "выберите значение"
                            var el = document.createElement("option");
                            el.setAttribute("value", "");
                            el.setAttribute("selected", "selected");
                            el.setAttribute("disabled", "disabled");
                            el.textContent = "Выберите значение";
                            select.appendChild(el);
                */
                // Заполняем второй список
                for (var i = 0; i < options.length; i++) {
                    var opt = options[i]['Technic_name'];
                    var el = document.createElement("option");
                    el.textContent = opt;
                    el.value = opt;
                    select.appendChild(el);
                }
            } else if (this.id == "Technic_Name") {
                // Если выбирается новое значение техники, обновляем переменную technic
                technic = select.value;
            }

            var response2 = await fetchData('share/functions_addpainting_and_search.php', {
                request: "SELECT Title, Era, Year_, Full_name, Technic_Name, Organization_Name \
            FROM Paintings LEFT JOIN Artists ON Paintings.Artist_id = Artists.Artist_id \
            LEFT JOIN Technics ON Paintings.Technic_id = Technics.Technic_id \
            LEFT JOIN Organizations ON Paintings.Organization_id = Organizations.Organization_id \
            WHERE Century = " + century + " AND Technic_Name = \"" + technic + "\""
            });

            var rows = JSON.parse(response2);
            var table = document.getElementById("yourTableId").getElementsByTagName('tbody')[0];
            table.innerHTML = "";
            console.log(technic);
            for (var i = 0; i < rows.length; i++) {
                if (i === 0) {
                    document.getElementById("yourTableId").getElementsByTagName('thead')[0].style.display = "table-header-group";
                }
                var row = table.insertRow(-1);
                row.insertCell(0).innerHTML = rows[i]['Title'];
                row.insertCell(1).innerHTML = rows[i]['Era'];
                row.insertCell(2).innerHTML = rows[i]['Year_'];
                row.insertCell(3).innerHTML = rows[i]['Full_name'];
                row.insertCell(4).innerHTML = rows[i]['Technic_Name'];
                row.insertCell(5).innerHTML = rows[i]['Organization_Name'];
            }
        });
    });


</script>

<footer class="footer">© 2023 Михальченко Дмитрий ИВТ-Б20 ИАТЭ НИЯУ МИФИ</footer>