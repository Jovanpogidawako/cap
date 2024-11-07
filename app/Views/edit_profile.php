<?= $this->include('layout/header') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            min-height: 100vh;
            background-color: #f5f7fa;
            padding: 40px 20px;
            color: #333;
        }

        .update-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            padding: 40px;
        }

        h2 {
            color: #1a1a1a;
            font-size: 28px;
            margin-bottom: 30px;
            text-align: center;
            font-weight: 600;
        }

        .validation-errors {
            background-color: #fff2f2;
            border: 1px solid #ffcdd2;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 25px;
            color: #d32f2f;
            font-size: 14px;
            line-height: 1.5;
        }

        .validation-errors ul {
            list-style-position: inside;
            margin-left: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
            font-size: 15px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #fafafa;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #1a1a1a;
            outline: none;
            background: #ffffff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .file-input-wrapper {
            position: relative;
            margin-top: 8px;
        }

        input[type="file"] {
            display: none;
        }

        .file-input-label {
            display: inline-block;
            padding: 12px 20px;
            background-color: #f0f0f0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
            color: #555;
        }

        .file-input-label:hover {
            background-color: #e0e0e0;
        }

        .selected-file {
            margin-top: 8px;
            font-size: 14px;
            color: #666;
        }

        .button-group {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        button {
            flex: 1;
            padding: 12px 24px;
            background: #1a1a1a;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            background: #333;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #666;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .back-link:hover {
            color: #1a1a1a;
        }

        .password-section {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .password-section-title {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
            font-weight: 500;
        }

        @media (max-width: 600px) {
            .update-container {
                padding: 20px;
            }

            h2 {
                font-size: 24px;
            }

            .button-group {
                flex-direction: column;
            }
        }
        .alert-success {
    background-color: #e0f8e0;
    color: #2e7d32;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-size: 14px;
    text-align: center;
}

    </style>
</head>
<body>
    <div class="update-container">
        <h2>Update Profile</h2>

        <?php if (session()->getFlashdata('message')): ?>
    <div class="alert-success">
        <?= session()->getFlashdata('message') ?>
    </div>
<?php endif; ?>
        <form action="<?= base_url('user/updateProfile') ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="form-group">
        <label for="update_name">Name</label>
        <input type="text" name="update_name" id="update_name" value="<?= esc($user['name']) ?>">
    </div>

    <div class="form-group">
        <label for="update_email">Email</label>
        <input type="email" name="update_email" id="update_email" value="<?= esc($user['email']) ?>">
    </div>

    <div class="form-group">
        <label for="update_phone">Phone</label>
        <input type="text" name="update_phone" id="update_phone" value="<?= esc($user['phone']) ?>">
    </div>

    <div class="form-group">
        <label for="update_address">Address</label>
        <input type="text" name="update_address" id="update_address" value="<?= esc($user['address']) ?>">
    </div>

    <div class="form-group">
        <label for="update_gender">Gender</label>
        <select name="update_gender" id="update_gender">
            <option value="male" <?= ($user['gender'] === 'male') ? 'selected' : '' ?>>Male</option>
            <option value="female" <?= ($user['gender'] === 'female') ? 'selected' : '' ?>>Female</option>
            <option value="other" <?= ($user['gender'] === 'other') ? 'selected' : '' ?>>Other</option>
        </select>
    </div>

    <div class="form-group">
        <label for="update_image">Profile Image (optional)</label>
        <div class="file-input-wrapper">
            <label for="update_image" class="file-input-label">Choose File</label>
            <input type="file" name="update_image" id="update_image" accept="image/*">
            <div class="selected-file" id="file-name">No file chosen</div>
        </div>
    </div>

    <div class="button-group">
        <button type="submit">Update Profile</button>
    </div>
</form>


        <a href="<?= base_url('profs') ?>" class="back-link">Back to Profile</a>
    </div>

    <script>
        // Display selected file name
        document.getElementById('update_image').addEventListener('change', function() {
            const fileName = this.files[0]?.name || 'No file chosen';
            document.getElementById('file-name').textContent = fileName;
        });
    </script>
</body>
</html>