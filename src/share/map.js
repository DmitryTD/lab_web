ymaps.ready(init);
function init(){ 
    var myMap = new ymaps.Map("map", {
        center: [55.137306, 36.606740], // Координаты центра карты (Москва)
        zoom: 16 // Уровень масштабирования
    }); 

    myMap.geoObjects.add(new ymaps.Placemark([55.137306, 36.606740], {
        balloonContent: 'Обнинский институт атомной энергетики НИЯУ МИФИ'
    }));
}
