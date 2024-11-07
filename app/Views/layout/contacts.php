<!DOCTYPE html>
<html lang="en">
<head>
<?= $this->include('layout/header') ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us with Map</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .QWEcontainer {
            display: flex;
            max-width: 1200px;
            margin: 20px auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            background-color: #ffffff;
        }
        .map-container {
            flex: 1;
            position: relative;
        }
        #map {
            height: 500px; /* Set the height of the map */
            width: 100%;
        }
        .form-container {
            flex: 1;
            padding: 20px;
        }
        .contact-title {
            color: #333;
        }
        .contact-label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }
        .contact-input,
        .contact-textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px 0;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .contact-button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .contact-button:hover {
            background-color: #0056b3;
        }
        .contact-error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<br>
<br>
<br>

    <div class="QWEcontainer">
        <div class="map-container">
            <h2 class="contact-title">Find Us Here</h2>
            <div id="map"></div>
        </div>
        <div class="form-container">
            <h1 class="contact-title">Contact Us</h1>
            
            <?php if (session()->getFlashdata('success')): ?>
                <p><?= session()->getFlashdata('success') ?></p>
            <?php endif; ?>

            <form action="/contact/submit" method="post">
                <?= csrf_field() ?>
                <label class="contact-label">Name:</label>
                <input type="text" name="name" class="contact-input" value="<?= old('name') ?>">
                <div class="contact-error"><?= \Config\Services::validation()->getError('name') ?></div>
                
                <label class="contact-label">Email:</label>
                <input type="email" name="email" class="contact-input" value="<?= old('email') ?>">
                <div class="contact-error"><?= \Config\Services::validation()->getError('email') ?></div>

                <label class="contact-label">Message:</label>
                <textarea name="message" class="contact-textarea"><?= old('message') ?></textarea>
                <div class="contact-error"><?= \Config\Services::validation()->getError('message') ?></div>

                <button type="submit" class="contact-button">Send Message</button>
            </form>
        </div>
    </div>

    <!-- Leaflet JavaScript library -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        // Initialize the map and set its view to Nacoco Highway, Calapan City with a chosen zoom level
        const map = L.map('map').setView([13.3607, 121.1805], 15);

        // Add OpenStreetMap tiles to the map
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Add a marker at the specified location
        const marker = L.marker([13.4115, 121.1803]).addTo(map);
        marker.bindPopup("<b>Nacoco Highway</b><br>Calapan City, Oriental Mindoro, Philippines").openPopup();
    </script>
</body>
</html>
