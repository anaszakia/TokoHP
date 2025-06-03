@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.3s ease-out'
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-indigo-50 min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <!-- Header Section -->
        <div class="text-center mb-8 animate-fade-in">
            <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-2">
                Edit Profil
            </h1>
            <p class="text-gray-600">Perbarui informasi profil Anda dengan mudah</p>
        </div>

        <!-- Success Alert -->
        @if(session('success'))
            <div class="mb-6 animate-slide-up">
                <div class="bg-green-50 border-l-4 border-green-400 p-4 rounded-r-lg shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-green-800 font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Main Form Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden animate-fade-in">
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-8 py-6">
                <h2 class="text-2xl font-semibold text-white flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Informasi Profil
                </h2>
            </div>

            <form action="{{ route('profile.update') }}" method="POST" class="p-8 space-y-6">
                @csrf
                
                <!-- Personal Information Section -->
                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Name Field -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-gray-700 mb-2 transition-colors group-focus-within:text-blue-600">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Nama Lengkap
                        </label>
                        <input type="text" 
                               name="name" 
                               value="{{ old('name', $user->name) }}" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 hover:border-gray-400"
                               placeholder="Masukkan nama lengkap Anda">
                    </div>

                    <!-- Email Field -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-gray-700 mb-2 transition-colors group-focus-within:text-blue-600">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                            </svg>
                            Email
                        </label>
                        <input type="email" 
                               name="email" 
                               value="{{ old('email', $user->email) }}" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 hover:border-gray-400"
                               placeholder="contoh@email.com">
                    </div>
                </div>

                <!-- Password Field -->
                <div class="group">
                    <label class="block text-sm font-semibold text-gray-700 mb-2 transition-colors group-focus-within:text-blue-600">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        Password Baru
                    </label>
                    <input type="password" 
                           name="password" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 hover:border-gray-400"
                           placeholder="Biarkan kosong jika tidak ingin mengubah">
                    <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah password</p>
                </div>

                <!-- Address Section Divider -->
                <div class="flex items-center my-8">
                    <div class="flex-grow border-t border-gray-200"></div>
                    <div class="flex-shrink-0 px-4">
                        <span class="text-sm font-medium text-gray-500 bg-gray-50 px-3 py-1 rounded-full">Informasi Alamat</span>
                    </div>
                    <div class="flex-grow border-t border-gray-200"></div>
                </div>

                <!-- Full Address -->
                <div class="group">
                    <label class="block text-sm font-semibold text-gray-700 mb-2 transition-colors group-focus-within:text-blue-600">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Alamat Lengkap
                    </label>
                    <textarea name="alamat_lengkap" 
                              rows="3"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 hover:border-gray-400 resize-none"
                              placeholder="Masukkan alamat lengkap Anda">{{ old('alamat_lengkap', $user->alamat_lengkap) }}</textarea>
                </div>

                <!-- Province and City -->
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="group">
                        <label class="block text-sm font-semibold text-gray-700 mb-2 transition-colors group-focus-within:text-blue-600">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                            </svg>
                            Provinsi
                        </label>
                        <input type="text" 
                               name="province_id" 
                               value="{{ old('province_id', $user->province_id) }}" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 hover:border-gray-400"
                               placeholder="Masukkan provinsi">
                    </div>

                    <div class="group">
                        <label class="block text-sm font-semibold text-gray-700 mb-2 transition-colors group-focus-within:text-blue-600">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            Kota/Kabupaten
                        </label>
                        <input type="text" 
                               name="city_id" 
                               value="{{ old('city_id', $user->city_id) }}" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 hover:border-gray-400"
                               placeholder="Masukkan kota/kabupaten">
                    </div>
                </div>

                <!-- Postal Code -->
                <div class="group">
                    <label class="block text-sm font-semibold text-gray-700 mb-2 transition-colors group-focus-within:text-blue-600">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                        Kode Pos
                    </label>
                    <input type="text" 
                           name="kode_pos" 
                           value="{{ old('kode_pos', $user->kode_pos) }}" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 hover:border-gray-400"
                           placeholder="Contoh: 12345"
                           maxlength="5">
                </div>

                <!-- Submit Button -->
                <div class="pt-6">
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-black font-semibold py-4 px-8 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 flex items-center justify-center group">
                        <svg class="w-5 h-5 mr-2 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8 text-gray-500 text-sm">
            <p>Pastikan semua informasi yang Anda masukkan sudah benar sebelum menyimpan.</p>
        </div>
    </div>
</body>
</html>
@endsection