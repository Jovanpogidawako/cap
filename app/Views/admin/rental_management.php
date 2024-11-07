<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* General body styling */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
            color: #333;
        }

        /* Container for central layout */
        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        /* Main heading */
        h1 {
            color: #2c3e50;
            margin-bottom: 30px;
            font-size: 2.5rem;
            text-align: center;
        }

        /* Calendar section */
        #calendar {
            margin: 20px 0;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Modal content */
        .modal-content {
            background-color: #fff;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
            position: relative;
            max-width: 500px;
            max-height: 80vh;
            overflow-y: auto;
            margin: auto;
        }

        /* Close button for modal */
        .close {
            cursor: pointer;
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 25px;
            color: #888;
            transition: color 0.3s;
        }

        .close:hover {
            color: #e74c3c;
        }

        /* Modal background */
        #updateModal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            padding: 40px;
        }

        /* Button styling */
        button {
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-right: 10px;
            padding: 10px 15px;
        }

        /* Specific style for the update button */
        button[type="submit"] {
            background-color: green;
        }

        button[type="submit"]:hover {
            background-color: darkgreen;
        }

        /* Input field styling */
        input[type="text"], input[type="date"], input[type="time"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 1rem;
            box-sizing: border-box;
        }

        input[type="text"]:focus, input[type="date"]:focus, input[type="time"]:focus {
            border-color: #3498db;
            outline: none;
        }

        /* Responsive layout */
        @media (max-width: 768px) {
            .container {
                width: 95%;
                padding: 20px;
            }

            h1 {
                font-size: 2rem;
            }

            .modal-content {
                width: 90%;
                padding: 20px;
            }
        }

        .fc-scrollgrid {
            border: 1px solid #dde2e7 !important;
        }

        .fc-scrollgrid-section > * {
            border: 1px solid #dde2e7 !important;
        }

        .fc-daygrid-day {
            background-color: #ffffff !important;
            border: 1px solid #dde2e7 !important;
            margin: 0 !important;
            transition: background-color 0.2s;
        }

        .fc-daygrid-day:hover {
            background-color: #f8f9fa !important;
        }

        .fc-daygrid-day-frame {
            padding: 8px !important;
            min-height: 100px !important;
        }

        .fc-col-header-cell {
            background-color: #f8f9fa !important;
            border: 1px solid #dde2e7 !important;
            padding: 10px !important;
            font-weight: bold !important;
        }

        .fc-day-today {
            background-color: #fff3cd !important;
        }

        .fc-event {
            margin: 2px 0 !important;
            padding: 4px 6px !important;
            border-radius: 4px !important;
            border: none !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1) !important;
        }

        /* Enhanced header styles */
        .fc-toolbar {
            margin-bottom: 1.5em !important;
            background-color: #f8f9fa !important;
            border: 1px solid #dde2e7 !important;
            border-radius: 8px !important;
            padding: 15px !important;
        }

        .fc-toolbar-title {
            font-size: 1.5em !important;
            font-weight: bold !important;
            color: #2c3e50 !important;
        }

        /* Weekend day styling */
        .fc-day-sat, .fc-day-sun {
            background-color: #fafbfc !important;
        }

        /* Month/week number cells */
        .fc-daygrid-day-number {
            padding: 4px 8px !important;
            color: #495057 !important;
            font-weight: 500 !important;
        }

        /* Event content */
        .fc-event-title {
            font-weight: 500 !important;
            padding: 2px 4px !important;
        }

        .fc-event-time {
            font-size: 0.9em !important;
            opacity: 0.9 !important;
        }

        /* Empty cell hover effect */
        .fc-daygrid-day:not(.fc-day-other):hover {
            background-color: #f0f4f8 !important;
            cursor: pointer;
        }

        .fc-daygrid-day:hover {
            background-color: #dfe6e9;
        }

        /* Enhanced styles for the rental info modal */
        #rentalInfoModal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .rental-info-content {
            background-color: #ffffff;
            margin: 10% auto;
            padding: 30px;
            border: 1px solid #e0e0e0;
            width: 90%;
            max-width: 500px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .rental-info-close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .rental-info-close:hover,
        .rental-info-close:focus {
            color: #2c3e50;
            text-decoration: none;
            cursor: pointer;
        }

        #rentalInfoTitle {
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 1.8rem;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }

        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .info-item i {
            font-size: 1.2rem;
            margin-right: 10px;
            color: #3498db;
            width: 25px;
            text-align: center;
        }

        .info-item span {
            font-size: 1rem;
            color: #34495e;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.9rem;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .status-completed { background-color: #2ecc71; color: white; }
        .status-ongoing { background-color: #3498db; color: white; }
        .status-upcoming { background-color: #f1c40f; color: #2c3e50; }
        <style>
    /* Style for Accept and Decline buttons */
    .action-buttons {
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
    }
    .accept-button {
        background-color: #28a745;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .accept-button:hover {
        background-color: #218838;
    }
    .decline-button {
        background-color: #dc3545;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .decline-button:hover {
        background-color: #c82333;
    } #phoneMapModal {
            display: none;
            position: fixed;
            z-index: 1001;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
        }

        .phone-map-content {
            background-color: #fff;
            padding: 30px;
            border-radius: 15px;
            width: 90%;
            max-width: 700px;
            position: relative;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }

        #map {
            width: 100%;
            height: 400px;
            border-radius: 10px;
            margin-top: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        #phoneDisplay {
            font-size: 1.2rem;
            margin-bottom: 15px;
            color: #2c3e50;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Rental Management Calendar</h1>
        <div id="calendar"></div>
    </div>

    <!-- Enhanced Rental Info Modal -->
    <div id="rentalInfoModal">
        <div class="rental-info-content">
            <span class="rental-info-close">&times;</span>
            <h2 id="rentalInfoTitle"></h2>
            <div id="rentalInfoContent"></div>
            <div class="action-buttons">
                <button class="action-button accept-button" onclick="acceptRental()">Accept</button>
                <button class="action-button decline-button" onclick="declineRental()">Decline</button>
            </div>
        </div>
    </div>

    <!-- Phone Map Modal -->
    <div id="phoneMapModal" class="modal">
        <div class="phone-map-content">
            <span class="close phone-map-close">&times;</span>
            <h2>Locate Phone Number</h2>
            <p id="phoneDisplay"></p>
            <div id="map"></div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        let currentRentalId;
        let calendar;

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            calendar = new FullCalendar.Calendar(calendarEl, {
                // ... other calendar options ...
                events: <?= json_encode(array_map(function($rental) {
                    return [
                        'id' => $rental['RentalID'],
                        'title' => $rental['Name'],
                        'start' => "{$rental['StartDate']}T{$rental['StartTime']}",
                        'end' => "{$rental['EndDate']}T{$rental['EndTime']}",
                        'extendedProps' => [
                            'firstLocation' => $rental['FirstLocation'],
                            'secondLocation' => $rental['SecondLocation'],
                            'phone' => $rental['Phone'],
                            'status' => $rental['Status'],
                            'approvalStatus' => $rental['approval_status'],
                            'startTime' => $rental['StartTime'],
                            'price' => $rental['price'],
                            'endTime' => $rental['EndTime'],
                            'validIdImage' => $rental['valid_id_image']
                        ]
                    ];
                }, $rentals)); ?>,
                eventDidMount: function(info) {
                    // Set the background color based on the status
                    info.el.style.backgroundColor = getStatusColor(info.event.extendedProps.status);
                },
                eventClick: function(info) {
                    showRentalInfo(info.event);
                },
                // ... other calendar options ...
            });
            calendar.render();
        });

        function getStatusColor(status) {
            switch (status.toLowerCase()) {
                case 'completed':
                    return '#28a745'; // Green
                case 'ongoing':
                    return '#007bff'; // Blue
                case 'upcoming':
                    return '#ffc107'; // Yellow
                case 'pending':
                    return '#6c757d'; // Grey
                default:
                    return '#6c757d'; // Default to Grey
            }
        }

        function showRentalInfo(event) {
            currentRentalId = event.id;
            var modal = document.getElementById('rentalInfoModal');
            var title = document.getElementById('rentalInfoTitle');
            var content = document.getElementById('rentalInfoContent');

            title.textContent = event.title;
            var statusColor = getStatusColor(event.extendedProps.status);
            var statusClass = 'status-' + event.extendedProps.status.toLowerCase();
            content.innerHTML = `
                <div class="status-badge ${statusClass}" style="background-color: ${statusColor}">${event.extendedProps.status}</div>
                <div class="info-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span><strong>From:</strong> ${event.extendedProps.firstLocation}</span>
                </div>
                <div class="info-item">
                    <i class="fas fa-map-pin"></i>
                    <span><strong>To:</strong> ${event.extendedProps.secondLocation}</span>
                </div>
                <div class="info-item">
                    <i class="fas fa-phone"></i>
                    <span>${event.extendedProps.phone}</span>
                </div>
                <div class="info-item">
                    <i class="fas fa-calendar-alt"></i>
                    <span><strong>Start:</strong> ${event.start.toLocaleString()}</span>
                </div>
                <div class="info-item">
                    <i class="fas fa-calendar-check"></i>
                    <span><strong>End:</strong> ${event.end ? event.end.toLocaleString() : 'N/A'}</span>
                </div>
                <div class="info-item">
                    <i class="fas fa-dollar-sign"></i>
                    <span><strong>Price:</strong> $${event.extendedProps.price}</span>
                </div>
            `;

            // Add valid ID image if available
            if (event.extendedProps.validIdImage) {
                content.innerHTML += `
                    <div class="info-item">
                        <i class="fas fa-id-card"></i>
                        <span><strong>Valid ID:</strong></span>
                    </div>
                    <img src="<?= base_url('uploads/valid_ids/') ?>${event.extendedProps.validIdImage}" alt="Valid ID" class="valid-id-image">
                `;
            }

            modal.style.display = 'block';
        }
