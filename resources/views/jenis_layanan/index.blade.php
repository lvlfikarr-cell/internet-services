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

<!-- Navbar Master Data -->
<nav class="navbar-master-data">
    <div class="navbar-container-master">
        <!-- Logo/Brand -->
        <a class="navbar-brand-master" href="{{ url('/') }}">
            <div class="logo-icon-master">
                <i class="fas fa-database"></i>
            </div>
            <div class="brand-text-master">
                <span class="brand-main-master">Internet Services</span>
                <span class="brand-sub-master">MASTER DATA</span>
            </div>
        </a>

        <!-- User Dropdown -->
        <div class="user-dropdown-master" id="userDropdownMaster">
            <button class="dropdown-toggle-master" type="button" id="userDropdownBtnMaster">
                <div class="user-avatar-master">
                    <i class="fas fa-user-cog"></i>
                </div>
                <div class="user-info-master">
                    <span class="user-name-master">Administrator</span>
                    <span class="user-role-master">Admin Master Data</span>
                </div>
                <i class="fas fa-chevron-down dropdown-arrow-master"></i>
            </button>

            <div class="dropdown-menu-master" id="userDropdownMenuMaster">
                <form action="{{ route('logout') }}" method="POST" class="logout-form">
                    @csrf
                    <button type="submit" class="dropdown-item-master logout">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<!-- Main Content Area -->
