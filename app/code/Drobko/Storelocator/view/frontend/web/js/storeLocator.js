define([
    "jquery",
    'jquery/ui',
    'domReady!'
], function ($) {
    "use strict";

    $.widget('drobko.Storelocator', {
        options: {
            'defaultInitLat': 40.730610,
            'defaultInitLng': -73.935242
        },
        _create: function () {
            var widgetElement = this.element;
            var widgetOptions = this.options;

            var map;
            var marker;
            var infowindow;
            var stores = makeHashTableStoresById(widgetOptions.stores);

            function makeHashTableStoresById(stores) {
                return stores.reduce((acc, store) => {
                    return { ...acc, [store.store_id]: store };
                }, {});
            }

            // get google maps api and initialize map
            $.getScript("https://maps.googleapis.com/maps/api/js?key=" + widgetOptions.apiKey + "&language=en", function () {
                initMap(widgetOptions.defaultInitLat, widgetOptions.defaultInitLng);
            });

            function initMap(lat, lng) {

                map = new google.maps.Map(document.getElementById('map'), {
                    center: new google.maps.LatLng(lat, lng),
                    zoom: 12
                });

                marker = new google.maps.Marker({
                    map: map,
                });

                infowindow = new google.maps.InfoWindow({
                    content: ''
                });
            }

            // set store marker of clicked store with info window
            $('.storeCard').click(function () {
                $(".storeCard").removeClass("active");
                $(this).addClass("active");

                var storeId = $(this).attr('data-storeId');
                var storeLatLng = { lat: +stores[storeId].latitude, lng: +stores[storeId].longitude };
                var storeInfo = $(this).find('.storeInfo').html();
                var linkStore = `<a href="${$(this).attr('data-link')}">Read more</a>`;
                storeInfo += `<p>Description:</p><p>${stores[storeId].description} ${linkStore}</p>`;

                infowindow.setContent(storeInfo);
                infowindow.open(map, marker);
                marker.addListener('click', function () {
                    infowindow.open(map, marker);
                });
                map.setCenter(storeLatLng);
                marker.setPosition(storeLatLng);
            });
        }
    });

    return $.drobko.Storelocator;
});
