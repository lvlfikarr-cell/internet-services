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

<div class="create-container">
    <!-- Header -->
    <div class="header-section mb-4">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('jenis-layanan.index') }}" class="breadcrumb-link">
                        <i class="fas fa-arrow-left me-2"></i>Master Layanan
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Layanan Baru</li>
            </ol>
        </nav>
        
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title mb-2">Tambah Jenis Layanan Baru</h1>
                <p class="page-subtitle">Tambahkan jenis layanan internet baru ke dalam sistem</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('jenis-layanan.index') }}" class="btn btn-secondary-custom me-2">
                    <i class="fas fa-times me-2"></i>Batal
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-lg-8">
            <!-- Form Card -->
            <div class="card form-card shadow-sm border-0 mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-edit me-2"></i>Form Tambah Layanan
                    </h5>
                </div>
                <div class="card-body">
                    <!-- Error Messages -->
                    @if ($errors->any())
                    <div class="alert alert-danger-custom alert-dismissible fade show mb-4" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-triangle me-3" style="font-size: 1.5rem;"></i>
                            <div>
                                <h5 class="alert-heading mb-2">Terjadi kesalahan!</h5>
                                <ul class="mb-0 ps-0">
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <form action="{{ route('jenis-layanan.store') }}" method="POST" id="createForm">
                        @csrf

                        <!-- Nama Layanan -->
                        <div class="form-group mb-4">
                            <label for="nama_layanan" class="form-label">
                                <i class="fas fa-wifi me-2"></i>Nama Layanan
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group input-group-hover">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-network-wired text-muted"></i>
                                </span>
                                <input type="text" 
                                       name="nama_layanan" 
                                       id="nama_layanan"
                                       class="form-control @error('nama_layanan') is-invalid @enderror" 
                                       placeholder="Contoh: Internet 100 Mbps"
                                       value="{{ old('nama_layanan') }}"
                                       required
                                       autofocus>
                            </div>
                            <div class="form-text mt-2">
                                <i class="fas fa-info-circle me-1"></i>Berikan nama yang jelas dan mudah dipahami
                            </div>
                            @error('nama_layanan')
                                <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Harga -->
                        <div class="form-group mb-4">
                            <label for="harga" class="form-label">
                                <i class="fas fa-tag me-2"></i>Harga per Bulan
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group input-group-hover">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-money-bill-wave text-muted"></i>
                                </span>
                                <input type="number" 
                                       name="harga" 
                                       id="harga"
                                       class="form-control @error('harga') is-invalid @enderror" 
                                       placeholder="Contoh: 350000"
                                       value="{{ old('harga') }}"
                                       required
                                       min="0"
                                       step="1000">
                                <span class="input-group-text">IDR</span>
                            </div>
                            <div class="price-preview mt-2" id="pricePreview">
                                <span class="badge bg-light text-dark">
                                    <i class="fas fa-eye me-1"></i>Preview: <span id="formattedPrice">Rp 0</span>/bulan
                                </span>
                            </div>
                            @error('harga')
                                <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="form-group mb-4">
                            <label for="deskripsi" class="form-label">
                                <i class="fas fa-align-left me-2"></i>Deskripsi Layanan
                            </label>
                            <div class="input-group input-group-hover">
                                <span class="input-group-text bg-light align-items-start pt-3">
                                    <i class="fas fa-file-alt text-muted"></i>
                                </span>
                                <textarea name="deskripsi" 
                                          id="deskripsi"
                                          class="form-control @error('deskripsi') is-invalid @enderror" 
                                          placeholder="Deskripsikan fitur dan keunggulan layanan ini..."
                                          rows="4">{{ old('deskripsi') }}</textarea>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>Opsional, maksimal 500 karakter
                                </div>
                                <div class="form-text">
                                    <span id="charCount">0</span>/500 karakter
                                </div>
                            </div>
                            @error('deskripsi')
                                <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Form Actions -->
                        <div class="form-actions mt-5 pt-4 border-top">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('jenis-layanan.index') }}" class="btn btn-secondary-custom">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali
                                </a>
                                <div>
                                    <button type="button" class="btn btn-reset me-2" onclick="resetForm()">
                                        <i class="fas fa-redo me-2"></i>Reset
                                    </button>
                                    <button type="submit" class="btn btn-primary-custom">
                                        <i class="fas fa-save me-2"></i>Simpan Layanan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar Info -->
        <div class="col-lg-4">
            <!-- Info Card -->
            <div class="card info-card shadow-sm border-0 mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-lightbulb me-2"></i>Tips & Panduan
                    </h5>
                </div>
                <div class="card-body">
                    <div class="info-item mb-3">
                        <div class="info-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="info-content">
                            <h6>Nama Jelas</h6>
                            <p class="small">Gunakan nama yang mudah dipahami pelanggan</p>
                        </div>
                    </div>
                    <div class="info-item mb-3">
                        <div class="info-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="info-content">
                            <h6>Harga Kompetitif</h6>
                            <p class="small">Tetapkan harga yang sesuai dengan kecepatan</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="info-content">
                            <h6>Deskripsi Lengkap</h6>
                            <p class="small">Jelaskan keunggulan layanan secara detail</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Preview Card -->
            <div class="card preview-card shadow-sm border-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-eye me-2"></i>Preview Layanan
                    </h5>
                </div>
                <div class="card-body">
                    <div class="preview-content">
                        <div class="preview-icon mb-3">
                            <i class="fas fa-wifi"></i>
                        </div>
                        <h5 id="previewName" class="preview-title">Nama Layanan</h5>
                        <div id="previewPrice" class="preview-price mb-3">Rp 0 /bulan</div>
                        <p id="previewDesc" class="preview-desc">
                            Deskripsi layanan akan muncul di sini...
                        </p>
                    </div>
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

    .create-container {
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
    .form-card, .info-card, .preview-card {
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

    /* Price Preview */
    .price-preview .badge {
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 500;
        font-size: 0.9rem;
    }

    /* Character Counter */
    #charCount {
        font-weight: 600;
        color: var(--primary-color);
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

    .btn-reset {
        background: transparent;
        color: #fd7e14;
        border: 2px solid #fd7e14;
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 500;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
    }

    .btn-reset:hover {
        background: #fd7e14;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(253, 126, 20, 0.3);
    }

    /* Alert Styling */
    .alert-danger-custom {
        background: linear-gradient(135deg, rgba(220, 53, 69, 0.1) 0%, rgba(220, 53, 69, 0.05) 100%);
        border: none;
        border-left: 5px solid #dc3545;
        border-radius: 12px;
        padding: 20px;
        backdrop-filter: blur(10px);
    }

    .alert-danger-custom .alert-heading {
        color: #dc3545;
        font-weight: 600;
        font-size: 1.1rem;
    }

    .alert-danger-custom ul {
        list-style: none;
        padding-left: 0;
        margin-bottom: 0;
    }

    .alert-danger-custom ul li {
        padding: 4px 0;
        color: #721c24;
        font-size: 0.95rem;
    }

    /* Info Card */
    .info-item {
        display: flex;
        align-items: flex-start;
        padding: 10px 0;
    }

    .info-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: linear-gradient(135deg, rgba(67, 97, 238, 0.1) 0%, rgba(114, 9, 183, 0.1) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-color);
        margin-right: 15px;
        flex-shrink: 0;
    }

    .info-content h6 {
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--dark-color);
        margin-bottom: 4px;
    }

    .info-content p {
        font-size: 0.85rem;
        color: var(--gray-color);
        margin-bottom: 0;
        line-height: 1.5;
    }

    /* Preview Card */
    .preview-content {
        text-align: center;
        padding: 20px 0;
    }

    .preview-icon {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        background: linear-gradient(135deg, rgba(67, 97, 238, 0.1) 0%, rgba(114, 9, 183, 0.1) 100%);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-color);
        font-size: 2rem;
        margin-bottom: 20px;
    }

    .preview-title {
        font-weight: 600;
        color: var(--dark-color);
        font-size: 1.3rem;
        margin-bottom: 10px;
    }

    .preview-price {
        font-size: 1.5rem;
        font-weight: 700;
        color: #28a745;
        background: linear-gradient(135deg, rgba(40, 167, 69, 0.1) 0%, rgba(40, 167, 69, 0.05) 100%);
        padding: 10px 20px;
        border-radius: 12px;
        display: inline-block;
    }

    .preview-desc {
        color: var(--gray-color);
        font-size: 0.95rem;
        line-height: 1.6;
        margin-top: 20px;
        padding: 15px;
        background: var(--light-color);
        border-radius: 10px;
        border-left: 4px solid var(--primary-color);
    }

    /* Form Actions */
    .form-actions {
        padding-top: 20px;
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .create-container {
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
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 1.5rem;
        }
        
        .card-body {
            padding: 20px;
        }
        
        .preview-icon {
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
        }
        
        .preview-title {
            font-size: 1.1rem;
        }
        
        .preview-price {
            font-size: 1.2rem;
            padding: 8px 16px;
        }
        
        .btn-primary-custom,
        .btn-secondary-custom,
        .btn-reset {
            padding: 10px 16px;
            font-size: 0.9rem;
        }
    }

    @media (max-width: 576px) {
        .create-container {
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
        
        .preview-content {
            padding: 15px 0;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Format price as user types
        const hargaInput = document.getElementById('harga');
        const formattedPrice = document.getElementById('formattedPrice');
        const previewPrice = document.getElementById('previewPrice');
        
        function formatPrice(value) {
            if (!value) return '0';
            return new Intl.NumberFormat('id-ID').format(value);
        }
        
        function updatePricePreview() {
            const value = hargaInput.value || 0;
            const formatted = formatPrice(value);
            formattedPrice.textContent = `Rp ${formatted}`;
            previewPrice.textContent = `Rp ${formatted} /bulan`;
        }
        
        hargaInput.addEventListener('input', updatePricePreview);
        
        // Character counter for description
        const descTextarea = document.getElementById('deskripsi');
        const charCount = document.getElementById('charCount');
        const previewDesc = document.getElementById('previewDesc');
        
        function updateCharCount() {
            const length = descTextarea.value.length;
            charCount.textContent = length;
            
            if (length > 500) {
                descTextarea.classList.add('is-invalid');
                charCount.style.color = '#dc3545';
            } else {
                descTextarea.classList.remove('is-invalid');
                charCount.style.color = 'var(--primary-color)';
            }
            
            // Update preview
            previewDesc.textContent = descTextarea.value || 'Deskripsi layanan akan muncul di sini...';
        }
        
        descTextarea.addEventListener('input', updateCharCount);
        
        // Update name preview
        const nameInput = document.getElementById('nama_layanan');
        const previewName = document.getElementById('previewName');
        
        nameInput.addEventListener('input', function() {
            previewName.textContent = this.value || 'Nama Layanan';
        });
        
        // Initialize previews
        updatePricePreview();
        updateCharCount();
        previewName.textContent = nameInput.value || 'Nama Layanan';
        previewDesc.textContent = descTextarea.value || 'Deskripsi layanan akan muncul di sini...';
        
        // Form validation
        const form = document.getElementById('createForm');
        form.addEventListener('submit', function(e) {
            const nama = nameInput.value.trim();
            const harga = hargaInput.value.trim();
            
            if (!nama) {
                e.preventDefault();
                showError('Nama layanan harus diisi!', nameInput);
                return false;
            }
            
            if (!harga || parseInt(harga) <= 0) {
                e.preventDefault();
                showError('Harga harus lebih dari 0!', hargaInput);
                return false;
            }
            
            if (descTextarea.value.length > 500) {
                e.preventDefault();
                showError('Deskripsi maksimal 500 karakter!', descTextarea);
                return false;
            }
            
            return true;
        });
        
        function showError(message, element) {
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
            
            // Focus on the problematic element
            element.focus();
            element.classList.add('is-invalid');
            
            // Remove toast after 5 seconds
            setTimeout(() => {
                toast.remove();
            }, 5000);
        }
    });
    
    function resetForm() {
        if (confirm('Apakah Anda yakin ingin mengosongkan semua field?')) {
            document.getElementById('createForm').reset();
            document.getElementById('previewName').textContent = 'Nama Layanan';
            document.getElementById('formattedPrice').textContent = 'Rp 0';
            document.getElementById('previewPrice').textContent = 'Rp 0 /bulan';
            document.getElementById('previewDesc').textContent = 'Deskripsi layanan akan muncul di sini...';
            document.getElementById('charCount').textContent = '0';
            document.getElementById('nama_layanan').focus();
        }
    }
</script>

<!-- Font Awesome Icons -->
@unless(view()->exists('layouts.includes.fontawesome'))
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endunless
@endsection