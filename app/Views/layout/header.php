<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Earl Garahe Car Trading</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

    <!-- Custom CSS link -->
    <link rel="stylesheet" href="<?= base_url('/css/home.css') ?>">


    <!-- Google Font link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
<header class="header" data-header>
    <div class="container">
        <div class="overlay" data-overlay></div>
        <a href="/home" class="logo">
        <img src="<?= base_url('/images/IMAHE.jpg') ?>" alt="Earl Garahe Car Trading Logo">
        </a>

        <nav class="navbar" data-navbar>
            <ul class="navbar-list">
                <li>
                    <a href="/home" class="navbar-link" data-nav-link>Home</a>
                </li>
                <li>
                    <?php if (session()->has('user_id')) : ?>
                        <a href="/carslist" class="navbar-link" data-nav-link>Cars</a>
                    <?php else : ?>
                        <a href="/signin" class="navbar-link" data-nav-link>Cars</a>
                    <?php endif; ?>
                </li>

                <?php if (!session()->get('isLoggedIn')) : ?>
                    <li>
                        <a href="#getstart" class="navbar-link" data-nav-link>Get Started</a>
                    </li>
                <?php endif; ?>
                <li>
                    <a href="/contact" class="navbar-link" data-nav-link>Contact</a>
                </li>
            </ul>
        </nav>

        <div class="header-actions">
            <div class="header-contact">
                <a href="tel:88002345678" class="contact-link">8 800 234 56 78</a>
                <span class="contact-time">Mon - Sat: 9:00 am - 8:00 pm</span>
            </div>

            
            <div class="icons" style="display: flex; align-items: center;">
                <!-- History dropdown -->
                <div class="dropdown" style="position: relative; display: inline-block; margin-right: 10px;">
                    <a href="#" class="history-icon" aria-label="History" onclick="toggleHistoryDropdown(event)">
                        <ion-icon name="time-outline" style="font-size: 24px; color: white;"></ion-icon>
                    </a>
                    <div id="historyDropdown" class="dropdown-content" style="display: none; position: absolute; background-color: #f9f9f9; min-width: 160px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); z-index: 1; right: 0; border-radius: 4px;">
                        <a href="/historia" style="color: black; padding: 12px 16px; text-decoration: none; display: block;">Booking History</a>
                        <a href="/History" style="color: black; padding: 12px 16px; text-decoration: none; display: block;">Purchase History</a>
                    </div>
                </div>

                <a href="#" class="notification-icon" aria-label="Notifications" style="margin-right: 10px;">
                    <ion-icon name="notifications-outline" style="font-size: 24px; color: white;"></ion-icon>
                </a>
                
                <a href="/profs" class="profile-icon" aria-label="Profile" style="margin-right: 10px;">
                    <i class="fas fa-user-circle" style="font-size: 24px; color: white;"></i>
                </a>
                
                <a href="/user/logout" class="logout-icon" aria-label="Logout" onclick="confirmLogout(event)" style="color: white;">
                    <i class="fas fa-sign-out-alt" style="font-size: 24px;"></i>
                </a>
            </div>
        </div>
    </div>
</header>

<style>
.dropdown-content {
    background-color: white;
    border: 1px solid #ddd;
    border-radius: 4px;
    margin-top: 5px;
}

.dropdown-content a:hover {
    background-color: #f1f1f1;
}

/* Animation for dropdown */
.dropdown-content.show {
    animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}
@media (max-width: 991px) {
    .header .container {
        padding: 0 15px;
    }

    .nav-toggle-btn {
        display: block;
        background: none;
        border: none;
        font-size: 1.9rem;
        cursor: pointer;
        color: var(--white);
    }

    .nav-toggle-btn span {
        display: block;
        width: 25px;
        height: 2px;
        background-color: var(--white);
        margin: 5px 0;
        transition: all 0.3s ease;
    }

    .nav-toggle-btn.active span:nth-child(1) {
        transform: rotate(45deg) translate(5px, 5px);
    }

    .nav-toggle-btn.active span:nth-child(2) {
        opacity: 0;
    }

    .nav-toggle-btn.active span:nth-child(3) {
        transform: rotate(-45deg) translate(5px, -5px);
    }

    .navbar {
        position: fixed;
        top: 70px;
        left: -100%;
        width: 80%;
        max-width: 300px;
        height: calc(100vh - 70px);
        background-color: var(--eerie-black);
        transition: left 0.3s ease;
        overflow-y: auto;
        z-index: 1000;
    }

    .navbar.active {
        left: 0;
    }

    .navbar-list {
        flex-direction: column;
        padding: 20px;
    }

    .navbar-link {
        display: block;
        padding: 10px 0;
        color: var(--white);
    }

    .overlay {
        position: fixed;
        top: 70px;
        left: 0;
        width: 100%;
        height: calc(100vh - 70px);
        background-color: rgba(0, 0, 0, 0.5);
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }

    .overlay.active {
        opacity: 1;
        visibility: visible;
    }
}

@media (min-width: 992px) {
    .nav-toggle-btn {
        display: none;
    }

    .navbar {
        position: static;
        width: auto;
        height: auto;
        background-color: transparent;
    }

    .navbar-list {
        display: flex;
        gap: 20px;
    }
}
</style>

<script>
function toggleHistoryDropdown(event) {
    event.preventDefault();
    const dropdown = document.getElementById('historyDropdown');
    const isDisplayed = dropdown.style.display === 'block';
    
    // Close any other open dropdowns if needed
    const allDropdowns = document.getElementsByClassName('dropdown-content');
    for (let i = 0; i < allDropdowns.length; i++) {
        allDropdowns[i].style.display = 'none';
    }
    
    // Toggle current dropdown
    dropdown.style.display = isDisplayed ? 'none' : 'block';
    
    // Add show class for animation
    if (!isDisplayed) {
        dropdown.classList.add('show');
    }
}

// Close dropdown when clicking outside
window.onclick = function(event) {
    if (!event.target.matches('.history-icon') && !event.target.matches('ion-icon')) {
        const dropdowns = document.getElementsByClassName('dropdown-content');
        for (let i = 0; i < dropdowns.length; i++) {
            dropdowns[i].style.display = 'none';
        }
    }
}
document.addEventListener('DOMContentLoaded', function() {
    const navToggleBtn = document.querySelector('.nav-toggle-btn');
    const navbar = document.querySelector('.navbar');
    const overlay = document.querySelector('.overlay');

    navToggleBtn.addEventListener('click', function() {
        this.classList.toggle('active');
        navbar.classList.toggle('active');
        overlay.classList.toggle('active');
        document.body.classList.toggle('no-scroll');
    });

    overlay.addEventListener('click', function() {
        navToggleBtn.classList.remove('active');
        navbar.classList.remove('active');
        this.classList.remove('active');
        document.body.classList.remove('no-scroll');
    });

    // Close menu when clicking on a nav link (for mobile)
    const navLinks = document.querySelectorAll('.navbar-link');
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            if (window.innerWidth < 992) {
                navToggleBtn.classList.remove('active');
                navbar.classList.remove('active');
                overlay.classList.remove('active');
                document.body.classList.remove('no-scroll');
            }
        });
    });

    // Handle resize events
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 992) {
            navToggleBtn.classList.remove('active');
            navbar.classList.remove('active');
            overlay.classList.remove('active');
            document.body.classList.remove('no-scroll');
        }
    });
});
</script>