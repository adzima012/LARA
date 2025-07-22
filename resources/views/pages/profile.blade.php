<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 py-12 px-6">
        <div class="max-w-4xl mx-auto">
            <!-- Paper-like container -->
            <div class="bg-gray-800/95 backdrop-blur-sm border border-gray-700 rounded-lg shadow-2xl overflow-hidden">
                <!-- Paper header -->
                <div class="relative bg-gray-800 border-b border-gray-700 px-8 py-6">
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-pink-500/30 to-transparent"></div>
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-3xl font-serif font-bold text-white mb-2">Profil Pengguna</h1>
                            <p class="text-gray-300 font-medium">Kelola informasi akun dan keamanan Anda</p>
                        </div>
                        <div class="text-right">
                            <div class="text-xs text-gray-400 font-medium">{{ auth()->user()->name }}</div>
                            <div class="text-xs text-gray-500">{{ now()->format('d M Y, H:i') }}</div>
                        </div>
                    </div>
                </div>

                <!-- Paper content area -->
                <div class="p-8 bg-gray-800/90 relative space-y-8">
                    <!-- Profile Information Section -->
                    <div class="bg-gray-700/50 border-2 border-gray-600 rounded-lg p-6 hover:border-pink-500/30 transition-all duration-300">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-pink-500/20 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-user text-pink-400 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-serif font-semibold text-white">Informasi Profil</h3>
                                <p class="text-gray-400 text-sm">Perbarui informasi akun Anda</p>
                            </div>
                        </div>
                        <div class="max-w-xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <!-- Password Update Section -->
                    <div class="bg-gray-700/50 border-2 border-gray-600 rounded-lg p-6 hover:border-pink-500/30 transition-all duration-300">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-pink-500/20 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-lock text-pink-400 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-serif font-semibold text-white">Keamanan Akun</h3>
                                <p class="text-gray-400 text-sm">Perbarui kata sandi untuk keamanan</p>
                            </div>
                        </div>
                        <div class="max-w-xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <!-- Account Deletion Section -->
                    <div class="bg-red-500/10 border-2 border-red-500/30 rounded-lg p-6 hover:border-red-500/50 transition-all duration-300">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-red-500/20 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-exclamation-triangle text-red-400 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-serif font-semibold text-white">Hapus Akun</h3>
                                <p class="text-gray-400 text-sm">Tindakan ini tidak dapat dibatalkan</p>
                            </div>
                        </div>
                        <div class="max-w-xl">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>

                    <!-- Security Information -->
                    <div class="bg-pink-500/10 border-l-4 border-pink-500/50 rounded-r-lg p-6">
                        <div class="flex items-start">
                            <i class="fas fa-shield-alt text-pink-400 mt-1 mr-4 text-lg"></i>
                            <div class="text-sm text-gray-300">
                                <p class="font-semibold mb-3 text-white">Informasi Keamanan:</p>
                                <ul class="space-y-2 text-gray-300">
                                    <li class="flex items-start">
                                        <span class="text-pink-400 mr-2">•</span>
                                        Semua data Anda dilindungi dengan enkripsi tingkat tinggi
                                    </li>
                                    <li class="flex items-start">
                                        <span class="text-pink-400 mr-2">•</span>
                                        Surat digital Anda akan tetap aman meskipun akun dihapus
                                    </li>
                                    <li class="flex items-start">
                                        <span class="text-pink-400 mr-2">•</span>
                                        Perubahan kata sandi akan berlaku untuk semua perangkat
                                    </li>
                                    <li class="flex items-start">
                                        <span class="text-pink-400 mr-2">•</span>
                                        Kami tidak pernah menyimpan kata sandi dalam bentuk teks biasa
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Paper footer -->
                <div class="bg-gray-800 border-t border-gray-700 px-8 py-4">
                    <div class="flex justify-between items-center text-xs text-gray-400">
                        <div class="flex items-center">
                            <i class="fas fa-shield-alt mr-2"></i>
                            <span>Profil terlindungi dan aman</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-clock mr-2"></i>
                            <span>Terakhir diperbarui: {{ now()->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
    /* Paper texture effect */
    .bg-gray-800\/95 {
        background-image: 
            radial-gradient(circle at 20% 80%, rgba(255,255,255,0.05) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(255,255,255,0.05) 0%, transparent 50%),
            radial-gradient(circle at 40% 40%, rgba(255,255,255,0.03) 0%, transparent 50%);
    }

    /* Subtle paper grain */
    .bg-gray-800\/90::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100' height='100' filter='url(%23noise)' opacity='0.02'/%3E%3C/svg%3E");
        pointer-events: none;
        z-index: 0;
    }

    /* Section hover effects */
    .bg-gray-700\/50:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }

    /* Custom styling for form components */
    .bg-gray-700\/50 input,
    .bg-gray-700\/50 textarea,
    .bg-gray-700\/50 select {
        background-color: rgba(55, 65, 81, 0.5) !important;
        border-color: rgb(75, 85, 99) !important;
        color: white !important;
    }

    .bg-gray-700\/50 input:focus,
    .bg-gray-700\/50 textarea:focus,
    .bg-gray-700\/50 select:focus {
        border-color: rgb(236, 72, 153) !important;
        background-color: rgba(55, 65, 81, 0.7) !important;
    }

    .bg-gray-700\/50 label {
        color: rgb(209, 213, 219) !important;
    }

    .bg-gray-700\/50 button[type="submit"] {
        background-color: rgb(236, 72, 153) !important;
        color: white !important;
    }

    .bg-gray-700\/50 button[type="submit"]:hover {
        background-color: rgb(219, 39, 119) !important;
    }

    /* Override Breeze component styles */
    .bg-gray-700\/50 .text-gray-900,
    .bg-gray-700\/50 .text-gray-600 {
        color: rgb(209, 213, 219) !important;
    }

    .bg-gray-700\/50 .text-gray-800 {
        color: white !important;
    }

    .bg-gray-700\/50 .text-gray-400 {
        color: rgb(156, 163, 175) !important;
    }

    .bg-gray-700\/50 .text-green-600 {
        color: rgb(34, 197, 94) !important;
    }

    .bg-gray-700\/50 .text-green-400 {
        color: rgb(74, 222, 128) !important;
    }

    .bg-gray-700\/50 .border-gray-300 {
        border-color: rgb(75, 85, 99) !important;
    }

    .bg-gray-700\/50 .focus:ring-indigo-500 {
        --tw-ring-color: rgb(236, 72, 153) !important;
    }

    .bg-gray-700\/50 .focus:ring-offset-gray-800 {
        --tw-ring-offset-color: rgb(31, 41, 55) !important;
    }
    </style>
</x-app-layout> 