function acceptRental() {
    if (!currentRentalId) return;

    fetch(`/rent/accept-rental/${currentRentalId}`, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Content-Type': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert("Rental request accepted.");
            var event = calendar.getEventById(currentRentalId);
            if (event) {
                event.setExtendedProp('approvalStatus', 'approved');
                // Update the color based on the current status
                event.setProp('backgroundColor', getStatusColor(event.extendedProps.status));
            }
        } else {
            alert("Failed to accept rental: " + data.message);
        }
        document.getElementById('rentalInfoModal').style.display = 'none';
    })
    .catch(error => {
        console.error('Error:', error);
        alert("An error occurred while processing your request.");
    });
}


        function declineRental() {
            if (!currentRentalId) return;

            fetch(`/rent/decline-rental/${currentRentalId}`, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert("Rental request declined.");
                    var event = calendar.getEventById(currentRentalId);
                    if (event) {
                        event.setProp('backgroundColor', '#dc3545'); // Red for declined
                        event.setExtendedProp('status', 'declined');
                    }
                } else {
                    alert("Failed to decline rental: " + data.message);
                }
                document.getElementById('rentalInfoModal').style.display = 'none';
            })
            .catch(error => {
                console.error('Error:', error);
                alert("An error occurred while processing your request.");
            });
        }

        function showPhoneMap(phoneNumber) {
            if (!phoneNumber.startsWith("+63") && !phoneNumber.startsWith("09")) {
                alert("Phone number is not from the Philippines. Please enter a number starting with +63 or 09.");
                return;
            }

            document.getElementById('phoneDisplay').textContent = 'Phone: ' + phoneNumber;
            document.getElementById('phoneMapModal').style.display = 'flex';

            var lat = 14.5995 + (Math.random() - 0.5) * 2;
            var lng = 120.9842 + (Math.random() - 0.5) * 2;

            var map = L.map('map').setView([lat, lng], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            var marker = L.marker([lat, lng]).addTo(map);
            marker.bindPopup(`<b>Phone Number:</b> ${phoneNumber}<br>Simulated Location`).openPopup();
        }

        document.querySelectorAll('.close').forEach(btn => {
            btn.onclick = function() {
                this.closest('.modal').style.display = 'none';
            }
        });

        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.style.display = 'none';
            }
        }
    </script>
</body>
<?= $this->endSection() ?>