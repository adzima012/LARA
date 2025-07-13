@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 py-12 px-6">
    <div class="max-w-4xl mx-auto">
        <!-- Paper-like container -->
        <div class="bg-gray-800/95 backdrop-blur-sm border border-gray-700 rounded-lg shadow-2xl overflow-hidden">
            <!-- Paper header -->
            <div class="relative bg-gray-800 border-b border-gray-700 px-8 py-6">
                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-pink-500/30 to-transparent"></div>
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-serif font-bold text-white mb-2">{{ $lara->title }}</h1>
                        <p class="text-gray-300 font-medium flex items-center">
                            @if($lara->pemilik_id === Auth::id())
                                <span class="flex items-center">
                                    <i class="fas fa-paper-plane text-pink-400 mr-2"></i>
                                    Dikirim ke: {{ $lara->recipient_email }}
                                </span>
                            @else
                                <span class="flex items-center">
                                    <i class="fas fa-envelope-open text-pink-400 mr-2"></i>
                                    Dari: {{ $lara->pemilik->name }}
                                </span>
                            @endif
                        </p>
                    </div>
                    <div class="text-right">
                        <div class="text-xs text-gray-400 font-mono">{{ $lara->created_at->format('d M Y') }}</div>
                        <div class="text-xs text-gray-500">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $lara->is_released ? 'bg-green-500/20 text-green-300 border border-green-500/30' : 'bg-pink-500/20 text-pink-300 border border-pink-500/30' }}">
                                <i class="fas {{ $lara->is_released ? 'fa-unlock' : 'fa-lock' }} mr-1"></i>
                                {{ $lara->is_released ? 'Dibuka' : 'Pribadi' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Paper content area -->
            <div class="p-8 bg-gray-800/90 relative">
                <!-- Image if exists -->
                @if($lara->image_path)
                    <div class="mb-8">
                        <div class="relative rounded-lg border-2 border-gray-700 bg-gray-900/50">
                            <img src="{{ asset('storage/' . $lara->image_path) }}" 
                                 alt="Gambar Surat" 
                                 class="mx-auto max-w-full h-auto"
                                 style="max-height: 80vh;">
                        </div>
                    </div>
                @endif

                <!-- Letter content -->
                <div class="bg-gray-700/50 border-2 border-gray-600 rounded-lg p-8">
                    <div class="prose prose-invert max-w-none">
                        <div class="text-gray-300 leading-relaxed whitespace-pre-wrap font-serif">
                            {{ $lara->content }}
                        </div>
                    </div>
                </div>

                <!-- Action buttons -->
                <div class="mt-8 flex justify-between items-center">
                    <a href="{{ url()->previous() }}" 
                       class="border-2 border-gray-600 text-gray-300 hover:bg-gray-700/50 hover:border-gray-500 font-medium px-6 py-3 rounded-lg transition-all duration-300 inline-flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>

                    @if($lara->pemilik_id === Auth::id() && !$lara->is_released)
                        <div class="flex gap-4">
                            <a href="{{ route('laras.edit', $lara) }}" 
                               class="bg-pink-500 hover:bg-pink-600 text-white font-medium px-6 py-3 rounded-lg transition-all duration-300 inline-flex items-center">
                                <i class="fas fa-edit mr-2"></i>
                                Edit Surat
                            </a>
                            <form action="{{ route('laras.destroy', $lara) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus surat digital ini?')"
                                        class="border-2 border-red-500/30 text-red-300 hover:bg-red-500/10 hover:border-red-500/50 font-medium px-6 py-3 rounded-lg transition-all duration-300 inline-flex items-center">
                                    <i class="fas fa-trash mr-2"></i>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Paper footer -->
            <div class="bg-gray-800 border-t border-gray-700 px-8 py-4">
                <div class="flex justify-between items-center text-xs text-gray-400">
                    <div class="flex items-center">
                        <i class="fas fa-shield-alt mr-2"></i>
                        <span>Surat ini dilindungi dan terenkripsi</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-clock mr-2"></i>
                        <span>Terakhir diperbarui: {{ $lara->updated_at->format('d/m/Y H:i') }}</span>
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
</style>
@endsection

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 py-12 px-6">
    <div class="max-w-4xl mx-auto">
        <!-- Paper-like container -->
        <div class="bg-gray-800/95 backdrop-blur-sm border border-gray-700 rounded-lg shadow-2xl overflow-hidden">
            <!-- Paper header with tear effect -->
            <div class="relative bg-gray-800 border-b border-gray-700 px-8 py-6">
                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-pink-500/30 to-transparent"></div>
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-serif font-bold text-white mb-2">{{ $lara->title }}</h1>
                        <p class="text-gray-300 font-medium">Surat Digital</p>
                    </div>
                    <div class="text-right">
                        <div class="text-xs text-gray-400 font-mono">{{ $lara->created_at->format('d M Y, H:i') }}</div>
                        <div class="text-xs text-gray-500">Dokumen Pribadi</div>
                    </div>
                </div>
            </div>

            <!-- Paper content area -->
            <div class="p-8 bg-gray-800/90 relative">
                <!-- Status indicator -->
                <div class="mb-6">
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium {{ $lara->is_released ? 'bg-green-500/20 text-green-300 border border-green-500/30' : 'bg-pink-500/20 text-pink-300 border border-pink-500/30' }}">
                        <i class="fas {{ $lara->is_released ? 'fa-unlock' : 'fa-lock' }} mr-2"></i>
                        {{ $lara->is_released ? 'Surat Telah Dibuka' : 'Surat Masih Pribadi' }}
                    </span>
                </div>

                <!-- Recipient information -->
                <div class="bg-gray-700/50 border border-gray-600 rounded-lg p-6 mb-8">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-heart text-pink-400 mr-3 text-lg"></i>
                        <h3 class="text-lg font-semibold text-white">Penerima Surat</h3>
                    </div>
                    <div class="flex items-center text-gray-300">
                        <i class="fas fa-envelope mr-2"></i>
                        <span>{{ $lara->recipient_email }}</span>
                    </div>
                </div>

                <!-- Image section (if exists) -->
                @if($lara->image_path)
                    <div class="bg-gray-700/50 border border-gray-600 rounded-lg p-6 mb-8">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-image text-pink-400 mr-3 text-lg"></i>
                            <h3 class="text-lg font-semibold text-white">Gambar Surat</h3>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="relative rounded-lg overflow-hidden shadow-lg bg-gray-900/50">
                                <img src="{{ asset('storage/' . $lara->image_path) }}" 
                                     alt="Gambar Surat" 
                                     class="mx-auto max-w-full h-auto"
                                     style="max-height: 80vh;">
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Content section -->
                <div class="bg-gray-700/50 border border-gray-600 rounded-lg p-6 mb-8">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-scroll text-pink-400 mr-3 text-lg"></i>
                        <h3 class="text-lg font-semibold text-white">Isi Surat</h3>
                    </div>
                    <div class="text-gray-300 leading-relaxed font-serif text-base whitespace-pre-wrap">
                        {{ $lara->content }}
                    </div>
                </div>

                <!-- Metadata -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-gray-700/50 border border-gray-600 rounded-lg p-4">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-user text-pink-400 mr-2"></i>
                            <span class="text-sm font-medium text-gray-300">Pemilik</span>
                        </div>
                        <p class="text-white">{{ $lara->pemilik->name }}</p>
                    </div>
                    
                    <div class="bg-gray-700/50 border border-gray-600 rounded-lg p-4">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-calendar text-pink-400 mr-2"></i>
                            <span class="text-sm font-medium text-gray-300">Dibuat</span>
                        </div>
                        <p class="text-white">{{ $lara->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>

                <!-- Action buttons -->
                <div class="flex items-center gap-4 pt-6 border-t border-gray-700">
                    @if(!$lara->is_released)
                        <a href="{{ route('laras.edit', $lara) }}" class="bg-pink-500 hover:bg-pink-600 text-white font-medium px-6 py-3 rounded-lg transition-all duration-300 flex items-center shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <i class="fas fa-edit mr-2"></i>
                            Edit Surat
                        </a>
                    @endif
                    
                    <a href="{{ route('laras.index') }}" class="border-2 border-gray-600 text-gray-300 hover:bg-gray-700/50 hover:border-gray-500 font-medium px-6 py-3 rounded-lg transition-all duration-300">
                        Kembali ke Daftar
                    </a>
                </div>
            </div>

            <!-- Paper footer -->
            <div class="bg-gray-800 border-t border-gray-700 px-8 py-4">
                <div class="flex justify-between items-center text-xs text-gray-400">
                    <div class="flex items-center">
                        <i class="fas fa-lock mr-2"></i>
                        <span>Dokumen Terenkripsi & Terlindungi</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-clock mr-2"></i>
                        <span>Terakhir diperbarui: {{ $lara->updated_at->format('d/m/Y H:i') }}</span>
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
</style>
@endsection
