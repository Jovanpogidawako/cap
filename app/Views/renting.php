
<?= $this->include('layout/header') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

<style>
   body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 0;
}

.container {
    display: flex;
    justify-content: space-between;
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
}

.card {
    flex: 1;
    background-color: #ffffff;
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    margin-top: 90px;
}

h1 {
    font-size: 28px;
    font-weight: bold;
    color: #333;
    margin-bottom: 30px;
    display: flex;
    align-items: center;
}

h1 i {
    margin-right: 10px;
    color: #4CAF50;
}

.form-group {
    margin-bottom: 15px;
    position: relative;
}

.form-group i {
    position: absolute;
    top: 50%;
    left: 15px;
    transform: translateY(-50%);
    color: #888;
    font-size: 16px;
}

input[type="text"],
input[type="email"],
input[type="date"],
input[type="time"] {
    width: 100%;
    padding: 12px 50px;
    border: 1px solid #ddd;
    border-radius: 6px;
    transition: all 0.3s ease;
    font-size: 16px;
    background-color: #fafafa;
}

input[type="text"]:focus,
input[type="email"]:focus,
input[type="date"]:focus,
input[type="time"]:focus {
    outline: none;
    border-color: #4CAF50;
    box-shadow: 0 0 8px rgba(76, 175, 80, 0.5);
}

button[type="submit"] {
    width: 100%;
    padding: 12px 0;
    border: none;
    border-radius: 6px;
    background-color: black;
    color: #fff;
    font-size: 18px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
    background-color: white;
    box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);
}

.map {
    flex: 1;
    margin-left: 20px;
    margin-top: 90px;
    height: 800px;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.map .leaflet-container {
    border-radius: 15px;
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
    animation: fadeIn 0.3s ease;
}

.modal-content {
    background: linear-gradient(145deg, #ffffff, #f8f9fa);
    margin: 10% auto;
    padding: 40px;
    border-radius: 20px;
    max-width: 500px;
    text-align: center;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    animation: slideDown 0.4s ease;
    position: relative;
}

.modal-icon {
    margin-bottom: 25px;
}

.modal-icon i {
    font-size: 70px;
    color: #4CAF50;
    animation: scaleIn 0.5s ease;
}

.modal-header h2 {
    font-size: 32px;
    color: #2c3e50;
    margin: 0 0 10px 0;
    font-weight: 600;
}

.modal-header .subtitle {
    font-size: 18px;
    color: #666;
    margin: 0 0 25px 0;
}

.modal-body {
    padding: 20px 0;
}

.success-message {
    background-color: #f8fff8;
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 25px;
    border: 1px solid #e0f2e0;
}

.success-message p {
    color: #4a4a4a;
    font-size: 16px;
    line-height: 1.6;
    margin: 0;
}

.action-buttons {
    display: flex;
    justify-content: center;
    gap: 15px;
}

.close-btn, .view-btn {
    padding: 12px 25px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 16px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
}

.close-btn {
    background-color: #f8f9fa;
    color: #4a4a4a;
    border: 1px solid #ddd;
}

.view-btn {
    background-color: #4CAF50;
    color: white;
}

.close-btn:hover {
    background-color: #e9ecef;
    transform: translateY(-2px);
}

.view-btn:hover {
    background-color: #45a049;
    transform: translateY(-2px);
}

/* Animations */
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideDown {
    from {
        transform: translateY(-50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

@keyframes scaleIn {
    0% {
        transform: scale(0);
        opacity: 0;
    }
    50% {
        transform: scale(1.2);
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}

/* Mobile Responsiveness */
@media (max-width: 600px) {
    .modal-content {
        margin: 20% auto;
        padding: 25px;
        width: 90%;
    }

    .modal-icon i {
        font-size: 50px;
    }

    .modal-header h2 {
        font-size: 24px;
    }

    .action-buttons {
        flex-direction: column;
    }

    .close-btn, .view-btn {
        width: 100%;
        justify-content: center;
    }
    
}
</style>

<a href="<?= site_url('rental/history') ?>" title="View History">
    <i class="fas fa-history history-icon"></i>
</a>

<div class="container">

    <div class="card">
        <h1>
            <i class="fas fa-car"></i> Car Rental Form
        </h1>
        <form id="rental-form" action="<?= site_url('rental/submit') ?>" method="post">
            <div class="form-group">
                <i class="fas fa-map-marker-alt"></i>
                <input type="text" id="firstlocation" name="firstlocation" placeholder="Enter First Location" value="Nacoco Highway, Calapan City, Oriental Mindoro, National High School" readonly>
            </div>
            <div class="form-group">
                <i class="fas fa-map-marker-alt"></i>
                <input type="text" id="secondlocation" name="secondlocation" placeholder="Enter Second Location">
            </div>
            <div class="form-group">
                <i class="fas fa-user"></i>
                <input type="text" id="name" name="name" placeholder="Your Name" value="<?= esc($user_name) ?>">
            </div>
            <div class="form-group">
                <i class="fas fa-phone"></i>
                <input type="text" id="phone" name="phone" placeholder="Your Phone" value="<?= esc($user_phone) ?>">
            </div>
            <div class="form-group">
                <i class="fas fa-calendar-alt"></i>
                <input type="text" id="start-date" name="start_date" placeholder="Start Date">
            </div>
            <div class="form-group">
                <i class="fas fa-calendar-alt"></i>
                <input type="text" id="end-date" name="end_date" placeholder="End Date">
            </div>
            <div class="form-group">
                <i class="fas fa-clock"></i>
                <input type="text" id="start-time" name="start_time" placeholder="Start Time">
            </div>
            <div class="form-group">
                <i class="fas fa-clock"></i>
                <input type="text" id="end-time" name="end_time" placeholder="End Time">
            </div>
            <div class="form-group">
                <i class="fas fa-dollar-sign"></i>
                <input type="text" id="price" name="price" placeholder="Auto-generated Price" readonly>
            </div>
            <button type="submit"><i class="fas fa-paper-plane"></i> Submit</button>
        </form>
    </div>
    <div class="map" id="map"></div>
</div>

<!-- Confirmation Modal -->
<div id="confirmationModal" class="modal">
    <div class="modal-content">
        <div class="modal-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="modal-header">
            <h2>Booking Confirmed!</h2>
            <p class="subtitle">Your rental request has been successfully submitted.</p>
        </div>
        <div class="modal-body">
            <div class="success-message">
                <p>Thank you for choosing our service! You will receive a confirmation email shortly with your booking details.</p>
            </div>
            <div class="action-buttons">
                <button id="closeModal" class="close-btn">
                    <i class="fas fa-times"></i>
                    Close
                </button>
                <button id="viewBookings" class="view-btn">
                    <i class="fas fa-list"></i>
                    View Bookings
                </button>
            </div>
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
                placeMarker(latlng, 'second');
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
</script>

<?= $this->include('layout/footer') ?>