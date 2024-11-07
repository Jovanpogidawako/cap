<?= $this->include('layout/header') ?>
<title>Register</title>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .gender-select {
    width: 100%;
    padding: 12px;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    font-size: 16px;
    background: #fafafa;
    transition: border-color 0.3s ease;
}

.gender-select:focus {
    border-color: #333;
    outline: none;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.gender-select:hover {
    border-color: #ccc;
}

        /* ... (keep all existing styles) ... */

        /* Add new styles for terms modal */
        
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .modal-content {
            position: relative;
            background-color: #fff;
            margin: 5% auto;
            padding: 20px;
            width: 90%;
            max-width: 700px;
            border-radius: 10px;
            max-height: 80vh;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .modal-header {
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .modal-body {
            overflow-y: auto;
            padding: 20px 0;
            flex-grow: 1;
            max-height: calc(80vh - 150px);
        }

        .modal-footer {
            padding-top: 15px;
            border-top: 1px solid #eee;
            text-align: right;
        }

        .close {
            position: absolute;
            right: 20px;
            top: 20px;
            font-size: 24px;
            cursor: pointer;
            color: #666;
        }

        .terms-checkbox-container {
            margin: 20px 0;
            padding: 10px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background: #f9f9f9;
        }

        .terms-checkbox-container label {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }

        .terms-checkbox-container input[type="checkbox"] {
            width: auto;
            margin-right: 10px;
        }

        .terms-link {
            color: #1a1a1a;
            text-decoration: underline;
            cursor: pointer;
        }

        .accept-terms-btn {
            background: #1a1a1a;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
        }

        .accept-terms-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        .modal-scroll-indicator {
            text-align: center;
            color: #666;
            margin-bottom: 10px;
            font-size: 14px;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: flex-start; /* Align to the left */
            padding: 20px;
        }

        .register-container {
            background: rgba(255, 255, 255, 0.98);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 600px;
            border: 1px solid #eaeaea;
            margin-right: 20px; /* Add space to the right if needed */
            margin-top: 80px;
            margin-left: 70px;
        }

        .register-container h2 {
            color: #1a1a1a;
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .register-container .validation-errors {
            background-color: #333;
            color: white;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            line-height: 1.5;
        }

        .register-container .validation-errors ul {
            list-style-type: none;
            padding-left: 0;
        }

        .register-container .validation-errors li {
            margin-bottom: 5px;
        }

        .register-container .form-group {
            margin-bottom: 20px;
        }

        .register-container label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
        }

        .register-container input {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #fafafa;
        }

        .register-container input[type="file"] {
            padding: 8px;
            background: #fff;
            font-size: 14px;
        }

        .register-container input:focus {
            border-color: #333;
            outline: none;
            background: #ffffff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .register-container button {
            width: 100%;
            padding: 12px;
            background: #1a1a1a;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            letter-spacing: 0.5px;
            margin-top: 10px;
        }

        .register-container button:hover {
            background: #333;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .register-container .login-link {
            text-align: center;
            margin-top: 20px;
            color: #666;
        }

        .register-container .login-link a {
            color: #1a1a1a;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease;
        }

        .register-container .login-link a:hover {
            color: #444;
            text-decoration: underline;
        }

        .register-container .file-input-wrapper {
            position: relative;
            margin-bottom: 20px;
        }

        .register-container .file-input-wrapper input[type="file"] {
            border: 2px dashed #e0e0e0;
            padding: 20px;
            text-align: center;
            cursor: pointer;
        }

        .register-container .file-input-wrapper input[type="file"]:hover {
            border-color: #ccc;
            background: #f5f5f5;
        }

        @media (max-width: 480px) {
            .register-container {
                padding: 20px;
                width: 90%; /* Adjust width for smaller screens */
            }
        }

        .register-container input:hover {
            border-color: #ccc;
        }

        .register-container button:active {
            transform: translateY(1px);
            box-shadow: none;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
        <?php if (isset($validation)): ?>
            <div class="validation-errors">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('signin') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="<?= set_value('name') ?>" placeholder="Enter your name">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="<?= set_value('email') ?>" placeholder="Enter your email">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password">
            </div>

            <div class="form-group">
                <label for="cpassword">Confirm Password</label>
                <input type="password" name="cpassword" id="cpassword" placeholder="Confirm your password">
            </div>

            <div class="form-group file-input-wrapper">
                <label for="image">Profile Image</label>
                <input type="file" name="image" id="image" accept="image/*">
            </div>

            <!-- Additional fields -->
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" value="<?= set_value('phone') ?>" placeholder="Enter your phone number">
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" value="<?= set_value('address') ?>" placeholder="Enter your address">
            </div>

            <div class="form-group">
    <label for="gender">Gender</label>
    <select name="gender" id="gender" class="gender-select">
        <option value="">Select Gender</option>
        <option value="male" <?= set_value('gender') === 'male' ? 'selected' : '' ?>>Male</option>
        <option value="female" <?= set_value('gender') === 'female' ? 'selected' : '' ?>>Female</option>
        <option value="other" <?= set_value('gender') === 'other' ? 'selected' : '' ?>>Other</option>
    </select>
</div>

            <div class="terms-checkbox-container">
            <label>
                <input type="checkbox" id="terms-checkbox" disabled required>
                I accept the <span class="terms-link" id="open-terms">Terms and Policy</span>
            </label>
        </div>
            <button type="submit">Register</button>
        </form>

        <p class="login-link">Already have an account? <a href="<?= base_url('signin') ?>">Login here</a></p>
    </div>
    <div id="terms-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="modal-header">
                <h2>Terms and Policy</h2>
            </div>
            <div class="modal-scroll-indicator" id="scroll-indicator">
                Scroll to bottom to accept terms
            </div>
            <div class="modal-body">
                <h3>E-Commerce Terms</h3>
                <p>Welcome to our e-commerce and car rental platform. By using our services, you agree to the following terms:</p>
                
                <h4>1. Account Registration</h4>
                <p>Users must provide accurate and complete information during registration. You are responsible for maintaining the confidentiality of your account credentials.</p>

                <h4>2. E-Commerce Policies</h4>
                <p>- All prices are in local currency unless otherwise stated<br>
                - Payment information is encrypted and secured<br>
                - Shipping policies apply as per local regulations<br>
                - Returns are accepted within 14 days of purchase</p>

                <h4>3. Car Rental Terms</h4>
                <p>- Renters must be 21 years or older<br>
                - Valid driver's license required<br>
                - Insurance coverage is mandatory<br>
                - Fuel policy: Return with same fuel level<br>
                - Damage assessment will be conducted before and after rental</p>

                <h4>4. Cancellation Policy</h4>
                <p>- Free cancellation up to 24 hours before pickup<br>
                - Late cancellations may incur charges<br>
                - No-shows will be charged full amount</p>

                <h4>5. Privacy Policy</h4>
                <p>We collect and process personal data in accordance with local privacy laws. Your information is used to:</p>
                <p>- Process orders and rentals<br>
                - Communicate about services<br>
                - Improve user experience<br>
                - Comply with legal requirements</p>

                <h4>6. User Responsibilities</h4>
                <p>Users agree to:<br>
                - Provide accurate information<br>
                - Maintain account security<br>
                - Follow rental vehicle guidelines<br>
                - Report any issues promptly</p>

                <!-- Add more terms content to make it scrollable -->
                <h4>7. Liability</h4>
                <p>The company is not liable for:</p>
                <p>- Personal injuries during vehicle use<br>
                - Loss of personal belongings<br>
                - Indirect or consequential damages<br>
                - Technical malfunctions</p>

                <h4>8. Modifications</h4>
                <p>We reserve the right to modify these terms at any time. Users will be notified of significant changes.</p>
            </div>
            <div class="modal-footer">
                <button class="accept-terms-btn" id="accept-terms-btn" disabled>Accept Terms</button>
            </div>
        </div>
        </div>    

    <div class="hero-banner"></div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('terms-modal');
            const openTermsLink = document.getElementById('open-terms');
            const closeBtn = document.querySelector('.close');
            const modalBody = document.querySelector('.modal-body');
            const acceptTermsBtn = document.getElementById('accept-terms-btn');
            const termsCheckbox = document.getElementById('terms-checkbox');
            const registerButton = document.getElementById('register-button');
            const scrollIndicator = document.getElementById('scroll-indicator');
            
            let hasScrolledToBottom = false;

            // Open modal
            openTermsLink.onclick = function() {
                modal.style.display = "block";
                hasScrolledToBottom = false;
                acceptTermsBtn.disabled = true;
            }

            // Close modal
            closeBtn.onclick = function() {
                modal.style.display = "none";
            }

            // Close when clicking outside
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }

            // Check scroll position
            modalBody.addEventListener('scroll', function() {
                const isAtBottom = modalBody.scrollHeight - modalBody.scrollTop <= modalBody.clientHeight + 50;
                
                if (isAtBottom && !hasScrolledToBottom) {
                    hasScrolledToBottom = true;
                    acceptTermsBtn.disabled = false;
                    scrollIndicator.style.display = 'none';
                }
            });

            // Handle terms acceptance
            acceptTermsBtn.onclick = function() {
                termsCheckbox.checked = true;
                modal.style.display = "none";
                registerButton.disabled = false;
            }

            // Update register button state when checkbox changes
            termsCheckbox.onchange = function() {
                registerButton.disabled = !termsCheckbox.checked;
            }
        });
    </script>
    <script src="<?= base_url('js/script.js') ?>"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>