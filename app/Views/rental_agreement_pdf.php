<style>
    body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
    }
    .agreement-header {
        text-align: center;
        margin-bottom: 20px;
    }
    .agreement-table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }
    .agreement-table td {
        padding: 8px;
        border: 1px solid #ddd;
    }
    .signature-section {
        margin-top: 40px;
    }
    .signature-line {
        border-top: 1px solid #000;
        margin-top: 40px;
        padding-top: 5px;
    }
</style>

<div class="agreement-header">
    <h2>RENTAL AGREEMENT</h2>
</div>

<p>This is a rental agreement made between the Lessor,</p>
<p><strong>Luxury Car Rentals</strong>, and the Lessee,</p>
<p><strong><?= esc($rental['Name']) ?></strong>, dated <?= date('F d, Y') ?>.</p>

<table class="agreement-table">
    <tr>
        <td>Vehicle Model</td>
        <td><?= esc($rental['product_model']) ?></td>
    </tr>
    <tr>
        <td>Rental Period</td>
        <td>From: <?= esc($rental['StartDate']) ?> <?= esc($rental['StartTime']) ?><br>
            To: <?= esc($rental['EndDate']) ?> <?= esc($rental['EndTime']) ?></td>
    </tr>
    <tr>
        <td>Pick-up Location</td>
        <td><?= esc($rental['FirstLocation']) ?></td>
    </tr>
    <tr>
        <td>Drop-off Location</td>
        <td><?= esc($rental['SecondLocation']) ?></td>
    </tr>
    <tr>
        <td>Total Rental Fee</td>
        <td>PHP <?= number_format($rental['price'], 2) ?></td>
    </tr>
</table>

<div class="terms">
    <h3>Terms and Conditions:</h3>
    <ol>
        <li>The Lessee agrees to return the vehicle in the same condition as received.</li>
        <li>The Lessee is responsible for fuel costs during the rental period.</li>
        <li>The Lessee must have a valid driver's license and be over 21 years of age.</li>
        <li>Insurance coverage is included in the rental fee.</li>
        <li>Any damage to the vehicle will be assessed and charged to the Lessee.</li>
    </ol>
</div>

<div class="signature-section">
    <div class="signature-line">
        <p>Lessor's Signature</p>
        <p>Luxury Car Rentals</p>
    </div>

    <div class="signature-line">
        <p>Lessee's Signature</p>
        <p><?= esc($rental['Name']) ?></p>
    </div>

    <div class="signature-line">
        <p>Date: <?= date('F d, Y') ?></p>
    </div>
</div>