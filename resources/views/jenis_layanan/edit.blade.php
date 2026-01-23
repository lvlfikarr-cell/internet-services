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

<div class="edit-container">
    <!-- Header -->
    <div class="header-section mb-4">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('jenis-layanan.index') }}" class="breadcrumb-link">
                        <i class="fas fa-arrow-left me-2"></i>Master Layanan
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('jenis-layanan.show', $jenis_layanan->id) }}" class="breadcrumb-link">
                        Detail Layanan
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit Layanan</li>
            </ol>
        </nav>
        
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title mb-2">
                    <i class="fas fa-edit me-2"></i>Edit Layanan
                </h1>
                <p class="page-subtitle">Perbarui informasi layanan <strong>"{{ $jenis_layanan->nama_layanan }}"</strong></p>
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
                        <i class="fas fa-pencil-alt me-2"></i>Form Edit Layanan
                    </h5>
                </div>
                <div class="card-body">
                    <!-- Error Messages -->
                    @if ($errors->any())
                    <div class="alert alert-warning-custom alert-dismissible fade show mb-4" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-triangle me-3" style="font-size: 1.5rem;"></i>
                            <div>
                                <h5 class="alert-heading mb-2">Periksa kembali data Anda!</h5>
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

                    <form action="{{ route('jenis-layanan.update', $jenis_layanan->id) }}" method="POST" id="editForm">
                        @csrf
                        @method('PUT')

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
                                       value="{{ old('nama_layanan', $jenis_layanan->nama_layanan) }}"
                                       required
                                       autofocus>
                            </div>
                            <div class="form-text mt-2">
                                <i class="fas fa-info-circle me-1"></i>Nama harus jelas dan mudah dipahami
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
                                       value="{{ old('harga', $jenis_layanan->harga) }}"
                                       required
                                       min="0"
                                       step="1000">
                                <span class="input-group-text">IDR</span>
                            </div>
                            <div class="price-info mt-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="price-preview">
                                        <span class="badge bg-light text-dark">
                                            <i class="fas fa-eye me-1"></i>Preview: 
                                            <span id="formattedPrice">
                                                Rp {{ number_format(old('harga', $jenis_layanan->harga), 0, ',', '.') }}
                                            </span>/bulan
                                        </span>
                                    </div>
                                    <div class="price-change">
                                        @php
                                            $oldPrice = $jenis_layanan->harga;
                                            $newPrice = old('harga', $jenis_layanan->harga);
                                            $change = $newPrice - $oldPrice;
                                            $percent = $oldPrice > 0 ? ($change / $oldPrice) * 100 : 0;
                                        @endphp
                                        @if($change != 0)
                                        <span class="badge @if($change > 0) bg-danger @else bg-success @endif">
                                            <i class="fas fa-arrow-@if($change > 0)up @else down @endif me-1"></i>
                                            {{ $change > 0 ? '+' : '' }}{{ number_format($change, 0, ',', '.') }}
                                            ({{ $change > 0 ? '+' : '' }}{{ number_format($percent, 1) }}%)
                                        </span>
                                        @endif
                                    </div>
                                </div>
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
                                          rows="4">{{ old('deskripsi', $jenis_layanan->deskripsi) }}</textarea>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>Opsional, maksimal 500 karakter
                                </div>
                                <div class="form-text">
                                    <span id="charCount">{{ strlen(old('deskripsi', $jenis_layanan->deskripsi)) }}</span>/500 karakter
                                </div>
                            </div>
                            @error('deskripsi')
                                <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Created Info -->
                        <div class="info-box mb-4">
                            <div class="info-box-header">
                                <i class="fas fa-history me-2"></i>Informasi Data
                            </div>
                            <div class="info-box-content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <span class="info-label">Dibuat pada:</span>
                                            <span class="info-value">
                                                {{ $jenis_layanan->created_at->format('d/m/Y H:i') }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <span class="info-label">Terakhir diubah:</span>
                                            <span class="info-value">
                                                {{ $jenis_layanan->updated_at->format('d/m/Y H:i') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="form-actions mt-5 pt-4 border-top">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <a href="{{ route('jenis-layanan.index') }}" class="btn btn-secondary-custom me-2">
                                        <i class="fas fa-arrow-left me-2"></i>Kembali
                                    </a>
                                    <button type="button" class="btn btn-reset" onclick="resetToOriginal()">
                                        <i class="fas fa-undo me-2"></i>Reset ke Asli
                                    </button>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary-custom">
                                        <i class="fas fa-save me-2"></i>Perbarui Layanan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Preview Card -->
            <div class="card preview-card shadow-sm border-0 mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-eye me-2"></i>Preview Perubahan
                    </h5>
                </div>
                <div class="card-body">
                    <div class="preview-content">
                        <div class="preview-icon mb-3">
                            <i class="fas fa-wifi"></i>
                        </div>
                        <h5 id="previewName" class="preview-title">
                            {{ old('nama_layanan', $jenis_layanan->nama_layanan) }}
                        </h5>
                        <div id="previewPrice" class="preview-price mb-3">
                            Rp {{ number_format(old('harga', $jenis_layanan->harga), 0, ',', '.') }} /bulan
                        </div>
                        <p id="previewDesc" class="preview-desc">
                            {{ old('deskripsi', $jenis_layanan->deskripsi) ?: 'Tidak ada deskripsi' }}
                        </p>
                        
                        <!-- Changes Indicator -->
                        @php
                            $nameChanged = old('nama_layanan', $jenis_layanan->nama_layanan) != $jenis_layanan->nama_layanan;
                            $priceChanged = old('harga', $jenis_layanan->harga) != $jenis_layanan->harga;
                            $descChanged = old('deskripsi', $jenis_layanan->deskripsi) != $jenis_layanan->deskripsi;
                            $totalChanges = ($nameChanged ? 1 : 0) + ($priceChanged ? 1 : 0) + ($descChanged ? 1 : 0);
                        @endphp
                        
                        @if($totalChanges > 0)
                        <div class="changes-indicator mt-4 pt-3 border-top">
                            <h6 class="mb-3">
                                <i class="fas fa-exchange-alt me-2"></i>Perubahan Terdeteksi
                            </h6>
                            <div class="changes-list">
                                @if($nameChanged)
                                <div class="change-item">
                                    <i class="fas fa-circle text-warning me-2"></i>
                                    <span>Nama layanan diubah</span>
                                </div>
                                @endif
                                @if($priceChanged)
                                <div class="change-item">
                                    <i class="fas fa-circle @if(old('harga', $jenis_layanan->harga) > $jenis_layanan->harga) text-danger @else text-success @endif me-2"></i>
                                    <span>Harga diubah</span>
                                </div>
                                @endif
                                @if($descChanged)
                                <div class="change-item">
                                    <i class="fas fa-circle text-info me-2"></i>
                                    <span>Deskripsi diubah</span>
                                </div>
                                @endif
                            </div>
                        </div>
                        @else
                        <div class="no-changes mt-4 pt-3 border-top text-center">
                            <i class="fas fa-check-circle text-muted fa-2x mb-2"></i>
                            <p class="small text-muted mb-0">Belum ada perubahan</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Original Data Card -->
            <div class="card original-card shadow-sm border-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-archive me-2"></i>Data Asli
                    </h5>
                </div>
                <div class="card-body">
                    <div class="original-content">
                        <h6 class="original-title mb-3">
                            <i class="fas fa-wifi me-2"></i>{{ $jenis_layanan->nama_layanan }}
                        </h6>
                        <div class="original-price mb-3">
                            <span class="badge bg-light text-dark">
                                Rp {{ number_format($jenis_layanan->harga, 0, ',', '.') }} /bulan
                            </span>
                        </div>
                        <div class="original-desc">
                            <small class="text-muted">
                                {{ $jenis_layanan->deskripsi ?: 'Tidak ada deskripsi' }}
                            </small>
                        </div>
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

    .edit-container {
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
        display: flex;
        align-items: center;
    }

    .page-subtitle {
        font-size: 0.95rem;
        color: var(--gray-color);
        opacity: 0.8;
    }

    .page-subtitle strong {
        color: var(--primary-color);
        font-weight: 600;
    }

    /* Card Styling */
    .form-card, .preview-card, .original-card {
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

    /* Price Info */
    .price-info .price-preview .badge {
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 500;
        font-size: 0.9rem;
        background: var(--light-color);
        color: var(--dark-color);
    }

    .price-change .badge {
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    /* Character Counter */
    #charCount {
        font-weight: 600;
        color: var(--primary-color);
    }

    /* Info Box */
    .info-box {
        background: linear-gradient(135deg, rgba(67, 97, 238, 0.05) 0%, rgba(114, 9, 183, 0.05) 100%);
        border-radius: 12px;
        border: 1px solid rgba(67, 97, 238, 0.1);
        padding: 20px;
    }

    .info-box-header {
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        font-size: 0.95rem;
    }

    .info-item {
        margin-bottom: 10px;
    }

    .info-label {
        font-weight: 500;
        color: var(--gray-color);
        font-size: 0.9rem;
        display: block;
        margin-bottom: 4px;
    }

    .info-value {
        font-weight: 600;
        color: var(--dark-color);
        font-size: 0.95rem;
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
    .alert-warning-custom {
        background: linear-gradient(135deg, rgba(255, 193, 7, 0.1) 0%, rgba(255, 193, 7, 0.05) 100%);
        border: none;
        border-left: 5px solid #ffc107;
        border-radius: 12px;
        padding: 20px;
        backdrop-filter: blur(10px);
    }

    .alert-warning-custom .alert-heading {
        color: #856404;
        font-weight: 600;
        font-size: 1.1rem;
    }

    .alert-warning-custom ul {
        list-style: none;
        padding-left: 0;
        margin-bottom: 0;
    }

    .alert-warning-custom ul li {
        padding: 4px 0;
        color: #856404;
        font-size: 0.95rem;
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

    /* Changes Indicator */
    .changes-indicator h6 {
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--dark-color);
        display: flex;
        align-items: center;
    }

    .change-item {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
        font-size: 0.9rem;
        color: var(--gray-color);
    }

    .change-item i {
        font-size: 0.6rem;
    }

    .no-changes {
        color: var(--gray-color);
    }

    /* Original Card */
    .original-content .original-title {
        font-weight: 600;
        color: var(--dark-color);
        font-size: 1.1rem;
        display: flex;
        align-items: center;
    }

    .original-content .original-price .badge {
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 500;
        background: var(--light-color);
        color: var(--gray-color);
        border: 1px solid var(--light-gray);
    }

    .original-content .original-desc {
        font-size: 0.9rem;
        line-height: 1.6;
    }

    /* Form Actions */
    .form-actions {
        padding-top: 20px;
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .edit-container {
            padding: 15px;
        }
        
        .form-actions .d-flex {
            flex-direction: column;
            gap: 15px;
        }
        
        .form-actions .d-flex > * {
            width: 100%;
            justify-content: center;
        }
        
        .form-actions .btn {
            width: 100%;
            margin-bottom: 10px;
        }
        
        .price-info .d-flex {
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
        
        .info-box .row {
            flex-direction: column;
            gap: 10px;
        }
    }

    @media (max-width: 576px) {
        .edit-container {
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
    // Store original values
    const originalData = {
        nama_layanan: "{{ $jenis_layanan->nama_layanan }}",
        harga: {{ $jenis_layanan->harga }},
        deskripsi: `{{ $jenis_layanan->deskripsi }}`
    };

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
            
            // Update price change indicator
            updateChanges();
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
            previewDesc.textContent = descTextarea.value || 'Tidak ada deskripsi';
            
            // Update changes
            updateChanges();
        }
        
        descTextarea.addEventListener('input', updateCharCount);
        
        // Update name preview
        const nameInput = document.getElementById('nama_layanan');
        const previewName = document.getElementById('previewName');
        
        nameInput.addEventListener('input', function() {
            previewName.textContent = this.value || originalData.nama_layanan;
            updateChanges();
        });
        
        // Update changes indicator
        function updateChanges() {
            // This would update the changes indicator dynamically
            // For now, we'll just log the changes
            const changes = {
                name: nameInput.value !== originalData.nama_layanan,
                price: parseInt(hargaInput.value) !== originalData.harga,
                desc: descTextarea.value !== originalData.deskripsi
            };
            
            // You could update a visual indicator here
            console.log('Changes detected:', changes);
        }
        
        // Form validation
        const form = document.getElementById('editForm');
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
            
            // Check if there are any changes
            const hasChanges = nameInput.value !== originalData.nama_layanan ||
                              parseInt(hargaInput.value) !== originalData.harga ||
                              descTextarea.value !== originalData.deskripsi;
            
            if (!hasChanges) {
                e.preventDefault();
                Swal.fire({
                    title: 'Tidak ada perubahan',
                    text: 'Anda belum melakukan perubahan apapun.',
                    icon: 'info',
                    confirmButtonColor: '#4361ee',
                });
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
    
    function resetToOriginal() {
        if (confirm('Apakah Anda yakin ingin mengembalikan semua nilai ke data asli?')) {
            document.getElementById('nama_layanan').value = originalData.nama_layanan;
            document.getElementById('harga').value = originalData.harga;
            document.getElementById('deskripsi').value = originalData.deskripsi;
            
            // Trigger updates
            document.getElementById('nama_layanan').dispatchEvent(new Event('input'));
            document.getElementById('harga').dispatchEvent(new Event('input'));
            document.getElementById('deskripsi').dispatchEvent(new Event('input'));
            
            // Show success message
            Swal.fire({
                title: 'Berhasil!',
                text: 'Data telah dikembalikan ke nilai asli.',
                icon: 'success',
                confirmButtonColor: '#4361ee',
                timer: 2000,
                showConfirmButton: false
            });
        }
    }
</script>

<!-- SweetAlert2 -->
@unless(view()->exists('layouts.includes.sweetalert'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endunless

<!-- Font Awesome Icons -->
@unless(view()->exists('layouts.includes.fontawesome'))
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endunless
@endsection