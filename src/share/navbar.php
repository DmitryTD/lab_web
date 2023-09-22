<!-- Подключаем основной стиль  -->
<link rel="stylesheet" href="share/main.css">
<?php
echo <<<HTML
<header class="header">База данных "Картины"</header>
<div class="navbar">
    <a href="index.php">Главная страница</a>
    <a href="XML.php">XML</a>
    <a href="RSS.php">RSS</a>
    <a href="partners.php">Партнёры</a>
    <a href="API.php">API</a>
    <a href="about_us.php">О нас</a>

    <div class="dropdown">
        <button class="dropbtn"> Сервисы
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <a href="widgets.php">Виджеты</a>
            <a href="weather.php">Погода</a>
            <a href="converter.php">Конвертер валют</a>
            <a href="map.php">Карта</a>
        </div>
    </div>

    <div class="dropdown">
        <button class="dropbtn"> База данных
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <a href="about.php">О БД</a>
            <a href="addpainting.php">Добавление данных</a>
            <a href="search.php">Поиск картин по веку и технике</a>
            <a href="statistics.php">Статистика</a>
        </div>
    </div>

HTML;

print_reg_auth();

echo "</div>";
?>


<!-- Форма поиска -->
<div class="ya-site-form ya-site-form_inited_no" data-bem="{&quot;action&quot;:&quot;https://yandex.ru/search/site/&quot;,&quot;arrow&quot;:false,&quot;bg&quot;:&quot;#cc6600&quot;,&quot;fontsize&quot;:14,&quot;fg&quot;:&quot;#000000&quot;,&quot;language&quot;:&quot;ru&quot;,&quot;logo&quot;:&quot;rb&quot;,&quot;publicname&quot;:&quot;поиск по g930720y.beget.tech&quot;,&quot;suggest&quot;:true,&quot;target&quot;:&quot;_blank&quot;,&quot;tld&quot;:&quot;ru&quot;,&quot;type&quot;:2,&quot;usebigdictionary&quot;:true,&quot;searchid&quot;:3440397,&quot;input_fg&quot;:&quot;#000000&quot;,&quot;input_bg&quot;:&quot;#ffffff&quot;,&quot;input_fontStyle&quot;:&quot;normal&quot;,&quot;input_fontWeight&quot;:&quot;normal&quot;,&quot;input_placeholder&quot;:&quot;Поиск по сайту&quot;,&quot;input_placeholderColor&quot;:&quot;#000000&quot;,&quot;input_borderColor&quot;:&quot;#cc0000&quot;}">
    <form action="https://yandex.ru/search/site/" method="get" target="_blank" accept-charset="utf-8"><input type="hidden" name="searchid" value="3440397" /><input type="hidden" name="l10n" value="ru" /><input type="hidden" name="reqenc" value="" /><input type="search" name="text" value="" /><input type="submit" value="Найти" /></form>
</div>
<style type="text/css">
    .ya-page_js_yes .ya-site-form_inited_no {
        display: none;
    }
</style>
<script type="text/javascript">
    (function(w, d, c) {
        var s = d.createElement('script'),
            h = d.getElementsByTagName('script')[0],
            e = d.documentElement;
        if ((' ' + e.className + ' ').indexOf(' ya-page_js_yes ') === -1) {
            e.className += ' ya-page_js_yes';
        }
        s.type = 'text/javascript';
        s.async = true;
        s.charset = 'utf-8';
        s.src = (d.location.protocol === 'https:' ? 'https:' : 'http:') + '//site.yandex.net/v2.0/js/all.js';
        h.parentNode.insertBefore(s, h);
        (w[c] || (w[c] = [])).push(function() {
            Ya.Site.Form.init()
        })
    })(window, document, 'yandex_site_callbacks');
</script>