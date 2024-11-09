<style>
    body { font-family: Arial, sans-serif; line-height: 1.6; }
    h1 { text-align: center; color: #333; }
    table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
    th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
    th { background-color: #f2f2f2; }
</style>

<h1>PURCHASE AGREEMENT</h1>

<p>This Purchase Agreement is made on <?= date('F d, Y') ?> between:</p>

<p><strong>Seller:</strong> Luxury Car Sales</p>
<p><strong>Buyer:</strong> <?= esc($purchase['customer_name']) ?></p>

<h2>Vehicle Details</h2>
<table>
    <tr>
        <th>Model</th>
        <td><?= esc($purchase['car_model']) ?></td>
    </tr>
    <tr>
        <th>Purchase Price</th>
        <td>₱<?= number_format($purchase['price'], 2) ?></td>
    </tr>
    <tr>
        <th>Payment Method</th>
        <td><?= esc($purchase['payment_method']) ?></td>
    </tr>
    <tr>
        <th>Purchase Date</th>
        <td><?= date('F d, Y', strtotime($purchase['purchase_date'])) ?></td>
    </tr>
</table>

<h2>Terms and Conditions</h2>
<ol>
    <li>The Seller agrees to sell and the Buyer agrees to purchase the above-described vehicle.</li>
    <li>The Buyer acknowledges that they have inspected the vehicle and are satisfied with its condition.</li>
    <li>The Seller warrants that they have full right and authority to sell and transfer the vehicle.</li>
    <li>The vehicle is sold "as is" without any warranties, express or implied, except as required by law.</li>
    <li>The Buyer is responsible for all taxes, fees, and other charges related to the transfer of ownership.</li>
</ol>

<p>By accepting this agreement, both parties acknowledge and agree to the terms and conditions stated herein.</p>

<div style="margin-top: 50px;">
    <p>____________________________</p>
    <p>Seller's Signature</p>
</div>

<div style="margin-top: 50px;">
    <p>____________________________</p>
    <p>Buyer's Signature</p>
</div>