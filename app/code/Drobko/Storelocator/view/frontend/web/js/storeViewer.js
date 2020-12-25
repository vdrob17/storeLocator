define([
    "jquery",
    'jquery/ui',
    'domReady!'
], function ($) {
    "use strict";

    $.widget('drobko.Storelocator', {
        options: {
        },
        _create: function (element, options) {
            var widgetElement = this.element;
            var widgetOptions = this.options;

            var storeLat = this.options.storeLat;
            var storeLng = this.options.storeLng;
            // get google maps api and initialize map
            $.getScript("https://maps.googleapis.com/maps/api/js?key=" + widgetOptions.apiKey + "&language=en", function () {
                initMap(storeLat, storeLng);
            });

            var map;
            var marker;

            function initMap(lat, lng) {
                map = new google.maps.Map(document.getElementById('map'), {
                    center: new google.maps.LatLng(lat, lng),
                    zoom: 14
                });

                marker = new google.maps.Marker({
                    map: map,
                });

                var latLng = {lat: lat, lng: lng };

                map.setCenter(latLng);
                marker.setPosition(latLng);
            }
        }
    });

    return $.drobko.Storelocator;
});
