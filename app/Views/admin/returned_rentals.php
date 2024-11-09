<div class="container">
    <h2>All Returned Rentals</h2>
    <?php if (!empty($returnedRentals)): ?>
        <?php foreach ($returnedRentals as $rental): ?>
            <div class="card rental-item">
                <div class="car-details">
                <div class="detail-item"><strong>User Name:</strong> <?= esc($rental['user_name'] ?? 'Unknown') ?></div>
<div class="detail-item"><strong>Product Model:</strong> <?= esc($rental['product_model'] ?? 'Unknown') ?></div>

                    <div class="detail-item"><strong>Return Date:</strong> <?= esc($rental['EndDate']) ?> <?= esc($rental['EndTime']) ?></div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No returned rentals found.</p>
    <?php endif; ?>
</div>
