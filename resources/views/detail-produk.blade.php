@extends('layouts.app')

@section('title', $product->nama . ' - PhoneStore')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.7/glider.min.css">
<style>
    :root {
        --primary: #4f46e5;
        --primary-dark: #3730a3;
        --secondary: #06b6d4;
        --accent: #f59e0b;
        --dark: #0f172a;
        --gray: #64748b;
        --light: #f8fafc;
        --success: #10b981;
        --danger: #ef4444;
        --shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        --shadow-lg: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }

    .phonestore-detail * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .phonestore-detail {
        font-family: 'Inter', system-ui, sans-serif;
        color: var(--dark);
        background: var(--light);
        line-height: 1.6;
    }

    .phonestore-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    /* Breadcrumb */
    .phonestore-breadcrumb {
        background: white;
        padding: 1rem 0;
        border-bottom: 1px solid #e2e8f0;
    }

    .phonestore-breadcrumb-list {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        list-style: none;
        font-size: 0.9rem;
    }

    .phonestore-breadcrumb-item {
        color: var(--gray);
    }

    .phonestore-breadcrumb-item a {
        color: var(--primary);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .phonestore-breadcrumb-item a:hover {
        color: var(--primary-dark);
    }

    .phonestore-breadcrumb-separator {
        color: #cbd5e1;
    }

    /* Product Detail Section */
    .phonestore-product-detail {
        padding: 3rem 0;
    }

    .phonestore-detail-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
        margin-bottom: 4rem;
    }

    /* Product Gallery */
    .phonestore-gallery {
        position: sticky;
        top: 2rem;
        height: fit-content;
    }

    .phonestore-main-image {
        width: 100%;
        height: 500px;
        background: white;
        border-radius: 24px;
        box-shadow: var(--shadow);
        overflow: hidden;
        margin-bottom: 1rem;
        position: relative;
        border: 1px solid rgba(79, 70, 229, 0.1);
    }

    .phonestore-main-image img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        object-position: center;
        transition: transform 0.3s ease;
    }

    .phonestore-main-image:hover img {
        transform: scale(1.05);
    }

    .phonestore-zoom-btn {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: rgba(255, 255, 255, 0.9);
        border: none;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .phonestore-zoom-btn:hover {
        background: white;
        transform: scale(1.1);
    }

    .phonestore-thumbnail-container {
        position: relative;
    }

    .phonestore-thumbnails {
        display: flex;
        gap: 1rem;
        overflow-x: auto;
        padding: 0.5rem 0;
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    .phonestore-thumbnails::-webkit-scrollbar {
        display: none;
    }

    .phonestore-thumbnail {
        flex-shrink: 0;
        width: 80px;
        height: 80px;
        border-radius: 12px;
        overflow: hidden;
        cursor: pointer;
        border: 3px solid transparent;
        transition: all 0.3s ease;
        background: white;
    }

    .phonestore-thumbnail.active {
        border-color: var(--primary);
        box-shadow: 0 0 0 1px var(--primary);
    }

    .phonestore-thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    /* Product Info */
    .phonestore-product-info {
        padding: 1rem 0;
    }

    .phonestore-product-badge {
        display: inline-block;
        background: var(--success);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .phonestore-product-badge.sale {
        background: var(--danger);
    }

    .phonestore-product-brand {
        color: var(--primary);
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .phonestore-product-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--dark);
        margin-bottom: 1rem;
        line-height: 1.2;
    }

    .phonestore-rating-section {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 2rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .phonestore-rating {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .phonestore-stars {
        display: flex;
        gap: 0.25rem;
    }

    .phonestore-star {
        color: #fbbf24;
        font-size: 1.2rem;
    }

    .phonestore-rating-text {
        font-weight: 600;
        color: var(--dark);
    }

    .phonestore-review-count {
        color: var(--gray);
        font-size: 0.9rem;
    }

    .phonestore-price-section {
        margin-bottom: 2rem;
    }

    .phonestore-current-price {
        font-size: 3rem;
        font-weight: 900;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
        display: block;
    }

    .phonestore-price-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .phonestore-original-price {
        color: var(--gray);
        text-decoration: line-through;
        font-size: 1.25rem;
    }

    .phonestore-discount {
        background: var(--danger);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 12px;
        font-size: 0.9rem;
        font-weight: 600;
    }

    /* Specifications */
    .phonestore-specs-section {
        margin-bottom: 2rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .phonestore-specs-title {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: var(--dark);
    }

    .phonestore-specs-grid {
        display: grid;
        gap: 1rem;
    }

    .phonestore-spec-item {
        display: flex;
        justify-content: space-between;
        padding: 1rem;
        background: white;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .phonestore-spec-item:hover {
        border-color: var(--primary);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.1);
    }

    .phonestore-spec-label {
        font-weight: 600;
        color: var(--gray);
    }

    .phonestore-spec-value {
        font-weight: 600;
        color: var(--dark);
    }

    /* Color Options */
    .phonestore-color-section {
        margin-bottom: 2rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .phonestore-color-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: var(--dark);
    }

    .phonestore-color-options {
        display: flex;
        gap: 1rem;
    }

    .phonestore-color-option {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        border: 3px solid transparent;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
    }

    .phonestore-color-option.active {
        border-color: var(--primary);
        box-shadow: 0 0 0 2px white, 0 0 0 4px var(--primary);
    }

    .phonestore-color-option::after {
        content: '';
        position: absolute;
        inset: 5px;
        border-radius: 50%;
        background: var(--color);
    }

    /* Action Buttons */
    .phonestore-actions {
        display: grid;
        grid-template-columns: 1fr auto auto;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .phonestore-quantity-selector {
        display: flex;
        align-items: center;
        background: white;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
    }

    .phonestore-qty-btn {
        background: none;
        border: none;
        padding: 1rem;
        cursor: pointer;
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--gray);
        transition: all 0.3s ease;
        min-width: 50px;
    }

    .phonestore-qty-btn:hover {
        background: var(--light);
        color: var(--primary);
    }

    .phonestore-qty-input {
        border: none;
        text-align: center;
        font-size: 1.1rem;
        font-weight: 600;
        width: 60px;
        padding: 1rem 0.5rem;
        background: transparent;
    }

    .phonestore-action-btn {
        padding: 1rem 2rem;
        border-radius: 12px;
        border: none;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        font-size: 1rem;
        text-decoration: none;
        min-width: 180px;
    }

    .phonestore-btn-cart {
        background: linear-gradient(135deg, var(--success), #059669);
        color: white;
        box-shadow: var(--shadow);
    }

    .phonestore-btn-cart:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    .phonestore-btn-wishlist {
        background: white;
        color: var(--danger);
        border: 2px solid var(--danger);
        aspect-ratio: 1;
        min-width: auto;
        width: 60px;
    }

    .phonestore-btn-wishlist:hover {
        background: var(--danger);
        color: white;
    }

    .phonestore-btn-buy {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        box-shadow: var(--shadow);
    }

    .phonestore-btn-buy:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    /* Product Features */
    .phonestore-features {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: var(--shadow);
        margin-bottom: 3rem;
    }

    .phonestore-features-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: var(--dark);
    }

    .phonestore-features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .phonestore-feature-item {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        padding: 1rem;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .phonestore-feature-item:hover {
        background: var(--light);
    }

    .phonestore-feature-icon {
        flex-shrink: 0;
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.25rem;
    }

    .phonestore-feature-content h4 {
        font-weight: 600;
        margin-bottom: 0.25rem;
        color: var(--dark);
    }

    .phonestore-feature-content p {
        color: var(--gray);
        font-size: 0.9rem;
    }

    /* Tabs Section */
    .phonestore-tabs-section {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--shadow);
        margin-bottom: 3rem;
    }

    .phonestore-tabs-nav {
        display: flex;
        background: var(--light);
        border-bottom: 1px solid #e2e8f0;
    }

    .phonestore-tab-btn {
        flex: 1;
        padding: 1.5rem 2rem;
        border: none;
        background: transparent;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        color: var(--gray);
        border-bottom: 3px solid transparent;
    }

    .phonestore-tab-btn.active {
        color: var(--primary);
        border-bottom-color: var(--primary);
        background: white;
    }

    .phonestore-tab-content {
        padding: 2rem;
        display: none;
    }

    .phonestore-tab-content.active {
        display: block;
    }

    .phonestore-description {
        font-size: 1.1rem;
        line-height: 1.8;
        color: var(--dark);
    }

    .phonestore-description h3 {
        font-size: 1.3rem;
        font-weight: 700;
        margin: 2rem 0 1rem;
        color: var(--dark);
    }

    .phonestore-description ul {
        margin: 1rem 0;
        padding-left: 1.5rem;
    }

    .phonestore-description li {
        margin-bottom: 0.5rem;
        color: var(--gray);
    }

    /* Reviews Section */
    .phonestore-reviews {
        display: grid;
        gap: 1.5rem;
    }

    .phonestore-review-item {
        padding: 1.5rem;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .phonestore-review-item:hover {
        border-color: var(--primary);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.1);
    }

    .phonestore-review-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .phonestore-reviewer {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .phonestore-reviewer-avatar {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
    }

    .phonestore-reviewer-name {
        font-weight: 600;
        color: var(--dark);
    }

    .phonestore-review-date {
        color: var(--gray);
        font-size: 0.9rem;
    }

    .phonestore-review-rating {
        display: flex;
        gap: 0.25rem;
        margin-bottom: 0.75rem;
    }

    .phonestore-review-text {
        color: var(--gray);
        line-height: 1.6;
    }

    /* Related Products */
    .phonestore-related {
        padding: 3rem 0;
    }

    .phonestore-section-title {
        font-size: 2rem;
        font-weight: 800;
        text-align: center;
        margin-bottom: 3rem;
        color: var(--dark);
    }

    .phonestore-related-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
    }

    .phonestore-related-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: all 0.3s ease;
        border: 1px solid rgba(79, 70, 229, 0.1);
    }

    .phonestore-related-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-lg);
    }

    .phonestore-related-image {
        height: 200px;
        overflow: hidden;
        background: var(--light);
    }

    .phonestore-related-image img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        transition: transform 0.3s ease;
    }

    .phonestore-related-card:hover .phonestore-related-image img {
        transform: scale(1.05);
    }

    .phonestore-related-info {
        padding: 1.5rem;
    }

    .phonestore-related-brand {
        color: var(--gray);
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    .phonestore-related-name {
        font-weight: 700;
        margin-bottom: 1rem;
        color: var(--dark);
    }

    .phonestore-related-price {
        font-size: 1.25rem;
        font-weight: 800;
        color: var(--primary);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .phonestore-container {
            padding: 0 1rem;
        }

        .phonestore-detail-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .phonestore-gallery {
            position: static;
        }

        .phonestore-main-image {
            height: 400px;
        }

        .phonestore-product-title {
            font-size: 2rem;
        }

        .phonestore-current-price {
            font-size: 2.5rem;
        }

        .phonestore-actions {
            grid-template-columns: 1fr;
        }

        .phonestore-tabs-nav {
            flex-direction: column;
        }

        .phonestore-features-grid {
            grid-template-columns: 1fr;
        }

        .phonestore-related-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Loading and Animation */
    .phonestore-loading {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 3rem;
        color: var(--gray);
    }

    .phonestore-spinner {
        display: inline-block;
        width: 40px;
        height: 40px;
        border: 3px solid #e2e8f0;
        border-radius: 50%;
        border-top-color: var(--primary);
        animation: spin 1s ease-in-out infinite;
        margin-right: 1rem;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .phonestore-fade-in {
        animation: fadeInUp 0.6s ease-out;
    }
</style>
@endpush

@section('content')
<div class="phonestore-detail">
    <!-- Breadcrumb -->
    <section class="phonestore-breadcrumb">
        <div class="phonestore-container">
            <ol class="phonestore-breadcrumb-list">
                <li class="phonestore-breadcrumb-item">
                    <a href="{{ route('beranda') }}">Beranda</a>
                </li>
                <li class="phonestore-breadcrumb-separator">
                    <i class="fas fa-chevron-right"></i>
                </li>
                <li class="phonestore-breadcrumb-item">
                    <a href="{{ route('produk.index') }}">Produk</a>
                </li>
                <li class="phonestore-breadcrumb-separator">
                    <i class="fas fa-chevron-right"></i>
                </li>
                <li class="phonestore-breadcrumb-item">{{ $product->nama }}</li>
            </ol>
        </div>
    </section>

    <!-- Product Detail -->
    <section class="phonestore-product-detail">
        <div class="phonestore-container">
            <div class="phonestore-detail-grid phonestore-fade-in">
                <!-- Product Gallery -->
                <div class="phonestore-gallery">
                    <div class="phonestore-main-image">
                        <img id="mainImage" src="{{ asset('storage/' . ($product->images->first()->image_path ?? 'placeholder.jpg')) }}" alt="{{ $product->nama }}">
                        <button class="phonestore-zoom-btn">
                            <i class="fas fa-search-plus"></i>
                        </button>
                    </div>
                    
                    <div class="phonestore-thumbnail-container">
                        <div class="phonestore-thumbnails">
                            @foreach($product->images as $index => $image)
                            <div class="phonestore-thumbnail {{ $index === 0 ? 'active' : '' }}" 
                                 onclick="changeMainImage('{{ asset('storage/' . $image->image_path) }}', this)">
                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $product->nama }}">
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="phonestore-product-info">
                    @if ($product->harga_semula > $product->harga_sekarang)
                        <span class="phonestore-product-badge sale">
                            Diskon {{ round((($product->harga_semula - $product->harga_sekarang) / $product->harga_semula) * 100) }}%
                        </span>
                    @else
                        <span class="phonestore-product-badge">Tersedia</span>
                    @endif

                    <div class="phonestore-product-brand">{{ $product->brand->nama }}</div>
                    <h1 class="phonestore-product-title">{{ $product->nama }}</h1>

                    <!-- Rating -->
                    <div class="phonestore-rating-section">
                        <div class="phonestore-rating">
                            <div class="phonestore-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star phonestore-star"></i>
                                @endfor
                            </div>
                            <span class="phonestore-rating-text">4.8</span>
                        </div>
                        <span class="phonestore-review-count">(124 reviews)</span>
                    </div>

                    <!-- Price -->
                    <div class="phonestore-price-section">
                        <span class="phonestore-current-price">Rp {{ number_format($product->harga_sekarang, 0, ',', '.') }}</span>
                        @if ($product->harga_semula > $product->harga_sekarang)
                        <div class="phonestore-price-info">
                            <span class="phonestore-original-price">Rp {{ number_format($product->harga_semula, 0, ',', '.') }}</span>
                            <span class="phonestore-discount">Hemat {{ number_format($product->harga_semula - $product->harga_sekarang, 0, ',', '.') }}</span>
                        </div>
                        @endif
                    </div>

                    <!-- Specifications Preview -->
                   <div class="phonestore-specs-grid">
                    <div class="phonestore-spec-item">
                        <span class="phonestore-spec-label">Layar</span>
                        <span class="phonestore-spec-value">{{ $product->ukuran_layar }} - {{ $product->tipe_layar }}</span>
                    </div>
                    <div class="phonestore-spec-item">
                        <span class="phonestore-spec-label">RAM</span>
                        <span class="phonestore-spec-value">{{ $product->ram }}</span>
                    </div>
                    <div class="phonestore-spec-item">
                        <span class="phonestore-spec-label">Storage</span>
                        <span class="phonestore-spec-value">{{ $product->rom }}</span>
                    </div>
                    <div class="phonestore-spec-item">
                        <span class="phonestore-spec-label">Kamera Belakang</span>
                        <span class="phonestore-spec-value">{{ $product->kamera_belakang }}</span>
                    </div>
                    <div class="phonestore-spec-item">
                        <span class="phonestore-spec-label">Kamera Depan</span>
                        <span class="phonestore-spec-value">{{ $product->kamera_depan }}</span>
                    </div>
                </div>

                    <!-- Color Options -->
                    {{-- <div class="phonestore-color-section">
                        <h3 class="phonestore-color-title">Pilih Warna</h3>
                        <div class="phonestore-color-options">
                            <div class="phonestore-color-option active" style="--color: #1f2937" data-color="Hitam"></div>
                            <div class="phonestore-color-option" style="--color: #ffffff; border: 1px solid #e5e7eb" data-color="Putih"></div>
                            <div class="phonestore-color-option" style="--color: #3b82f6" data-color="Biru"></div>
                            <div class="phonestore-color-option" style="--color: #ef4444" data-color="Merah"></div>
                        </div>
                    </div> --}}
                    <!-- Action Buttons -->
                    <div class="phonestore-actions">
                        <div class="phonestore-quantity-selector">
                            <button class="phonestore-qty-btn" onclick="changeQuantity(-1)">-</button>
                            <input type="number" class="phonestore-qty-input" value="1" min="1" id="quantity">
                            <button class="phonestore-qty-btn" onclick="changeQuantity(1)">+</button>
                        </div>
                        
                        <button class="phonestore-action-btn phonestore-btn-wishlist">
                            <i class="fas fa-heart"></i>
                        </button>
                        
                        <button class="phonestore-action-btn phonestore-btn-cart" data-product-id="{{ $product->id }}">
                            <i class="fas fa-shopping-cart"></i>
                            Tambah ke Keranjang
                        </button>
                        
                        <a href="#" class="phonestore-action-btn phonestore-btn-buy">
                            <i class="fas fa-bolt"></i>
                            Beli Sekarang
                        </a>
                    </div>

                    <!-- Additional Info -->
                    <div class="phonestore-additional-info">
                        <div class="phonestore-info-item">
                            <i class="fas fa-shipping-fast"></i>
                            <div>
                                <strong>Gratis Ongkir</strong>
                                <p>Untuk pembelian di atas Rp 500.000</p>
                            </div>
                        </div>
                        <div class="phonestore-info-item">
                            <i class="fas fa-shield-alt"></i>
                            <div>
                                <strong>Garansi Resmi</strong>
                                <p>1 tahun garansi distributor</p>
                            </div>
                        </div>
                        <div class="phonestore-info-item">
                            <i class="fas fa-undo"></i>
                            <div>
                                <strong>30 Hari Retur</strong>
                                <p>Bisa ditukar jika tidak sesuai</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabs Section -->
            <div class="phonestore-tabs-section phonestore-fade-in">
                <div class="phonestore-tabs-nav">
                    <button class="phonestore-tab-btn active" onclick="switchTab(event, 'description')">
                        Deskripsi
                    </button>
                    <button class="phonestore-tab-btn" onclick="switchTab(event, 'specifications')">
                        Spesifikasi Lengkap
                    </button>
                    <button class="phonestore-tab-btn" onclick="switchTab(event, 'reviews')">
                        Ulasan (124)
                    </button>
                </div>

                <!-- Description Tab -->
                <div id="description" class="phonestore-tab-content active">
                    <div class="phonestore-description">
                        <p>{{ $product->description }}</p>
                        
                        <h3>Keunggulan Utama</h3>
                        <ul>
                            <li>Desain premium dengan material berkualitas tinggi</li>
                            <li>Performa superior untuk gaming dan multitasking</li>
                            <li>Sistem kamera canggih dengan AI photography</li>
                            <li>Baterai tahan lama dengan fast charging</li>
                            <li>Layar berkualitas tinggi dengan teknologi terdepan</li>
                        </ul>

                        <h3>Dalam Kotak</h3>
                        <ul>
                            <li>1x Smartphone {{ $product->nama }}</li>
                            <li>1x Charger cepat</li>
                            <li>1x Kabel USB-C</li>
                            <li>1x Tool eject SIM</li>
                            <li>1x Panduan pengguna</li>
                            <li>1x Kartu garansi</li>
                        </ul>
                    </div>
                </div>

                <!-- Specifications Tab -->
                <div id="specifications" class="phonestore-tab-content">
                    <div class="phonestore-specs-grid">
                        {{-- @if($product->specifications && $product->specifications->count() > 0)
                            @foreach($product->specifications as $spec)
                            <div class="phonestore-spec-item">
                                <span class="phonestore-spec-label">{{ $spec->name }}</span>
                                <span class="phonestore-spec-value">{{ $spec->value }}</span>
                            </div>
                            @endforeach
                        @else --}}
                            <div class="phonestore-spec-item">
                                <span class="phonestore-spec-label">Layar</span>
                                <span class="phonestore-spec-value">{{ $product->ukuran_layar }} - {{ $product->tipe_layar }}</span>
                            </div>
                            <div class="phonestore-spec-item">
                                <span class="phonestore-spec-label">Processor</span>
                                <span class="phonestore-spec-value">{{ $product->prosesor }}</span>
                            </div>
                            <div class="phonestore-spec-item">
                                <span class="phonestore-spec-label">RAM</span>
                                <span class="phonestore-spec-value">{{ $product->ram }}</span>
                            </div>
                            <div class="phonestore-spec-item">
                                <span class="phonestore-spec-label">Storage</span>
                                <span class="phonestore-spec-value">{{ $product->rom }}</span>
                            </div>
                            <div class="phonestore-spec-item">
                                <span class="phonestore-spec-label">Kamera Belakang</span>
                                <span class="phonestore-spec-value">{{ $product->kamera_belakang }}</span>
                            </div>
                            <div class="phonestore-spec-item">
                                <span class="phonestore-spec-label">Kamera Depan</span>
                                <span class="phonestore-spec-value">{{ $product->kamera_depan }}</span>
                            </div>
                            <div class="phonestore-spec-item">
                                <span class="phonestore-spec-label">Baterai</span>
                                <span class="phonestore-spec-value">{{ $product->baterai }}</span>
                            </div>
                            <div class="phonestore-spec-item">
                                <span class="phonestore-spec-label">OS</span>
                                <span class="phonestore-spec-value">{{ $product->sistem_operasi }}</span>
                            </div>
                            <div class="phonestore-spec-item">
                                <span class="phonestore-spec-label">Konektivitas</span>
                                <span class="phonestore-spec-value">{{ $product->ukuran_layar }}</span>
                            </div>
                            <div class="phonestore-spec-item">
                                <span class="phonestore-spec-label">Dimensi</span>
                                <span class="phonestore-spec-value">{{ $product->dimensi }}</span>
                            </div>
                            <div class="phonestore-spec-item">
                                <span class="phonestore-spec-label">Berat</span>
                                <span class="phonestore-spec-value">{{ $product->berat }}</span>
                            </div>
                            <div class="phonestore-spec-item">
                                <span class="phonestore-spec-label">Pengisi Daya</span>
                                <span class="phonestore-spec-value">{{ $product->pengisi_daya }}</span>
                            </div>
                        {{-- @endif --}}
                    </div>
                </div>

                <!-- Reviews Tab -->
                <div id="reviews" class="phonestore-tab-content">
                    <div class="phonestore-reviews">
                        <div class="phonestore-review-item">
                            <div class="phonestore-review-header">
                                <div class="phonestore-reviewer">
                                    <div class="phonestore-reviewer-avatar">A</div>
                                    <div>
                                        <div class="phonestore-reviewer-name">Ahmad Rizki</div>
                                        <div class="phonestore-review-date">2 hari yang lalu</div>
                                    </div>
                                </div>
                            </div>
                            <div class="phonestore-review-rating">
                                <i class="fas fa-star phonestore-star"></i>
                                <i class="fas fa-star phonestore-star"></i>
                                <i class="fas fa-star phonestore-star"></i>
                                <i class="fas fa-star phonestore-star"></i>
                                <i class="fas fa-star phonestore-star"></i>
                            </div>
                            <p class="phonestore-review-text">
                                Smartphone ini benar-benar luar biasa! Kamera sangat jernih, performa gaming lancar, dan baterai tahan lama. Pengiriman juga cepat dan packaging aman. Sangat recommended!
                            </p>
                        </div>

                        <div class="phonestore-review-item">
                            <div class="phonestore-review-header">
                                <div class="phonestore-reviewer">
                                    <div class="phonestore-reviewer-avatar">S</div>
                                    <div>
                                        <div class="phonestore-reviewer-name">Sari Indah</div>
                                        <div class="phonestore-review-date">5 hari yang lalu</div>
                                    </div>
                                </div>
                            </div>
                            <div class="phonestore-review-rating">
                                <i class="fas fa-star phonestore-star"></i>
                                <i class="fas fa-star phonestore-star"></i>
                                <i class="fas fa-star phonestore-star"></i>
                                <i class="fas fa-star phonestore-star"></i>
                                <i class="far fa-star phonestore-star"></i>
                            </div>
                            <p class="phonestore-review-text">
                                Kualitas build bagus, layar jernih dan responsif. Untuk harga segini sangat worth it. Cuma agak susah dapat case yang pas karena model baru.
                            </p>
                        </div>

                        <div class="phonestore-review-item">
                            <div class="phonestore-review-header">
                                <div class="phonestore-reviewer">
                                    <div class="phonestore-reviewer-avatar">D</div>
                                    <div>
                                        <div class="phonestore-reviewer-name">Dani Pratama</div>
                                        <div class="phonestore-review-date">1 minggu yang lalu</div>
                                    </div>
                                </div>
                            </div>
                            <div class="phonestore-review-rating">
                                <i class="fas fa-star phonestore-star"></i>
                                <i class="fas fa-star phonestore-star"></i>
                                <i class="fas fa-star phonestore-star"></i>
                                <i class="fas fa-star phonestore-star"></i>
                                <i class="fas fa-star phonestore-star"></i>
                            </div>
                            <p class="phonestore-review-text">
                                Gaming experience sangat smooth, tidak ada lag sama sekali. Fast charging juga bekerja dengan baik. Seller responsif dan pelayanan memuaskan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.7/glider.min.js"></script>
<script>
    // Image Gallery Functions
    function changeMainImage(src, thumbnail) {
        document.getElementById('mainImage').src = src;
        
        // Remove active class from all thumbnails
        document.querySelectorAll('.phonestore-thumbnail').forEach(thumb => {
            thumb.classList.remove('active');
        });
        
        // Add active class to clicked thumbnail
        thumbnail.classList.add('active');
    }

    // Quantity Functions
    function changeQuantity(delta) {
        const quantityInput = document.getElementById('quantity');
        let currentValue = parseInt(quantityInput.value) || 1;
        let newValue = currentValue + delta;
        
        if (newValue < 1) newValue = 1;
        if (newValue > 99) newValue = 99;
        
        quantityInput.value = newValue;
    }

    // Color Selection
    document.querySelectorAll('.phonestore-color-option').forEach(option => {
        option.addEventListener('click', function() {
            document.querySelectorAll('.phonestore-color-option').forEach(opt => {
                opt.classList.remove('active');
            });
            this.classList.add('active');
        });
    });

    // Tab Functions
    function switchTab(event, tabName) {
        // Remove active class from all tab buttons and contents
        document.querySelectorAll('.phonestore-tab-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        document.querySelectorAll('.phonestore-tab-content').forEach(content => {
            content.classList.remove('active');
        });

        // Add active class to clicked button and corresponding content
        event.target.classList.add('active');
        document.getElementById(tabName).classList.add('active');
    }

    // Additional Info Styling
    const additionalInfoCSS = `
        .phonestore-additional-info {
            display: grid;
            gap: 1rem;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #e2e8f0;
        }

        .phonestore-info-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: white;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .phonestore-info-item:hover {
            border-color: var(--primary);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.1);
        }

        .phonestore-info-item i {
            font-size: 1.5rem;
            color: var(--primary);
            width: 30px;
            text-align: center;
        }

        .phonestore-info-item strong {
            color: var(--dark);
            font-weight: 600;
            margin-bottom: 0.25rem;
            display: block;
        }

        .phonestore-info-item p {
            color: var(--gray);
            font-size: 0.9rem;
            margin: 0;
        }
    `;

    // Add the CSS to the page
    const style = document.createElement('style');
    style.textContent = additionalInfoCSS;
    document.head.appendChild(style);

    // Smooth scroll animation
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('phonestore-fade-in');
            }
        });
    });

    document.querySelectorAll('.phonestore-features, .phonestore-tabs-section').forEach(el => {
        observer.observe(el);
    });

    // Wishlist functionality
    document.querySelector('.phonestore-btn-wishlist').addEventListener('click', function() {
        this.classList.toggle('active');
        const icon = this.querySelector('i');
        if (this.classList.contains('active')) {
            icon.classList.remove('far');
            icon.classList.add('fas');
        } else {
            icon.classList.remove('fas');
            icon.classList.add('far');
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
    // Add to cart functionality - DIPERBAIKI
    const cartButton = document.querySelector('.phonestore-btn-cart');
    
    if (cartButton) {
        cartButton.addEventListener('click', function() {
            const productId = this.dataset.productId;
            const quantity = document.getElementById('quantity').value || 1;
            
            if (!productId) {
                console.error('Product ID tidak ditemukan');
                showCartNotification('Product ID tidak ditemukan', 'error');
                return;
            }
            
            // Visual feedback
            const originalHTML = this.innerHTML;
            this.style.transform = 'scale(0.9)';
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menambahkan...';
            this.disabled = true;
            
            // Get CSRF token
            let csrfToken = '';
            const csrfMeta = document.querySelector('meta[name="csrf-token"]');
            if (csrfMeta) {
                csrfToken = csrfMeta.getAttribute('content');
            } else {
                // Fallback: cari dari form yang ada di halaman
                const csrfInput = document.querySelector('input[name="_token"]');
                if (csrfInput) {
                    csrfToken = csrfInput.value;
                }
            }
            
            // Send request to add to cart
            fetch(`/keranjang/tambah/${productId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    jumlah: parseInt(quantity)
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                // Reset button
                this.style.transform = 'scale(1)';
                this.innerHTML = originalHTML;
                this.disabled = false;
                
                if (data.success) {
                    // Show success notification
                    showCartNotification(data.message || 'Produk berhasil ditambahkan ke keranjang', 'success');
                    
                    // Update cart count in navbar (if you have one)
                    if (data.totalItems) {
                        updateCartCount(data.totalItems);
                    }
                } else {
                    // Show error notification
                    showCartNotification(data.message || 'Gagal menambahkan produk ke keranjang', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                
                // Reset button
                this.style.transform = 'scale(1)';
                this.innerHTML = originalHTML;
                this.disabled = false;
                
                showCartNotification('Terjadi kesalahan saat menambahkan ke keranjang', 'error');
            });
        });
    }
});

// Show cart notification function - DIPERBAIKI
function showCartNotification(message, type = 'info') {
    // Remove existing notifications
    const existingNotifications = document.querySelectorAll('.cart-notification');
    existingNotifications.forEach(notification => notification.remove());
    
    const notification = document.createElement('div');
    notification.className = `cart-notification cart-notification-${type}`;
    notification.innerHTML = `
        <div class="cart-notification-content">
            <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i>
            <span>${message}</span>
            <button class="cart-notification-close" onclick="this.parentElement.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    
    // Add styles
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: ${type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : '#4f46e5'};
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        z-index: 10000;
        animation: slideInRight 0.3s ease;
        max-width: 300px;
    `;
    
    // Add animation styles if not already added
    if (!document.querySelector('#cart-notification-styles')) {
        const style = document.createElement('style');
        style.id = 'cart-notification-styles';
        style.textContent = `
            @keyframes slideInRight {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            .cart-notification-content {
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }
            .cart-notification-close {
                background: none;
                border: none;
                color: white;
                cursor: pointer;
                padding: 0.25rem;
                border-radius: 4px;
                margin-left: auto;
                opacity: 0.8;
                transition: opacity 0.2s;
            }
            .cart-notification-close:hover {
                opacity: 1;
                background: rgba(255, 255, 255, 0.1);
            }
        `;
        document.head.appendChild(style);
    }
    
    document.body.appendChild(notification);
    
    // Auto remove after 4 seconds
    setTimeout(() => {
        if (notification.parentElement) {
            notification.style.animation = 'slideInRight 0.3s ease reverse';
            setTimeout(() => notification.remove(), 300);
        }
    }, 4000);
}

// Update cart count in navbar - DIPERBAIKI
function updateCartCount(count) {
    const cartCountElements = document.querySelectorAll('.cart-count, .phonestore-cart-count, [class*="cart-count"]');
    
    cartCountElements.forEach(cartCountElement => {
        if (cartCountElement) {
            cartCountElement.textContent = count;
            
            // Add animation to cart count
            cartCountElement.style.transform = 'scale(1.3)';
            cartCountElement.style.background = '#ef4444';
            setTimeout(() => {
                cartCountElement.style.transform = 'scale(1)';
                cartCountElement.style.background = '#4f46e5';
            }, 200);
        }
    });
}

// Debug helper - hapus setelah testing
function debugCartButton() {
    const button = document.querySelector('.phonestore-btn-cart');
    const productId = button?.dataset.productId;
    const quantity = document.getElementById('quantity')?.value;
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    
    console.log('Debug Info:', {
        button: !!button,
        productId: productId,
        quantity: quantity,
        csrfToken: csrfToken ? 'Found' : 'Not found'
    });
}
</script>
@endpush

@endsection