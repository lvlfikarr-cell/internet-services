@extends('layouts.app')

@section('content')

<style>
    /* HIDE EVERYTHING EXCEPT LOGIN CONTENT */
    body {
        padding: 0 !important;
        margin: 0 !important;
        overflow-x: hidden !important;
    }
    
    .navbar {
        display: none !important;
    }
    
    /* Remove all container padding */
    .container, .container-fluid {
        padding-left: 0 !important;
        padding-right: 0 !important;
        max-width: 100% !important;
    }
    
    .row {
        margin-left: 0 !important;
        margin-right: 0 !important;
    }
    
    .col-lg-5, .col-md-7, .col-sm-9 {
        padding-left: 0 !important;
        padding-right: 0 !important;
    }
    
    /* Make login container full width */
    .login-container {
        width: 100vw !important;
        min-height: 100vh !important;
        margin: 0 !important;
        padding: 20px !important;
        background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%) !important;
    }
    
    /* Center content properly */
    .justify-content-center {
        justify-content: center !important;
    }
    
    .align-items-center {
        align-items: center !important;
    }
</style>

<div class="login-container d-flex align-items-center justify-content-center">
    <div class="container-fluid px-0">
        <div class="row justify-content-center mx-0">
            <div class="col-xxl-3 col-xl-4 col-lg-5 col-md-6 col-sm-8 col-12 px-3">
                <!-- Logo Section -->
                <div class="text-center mb-5">
                    <div class="logo-icon mx-auto mb-3">
                        <i class="fas fa-network-wired"></i>
                    </div>
                    <h1 class="logo-title mb-2">Aplikasi Internet Services</h1>
                    <p class="logo-subtitle">Masuk dan nikmati layanan internet kami</p>
                </div>

                <!-- Login Card -->
                <div class="login-card">
                    <!-- Session Status & Errors -->
                    @if(session('error'))
                        <div class="alert alert-custom alert-danger-custom mb-4" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-custom alert-danger-custom mb-4" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" id="loginForm">
                        @csrf
                        
                        <!-- Username Input -->
                        <div class="mb-4">
                            <label for="username" class="form-label">
                                Username
                            </label>
                            <div class="input-group input-group-hover">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-user text-muted"></i>
                                </span>
                                <input type="text" 
                                       name="username" 
                                       id="username"
                                       class="form-control @error('username') is-invalid @enderror" 
                                       placeholder="Masukkan username"
                                       value="{{ old('username') }}"
                                       required 
                                       autofocus>
                            </div>
                            @error('username')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password Input -->
                        <div class="mb-4">
                            <label for="password" class="form-label">
                                Password
                            </label>
                            <div class="input-group input-group-hover position-relative">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-lock text-muted"></i>
                                </span>
                                <input type="password" 
                                       name="password" 
                                       id="password"
                                       class="form-control pe-5 @error('password') is-invalid @enderror" 
                                       placeholder="Masukkan password"
                                       required>
                                <button type="button" class="btn password-toggle-btn position-absolute end-0 top-50 translate-middle-y me-3" id="passwordToggle">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input type="checkbox" 
                                       class="form-check-input" 
                                       id="remember" 
                                       name="remember">
                                <label class="form-check-label" for="remember">
                                    Ingat saya
                                </label>
                            </div>
                            
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="forgot-link">
                                    Lupa password?
                                </a>
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-login w-100 mb-4">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </button>

                        <!-- Divider -->
                        <div class="divider d-flex align-items-center my-4">
                            <div class="divider-line flex-grow-1"></div>
                            <div class="divider-text px-3">atau</div>
                            <div class="divider-line flex-grow-1"></div>
                        </div>

                        <!-- Create Account Link -->
                        <div class="text-center">
                            <p class="mb-0">Belum punya akun?</p>
                            <a href="{{ route('register') }}" class="btn btn-register mt-2">
                                <i class="fas fa-user-plus me-2"></i>Buat Akun Baru
                            </a>
                        </div>
                        <div class="text-center mt-3">
                            <a href="{{ route('google.login') }}" class="btn btn-outline-danger mt-2">
                                    <class="flex items-center justify-center gap-3 w-full border border-gray-300 rounded-lg py-2 hover:bg-gray-50 transition">

                                    {{-- Logo Google --}}
                                    <svg width="20" height="20" viewBox="0 0 48 48">
                                        <path fill="#EA4335" d="M24 9.5c3.54 0 6.67 1.22 9.16 3.6l6.82-6.82C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.13 17.74 9.5 24 9.5z"/>
                                        <path fill="#4285F4" d="M46.98 24.55c0-1.57-.14-3.09-.4-4.55H24v9.02h12.97c-.56 3.02-2.26 5.58-4.8 7.3l7.36 5.72C43.9 38.28 46.98 31.9 46.98 24.55z"/>
                                        <path fill="#FBBC05" d="M10.54 28.59c-.48-1.43-.76-2.96-.76-4.59s.28-3.16.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.98-6.19z"/>
                                        <path fill="#34A853" d="M24 48c6.48 0 11.9-2.13 15.86-5.78l-7.36-5.72c-2.05 1.38-4.67 2.2-8.5 2.2-6.26 0-11.57-3.63-13.46-8.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
                                    </svg>

                                    <span class="font-medium text-gray-700">
                                        Sign in with Google
                                    </span>
                            </a>
                    </form>
                </div>

                
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-color: #4361ee;
        --primary-dark: #3a56d4;
        --secondary-color: #7209b7;
        --light-color: #f8f9fa;
        --dark-color: #212529;
        --gray-color: #6c757d;
        --light-gray: #e9ecef;
        --success-color: #4cc9f0;
        --card-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
        --hover-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        --gradient-primary: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    }

    /* Reset body styles */
    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%) !important;
        min-height: 100vh;
        width: 100vw;
        overflow-x: hidden;
    }

    .logo-icon {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        background: var(--gradient-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2.2rem;
        box-shadow: 0 8px 25px rgba(67, 97, 238, 0.3);
        margin-bottom: 25px;
        transition: transform 0.3s ease;
    }

    .logo-icon:hover {
        transform: scale(1.05);
    }

    .logo-title {
        font-size: 2rem;
        font-weight: 700;
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 10px;
    }

    .logo-subtitle {
        font-size: 1rem;
        color: var(--gray-color);
        font-weight: 400;
        opacity: 0.8;
    }

    .login-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 50px;
        box-shadow: var(--card-shadow);
        border: 1px solid rgba(255, 255, 255, 0.2);
        width: 100%;
        animation: fadeInUp 0.8s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .form-label {
        font-weight: 600;
        color: var(--dark-color);
        margin-bottom: 10px;
        font-size: 1rem;
        display: flex;
        align-items: center;
    }

    /* INPUT GROUP STYLING - DIUBAH! */
    .input-group {
        transition: all 0.3s ease;
        border-radius: 12px;
        overflow: hidden;
    }

    .input-group-hover {
        border: 2px solid var(--light-gray);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .input-group-hover:hover {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
    }

    .input-group-hover:focus-within {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
        transform: none; /* Tidak ada efek pop-up */
    }

    .form-control {
        border: none !important;
        padding: 14px 18px;
        font-size: 1rem;
        transition: all 0.3s ease;
        height: 52px;
        background: transparent !important;
    }

    .form-control:focus {
        border: none !important;
        box-shadow: none !important;
        outline: none !important;
        background: transparent !important;
        transform: none !important; /* Tidak ada efek pop-up */
    }

    .input-group-text {
        background-color: rgba(248, 249, 250, 0.8);
        border: none !important;
        color: var(--gray-color);
        padding: 0 20px;
        transition: all 0.3s ease;
    }

    .input-group-hover:hover .input-group-text,
    .input-group-hover:focus-within .input-group-text {
        color: var(--primary-color);
        background-color: rgba(67, 97, 238, 0.05);
    }

    .password-toggle-btn {
        background: transparent;
        border: none;
        color: var(--gray-color);
        z-index: 5;
        padding: 8px;
        transition: all 0.2s ease;
    }

    .password-toggle-btn:hover {
        color: var(--primary-color);
        transform: scale(1.1);
    }

    .btn-login {
        background: var(--gradient-primary);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 16px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        height: 56px;
        letter-spacing: 0.5px;
    }

    .btn-login:hover {
        background: linear-gradient(135deg, var(--primary-dark) 0%, #6411ad 100%);
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(67, 97, 238, 0.3);
        color: white;
    }

    .btn-register {
        background: transparent;
        color: var(--primary-color);
        border: 2px solid var(--primary-color);
        border-radius: 12px;
        padding: 12px 30px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .btn-register:hover {
        background: var(--primary-color);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(67, 97, 238, 0.2);
    }

    .forgot-link {
        color: var(--primary-color);
        text-decoration: none;
        font-size: 0.95rem;
        transition: all 0.2s ease;
        font-weight: 500;
    }

    .forgot-link:hover {
        color: var(--secondary-color);
        text-decoration: underline;
        transform: translateX(2px);
    }

    .back-link {
        color: var(--gray-color);
        text-decoration: none;
        font-size: 0.95rem;
        transition: all 0.2s ease;
        padding: 8px 16px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
    }

    .back-link:hover {
        color: var(--primary-color);
        background: rgba(67, 97, 238, 0.05);
        text-decoration: none;
        transform: translateX(-3px);
    }

    .divider {
        color: var(--gray-color);
        font-size: 0.95rem;
        margin: 30px 0;
    }

    .divider-line {
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--light-gray), transparent);
    }

    .divider-text {
        color: var(--gray-color);
        font-size: 0.9rem;
        opacity: 0.7;
        font-weight: 500;
    }

    .alert-custom {
        border-radius: 12px;
        border: none;
        padding: 18px;
        margin-bottom: 25px;
        font-size: 0.95rem;
        animation: slideIn 0.3s ease;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(-10px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .alert-danger-custom {
        background: linear-gradient(135deg, rgba(220, 53, 69, 0.1) 0%, rgba(220, 53, 69, 0.05) 100%);
        color: #721c24;
        border-left: 5px solid #dc3545;
        backdrop-filter: blur(5px);
    }

    /* Checkbox styling */
    .form-check-input {
        width: 1.1em;
        height: 1.1em;
        margin-top: 0.2em;
        border: 2px solid var(--light-gray);
        transition: all 0.2s ease;
    }

    .form-check-input:hover {
        border-color: var(--primary-color);
    }

    .form-check-input:checked {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .form-check-input:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
    }

    .form-check-label {
        color: var(--dark-color);
        font-weight: 500;
        font-size: 0.95rem;
        cursor: pointer;
        user-select: none;
        transition: color 0.2s ease;
    }

    .form-check-label:hover {
        color: var(--primary-color);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .login-container {
            padding: 15px !important;
        }
        
        .login-card {
            padding: 40px 30px;
            border-radius: 18px;
        }
        
        .logo-icon {
            width: 80px;
            height: 80px;
            font-size: 2rem;
        }
        
        .logo-title {
            font-size: 1.8rem;
        }
        
        .logo-subtitle {
            font-size: 0.95rem;
        }
        
        .btn-login {
            padding: 15px;
            font-size: 1.05rem;
            height: 54px;
        }
        
        .input-group-hover {
            border-width: 1.5px;
        }
    }

    @media (max-width: 576px) {
        .login-container {
            padding: 10px !important;
        }
        
        .login-card {
            padding: 35px 25px;
            border-radius: 16px;
        }
        
        .logo-icon {
            width: 70px;
            height: 70px;
            font-size: 1.8rem;
        }
        
        .logo-title {
            font-size: 1.6rem;
        }
        
        .logo-subtitle {
            font-size: 0.9rem;
        }
        
        .form-control {
            padding: 12px 15px;
            height: 50px;
        }
        
        .btn-login {
            padding: 14px;
            font-size: 1rem;
            height: 52px;
        }
        
        .btn-register {
            padding: 10px 25px;
            font-size: 0.95rem;
        }
        
        .input-group-hover {
            border-width: 1px;
        }
    }

    @media (max-width: 400px) {
        .login-card {
            padding: 30px 20px;
        }
        
        .logo-icon {
            width: 65px;
            height: 65px;
            font-size: 1.6rem;
        }
        
        .logo-title {
            font-size: 1.4rem;
        }
        
        .d-flex.justify-content-between {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
    }

    /* Force full width for mobile */
    @media (max-width: 576px) {
        .col-12 {
            width: 100% !important;
            max-width: 100% !important;
            flex: 0 0 100% !important;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Password toggle functionality
        const passwordInput = document.getElementById('password');
        const passwordToggle = document.getElementById('passwordToggle');
        
        passwordToggle.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            const icon = this.querySelector('i');
            if (type === 'password') {
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
            
            // Add click animation
            this.style.transform = 'translateY(-50%) scale(0.9)';
            setTimeout(() => {
                this.style.transform = 'translateY(-50%) scale(1)';
            }, 150);
        });
        
        // Auto focus username if empty
        if (!document.getElementById('username').value) {
            document.getElementById('username').focus();
        }
        
        // Smooth hover effect for input groups
        const inputGroups = document.querySelectorAll('.input-group-hover');
        inputGroups.forEach(group => {
            const input = group.querySelector('input');
            const icon = group.querySelector('.input-group-text i');
            
            input.addEventListener('focus', function() {
                group.style.borderColor = 'var(--primary-color)';
                group.style.boxShadow = '0 0 0 3px rgba(67, 97, 238, 0.15)';
                if (icon) {
                    icon.style.color = 'var(--primary-color)';
                }
            });
            
            input.addEventListener('blur', function() {
                group.style.borderColor = 'var(--light-gray)';
                group.style.boxShadow = 'none';
                if (icon) {
                    icon.style.color = 'var(--gray-color)';
                }
            });
        });
        
        // Add ripple effect to login button
        const loginBtn = document.querySelector('.btn-login');
        if (loginBtn) {
            loginBtn.addEventListener('click', function(e) {
                const rect = this.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                const ripple = document.createElement('span');
                ripple.style.position = 'absolute';
                ripple.style.background = 'rgba(255, 255, 255, 0.4)';
                ripple.style.borderRadius = '50%';
                ripple.style.transform = 'scale(0)';
                ripple.style.animation = 'ripple 0.6s linear';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.style.width = ripple.style.height = '100px';
                
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
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
                .btn-login {
                    position: relative;
                    overflow: hidden;
                }
            `;
            document.head.appendChild(style);
        }
        
        // Form validation
        const form = document.getElementById('loginForm');
        if (form) {
            form.addEventListener('submit', function(e) {
                const username = document.getElementById('username').value.trim();
                const password = document.getElementById('password').value.trim();
                
                if (!username) {
                    e.preventDefault();
                    document.getElementById('username').focus();
                    return false;
                }
                
                if (!password) {
                    e.preventDefault();
                    document.getElementById('password').focus();
                    return false;
                }
                
                return true;
            });
        }
    });
</script>

<!-- Include Font Awesome if not already included in layout -->
@unless(view()->exists('layouts.includes.fontawesome'))
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endunless

<!-- Include Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
@endsection