<div class="master-data-container" style="margin-top: 80px;">
    <!-- Header Section -->
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="page-title mb-1">Master Jenis Layanan</h1>
                    <p class="page-subtitle mb-0">Kelola berbagai jenis layanan internet yang tersedia</p>
                </div>
                <a href="{{ route('jenis-layanan.create') }}" class="btn btn-primary-custom">
                    <i class="fas fa-plus-circle me-2"></i>Tambah Layanan
                </a>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="alert alert-success-custom alert-dismissible fade show mb-4" role="alert">
        <div class="d-flex align-items-center">
            <i class="fas fa-check-circle me-3" style="font-size: 1.5rem;"></i>
            <div>
                <h5 class="alert-heading mb-1">Berhasil!</h5>
                <p class="mb-0">{{ session('success') }}</p>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Main Content -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <!-- Table Container -->
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-header">
                        <tr>
                            <th class="ps-4">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-network-wired me-2"></i>
                                    <span>Nama Layanan</span>
                                </div>
                            </th>
                            <th>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-tag me-2"></i>
                                    <span>Harga</span>
                                </div>
                            </th>
                            <th class="text-center pe-4" width="200">
                                <div class="d-flex align-items-center justify-content-center">
                                    <i class="fas fa-cogs me-2"></i>
                                    <span>Aksi</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jenisLayanans as $item)
                        <tr class="table-row">
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="service-icon me-3">
                                        <i class="fas fa-wifi"></i>
                                    </div>
                                    <div>
                                        <h6 class="service-name mb-0">{{ $item->nama_layanan }}</h6>
                                        <small class="text-muted">Layanan Internet</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="price-badge">
                                    <span class="currency">Rp</span>
                                    <span class="amount">{{ number_format($item->harga, 0, ',', '.') }}</span>
                                    <span class="period">/bulan</span>
                                </div>
                            </td>
                            <td class="text-center pe-4">
                                <div class="action-buttons">
                                    <a href="{{ route('jenis-layanan.edit', $item->id) }}" 
                                       class="btn btn-edit btn-sm me-2" 
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                        <span class="d-none d-md-inline">Edit</span>
                                    </a>
                                    <form action="{{ route('jenis-layanan.destroy', $item->id) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirmDelete(this)">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete btn-sm" title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                            <span class="d-none d-md-inline">Hapus</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-5">
                                <div class="empty-state">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">Belum ada data layanan</h5>
                                    <p class="text-muted mb-4">Tambahkan layanan pertama Anda</p>
                                    <a href="{{ route('jenis-layanan.create') }}" class="btn btn-primary-custom">
                                        <i class="fas fa-plus me-2"></i>Tambah Layanan Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Stats Footer -->
            @if($jenisLayanans->count() > 0)
            <div class="table-footer p-3 border-top">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        <i class="fas fa-info-circle me-2"></i>
                        <small>Total: {{ $jenisLayanans->count() }} jenis layanan</small>
                    </div>
                    <div>
                        <small class="text-muted">
                            <i class="fas fa-clock me-1"></i>
                            Terakhir diperbarui: {{ now()->format('d/m/Y H:i') }}
                        </small>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Quick Stats -->
    @if($jenisLayanans->count() > 0)
    <div class="row mt-4">
        <div class="col-md-4 mb-3">
            <div class="stat-card">
                <div class="stat-icon bg-primary">
                    <i class="fas fa-layer-group"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-number">{{ $jenisLayanans->count() }}</h3>
                    <p class="stat-label">Total Layanan</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="stat-card">
                <div class="stat-icon bg-success">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-number">Rp {{ number_format($jenisLayanans->avg('harga'), 0, ',', '.') }}</h3>
                    <p class="stat-label">Rata-rata Harga</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="stat-card">
                <div class="stat-icon bg-info">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-number">{{ $jenisLayanans->count() > 0 ? $jenisLayanans->count() : '0' }}</h3>
                    <p class="stat-label">Jenis Tersedia</p>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<style>
    /* Navbar Master Data Styles */
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

    /* Navbar Styling */
    .navbar-master-data {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        border-bottom: none;
        padding: 0;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1030;
        height: 70px;
        transition: all 0.3s ease;
    }

    .navbar-container-master {
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
    .navbar-brand-master {
        display: flex;
        align-items: center;
        text-decoration: none;
        color: white;
        font-weight: 700;
        font-size: 1.4rem;
        transition: all 0.3s ease;
        padding: 10px 0;
    }

    .navbar-brand-master:hover {
        color: rgba(255, 255, 255, 0.9);
        transform: translateY(-1px);
    }

    .logo-icon-master {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        color: white;
        font-size: 1.2rem;
        transition: all 0.3s ease;
    }

    .navbar-brand-master:hover .logo-icon-master {
        background: rgba(255, 255, 255, 0.3);
        transform: scale(1.05) rotate(5deg);
    }

    .brand-text-master {
        display: flex;
        flex-direction: column;
        line-height: 1.2;
    }

    .brand-main-master {
        font-weight: 700;
        font-size: 1.3rem;
        color: white;
    }

    .brand-sub-master {
        font-size: 0.75rem;
        font-weight: 500;
        color: rgba(255, 255, 255, 0.8);
        letter-spacing: 0.5px;
        margin-top: 2px;
    }

    /* User Dropdown */
    .user-dropdown-master {
        position: relative;
    }

    .dropdown-toggle-master {
        background: rgba(255, 255, 255, 0.15);
        border: 2px solid rgba(255, 255, 255, 0.2);
        border-radius: 10px;
        padding: 8px 16px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
        text-decoration: none;
        cursor: pointer;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
    }

    .dropdown-toggle-master:hover {
        background: rgba(255, 255, 255, 0.25);
        border-color: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    }

    .dropdown-toggle-master:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.1);
    }

    .user-avatar-master {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.9);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-color);
        font-weight: 600;
        font-size: 0.9rem;
        flex-shrink: 0;
    }

    .user-info-master {
        text-align: left;
        flex-grow: 1;
    }

    .user-name-master {
        font-weight: 600;
        font-size: 0.9rem;
        color: white;
        display: block;
        line-height: 1.2;
    }

    .user-role-master {
        font-size: 0.75rem;
        color: rgba(255, 255, 255, 0.8);
        font-weight: 500;
        display: block;
        line-height: 1.2;
    }

    .dropdown-arrow-master {
        font-size: 0.8rem;
        color: rgba(255, 255, 255, 0.8);
        transition: transform 0.3s ease;
    }

    .user-dropdown-master.show .dropdown-arrow-master {
        transform: rotate(180deg);
        color: white;
    }

    /* Dropdown Menu */
    .dropdown-menu-master {
        background: white;
        border: none;
        border-radius: 12px;
        box-shadow: var(--hover-shadow);
        padding: 10px 0;
        margin-top: 10px;
        border: 1px solid var(--light-gray);
        min-width: 200px;
        animation: dropdownFade 0.2s ease;
        display: none;
        position: absolute;
        top: 100%;
        right: 0;
        z-index: 1000;
    }

    .user-dropdown-master.show .dropdown-menu-master {
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

    .dropdown-item-master {
        padding: 12px 20px;
        color: var(--dark-color);
        font-weight: 500;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: all 0.2s ease;
        text-decoration: none;
        border-left: 3px solid transparent;
        cursor: pointer;
        width: 100%;
        background: none;
        border: none;
        text-align: left;
    }

    .dropdown-item-master:hover {
        background: rgba(67, 97, 238, 0.05);
        color: var(--primary-color);
        border-left-color: var(--primary-color);
        padding-left: 23px;
    }

    .dropdown-item-master i {
        width: 20px;
        text-align: center;
        font-size: 1rem;
    }

    .dropdown-item-master.logout {
        color: #dc3545;
    }

    .dropdown-item-master.logout:hover {
        background: rgba(220, 53, 69, 0.05);
        color: #dc3545;
        border-left-color: #dc3545;
    }

    /* Main Content */
    .master-data-container {
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

    /* Rest of your existing styles remain exactly the same */
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

    .btn-primary-custom {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 600;
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

    /* Alert Styling */
    .alert-success-custom {
        background: linear-gradient(135deg, rgba(40, 167, 69, 0.1) 0%, rgba(40, 167, 69, 0.05) 100%);
        border: none;
        border-left: 5px solid #28a745;
        border-radius: 12px;
        padding: 20px;
        backdrop-filter: blur(10px);
    }

    .alert-success-custom .alert-heading {
        color: #28a745;
        font-weight: 600;
        font-size: 1.1rem;
    }

    /* Table Styling */
    .table-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-bottom: 2px solid var(--primary-color);
    }

    .table-header th {
        font-weight: 600;
        color: var(--dark-color);
        padding: 18px 16px;
        border: none;
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .table-row {
        transition: all 0.3s ease;
        border-bottom: 1px solid var(--border-color);
    }

    .table-row:hover {
        background-color: rgba(67, 97, 238, 0.03);
        transform: translateY(-1px);
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
    }

    .table-row td {
        padding: 20px 16px;
        vertical-align: middle;
        border: none;
    }

    /* Service Icon */
    .service-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: linear-gradient(135deg, rgba(67, 97, 238, 0.1) 0%, rgba(114, 9, 183, 0.1) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-color);
        font-size: 1.2rem;
    }

    .service-name {
        font-weight: 600;
        color: var(--dark-color);
        font-size: 1.05rem;
    }

    /* Price Badge */
    .price-badge {
        background: linear-gradient(135deg, rgba(40, 167, 69, 0.1) 0%, rgba(40, 167, 69, 0.05) 100%);
        border-radius: 8px;
        padding: 8px 16px;
        display: inline-flex;
        align-items: center;
        border: 1px solid rgba(40, 167, 69, 0.2);
    }

    .price-badge .currency {
        font-weight: 600;
        color: #28a745;
        font-size: 0.9rem;
        margin-right: 4px;
    }

    .price-badge .amount {
        font-weight: 700;
        color: #28a745;
        font-size: 1.2rem;
    }

    .price-badge .period {
        font-weight: 500;
        color: var(--gray-color);
        font-size: 0.85rem;
        margin-left: 4px;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        justify-content: center;
        gap: 8px;
    }

    .btn-edit {
        background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
        color: white;
        border: none;
        border-radius: 6px;
        padding: 8px 16px;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-edit:hover {
        background: linear-gradient(135deg, #e0a800 0%, #e68900 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 193, 7, 0.3);
        color: white;
    }

    .btn-delete {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
        border: none;
        border-radius: 6px;
        padding: 8px 16px;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-delete:hover {
        background: linear-gradient(135deg, #c82333 0%, #bd2130 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
        color: white;
    }

    /* Empty State */
    .empty-state {
        padding: 60px 20px;
        text-align: center;
    }

    .empty-state h5 {
        font-weight: 600;
        margin: 15px 0 10px;
    }

    /* Table Footer */
    .table-footer {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 0 0 12px 12px;
    }

    /* Stat Cards */
    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: var(--card-shadow);
        border: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
        height: 100%;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--hover-shadow);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        margin-right: 20px;
        flex-shrink: 0;
    }

    .stat-icon.bg-primary {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    }

    .stat-icon.bg-success {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    }

    .stat-icon.bg-info {
        background: linear-gradient(135deg, #17a2b8 0%, #0dcaf0 100%);
    }

    .stat-number {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--dark-color);
        margin-bottom: 5px;
        line-height: 1;
    }

    .stat-label {
        font-size: 0.9rem;
        color: var(--gray-color);
        margin-bottom: 0;
        font-weight: 500;
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .navbar-container-master {
            padding: 0 20px;
        }
        
        .brand-main-master {
            font-size: 1.2rem;
        }
        
        .dropdown-toggle-master {
            padding: 6px 12px;
        }
        
        .user-name-master {
            font-size: 0.85rem;
        }
    }

    @media (max-width: 768px) {
        .navbar-master-data {
            height: 60px;
        }
        
        .master-data-container {
            margin-top: 70px !important;
            padding: 15px;
        }
        
        .navbar-container-master {
            padding: 0 15px;
        }
        
        .brand-text-master {
            display: none;
        }
        
        .logo-icon-master {
            margin-right: 0;
            width: 36px;
            height: 36px;
            font-size: 1rem;
        }
        
        .user-info-master {
            display: none;
        }
        
        .dropdown-toggle-master {
            padding: 6px 10px;
            gap: 8px;
        }
        
        .user-avatar-master {
            width: 32px;
            height: 32px;
            font-size: 0.8rem;
        }
        
        .page-title {
            font-size: 1.5rem;
        }
        
        .btn-primary-custom {
            padding: 8px 16px;
            font-size: 0.9rem;
        }
        
        .table-header th {
            padding: 14px 12px;
            font-size: 0.85rem;
        }
        
        .table-row td {
            padding: 16px 12px;
        }
        
        .service-icon {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }
        
        .service-name {
            font-size: 0.95rem;
        }
        
        .price-badge {
            padding: 6px 12px;
        }
        
        .price-badge .amount {
            font-size: 1rem;
        }
        
        .action-buttons {
            flex-direction: column;
            gap: 5px;
        }
        
        .btn-edit, .btn-delete {
            width: 100%;
            justify-content: center;
            padding: 6px 12px;
            font-size: 0.85rem;
        }
        
        .stat-card {
            padding: 15px;
        }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            font-size: 1.3rem;
            margin-right: 15px;
        }
        
        .stat-number {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 576px) {
        .navbar-master-data {
            height: 60px;
        }
        
        .master-data-container {
            margin-top: 70px !important;
            padding: 10px;
        }
        
        .dropdown-menu-master {
            min-width: 180px;
            right: 10px !important;
            left: auto !important;
        }
        
        .page-title {
            font-size: 1.3rem;
        }
        
        .page-subtitle {
            font-size: 0.85rem;
        }
        
        .btn-primary-custom span {
            display: none;
        }
        
        .btn-primary-custom i {
            margin-right: 0;
        }
        
        .service-icon {
            width: 36px;
            height: 36px;
            font-size: 0.9rem;
            margin-right: 12px;
        }
        
        .stat-card {
            padding: 12px;
        }
        
        .stat-icon {
            width: 40px;
            height: 40px;
            font-size: 1.1rem;
            margin-right: 12px;
        }
        
        .stat-number {
            font-size: 1.3rem;
        }
        
        .stat-label {
            font-size: 0.8rem;
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

    /* Ripple Effect Animation */
    @keyframes ripple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
</style>

<script>
    // Navbar dropdown functionality
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownContainer = document.querySelector('#userDropdownMaster');
        const dropdownBtn = document.querySelector('#userDropdownBtnMaster');
        const dropdownMenu = document.querySelector('#userDropdownMenuMaster');
        
        if (dropdownBtn && dropdownMenu) {
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
                ripple.style.background = 'rgba(255, 255, 255, 0.3)';
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
                        ? '0 4px 15px rgba(0, 0, 0, 0.2)'
                        : '0 2px 10px rgba(0, 0, 0, 0.1)';
                }
            });
        }

        // Original table functionality remains
        const tableRows = document.querySelectorAll('.table-row');
        tableRows.forEach((row, index) => {
            row.style.animationDelay = `${index * 0.05}s`;
        });

        // Auto-dismiss alert after 5 seconds
        const alert = document.querySelector('.alert-success-custom');
        if (alert) {
            setTimeout(() => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 5000);
        }

        // Add smooth hover effects
        const cards = document.querySelectorAll('.stat-card, .btn-primary-custom');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-3px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    });

    function confirmDelete(form) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4361ee',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
            return false;
        } else {
            // Fallback to native confirm if SweetAlert is not available
            return confirm('Apakah Anda yakin ingin menghapus data ini?');
        }
    }
</script>

<!-- SweetAlert2 for beautiful confirmation -->
@unless(view()->exists('layouts.includes.sweetalert'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endunless

<!-- Font Awesome Icons -->
@unless(view()->exists('layouts.includes.fontawesome'))
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endunless

<!-- Bootstrap JS Modal Support -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection