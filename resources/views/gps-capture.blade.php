<!DOCTYPE html>
<html>
<head>
    <title>GPS Location Capture - Tree Monitoring</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
        }
        .location-box {
            background: #f0f0f0;
            padding: 20px;
            margin: 20px 0;
            border-radius: 10px;
        }
        button {
            background: green;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            margin: 5px;
            border-radius: 5px;
        }
        button:hover {
            background: darkgreen;
        }
        #map {
            height: 400px;
            width: 100%;
            margin-top: 20px;
            border-radius: 10px;
        }
        .info {
            background: white;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>🌳 Tree Monitoring System</h1>
    <h2>📍 GPS Location Capture</h2>

    <div class="location-box">
        <h3>Current Location:</h3>
        <div class="info">
            <p><strong>Latitude:</strong> <span id="lat">-</span></p>
            <p><strong>Longitude:</strong> <span id="lng">-</span></p>
            <p><strong>Accuracy:</strong> <span id="accuracy">-</span> meters</p>
        </div>
        <button onclick="getLocation()">📍 Get My GPS Location</button>
        <button onclick="saveLocation()">💾 Save Tree Location</button>
        <button onclick="addTree()">🌳 Add New Tree</button>
    </div>

    <div id="map"></div>

    <script>
        let currentLat = null;
        let currentLng = null;
        let map = null;
        let marker = null;

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function showPosition(position) {
            currentLat = position.coords.latitude;
            currentLng = position.coords.longitude;

            document.getElementById("lat").innerHTML = currentLat;
            document.getElementById("lng").innerHTML = currentLng;
            document.getElementById("accuracy").innerHTML = position.coords.accuracy;

            // Update map
            if (map) {
                const location = { lat: currentLat, lng: currentLng };
                map.setCenter(location);
                map.setZoom(15);

                if (marker) marker.setMap(null);
                marker = new google.maps.Marker({
                    position: location,
                    map: map,
                    title: "Tree Location",
                });

                // Add info window
                const infoWindow = new google.maps.InfoWindow({
                    content: `<h3>Tree Location</h3><p>Lat: ${currentLat}<br>Lng: ${currentLng}</p>`
                });
                marker.addListener('click', () => {
                    infoWindow.open(map, marker);
                });
            }

            alert("Location captured successfully!");
        }

        function showError(error) {
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    alert("Please allow location access to use this feature.");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Location information unavailable.");
                    break;
                case error.TIMEOUT:
                    alert("Location request timed out.");
                    break;
            }
        }

        function saveLocation() {
            if (currentLat && currentLng) {
                localStorage.setItem('treeLat', currentLat);
                localStorage.setItem('treeLng', currentLng);
                alert(`✅ Tree location saved!\nLatitude: ${currentLat}\nLongitude: ${currentLng}`);
            } else {
                alert("Please get your location first by clicking 'Get My GPS Location'");
            }
        }

        function addTree() {
            const lat = localStorage.getItem('treeLat');
            const lng = localStorage.getItem('treeLng');

            if (lat && lng) {
                const treeName = prompt("Enter tree name:", "Sample Tree");
                const species = prompt("Enter species:", "Narra");

                if (treeName && species) {
                    alert(`✅ Tree Added!\nName: ${treeName}\nSpecies: ${species}\nLocation: ${lat}, ${lng}`);
                    // Here you can send data to server via AJAX
                }
            } else {
                alert("Please capture and save a location first.");
            }
        }

        function initMap() {
            const defaultLocation = { lat: 14.5995, lng: 120.9842 }; // Manila
            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 12,
                center: defaultLocation,
            });
        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap" async defer></script>
</body>
</html>
