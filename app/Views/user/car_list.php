<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?= $this->include('layout/header') ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Shop - Luxury Car Rentals</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #000000;
            --secondary-color: #333333;
            --accent-color: #666666;
            --background-color: #ffffff;
            --text-color: #000000;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--background-color);
            color: var(--text-color);
        }

        .search-container {
            padding-top: 50px;
            display: flex;
            justify-content: center;
            margin: 2rem 0;
        }

        .search-container input {
            width: 300px;
            padding: 12px;
            border: 2px solid var(--primary-color);
            border-radius: 25px 0 0 25px;
            font-size: 1rem;
            outline: none;
            transition: all 0.3s ease;
        }

        .search-container input:focus {
            border-color: var(--accent-color);
        }

        .search-btn {
            padding: 12px 20px;
            border: 2px solid var(--primary-color);
            background-color: var(--primary-color);
            color: var(--background-color);
            cursor: pointer;
            border-radius: 0 25px 25px 0;
            transition: all 0.3s ease;
        }

        .search-btn:hover {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
        }

        .container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            padding: 0 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .card {
            background-color: var(--background-color);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: all 0.3s ease;
            position: relative;
        }

        .card:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .card-image {
            position: relative;
            overflow: hidden;
        }

        .card-image img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: all 0.3s ease;
        }

        .card:hover .card-image img {
            transform: scale(1.1);
        }

        .card-body {
            padding: 1.5rem;
        }

        .car-title {
            font-size: 1.5rem;
            margin: 0 0 0.5rem;
            color: var(--primary-color);
        }

        .price {
            font-size: 1.25rem;
            color: var(--accent-color);
            font-weight: 600;
        }

        .car-details {
            margin-top: 1rem;
        }

        .car-details p {
            display: flex;
            align-items: center;
            margin: 0.5rem 0;
            font-size: 0.9rem;
        }

        .car-details i {
            margin-right: 0.5rem;
            color: var(--primary-color);
        }

        .checkout-btn {
            display: inline-block;
            background-color: var(--primary-color);
            color: var(--background-color);
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 25px;
            transition: all 0.3s ease;
            font-size: 1rem;
            margin-top: 1rem;
            border: 2px solid var(--primary-color);
        }

        .checkout-btn:hover {
            background-color: var(--background-color);
            color: var(--primary-color);
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.8);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal.show {
            opacity: 1;
        }

        .modal-content {
            background-color: var(--background-color);
            margin: 5% auto;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
            max-width: 500px;
            width: 90%;
            transform: scale(0.8);
            opacity: 0;
            transition: all 0.3s ease;
        }

        .modal.show .modal-content {
            transform: scale(1);
            opacity: 1;
        }

        .close {
            align-self: flex-end;
            color: var(--accent-color);
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .close:hover {
            color: var(--primary-color);
        }

        .car-info {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .car-info img {
            width: 100%;
            max-height: 250px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 1rem;
        }

        .car-info h2 {
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
            color: var(--primary-color);
        }

        .price-modal {
            font-size: 1.5rem;
            color: var(--accent-color);
            font-weight: 600;
        }

        .payment-methods h2 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--primary-color);
        }

        .payment-methods form {
            display: flex;
            flex-direction: column;
        }

        .payment-methods input,
        .payment-methods select {
            width: 100%;
            padding: 10px;
            margin-bottom: 1rem;
            border: 1px solid var(--accent-color);
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .payment-methods input:focus,
        .payment-methods select:focus {
            border-color: var(--primary-color);
        }

        .payment-methods button {
            background-color: var(--primary-color);
            color: var(--background-color);
            padding: 12px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .payment-methods button:hover {
            background-color: var(--accent-color);
        }

        .success-modal {
            display: none;
            position: fixed;
            z-index: 1001;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .success-modal.show {
            opacity: 1;
        }

        .success-modal-content {
            background-color: var(--background-color);
            margin: 15% auto;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            text-align: center;
            max-width: 400px;
            width: 90%;
            transform: scale(0.8);
            opacity: 0;
            transition: all 0.3s ease;
            position: relative;
        }

        .success-modal.show .success-modal-content {
            transform: scale(1);
            opacity: 1;
        }

        .success-icon {
            font-size: 4rem;
            color: #4CAF50;
            margin-bottom: 1rem;
        }

        .success-title {
            font-size: 1.8rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .success-message {
            font-size: 1.1rem;
            color: var(--secondary-color);
            margin-bottom: 1.5rem;
        }

        .success-btn {
            background-color: #4CAF50;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 25px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .success-btn:hover {
            background-color: #45a049;
            transform: translateY(-2px);
        }

        .payment-icons {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .payment-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        .gcash-btn {
            background-color: #0066cc;
            color: white;
        }

        .gcash-btn:hover {
            background-color: #0052a3;
        }

        .bank-btn {
            background-color: #00a65a;
            color: white;
        }

        .bank-btn:hover {
            background-color: #008548;
        }

        .qr-container {
            text-align: center;
            padding: 1rem;
        }

        .qr-container img {
            max-width: 200px;
            margin-bottom: 1rem;
        }

        .bank-details {
            padding: 1rem;
        }

        .bank-details p {
            margin: 0.5rem 0;
        }

        .bank-details .note {
            margin-top: 1rem;
            color: #666;
            font-style: italic;
        }

        #gcashModal, #bankModal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }

        #gcashModal .modal-content, #bankModal .modal-content {
            max-width: 400px;
        }

        .category-title {
            font-size: 2rem;
            text-align: center;
            margin: 2rem 0;
            color: var(--primary-color);
        }

        .cart-icon {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: var(--primary-color);
            color: var(--background-color);
            padding: 10px;
            border-radius: 50%;
            cursor: pointer;
            z-index: 1000;
        }

        .cart-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 12px;
        }

        .filters {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
        }

        .filter-btn {
            background-color: var(--primary-color);
            color: var(--background-color);
            border: none;
            padding: 10px 20px;
            margin: 0 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .filter-btn:hover {
            background-color: var(--accent-color);
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
        }

        .pagination-btn {
            background-color: var(--primary-color);
            color: var(--background-color);
            border: none;
            padding: 10px 15px;
            margin: 0 5px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .pagination-btn:hover {
            background-color: var(--accent-color);
        }

        .reviews {
            margin-top: 1rem;
        }

        .review {
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .review-author {
            font-weight: bold;
        }

        .review-rating {
            color: #ffd700;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .card {
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .success-modal-content {
            animation: fadeInUp 0.5s ease-out;
        }
        .cart-icon {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: var(--primary-color);
            color: var(--background-color);
            padding: 10px;
            border-radius: 50%;
            cursor: pointer;
            z-index: 1000;
            text-decoration: none;
        }

        .cart-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 12px;
        }

        .proof-upload {
            margin-top: 1rem;
        }

        .proof-upload input[type="file"] {
            display: none;
        }

        .proof-upload label {
            display: inline-block;
            padding: 10px 15px;
            background-color: var(--primary-color);
            color: var(--background-color);
            border-radius: 5px;
            cursor: pointer;
        }

        .proof-upload label:hover {
            background-color: var(--accent-color);
        }

        .add-to-cart-btn {
            background-color: var(--accent-color);
            color: var(--background-color);
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-right: 10px;
        }

        .add-to-cart-btn:hover {
            background-color: var(--primary-color);
        }
        .rent-btn {
    background-color: #007bff; /* Primary blue color */
    color: #fff; /* White text color */
    padding: 10px 15px; /* Padding for the button */
    border: none; /* Remove border */
    border-radius: 5px; /* Rounded corners */
    cursor: pointer; /* Pointer cursor on hover */
    font-size: 16px; /* Font size */
    display: inline-flex; /* Align icon and text */
    align-items: center; /* Center icon and text vertically */
    gap: 8px; /* Space between icon and text */
    transition: background-color 0.3s ease; /* Smooth transition for hover effect */
}

.rent-btn:hover {
    background-color: #0056b3; /* Darker blue on hover */
}

.rent-btn i {
    font-size: 18px; /* Adjust icon size */
}

    </style>
</head>
<body>

    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Search for cars..."   onkeyup="searchCars()">
        <button class="search-btn"><i class="fas fa-search"></i></button>
    </div>

    <div class="filters">
        <button class="filter-btn" onclick="filterCars('all')">All Cars</button>
        <button class="filter-btn" onclick="filterCars('rent')">Rent</button>
        <button class="filter-btn" onclick="filterCars('sale')">Sale</button>
    </div>

    <h2 class="category-title">Cars for Rent</h2>
    <div class="container" id="rentCarsContainer">
        <?php if (!empty($rentCars) && is_array($rentCars)): ?>
            <?php foreach ($rentCars as $car): ?>
                <div class="card" data-category="rent">
                    <div class="card-image">
                        <img src="<?= base_url('uploaded_img/' . $car['image']) ?>" alt="<?= esc($car['model']) ?>" class="img-fluid">
                    </div>
                    <div class="card-body">
                        <h3 class="car-title"><?= esc($car['model']) ?></h3>
                        <p class="price">₱<?= number_format($car['price'], 2) ?> / day</p>
                        
                        <div class="car-details">
                            <p><i class="fas fa-gas-pump"></i> <?= esc($car['fueltype']) ?></p>
                            <p><i class="fas fa-cogs"></i> <?= esc($car['transmission']) ?></p>
                            <p><i class="fas fa-tachometer-alt"></i> <?= number_format($car['mileage']) ?> km</p>
                        </div>
                        <form action="<?= site_url('product/rent/' . $car['id']) ?>" method="get" style="display:inline;">
                        <button type="submit" class="rent-btn">
                            <i class="fas fa-key"></i> Rent this car
                        </button>
                    </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No rental cars available at the moment. Please check back later.</p>
        <?php endif; ?>
    </div>

    <h2 class="category-title">Cars for Sale</h2>
    <div class="container" id="saleCarsContainer">
        <?php if (!empty($ecommerceCars) && is_array($ecommerceCars)): ?>
            <?php foreach ($ecommerceCars as $car): ?>
                <div class="card" data-category="sale">
                    <div class="card-image">
                        <img src="<?= base_url('uploaded_img/' . $car['image']) ?>" alt="<?= esc($car['model']) ?>" class="img-fluid">
                    </div>
                    <div class="card-body">
                        <h3 class="car-title"><?= esc($car['model']) ?></h3>
                        <p class="price">₱<?= number_format($car['price'], 2) ?></p>
                        
                        <div class="car-details">
                            <p><i class="fas fa-gas-pump"></i> <?= esc($car['fueltype']) ?></p>
                            <p><i class="fas fa-cogs"></i> <?= esc($car['transmission']) ?></p>
                            <p><i class="fas fa-tachometer-alt"></i> <?= number_format($car['mileage']) ?> km</p>
                        </div>
                        <button class="checkout-btn" onclick="openModal('<?= esc($car['model']) ?>', <?= esc($car['price']) ?>, '<?= base_url('uploaded_img/' . $car['image']) ?>', 'ecommerce')">
                            <i class="fas fa-car"></i> Buy this Car
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No cars for sale available at the moment. Please check back later.</p>
        <?php endif; ?>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div class="car-info">
                <img id="modalCarImage" src="" alt="Car Image">
                <h2 id="modalCarModel"></h2>
                <div class="price-modal" id="modalCarPrice"></div>
            </div>
            <div class="payment-methods">
                <h2>Payment Details</h2>
                
                <!-- Payment Option Icons -->
                <div class="payment-icons">
                    <button onclick="showGcashModal()" class="payment-btn gcash-btn">
                        <i class="fas fa-qrcode"></i> GCash
                    </button>   
                    <button onclick="showBankModal()" class="payment-btn bank-btn">
                        <i class="fas fa-university"></i> Bank Transfer
                    </button>
                </div>

                <form method="POST" action="<?= base_url('/submitPayment'); ?>" onsubmit="showSuccessModal(event)" enctype="multipart/form-data">
                <!-- Hidden inputs for car details -->
                <input type="hidden" name="car_model" id="modalCarModelInput" value="">
                <input type="hidden" name="car_price" id="modalCarPriceInput" value="">
                <input type="hidden" name="car_image" id="modalCarImageInput" value="">

                <input type="text" id="card-name" name="card-name" placeholder="Full Name" required>
                <input type="text" id="card-address" name="card-address" placeholder="Address" required>

                <!-- Payment method set to "Face to Face Interaction" -->
                <select id="payment-method" name="payment-method" required>
                    <option value="face-to-face">Face to Face Interaction</option>
                </select>

                <!-- Add image upload field -->
                <div class="upload-container">
                    <label for="payment-image">Upload Payment Image (e.g., receipt or proof):</label>
                    <input type="file" id="payment-image" name="payment-image" accept="image/*" required>
                </div>

                <button type="submit"><i class="fas fa-credit-card"></i> Complete Payment</button>
            </form>
        </div>
    </div>
</div>
    <!-- GCash Modal -->
    <div id="gcashModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeGcashModal()">&times;</span>
            <h2>GCash Payment</h2>
            <div class="qr-container">
                <img src="<?= base_url('assets/images/gcash-qr.png'); ?>" alt="GCash QR Code">
                <p>Scan this QR code using your GCash app to complete the payment</p>
            </div>
        </div>
    </div>

    <!-- Bank Modal -->
    <div id="bankModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeBankModal()">&times;</span>
            <h2>Bank Transfer Details</h2>
            <div class="bank-details">
                <p><strong>Bank Name:</strong> Sample Bank</p>
                <p><strong>Account Name:</strong> John Doe</p>
                <p><strong>Account Number:</strong> 1234-5678-9012</p>
                <p><strong>Branch:</strong> Main Branch</p>
                <p class="note">Please use your name as reference when making the transfer</p>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="success-modal">
        <div class="success-modal-content">
            <i class="fas fa-check-circle success-icon"></i>
            <h2 class="success-title">Purchase Successful!</h2>
            <p class="success-message">Thank you for your purchase. Your order has been successfully processed.</p>
            <button class="success-btn" onclick="closeSuccessModal()">Continue Shopping</button>
        </div>
    </div>

    <script>
        let cartCount = 0;
        const cartCountElement = document.querySelector('.cart-count');

        function openModal(carModel, carPrice, carImage) {
            document.getElementById("modalCarModel").innerText = carModel;
            document.getElementById("modalCarPrice").innerText = "₱" + carPrice.toLocaleString();
            document.getElementById("modalCarImage").src = carImage;

            // Set hidden fields for form submission
            document.getElementById("modalCarModelInput").value = carModel;
            document.getElementById("modalCarPriceInput").value = carPrice;
            document.getElementById("modalCarImageInput").value = carImage;

            const modal = document.getElementById("myModal");
            modal.style.display = "block";
            setTimeout(() => {
                modal.classList.add("show");
            }, 10);
        }

        function closeModal() {
            const modal = document.getElementById("myModal");
            modal.classList.remove("show");
            setTimeout(() => {
                modal.style.display = "none";
            }, 300);
        }

        function searchCars() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toLowerCase();
            const cards = document.getElementsByClassName('card');

            for (let i = 0; i < cards.length; i++) {
                const title = cards[i].getElementsByClassName('car-title')[0].innerText.toLowerCase();
                if (title.indexOf(filter) > -1) {
                    cards[i].style.display = "";
                } else {
                    cards[i].style.display = "none";
                }
            }
        }

        function showSuccessModal(event) {
            event.preventDefault();
            const form = event.target;
            const successModal = document.getElementById("successModal");
            
            successModal.style.display = "block";
            setTimeout(() => {
                successModal.classList.add("show");
            }, 10);

            setTimeout(() => {
                form.submit();
            }, 2000);
        }

        function closeSuccessModal() {
            const successModal = document.getElementById("successModal");
            successModal.classList.remove("show");
            setTimeout(() => {
                successModal.style.display = "none";
                window.location.reload();
            }, 1000);
        }

        function showGcashModal() {
            const gcashModal = document.getElementById("gcashModal");
            gcashModal.style.display = "block";
            setTimeout(() => {
                gcashModal.classList.add("show");
            }, 10);
        }

        function closeGcashModal() {
            const gcashModal = document.getElementById("gcashModal");
            gcashModal.classList.remove("show");
            setTimeout(() => {
                gcashModal.style.display = "none";
            }, 300);
        }

        function showBankModal() {
            const bankModal = document.getElementById("bankModal");
            bankModal.style.display = "block";
            setTimeout(() => {
                bankModal.classList.add("show");
            }, 10);
        }

        function closeBankModal() {
            const bankModal = document.getElementById("bankModal");
            bankModal.classList.remove("show");
            setTimeout(() => {
                bankModal.style.display = "none";
            }, 300);
        }

        function filterCars(category) {
            const allCards = document.querySelectorAll('.card');
            allCards.forEach(card => {
                if (category === 'all' || card.dataset.category === category) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>

    <?= $this->include('layout/footer') ?>
</body>
</html>