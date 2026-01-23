@extends('layouts.user')

@section('content')
<div class="history-container">
    <!-- Header -->
    <div class="header-section mb-5">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('transaksi.index') }}" class="breadcrumb-link">
                        <i class="fas fa-arrow-left me-2"></i>Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Riwayat Langganan</li>
            </ol>
        </nav>
        
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title mb-2">Riwayat Langganan Saya</h1>
                <p class="page-subtitle">Catatan semua layanan internet yang pernah Anda langgani</p>
            </div>
            <div class="header-stats">
                <div class="stat-badge">
                    <i class="fas fa-history me-2"></i>
                    <span>{{ $transaksis->count() }} Transaksi</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    @if($transaksis->count() > 0)
    <div class="row mb-5">
        <div class="col-md-4 mb-4">
            <div class="stat-card">
                <div class="stat-icon bg-primary">
                    <i class="fas fa-layer-group"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-number">{{ $transaksis->count() }}</h3>
                    <p class="stat-label">Total Transaksi</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="stat-card">
                <div class="stat-icon bg-success">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-number">Rp {{ number_format($transaksis->sum(function($trx) { return $trx->jenisLayanan->harga; }), 0, ',', '.') }}</h3>
                    <p class="stat-label">Total Pengeluaran</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="stat-card">
                <div class="stat-icon bg-info">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-number">
                        @if($transaksis->count() > 0)
                            {{ \Carbon\Carbon::parse($transaksis->first()->tanggal_berlangganan)->format('d M Y') }}
                        @else
                            -
                        @endif
                    </h3>
                    <p class="stat-label">Transaksi Terakhir</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Filter Section -->
    <div class="filter-section mb-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="filter-buttons">
                    <button class="filter-btn active" data-filter="all">Semua</button>
                    <button class="filter-btn" data-filter="active">Aktif</button>
                    <button class="filter-btn" data-filter="expired">Berakhir</button>
                    <button class="filter-btn" data-filter="this-year">Tahun Ini</button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex justify-content-end">
                    <div class="dropdown">
                        <button class="btn btn-sort dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-sort-amount-down me-2"></i>Urutkan
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" data-sort="newest">Terbaru</a></li>
                            <li><a class="dropdown-item" href="#" data-sort="oldest">Terlama</a></li>
                            <li><a class="dropdown-item" href="#" data-sort="price-high">Harga Tertinggi</a></li>
                            <li><a class="dropdown-item" href="#" data-sort="price-low">Harga Terendah</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <!-- Transactions Table -->
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-header">
                        <tr>
                            <th class="ps-4">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-wifi me-2"></i>
                                    <span>Layanan</span>
                                </div>
                            </th>
                            <th>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-calendar me-2"></i>
                                    <span>Tanggal Berlangganan</span>
                                </div>
                            </th>
                            <th>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-calendar-check me-2"></i>
                                    <span>Status</span>
                                </div>
                            </th>
                            <th class="text-end pe-4">
                                <div class="d-flex align-items-center justify-content-end">
                                    <i class="fas fa-tag me-2"></i>
                                    <span>Harga</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksis as $trx)
                        @php
                            // Determine status
                            $subscriptionDate = \Carbon\Carbon::parse($trx->tanggal_berlangganan);
                            $now = \Carbon\Carbon::now();
                            $monthsPassed = $subscriptionDate->diffInMonths($now);
                            $isActive = $monthsPassed <= 12; // Assuming 1-year contract
                            $status = $isActive ? 'active' : 'expired';
                            $statusText = $isActive ? 'Aktif' : 'Berakhir';
                            $statusColor = $isActive ? 'success' : 'secondary';
                            
                            // Determine if this year
                            $isThisYear = $subscriptionDate->year == $now->year;
                        @endphp
                        <tr class="transaction-row" 
                            data-status="{{ $status }}"
                            data-date="{{ $trx->tanggal_berlangganan }}"
                            data-price="{{ $trx->jenisLayanan->harga }}"
                            data-this-year="{{ $isThisYear ? 'yes' : 'no' }}">
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="service-icon me-3">
                                        <i class="fas fa-wifi"></i>
                                    </div>
                                    <div>
                                        <h6 class="service-name mb-0">{{ $trx->jenisLayanan->nama_layanan }}</h6>
                                        <small class="text-muted">Internet Unlimited</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="date-info">
                                    <div class="date-main">{{ $subscriptionDate->format('d M Y') }}</div>
                                    <div class="date-ago text-muted">
                                        {{ $subscriptionDate->diffForHumans() }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="status-badge bg-{{ $statusColor }}">
                                    <i class="fas fa-circle me-1"></i>{{ $statusText }}
                                </span>
                                @if($isActive)
                                <div class="progress mt-2" style="height: 5px; width: 100px;">
                                    @php
                                        $progress = min(100, ($monthsPassed / 12) * 100);
                                    @endphp
                                    <div class="progress-bar bg-success" role="progressbar" 
                                         style="width: {{ $progress }}%"
                                         aria-valuenow="{{ $progress }}" 
                                         aria-valuemin="0" 
                                         aria-valuemax="100">
                                    </div>
                                </div>
                                <small class="text-muted">{{ 12 - $monthsPassed }} bulan lagi</small>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <div class="price-info">
                                    <div class="price-amount">Rp {{ number_format($trx->jenisLayanan->harga, 0, ',', '.') }}</div>
                                    <div class="price-period">/bulan</div>
                                    @if(!$isActive)
                                    <div class="renew-link">
                                        <a href="{{ route('transaksi.create', $trx->jenisLayanan->id) }}" 
                                           class="btn btn-sm btn-outline-primary mt-2">
                                            <i class="fas fa-redo me-1"></i>Perpanjang
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <!-- Empty State -->
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <div class="empty-state">
                                    <i class="fas fa-history fa-3x text-muted mb-3"></i>
                                    <h4 class="text-muted">Belum ada riwayat langganan</h4>
                                    <p class="text-muted mb-4">Mulai langganan layanan pertama Anda</p>
                                    <a href="{{ route('transaksi.index') }}" class="btn btn-primary-custom">
                                        <i class="fas fa-plus me-2"></i>Berlangganan Sekarang
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Table Footer -->
            @if($transaksis->count() > 0)
            <div class="table-footer p-3 border-top">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        <i class="fas fa-info-circle me-2"></i>
                        <small>Menampilkan {{ $transaksis->count() }} riwayat langganan</small>
                    </div>
                    <div>
                        <small class="text-muted">
                            <i class="fas fa-clock me-1"></i>
                            Diperbarui: {{ now()->format('d/m/Y H:i') }}
                        </small>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="action-buttons mt-4">
        <div class="d-flex justify-content-between">
            <a href="{{ route('transaksi.index') }}" class="btn btn-secondary-custom">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
            </a>
            @if($transaksis->count() > 0)
            <div>
                <button class="btn btn-outline-success me-2" onclick="exportHistory()">
                    <i class="fas fa-file-export me-2"></i>Export PDF
                </button>
                <a href="{{ route('transaksi.index') }}" class="btn btn-primary-custom">
                    <i class="fas fa-plus me-2"></i>Berlangganan Baru
                </a>
            </div>
            @endif
        </div>
    </div>

    <!-- Timeline View (Alternative) -->
    @if($transaksis->count() > 0)
    <div class="timeline-section mt-5 pt-4 border-top">
        <h3 class="section-title mb-4">
            <i class="fas fa-stream me-2"></i>Timeline Langganan
        </h3>
        <div class="timeline">
            @foreach($transaksis as $index => $trx)
            @php
                $subscriptionDate = \Carbon\Carbon::parse($trx->tanggal_berlangganan);
                $isActive = $subscriptionDate->diffInMonths(now()) <= 12;
                $isFirst = $index === 0;
                $isLast = $index === $transaksis->count() - 1;
            @endphp
            <div class="timeline-item {{ $isFirst ? 'first' : '' }} {{ $isLast ? 'last' : '' }}">
                <div class="timeline-marker {{ $isActive ? 'active' : 'inactive' }}"></div>
                <div class="timeline-content">
                    <div class="timeline-date">{{ $subscriptionDate->format('d M Y') }}</div>
                    <h5 class="timeline-title">{{ $trx->jenisLayanan->nama_layanan }}</h5>
                    <p class="timeline-desc">
                        Rp {{ number_format($trx->jenisLayanan->harga, 0, ',', '.') }} / bulan
                        • {{ $isActive ? 'Masih aktif' : 'Telah berakhir' }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
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

    .history-container {
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

    .header-stats .stat-badge {
        background: rgba(67, 97, 238, 0.1);
        color: var(--primary-color);
        padding: 10px 20px;
        border-radius: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        border: 2px solid rgba(67, 97, 238, 0.2);
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

    /* Filter Section */
    .filter-section {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: var(--card-shadow);
        margin-bottom: 20px;
    }

    .filter-buttons {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .filter-btn {
        padding: 8px 20px;
        border: 2px solid var(--light-gray);
        border-radius: 8px;
        background: white;
        color: var(--gray-color);
        font-weight: 500;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .filter-btn:hover,
    .filter-btn.active {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }

    .btn-sort {
        background: white;
        border: 2px solid var(--light-gray);
        color: var(--dark-color);
        font-weight: 500;
        padding: 8px 20px;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-sort:hover {
        border-color: var(--primary-color);
        color: var(--primary-color);
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
    }

    .transaction-row {
        transition: all 0.3s ease;
        border-bottom: 1px solid var(--border-color);
    }

    .transaction-row:hover {
        background-color: rgba(67, 97, 238, 0.03);
    }

    .transaction-row td {
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

    /* Date Info */
    .date-info .date-main {
        font-weight: 600;
        color: var(--dark-color);
        font-size: 1rem;
    }

    .date-info .date-ago {
        font-size: 0.85rem;
        margin-top: 2px;
    }

    /* Status Badge */
    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
    }

    .status-badge i {
        font-size: 0.6rem;
    }

    .bg-success {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
    }

    .bg-secondary {
        background: linear-gradient(135deg, #6c757d 0%, #adb5bd 100%);
        color: white;
    }

    /* Price Info */
    .price-info {
        text-align: right;
    }

    .price-amount {
        font-weight: 700;
        color: #28a745;
        font-size: 1.2rem;
    }

    .price-period {
        font-size: 0.85rem;
        color: var(--gray-color);
    }

    .renew-link .btn {
        font-size: 0.8rem;
        padding: 4px 12px;
    }

    /* Empty State */
    .empty-state {
        padding: 60px 20px;
        text-align: center;
    }

    .empty-state h4 {
        font-weight: 600;
        margin: 15px 0 10px;
        color: var(--gray-color);
    }

    .empty-state p {
        color: var(--gray-color);
        margin-bottom: 20px;
    }

    /* Table Footer */
    .table-footer {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 0 0 12px 12px;
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

    /* Timeline */
    .section-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--dark-color);
        display: flex;
        align-items: center;
    }

    .timeline {
        position: relative;
        padding-left: 30px;
    }

    .timeline:before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 2px;
        background: linear-gradient(to bottom, var(--primary-color), var(--secondary-color));
    }

    .timeline-item {
        position: relative;
        margin-bottom: 30px;
    }

    .timeline-marker {
        position: absolute;
        left: -38px;
        top: 5px;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        border: 3px solid white;
        z-index: 1;
    }

    .timeline-marker.active {
        background: var(--primary-color);
    }

    .timeline-marker.inactive {
        background: var(--gray-color);
    }

    .timeline-content {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: var(--card-shadow);
        border: 1px solid var(--border-color);
    }

    .timeline-date {
        font-size: 0.9rem;
        color: var(--gray-color);
        margin-bottom: 5px;
    }

    .timeline-title {
        font-weight: 600;
        color: var(--dark-color);
        font-size: 1.1rem;
        margin-bottom: 5px;
    }

    .timeline-desc {
        color: var(--gray-color);
        font-size: 0.9rem;
        margin-bottom: 0;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .history-container {
            padding: 15px;
        }
        
        .page-title {
            font-size: 1.5rem;
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
        
        .filter-buttons {
            justify-content: center;
            margin-bottom: 15px;
        }
        
        .btn-sort {
            width: 100%;
        }
        
        .table-header th {
            padding: 14px 12px;
            font-size: 0.85rem;
        }
        
        .transaction-row td {
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
        
        .action-buttons .d-flex {
            flex-direction: column;
            gap: 15px;
        }
        
        .action-buttons .btn {
            width: 100%;
            justify-content: center;
        }
        
        .timeline {
            padding-left: 20px;
        }
        
        .timeline-marker {
            left: -28px;
            width: 12px;
            height: 12px;
        }
    }

    @media (max-width: 576px) {
        .history-container {
            padding: 10px;
        }
        
        .page-title {
            font-size: 1.3rem;
        }
        
        .page-subtitle {
            font-size: 0.85rem;
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
        
        .filter-btn {
            padding: 6px 15px;
            font-size: 0.85rem;
        }
        
        .price-amount {
            font-size: 1rem;
        }
        
        .btn-primary-custom,
        .btn-secondary-custom {
            padding: 10px 16px;
            font-size: 0.9rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Filter functionality
        const filterButtons = document.querySelectorAll('.filter-btn');
        const transactionRows = document.querySelectorAll('.transaction-row');
        const sortDropdownItems = document.querySelectorAll('.dropdown-item[data-sort]');
        
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Update active button
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                
                const filter = this.dataset.filter;
                
                // Filter rows
                transactionRows.forEach(row => {
                    const status = row.dataset.status;
                    const thisYear = row.dataset.thisYear;
                    
                    let showRow = false;
                    
                    switch(filter) {
                        case 'all':
                            showRow = true;
                            break;
                        case 'active':
                            showRow = status === 'active';
                            break;
                        case 'expired':
                            showRow = status === 'expired';
                            break;
                        case 'this-year':
                            showRow = thisYear === 'yes';
                            break;
                    }
                    
                    if (showRow) {
                        row.style.display = '';
                        setTimeout(() => {
                            row.style.opacity = '1';
                        }, 10);
                    } else {
                        row.style.opacity = '0';
                        setTimeout(() => {
                            row.style.display = 'none';
                        }, 300);
                    }
                });
            });
        });
        
        // Sort functionality
        sortDropdownItems.forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                const sortType = this.dataset.sort;
                
                // Get all visible rows
                const rows = Array.from(document.querySelectorAll('.transaction-row:not([style*="display: none"])'));
                
                // Sort rows
                rows.sort((a, b) => {
                    switch(sortType) {
                        case 'newest':
                            return new Date(b.dataset.date) - new Date(a.dataset.date);
                        case 'oldest':
                            return new Date(a.dataset.date) - new Date(b.dataset.date);
                        case 'price-high':
                            return parseInt(b.dataset.price) - parseInt(a.dataset.price);
                        case 'price-low':
                            return parseInt(a.dataset.price) - parseInt(b.dataset.price);
                        default:
                            return 0;
                    }
                });
                
                // Reorder table rows
                const tbody = document.querySelector('tbody');
                rows.forEach(row => {
                    tbody.appendChild(row);
                });
                
                // Update sort button text
                const sortBtn = document.querySelector('.btn-sort');
                sortBtn.innerHTML = `<i class="fas fa-sort-amount-down me-2"></i>${this.textContent}`;
            });
        });
        
        // Add hover effects to rows
        transactionRows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.transform = 'translateX(5px)';
            });
            
            row.addEventListener('mouseleave', function() {
                this.style.transform = 'translateX(0)';
            });
        });
        
        // Export functionality
        window.exportHistory = function() {
            Swal.fire({
                title: 'Export Riwayat',
                text: 'Riwayat langganan akan diexport dalam format PDF',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#4361ee',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Export',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Simulate export process
                    Swal.fire({
                        title: 'Mengexport...',
                        html: 'Sedang memproses file PDF',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    
                    setTimeout(() => {
                        Swal.fire(
                            'Berhasil!',
                            'File PDF berhasil di-generate',
                            'success'
                        );
                    }, 2000);
                }
            });
        };
    });
</script>

<!-- SweetAlert2 -->
@unless(view()->exists('layouts.includes.sweetalert'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endif

<!-- Font Awesome Icons -->
@unless(view()->exists('layouts.includes.fontawesome'))
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endunless
@endsection