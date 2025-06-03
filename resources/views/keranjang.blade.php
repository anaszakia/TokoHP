@extends('layouts.app')

@section('title', 'Keranjang Belanja - PhoneStore')

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

    .keranjang-content * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .keranjang-content {
        font-family: 'Inter', system-ui, sans-serif;
        color: var(--dark);
        background: var(--light);
        line-height: 1.6;
        min-height: 100vh;
    }

    .keranjang-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
    }

    /* Page Header */
    .keranjang-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .keranjang-title {
        font-size: 2.5rem;
        font-weight: 700;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
    }

    .keranjang-subtitle {
        color: var(--gray);
        font-size: 1.1rem;
    }

    /* Empty Cart */
    .keranjang-empty {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 20px;
        box-shadow: var(--shadow);
    }

    .keranjang-empty-icon {
        font-size: 4rem;
        color: var(--gray);
        margin-bottom: 1.5rem;
    }

    .keranjang-empty-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .keranjang-empty-text {
        color: var(--gray);
        margin-bottom: 2rem;
    }

    .keranjang-btn-shop {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.875rem 2rem;
        background: var(--primary);
        color: white;
        text-decoration: none;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .keranjang-btn-shop:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        text-decoration: none;
        color: white;
    }

    /* Cart Content */
    .keranjang-content-wrapper {
        display: grid;
        grid-template-columns: 1fr 350px;
        gap: 2rem;
    }

    /* Cart Items */
    .keranjang-items {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: var(--shadow);
    }

    .keranjang-items-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #f1f5f9;
    }

    .keranjang-items-title {
        font-size: 1.5rem;
        font-weight: 700;
    }

    .keranjang-btn-clear {
        color: var(--danger);
        background: none;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        padding: 0.5rem 1rem;
        border-radius: 8px;
    }

    .keranjang-btn-clear:hover {
        background: #fee2e2;
    }

    /* Cart Item */
    .keranjang-item {
        display: grid;
        grid-template-columns: 100px 1fr auto auto;
        gap: 1.5rem;
        align-items: center;
        padding: 1.5rem 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .keranjang-item:last-child {
        border-bottom: none;
    }

    .keranjang-item-image {
        width: 100px;
        height: 100px;
        border-radius: 12px;
        overflow: hidden;
        background: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .keranjang-item-image img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .keranjang-item-info {
        min-width: 0;
    }

    .keranjang-item-brand {
        color: var(--gray);
        font-size: 0.9rem;
        margin-bottom: 0.25rem;
    }

    .keranjang-item-name {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        line-height: 1.4;
    }

    .keranjang-item-price {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--primary);
    }

    /* Quantity Controls */
    .keranjang-quantity {
        display: flex;
        align-items: center;
        background: var(--light);
        border-radius: 12px;
        border: 2px solid #e2e8f0;
    }

    .keranjang-qty-btn {
        width: 40px;
        height: 40px;
        border: none;
        background: transparent;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        font-weight: 600;
    }

    .keranjang-qty-btn:hover {
        background: var(--primary);
        color: white;
    }

    .keranjang-qty-btn:first-child {
        border-radius: 10px 0 0 10px;
    }

    .keranjang-qty-btn:last-child {
        border-radius: 0 10px 10px 0;
    }

    .keranjang-qty-input {
        width: 60px;
        height: 40px;
        border: none;
        background: transparent;
        text-align: center;
        font-weight: 600;
        font-size: 1rem;
    }

    .keranjang-qty-input:focus {
        outline: none;
    }

    /* Remove Button */
    .keranjang-btn-remove {
        color: var(--danger);
        background: none;
        border: none;
        font-size: 1.2rem;
        cursor: pointer;
        padding: 0.5rem;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .keranjang-btn-remove:hover {
        background: #fee2e2;
        transform: scale(1.1);
    }

    /* Cart Summary */
    .keranjang-summary {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: var(--shadow);
        height: fit-content;
        position: sticky;
        top: 2rem;
    }

    .keranjang-summary-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 2rem;
        text-align: center;
    }

    .keranjang-summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #f1f5f9;
    }

    .keranjang-summary-row:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }

    .keranjang-summary-label {
        color: var(--gray);
        font-weight: 500;
    }

    .keranjang-summary-value {
        font-weight: 600;
    }

    .keranjang-total-row {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--primary);
        border-top: 2px solid #f1f5f9;
        padding-top: 1rem;
        margin-top: 1rem;
    }

    .keranjang-btn-checkout {
        width: 100%;
        padding: 1rem;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 1.1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .keranjang-btn-checkout:hover {
        transform: translateY(-2px);
        box-shadow: 0 20px 40px -12px rgba(79, 70, 229, 0.4);
    }

    .keranjang-btn-continue {
        width: 100%;
        padding: 0.875rem;
        background: transparent;
        color: var(--primary);
        border: 2px solid var(--primary);
        border-radius: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 1rem;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .keranjang-btn-continue:hover {
        background: var(--primary);
        color: white;
        text-decoration: none;
    }

    /* Loading State */
    .keranjang-loading {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        align-items: center;
        justify-content: center;
    }

    .keranjang-spinner {
        width: 40px;
        height: 40px;
        border: 3px solid rgba(255, 255, 255, 0.3);
        border-top: 3px solid white;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .keranjang-container {
            padding: 1rem;
        }

        .keranjang-content-wrapper {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .keranjang-item {
            grid-template-columns: 80px 1fr;
            gap: 1rem;
        }

        .keranjang-quantity,
        .keranjang-btn-remove {
            grid-column: 1 / -1;
            justify-self: start;
            margin-top: 1rem;
        }

        .keranjang-item-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            margin-top: 1rem;
        }

        .keranjang-title {
            font-size: 2rem;
        }
    }
</style>
@endpush

@section('content')
<div class="keranjang-content">
    <div class="keranjang-container">
        <!-- Page Header -->
        <div class="keranjang-header">
            <h1 class="keranjang-title">Keranjang Belanja</h1>
            <p class="keranjang-subtitle">Kelola produk yang ingin Anda beli</p>
        </div>

        @if($keranjangItems->count() > 0)
        <div class="keranjang-content-wrapper">
            <!-- Cart Items -->
            <div class="keranjang-items">
                <div class="keranjang-items-header">
                    <h2 class="keranjang-items-title">
                        Produk ({{ $keranjangItems->sum('jumlah') }} item)
                    </h2>
                    <button class="keranjang-btn-clear" onclick="kosongkanKeranjang()">
                        <i class="fas fa-trash"></i> Kosongkan
                    </button>
                </div>

                <div id="keranjangItemsContainer">
                    @foreach($keranjangItems as $item)
                    <div class="keranjang-item" data-id="{{ $item->id }}">
                        <div class="keranjang-item-image">
                            <img src="{{ asset('storage/' . ($item->produk->images->first()->image_path ?? 'placeholder.jpg')) }}" alt="{{ $item->produk->nama }}">
                        </div>

                        <div class="keranjang-item-info">
                            <div class="keranjang-item-brand">{{ $item->produk->brand->nama }}</div>
                            <h3 class="keranjang-item-name">{{ $item->produk->nama }}</h3>
                            <div class="keranjang-item-price">Rp {{ number_format($item->harga, 0, ',', '.') }}</div>
                        </div>

                        <div class="keranjang-quantity">
                            <button class="keranjang-qty-btn" onclick="updateQuantity({{ $item->id }}, {{ $item->jumlah - 1 }})">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="number" class="keranjang-qty-input" value="{{ $item->jumlah }}" min="1" 
                                   onchange="updateQuantity({{ $item->id }}, this.value)">
                            <button class="keranjang-qty-btn" onclick="updateQuantity({{ $item->id }}, {{ $item->jumlah + 1 }})">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>

                        <button class="keranjang-btn-remove" onclick="hapusItem({{ $item->id }})">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Cart Summary -->
            <div class="keranjang-summary">
                <h2 class="keranjang-summary-title">Ringkasan Belanja</h2>
                
                <div class="keranjang-summary-row">
                    <span class="keranjang-summary-label">Total Item</span>
                    <span class="keranjang-summary-value" id="totalItems">{{ $keranjangItems->sum('jumlah') }} item</span>
                </div>
                
                <div class="keranjang-summary-row">
                    <span class="keranjang-summary-label">Subtotal</span>
                    <span class="keranjang-summary-value" id="subtotalAmount">
                        Rp {{ number_format($keranjangItems->sum(function($item) {
                            return $item->harga * $item->jumlah;
                        }), 0, ',', '.') }}
                    </span>
                </div>
                
                <div class="keranjang-summary-row">
                    <span class="keranjang-summary-label">Ongkos Kirim</span>
                    <span class="keranjang-summary-value">Rp. 30.000</span>
                </div>
                
               <div class="keranjang-summary-row keranjang-total-row">
                    <span class="keranjang-summary-label">Total</span>
                    <span class="keranjang-summary-value" id="totalAmount">
                        Rp {{ number_format($total + 30000, 0, ',', '.') }}
                    </span>
                </div>

                <button class="keranjang-btn-checkout" onclick="checkout()">Lanjut ke Pembayaran</button>

                
                <a href="{{ route('produk.index') }}" class="keranjang-btn-continue">
                    <i class="fas fa-arrow-left"></i>
                    Lanjut Belanja
                </a>
            </div>
        </div>
        @else
        <!-- Empty Cart -->
        <div class="keranjang-empty">
            <div class="keranjang-empty-icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <h2 class="keranjang-empty-title">Keranjang Belanja Kosong</h2>
            <p class="keranjang-empty-text">
                Anda belum menambahkan produk apapun ke keranjang belanja.
                <br>Mari mulai berbelanja sekarang!
            </p>
            <a href="{{ route('produk.index') }}" class="keranjang-btn-shop">
                <i class="fas fa-shopping-bag"></i>
                Mulai Belanja
            </a>
        </div>
        @endif
    </div>

    <!-- Loading Overlay -->
    <div class="keranjang-loading" id="loadingOverlay">
        <div class="keranjang-spinner"></div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
<script>
// Show loading
function showLoading() {
    document.getElementById('loadingOverlay').style.display = 'flex';
}

// Hide loading
function hideLoading() {
    document.getElementById('loadingOverlay').style.display = 'none';
}

// Update quantity
function updateQuantity(itemId, newQuantity) {
    if (newQuantity < 1) {
        hapusItem(itemId);
        return;
    }

    showLoading();

    fetch(`/keranjang/update/${itemId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            jumlah: newQuantity
        })
    })
    .then(response => response.json())
    .then(data => {
        hideLoading();
        if (data.success) {
            // Update quantity input
            const quantityInput = document.querySelector(`[data-id="${itemId}"] .keranjang-qty-input`);
            quantityInput.value = newQuantity;
            
            // Update summary
            updateSummary(data.total, data.totalItems);
            
            // Show success message
            showNotification(data.message, 'success');
        } else {
            showNotification(data.message, 'error');
        }
    })
    .catch(error => {
        hideLoading();
        console.error('Error:', error);
        showNotification('Terjadi kesalahan', 'error');
    });
}

// Remove item from cart
function hapusItem(itemId) {
    if (!confirm('Apakah Anda yakin ingin menghapus produk ini dari keranjang?')) {
        return;
    }

    showLoading();

    fetch(`/keranjang/hapus/${itemId}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        hideLoading();
        if (data.success) {
            // Remove item from DOM
            const itemElement = document.querySelector(`[data-id="${itemId}"]`);
            itemElement.remove();
            
            // Update summary
            updateSummary(data.total, data.totalItems);
            
            // Check if cart is empty
            const remainingItems = document.querySelectorAll('.keranjang-item').length;
            if (remainingItems === 0) {
                location.reload(); // Reload to show empty cart message
            }
            
            showNotification(data.message, 'success');
        } else {
            showNotification(data.message, 'error');
        }
    })
    .catch(error => {
        hideLoading();
        console.error('Error:', error);
        showNotification('Terjadi kesalahan', 'error');
    });
}

// Clear entire cart
function kosongkanKeranjang() {
    if (!confirm('Apakah Anda yakin ingin mengosongkan seluruh keranjang?')) {
        return;
    }

    showLoading();

    fetch('/keranjang/kosongkan', {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        hideLoading();
        if (data.success) {
            location.reload(); // Reload to show empty cart
        } else {
            showNotification(data.message, 'error');
        }
    })
    .catch(error => {
        hideLoading();
        console.error('Error:', error);
        showNotification('Terjadi kesalahan', 'error');
    });
}

// Update summary display
function updateSummary(total, totalItems) {
    document.getElementById('totalItems').textContent = `${totalItems} item`;
    document.getElementById('subtotalAmount').textContent = `Rp ${total}`;
    document.getElementById('totalAmount').textContent = `Rp ${total}`;
    
    // Update items header
    const itemsTitle = document.querySelector('.keranjang-items-title');
    itemsTitle.textContent = `Produk (${totalItems} item)`;
}

function checkout() {
    fetch('{{ route('checkout.pay') }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
        },
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        console.log('Pay response:', data); // Debug log
        
        // Simpan order_id dari response pay
        const orderId = data.order_id;
        
        if (!data.snap_token) {
            throw new Error('Snap token not received');
        }

        // Panggil Midtrans Snap
        snap.pay(data.snap_token, {
            onSuccess: function(result) {
                console.log('Midtrans success result:', result);

                // Kirim data transaksi ke backend
                fetch('{{ route('checkout.success') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        order_id: orderId,
                        transaction_status: result.transaction_status || 'settlement',
                        payment_type: result.payment_type || '',
                        fraud_status: result.fraud_status || '',
                        transaction_id: result.transaction_id || ''
                    }),
                })
                .then(res => {
                    if (!res.ok) {
                        throw new Error('Failed to save transaction');
                    }
                    return res.json();
                })
                .then(data => {
                    console.log('Success response:', data); // Debug log
                    alert(data.message || 'Transaksi berhasil disimpan');
                    // Optional redirect atau refresh halaman
                    window.location.href = '/';
                })
                .catch(err => {
                    console.error('Error simpan transaksi:', err);
                    alert('Gagal menyimpan transaksi: ' + err.message);
                });
            },
            onPending: function(result) {
                console.log('Midtrans pending result:', result);
                alert('Pembayaran pending. Silakan cek kembali status pembayaran Anda.');
            },
            onError: function(result) {
                console.error('Midtrans error result:', result);
                alert('Pembayaran gagal: ' + (result.status_message || 'Unknown error'));
            },
            onClose: function() {
                alert('Anda menutup popup pembayaran tanpa menyelesaikan pembayaran.');
            }
        });
    })
    .catch(err => {
        console.error('Error fetch snap token:', err);
        alert('Gagal memproses pembayaran. Silakan coba lagi. Error: ' + err.message);
    });
}

// Show notification
function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <div class="notification-content">
            <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i>
            <span>${message}</span>
        </div>
    `;
    
    // Add styles for notification
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
    `;
    
    // Add animation styles
    const style = document.createElement('style');
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
        .notification-content {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
    `;
    document.head.appendChild(style);
    
    // Add to page
    document.body.appendChild(notification);
    
    // Remove after 3 seconds
    setTimeout(() => {
        notification.style.animation = 'slideOutRight 0.3s ease';
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 3000);
}

// Add slideOut animation
const slideOutStyle = document.createElement('style');
slideOutStyle.textContent = `
    @keyframes slideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
`;
document.head.appendChild(slideOutStyle);
</script>
@endpush