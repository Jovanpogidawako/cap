<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?= $this->include('layout/header') ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History - Luxury Car Rentals</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        /* Base Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin: 40px 0 20px;
            font-size: 2em;
            position: relative;
        }

        /* Section Title Styling */
        h2::after {
            content: "";
            display: block;
            width: 60px;
            height: 3px;
            background-color: #4CAF50;
            margin: 10px auto;
            border-radius: 2px;
        }

        /* Card Styles */
        .card {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
        }

        .icon {
            font-size: 1.2em;
            color: #4CAF50;
            margin-right: 10px;
            width: 20px;
        }

        .car-details {
            display: flex;
            flex-direction: column;
            color: #555;
            font-size: 1em;
            width: 100%;
        }

        .detail-item {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
            font-size: 0.95em;
        }

        .price, .status {
            font-weight: bold;
            display: inline-block;
            margin-top: 5px;
        }

        .price {
            color: #4CAF50;
        }

        /* Button Styles */
        .delete-btn {
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 14px;
            cursor: pointer;
            font-size: 0.9em;
            display: inline-flex;
            align-items: center;
            transition: background-color 0.3s ease;
            margin-top: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .delete-btn i {
            margin-right: 5px;
        }

        .delete-btn:hover {
            background-color: #c0392b;
        }

        /* Status Colors */
        .status.success { color: green; }
        .status.primary { color: blue; }
        .status.info { color: orange; }
        .status.secondary { color: grey; }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            .card {
                padding: 15px;
            }

            h2 {
                font-size: 1.8em;
            }
        }
        .status.approved { color: #28a745; }
.status.declined { color: #dc3545; }
.status.pending { color: #ffc107; }
@media (max-width: 480px) {
    .card {
        padding: 12px;
    }
    
    .detail-item {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .icon {
        margin-bottom: 5px;
    }
    
    .delete-btn {
        width: 100%;
        justify-content: center;
    }
}
.card {
    position: relative;
}

.card.loading::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.8);
    display: flex;
    justify-content: center;
    align-items: center;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.card {
    animation: fadeIn 0.3s ease-out;
}
.status {
            font-weight: bold;
        }
        .status.success {
            color: green;
        }
        .status.primary {
            color: blue;
        }
        .status.info {
            color: orange;
        }
        .status.secondary {
            color: grey;
        }
        .price {
            font-weight: bold;
        }
        .valid-id-image {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        /* Add new style for valid ID container */
        .valid-id-container {
            margin-top: 10px;
            text-align: center;
        }

        .valid-id-container a {
            display: inline-block;
            margin-top: 5px;
            color: #4CAF50;
            text-decoration: none;
        }

        .valid-id-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <br>
    <br>
    <br>
    <div class="container">
        <h2>Rental History</h2>
        <?php if (!empty($rentals)): ?>
            <?php foreach ($rentals as $rental): ?>
                <div class="card rental-item">
                    <div class="car-details">
                        <div class="detail-item"><strong>Name:</strong> <?= esc($rental['user_name']) ?></div>
                        <div class="detail-item"><strong>Product Model:</strong> <?= esc($rental['product_model']) ?></div>
                        <div class="detail-item"><strong>First Location:</strong> <?= esc($rental['FirstLocation']) ?></div>
                        <div class="detail-item"><strong>Second Location:</strong> <?= esc($rental['SecondLocation']) ?></div>
                        <div class="detail-item"><strong>Start Date:</strong> <?= esc($rental['StartDate']) ?> <?= esc($rental['StartTime']) ?></div>
                        <div class="detail-item"><strong>End Date:</strong> <?= esc($rental['EndDate']) ?> <?= esc($rental['EndTime']) ?></div>
                        <div class="detail-item"><strong>Price:</strong> PHP <?= esc(number_format((float)$rental['price'], 2)) ?></div>
                        <div class="detail-item"><strong class="status" style="color: <?= esc($rental['statusColor']) ?>">Status: <?= esc($rental['Status']) ?></strong></div>
                        <div class="detail-item"><strong>Approval Status:</strong><span class="status <?= strtolower($rental['approval_status'] ?? 'pending') ?>" data-id="<?= $rental['rental_id'] ?>"><?= ucfirst($rental['approval_status'] ?? 'Pending') ?></span></div>
                        
                        <!-- Add Valid ID display -->
                        <?php if (!empty($rental['valid_id_image'])): ?>
                            <div class="valid-id-container">
                                <strong>Valid ID:</strong>
                                <br>
                                <img src="<?= base_url('uploads/valid_ids/' . $rental['valid_id_image']) ?>" alt="Valid ID" class="valid-id-image">
                                <br>
                                <a href="<?= base_url('uploads/valid_ids/' . $rental['valid_id_image']) ?>" target="_blank">View Full Size</a>
                            </div>
                        <?php endif; ?>
                        <a href="<?= base_url('user/returned_rentals') ?>">View Returned Rentals</a>

                        <?php if ($rental['Status'] === 'Ongoing' && ($rental['RentStatus'] ?? '') !== 'returned'): ?>
                            <button class="return-button" onclick="returnRental(<?= $rental['rental_id'] ?>)">Return</button>
                        <?php else: ?>
                            <button class="return-button returned" disabled>Returned</button>
                        <?php endif; ?>
                        <?php if ($rental['approval_status'] === 'approved'): ?>
    <div class="detail-item">
        <a href="<?= base_url('rentals/agreement/' . $rental['rental_id']) ?>" 
           class="download-agreement-btn" 
           style="background-color: #4CAF50; 
                  color: white; 
                  padding: 8px 15px; 
                  border-radius: 5px; 
                  text-decoration: none; 
                  display: inline-block; 
                  margin-top: 10px;">
            Download Rental Agreement
        </a>
    </div>
<?php endif; ?>

                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No rental history available.</p>
        <?php endif; ?>       
    </body>
    <script>
function returnRental(rentalId) {
    if (confirm("Are you sure you want to return this rental?")) {
        fetch(`<?= base_url('rentals/return') ?>/${rentalId}`, { method: 'POST' })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Successfully returned the rental!");
                    location.reload(); // Refresh page to show "Returned" status
                } else {
                    alert("Failed to return the rental.");
                }
            })
            .catch(error => console.error('Error:', error));
    }
}
</script>
</html>