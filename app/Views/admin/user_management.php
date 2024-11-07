<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<title>User Management</title>

<style>
    :root {
        --primary-color: #4f46e5;
        --primary-hover: #4338ca;
        --danger-color: #ef4444;
        --danger-hover: #dc2626;
        --text-primary: #1f2937;
        --text-secondary: #6b7280;
        --bg-primary: #f9fafb;
        --bg-card: #ffffff;
        --border-color: #e5e7eb;
    }

    body {
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
        background-color: var(--bg-primary);
        color: var(--text-primary);
        line-height: 1.5;
    }

    .container {
        max-width: 1280px;
        margin: 0 auto;
        padding: 2rem;
    }

    h2 {
        color: var(--text-primary);
        font-size: 2.25rem;
        font-weight: 700;
        margin-bottom: 2rem;
        text-align: center;
        letter-spacing: -0.025em;
    }

    .user-management {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 1.5rem;
        padding: 1rem 0;
    }

    .user-card {
        background-color: var(--bg-card);
        border-radius: 1rem;
        padding: 1.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
        border: 1px solid var(--border-color);
    }

    .user-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    .profile-image {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid var(--primary-color);
        margin: 0 auto 1.5rem;
        display: block;
        box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.2);
    }

    .user-info {
        text-align: center;
    }

    .user-info h3 {
        color: var(--text-primary);
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .user-info p {
        color: var(--text-secondary);
        margin: 0.5rem 0;
        font-size: 0.875rem;
    }

    .user-actions {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
        margin-top: 1.5rem;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        font-weight: 500;
        font-size: 0.875rem;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
        gap: 0.5rem;
    }

    .btn-primary {
        background-color: var(--primary-color);
        color: white;
    }

    .btn-primary:hover {
        background-color: var(--primary-hover);
    }

    .btn-secondary {
        background-color: white;
        color: var(--text-primary);
        border: 1px solid var(--border-color);
    }

    .btn-secondary:hover {
        background-color: var(--bg-primary);
    }

    .btn-danger {
        background-color: var(--danger-color);
        color: white;
    }

    .btn-danger:hover {
        background-color: var(--danger-hover);
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
    }

    .modal-content {
        background-color: var(--bg-card);
        margin: 5% auto;
        padding: 2rem;
        border-radius: 1rem;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        width: 90%;
        max-width: 500px;
        position: relative;
    }

    .close {
        position: absolute;
        right: 1.5rem;
        top: 1.5rem;
        font-size: 1.5rem;
        color: var(--text-secondary);
        cursor: pointer;
        transition: color 0.2s ease;
    }

    .close:hover {
        color: var(--text-primary);
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: var(--text-primary);
        font-size: 0.875rem;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid var(--border-color);
        border-radius: 0.5rem;
        font-size: 0.875rem;
        transition: all 0.2s ease;
        background-color: white;
    }

    .form-group input:focus,
    .form-group select:focus {
        border-color: var(--primary-color);
        outline: none;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    .alert {
        padding: 1rem;
        border-radius: 0.5rem;
        margin-bottom: 1.5rem;
        font-size: 0.875rem;
    }

    .alert-success {
        background-color: #ecfdf5;
        color: #065f46;
        border: 1px solid #6ee7b7;
    }

    .modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--border-color);
    }
</style>

<div class="container">
    <h2>User Management</h2>

    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('message') ?></div>
    <?php endif; ?>

    <div class="user-management">
        <?php foreach ($users as $user): ?>
            <div class="user-card">
                <img src="<?= base_url('uploads/' . esc($user['image'])) ?>" alt="Profile Image" class="profile-image">
                <div class="user-info">
                    <h3><?= esc($user['name']) ?></h3>
                    <p><strong>Email:</strong> <?= esc($user['email']) ?></p>
                    <p><strong>Phone:</strong> <?= esc($user['phone']) ?></p>
                    <p><strong>Address:</strong> <?= esc($user['address']) ?></p>
                    <p><strong>Gender:</strong> <?= esc($user['gender']) ?></p>
                </div>
                <div class="user-actions">
                    <button class="btn btn-primary" onclick="openModal('viewUserModal<?= $user['id'] ?>')">View</button>
                    <button class="btn btn-secondary" onclick="openModal('editUserModal<?= $user['id'] ?>')">Edit</button>
                    <a href="<?= base_url('admin/deleteUser/' . $user['id']) ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                </div>
            </div>

            <!-- View User Modal -->
            <div class="modal" id="viewUserModal<?= $user['id'] ?>">
                <div class="modal-content">
                    <span class="close" onclick="closeModal('viewUserModal<?= $user['id'] ?>')">&times;</span>
                    <h3>User Profile</h3>
                    <img src="<?= base_url('uploads/' . esc($user['image'])) ?>" alt="Profile Image" class="profile-image">
                    <div class="user-info">
                        <h3><?= esc($user['name']) ?></h3>
                        <p><strong>Email:</strong> <?= esc($user['email']) ?></p>
                        <p><strong>Phone:</strong> <?= esc($user['phone']) ?></p>
                        <p><strong>Address:</strong> <?= esc($user['address']) ?></p>
                        <p><strong>Gender:</strong> <?= esc($user['gender']) ?></p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" onclick="closeModal('viewUserModal<?= $user['id'] ?>')">Close</button>
                    </div>
                </div>
            </div>

            <!-- Edit User Modal -->
            <div class="modal" id="editUserModal<?= $user['id'] ?>">
                <div class="modal-content">
                    <span class="close" onclick="closeModal('editUserModal<?= $user['id'] ?>')">&times;</span>
                    <h3>Edit User</h3>
                    <form action="<?= base_url('admin/editUser/' . $user['id']) ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="<?= esc($user['name']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" value="<?= esc($user['email']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" value="<?= esc($user['phone']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" name="address" value="<?= esc($user['address']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select name="gender" required>
                                <option value="male" <?= ($user['gender'] == 'male') ? 'selected' : '' ?>>Male</option>
                                <option value="female" <?= ($user['gender'] == 'female') ? 'selected' : '' ?>>Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image">Profile Image (optional)</label>
                            <input type="file" name="image" accept="image/*">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" onclick="closeModal('editUserModal<?= $user['id'] ?>')">Close</button>
                            <button type="submit" class="btn btn-primary">Update User</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    function openModal(modalId) {
        document.getElementById(modalId).style.display = "block";
        document.body.style.overflow = "hidden";
    }

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = "none";
        document.body.style.overflow = "auto";
    }

    window.onclick = function(event) {
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            if (event.target === modal) {
                modal.style.display = "none";
                document.body.style.overflow = "auto";
            }
        });
    }
</script>

<?= $this->endSection() ?>