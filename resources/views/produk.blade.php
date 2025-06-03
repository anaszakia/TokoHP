@extends('layouts.app')

@section('title', 'Semua Produk - PhoneStore')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
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
    }

    .phonestore-content * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .phonestore-content {
        font-family: 'Inter', system-ui, sans-serif;
        color: var(--dark);
        background: var(--light);
        line-height: 1.6;
        margin: 0;
        padding: 0;
    }

    .phonestore-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    /* Page Header */
    .phonestore-page-header {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        padding: 4rem 0 2rem;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .phonestore-page-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
        opacity: 0.3;
    }

    .phonestore-page-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 2;
    }

    .phonestore-page-subtitle {
        font-size: 1.1rem;
        opacity: 0.9;
        position: relative;
        z-index: 2;
    }

    /* Filter & Search Section */
    .phonestore-filter-section {
        background: white;
        padding: 2rem 0;
        border-bottom: 1px solid #e2e8f0;
        position: sticky;
        top: 0;
        z-index: 10;
        backdrop-filter: blur(10px);
    }

    .phonestore-filter-container {
        display: grid;
        grid-template-columns: 1fr auto auto;
        gap: 1.5rem;
        align-items: center;
    }

    .phonestore-search-box {
        position: relative;
    }

    .phonestore-search-input {
        width: 100%;
        padding: 0.875rem 1rem 0.875rem 3rem;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: var(--light);
    }

    .phonestore-search-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    .phonestore-search-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray);
        font-size: 1.1rem;
    }

    .phonestore-filter-group {
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .phonestore-select {
        padding: 0.875rem 1rem;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        background: white;
        font-size: 0.9rem;
        color: var(--dark);
        cursor: pointer;
        transition: all 0.3s ease;
        min-width: 140px;
    }

    .phonestore-select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    .phonestore-view-toggle {
        display: flex;
        background: var(--light);
        border-radius: 12px;
        padding: 0.25rem;
        border: 2px solid #e2e8f0;
    }

    .phonestore-view-btn {
        padding: 0.5rem 0.75rem;
        border: none;
        background: transparent;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        color: var(--gray);
    }

    .phonestore-view-btn.active {
        background: var(--primary);
        color: white;
        box-shadow: var(--shadow);
    }

    /* Products Section */
    .phonestore-products-section {
        padding: 3rem 0;
    }

    .phonestore-products-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .phonestore-results-count {
        color: var(--gray);
        font-size: 0.95rem;
    }

    .phonestore-products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 2rem;
        transition: all 0.3s ease;
    }

    .phonestore-products-grid.list-view {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    /* Product Card - Grid View */
    .phonestore-product-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: all 0.3s ease;
        position: relative;
        border: 1px solid rgba(79, 70, 229, 0.1);
    }

    .phonestore-product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }

    .phonestore-product-badge {
        position: absolute;
        top: 1rem;
        left: 1rem;
        background: var(--accent);
        color: white;
        padding: 0.375rem 0.875rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        z-index: 3;
    }

    .phonestore-product-badge.new {
        background: var(--success);
    }

    .phonestore-product-badge.sale {
        background: var(--danger);
    }

  .phonestore-product-image {
        width: 100%;
        min-height: 150px; /* Tinggi minimum untuk konsistensi */
        max-height: 300px; /* Tinggi maksimum untuk membatasi ukuran */
        overflow: hidden;
        background: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .phonestore-product-image img {
        width: 100%;
        height: auto; /* Biarkan tinggi menyesuaikan proporsi gambar */
        max-height: 100%;
        object-fit: contain; /* Menampilkan gambar lengkap tanpa cropping */
        object-position: center;
        transition: transform 0.3s ease;
    }

    .phonestore-product-card:hover .phonestore-product-image img {
        transform: scale(1.05);
    }

    /* Alternatif jika ingin gambar mengisi container penuh */
    .phonestore-product-image.fill img {
        height: 100%;
        object-fit: cover; /* Gambar akan di-crop jika perlu untuk mengisi container */
    }

    /* Untuk gambar dengan aspect ratio yang sangat berbeda */
    .phonestore-product-image.adaptive {
        height: auto;
        min-height: 150px;
        max-height: none;
    }

    .phonestore-product-image.adaptive img {
        width: 100%;
        height: auto;
        max-width: 100%;
    }

    .phonestore-product-info {
        padding: 1.5rem;
    }

    .phonestore-product-brand {
        color: var(--gray);
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
        font-weight: 500;
    }

    .phonestore-product-name {
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: var(--dark);
    }

    .phonestore-product-price {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
    }

    .phonestore-current-price {
        font-size: 1.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .phonestore-original-price {
        color: var(--gray);
        text-decoration: line-through;
        font-size: 1rem;
    }

    .phonestore-product-actions {
        display: grid;
        grid-template-columns: 1fr auto auto;
        gap: 0.75rem;
    }

    .phonestore-action-btn {
        padding: 0.75rem 1rem;
        border-radius: 12px;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        font-size: 0.9rem;
    }

    .phonestore-btn-detail {
        background: var(--primary);
        color: white;
    }

    .phonestore-btn-detail:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
    }

    .phonestore-btn-cart, 
    .phonestore-btn-wishlist {
        aspect-ratio: 1;
        padding: 0.75rem;
    }

    .phonestore-btn-cart {
        background: var(--success);
        color: white;
    }

    .phonestore-btn-cart:hover {
        background: #059669;
    }

    .phonestore-btn-wishlist {
        background: var(--light);
        color: var(--gray);
        border: 2px solid #e2e8f0;
    }

    .phonestore-btn-wishlist:hover {
        background: #fee2e2;
        color: var(--danger);
        border-color: var(--danger);
    }

    /* List View Styles */
    .phonestore-products-grid.list-view .phonestore-product-card {
        display: grid;
        grid-template-columns: 200px 1fr auto;
        gap: 1.5rem;
        align-items: center;
    }

    .phonestore-products-grid.list-view .phonestore-product-image {
        height: 150px;
        width: 200px;
        flex-shrink: 0;
    }

    .phonestore-products-grid.list-view .phonestore-product-info {
        padding: 1rem 0;
    }

    .phonestore-products-grid.list-view .phonestore-product-actions {
        flex-direction: column;
        padding: 1rem;
        gap: 0.5rem;
        min-width: 120px;
    }

    .phonestore-products-grid.list-view .phonestore-action-btn {
        width: 100%;
    }

    /* Pagination */
    .phonestore-pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 3rem;
        gap: 0.5rem;
    }

    .phonestore-page-btn {
        padding: 0.75rem 1rem;
        border: 2px solid #e2e8f0;
        background: white;
        color: var(--gray);
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .phonestore-page-btn:hover,
    .phonestore-page-btn.active {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    .phonestore-page-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    /* Loading State */
    .phonestore-loading {
        text-align: center;
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
        margin-bottom: 1rem;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .phonestore-container {
            padding: 0 1rem;
        }

        .phonestore-filter-container {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .phonestore-filter-group {
            justify-content: space-between;
        }

        .phonestore-products-grid {
            grid-template-columns: 1fr;
        }

        .phonestore-products-grid.list-view .phonestore-product-card {
            grid-template-columns: 1fr;
            text-align: center;
        }

        .phonestore-products-grid.list-view .phonestore-product-image {
            width: 100%;
            height: 200px;
        }

        .phonestore-products-grid.list-view .phonestore-product-actions {
            flex-direction: row;
            justify-content: center;
        }

        .phonestore-page-title {
            font-size: 2rem;
        }

        .phonestore-products-header {
            flex-direction: column;
            gap: 1rem;
            align-items: flex-start;
        }
    }
</style>
@endpush

@section('content')
<div class="phonestore-content">
    <!-- Page Header -->
    <section class="phonestore-page-header">
        <div class="phonestore-container">
            <h1 class="phonestore-page-title">Semua Produk</h1>
            <p class="phonestore-page-subtitle">Temukan smartphone impian Anda dari koleksi terlengkap kami</p>
        </div>
    </section>

    <!-- Filter & Search -->
    <section class="phonestore-filter-section">
        <div class="phonestore-container">
            <div class="phonestore-filter-container">
                <div class="phonestore-search-box">
                    <i class="fas fa-search phonestore-search-icon"></i>
                    <input type="text" class="phonestore-search-input" placeholder="Cari produk...">
                </div>
                
                @php
                    use App\Models\Brand;
                    $brands = Brand::all();
                @endphp

                <div class="phonestore-filter-group">
                    <select class="phonestore-select" id="brandFilter">
                        <option value="">Semua Brand</option>
                        @foreach($brands as $brand)
                            <option value="{{ strtolower($brand->nama) }}">{{ $brand->nama }}</option>
                        @endforeach
                    </select>

                    <select class="phonestore-select" id="sortBy">
                        <option value="newest">Terbaru</option>
                        <option value="price-low">Harga Terendah</option>
                        <option value="price-high">Harga Tertinggi</option>
                        <option value="popular">Terpopuler</option>
                        <option value="rating">Rating Tertinggi</option>
                    </select>
                </div>
                
                <div class="phonestore-view-toggle">
                    <button class="phonestore-view-btn active" data-view="grid">
                        <i class="fas fa-th-large"></i>
                    </button>
                    <button class="phonestore-view-btn" data-view="list">
                        <i class="fas fa-list"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="phonestore-products-section">
        <div class="phonestore-container">
            <div class="phonestore-products-header">
                <div class="phonestore-results-count">
                    Menampilkan <span id="currentCount">{{ $products->count() }}</span> dari <span id="totalCount">{{ $products->total() }}</span> produk
                </div>
            </div>

            <div class="phonestore-products-grid" id="productsGrid">
                @foreach ($products as $product)
                <div class="phonestore-product-card"
                    data-brand="{{ strtolower($product->brand->nama) }}"
                    data-price="{{ $product->harga_sekarang }}"
                    data-name="{{ $product->nama }}">
                    
                    @if ($product->harga_semula > $product->harga_sekarang)
                        <div class="phonestore-product-badge sale">
                            Diskon {{ round((($product->harga_semula - $product->harga_sekarang) / $product->harga_semula) * 100) }}%
                        </div>
                    @elseif ($loop->first)
                        <div class="phonestore-product-badge new">Terbaru</div>
                    @endif

                    <div class="phonestore-product-image">
                        <img src="{{ asset('storage/' . ($product->images->first()->image_path ?? 'placeholder.jpg')) }}" alt="{{ $product->nama }}">
                    </div>

                    <div class="phonestore-product-info">
                        <div class="phonestore-product-brand">{{ $product->brand->nama }}</div>
                        <h3 class="phonestore-product-name">{{ $product->nama }}</h3>
                        <div class="phonestore-product-price">
                            <span class="phonestore-current-price">Rp {{ number_format($product->harga_sekarang, 0, ',', '.') }}</span>
                            @if ($product->harga_semula > $product->harga_sekarang)
                            <span class="phonestore-original-price">Rp {{ number_format($product->harga_semula, 0, ',', '.') }}</span>
                            @endif
                        </div>
                        <div class="phonestore-product-actions">
                           <a href="{{ route('produk.detail', $product->id) }}" class="phonestore-action-btn phonestore-btn-detail">
                                <i class="fas fa-eye"></i>
                                Lihat Detail
                            </a>
                            <button class="phonestore-action-btn phonestore-btn-cart" data-product-id="{{ $product->id }}">
                                <i class="fas fa-cart-plus"></i>
                            </button>
                            {{-- <button class="phonestore-action-btn phonestore-btn-wishlist">
                                <i class="far fa-heart"></i>
                            </button> --}}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="phonestore-pagination">
                {{ $products->links() }}
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const productsGrid = document.getElementById('productsGrid');
        const searchInput = document.querySelector('.phonestore-search-input');
        const brandFilter = document.getElementById('brandFilter');
        const sortSelect = document.getElementById('sortBy');
        const viewButtons = document.querySelectorAll('.phonestore-view-btn');
        
        // View toggle functionality
        viewButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                viewButtons.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                
                const viewType = this.dataset.view;
                if (viewType === 'list') {
                    productsGrid.classList.add('list-view');
                } else {
                    productsGrid.classList.remove('list-view');
                }
            });
        });

        // Search functionality
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const productCards = document.querySelectorAll('.phonestore-product-card');
            
            productCards.forEach(card => {
                const productName = card.dataset.name.toLowerCase();
                const brand = card.querySelector('.phonestore-product-brand').textContent.toLowerCase();
                
                if (productName.includes(searchTerm) || brand.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
            
            updateResultsCount();
        });

        // Brand filter functionality
        brandFilter.addEventListener('change', function() {
            const selectedBrand = this.value;
            const productCards = document.querySelectorAll('.phonestore-product-card');
            
            productCards.forEach(card => {
                if (selectedBrand === '' || card.dataset.brand === selectedBrand) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
            
            updateResultsCount();
        });

        // Sort functionality
        sortSelect.addEventListener('change', function() {
            const sortBy = this.value;
            const productCards = Array.from(document.querySelectorAll('.phonestore-product-card'));
            
            productCards.sort((a, b) => {
                switch(sortBy) {
                    case 'price-low':
                        return parseInt(a.dataset.price) - parseInt(b.dataset.price);
                    case 'price-high':
                        return parseInt(b.dataset.price) - parseInt(a.dataset.price);
                    case 'name':
                        return a.dataset.name.localeCompare(b.dataset.name);
                    default:
                        return 0;
                }
            });
            
            productCards.forEach(card => productsGrid.appendChild(card));
        });

        // Update results count
        function updateResultsCount() {
            const visibleCards = document.querySelectorAll('.phonestore-product-card[style*="display: block"], .phonestore-product-card:not([style*="display: none"])');
            const totalCards = document.querySelectorAll('.phonestore-product-card');
            
            document.getElementById('currentCount').textContent = visibleCards.length;
            document.getElementById('totalCount').textContent = totalCards.length;
        }

        // Wishlist toggle functionality
        document.querySelectorAll('.phonestore-btn-wishlist').forEach(btn => {
            btn.addEventListener('click', function() {
                const icon = this.querySelector('i');
                if (icon.classList.contains('far')) {
                    icon.classList.remove('far');
                    icon.classList.add('fas');
                    this.style.background = '#fee2e2';
                    this.style.color = '#ef4444';
                    this.style.borderColor = '#ef4444';
                } else {
                    icon.classList.remove('fas');
                    icon.classList.add('far');
                    this.style.background = '#f8fafc';
                    this.style.color = '#64748b';
                    this.style.borderColor = '#e2e8f0';
                }
            });
        });

        // Add to cart functionality
       // Add to cart functionality (REPLACE the existing cart button functionality)
        document.querySelectorAll('.phonestore-btn-cart').forEach(btn => {
            btn.addEventListener('click', function() {
                const productCard = this.closest('.phonestore-product-card');
                const productName = productCard.querySelector('.phonestore-product-name').textContent;
                const productId = this.dataset.productId; // Anda perlu menambahkan data-product-id ke tombol
                
                // Visual feedback
                this.style.transform = 'scale(0.9)';
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                this.disabled = true;
                
                // Send request to add to cart
                fetch(`/keranjang/tambah/${productId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        jumlah: 1
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Reset button
                        this.style.transform = 'scale(1)';
                        this.innerHTML = '<i class="fas fa-cart-plus"></i>';
                        this.disabled = false;
                        
                        // Show success notification
                        showCartNotification(data.message, 'success');
                        
                        // Update cart count in navbar (if you have one)
                        updateCartCount(data.totalItems);
                    } else {
                        // Reset button
                        this.style.transform = 'scale(1)';
                        this.innerHTML = '<i class="fas fa-cart-plus"></i>';
                        this.disabled = false;
                        
                        // Show error notification
                        showCartNotification(data.message, 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    
                    // Reset button
                    this.style.transform = 'scale(1)';
                    this.innerHTML = '<i class="fas fa-cart-plus"></i>';
                    this.disabled = false;
                    
                    showCartNotification('Terjadi kesalahan', 'error');
                });
            });
        });

        // Show cart notification function
        function showCartNotification(message, type = 'info') {
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
                        margin-left: auto;
                    }
                `;
                document.head.appendChild(style);
            }
            
            document.body.appendChild(notification);
            
            // Auto remove after 4 seconds
            setTimeout(() => {
                if (notification.parentElement) {
                    notification.remove();
                }
            }, 4000);
        }

        // Update cart count in navbar
        function updateCartCount(count) {
            const cartCountElement = document.querySelector('.cart-count');
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
        }

        // Product detail functionality
        // document.querySelectorAll('.phonestore-btn-detail').forEach(btn => {
        //     btn.addEventListener('click', function() {
        //         const productCard = this.closest('.phonestore-product-card');
        //         const productName = productCard.querySelector('.phonestore-product-name').textContent;
                
        //         // Replace with actual navigation
        //         alert(`Viewing details for: ${productName}`);
        //     });
        // });

        // // Pagination functionality
        // document.querySelectorAll('.phonestore-page-btn').forEach(btn => {
        //     btn.addEventListener('click', function() {
        //         if (!this.disabled && !this.classList.contains('active')) {
        //             document.querySelectorAll('.phonestore-page-btn').forEach(b => {
        //                 b.classList.remove('active');
        //             });
                    
        //             if (!this.querySelector('i')) {
        //                 this.classList.add('active');
        //             }
                    
        //             // Add actual pagination logic here
        //             console.log('Navigate to page:', this.textContent);
        //         }
        //     });
        // });
    });
</script>
@endpush