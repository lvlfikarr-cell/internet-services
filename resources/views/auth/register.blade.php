@extends('layouts.app')

@section('content')

<style>
    /* HIDE EVERYTHING EXCEPT REGISTER CONTENT */
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
    
    .col-md-4, .col-lg-5, .col-md-6, .col-sm-8 {
        padding-left: 0 !important;
        padding-right: 0 !important;
    }
    
    /* Make register container full width */
    .register-container {
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

<div class="register-container d-flex align-items-center justify-content-center">
    <div class="container-fluid px-0">
        <div class="row justify-content-center mx-0">
            <div class="col-xxl-3 col-xl-4 col-lg-5 col-md-6 col-sm-8 col-12 px-3">
                <!-- Logo Section -->
                <div class="text-center mb-5">
                    <div class="logo-icon mx-auto mb-3">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <h1 class="logo-title mb-2">Buat Akun Baru</h1>
                    <p class="logo-subtitle">Daftar untuk mengakses layanan Internet kami</p>
                </div>

                <!-- Register Card -->
                <div class="register-card">
                    <!-- Validation Errors -->
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

                    <form method="POST" action="{{ route('register') }}" id="registerForm">
                        @csrf
                        
                        <!-- Nama Input -->
                        <div class="mb-4">
                            <label for="nama" class="form-label">
                                Nama
                            </label>
                            <div class="input-group input-group-hover">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-user text-muted"></i>
                                </span>
                                <input type="text" 
                                       name="nama" 
                                       id="nama"
                                       class="form-control @error('nama') is-invalid @enderror" 
                                       placeholder="Masukkan nama lengkap"
                                       value="{{ old('nama') }}"
                                       required 
                                       autofocus>
                            </div>
                            @error('nama')
                                <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Username Input -->
                        <div class="mb-4">
                            <label for="username" class="form-label">
                                Username
                            </label>
                            <div class="input-group input-group-hover">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-at text-muted"></i>
                                </span>
                                <input type="text" 
                                       name="username" 
                                       id="username"
                                       class="form-control @error('username') is-invalid @enderror" 
                                       placeholder="Masukkan username"
                                       value="{{ old('username') }}"
                                       required>
                            </div>
                            <div class="form-text text-muted mt-2" style="font-size: 0.85rem;">
                                <i class="fas fa-info-circle me-1"></i>Username hanya boleh mengandung huruf, angka, dan underscore.
                            </div>
                            @error('username')
                                <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
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
                                       placeholder="Masukkan password minimal 8 karakter"
                                       required>
                                <button type="button" class="btn password-toggle-btn position-absolute end-0 top-50 translate-middle-y me-3" id="passwordToggle">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            
                            <!-- Password Strength Indicator -->
                            <div class="password-strength mt-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <small class="text-muted">Kekuatan password:</small>
                                    <small class="text-muted" id="strengthText">Lemah</small>
                                </div>
                                <div class="progress" style="height: 6px;">
                                    <div id="passwordStrengthBar" class="progress-bar" role="progressbar" style="width: 0%; transition: width 0.3s ease;" 
                                         aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            
                            <!-- Password Requirements -->
                            <div class="password-requirements mt-3">
                                <small class="text-muted d-block mb-2">
                                    <i class="fas fa-shield-alt me-1"></i>Password harus mengandung:
                                </small>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="requirement" id="reqLength">
                                            <i class="fas fa-circle me-2"></i>
                                            <span>Min. 8 karakter</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="requirement" id="reqUppercase">
                                            <i class="fas fa-circle me-2"></i>
                                            <span>Huruf besar</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="requirement" id="reqLowercase">
                                            <i class="fas fa-circle me-2"></i>
                                            <span>Huruf kecil</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="requirement" id="reqNumber">
                                            <i class="fas fa-circle me-2"></i>
                                            <span>Angka</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            @error('password')
                                <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password Input -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">
                                Konfirmasi Password
                            </label>
                            <div class="input-group input-group-hover position-relative">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-lock text-muted"></i>
                                </span>
                                <input type="password" 
                                       name="password_confirmation" 
                                       id="password_confirmation"
                                       class="form-control pe-5 @error('password_confirmation') is-invalid @enderror" 
                                       placeholder="Ketik ulang password"
                                       required>
                                <button type="button" class="btn password-toggle-btn position-absolute end-0 top-50 translate-middle-y me-3" id="confirmPasswordToggle">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div id="passwordMatch" class="form-text mt-2" style="font-size: 0.85rem; display: none;">
                                <i class="fas fa-check-circle me-1"></i><span>Password cocok</span>
                            </div>
                            @error('password_confirmation')
                                <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Terms Agreement -->
                        <div class="mb-4">
                            <div class="form-check">
                                <input type="checkbox" 
                                       class="form-check-input" 
                                       id="terms" 
                                       name="terms"
                                       required>
                                <label class="form-check-label" for="terms" style="font-size: 0.9rem;">
                                    Saya menyetujui 
                                    <a href="#" class="terms-link">Syarat & Ketentuan</a> 
                                    dan 
                                    <a href="#" class="terms-link">Kebijakan Privasi</a>
                                </label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-register w-100 mb-4">
                            <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                        </button>

                        <!-- Divider -->
                        <div class="divider d-flex align-items-center my-4">
                            <div class="divider-line flex-grow-1"></div>
                            <div class="divider-text px-3">atau</div>
                            <div class="divider-line flex-grow-1"></div>
                        </div>

                        <!-- Login Link -->
                        <div class="text-center">
                            <p class="mb-0">Sudah punya akun?</p>
                            <a href="{{ route('login') }}" class="btn btn-login-alt mt-2">
                                <i class="fas fa-sign-in-alt me-2"></i>Masuk ke Akun
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Back to Home -->
                <div class="text-center mt-4">
                    <a href="{{ url('/') }}" class="back-link">
                        <i class="fas fa-arrow-left me-1"></i>Kembali ke Halaman Utama
                    </a>
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

    .register-card {
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

    /* INPUT GROUP STYLING */
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

    /* Password Strength */
    .password-strength .progress {
        background-color: var(--light-gray);
        border-radius: 3px;
        overflow: hidden;
    }

    .progress-bar {
        border-radius: 3px;
        transition: width 0.3s ease, background-color 0.3s ease;
    }

    .password-requirements .requirement {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
        font-size: 0.85rem;
        color: var(--gray-color);
        transition: color 0.3s ease;
    }

    .password-requirements .requirement.valid {
        color: #28a745;
    }

    .password-requirements .requirement.valid i {
        color: #28a745;
    }

    .password-requirements .requirement.invalid {
        color: var(--gray-color);
    }

    .password-requirements .requirement i {
        font-size: 0.6rem;
        transition: color 0.3s ease;
    }

    /* Button Styling */
    .btn-register {
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

    .btn-register:hover {
        background: linear-gradient(135deg, var(--primary-dark) 0%, #6411ad 100%);
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(67, 97, 238, 0.3);
        color: white;
    }

    .btn-login-alt {
        background: transparent;
        color: var(--primary-color);
        border: 2px solid var(--primary-color);
        border-radius: 12px;
        padding: 12px 30px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .btn-login-alt:hover {
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

    .terms-link {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 500;
        transition: color 0.2s ease;
    }

    .terms-link:hover {
        color: var(--secondary-color);
        text-decoration: underline;
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
        font-size: 0.9rem;
        cursor: pointer;
        user-select: none;
        transition: color 0.2s ease;
        line-height: 1.5;
    }

    .form-check-label:hover {
        color: var(--primary-color);
    }

    /* Password match indicator */
    #passwordMatch {
        color: #28a745;
        font-weight: 500;
    }

    #passwordMatch i {
        color: #28a745;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .register-container {
            padding: 15px !important;
        }
        
        .register-card {
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
        
        .btn-register {
            padding: 15px;
            font-size: 1.05rem;
            height: 54px;
        }
        
        .input-group-hover {
            border-width: 1.5px;
        }
        
        .password-requirements .row {
            margin-left: -5px;
            margin-right: -5px;
        }
        
        .password-requirements .col-6 {
            padding-left: 5px;
            padding-right: 5px;
        }
    }

    @media (max-width: 576px) {
        .register-container {
            padding: 10px !important;
        }
        
        .register-card {
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
        
        .btn-register {
            padding: 14px;
            font-size: 1rem;
            height: 52px;
        }
        
        .btn-login-alt {
            padding: 10px 25px;
            font-size: 0.95rem;
        }
        
        .input-group-hover {
            border-width: 1px;
        }
        
        .password-requirements .requirement {
            font-size: 0.8rem;
        }
    }

    @media (max-width: 400px) {
        .register-card {
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
        
        .password-requirements .row {
            flex-direction: column;
        }
        
        .password-requirements .col-6 {
            width: 100%;
            margin-bottom: 5px;
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
        const confirmPasswordInput = document.getElementById('password_confirmation');
        const confirmPasswordToggle = document.getElementById('confirmPasswordToggle');
        
        // Toggle password visibility
        function togglePasswordVisibility(input, toggleButton) {
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            
            const icon = toggleButton.querySelector('i');
            if (type === 'password') {
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
            
            // Add click animation
            toggleButton.style.transform = 'translateY(-50%) scale(0.9)';
            setTimeout(() => {
                toggleButton.style.transform = 'translateY(-50%) scale(1)';
            }, 150);
        }
        
        passwordToggle.addEventListener('click', function() {
            togglePasswordVisibility(passwordInput, this);
        });
        
        confirmPasswordToggle.addEventListener('click', function() {
            togglePasswordVisibility(confirmPasswordInput, this);
        });
        
        // Password strength checker
        const passwordStrengthBar = document.getElementById('passwordStrengthBar');
        const strengthText = document.getElementById('strengthText');
        const reqLength = document.getElementById('reqLength');
        const reqUppercase = document.getElementById('reqUppercase');
        const reqLowercase = document.getElementById('reqLowercase');
        const reqNumber = document.getElementById('reqNumber');
        const passwordMatch = document.getElementById('passwordMatch');
        
        function checkPasswordStrength(password) {
            let strength = 0;
            let totalCriteria = 4;
            let metCriteria = 0;
            
            // Check length
            if (password.length >= 8) {
                strength += 25;
                updateRequirement(reqLength, true);
                metCriteria++;
            } else {
                updateRequirement(reqLength, false);
            }
            
            // Check uppercase
            if (/[A-Z]/.test(password)) {
                strength += 25;
                updateRequirement(reqUppercase, true);
                metCriteria++;
            } else {
                updateRequirement(reqUppercase, false);
            }
            
            // Check lowercase
            if (/[a-z]/.test(password)) {
                strength += 25;
                updateRequirement(reqLowercase, true);
                metCriteria++;
            } else {
                updateRequirement(reqLowercase, false);
            }
            
            // Check number
            if (/[0-9]/.test(password)) {
                strength += 25;
                updateRequirement(reqNumber, true);
                metCriteria++;
            } else {
                updateRequirement(reqNumber, false);
            }
            
            // Update progress bar
            passwordStrengthBar.style.width = strength + '%';
            
            // Update color and text based on strength
            let color, text;
            if (metCriteria === 0 || password.length === 0) {
                color = '#dc3545';
                text = 'Lemah';
            } else if (metCriteria <= 2) {
                color = '#fd7e14';
                text = 'Cukup';
            } else if (metCriteria === 3) {
                color = '#ffc107';
                text = 'Baik';
            } else {
                color = '#28a745';
                text = 'Kuat';
            }
            
            passwordStrengthBar.style.backgroundColor = color;
            strengthText.textContent = text;
            strengthText.style.color = color;
        }
        
        function updateRequirement(element, isValid) {
            if (isValid) {
                element.classList.add('valid');
                element.classList.remove('invalid');
                const icon = element.querySelector('i');
                icon.className = 'fas fa-check-circle me-2';
                icon.style.color = '#28a745';
            } else {
                element.classList.add('invalid');
                element.classList.remove('valid');
                const icon = element.querySelector('i');
                icon.className = 'fas fa-circle me-2';
                icon.style.color = '';
            }
        }
        
        // Check password confirmation
        function checkPasswordMatch() {
            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;
            
            if (confirmPassword.length > 0) {
                if (password === confirmPassword) {
                    passwordMatch.style.display = 'block';
                    confirmPasswordInput.classList.remove('is-invalid');
                    confirmPasswordInput.classList.add('is-valid');
                } else {
                    passwordMatch.style.display = 'none';
                    confirmPasswordInput.classList.add('is-invalid');
                    confirmPasswordInput.classList.remove('is-valid');
                }
            } else {
                passwordMatch.style.display = 'none';
                confirmPasswordInput.classList.remove('is-invalid', 'is-valid');
            }
        }
        
        // Event listeners
        passwordInput.addEventListener('input', function() {
            checkPasswordStrength(this.value);
            checkPasswordMatch();
        });
        
        confirmPasswordInput.addEventListener('input', checkPasswordMatch);
        
        // Auto focus nama if empty
        if (!document.getElementById('nama').value) {
            document.getElementById('nama').focus();
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
                    icon.style.color = '';
                }
            });
        });
        
        // Add ripple effect to register button
        const registerBtn = document.querySelector('.btn-register');
        if (registerBtn) {
            registerBtn.addEventListener('click', function(e) {
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
                .btn-register {
                    position: relative;
                    overflow: hidden;
                }
            `;
            document.head.appendChild(style);
        }
        
        // Form validation
        const form = document.getElementById('registerForm');
        if (form) {
            form.addEventListener('submit', function(e) {
                const nama = document.getElementById('nama').value.trim();
                const username = document.getElementById('username').value.trim();
                const password = document.getElementById('password').value.trim();
                const confirmPassword = document.getElementById('password_confirmation').value.trim();
                const terms = document.getElementById('terms').checked;
                
                // Basic validation
                if (!nama) {
                    e.preventDefault();
                    alert('Nama lengkap harus diisi!');
                    document.getElementById('nama').focus();
                    return false;
                }
                
                if (!username) {
                    e.preventDefault();
                    alert('Username harus diisi!');
                    document.getElementById('username').focus();
                    return false;
                }
                
                if (password.length < 8) {
                    e.preventDefault();
                    alert('Password harus minimal 8 karakter!');
                    document.getElementById('password').focus();
                    return false;
                }
                
                if (password !== confirmPassword) {
                    e.preventDefault();
                    alert('Password dan konfirmasi password tidak cocok!');
                    document.getElementById('password_confirmation').focus();
                    return false;
                }
                
                if (!terms) {
                    e.preventDefault();
                    alert('Anda harus menyetujui Syarat & Ketentuan!');
                    document.getElementById('terms').focus();
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