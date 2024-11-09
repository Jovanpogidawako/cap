<div class="container">
    <h2>Your Returned Rentals</h2>
    <?php if (!empty($returnedRentals)): ?>
        <?php foreach ($returnedRentals as $rental): ?>
            <div class="card rental-item">
                <div class="car-details">
                    <div class="detail-item"><strong>Product Model:</strong> <?= esc($rental['product_model']) ?></div>
                    <div class="detail-item"><strong>Return Date:</strong> <?= esc($rental['EndDate']) ?> <?= esc($rental['EndTime']) ?></div>
                    <div class="detail-item"><strong>Price:</strong> PHP <?= esc(number_format((float)$rental['price'], 2)) ?></div>
                    <div class="detail-item"><strong>First Location:</strong> <?= esc($rental['FirstLocation']) ?></div>
                    <div class="detail-item"><strong>Second Location:</strong> <?= esc($rental['SecondLocation']) ?></div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No returned rentals found.</p>
    <?php endif; ?>
</div>
