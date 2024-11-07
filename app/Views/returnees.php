<!DOCTYPE html>
<html lang="en">
<head>
<?= $this->include('layout/header') ?>

    <meta charset="UTF-8">
    <title>Return Details - Luxury Car Rentals</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }
        .returncontainer {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .penalty {
            color: #e74c3c; /* Red color for penalty */
            font-weight: bold;
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    <br>
    <br>
    <br>
    <div class="returncontainer">
        <h2>Rental Return Details</h2>
        <div class="rental-details">
            <p><strong>Name:</strong> <?= esc($rental['Name']) ?></p>
            <p><strong>Product Model:</strong> <?= esc($rental['product_model']) ?></p>
            <p><strong>Return Due Date:</strong> <?= esc($rental['EndDate']) ?> <?= esc($rental['EndTime']) ?></p>
            <p><strong>Returned On:</strong> <?= date('Y-m-d H:i:s') // Assume this is where you handle return time ?></p>
            
            <?php if ($penalty > 0): ?>
                <p class="penalty">Penalty for Late Return: PHP <?= esc(number_format($penalty, 2)) ?></p>
            <?php else: ?>
                <p>No penalty incurred. Thank you for returning on time!</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
