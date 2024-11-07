<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <h2>All Returned Rentals</h2>
    <?php if (!empty($returns)): ?>
        <?php foreach ($returns as $return): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Rental ID: <?= esc($return['RentalID']) ?></h5>
                    <p class="card-text">
                        <strong>Return Date:</strong> <?= esc($return['ReturnDate']) ?> <?= esc($return['ReturnTime']) ?><br>
                        <strong>Price:</strong> $<?= esc($return['price']) ?><br>
                        <strong>Penalty:</strong> $<?= esc($return['Penalty']) ?><br>
                        <strong>Total:</strong> $<?= esc($return['price'] + $return['Penalty']) ?>
                    </p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No returned rentals found.</p>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>