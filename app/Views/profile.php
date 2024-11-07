<?= $this->include('layout/header') ?>

<title>Profile</title>
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

    .profile-container {
        max-width: 800px;
        margin: 40px auto;
        background: white;
        border-radius: 20px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        padding: 40px;
    }

    .profile-header {
        display: flex;
        align-items: center;
        gap: 30px;
        margin-bottom: 40px;
        flex-wrap: wrap;
    }

    .profile-image-container {
        position: relative;
    }

    .profile-image {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid white;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        background-color: #f0f0f0;
    }

    .profile-info {
        flex: 1;
    }

    h2 {
        color: #1a1a1a;
        font-size: 34px;
        margin-bottom: 16px;
        font-weight: 600;
    }

    .profile-email {
        color: #666;
        font-size: 20px;
        margin-bottom: 15px;
    }

    .profile-info p {
        font-size: 18px;
        margin: 6px 0;
        color: #444;
    }

    .profile-info p strong {
        color: #1a1a1a;
    }

    .profile-actions {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        margin-top: 20px;
    }

    .profile-link {
        display: inline-flex;
        align-items: center;
        padding: 12px 24px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        font-size: 16px;
        transition: all 0.3s ease;
    }

    .edit-profile {
        background-color: #1a1a1a;
        color: white;
    }

    .edit-profile:hover {
        background-color: #333;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .logout {
        background-color: #f5f5f5;
        color: #666;
    }

    .logout:hover {
        background-color: #e5e5e5;
        color: #333;
    }

    /* No profile picture placeholder */
    .no-profile-image {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background-color: #e0e0e0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        color: #999;
    }

    @media (max-width: 600px) {
        .profile-container {
            padding: 20px;
        }

        .profile-header {
            flex-direction: column;
            text-align: center;
            gap: 20px;
        }

        .profile-image-container {
            margin: 0 auto;
        }

        .profile-actions {
            justify-content: center;
        }

        .profile-link {
            width: 100%;
            justify-content: center;
        }

        h2 {
            font-size: 28px;
        }

        .profile-email {
            font-size: 18px;
        }

        .profile-info p {
            font-size: 16px;
        }
    }
</style>
</head>
<body>

<div class="profile-container">
    <div class="profile-header">
        <div class="profile-image-container">
            <?php if ($user['image']): ?>
                <img class="profile-image" src="<?= base_url('uploads/' . esc($user['image'])) ?>" alt="Profile Picture">
            <?php else: ?>
                <div class="no-profile-image">
                    <?= strtoupper(substr($user['name'], 0, 1)) ?>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="profile-info">
            <h2><?= esc($user['name']) ?></h2>
            <p class="profile-email"><?= esc($user['email']) ?></p>

            <!-- Additional User Information -->
            <p><strong>Phone:</strong> <?= esc($user['phone']) ?></p>
            <p><strong>Address:</strong> <?= esc($user['address']) ?></p>
            <p><strong>Gender:</strong> <?= esc($user['gender']) ?></p>

            <div class="profile-actions">
                <a href="<?= base_url('edit_prof') ?>" class="profile-link edit-profile">Edit Profile</a>

            </div>
        </div>
    </div>
</div>
