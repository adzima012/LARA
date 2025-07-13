@extends('layouts.app')

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
                        <h1 class="text-3xl font-serif font-bold text-white mb-2">Edit Surat Digital</h1>
                        <p class="text-gray-300 font-medium">Ubah pesan terakhir untuk orang yang Anda kasihi</p>
                    </div>
                    <div class="text-right">
                        <div class="text-xs text-gray-400 font-mono">{{ now()->format('d M Y, H:i') }}</div>
                        <div class="text-xs text-gray-500">Dokumen Pribadi</div>
                    </div>
                </div>
            </div>

            <!-- Paper content area -->
            <div class="p-8 bg-gray-800/90 relative">
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

                <form action="{{ route('laras.update', $lara) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <!-- Title field with paper styling -->
                    <div class="relative">
                        <label for="title" class="block text-sm font-medium text-gray-300 mb-3">Judul Surat</label>
                        <div class="relative">
                            <input type="text" name="title" id="title" value="{{ old('title', $lara->title) }}" required
                                class="w-full px-6 py-4 bg-gray-700/50 border-2 border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-pink-500/50 focus:bg-gray-700/70 transition-all duration-300 font-serif text-lg @error('title') border-red-400/50 @enderror"
                                placeholder="Tulis judul surat Anda...">
                            <div class="absolute inset-0 border border-gray-600 rounded-lg pointer-events-none"></div>
                        </div>
                        @error('title')
                            <p class="text-red-300 text-xs mt-2 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Recipient field -->
                    <div class="relative">
                        <label for="recipient_email" class="block text-sm font-medium text-gray-300 mb-3">Email Penerima Surat</label>
                        <div class="relative">
                            <input type="email" name="recipient_email" id="recipient_email" value="{{ old('recipient_email', $lara->recipient_email) }}" required
                                class="w-full px-6 py-4 bg-gray-700/50 border-2 border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-pink-500/50 focus:bg-gray-700/70 transition-all duration-300 font-serif text-lg @error('recipient_email') border-red-400/50 @enderror"
                                placeholder="Masukkan email penerima surat...">
                            <div class="absolute inset-0 border border-gray-600 rounded-lg pointer-events-none"></div>
                        </div>
                        @error('recipient_email')
                            <p class="text-red-300 text-xs mt-2 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Image upload field -->
                    <div class="relative">
                        <label for="image" class="block text-sm font-medium text-gray-300 mb-3">Gambar Surat (Opsional)</label>
                        
                        @if($lara->image_path)
                            <div class="mb-4">
                                <p class="text-sm text-gray-400 mb-2">Gambar saat ini:</p>
                                <div class="relative inline-block">
                                    <img src="{{ asset('storage/' . $lara->image_path) }}" alt="Current image" class="w-32 h-32 object-cover rounded-lg border-2 border-gray-600">
                                    <div class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs cursor-pointer" onclick="removeCurrentImage()">
                                        <i class="fas fa-times"></i>
                                    </div>
                                </div>
                                <input type="hidden" name="remove_image" id="remove_image" value="0">
                            </div>
                        @endif
                        
                        <div class="relative">
                            <div class="flex items-center justify-center w-full">
                                <label for="image" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-600 border-dashed rounded-lg cursor-pointer bg-gray-700/50 hover:bg-gray-700/70 transition-all duration-300 group">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 group-hover:text-pink-400 transition-colors duration-300 mb-2"></i>
                                        <p class="mb-2 text-sm text-gray-400 group-hover:text-gray-300 transition-colors duration-300">
                                            <span class="font-semibold">Klik untuk upload</span> atau drag and drop
                                        </p>
                                        <p class="text-xs text-gray-500">PNG, JPG, JPEG, GIF (Max. 2MB)</p>
                                    </div>
                                    <input id="image" name="image" type="file" class="hidden" accept="image/*" />
                                </label>
                            </div>
                            <div class="absolute inset-0 border border-gray-600 rounded-lg pointer-events-none"></div>
                        </div>
                        @error('image')
                            <p class="text-red-300 text-xs mt-2 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Content field with paper texture -->
                    <div class="relative">
                        <label for="content" class="block text-sm font-medium text-gray-300 mb-3">Isi Surat</label>
                        <div class="relative">
                            <textarea name="content" id="content" rows="15" required
                                class="w-full px-6 py-4 bg-gray-700/50 border-2 border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-pink-500/50 focus:bg-gray-700/70 transition-all duration-300 font-serif text-base leading-relaxed resize-none @error('content') border-red-400/50 @enderror"
                                placeholder="Tulis pesan terakhir Anda di sini...&#10;&#10;Saya harap kata-kata ini dapat memberikan kenyamanan dan kejelasan...&#10;&#10;Dengan penuh cinta dan harapan...">{{ old('content', $lara->content) }}</textarea>
                            <div class="absolute inset-0 border border-gray-600 rounded-lg pointer-events-none"></div>
                        </div>
                        @error('content')
                            <p class="text-red-300 text-xs mt-2 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Status warning box -->
                    <div class="bg-pink-500/10 border-l-4 border-pink-500/50 rounded-r-lg p-6">
                        <div class="flex items-start">
                            <i class="fas fa-heart text-pink-400 mt-1 mr-4 text-lg"></i>
                            <div class="text-sm text-gray-300">
                                <p class="font-semibold mb-3 text-white">Status Surat:</p>
                                <ul class="space-y-2 text-gray-300">
                                    <li class="flex items-start">
                                        <span class="text-pink-400 mr-2">•</span>
                                        Status: <span class="font-semibold {{ $lara->is_released ? 'text-green-400' : 'text-yellow-400' }}">{{ $lara->is_released ? 'Dibuka' : 'Pribadi' }}</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="text-pink-400 mr-2">•</span>
                                        Dibuat pada: {{ $lara->created_at->format('d M Y, H:i') }}
                                    </li>
                                    <li class="flex items-start">
                                        <span class="text-pink-400 mr-2">•</span>
                                        Terakhir diperbarui: {{ $lara->updated_at->format('d M Y, H:i') }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Action buttons with emotional styling -->
                    <div class="flex items-center gap-4 pt-6 border-t border-gray-700">
                        <button type="submit" class="bg-pink-500 hover:bg-pink-600 text-white font-medium px-8 py-4 rounded-lg transition-all duration-300 flex items-center shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <i class="fas fa-save mr-3"></i>
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('laras.index') }}" class="border-2 border-gray-600 text-gray-300 hover:bg-gray-700/50 hover:border-gray-500 font-medium px-8 py-4 rounded-lg transition-all duration-300">
                            Batal
                        </a>
                    </div>
                </form>
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
                        <span>Diperbarui pada {{ now()->format('d/m/Y H:i') }}</span>
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

/* Typing effect for placeholder */
textarea::placeholder {
    animation: fadeInOut 3s ease-in-out infinite;
}

@keyframes fadeInOut {
    0%, 100% { opacity: 0.4; }
    50% { opacity: 0.7; }
}
</style>

<script>
function removeCurrentImage() {
    if (confirm('Apakah Anda yakin ingin menghapus gambar ini?')) {
        document.getElementById('remove_image').value = '1';
        // Hide the current image preview
        const imageContainer = document.querySelector('.relative.inline-block');
        if (imageContainer) {
            imageContainer.style.display = 'none';
        }
    }
}

// Image preview functionality for new uploads
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.createElement('img');
            preview.src = e.target.result;
            preview.className = 'w-32 h-32 object-cover rounded-lg border-2 border-gray-600 mt-2';
            preview.alt = 'New image preview';
            
            const container = document.querySelector('label[for="image"]');
            const existingPreview = container.querySelector('img');
            if (existingPreview && existingPreview.alt === 'New image preview') {
                existingPreview.remove();
            }
            container.appendChild(preview);
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endsection
