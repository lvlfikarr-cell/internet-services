<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Selamat Datang - Internet Services</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #4361ee;
            --primary-dark: #3a56d4;
            --secondary-color: #7209b7;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --gray-color: #6c757d;
            --light-gray: #e9ecef;
            --card-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            --hover-shadow: 0 30px 80px rgba(0, 0, 0, 0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: var(--dark-color);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 80%, rgba(255,255,255,0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255,255,255,0.1) 0%, transparent 50%);
            z-index: -1;
        }

        /* Main Container */
        .welcome-container {
            width: 100%;
            max-width: 1200px;
            padding: 40px 20px;
            position: relative;
            z-index: 1;
            animation: fadeIn 1s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Welcome Card */
        .welcome-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            padding: 60px 40px;
            box-shadow: var(--card-shadow);
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .welcome-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--hover-shadow);
        }

        .welcome-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            border-radius: 30px 30px 0 0;
        }

        /* Logo & Brand */
        .welcome-logo {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border-radius: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            color: white;
            font-size: 3rem;
            box-shadow: 0 15px 40px rgba(67, 97, 238, 0.3);
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-15px);
            }
        }

        .brand-text {
            text-align: center;
            margin-bottom: 40px;
        }

        .brand-main {
            font-size: 3rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 10px;
            line-height: 1.2;
        }

        .brand-sub {
            font-size: 1.2rem;
            color: var(--gray-color);
            font-weight: 500;
            opacity: 0.9;
        }

        /* Welcome Content */
        .welcome-content {
            text-align: center;
            margin-bottom: 40px;
        }

        .welcome-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 20px;
            line-height: 1.3;
        }

        .welcome-subtitle {
            font-size: 1.2rem;
            color: var(--gray-color);
            max-width: 600px;
            margin: 0 auto 30px;
            line-height: 1.6;
            opacity: 0.9;
        }

        /* Features */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 50px;
        }

        .feature-card {
            background: white;
            border-radius: 20px;
            padding: 30px 25px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            border-radius: 18px;
            background: linear-gradient(135deg, rgba(67, 97, 238, 0.1) 0%, rgba(114, 9, 183, 0.1) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: var(--primary-color);
            font-size: 1.8rem;
        }

        .feature-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 10px;
        }

        .feature-desc {
            font-size: 0.95rem;
            color: var(--gray-color);
            line-height: 1.5;
        }

        /* Login Button */
        .login-section {
            text-align: center;
        }

        .btn-login {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border: none;
            border-radius: 15px;
            padding: 18px 40px;
            font-size: 1.2rem;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            box-shadow: 0 10px 30px rgba(67, 97, 238, 0.3);
            position: relative;
            overflow: hidden;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, var(--primary-dark) 0%, #6411ad 100%);
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(67, 97, 238, 0.4);
            color: white;
        }

        .btn-login:active {
            transform: translateY(-1px);
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn-login:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-login i {
            font-size: 1.4rem;
        }

        /* Footer */
        .welcome-footer {
            text-align: center;
            margin-top: 40px;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
        }

        .welcome-footer a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .welcome-footer a:hover {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: underline;
        }

        /* Decorative Elements */
        .decorative-dots {
            position: absolute;
            width: 100px;
            height: 100px;
            background-image: radial-gradient(rgba(255, 255, 255, 0.1) 2px, transparent 2px);
            background-size: 20px 20px;
            z-index: -1;
            opacity: 0.5;
        }

        .dot-1 {
            top: 10%;
            left: 10%;
        }

        .dot-2 {
            bottom: 10%;
            right: 10%;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .welcome-container {
                padding: 20px;
            }
            
            .welcome-card {
                padding: 40px 30px;
            }
            
            .brand-main {
                font-size: 2.5rem;
            }
            
            .welcome-title {
                font-size: 2rem;
            }
            
            .welcome-subtitle {
                font-size: 1.1rem;
            }
            
            .features-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .welcome-card {
                padding: 30px 20px;
                border-radius: 20px;
            }
            
            .welcome-logo {
                width: 100px;
                height: 100px;
                font-size: 2.5rem;
            }
            
            .brand-main {
                font-size: 2rem;
            }
            
            .brand-sub {
                font-size: 1rem;
            }
            
            .welcome-title {
                font-size: 1.8rem;
            }
            
            .welcome-subtitle {
                font-size: 1rem;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .feature-card {
                padding: 25px 20px;
            }
            
            .btn-login {
                padding: 16px 32px;
                font-size: 1.1rem;
            }
        }

        @media (max-width: 576px) {
            .welcome-container {
                padding: 15px;
            }
            
            .welcome-card {
                padding: 25px 15px;
            }
            
            .welcome-logo {
                width: 80px;
                height: 80px;
                font-size: 2rem;
                margin-bottom: 20px;
            }
            
            .brand-main {
                font-size: 1.8rem;
            }
            
            .brand-sub {
                font-size: 0.9rem;
            }
            
            .welcome-title {
                font-size: 1.5rem;
                margin-bottom: 15px;
            }
            
            .welcome-subtitle {
                font-size: 0.9rem;
                margin-bottom: 25px;
            }
            
            .feature-card {
                padding: 20px 15px;
            }
            
            .feature-icon {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
                margin-bottom: 15px;
            }
            
            .feature-title {
                font-size: 1.1rem;
            }
            
            .feature-desc {
                font-size: 0.85rem;
            }
            
            .btn-login {
                padding: 14px 28px;
                font-size: 1rem;
                width: 100%;
            }
        }

        /* Animation for feature cards */
        .feature-card {
            animation: slideUp 0.5s ease-out;
            animation-fill-mode: both;
        }

        .feature-card:nth-child(1) { animation-delay: 0.1s; }
        .feature-card:nth-child(2) { animation-delay: 0.2s; }
        .feature-card:nth-child(3) { animation-delay: 0.3s; }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <!-- Decorative Dots -->
    <div class="decorative-dots dot-1"></div>
    <div class="decorative-dots dot-2"></div>

    <div class="welcome-container">
        <div class="welcome-card">
            <!-- Logo -->
            <div class="welcome-logo">
                <i class="fas fa-wifi"></i>
            </div>

            <!-- Brand -->
            <div class="brand-text">
                <h1 class="brand-main">Internet Services</h1>
                <p class="brand-sub">Solusi Internet Terbaik untuk Anda</p>
            </div>

            <!-- Welcome Content -->
            <div class="welcome-content">
                <h2 class="welcome-title">Selamat Datang di Sistem Manajemen Layanan Internet</h2>
                <p class="welcome-subtitle">
                    Kelola data pelanggan, transaksi, dan riwayat langganan dengan sistem yang mudah, cepat, dan efisien.
                    Semua kebutuhan manajemen internet Anda dalam satu platform terintegrasi.
                </p>
            </div>

            <!-- Features -->
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="feature-title">Manajemen Pelanggan</h3>
                    <p class="feature-desc">
                        Kelola data pelanggan dengan mudah, pantau riwayat transaksi, dan berikan layanan terbaik.
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="feature-title">Analisis Data</h3>
                    <p class="feature-desc">
                        Pantau performa layanan dan pertumbuhan pelanggan dengan dashboard analitik yang lengkap.
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="feature-title">Keamanan Data</h3>
                    <p class="feature-desc">
                        Sistem keamanan terenkripsi untuk melindungi data penting Anda dan pelanggan.
                    </p>
                </div>
            </div>

            <!-- Login Section -->
            <div class="login-section">
                <a href="{{ route('login') }}" class="btn btn-login">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Masuk ke Dashboard</span>
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="welcome-footer">
            <p>© 2024 Internet Services. Hak Cipta Dilindungi.</p>
            <p>
                <a href="#privacy">Kebijakan Privasi</a> • 
                <a href="#terms">Syarat & Ketentuan</a> • 
                <a href="#contact">Hubungi Kami</a>
            </p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add ripple effect to login button
            const loginBtn = document.querySelector('.btn-login');
            loginBtn.addEventListener('click', function(e) {
                const rect = this.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                const ripple = document.createElement('span');
                ripple.style.position = 'absolute';
                ripple.style.borderRadius = '50%';
                ripple.style.background = 'rgba(255, 255, 255, 0.3)';
                ripple.style.transform = 'scale(0)';
                ripple.style.animation = 'ripple 0.6s linear';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.style.width = ripple.style.height = '0';
                ripple.style.pointerEvents = 'none';
                
                this.appendChild(ripple);
                
                // Animate ripple
                setTimeout(() => {
                    ripple.style.width = ripple.style.height = '300px';
                    ripple.style.opacity = '0';
                    ripple.style.left = (x - 150) + 'px';
                    ripple.style.top = (y - 150) + 'px';
                }, 10);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });

            // Add animation for features on scroll
            const observerOptions = {
                threshold: 0.2,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observe feature cards
            const featureCards = document.querySelectorAll('.feature-card');
            featureCards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });

            // Add CSS for ripple animation
            const style = document.createElement('style');
            style.textContent = `
                @keyframes ripple {
                    to {
                        transform: scale(4);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
        });
    </script>
</body>
</html>