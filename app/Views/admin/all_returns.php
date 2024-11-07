<?= $this->extend('layout/admin') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <h2>All Returned Rentals (Admin View)</h2>
    <?php if (!empty($returns)): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Rental ID</th>
                    <th>User</th>
                    <th>Return Date</th>
                    <th>Price</th>
                    <th>Penalty</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($returns as $return): ?>
                    <tr>
                        <td><?= esc($return['RentalID']) ?></td>
                        <td><?= esc($return['Name']) ?></td>
                        <td><?= esc($return['ReturnDate']) ?> <?= esc($return['ReturnTime']) ?></td>
                        <td>$<?= esc($return['price']) ?></td>
                        <td>$<?= esc($return['Penalty']) ?></td>
                        <td>$<?= esc($return['price'] + $return['Penalty']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No returned rentals found.</p>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>