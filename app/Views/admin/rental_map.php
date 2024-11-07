<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rental Mapping</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map {
            height: 500px; /* Set the height of the map */
            width: 100%;   /* Set the width of the map */
        }
    </style>
</head>
<body>
    <h1>Rental Mapping</h1>

    <div id="map"></div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // Initialize the map
        const map = L.map('map').setView([13.736717, 100.523186], 10); // Set the initial center coordinates and zoom level

        // Add OpenStreetMap tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Rental data from the PHP variable
        const rentalData = <?= json_encode($rental_data); ?>; // Pass PHP data to JavaScript

        // Loop through the rental data to place markers on the map
        rentalData.forEach(function(rental) {
            // Assuming you have latitude and longitude in your data
            const lat = parseFloat(rental.FirstLocationLat); // Replace with the actual latitude field
            const lng = parseFloat(rental.FirstLocationLng); // Replace with the actual longitude field

            const marker = L.marker([lat, lng]).addTo(map)
                .bindPopup(`<b>${rental.Name}</b><br>${rental.Phone}`)
                .openPopup(); // Optional: Opens the popup immediately
        });
    </script>
</body>
</html>
