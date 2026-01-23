<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'User Area - Internet Services')</title>
    
    <!-- Bootstrap CSS -->
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
            --card-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            --hover-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f8fafc;
            color: var(--dark-color);
            min-height: 100vh;
            padding-top: 80px; /* Space for fixed navbar */
        }

        /* Navbar Styling */
        .navbar-custom {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(255, 255, 255, 0.95) 100%);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border-bottom: 1px solid rgba(67, 97, 238, 0.1);
            padding: 0;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            height: 80px;
            transition: all 0.3s ease;
        }

        .navbar-custom.scrolled {
            height: 70px;
            box-shadow: 0 6px 30px rgba(0, 0, 0, 0.1);
        }

        .navbar-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 30px;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* Logo/Brand */
        .navbar-brand-custom {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: var(--dark-color);
            font-weight: 700;
            font-size: 1.5rem;
            transition: all 0.3s ease;
            padding: 10px 0;
        }

        .navbar-brand-custom:hover {
            color: var(--primary-color);
            transform: translateY(-1px);
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            color: white;
            font-size: 1.2rem;
            box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
            transition: all 0.3s ease;
        }

        .navbar-brand-custom:hover .logo-icon {
            transform: scale(1.05) rotate(5deg);
            box-shadow: 0 6px 20px rgba(67, 97, 238, 0.4);
        }

        .brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .brand-main {
            font-weight: 700;
            font-size: 1.3rem;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .brand-sub {
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--gray-color);
            letter-spacing: 0.5px;
            margin-top: 2px;
        }

        /* User Dropdown */
        .user-dropdown {
            position: relative;
        }

        .dropdown-toggle-custom {
            background: white;
            border: 2px solid var(--light-gray);
            border-radius: 12px;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
            color: var(--dark-color);
            transition: all 0.3s ease;
            text-decoration: none;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
        }

        .dropdown-toggle-custom:hover {
            background: rgba(67, 97, 238, 0.05);
            border-color: var(--primary-color);
            color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(67, 97, 238, 0.15);
        }

        .dropdown-toggle-custom:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
            flex-shrink: 0;
            box-shadow: 0 3px 10px rgba(67, 97, 238, 0.2);
        }

        .user-info {
            text-align: left;
            flex-grow: 1;
        }

        .user-name {
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--dark-color);
            display: block;
            line-height: 1.2;
        }

        .user-role {
            font-size: 0.75rem;
            color: var(--gray-color);
            font-weight: 500;
            display: block;
            line-height: 1.2;
        }

        .dropdown-arrow {
            font-size: 0.8rem;
            color: var(--gray-color);
            transition: transform 0.3s ease;
        }

        .user-dropdown.show .dropdown-arrow {
            transform: rotate(180deg);
            color: var(--primary-color);
        }

        /* Dropdown Menu */
        .dropdown-menu-custom {
            background: white;
            border: none;
            border-radius: 12px;
            box-shadow: var(--hover-shadow);
            padding: 15px 0;
            margin-top: 10px;
            border: 1px solid var(--light-gray);
            min-width: 250px;
            animation: dropdownFade 0.2s ease;
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            z-index: 1000;
        }

        .user-dropdown.show .dropdown-menu-custom {
            display: block;
        }

        @keyframes dropdownFade {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dropdown-item-custom {
            padding: 12px 25px;
            color: var(--dark-color);
            font-weight: 500;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.2s ease;
            text-decoration: none;
            border-left: 3px solid transparent;
            cursor: pointer;
            width: 100%;
            background: none;
            border: none;
            text-align: left;
        }

        .dropdown-item-custom:hover {
            background: rgba(67, 97, 238, 0.05);
            color: var(--primary-color);
            border-left-color: var(--primary-color);
            padding-left: 28px;
        }

        .dropdown-item-custom i {
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }

        .dropdown-divider-custom {
            margin: 10px 25px;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--light-gray), transparent);
            border: none;
        }

        /* Logout Form */
        .logout-form {
            margin: 0;
            width: 100%;
        }

        .logout-btn {
            background: none;
            border: none;
            padding: 0;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }

        .dropdown-item-custom.logout {
            color: #dc3545;
        }

        .dropdown-item-custom.logout:hover {
            background: rgba(220, 53, 69, 0.05);
            color: #dc3545;
            border-left-color: #dc3545;
        }

        /* Main Content */
        .main-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 30px;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .navbar-container {
                padding: 0 20px;
            }
            
            .brand-main {
                font-size: 1.2rem;
            }
            
            .dropdown-toggle-custom {
                padding: 8px 16px;
            }
            
            .user-name {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 768px) {
            body {
                padding-top: 70px;
            }
            
            .navbar-custom {
                height: 70px;
            }
            
            .navbar-container {
                padding: 0 15px;
            }
            
            .brand-text {
                display: none;
            }
            
            .logo-icon {
                margin-right: 0;
                width: 36px;
                height: 36px;
                font-size: 1rem;
            }
            
            .user-info {
                display: none;
            }
            
            .dropdown-toggle-custom {
                padding: 8px 12px;
                gap: 8px;
            }
            
            .user-avatar {
                width: 32px;
                height: 32px;
                font-size: 0.8rem;
            }
            
            .dropdown-menu-custom {
                min-width: 220px;
            }
            
            .main-container {
                padding: 20px 15px;
            }
        }

        @media (max-width: 576px) {
            .navbar-custom {
                height: 65px;
            }
            
            body {
                padding-top: 65px;
            }
            
            .dropdown-menu-custom {
                min-width: 200px;
                right: 10px !important;
                left: auto !important;
            }
            
            .main-container {
                padding: 15px 10px;
            }
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--light-gray);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, var(--primary-dark) 0%, #6411ad 100%);
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar-custom">
        <div class="navbar-container">
            <!-- Logo/Brand -->
            <a class="navbar-brand-custom" href="{{ route('transaksi.index') }}">
                <div class="logo-icon">
                    <i class="fas fa-wifi"></i>
                </div>
                <div class="brand-text">
                    <span class="brand-main">Internet Services</span>
                    <span class="brand-sub">USER AREA</span>
                </div>
            </a>

            <!-- User Dropdown -->
            <div class="user-dropdown" id="userDropdownContainer">
                <button class="dropdown-toggle-custom" type="button" id="userDropdownBtn">
                    <div class="user-avatar">
                        {{ strtoupper(substr(session('user_name'), 0, 1)) }}
                    </div>
                    <div class="user-info">
                        <span class="user-name">{{ session('user_name') }}</span>
                        <span class="user-role">Pelanggan</span>
                    </div>
                    <i class="fas fa-chevron-down dropdown-arrow"></i>
                </button>

                <div class="dropdown-menu-custom" id="userDropdownMenu">
                    <a class="dropdown-item-custom" href="{{ route('transaksi.index') }}">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                    <a class="dropdown-item-custom" href="{{ route('riwayat.index') }}">
                        <i class="fas fa-history"></i>
                        <span>Riwayat Langganan</span>
                    </a>
                    <a class="dropdown-item-custom" href="#">
                        <i class="fas fa-cog"></i>
                        <span>Pengaturan Akun</span>
                    </a>
                    <div class="dropdown-divider-custom"></div>
                    <form action="{{ route('logout') }}" method="POST" class="logout-form">
                        @csrf
                        <button type="submit" class="dropdown-item-custom logout">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-container">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navbar = document.querySelector('.navbar-custom');
            const dropdownContainer = document.querySelector('#userDropdownContainer');
            const dropdownBtn = document.querySelector('#userDropdownBtn');
            const dropdownMenu = document.querySelector('#userDropdownMenu');
            
            // Navbar scroll effect
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });
            
            // Toggle dropdown manually
            dropdownBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                dropdownContainer.classList.toggle('show');
                
                // Position dropdown
                const rect = dropdownBtn.getBoundingClientRect();
                dropdownMenu.style.top = `${rect.bottom + 10}px`;
                dropdownMenu.style.right = `${window.innerWidth - rect.right}px`;
                
                // Add ripple effect
                const ripple = document.createElement('span');
                ripple.style.position = 'absolute';
                ripple.style.background = 'rgba(67, 97, 238, 0.2)';
                ripple.style.borderRadius = '50%';
                ripple.style.transform = 'scale(0)';
                ripple.style.animation = 'ripple 0.6s linear';
                ripple.style.left = (e.clientX - rect.left) + 'px';
                ripple.style.top = (e.clientY - rect.top) + 'px';
                ripple.style.width = ripple.style.height = '100px';
                ripple.style.pointerEvents = 'none';
                
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!dropdownContainer.contains(e.target)) {
                    dropdownContainer.classList.remove('show');
                }
            });
            
            // Close dropdown when pressing Escape
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    dropdownContainer.classList.remove('show');
                }
            });
            
            // Smooth dropdown animation
            dropdownContainer.addEventListener('click', function(e) {
                if (e.target === dropdownBtn) {
                    dropdownBtn.style.transform = dropdownContainer.classList.contains('show') 
                        ? 'translateY(-2px)' 
                        : 'translateY(0)';
                    dropdownBtn.style.boxShadow = dropdownContainer.classList.contains('show')
                        ? '0 4px 15px rgba(67, 97, 238, 0.2)'
                        : '0 2px 10px rgba(0, 0, 0, 0.05)';
                }
            });
            
            // Add CSS for ripple effect
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
            
            // Initialize scroll effect
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>