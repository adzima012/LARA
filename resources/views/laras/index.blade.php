@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 py-12 px-6">
    <div class="max-w-6xl mx-auto">
        <!-- Paper-like container -->
        <div class="bg-gray-800/95 backdrop-blur-sm border border-gray-700 rounded-lg shadow-2xl overflow-hidden">
            <!-- Paper header -->
            <div class="relative bg-gray-800 border-b border-gray-700 px-8 py-6">
                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-pink-500/30 to-transparent"></div>
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-serif font-bold text-white mb-2">Surat Digital Saya</h1>
                        <p class="text-gray-300 font-medium">Kelola dan lihat surat digital Anda</p>
                    </div>
                    <a href="{{ route('laras.create') }}" class="bg-pink-500 hover:bg-pink-600 text-white font-medium px-6 py-3 rounded-lg transition-all duration-300 flex items-center shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <i class="fas fa-feather mr-2"></i>
                        Buat Surat Baru
                    </a>
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

                @if($laras->isEmpty())
                    <div class="text-center py-16">
                        <div class="w-32 h-32 bg-pink-500/10 rounded-full flex items-center justify-center mx-auto mb-8 border-2 border-pink-500/20">
                            <i class="fas fa-scroll text-pink-400 text-4xl"></i>
                        </div>
                        <h3 class="text-2xl font-serif font-semibold text-white mb-3">Belum Ada Surat Digital</h3>
                        <p class="text-gray-300 mb-8 max-w-md mx-auto">Anda belum membuat surat digital apapun. Mulailah dengan membuat surat pertama Anda untuk orang yang Anda kasihi.</p>
                        <a href="{{ route('laras.create') }}" class="bg-pink-500 hover:bg-pink-600 text-white font-medium px-8 py-4 rounded-lg transition-all duration-300 inline-flex items-center shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <i class="fas fa-feather mr-3"></i>
                            Buat Surat Pertama Anda
                        </a>
                    </div>
                @else
                    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                        @foreach($laras as $lara)
                        <div class="bg-gray-700/50 border-2 border-gray-600 rounded-lg p-6 hover:border-pink-500/50 hover:bg-gray-700/70 transition-all duration-300 group relative overflow-hidden">
                            <!-- Paper texture overlay -->
                            <div class="absolute inset-0 bg-gradient-to-br from-transparent via-white/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            
                            <div class="relative z-10">
                                <div class="flex justify-between items-start mb-4">
                                    <a href="{{ route('laras.show', $lara) }}" class="text-lg font-serif font-semibold text-white group-hover:text-pink-100 transition-colors duration-300 hover:text-pink-400">{{ $lara->title }}</a>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $lara->is_released ? 'bg-green-500/20 text-green-300 border border-green-500/30' : 'bg-pink-500/20 text-pink-300 border border-pink-500/30' }}">
                                        <i class="fas {{ $lara->is_released ? 'fa-unlock' : 'fa-lock' }} mr-1"></i>
                                        {{ $lara->is_released ? 'Dibuka' : 'Pribadi' }}
                                    </span>
                                </div>
                                
                                @if($lara->image_path)
                                    <div class="bg-gray-800/50 border border-gray-600 rounded-lg p-4 mb-4">
                                        <div class="flex items-center mb-2">
                                            <i class="fas fa-image text-pink-400 mr-2 text-sm"></i>
                                            <span class="text-xs text-gray-400">Gambar tersedia</span>
                                        </div>
                                        <img src="{{ asset('storage/' . $lara->image_path) }}" 
                                             alt="Will thumbnail" 
                                             class="w-full h-32 object-cover rounded-lg mb-3">
                                        <p class="text-gray-300 text-sm leading-relaxed line-clamp-2 font-serif">
                                            {{ Str::limit($lara->content, 80) }}
                                        </p>
                                    </div>
                                @else
                                    <div class="bg-gray-800/50 border border-gray-600 rounded-lg p-4 mb-4">
                                        <p class="text-gray-300 text-sm leading-relaxed line-clamp-3 font-serif">
                                            {{ Str::limit($lara->content, 120) }}
                                        </p>
                                    </div>
                                @endif
                                
                                <div class="flex items-center text-gray-400 text-sm mb-4 bg-gray-800/30 rounded-lg p-3">
                                    <i class="fas fa-heart text-pink-400 mr-2"></i>
                                    <span>Untuk: {{ $lara->recipient_email }}</span>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-gray-500">
                                        <i class="fas fa-calendar mr-1"></i>
                                        {{ $lara->created_at->format('d M Y') }}
                                    </span>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('laras.edit', $lara) }}" 
                                           class="text-gray-400 hover:text-pink-400 text-sm transition-colors duration-300 p-2 hover:bg-pink-500/10 rounded-lg">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @if(!$lara->is_released)
                                            <form action="{{ route('laras.destroy', $lara) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus surat digital ini?')"
                                                        class="text-gray-400 hover:text-red-400 text-sm transition-colors duration-300 p-2 hover:bg-red-500/10 rounded-lg">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    @if($laras->hasPages())
                        <div class="mt-8 pt-6 border-t border-gray-700">
                            <div class="flex justify-center">
                                {{ $laras->links() }}
                            </div>
                        </div>
                    @endif
                @endif
            </div>

            <!-- Paper footer -->
            <div class="bg-gray-800 border-t border-gray-700 px-8 py-4">
                <div class="flex justify-between items-center text-xs text-gray-400">
                    <div class="flex items-center">
                        <i class="fas fa-shield-alt mr-2"></i>
                        <span>Semua surat dilindungi dan terenkripsi</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-clock mr-2"></i>
                        <span>Total: {{ $laras->count() }} surat</span>
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

/* Card hover effects */
.group:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
}

/* Line clamp for text truncation */
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection