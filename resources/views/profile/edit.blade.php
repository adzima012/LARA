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
                        <h1 class="text-3xl font-serif font-bold text-white mb-2">Pengaturan Profil</h1>
                        <p class="text-gray-300 font-medium">Kelola informasi akun dan preferensi Anda</p>
                    </div>
                    <div class="text-right">
                        <div class="text-xs text-gray-400 font-mono">User ID: {{ auth()->id() }}</div>
                        <div class="text-xs text-gray-500">{{ now()->format('d M Y, H:i') }}</div>
                    </div>
                </div>
            </div>

            <!-- Paper content area -->
            <div class="p-8 bg-gray-800/90 relative space-y-8">
                @if($errors->any())
                    <div class="mb-6 bg-red-500/20 border-l-4 border-red-400 text-red-200 text-sm p-4 rounded-r-lg">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            <span class="font-semibold">Mohon perbaiki kesalahan berikut:</span>
                        </div>
                        <ul class="list-disc list-inside space-y-1 ml-4">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Profile Information -->
                <div class="bg-gray-700/50 border-2 border-gray-600 rounded-lg p-6 hover:border-pink-500/30 transition-all duration-300">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-pink-500/20 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-user text-pink-400 text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-serif font-semibold text-white">Informasi Profil</h2>
                            <p class="text-gray-400 text-sm">Perbarui informasi akun dan alamat email Anda.</p>
                        </div>
                    </div>

                    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                        @csrf
                        @method('patch')

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Nama</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                                class="w-full px-4 py-3 bg-gray-700/50 border-2 border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-pink-500/50 focus:bg-gray-700/70 transition-all duration-300 @error('name') border-red-400/50 @enderror">
                            @error('name')
                                <p class="text-red-300 text-xs mt-1 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                                class="w-full px-4 py-3 bg-gray-700/50 border-2 border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-pink-500/50 focus:bg-gray-700/70 transition-all duration-300 @error('email') border-red-400/50 @enderror">
                            @error('email')
                                <p class="text-red-300 text-xs mt-1 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="bg-pink-500 hover:bg-pink-600 text-white font-medium px-6 py-3 rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                <i class="fas fa-save mr-2"></i>
                                Simpan Perubahan
                            </button>
                            @if (session('status') === 'profile-updated')
                                <p class="text-green-300 text-sm flex items-center">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Profil berhasil diperbarui.
                                </p>
                            @endif
                        </div>
                    </form>
                </div>

                <!-- Update Password -->
                <div class="bg-gray-700/50 border-2 border-gray-600 rounded-lg p-6 hover:border-pink-500/30 transition-all duration-300">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-pink-500/20 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-lock text-pink-400 text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-serif font-semibold text-white">Perbarui Kata Sandi</h2>
                            <p class="text-gray-400 text-sm">Pastikan akun Anda menggunakan kata sandi yang panjang dan acak untuk tetap aman.</p>
                        </div>
                    </div>

                    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                        @csrf
                        @method('put')

                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-300 mb-2">Kata Sandi Saat Ini</label>
                            <input type="password" name="current_password" id="current_password" required
                                class="w-full px-4 py-3 bg-gray-700/50 border-2 border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-pink-500/50 focus:bg-gray-700/70 transition-all duration-300 @error('current_password') border-red-400/50 @enderror"
                                placeholder="Masukkan kata sandi saat ini">
                            @error('current_password')
                                <p class="text-red-300 text-xs mt-1 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="new_password" class="block text-sm font-medium text-gray-300 mb-2">Kata Sandi Baru</label>
                            <input type="password" name="password" id="new_password" required
                                class="w-full px-4 py-3 bg-gray-700/50 border-2 border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-pink-500/50 focus:bg-gray-700/70 transition-all duration-300 @error('password') border-red-400/50 @enderror"
                                placeholder="Masukkan kata sandi baru">
                            @error('password')
                                <p class="text-red-300 text-xs mt-1 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">Konfirmasi Kata Sandi Baru</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" required
                                class="w-full px-4 py-3 bg-gray-700/50 border-2 border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-pink-500/50 focus:bg-gray-700/70 transition-all duration-300 @error('password_confirmation') border-red-400/50 @enderror"
                                placeholder="Konfirmasi kata sandi baru">
                            @error('password_confirmation')
                                <p class="text-red-300 text-xs mt-1 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="bg-pink-500 hover:bg-pink-600 text-white font-medium px-6 py-3 rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                <i class="fas fa-key mr-2"></i>
                                Perbarui Kata Sandi
                            </button>
                            @if (session('status') === 'password-updated')
                                <p class="text-green-300 text-sm flex items-center">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Kata sandi berhasil diperbarui.
                                </p>
                            @endif
                        </div>
                    </form>
                </div>

                <!-- Delete Account -->
                <div class="bg-red-500/10 border-2 border-red-500/30 rounded-lg p-6 hover:border-red-500/50 transition-all duration-300">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-red-500/20 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-exclamation-triangle text-red-400 text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-serif font-semibold text-white">Hapus Akun</h2>
                            <p class="text-gray-400 text-sm">Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen.</p>
                        </div>
                    </div>

                    <form method="post" action="{{ route('profile.destroy') }}" class="space-y-6">
                        @csrf
                        @method('delete')

                        <div>
                            <label for="delete_password" class="block text-sm font-medium text-gray-300 mb-2">Kata Sandi</label>
                            <input type="password" name="password" id="delete_password" required
                                class="w-full px-4 py-3 bg-gray-700/50 border-2 border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-red-500/50 focus:bg-gray-700/70 transition-all duration-300 @error('password') border-red-400/50 @enderror"
                                placeholder="Masukkan kata sandi untuk konfirmasi">
                            @error('password')
                                <p class="text-red-300 text-xs mt-1 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-medium px-6 py-3 rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus akun Anda? Tindakan ini tidak dapat dibatalkan.')">
                                <i class="fas fa-trash mr-2"></i>
                                Hapus Akun
                            </button>
                        </div>
                    </form>
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
                                    Wasiat digital Anda akan tetap aman meskipun akun dihapus
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
</style>
@endsection
