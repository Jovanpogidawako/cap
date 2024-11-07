<?= $this->include('layout/header') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f0f2f5;
        margin: 0;
        padding: 0;
        color: #333;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .rental-header {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .rental-header h1 {
        font-size: 28px;
        color: #2c3e50;
        margin: 0;
    }

    .rental-content {
        display: flex;
        gap: 20px;
    }

    .car-details {
        flex: 1;
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .car-details img {
        width: 100%;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .car-info {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }

    .car-info p {
        margin: 0;
        padding: 10px;
        background-color: #f8f9fa;
        border-radius: 5px;
        font-size: 14px;
    }

    .rental-form {
        flex: 1;
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: 600;
        color: #2c3e50;
    }

    .form-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
    }

    .form-group input:focus {
        outline: none;
        border-color: #3498db;
        box-shadow: 0 0 5px rgba(52, 152, 219, 0.5);
    }

    button[type="submit"] {
        width: 100%;
        padding: 12px;
        background-color: #3498db;
        color: #ffffff;
        border: none;
        border-radius: 5px;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button[type="submit"]:hover {
        background-color: #2980b9;
    }

    #map {
        height: 400px;
        border-radius: 10px;
        margin-top: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border: 1px solid #e0e0e0;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(5px);
    }

    .modal-content {
        background-color: #ffffff;
        margin: 10% auto;
        padding: 40px;
        border-radius: 15px;
        max-width: 500px;
        text-align: center;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        animation: modalFadeIn 0.3s ease-out;
    }

    @keyframes modalFadeIn {
        from { opacity: 0; transform: translateY(-50px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .modal-icon {
        font-size: 70px;
        color: #2ecc71;
        margin-bottom: 20px;
        animation: iconPop 0.5s ease-out;
    }

    @keyframes iconPop {
        0% { transform: scale(0); }
        70% { transform: scale(1.2); }
        100% { transform: scale(1); }
    }

    .modal-header h2 {
        color: #2c3e50;
        margin-bottom: 10px;
        font-size: 28px;
    }

    .modal-body {
        margin-bottom: 30px;
        color: #34495e;
        font-size: 16px;
        line-height: 1.6;
    }

    .action-buttons {
        display: flex;
        justify-content: center;
        gap: 15px;
    }

    .action-buttons button {
        padding: 12px 25px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .action-buttons button i {
        margin-right: 8px;
    }

    .close-btn {
        background-color: #ecf0f1;
        color: #2c3e50;
    }

    .view-btn {
        background-color: #3498db;
        color: #ffffff;
    }

    .close-btn:hover {
        background-color: #bdc3c7;
        transform: translateY(-2px);
    }

    .view-btn:hover {
        background-color: #2980b9;
        transform: translateY(-2px);
    }

    .history-icon {
        position: fixed;
        top: 20px;
        right: 20px;
        font-size: 24px;
        color: #3498db;
        background-color: #ffffff;
        padding: 10px;
        border-radius: 50%;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .history-icon:hover {
        transform: scale(1.1);
        color: #2980b9;
    }

    @media (max-width: 768px) {
        .rental-content {
            flex-direction: column;
        }

        .car-info {
            grid-template-columns: 1fr;
        }

        .modal-content {
            width: 90%;
            margin: 20% auto;
            padding: 30px;
        }

        .action-buttons {
            flex-direction: column;
        }

        .action-buttons button {
            width: 100%;
        }
    }
</style>
<br>
<br>
<br>
<div class="container">
    <div class="rental-header">
        <h1><i class="fas fa-car"></i> Car Rental</h1>
    </div>

    <div class="rental-content">
        <div class="car-details">
            <h2><?= esc($car['model']) ?></h2>
            <img src="<?= base_url('uploaded_img/' . $car['image']) ?>" alt="<?= esc($car['model']) ?>">
            <div class="car-info">
                <p><i class="fas fa-dollar-sign"></i> Price: ₱<?= number_format($car['price'], 2) ?> / day</p>
                <p><i class="fas fa-gas-pump"></i> Fuel Type: <?= esc($car['fueltype']) ?></p>
                <p><i class="fas fa-cog"></i> Transmission: <?= esc($car['transmission']) ?></p>
                <p><i class="fas fa-road"></i> Mileage: <?= number_format($car['mileage']) ?> km</p>
            </div>
        </div>

        <div class="rental-form">
            <h2>Rental Details</h2>
            <form id="rental-form" action="<?= site_url('rental/submit') ?>" method="post">
            <input type="hidden" name="product_id" value="<?= esc($car['id']) ?>">

                <div class="form-group">
                    <label for="firstlocation"><i class="fas fa-map-marker-alt"></i> First Location</label>
                    <input type="text" id="firstlocation" name="firstlocation" value="Nacoco Highway, Calapan City, Oriental Mindoro, National High School" readonly>
                </div>
                <div class="form-group">
                    <label for="secondlocation"><i class="fas fa-map-marker-alt"></i> Second Location</label>
                    <input type="text" id="secondlocation" name="secondlocation" placeholder="Enter Second Location">
                </div>
                <div class="form-group">
                <i class="fas fa-user"></i>
                <input type="text" id="name" name="name" placeholder="Your Name" value="<?= esc($user_name) ?>">
            </div>
                <div class="form-group">
    <label for="phone"><i class="fas fa-phone"></i> Your Phone</label>
    <input 
        type="text" 
        id="phone" 
        name="phone" 
        placeholder="+63" 
        pattern="^\+639\d{9}$" 
        title="Please enter a valid Philippine mobile number starting with +63 followed by 10 digits" 
        required>
</div>
<div class="form-group">
    <label for="valid_id"><i class="fas fa-id-card"></i> Valid ID</label>
    <input type="file" id="valid_id" name="valid_id" accept="image/*" required>
</div>
 <div class="form-group">
                    <label for="start-date"><i class="fas fa-calendar-alt"></i> Start Date</label>
                    <input type="text" id="start-date" name="start_date" placeholder="Select Start Date">
                </div>
                <div class="form-group">
                    <label for="end-date"><i class="fas fa-calendar-alt"></i> End Date</label>
                    <input type="text" id="end-date" name="end_date" placeholder="Select End Date">
                </div>
                <div class="form-group">
                    <label for="start-time"><i class="fas fa-clock"></i> Start Time</label>
                    <input type="text" id="start-time" name="start_time" placeholder="Select Start Time">
                </div>
                <div class="form-group">
                    <label for="end-time"><i class="fas fa-clock"></i> End Time</label>
                    <input type="text" id="end-time" name="end_time" placeholder="Select End Time">
                </div>
                <div class="form-group">
                    <label for="price"><i class="fas fa-dollar-sign"></i> Total Price</label>
                    <input type="text" id="price" name="price" placeholder="Auto-generated Price" readonly>
                </div>
                <button type="submit"><i class="fas fa-paper-plane"></i> Submit Rental Request</button>
            </form>
        </div>
    </div>

    <div id="map"></div>
</div>

<!-- Confirmation Modal -->
<div id="confirmationModal" class="modal">
    <div class="modal-content">
        <div class="modal-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="modal-header">
            <h2>Booking Confirmed!</h2>
        </div>
        <div class="modal-body">
            <p>Your rental request has been successfully submitted. You will receive a confirmation email shortly with your booking details.</p>
        </div>
        <div class="action-buttons">
            <button id="closeModal" class="close-btn">
                <i class="fas fa-times"></i> Close
            </button>
            <button id="viewBookings" class="view-btn">
                <i class="fas fa-list"></i> View Bookings
            </button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

<script>
    let map;
    let firstMarker, secondMarker;
    let firstLocation = [13.4115, 121.1803]; // Coordinates for Nacoco Highway, Calapan City
    let secondLocation = null;
    let routeControl = null;
    let distanceInKm = 0;
    let ratePerKmPerHour = 10; // Adjust the rate here

    function initMap() {
        map = L.map('map').setView(firstLocation, 14);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        firstMarker = L.marker(firstLocation).addTo(map).bindPopup("Nacoco Highway, Calapan City, Oriental Mindoro, National High School").openPopup();

        L.Control.geocoder().addTo(map);

        map.on('click', function(e) {
            const latlng = e.latlng;

            if (!secondMarker) {
                placeMarker(latlng, 'second');
                reverseGeocode(latlng.lat, latlng.lng, 'second');
            } else {
                map.removeLayer(secondMarker);
                placeMarker(latlng, 
                'second');
                reverseGeocode(latlng.lat, latlng.lng, 'second');
            }

            if (secondLocation) {
                drawRoute(firstLocation, secondLocation);
            }
        });
    }

    function placeMarker(latlng, locationType) {
        if (locationType === 'second') {
            secondMarker = L.marker(latlng).addTo(map).bindPopup("Second Location").openPopup();
            secondLocation = [latlng.lat, latlng.lng];
        }
    }

    function reverseGeocode(lat, lng, locationType) {
        const url = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                if (data && data.address) {
                    const { road, village, city, municipality, state, country } = data.address;
                    const formattedAddress = `${road || village || ''}, ${municipality || city || ''}, ${state || ''}, Philippines`;

                    if (locationType === 'second') {
                        document.getElementById('secondlocation').value = formattedAddress;
                    }
                } else {
                    alert('Address not found.');
                }
            })
            .catch(error => {
                console.error('Error during reverse geocoding:', error);
            });
    }

    function calculateDuration(startDate, startTime, endDate, endTime) {
        const start = new Date(`${startDate}T${startTime}`);
        const end = new Date(`${endDate}T${endTime}`);
        const duration = (end - start) / (1000 * 60 * 60);
        return duration > 0 ? duration : 0;
    }

    function calculatePrice() {
        const startDate = document.getElementById('start-date').value;
        const startTime = document.getElementById('start-time').value;
        const endDate = document.getElementById('end-date').value;
        const endTime = document.getElementById('end-time').value;

        const rentalDuration = calculateDuration(startDate, startTime, endDate, endTime);

        const totalPrice = distanceInKm * rentalDuration * ratePerKmPerHour;

        document.getElementById('price').value = totalPrice.toFixed(2);
    }

    function drawRoute(start, end) {
        if (routeControl) {
            map.removeControl(routeControl);
        }

        routeControl = L.Routing.control({
            waypoints: [
                L.latLng(start[0], start[1]),
                L.latLng(end[0], end[1])
            ],
            routeWhileDragging: true,
            createMarker: function() { return null; }
        })
        .on('routesfound', function(e) {
            const routes = e.routes;
            if (routes.length > 0) {
                distanceInKm = routes[0].summary.totalDistance / 1000;
                calculatePrice();
            }
        })
        .addTo(map);
    }

    flatpickr('#start-date', { dateFormat: "Y-m-d" });
    flatpickr('#end-date', { dateFormat: "Y-m-d" });
    flatpickr('#start-time', { enableTime: true, noCalendar: true, dateFormat: "H:i" });
    flatpickr('#end-time', { enableTime: true, noCalendar: true, dateFormat: "H:i" });

    document.getElementById('start-date').addEventListener('change', calculatePrice);
    document.getElementById('start-time').addEventListener('change', calculatePrice);
    document.getElementById('end-date').addEventListener('change', calculatePrice);
    document.getElementById('end-time').addEventListener('change', calculatePrice);

    window.onload = function() {
        initMap();
    }

    // Form submission and modal handling
    document.getElementById('rental-form').addEventListener('submit', function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        fetch('<?= site_url('rental/submit') ?>', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('confirmationModal').style.display = 'block';
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    });

    document.getElementById('closeModal').addEventListener('click', function() {
        document.getElementById('confirmationModal').style.display = 'none';
    });

    document.getElementById('viewBookings').addEventListener('click', function() {
        window.location.href = '<?= site_url('/historia') ?>';
    });

    // Close modal when clicking outside
    window.addEventListener('click', function(event) {
        const modal = document.getElementById('confirmationModal');
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
    document.getElementById('phone').addEventListener('input', function(e) {
    const input = e.target;

    // Ensure +63 is always prefixed in the input
    if (!input.value.startsWith('+63')) {
        input.value = '+63';
    }

    // Remove any non-numeric characters after +63
    input.value = '+63' + input.value.slice(3).replace(/\D/g, '');

    // Limit the number of digits after +63 to 10
    if (input.value.length > 13) { // +63 + 10 digits = 13 characters
        input.value = input.value.slice(0, 13);
    }
});

</script>

<?= $this->include('layout/footer') ?>