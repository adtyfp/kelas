<?php
require_once 'koneksi.php';
session_start();

$errors = [];
$success_message = "";
$active_tab = 'login';

// Redirect jika sudah login
if (isset($_SESSION['user_id'])) {
    header('Location: home.php');
    exit();
}

// Handle form POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // === LOGIN ===
    if ($_POST['action'] === 'login') {
        $email_nim = trim($_POST['email_nim']);
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? OR nim = ?");
        $stmt->execute([$email_nim, $email_nim]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Simpan ke session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];

            // Simpan ke cookie (24 jam)
            setcookie('user_id', $user['id'], time() + (86400), "/");
            setcookie('user_name', $user['name'], time() + (86400), "/");

            header('Location: home.php');
            exit();
        } else {
            $errors['login'] = "Email/NIM atau password salah.";
            $active_tab = 'login';
        }
    }

    // === REGISTER ===
    if ($_POST['action'] === 'register') {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $nim = trim($_POST['nim']);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Validasi
        if (empty($name))
            $errors['name'] = "Nama wajib diisi";
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL))
            $errors['email'] = "Email tidak valid";
        if (empty($nim))
            $errors['nim'] = "NIM wajib diisi";
        if (strlen($password) < 8)
            $errors['password'] = "Password minimal 8 karakter";
        if ($password !== $confirm_password)
            $errors['confirm_password'] = "Konfirmasi password tidak cocok";

        // Cek duplikat
        $check = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ? OR nim = ?");
        $check->execute([$email, $nim]);
        if ($check->fetchColumn() > 0) {
            $errors['email'] = "Email atau NIM sudah terdaftar";
        }

        // Simpan jika lolos validasi
        if (empty($errors)) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $insert = $pdo->prepare("INSERT INTO users (name, email, nim, password) VALUES (?, ?, ?, ?)");
            $insert->execute([$name, $email, $nim, $hash]);

            $success_message = "Registrasi berhasil. Silakan login.";
            $active_tab = 'login';
        } else {
            $active_tab = 'register';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kelas Virtual - Login/Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="css/login.css" />
</head>

<body>
    <div class="auth-container">
        <!-- Tab Navigation -->
        <div class="tabs-container">
            <div class="tabs">
                <div class="tab active" data-tab="login">Login</div>
                <div class="tab" data-tab="register">Register</div>
            </div>
        </div>

        <!-- Logo -->
        <div class="logo-container" id="logo-container">
            <img src="asset/kelas.png" alt="Kelas Virtual" />
        </div>

        <!-- Forms -->
        <div class="forms-wrapper" id="forms-wrapper">
            <!-- Login Form -->
            <div class="form-container">
                <div class="form-wrapper">
                    <h2>Login di Sini</h2>
                    <p>Selamat Datang Kembali</p>
                </div>
                <!-- LOGIN FORM -->
                <form method="POST">
                    <input type="hidden" name="action" value="login" />

                    <div class="input-group">
                        <label for="email_nim">Email/NIM</label>
                        <input type="text" id="email_nim" name="email_nim" required />
                    </div>

                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required />
                    </div>

                    <div class="remember-me">
                        <input type="checkbox" id="remember_me" name="remember_me" />
                        <label for="remember_me">Ingatkan saya</label>
                    </div>

                    <button type="submit" class="btn">Login</button>
                </form>
            </div>

            <!-- Register Form -->
            <div class="form-container">
                <div class="form-wrapper">
                    <h2>Registrasi</h2>
                    <p>Selamat Datang</p>
                </div>
                <form method="POST">
                    <input type="hidden" name="action" value="register" />

                    <div class="input-group">
                        <label for="full_name">Nama Lengkap</label>
                        <input type="text" id="full_name" name="name" required />
                    </div>

                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required />
                    </div>

                    <div class="input-group">
                        <label for="nim">NIM</label>
                        <input type="text" id="nim" name="nim" required />
                    </div>

                    <div class="input-group">
                        <label for="reg_password">Password</label>
                        <input type="password" id="reg_password" name="password" required />
                    </div>

                    <div class="input-group">
                        <label for="confirm_password">Konfirmasi Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" required />
                    </div>

                    <div class="remember-me">
                        <input type="checkbox" id="agree_terms" required />
                        <label for="agree_terms">Saya menyetujui syarat dan ketentuan</label>
                    </div>

                    <button type="submit" class="btn">Registrasi</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get all required elements
            const formsWrapper = document.getElementById('forms-wrapper');
            const logoContainer = document.getElementById('logo-container');
            const loginTab = document.querySelector('.tab[data-tab="login"]');
            const registerTab = document.querySelector('.tab[data-tab="register"]');
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');

            // Animation settings
            const animationDuration = 500;
            const easingFunction = 'cubic-bezier(0.4, 0, 0.2, 1)';

            // Initialize based on PHP state
            <?php if ($active_tab === 'register'): ?>
                setTimeout(() => {
                    activateTab('register', false); // Initialize without animation
                }, 50);
            <?php endif; ?>

            // Tab click handlers
            loginTab.addEventListener('click', function (e) {
                e.preventDefault();
                if (!this.classList.contains('active')) {
                    activateTab('login');
                }
            });

            registerTab.addEventListener('click', function (e) {
                e.preventDefault();
                if (!this.classList.contains('active')) {
                    activateTab('register');
                }
            });

            // Main tab activation function
            function activateTab(tabName, animate = true) {
                // Set transition properties if animating
                if (animate) {
                    formsWrapper.style.transition = `transform ${animationDuration}ms ${easingFunction}`;
                    logoContainer.style.transition = `opacity ${animationDuration}ms ${easingFunction}`;
                } else {
                    formsWrapper.style.transition = 'none';
                    logoContainer.style.transition = 'none';
                }

                if (tabName === 'register') {
                    // Switch to register
                    formsWrapper.classList.add('slide');
                    logoContainer.classList.add('hidden');

                    // Update tab states
                    loginTab.classList.remove('active');
                    registerTab.classList.add('active');

                    // Add visual feedback
                    registerTab.style.transform = 'translateY(-2px)';
                    registerTab.style.boxShadow = '0 4px 8px rgba(0,0,0,0.1)';
                    loginTab.style.transform = '';
                    loginTab.style.boxShadow = 'none';
                } else {
                    // Switch to login
                    formsWrapper.classList.remove('slide');
                    logoContainer.classList.remove('hidden');

                    // Update tab states
                    registerTab.classList.remove('active');
                    loginTab.classList.add('active');

                    // Add visual feedback
                    loginTab.style.transform = 'translateY(-2px)';
                    loginTab.style.boxShadow = '0 4px 8px rgba(0,0,0,0.1)';
                    registerTab.style.transform = '';
                    registerTab.style.boxShadow = 'none';
                }

                // Reset transitions after animation completes
                if (animate) {
                    setTimeout(() => {
                        formsWrapper.style.transition = '';
                        logoContainer.style.transition = '';
                    }, animationDuration);
                }
            }

            // Add hover effects to tabs
            [loginTab, registerTab].forEach(tab => {
                tab.addEventListener('mouseenter', () => {
                    if (!tab.classList.contains('active')) {
                        tab.style.transform = 'translateY(-2px)';
                        tab.style.transition = 'transform 0.2s ease';
                    }
                });

                tab.addEventListener('mouseleave', () => {
                    if (!tab.classList.contains('active')) {
                        tab.style.transform = '';
                    }
                });
            });

            // Add ripple effect to buttons
            document.querySelectorAll('.btn').forEach(btn => {
                btn.addEventListener('click', function (e) {
                    // Remove existing ripples
                    const existingRipples = this.querySelectorAll('.ripple');
                    existingRipples.forEach(ripple => ripple.remove());

                    // Create new ripple
                    const ripple = document.createElement('span');
                    ripple.classList.add('ripple');

                    // Position ripple
                    const rect = this.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;

                    ripple.style.left = `${x}px`;
                    ripple.style.top = `${y}px`;

                    this.appendChild(ripple);

                    // Remove ripple after animation
                    setTimeout(() => {
                        ripple.remove();
                    }, 800);
                });
            });
        });

        // Add ripple effect styles
        const rippleStyle = document.createElement('style');
        rippleStyle.textContent = `
    .ripple {
        position: absolute;
        width: 20px;
        height: 20px;
        background: rgba(255, 255, 255, 0.4);
        border-radius: 50%;
        transform: scale(0);
        animation: ripple 0.6s linear;
        pointer-events: none;
    }
    
    @keyframes ripple {
        to {
            transform: scale(10);
            opacity: 0;
        }
    }
`;
        document.head.appendChild(rippleStyle);
    </script>
</body>

</html>