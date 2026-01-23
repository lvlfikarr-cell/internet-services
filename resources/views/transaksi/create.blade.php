@extends('layouts.app')

@section('title', 'Berlangganan Layanan')

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

<div class="subscribe-container">
    <!-- Header Section -->
    <div class="header-section mb-5">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('transaksi.index') }}" class="breadcrumb-link">
                        <i class="fas fa-arrow-left me-2"></i>Daftar Layanan
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Form Berlangganan</li>
            </ol>
        </nav>
        
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title mb-2">Berlangganan Layanan</h1>
                <p class="page-subtitle">Isi formulir untuk berlangganan paket internet</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('transaksi.index') }}" class="btn btn-secondary-custom">
                    <i class="fas fa-times me-2"></i>Batal
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-lg-8">
            <!-- Form Card -->
            <div class="card form-card shadow-sm border-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-file-alt me-2"></i>Formulir Pendaftaran
                    </h5>
                </div>
                <div class="card-body">
                    <!-- Package Info -->
                    <div class="package-info mb-4">
                        <div class="package-badge">
                            <i class="fas fa-wifi me-2"></i>PAKET DIPILIH
                        </div>
                        <div class="package-details mt-3">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h4 class="package-name">{{ $layanan->nama_layanan }}</h4>
                                    <div class="package-features">
                                        <span class="feature-item">
                                            <i class="fas fa-bolt me-1"></i>Kecepatan Tinggi
                                        </span>
                                        <span class="feature-item">
                                            <i class="fas fa-infinity me-1"></i>Internet Unlimited
                                        </span>
                                        <span class="feature-item">
                                            <i class="fas fa-shield-alt me-1"></i>Garansi 24/7
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4 text-end">
                                    <div class="package-price">
                                        <div class="price-amount">Rp {{ number_format($layanan->harga, 0, ',', '.') }}</div>
                                        <div class="price-period">per bulan</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('transaksi.store') }}" method="POST" id="subscribeForm">
                        @csrf
                        
                        <!-- Hidden Input -->
                        <input type="hidden" name="jenis_layanan_id" value="{{ $layanan->id }}">

                        <!-- Customer Information -->
                        <div class="section-title mb-4">
                            <h6>
                                <i class="fas fa-user-circle me-2"></i>Informasi Pelanggan
                            </h6>
                        </div>

                        <!-- Nama Pelanggan -->
                        <div class="form-group mb-4">
                            <label for="nama_pelanggan" class="form-label">
                                Nama Lengkap
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group input-group-hover">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-user text-muted"></i>
                                </span>
                                <input type="text" 
                                       name="nama_pelanggan" 
                                       id="nama_pelanggan"
                                       class="form-control @error('nama_pelanggan') is-invalid @enderror" 
                                       placeholder="Masukkan nama lengkap"
                                       value="{{ old('nama_pelanggan') }}"
                                       required
                                       autofocus>
                            </div>
                            <div class="form-text mt-2">
                                <i class="fas fa-info-circle me-1"></i>Isi sesuai dengan nama di KTP
                            </div>
                            @error('nama_pelanggan')
                                <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Alamat -->
                        <div class="form-group mb-4">
                            <label for="alamat" class="form-label">
                                Alamat Lengkap
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group input-group-hover">
                                <span class="input-group-text bg-light align-items-start pt-3">
                                    <i class="fas fa-home text-muted"></i>
                                </span>
                                <textarea name="alamat" 
                                          id="alamat"
                                          class="form-control @error('alamat') is-invalid @enderror" 
                                          placeholder="Masukkan alamat lengkap (jalan, RT/RW, kelurahan, kecamatan, kota)"
                                          rows="4"
                                          required>{{ old('alamat') }}</textarea>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>Untuk proses instalasi
                                </div>
                                <div class="form-text">
                                    <span id="addressLength">0</span> karakter
                                </div>
                            </div>
                            @error('alamat')
                                <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Contact Info -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_telp" class="form-label">
                                        Nomor Telepon
                                    </label>
                                    <div class="input-group input-group-hover">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-phone text-muted"></i>
                                        </span>
                                        <input type="tel" 
                                               name="no_telp" 
                                               id="no_telp"
                                               class="form-control" 
                                               placeholder="08xx xxxx xxxx"
                                               value="{{ old('no_telp') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-label">
                                        Email
                                    </label>
                                    <div class="input-group input-group-hover">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-envelope text-muted"></i>
                                        </span>
                                        <input type="email" 
                                               name="email" 
                                               id="email"
                                               class="form-control" 
                                               placeholder="nama@email.com"
                                               value="{{ old('email') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Subscription Date -->
                        <div class="form-group mb-4">
                            <label for="tanggal_berlangganan" class="form-label">
                                Tanggal Mulai Berlangganan
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group input-group-hover">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-calendar text-muted"></i>
                                </span>
                                <input type="date" 
                                       name="tanggal_berlangganan" 
                                       id="tanggal_berlangganan"
                                       class="form-control @error('tanggal_berlangganan') is-invalid @enderror" 
                                       value="{{ old('tanggal_berlangganan', date('Y-m-d')) }}"
                                       required
                                       min="{{ date('Y-m-d') }}">
                            </div>
                            <div class="form-text mt-2">
                                <i class="fas fa-info-circle me-1"></i>Instalasi akan dilakukan setelah tanggal ini
                            </div>
                            @error('tanggal_berlangganan')
                                <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Payment Method -->
                        <div class="form-group mb-4">
                            <label class="form-label">
                                <i class="fas fa-credit-card me-2"></i>Metode Pembayaran
                            </label>
                            <div class="payment-methods">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <div class="payment-option active">
                                            <div class="payment-icon">
                                                <i class="fas fa-university"></i>
                                            </div>
                                            <div class="payment-name">Transfer Bank</div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="payment-option">
                                            <div class="payment-icon">
                                                <i class="fas fa-wallet"></i>
                                            </div>
                                            <div class="payment-name">E-Wallet</div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="payment-option">
                                            <div class="payment-icon">
                                                <i class="fas fa-money-bill-wave"></i>
                                            </div>
                                            <div class="payment-name">Tunai</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Terms Agreement -->
                        <div class="form-group mb-4">
                            <div class="form-check">
                                <input type="checkbox" 
                                       class="form-check-input" 
                                       id="terms" 
                                       name="terms"
                                       required>
                                <label class="form-check-label" for="terms">
                                    Saya menyetujui 
                                    <a href="#" class="terms-link">Syarat & Ketentuan</a> 
                                    dan 
                                    <a href="#" class="terms-link">Kebijakan Privasi</a>
                                    <span class="text-danger">*</span>
                                </label>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="form-actions mt-5 pt-4 border-top">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('transaksi.index') }}" class="btn btn-secondary-custom">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali
                                </a>
                                <div>
                                    <button type="button" class="btn btn-preview me-2" onclick="previewForm()">
                                        <i class="fas fa-eye me-2"></i>Preview
                                    </button>
                                    <button type="button" class="btn btn-primary-custom" onclick="submitFormWithConfirmation()">
                                        <i class="fas fa-paper-plane me-2"></i>Kirim Pendaftaran
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar Summary -->
        <div class="col-lg-4">
            <!-- Order Summary -->
            <div class="card summary-card shadow-sm border-0 mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-receipt me-2"></i>Ringkasan Pesanan
                    </h5>
                </div>
                <div class="card-body">
                    <div class="summary-content">
                        <!-- Package -->
                        <div class="summary-item">
                            <span class="summary-label">Paket</span>
                            <span class="summary-value">{{ $layanan->nama_layanan }}</span>
                        </div>
                        
                        <!-- Price -->
                        <div class="summary-item">
                            <span class="summary-label">Harga per Bulan</span>
                            <span class="summary-value text-success">Rp {{ number_format($layanan->harga, 0, ',', '.') }}</span>
                        </div>
                        
                        <!-- Installation Fee -->
                        <div class="summary-item">
                            <span class="summary-label">Biaya Instalasi</span>
                            <span class="summary-value">Rp 250.000</span>
                        </div>
                        
                        <!-- Discount -->
                        <div class="summary-item">
                            <span class="summary-label">Diskon Awal</span>
                            <span class="summary-value text-danger">- Rp 100.000</span>
                        </div>
                        
                        <hr>
                        
                        <!-- Total -->
                        <div class="summary-item total">
                            <span class="summary-label">Total Awal</span>
                            <span class="summary-value">
                                <strong>Rp {{ number_format($layanan->harga + 150000, 0, ',', '.') }}</strong>
                            </span>
                        </div>
                    </div>
                    
                    <!-- Features -->
                    <div class="summary-features mt-4">
                        <h6 class="mb-3">
                            <i class="fas fa-check-circle me-2"></i>Yang Anda Dapatkan:
                        </h6>
                        <ul class="mb-0 ps-3">
                            <li>Instalasi gratis modem/router</li>
                            <li>Garansi perangkat 1 tahun</li>
                            <li>Support teknis 24/7</li>
                            <li>Free upgrade jika ada gangguan</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Support Card -->
            <div class="card support-card shadow-sm border-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-headset me-2"></i>Butuh Bantuan?
                    </h5>
                </div>
                <div class="card-body">
                    <div class="support-info">
                        <div class="support-item mb-3">
                            <div class="support-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="support-content">
                                <h6>Telepon</h6>
                                <p class="mb-0">(021) 1234-5678</p>
                            </div>
                        </div>
                        <div class="support-item">
                            <div class="support-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="support-content">
                                <h6>Email</h6>
                                <p class="mb-0">support@internet-services.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-eye me-2"></i>Preview Pendaftaran
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="preview-content" id="previewContent">
                    <!-- Preview will be generated by JavaScript -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Edit Lagi</button>
                <button type="button" class="btn btn-primary" onclick="submitForm()">
                    <i class="fas fa-check me-2"></i>Konfirmasi & Kirim
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content success-modal-content">
            <div class="modal-body text-center p-5">
                <div class="success-icon mb-4">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h3 class="modal-title mb-3">Transaksi Berhasil!</h3>
                <p class="text-muted mb-4">
                    Pendaftaran berlangganan Anda telah berhasil dikirim. 
                    Tim kami akan segera menghubungi Anda untuk proses instalasi.
                </p>
                <div class="success-details mb-4">
                    <div class="detail-item">
                        <i class="fas fa-wifi me-2"></i>
                        <span><strong>Paket:</strong> {{ $layanan->nama_layanan }}</span>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-user me-2"></i>
                        <span id="successCustomerName"></span>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-calendar me-2"></i>
                        <span id="successStartDate"></span>
                    </div>
                </div>
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('transaksi.index') }}" class="btn btn-primary-custom">
                        <i class="fas fa-home me-2"></i>Kembali ke Dashboard
                    </a>
                    <button type="button" class="btn btn-secondary-custom" data-bs-dismiss="modal">
                        <i class="fas fa-print me-2"></i>Cetak Bukti
                    </button>
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
        --border-color: #eaeaea;
        --card-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        --hover-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    }

    .subscribe-container {
        padding: 20px;
        animation: fadeIn 0.5s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Breadcrumb */
    .breadcrumb {
        background: transparent;
        padding: 0;
        margin-bottom: 20px;
    }

    .breadcrumb-item {
        font-size: 0.9rem;
    }

    .breadcrumb-link {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 500;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
    }

    .breadcrumb-link:hover {
        color: var(--secondary-color);
        transform: translateX(-3px);
    }

    .page-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--dark-color);
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .page-subtitle {
        font-size: 0.95rem;
        color: var(--gray-color);
        opacity: 0.8;
    }

    /* Card Styling */
    .form-card, .summary-card, .support-card {
        border-radius: 16px;
        border: 1px solid var(--border-color);
        overflow: hidden;
    }

    .card-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-bottom: 1px solid var(--border-color);
        padding: 20px 25px;
    }

    .card-title {
        font-weight: 600;
        color: var(--dark-color);
        display: flex;
        align-items: center;
    }

    .card-body {
        padding: 30px;
    }

    /* Package Info */
    .package-info {
        background: linear-gradient(135deg, rgba(67, 97, 238, 0.05) 0%, rgba(114, 9, 183, 0.05) 100%);
        border-radius: 12px;
        padding: 20px;
        border: 1px solid rgba(67, 97, 238, 0.1);
    }

    .package-badge {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
    }

    .package-name {
        font-weight: 600;
        color: var(--dark-color);
        font-size: 1.4rem;
        margin-bottom: 10px;
    }

    .package-features {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .feature-item {
        display: inline-flex;
        align-items: center;
        background: rgba(67, 97, 238, 0.1);
        color: var(--primary-color);
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .package-price {
        text-align: right;
    }

    .price-amount {
        font-size: 1.8rem;
        font-weight: 700;
        color: #28a745;
        line-height: 1;
    }

    .price-period {
        color: var(--gray-color);
        font-size: 0.9rem;
        margin-top: 5px;
    }

    /* Section Title */
    .section-title {
        padding-bottom: 10px;
        border-bottom: 2px solid var(--light-gray);
    }

    .section-title h6 {
        font-weight: 600;
        color: var(--dark-color);
        display: flex;
        align-items: center;
        font-size: 1rem;
        margin: 0;
    }

    /* Form Elements */
    .form-label {
        font-weight: 600;
        color: var(--dark-color);
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        font-size: 1rem;
    }

    .form-label span.text-danger {
        margin-left: 4px;
    }

    /* Input Group Styling */
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
        min-height: 52px;
        background: transparent !important;
    }

    .form-control:focus {
        border: none !important;
        box-shadow: none !important;
        outline: none !important;
        background: transparent !important;
    }

    textarea.form-control {
        min-height: 120px;
        resize: vertical;
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

    .form-text {
        font-size: 0.85rem;
        color: var(--gray-color);
    }

    /* Payment Methods */
    .payment-option {
        border: 2px solid var(--light-gray);
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        height: 100%;
    }

    .payment-option:hover,
    .payment-option.active {
        border-color: var(--primary-color);
        background: rgba(67, 97, 238, 0.05);
        transform: translateY(-2px);
    }

    .payment-option.active {
        background: rgba(67, 97, 238, 0.1);
    }

    .payment-icon {
        font-size: 2rem;
        color: var(--primary-color);
        margin-bottom: 10px;
    }

    .payment-name {
        font-weight: 600;
        color: var(--dark-color);
    }

    /* Summary Card */
    .summary-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid var(--light-gray);
    }

    .summary-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .summary-item.total {
        border-top: 2px solid var(--primary-color);
        padding-top: 15px;
        margin-top: 15px;
    }

    .summary-label {
        color: var(--gray-color);
        font-weight: 500;
    }

    .summary-value {
        font-weight: 600;
        color: var(--dark-color);
    }

    .summary-features ul {
        list-style: none;
        padding-left: 0;
    }

    .summary-features li {
        padding: 5px 0;
        color: var(--gray-color);
        font-size: 0.9rem;
        position: relative;
        padding-left: 25px;
    }

    .summary-features li:before {
        content: "✓";
        position: absolute;
        left: 0;
        color: #28a745;
        font-weight: bold;
    }

    /* Support Card */
    .support-item {
        display: flex;
        align-items: center;
        padding: 10px 0;
    }

    .support-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: linear-gradient(135deg, rgba(67, 97, 238, 0.1) 0%, rgba(114, 9, 183, 0.1) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-color);
        margin-right: 15px;
        flex-shrink: 0;
    }

    .support-content h6 {
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--dark-color);
        margin-bottom: 2px;
    }

    .support-content p {
        font-size: 0.85rem;
        color: var(--gray-color);
        margin-bottom: 0;
    }

    /* Button Styling */
    .btn-primary-custom {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 12px 24px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-primary-custom:hover {
        background: linear-gradient(135deg, var(--primary-dark) 0%, #6411ad 100%);
        transform: translateY(-2px);
        box-shadow: var(--hover-shadow);
        color: white;
    }

    .btn-secondary-custom {
        background: transparent;
        color: var(--gray-color);
        border: 2px solid var(--light-gray);
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 500;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
    }

    .btn-secondary-custom:hover {
        background: var(--light-gray);
        color: var(--dark-color);
        border-color: var(--gray-color);
        transform: translateY(-2px);
    }

    .btn-preview {
        background: transparent;
        color: #17a2b8;
        border: 2px solid #17a2b8;
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 500;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
    }

    .btn-preview:hover {
        background: #17a2b8;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(23, 162, 184, 0.3);
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

    /* Form Actions */
    .form-actions {
        padding-top: 20px;
    }

    /* Modal */
    .modal-content {
        border-radius: 15px;
        border: none;
        box-shadow: var(--hover-shadow);
    }

    .modal-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-bottom: 1px solid var(--light-gray);
        padding: 25px;
    }

    .modal-title {
        font-weight: 600;
        color: var(--dark-color);
        display: flex;
        align-items: center;
    }

    .modal-body {
        padding: 30px;
    }

    .modal-footer {
        border-top: 1px solid var(--light-gray);
        padding: 20px 30px;
    }

    /* Preview Content */
    .preview-content .preview-item {
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid var(--light-gray);
    }

    .preview-content .preview-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .preview-label {
        font-weight: 600;
        color: var(--dark-color);
        margin-bottom: 5px;
        font-size: 0.9rem;
    }

    .preview-value {
        color: var(--gray-color);
        font-size: 1.1rem;
    }

    /* Success Modal Styling */
    .success-modal-content {
        border: none;
        box-shadow: 0 20px 60px rgba(67, 97, 238, 0.3);
        animation: successModalFadeIn 0.5s ease-out;
    }

    @keyframes successModalFadeIn {
        from {
            opacity: 0;
            transform: translateY(-30px) scale(0.9);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .success-icon {
        font-size: 80px;
        color: #28a745;
        animation: successIconAnimation 1s ease-out;
    }

    @keyframes successIconAnimation {
        0% {
            transform: scale(0);
            opacity: 0;
        }
        50% {
            transform: scale(1.2);
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    .success-details {
        background: rgba(67, 97, 238, 0.05);
        border-radius: 12px;
        padding: 20px;
        text-align: left;
    }

    .detail-item {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        color: var(--gray-color);
    }

    .detail-item:last-child {
        margin-bottom: 0;
    }

    .detail-item i {
        color: var(--primary-color);
        width: 20px;
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .subscribe-container {
            padding: 15px;
        }
        
        .form-actions .d-flex {
            flex-direction: column;
            gap: 15px;
        }
        
        .form-actions .d-flex > * {
            width: 100%;
        }
        
        .form-actions .btn {
            width: 100%;
            margin-bottom: 10px;
        }
        
        .package-features {
            flex-direction: column;
            gap: 10px;
        }
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 1.5rem;
        }
        
        .card-body {
            padding: 20px;
        }
        
        .package-name {
            font-size: 1.2rem;
        }
        
        .price-amount {
            font-size: 1.5rem;
        }
        
        .btn-primary-custom,
        .btn-secondary-custom,
        .btn-preview {
            padding: 10px 16px;
            font-size: 0.9rem;
        }
        
        .payment-methods .row {
            flex-direction: column;
        }
        
        .payment-methods .col-md-4 {
            width: 100%;
            margin-bottom: 10px;
        }
        
        .success-modal-content {
            margin: 20px;
        }
    }

    @media (max-width: 576px) {
        .subscribe-container {
            padding: 10px;
        }
        
        .page-title {
            font-size: 1.3rem;
        }
        
        .page-subtitle {
            font-size: 0.85rem;
        }
        
        .header-actions .btn span {
            display: none;
        }
        
        .header-actions .btn i {
            margin-right: 0;
        }
        
        .form-control {
            padding: 12px 15px;
            font-size: 0.95rem;
        }
        
        .input-group-text {
            padding: 0 15px;
        }
        
        .success-icon {
            font-size: 60px;
        }
        
        .modal-title {
            font-size: 1.2rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Address character counter
        const addressTextarea = document.getElementById('alamat');
        const addressLength = document.getElementById('addressLength');
        
        function updateAddressLength() {
            const length = addressTextarea.value.length;
            addressLength.textContent = length;
            
            if (length > 500) {
                addressTextarea.classList.add('is-invalid');
                addressLength.style.color = '#dc3545';
            } else {
                addressTextarea.classList.remove('is-invalid');
                addressLength.style.color = 'var(--primary-color)';
            }
        }
        
        addressTextarea.addEventListener('input', updateAddressLength);
        updateAddressLength(); // Initialize
        
        // Set minimum date to today
        const dateInput = document.getElementById('tanggal_berlangganan');
        const today = new Date().toISOString().split('T')[0];
        dateInput.min = today;
        
        // Payment method selection
        const paymentOptions = document.querySelectorAll('.payment-option');
        paymentOptions.forEach(option => {
            option.addEventListener('click', function() {
                paymentOptions.forEach(opt => opt.classList.remove('active'));
                this.classList.add('active');
            });
        });
    });
    
    function previewForm() {
        // Get form values
        const nama = document.getElementById('nama_pelanggan').value || '[Belum diisi]';
        const alamat = document.getElementById('alamat').value || '[Belum diisi]';
        const noTelp = document.getElementById('no_telp').value || '[Belum diisi]';
        const email = document.getElementById('email').value || '[Belum diisi]';
        const tanggal = document.getElementById('tanggal_berlangganan').value || '[Belum diisi]';
        const paket = "{{ $layanan->nama_layanan }}";
        const harga = "Rp {{ number_format($layanan->harga, 0, ',', '.') }}";
        
        // Format date
        let formattedDate = tanggal;
        if (tanggal !== '[Belum diisi]') {
            const dateObj = new Date(tanggal);
            formattedDate = dateObj.toLocaleDateString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
        }
        
        // Build preview content
        const previewHTML = `
            <div class="preview-header mb-4">
                <h5 class="text-success">
                    <i class="fas fa-check-circle me-2"></i>Konfirmasi Data Pendaftaran
                </h5>
                <p class="text-muted mb-0">Periksa kembali data sebelum mengirim</p>
            </div>
            
            <div class="preview-item">
                <div class="preview-label">Paket yang Dipilih</div>
                <div class="preview-value">
                    <strong>${paket}</strong> - ${harga}/bulan
                </div>
            </div>
            
            <div class="preview-item">
                <div class="preview-label">Nama Lengkap</div>
                <div class="preview-value">${nama}</div>
            </div>
            
            <div class="preview-item">
                <div class="preview-label">Alamat</div>
                <div class="preview-value">${alamat}</div>
            </div>
            
            <div class="preview-item">
                <div class="preview-label">Kontak</div>
                <div class="review-value">
                    <div>Telp: ${noTelp}</div>
                    <div class="mt-1">Email: ${email}</div>
                </div>
            </div>
            
            <div class="preview-item">
                <div class="preview-label">Tanggal Mulai</div>
                <div class="preview-value">${formattedDate}</div>
            </div>
            
            <div class="alert alert-info mt-4">
                <i class="fas fa-info-circle me-2"></i>
                <strong>Penting:</strong> Setelah mengirim formulir, tim kami akan menghubungi Anda untuk konfirmasi dan jadwal instalasi.
            </div>
        `;
        
        // Set preview content
        document.getElementById('previewContent').innerHTML = previewHTML;
        
        // Show modal
        const modal = new bootstrap.Modal(document.getElementById('previewModal'));
        modal.show();
    }
    
    function validateForm() {
        const nama = document.getElementById('nama_pelanggan').value.trim();
        const alamat = document.getElementById('alamat').value.trim();
        const tanggal = document.getElementById('tanggal_berlangganan').value;
        const terms = document.getElementById('terms').checked;
        
        let isValid = true;
        let errorMessage = '';
        
        if (!nama) {
            isValid = false;
            errorMessage = 'Nama pelanggan harus diisi!';
            document.getElementById('nama_pelanggan').focus();
        } else if (!alamat) {
            isValid = false;
            errorMessage = 'Alamat harus diisi!';
            document.getElementById('alamat').focus();
        } else if (!tanggal) {
            isValid = false;
            errorMessage = 'Tanggal berlangganan harus diisi!';
            document.getElementById('tanggal_berlangganan').focus();
        } else if (!terms) {
            isValid = false;
            errorMessage = 'Anda harus menyetujui Syarat & Ketentuan!';
            document.getElementById('terms').focus();
        }
        
        if (!isValid) {
            showErrorToast(errorMessage);
            return false;
        }
        
        return true;
    }
    
    function showErrorToast(message) {
        // Create toast notification
        const toast = document.createElement('div');
        toast.className = 'position-fixed bottom-0 end-0 p-3';
        toast.style.zIndex = '1050';
        
        toast.innerHTML = `
            <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header bg-danger text-white">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <strong class="me-auto">Error</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    ${message}
                </div>
            </div>
        `;
        
        document.body.appendChild(toast);
        
        // Remove toast after 5 seconds
        setTimeout(() => {
            toast.remove();
        }, 5000);
    }
    
    function submitFormWithConfirmation() {
        if (!validateForm()) {
            return;
        }
        
        // Get form data for success modal
        const nama = document.getElementById('nama_pelanggan').value;
        const tanggal = document.getElementById('tanggal_berlangganan').value;
        
        // Format date for display
        const dateObj = new Date(tanggal);
        const formattedDate = dateObj.toLocaleDateString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
        
        // Update success modal with user data
        document.getElementById('successCustomerName').innerHTML = `<strong>Pelanggan:</strong> ${nama}`;
        document.getElementById('successStartDate').innerHTML = `<strong>Mulai:</strong> ${formattedDate}`;
        
        // Show success modal
        const successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
        
        // After showing success modal, submit the form
        setTimeout(() => {
            document.getElementById('subscribeForm').submit();
        }, 3000); // Submit after 3 seconds to show success message
    }
    
    function submitForm() {
        if (validateForm()) {
            // Close preview modal
            const previewModal = bootstrap.Modal.getInstance(document.getElementById('previewModal'));
            previewModal.hide();
            
            // Submit the form
            submitFormWithConfirmation();
        }
    }
</script>

<!-- Bootstrap JS Modal Support -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Font Awesome Icons -->
@unless(view()->exists('layouts.includes.fontawesome'))
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endunless
@endsection