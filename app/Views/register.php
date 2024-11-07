<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #2c2c2c 0%, #1a1a1a 100%);
            padding: 20px;
        }

        .register-container {
            background: rgba(255, 255, 255, 0.98);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
            border: 1px solid #eaeaea;
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

        <form action="<?= base_url('user/register') ?>" method="post" enctype="multipart/form-data">
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

            <button type="submit">Register</button>
        </form>

        <p class="login-link">Already have an account? <a href="<?= base_url('user/login') ?>">Login here</a></p>
    </div>
</body>
</html>
