<?php
include 'share/functions.php';
include 'share/functions_XML.php';
?>
<meta charset="UTF-8" />
<!--   -->
<title>БД Картины | XML</title>
<?php
include 'share/navbar.php';
?>

<h1 style="text-align:center;">Последние добавленные картины</h1>

<input type="text" id="search" onkeyup="searchTable()" placeholder="Поиск по таблице..">
<script>
function searchTable() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("search");
  filter = input.value.toUpperCase();
  table = document.getElementById("XML_table");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td");
    for (j = 0; j < td.length; j++) {
      if (td[j]) {
        txtValue = td[j].textContent || td[j].innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          break;
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  }
}
</script>

<?php
show_query();
?>

<footer class="footer">© 2023 Михальченко Дмитрий ИВТ-Б20 ИАТЭ НИЯУ МИФИ</footer>