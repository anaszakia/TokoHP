<header class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <!-- Top Bar -->
        <div class="hidden md:flex justify-between items-center py-2 text-sm text-gray-600 border-b border-gray-200">
            <div class="flex items-center space-x-4">
                <span class="flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    0812-3456-7890
                </span>
                <span class="flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    info@tokohandphone.com
                </span>
            </div>
            <div class="flex items-center space-x-4">
                <span>Gratis Ongkir untuk pembelian diatas Rp 1,000,000</span>
            </div>
        </div>

        <!-- Main Header -->
        <div class="flex items-center justify-between py-4">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('beranda') }}" class="flex items-center space-x-2">
                    <div class="bg-blue-600 text-white p-2 rounded-lg">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="hidden sm:block">
                        <h1 class="text-xl font-bold text-gray-800">PhoneStore</h1>
                        <p class="text-xs text-gray-600">Toko Handphone Terpercaya</p>
                    </div>
                </a>
            </div>

            <!-- Search Bar -->
            <div class="flex-1 max-w-lg mx-4 hidden md:block">
                <form action="#" method="GET" class="relative">
                    <input type="text" 
                           name="q" 
                           placeholder="Cari handphone, aksesoris..." 
                           class="w-full px-4 py-2 pl-10 pr-4 text-gray-700 bg-gray-100 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <button type="submit" class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <div class="bg-blue-600 hover:bg-blue-700 text-white p-1.5 rounded-full transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </button>
                </form>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center space-x-4">
                <!-- Wishlist -->
                {{-- <a href="#" class="relative p-2 text-gray-600 hover:text-blue-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
                </a> --}}

                <!-- Cart -->
                <a href="{{ route('keranjang.index') }}" class="relative p-2 text-gray-600 hover:text-blue-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m0 0h7.5"/>
                    </svg>
                    {{-- <span class="absolute -top-1 -right-1 bg-blue-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">2</span> --}}
                </a>

                <!-- Riwayat Transaksi -->
                <a href="{{ route('riwayat.index') }}" class="relative p-2 text-gray-600 hover:text-blue-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    {{-- <span class="absolute -top-1 -right-1 bg-green-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span> --}}
                </a>

                <!-- User Profile -->
                <div class="relative">
                    @auth
                        <div class="relative">
                            <!-- Profile Button -->
                            <button id="profile-btn" class="flex items-center space-x-1 text-gray-600 hover:text-blue-600 transition-colors focus:outline-none">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span class="hidden sm:block">{{ Auth::user()->name }}</span>
                                <!-- Dropdown Arrow -->
                                <svg id="dropdown-arrow" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div id="profile-dropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none z-50 hidden opacity-0 scale-95 transition-all duration-100">
                                <div class="py-1">
                                    <!-- User Info -->
                                    <div class="px-4 py-2 text-sm text-gray-700 border-b border-gray-100">
                                        <div class="font-medium">{{ Auth::user()->name }}</div>
                                        <div class="text-gray-500">{{ Auth::user()->email }}</div>
                                    </div>
                                    
                                    <!-- Profile Link (Optional) -->
                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                            Profile
                                        </div>
                                    </a>
                                    
                                    <!-- Settings Link (Optional) -->
                                    {{-- <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            Pengaturan
                                        </div>
                                    </a> --}}
                                    
                                    <!-- Divider -->
                                    <div class="border-t border-gray-100"></div>
                                    
                                    <!-- Logout -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                                </svg>
                                                Keluar
                                            </div>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="flex items-center space-x-1 text-gray-600 hover:text-blue-600 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span class="hidden sm:block">Masuk</span>
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="md:hidden p-2 text-gray-600 hover:text-blue-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="hidden md:block border-t border-gray-200">
            <div class="flex items-center space-x-8 py-3">
                <a href="{{ route('beranda') }}" class="text-gray-700 hover:text-blue-600 font-medium transition-colors {{ Request::routeIs('home') ? 'text-blue-600' : '' }}">
                    Beranda
                </a>
                {{-- <div class="relative group">
                    <button class="flex items-center text-gray-700 hover:text-blue-600 font-medium transition-colors">
                        Kategori
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <!-- Dropdown Menu -->
                    <div class="absolute left-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Smartphone</a>
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Tablet</a>
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Aksesoris</a>
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Charger</a>
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Power Bank</a>
                    </div>
                </div> --}}
                <a href="{{ route('produk.index') }}" class="text-gray-700 hover:text-blue-600 font-medium transition-colors {{ Request::routeIs('products') ? 'text-blue-600' : '' }}">
                    Produk
                </a>
                {{-- <a href="#" class="text-gray-700 hover:text-blue-600 font-medium transition-colors {{ Request::routeIs('brands') ? 'text-blue-600' : '' }}">
                    Brand
                </a> --}}
                {{-- <a href="#" class="text-gray-700 hover:text-blue-600 font-medium transition-colors {{ Request::routeIs('promo') ? 'text-blue-600' : '' }}">
                    Promo
                </a> --}}
                <a href="#" class="text-gray-700 hover:text-blue-600 font-medium transition-colors {{ Request::routeIs('about') ? 'text-blue-600' : '' }}">
                    Tentang Kami
                </a>
                <a href="#" class="text-gray-700 hover:text-blue-600 font-medium transition-colors {{ Request::routeIs('contact') ? 'text-blue-600' : '' }}">
                    Kontak
                </a>
            </div>
        </nav>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden bg-white border-t border-gray-200 hidden">
        <!-- Mobile Search -->
        <div class="p-4 border-b border-gray-200">
            <form action="#" method="GET" class="relative">
                <input type="text" 
                       name="q" 
                       placeholder="Cari handphone..." 
                       class="w-full px-4 py-2 pl-10 pr-4 text-gray-700 bg-gray-100 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </form>
        </div>

        <!-- Mobile Navigation -->
        <div class="py-2">
            <a href="{{ route('beranda') }}" class="block px-4 py-3 text-gray-700 hover:bg-gray-100 {{ Request::routeIs('home') ? 'bg-blue-50 text-blue-600' : '' }}">
                Beranda
            </a>
            <a href="{{ route('produk.index') }}" class="block px-4 py-3 text-gray-700 hover:bg-gray-100">
                Produk
            </a>
            {{-- <a href="#" class="block px-4 py-3 text-gray-700 hover:bg-gray-100 pl-8">
                - Smartphone
            </a>
            <a href="#" class="block px-4 py-3 text-gray-700 hover:bg-gray-100 pl-8">
                - Tablet
            </a>
            <a href="#" class="block px-4 py-3 text-gray-700 hover:bg-gray-100 pl-8">
                - Aksesoris
            </a> --}}
            {{-- <a href="#" class="block px-4 py-3 text-gray-700 hover:bg-gray-100">
                Brand
            </a>
            <a href="#" class="block px-4 py-3 text-gray-700 hover:bg-gray-100">
                Promo
            </a> --}}
            <a href="#" class="block px-4 py-3 text-gray-700 hover:bg-gray-100">
                Tentang Kami
            </a>
            <a href="#" class="block px-4 py-3 text-gray-700 hover:bg-gray-100">
                Kontak
            </a>
        </div>
    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const profileBtn = document.getElementById('profile-btn');
    const profileDropdown = document.getElementById('profile-dropdown');
    const dropdownArrow = document.getElementById('dropdown-arrow');
    let isOpen = false;

    if (profileBtn && profileDropdown) {
        // Toggle dropdown when profile button is clicked
        profileBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            isOpen = !isOpen;
            
            if (isOpen) {
                profileDropdown.classList.remove('hidden');
                setTimeout(() => {
                    profileDropdown.classList.remove('opacity-0', 'scale-95');
                    profileDropdown.classList.add('opacity-100', 'scale-100');
                }, 10);
                dropdownArrow.style.transform = 'rotate(180deg)';
            } else {
                profileDropdown.classList.remove('opacity-100', 'scale-100');
                profileDropdown.classList.add('opacity-0', 'scale-95');
                setTimeout(() => {
                    profileDropdown.classList.add('hidden');
                }, 100);
                dropdownArrow.style.transform = 'rotate(0deg)';
            }
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!profileBtn.contains(e.target) && !profileDropdown.contains(e.target)) {
                if (isOpen) {
                    isOpen = false;
                    profileDropdown.classList.remove('opacity-100', 'scale-100');
                    profileDropdown.classList.add('opacity-0', 'scale-95');
                    setTimeout(() => {
                        profileDropdown.classList.add('hidden');
                    }, 100);
                    dropdownArrow.style.transform = 'rotate(0deg)';
                }
            }
        });

        // Close dropdown when pressing Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && isOpen) {
                isOpen = false;
                profileDropdown.classList.remove('opacity-100', 'scale-100');
                profileDropdown.classList.add('opacity-0', 'scale-95');
                setTimeout(() => {
                    profileDropdown.classList.add('hidden');
                }, 100);
                dropdownArrow.style.transform = 'rotate(0deg)';
            }
        });
    }
});
</script>