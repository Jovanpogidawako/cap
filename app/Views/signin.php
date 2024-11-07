<?= $this->include('layout/header') ?>
<style>
/* Login Container Styling */
.login-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    padding: 20px;
    padding-left:300px;
    
}

.login-container .container {
    background: rgba(255, 255, 255, 0.98);
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
    width: 100%;
    max-width: 400px;
    border: 1px solid #eaeaea;
    margin-left: 0; /* Aligns form to the left */
}

.login-container h2 {
    color: #1a1a1a;
    text-align: center;
    margin-bottom: 30px;
    font-size: 28px;
    font-weight: 600;
    letter-spacing: 0.5px;
}

.login-container .flash-message {
    background-color: #333;
    color: white;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 20px;
    text-align: center;
}

.login-container .form-group {
    margin-bottom: 20px;
}

.login-container label {
    display: block;
    margin-bottom: 8px;
    color: #333;
    font-weight: 500;
}

.login-container input {
    width: 100%;
    padding: 12px;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    font-size: 16px;
    transition: all 0.3s ease;
    background: #fafafa;
}

.login-container input:focus {
    border-color: #333;
    outline: none;
    background: #ffffff;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.login-container button {
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
}

.login-container button:hover {
    background: #333;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.login-container .register-link {
    text-align: center;
    margin-top: 20px;
    color: #666;
}

.login-container .register-link a {
    color: #1a1a1a;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.2s ease;
}

.login-container .register-link a:hover {
    color: #444;
    text-decoration: underline;
}

@media (max-width: 480px) {
    .login-container .container {
        padding: 20px;
    }
}

/* Add subtle hover effect to input fields */
.login-container input:hover {
    border-color: #ccc;
}

/* Add loading state to button */
.login-container button:active {
    transform: translateY(1px);
    box-shadow: none;
}
</style>
</head>
<body>
<div class="login-container">
<div class="container">
    <h2>Login</h2>
    <?php if (session()->getFlashdata('message')): ?>
        <div class="flash-message">
            <?= session()->getFlashdata('message') ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('user/login') ?>" method="post">
        <?= csrf_field() ?>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?= set_value('email') ?>" placeholder="Enter your email">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter your password">
        </div>

        <button type="submit">Login</button>
    </form>

    <p class="register-link">Don't have an account? <a href="<?= base_url('signup') ?>">Register here</a></p>
</div>
</div>
</body>
</html>
<div class="hero-banner"></div>
</body>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
