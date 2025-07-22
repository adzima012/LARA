{{--
    View Dashboard - Halaman utama setelah login
    Menampilkan:
    - Daftar surat digital yang dimiliki user
    - Daftar surat digital yang diterima
    - Statistik dan informasi ringkas
    - Menu untuk membuat surat baru
    
    Menggunakan layout app.blade.php sebagai template utama
--}}
@extends('layouts.app')

@section('content')
{{-- Container utama dengan latar belakang gradient --}}
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 py-12 px-6">
    <div class="max-w-6xl mx-auto">
        {{-- Container utama dengan efek paper-like --}}
        <div class="bg-gray-800/95 backdrop-blur-sm border border-gray-700 rounded-lg shadow-2xl overflow-hidden">
            {{-- Header dashboard dengan garis gradien --}}
            <div class="relative bg-gray-800 border-b border-gray-700 px-8 py-6">
                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-pink-500/30 to-transparent"></div>
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-serif font-bold text-white mb-2">Dashboard Surat Digital</h1>
                        <p class="text-gray-300 font-medium">Kelola dan temukan surat digital Anda</p>
                    </div>                        
                        <div class="text-right">
                            <div class="text-xs text-gray-400 font-medium">{{ auth()->user()->name }}</div>
                            <div class="text-xs text-gray-500">{{ now()->format('d M Y, H:i') }}</div>
                        </div>
                </div>
            </div>

            <!-- Paper content area -->
            <div class="p-8 bg-gray-800/90 relative">
                @if(session('success'))
                    <div class="mb-6 bg-green-500/20 border-l-4 border-green-400 text-green-200 text-sm p-4 rounded-r-lg">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                <!-- Search and Create Button Section -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 mb-8">
                    <div class="order-2 sm:order-1">
                        <a href="{{ route('laras.create') }}" class="bg-pink-500 hover:bg-pink-600 text-white font-medium px-6 py-3 rounded-lg transition-all duration-300 flex items-center shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <i class="fas fa-feather mr-2"></i>
                            Buat Surat Baru
                        </a>
                    </div>
                    
                    <form action="{{ route('dashboard') }}" method="GET" class="order-1 sm:order-2 w-full sm:w-96">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input 
                                type="text" 
                                name="search" 
                                class="block w-full pl-12 pr-12 py-3 border-2 border-gray-600 rounded-lg bg-gray-700/50 text-white placeholder-gray-400 focus:outline-none focus:border-pink-500/50 focus:bg-gray-700/70 transition-all duration-300" 
                                placeholder="Cari berdasarkan judul atau isi..." 
                                value="{{ request('search') }}"
                            >
                            @if(request('search'))
                                <a 
                                    href="{{ route('dashboard') }}"
                                    class="absolute inset-y-0 right-12 flex items-center pr-2 text-gray-400 hover:text-pink-400 transition-colors duration-300"
                                    title="Hapus pencarian"
                                >
                                    <i class="fas fa-times"></i>
                                </a>
                            @endif
                            <button 
                                type="submit" 
                                class="absolute inset-y-0 right-0 flex items-center pr-4 text-pink-400 hover:text-pink-300 transition-colors duration-300"
                                title="Cari"
                            >
                                <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </form>
                </div>

                @if($receivedLetters->isEmpty() && $sentLetters->isEmpty())
                    <!-- Empty State with Emotional Design -->
                    <div class="text-center py-16">
                        <div class="w-40 h-40 bg-pink-500/10 rounded-full flex items-center justify-center mx-auto mb-8 border-2 border-pink-500/20 relative">
                            <i class="fas fa-scroll text-pink-400 text-5xl"></i>
                            <!-- Floating elements for emotional effect -->
                            <div class="absolute -top-2 -right-2 w-8 h-8 bg-pink-500/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-heart text-pink-400 text-xs"></i>
                            </div>
                            <div class="absolute -bottom-2 -left-2 w-6 h-6 bg-pink-500/15 rounded-full flex items-center justify-center">
                                <i class="fas fa-star text-pink-300 text-xs"></i>
                            </div>
                        </div>
                        
                        <div class="max-w-md mx-auto">
                            <h3 class="text-2xl font-serif font-semibold text-white mb-4">Belum Ada Surat Digital</h3>
                            <p class="text-gray-300 mb-6 leading-relaxed">
                                Anda belum membuat atau menerima surat digital apapun. Mulailah dengan menulis pesan untuk orang yang Anda kasihi.
                            </p>
                            <p class="text-gray-400 text-sm mb-8">
                                Setiap kata yang Anda tulis akan menjadi warisan berharga bagi mereka yang Anda tinggalkan.
                            </p>
                            
                            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                                <a href="{{ route('laras.create') }}" class="bg-pink-500 hover:bg-pink-600 text-white font-medium px-8 py-4 rounded-lg transition-all duration-300 inline-flex items-center justify-center shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                    <i class="fas fa-feather mr-3"></i>
                                    Buat Surat Pertama
                                </a>
                                <a href="{{ route('laras.index') }}" class="border-2 border-gray-600 text-gray-300 hover:bg-gray-700/50 hover:border-gray-500 font-medium px-8 py-4 rounded-lg transition-all duration-300 inline-flex items-center justify-center">
                                    <i class="fas fa-list mr-3"></i>
                                    Lihat Semua Surat
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Letters Grid -->
                    @if($receivedLetters->isNotEmpty())
                        <div class="mb-12">
                            <h2 class="text-xl font-serif font-semibold text-white mb-6 flex items-center">
                                <i class="fas fa-envelope-open-text text-pink-400 mr-3"></i>
                                Surat yang Diterima
                            </h2>
                            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                                @foreach($receivedLetters as $letter)
                                    <a href="{{ route('laras.show', $letter) }}" class="block">
                                        <div class="bg-gray-700/50 border-2 border-gray-600 rounded-lg p-6 hover:border-pink-500/50 hover:bg-gray-700/70 transition-all duration-300 group relative overflow-hidden">
                                            <div class="relative z-10">
                                                <div class="flex justify-between items-start mb-4">
                                                    <h3 class="text-lg font-serif font-semibold text-white group-hover:text-pink-100 transition-colors duration-300">{{ $letter->title }}</h3>
                                                </div>
                                            
                                            <div class="bg-gray-800/50 border border-gray-600 rounded-lg p-4 mb-4">
                                                <p class="text-gray-300 text-sm leading-relaxed line-clamp-3 font-serif">
                                                    {{ Str::limit($letter->content, 120) }}
                                                </p>
                                            </div>
                                            
                                            <div class="flex items-center text-gray-400 text-sm mb-4 bg-gray-800/30 rounded-lg p-3">
                                                <i class="fas fa-user text-pink-400 mr-2"></i>
                                                <span>Dari: {{ $letter->pemilik->name }}</span>
                                            </div>
                                            
                                            <div class="flex items-center text-xs text-gray-500">
                                                <i class="fas fa-calendar mr-2"></i>
                                                <span>{{ $letter->created_at->format('d M Y') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @if($receivedLetters->hasPages())
                                <div class="mt-6 flex justify-center">
                                    {{ $receivedLetters->links() }}
                                </div>
                            @endif
                        </div>
                    @endif

                    @if($sentLetters->isNotEmpty())
                        <div class="mb-8">
                            <h2 class="text-xl font-serif font-semibold text-white mb-6 flex items-center">
                                <i class="fas fa-paper-plane text-pink-400 mr-3"></i>
                                Surat yang Dikirim
                            </h2>
                            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                                @foreach($sentLetters as $letter)
                                    <div class="bg-gray-700/50 border-2 border-gray-600 rounded-lg p-6 hover:border-pink-500/50 hover:bg-gray-700/70 transition-all duration-300 group relative overflow-hidden">
                                        <div class="relative z-10">
                                            <div class="flex justify-between items-start mb-4">
                                                <h3 class="text-lg font-serif font-semibold text-white group-hover:text-pink-100 transition-colors duration-300">{{ $letter->title }}</h3>
                                            </div>
                                            
                                            <div class="bg-gray-800/50 border border-gray-600 rounded-lg p-4 mb-4">
                                                <p class="text-gray-300 text-sm leading-relaxed line-clamp-3 font-serif">
                                                    {{ Str::limit($letter->content, 120) }}
                                                </p>
                                            </div>
                                            
                                            <div class="flex items-center text-gray-400 text-sm mb-4 bg-gray-800/30 rounded-lg p-3">
                                                <i class="fas fa-heart text-pink-400 mr-2"></i>
                                                <span>Untuk: {{ $letter->recipient_email }}</span>
                                            </div>
                                            
                                            <div class="flex items-center text-xs text-gray-500">
                                                <i class="fas fa-calendar mr-2"></i>
                                                <span>{{ $letter->created_at->format('d M Y') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @if($sentLetters->hasPages())
                                <div class="mt-6 flex justify-center">
                                    {{ $sentLetters->links() }}
                                </div>
                            @endif
                        </div>
                    @endif
                @endif

                <!-- Emotional quote -->
                <div class="mt-12 p-6 bg-pink-500/10 border-l-4 border-pink-500/50 rounded-r-lg max-w-lg mx-auto">
                    <div class="flex items-start">
                        <i class="fas fa-quote-left text-pink-400 mt-1 mr-3 text-lg"></i>
                        <div class="text-sm text-gray-300 italic">
                            "Kata-kata yang ditulis dengan hati akan selalu hidup dalam ingatan mereka yang membaca."
                        </div>
                    </div>
                </div>
            </div>

            <!-- Paper footer -->
            <div class="bg-gray-800 border-t border-gray-700 px-8 py-4">
                <div class="flex justify-between items-center text-xs text-gray-400">
                    <div class="flex items-center">
                        <i class="fas fa-shield-alt mr-2"></i>
                        <span>Dashboard terlindungi dan aman</span>
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

/* Floating animation for decorative elements */
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

.absolute.-top-2.-right-2 {
    animation: float 3s ease-in-out infinite;
}

.absolute.-bottom-2.-left-2 {
    animation: float 3s ease-in-out infinite 1.5s;
}
</style>
@endsection
