<!DOCTYPE html>
<html>
<head>
    <title>Tree Monitoring - Map Test</title>
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
    </style>
</head>
<body>
    <h1>🌳 Tree Monitoring System - Google Map</h1>
    <div id="map"></div>

    <script>
        function initMap() {
            const location = { lat: 14.5995, lng: 120.9842 };
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 12,
                center: location,
            });
            new google.maps.Marker({
                position: location,
                map: map,
                title: "Sample Tree Location",
            });
        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap" async defer></script>
</body>
</html>
