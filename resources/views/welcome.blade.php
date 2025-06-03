@extends('layouts.app')

@section('title', 'PhoneStore - Smartphone Premium Indonesia')

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

    /* Reset untuk menghindari konflik dengan layout */
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

    /* Hero Section */
    .phonestore-hero {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        min-height: 85vh;
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
        margin: 0;
    }

    .phonestore-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
        opacity: 0.3;
    }

    .phonestore-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
        position: relative;
        z-index: 2;
    }

    .phonestore-hero-content {
        color: white;
        max-width: 600px;
    }

    .phonestore-hero h1 {
        font-size: clamp(2.5rem, 5vw, 4rem);
        font-weight: 800;
        margin-bottom: 1.5rem;
        background: linear-gradient(135deg, #fff, rgba(255,255,255,0.8));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .phonestore-hero p {
        font-size: 1.2rem;
        margin-bottom: 2rem;
        opacity: 0.9;
    }

    .phonestore-btn-group {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .phonestore-btn {
        padding: 0.875rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        border: none;
        cursor: pointer;
        font-size: 1rem;
    }

    .phonestore-btn-primary {
        background: white;
        color: var(--primary);
        box-shadow: var(--shadow);
    }

    .phonestore-btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 20px 40px -10px rgba(0,0,0,0.2);
    }

    .phonestore-btn-outline {
        background: rgba(255,255,255,0.1);
        color: white;
        border: 2px solid rgba(255,255,255,0.3);
        backdrop-filter: blur(10px);
    }

    .phonestore-btn-outline:hover {
        background: rgba(255,255,255,0.2);
        border-color: white;
    }

    /* Products Section */
    .phonestore-products {
        padding: 5rem 0;
        background: white;
    }

    .phonestore-section-header {
        text-align: center;
        margin-bottom: 4rem;
    }

    .phonestore-section-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .phonestore-section-subtitle {
        color: var(--gray);
        font-size: 1.1rem;
    }

    .phonestore-products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
        padding: 20px;
    }

    .phonestore-product-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
    }

    .phonestore-product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .phonestore-product-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: #ff6b35;
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        z-index: 2;
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

    /* Features Section */
    .phonestore-features {
        padding: 5rem 0;
        background: var(--light);
    }

    .phonestore-features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
    }

    .phonestore-feature-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: var(--shadow);
        transition: all 0.3s ease;
        text-align: center;
    }

    .phonestore-feature-card:hover {
        transform: translateY(-5px);
    }

    .phonestore-feature-icon {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: white;
        font-size: 2rem;
    }

    .phonestore-feature-title {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: var(--dark);
    }

    .phonestore-feature-desc {
        color: var(--gray);
        line-height: 1.7;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .phonestore-btn-group { 
            justify-content: center; 
        }
        .phonestore-products-grid { 
            grid-template-columns: 1fr; 
        }
        .phonestore-product-actions { 
            grid-template-columns: 1fr auto auto;
            gap: 0.5rem;
        }
        .phonestore-container {
            padding: 0 1rem;
        }
        
        /* Mobile button sizing */
        .phonestore-action-btn {
            padding: 0.625rem 0.875rem;
            font-size: 0.8rem;
        }
        
        .phonestore-btn-detail {
            padding: 0.625rem 1rem;
        }
        
        .phonestore-btn-cart, 
        .phonestore-btn-wishlist {
            padding: 0.625rem;
            width: 44px;
            height: 44px;
            aspect-ratio: 1;
        }
        
        .phonestore-btn-cart i,
        .phonestore-btn-wishlist i {
            font-size: 0.9rem;
        }
        
        /* Smaller product cards on mobile */
        .phonestore-product-info {
            padding: 1.25rem;
        }
        
        .phonestore-product-name {
            font-size: 1.1rem;
        }
        
        .phonestore-current-price {
            font-size: 1.3rem;
        }
    }
</style>
@endpush

