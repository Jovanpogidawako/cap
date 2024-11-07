<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxury Car Sales Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            background-color: #f0f2f5;
            color: #1a1a1a;
            line-height: 1.6;
        }
        .dashboard {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        .header h1 {
            font-size: 2rem;
            color: #1a1a1a;
            font-weight: 600;
        }
        .sales-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }
        .sale-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease;
        }
        .sale-card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }
        .car-image-container {
            position: relative;
            height: 200px;
            overflow: hidden;
        }
        .car-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .sale-info {
            padding: 1.5rem;
        }
        .car-model {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        .price {
            color: #2563eb;
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        .customer-info {
            display: grid;
            gap: 0.5rem;
            margin-bottom: 1rem;
            font-size: 0.9rem;
            color: #666;
        }
        .payment-status {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 1rem;
            border-top: 1px solid #eee;
        }
        .toggle-switch {
            position: relative;
            width: 60px;
            height: 30px;
            background: #ccc;
            border-radius: 15px;
            padding: 4px;
            transition: all 0.3s;
            cursor: pointer;
        }
        .toggle-switch.active {
            background: #10b981;
        }
        .toggle-switch::before {
            content: '';
            position: absolute;
            width: 24px;
            height: 24px;
            background: white;
            border-radius: 50%;
            transition: transform 0.3s;
        }
        .toggle-switch.active::before {
            transform: translateX(30px);
        }
        .status-label {
            font-weight: 500;
            color: #666;
        }
        .payment-method {
            display: inline-block;
            padding: 0.4rem 0.8rem;
            background: #f3f4f6;
            border-radius: 6px;
            font-size: 0.85rem;
            color: #666;
            margin-bottom: 1rem;
        }
        .date {
            color: #666;
            font-size: 0.85rem;
            margin-bottom: 0.5rem;
        }
        @media (max-width: 768px) {
            .dashboard {
                padding: 1rem;
            }
            .sales-grid {
                grid-template-columns: 1fr;
            }
        }
        .approve-btn, .disapprove-btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            font-weight: 600;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-left: 10px;
        }
        .approve-btn {
            background-color: #10b981;
        }
        .approve-btn:hover {
            background-color: #0f9a6e;
        }
        .disapprove-btn {
            background-color: #f59e0b;
        }
        .disapprove-btn:hover {
            background-color: #d97706;
        }
    </style>
</head>
<<body>
    <div class="dashboard">
        <div class="header">
            <h1>Sales Dashboard</h1>
        </div>

        <div class="sales-grid">
            <?php foreach ($purchases as $purchase): ?>
            <div class="sale-card">
                <div class="car-image-container">
                    <img src="<?= esc($purchase['car_image']) ?>" alt="Image of <?= esc($purchase['car_model']) ?>">
                </div>
                <div class="sale-info">
                    <div class="date">
                        <i class="far fa-calendar"></i>
                        <?= date('F j, Y', strtotime($purchase['purchase_date'])) ?>
                    </div>
                    <div class="car-model"><?= esc($purchase['car_model']) ?></div>
                    <div class="price">₱<?= number_format($purchase['price'], 2) ?></div>
                    <div class="payment-method">
                        <i class="fas fa-credit-card"></i>
                        <?= esc($purchase['payment_method']) ?>
                    </div>
                    <div class="customer-info">
                        <div>
                            <i class="far fa-user"></i>
                            <?= esc($purchase['customer_name']) ?>
                        </div>
                        <div>
                            <i class="fas fa-map-marker-alt"></i>
                            <?= esc($purchase['customer_address']) ?>
                        </div>
                    </div>
                    <div class="payment-status">
    <span class="status-label">Approval Status: <?= $purchase['is_approved'] ? 'Approved' : 'Pending' ?></span>
    <?php if ($purchase['is_approved']): ?>
        <button class="disapprove-btn" onclick="updateApprovalStatus(<?= esc($purchase['id']) ?>, false)">Disapprove</button>
    <?php else: ?>
        <button class="approve-btn" onclick="updateApprovalStatus(<?= esc($purchase['id']) ?>, true)">Approve</button>
    <?php endif; ?>
</div>



                    <!-- Add delete button form -->
                    <form action="/delete_purchase/<?= esc($purchase['id']) ?>" method="post" style="margin-top: 1rem;">
                        <?= csrf_field() ?>
                        <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete this purchase?');">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

<!-- ... (previous HTML code remains unchanged) ... -->

<script>
function updateApprovalStatus(purchaseId, isApproved) {
    const statusText = isApproved ? 'Approved' : 'Pending';
    fetch(`/product/toggleApproval/${purchaseId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
        },
        body: JSON.stringify({ is_approved: isApproved })
    }).then(response => response.json()).then(data => {
        if (data.success) {
            alert('Approval status updated to ' + statusText);
            location.reload(); // Reload page to show updated status
        } else {
            alert('Error updating approval status: ' + data.message);
        }
    }).catch(error => {
        console.error('Error:', error);
        alert('An error occurred while updating the approval status');
    });
}

</script>

<!-- ... (rest of the HTML code remains unchanged) ... -->
</body>
</html>
<?= $this->endSection() ?>