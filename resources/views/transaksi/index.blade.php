@extends('layouts.user')

@section('content')



<div class="user-services-container">
    <!-- Hero Section -->
    <div class="hero-section mb-5">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="hero-title mb-3">Pilih Paket Internet Anda</h1>
                <p class="hero-subtitle mb-4">
                    Temukan paket internet terbaik sesuai kebutuhan Anda. Berlangganan sekarang dan nikmati internet cepat tanpa batas.
                </p>
                <div class="hero-stats">
                    <div class="stat-item">
                        <i class="fas fa-bolt"></i>
                        <span>Kecepatan Tinggi</span>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-shield-alt"></i>
                        <span>Stabil & Aman</span>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-headset"></i>
                        <span>Support 24/7</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-lg-end">
                <div class="hero-icon">
                    <i class="fas fa-wifi"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="filter-section mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="filter-buttons">
                    <button class="filter-btn active" data-filter="all">Semua Layanan</button>
                    <button class="filter-btn" data-filter="popular">Populer</button>
                    <button class="filter-btn" data-filter="economic">Ekonomis</button>
                    <button class="filter-btn" data-filter="premium">Premium</button>
                </div>
            </div>
            <div class="col-md-4">
                <div class="search-box">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" class="form-control" id="searchInput" placeholder="Cari layanan...">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Services Grid -->
    <div class="services-grid" id="servicesGrid">
        @forelse($layanans as $layanan)
        @php
            // Determine package type based on price
            $price = $layanan->harga;
            if ($price <= 200000) {
                $type = 'economic';
                $badgeColor = 'success';
                $badgeText = 'Ekonomis';
            } elseif ($price <= 500000) {
                $type = 'popular';
                $badgeColor = 'primary';
                $badgeText = 'Populer';
            } else {
                $type = 'premium';
                $badgeColor = 'warning';
                $badgeText = 'Premium';
            }
            
            // Determine speed from name
            $speed = '50 Mbps';
            if (strpos($layanan->nama_layanan, '100') !== false) $speed = '100 Mbps';
            if (strpos($layanan->nama_layanan, '200') !== false) $speed = '200 Mbps';
            if (strpos($layanan->nama_layanan, '300') !== false) $speed = '300 Mbps';
            if (strpos($layanan->nama_layanan, '500') !== false) $speed = '500 Mbps';
        @endphp
        
        <div class="service-card" data-type="{{ $type }}">
            <!-- Badge -->
            <div class="service-badge badge-{{ $badgeColor }}">
                <i class="fas fa-star me-1"></i>{{ $badgeText }}
            </div>
            
            <!-- Header -->
            <div class="service-header">
                <div class="service-icon">
                    <i class="fas fa-wifi"></i>
                </div>
                <h3 class="service-title">{{ $layanan->nama_layanan }}</h3>
                <div class="service-speed">
                    <i class="fas fa-tachometer-alt me-2"></i>
                    <span>{{ $speed }}</span>
                </div>
            </div>
            
            <!-- Price -->
            <div class="service-price">
                <div class="price-amount">Rp {{ number_format($layanan->harga, 0, ',', '.') }}</div>
                <div class="price-period">per bulan</div>
            </div>
            
            <!-- Features -->
            <div class="service-features">
                <div class="feature-item">
                    <i class="fas fa-check text-success me-2"></i>
                    <span>Internet Unlimited</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-check text-success me-2"></i>
                    <span>Download {{ $speed }}</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-check text-success me-2"></i>
                    <span>Upload {{ $speed }}</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-check text-success me-2"></i>
                    <span>Support 24/7</span>
                </div>
                @if($layanan->deskripsi)
                <div class="feature-desc">
                    <small class="text-muted">{{ Str::limit($layanan->deskripsi, 80) }}</small>
                </div>
                @endif
            </div>
            
            <!-- Action Button -->
            <div class="service-action">
                <a href="{{ route('transaksi.create', $layanan->id) }}" 
                   class="btn-subscribe">
                    <i class="fas fa-shopping-cart me-2"></i>
                    Berlangganan Sekarang
                </a>
                <a href="#" class="btn-detail" onclick="showDetail({{ $layanan->id }})">
                    <i class="fas fa-info-circle me-2"></i>
                    Detail Layanan
                </a>
            </div>
        </div>
        @empty
        <!-- Empty State -->
        <div class="empty-state col-12">
            <div class="empty-icon">
                <i class="fas fa-wifi-slash"></i>
            </div>
            <h4 class="empty-title">Belum ada layanan tersedia</h4>
            <p class="empty-text">Silakan hubungi admin untuk informasi lebih lanjut.</p>
        </div>
        @endforelse
    </div>

    <!-- Compare Section -->
    @if($layanans->count() >= 2)
    <div class="compare-section mt-5 pt-4 border-top">
        <h3 class="section-title mb-4">
            <i class="fas fa-balance-scale me-2"></i>Bandingkan Paket
        </h3>
        <div class="compare-table">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="25%">Fitur</th>
                            @foreach($layanans as $layanan)
                            <th class="text-center">{{ $layanan->nama_layanan }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Harga per Bulan</td>
                            @foreach($layanans as $layanan)
                            <td class="text-center fw-bold text-success">
                                Rp {{ number_format($layanan->harga, 0, ',', '.') }}
                            </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Kecepatan</td>
                            @foreach($layanans as $layanan)
                            <td class="text-center">
                                @php
                                    $speed = '50 Mbps';
                                    if (strpos($layanan->nama_layanan, '100') !== false) $speed = '100 Mbps';
                                    if (strpos($layanan->nama_layanan, '200') !== false) $speed = '200 Mbps';
                                    if (strpos($layanan->nama_layanan, '300') !== false) $speed = '300 Mbps';
                                @endphp
                                {{ $speed }}
                            </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Kuota</td>
                            @foreach($layanans as $layanan)
                            <td class="text-center">Unlimited</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Kontrak</td>
                            @foreach($layanans as $layanan)
                            <td class="text-center">12 Bulan</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td></td>
                            @foreach($layanans as $layanan)
                            <td class="text-center">
                                <a href="{{ route('transaksi.create', $layanan->id) }}" 
                                   class="btn btn-sm btn-primary">
                                    Pilih
                                </a>
                            </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

    <!-- FAQ Section -->
    <div class="faq-section mt-5 pt-4 border-top">
        <h3 class="section-title mb-4">
            <i class="fas fa-question-circle me-2"></i>Pertanyaan Umum
        </h3>
        <div class="accordion" id="faqAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                        Bagaimana cara berlangganan?
                    </button>
                </h2>
                <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Klik tombol "Berlangganan Sekarang" pada paket yang Anda pilih, kemudian isi formulir pendaftaran.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                        Apa saja metode pembayaran?
                    </button>
                </h2>
                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Kami menerima transfer bank, e-wallet, dan pembayaran tunai melalui kantor kami.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                        Berapa lama proses instalasi?
                    </button>
                </h2>
                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Instalasi akan dilakukan dalam 1-3 hari kerja setelah pembayaran dikonfirmasi.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-info-circle me-2"></i>Detail Layanan
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalBody">
                <!-- Content will be loaded via JavaScript -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <a href="#" class="btn btn-primary" id="subscribeBtn">
                    <i class="fas fa-shopping-cart me-2"></i>Berlangganan
                </a>
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
        --card-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        --hover-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
    }

    .user-services-container {
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

    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, rgba(67, 97, 238, 0.05) 0%, rgba(114, 9, 183, 0.05) 100%);
        border-radius: 20px;
        padding: 40px;
        border: 1px solid rgba(67, 97, 238, 0.1);
    }

    .hero-title {
        font-size: 2.2rem;
        font-weight: 700;
        color: var(--dark-color);
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-subtitle {
        font-size: 1.1rem;
        color: var(--gray-color);
        max-width: 600px;
        line-height: 1.6;
    }

    .hero-stats {
        display: flex;
        gap: 30px;
        margin-top: 25px;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--primary-color);
        font-weight: 500;
    }

    .stat-item i {
        font-size: 1.2rem;
        background: rgba(67, 97, 238, 0.1);
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .hero-icon {
        font-size: 8rem;
        color: rgba(67, 97, 238, 0.1);
        text-align: center;
    }

    /* Filter Section */
    .filter-section {
        background: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: var(--card-shadow);
        margin-bottom: 30px;
    }

    .filter-buttons {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .filter-btn {
        padding: 10px 20px;
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
        transform: translateY(-2px);
    }

    .search-box .input-group {
        border-radius: 8px;
        overflow: hidden;
        border: 2px solid var(--light-gray);
        transition: all 0.3s ease;
    }

    .search-box .input-group:focus-within {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
    }

    .search-box .input-group-text {
        background: white;
        border: none;
        color: var(--gray-color);
    }

    .search-box .form-control {
        border: none;
        padding: 12px 15px;
    }

    .search-box .form-control:focus {
        box-shadow: none;
    }

    /* Services Grid */
    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 25px;
        margin-bottom: 40px;
    }

    @media (max-width: 768px) {
        .services-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Service Card */
    .service-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: var(--card-shadow);
        border: 1px solid var(--light-gray);
        transition: all 0.3s ease;
        position: relative;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .service-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--hover-shadow);
        border-color: var(--primary-color);
    }

    .service-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        display: flex;
        align-items: center;
    }

    .badge-success {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
    }

    .badge-primary {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
    }

    .badge-warning {
        background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
        color: white;
    }

    .service-header {
        text-align: center;
        margin-bottom: 25px;
    }

    .service-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(67, 97, 238, 0.1) 0%, rgba(114, 9, 183, 0.1) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        color: var(--primary-color);
        font-size: 2rem;
    }

    .service-title {
        font-size: 1.4rem;
        font-weight: 600;
        color: var(--dark-color);
        margin-bottom: 10px;
    }

    .service-speed {
        color: var(--gray-color);
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .service-price {
        text-align: center;
        margin-bottom: 25px;
        padding-bottom: 25px;
        border-bottom: 1px solid var(--light-gray);
    }

    .price-amount {
        font-size: 2.2rem;
        font-weight: 700;
        color: #28a745;
        line-height: 1;
    }

    .price-period {
        color: var(--gray-color);
        font-size: 0.95rem;
        margin-top: 5px;
    }

    .service-features {
        flex-grow: 1;
        margin-bottom: 25px;
    }

    .feature-item {
        display: flex;
        align-items: center;
        margin-bottom: 12px;
        font-size: 0.95rem;
        color: var(--dark-color);
    }

    .feature-desc {
        margin-top: 20px;
        padding-top: 15px;
        border-top: 1px solid var(--light-gray);
    }

    .service-action {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .btn-subscribe {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 14px;
        font-weight: 600;
        font-size: 1rem;
        text-align: center;
        text-decoration: none;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-subscribe:hover {
        background: linear-gradient(135deg, var(--primary-dark) 0%, #6411ad 100%);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        color: white;
    }

    .btn-detail {
        background: transparent;
        color: var(--primary-color);
        border: 2px solid var(--light-gray);
        border-radius: 8px;
        padding: 12px;
        font-weight: 500;
        font-size: 0.95rem;
        text-align: center;
        text-decoration: none;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-detail:hover {
        background: rgba(67, 97, 238, 0.05);
        border-color: var(--primary-color);
        color: var(--primary-color);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        grid-column: 1 / -1;
    }

    .empty-icon {
        font-size: 4rem;
        color: var(--light-gray);
        margin-bottom: 20px;
    }

    .empty-title {
        color: var(--gray-color);
        font-weight: 600;
        margin-bottom: 10px;
    }

    .empty-text {
        color: var(--gray-color);
        font-size: 1.1rem;
    }

    /* Compare Section */
    .section-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--dark-color);
        display: flex;
        align-items: center;
    }

    .compare-table {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: var(--card-shadow);
    }

    .compare-table th {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        font-weight: 600;
        padding: 20px;
        border-bottom: 2px solid var(--primary-color);
    }

    .compare-table td {
        padding: 20px;
        vertical-align: middle;
    }

    .compare-table tr:hover {
        background: rgba(67, 97, 238, 0.03);
    }

    /* FAQ Section */
    .faq-section .accordion-item {
        border: 1px solid var(--light-gray);
        border-radius: 10px;
        margin-bottom: 10px;
        overflow: hidden;
    }

    .faq-section .accordion-button {
        background: white;
        color: var(--dark-color);
        font-weight: 600;
        padding: 20px;
        border: none;
        box-shadow: none;
    }

    .faq-section .accordion-button:not(.collapsed) {
        background: rgba(67, 97, 238, 0.05);
        color: var(--primary-color);
    }

    .faq-section .accordion-body {
        padding: 20px;
        color: var(--gray-color);
        line-height: 1.6;
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

    /* Responsive */
    @media (max-width: 768px) {
        .user-services-container {
            padding: 15px;
        }
        
        .hero-section {
            padding: 30px 20px;
            text-align: center;
        }
        
        .hero-title {
            font-size: 1.8rem;
        }
        
        .hero-stats {
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
        }
        
        .hero-icon {
            font-size: 6rem;
            margin-top: 20px;
        }
        
        .filter-buttons {
            justify-content: center;
            margin-bottom: 20px;
        }
        
        .service-card {
            padding: 25px;
        }
        
        .price-amount {
            font-size: 1.8rem;
        }
        
        .section-title {
            font-size: 1.3rem;
        }
    }

    @media (max-width: 576px) {
        .user-services-container {
            padding: 10px;
        }
        
        .hero-section {
            padding: 25px 15px;
        }
        
        .hero-title {
            font-size: 1.5rem;
        }
        
        .hero-subtitle {
            font-size: 1rem;
        }
        
        .service-card {
            padding: 20px;
        }
        
        .service-icon {
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
        }
        
        .service-title {
            font-size: 1.2rem;
        }
        
        .price-amount {
            font-size: 1.5rem;
        }
        
        .btn-subscribe,
        .btn-detail {
            padding: 12px;
            font-size: 0.9rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Filter functionality
        const filterButtons = document.querySelectorAll('.filter-btn');
        const serviceCards = document.querySelectorAll('.service-card');
        const searchInput = document.getElementById('searchInput');
        
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Update active button
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                
                const filter = this.dataset.filter;
                
                // Filter cards
                serviceCards.forEach(card => {
                    if (filter === 'all' || card.dataset.type === filter) {
                        card.style.display = 'block';
                        setTimeout(() => {
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0)';
                        }, 10);
                    } else {
                        card.style.opacity = '0';
                        card.style.transform = 'translateY(20px)';
                        setTimeout(() => {
                            card.style.display = 'none';
                        }, 300);
                    }
                });
            });
        });
        
        // Search functionality
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            
            serviceCards.forEach(card => {
                const title = card.querySelector('.service-title').textContent.toLowerCase();
                const features = card.querySelector('.service-features').textContent.toLowerCase();
                
                if (title.includes(searchTerm) || features.includes(searchTerm) || searchTerm === '') {
                    card.style.display = 'block';
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, 10);
                } else {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        card.style.display = 'none';
                    }, 300);
                }
            });
        });
        
        // Add hover animation
        serviceCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
        
        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
    
    function showDetail(layananId) {
        // In a real application, you would fetch this data via AJAX
        // For now, we'll use the existing data or show a loading state
        
        const modal = new bootstrap.Modal(document.getElementById('detailModal'));
        const modalBody = document.getElementById('modalBody');
        const subscribeBtn = document.getElementById('subscribeBtn');
        
        // Set subscribe link
        subscribeBtn.href = `/transaksi/create/${layananId}`;
        
        // Find the service card data
        const serviceCard = document.querySelector(`[data-layanan-id="${layananId}"]`);
        if (serviceCard) {
            const title = serviceCard.querySelector('.service-title').textContent;
            const price = serviceCard.querySelector('.price-amount').textContent;
            const features = serviceCard.querySelector('.service-features').innerHTML;
            
            modalBody.innerHTML = `
                <div class="row">
                    <div class="col-md-4">
                        <div class="text-center mb-4">
                            <div class="service-icon-lg mb-3">
                                <i class="fas fa-wifi"></i>
                            </div>
                            <h4>${title}</h4>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="detail-price mb-4">
                            <h3 class="text-success">${price} <small class="text-muted">/bulan</small></h3>
                        </div>
                        <h5 class="mb-3">Fitur Utama:</h5>
                        <div class="detail-features">
                            ${features}
                        </div>
                    </div>
                </div>
            `;
        } else {
            modalBody.innerHTML = `
                <div class="text-center py-5">
                    <div class="spinner-border text-primary mb-3" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p>Memuat detail layanan...</p>
                </div>
            `;
            
            // Simulate API call
            setTimeout(() => {
                modalBody.innerHTML = `
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Detail lengkap akan ditampilkan di sini.
                    </div>
                `;
            }, 1000);
        }
        
        modal.show();
    }
    
    // Add data-layanan-id to cards
    document.querySelectorAll('.service-card').forEach((card, index) => {
        card.setAttribute('data-layanan-id', index + 1);
    });
</script>

<!-- Bootstrap JS (if not already included) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Font Awesome Icons -->
@unless(view()->exists('layouts.includes.fontawesome'))
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endunless
@endsection