@section('content')
<div class="phonestore-content">
    <!-- Hero Section -->
    <section class="phonestore-hero">
        <div class="phonestore-container">
            <div class="phonestore-hero-content">
                <h1>Smartphone Premium dengan Harga Terbaik</h1>
                <p>Temukan koleksi smartphone flagship terbaru dengan teknologi canggih, garansi resmi, dan layanan premium terpercaya.</p>
                <div class="phonestore-btn-group">
                    <a href="#products" class="phonestore-btn phonestore-btn-primary">
                        <i class="fas fa-shopping-bag"></i>
                        Belanja Sekarang
                    </a>
                    <a href="#features" class="phonestore-btn phonestore-btn-outline">
                        <i class="fas fa-info-circle"></i>
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Produk Terbaru -->
    <section id="products" class="phonestore-products">
        <div class="phonestore-container">
            <div class="phonestore-section-header">
                <h2 class="phonestore-section-title">Produk Terbaru</h2>
                <p class="phonestore-section-subtitle">Koleksi smartphone terbaru dengan teknologi terdepan</p>
            </div>
            
            <div class="phonestore-products-grid">
                @foreach ($latestProducts as $product)
                    <div class="phonestore-product-card">
                        @php
                            $firstImage = $product->images->first();
                        @endphp

                        @if ($product->harga_semula && $product->harga_semula > $product->harga_sekarang)
                            <div class="phonestore-product-badge">Diskon</div>
                        @endif

                        <div class="phonestore-product-image">
                            <img src="{{ asset('storage/' . ($firstImage->image_path ?? 'placeholder.jpg')) }}" alt="{{ $product->nama }}">
                        </div>
                        <div class="phonestore-product-info">
                            <div class="phonestore-product-brand">{{ $product->brand->nama ?? '-' }}</div>
                            <h3 class="phonestore-product-name">{{ $product->nama }}</h3>
                            <div class="phonestore-product-price">
                                <span class="phonestore-current-price">Rp {{ number_format($product->harga_sekarang, 0, ',', '.') }}</span>
                                @if ($product->harga_semula && $product->harga_semula > $product->harga_sekarang)
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

        </div>
    </section>

    <!-- Keunggulan -->
    <section id="features" class="phonestore-features">
        <div class="phonestore-container">
            <div class="phonestore-section-header">
                <h2 class="phonestore-section-title">Mengapa Memilih PhoneStore?</h2>
                <p class="phonestore-section-subtitle">Layanan terbaik untuk pengalaman berbelanja yang memuaskan</p>
            </div>
            
            <div class="phonestore-features-grid">
                <div class="phonestore-feature-card">
                    <div class="phonestore-feature-icon">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <h3 class="phonestore-feature-title">Pengiriman Cepat</h3>
                    <p class="phonestore-feature-desc">Gratis ongkir untuk pembelian di atas Rp 1 juta dengan pengiriman express 24 jam di kota besar.</p>
                </div>
                
                <div class="phonestore-feature-card">
                    <div class="phonestore-feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="phonestore-feature-title">Garansi Resmi</h3>
                    <p class="phonestore-feature-desc">Semua produk bergaransi resmi dengan layanan purna jual terpercaya di seluruh Indonesia.</p>
                </div>
                
                <div class="phonestore-feature-card">
                    <div class="phonestore-feature-icon">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <h3 class="phonestore-feature-title">Cicilan 0%</h3>
                    <p class="phonestore-feature-desc">Nikmati kemudahan cicilan 0% hingga 24 bulan dengan berbagai pilihan bank dan e-wallet.</p>
                </div>
                
                <div class="phonestore-feature-card">
                    <div class="phonestore-feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3 class="phonestore-feature-title">Support 24/7</h3>
                    <p class="phonestore-feature-desc">Tim customer service siap membantu Anda kapan saja melalui chat, telepon, atau email.</p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Smooth scrolling untuk anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ 
                        behavior: 'smooth', 
                        block: 'start',
                        inline: 'nearest' 
                    });
                }
            });
        });
        
        // Toggle wishlist icon
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
        document.querySelectorAll('.phonestore-btn-cart').forEach(btn => {
            btn.addEventListener('click', function() {
                // Simple feedback animation
                this.style.transform = 'scale(0.9)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 150);
                
                // You can add actual cart functionality here
                console.log('Added to cart');
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
                
        //         // Simple alert - replace with modal or navigation
        //         alert(`Viewing details for: ${productName}`);
                
        //         // You can add actual navigation here
        //         // window.location.href = `/product/${productSlug}`;
        //     });
        // });
    });
</script>
@endpush