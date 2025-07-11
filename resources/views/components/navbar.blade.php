<nav class="bg-surface border-b border-accent/20 py-4 px-6">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <!-- Logo -->
        <div class="flex items-center space-x-2">
            <i class="fas fa-feather-alt text-accent text-2xl"></i>
            <span class="title-font text-2xl font-bold text-text">Lara</span>
        </div>

        <!-- Tombol Autentikasi -->
        <div class="flex items-center space-x-4">
            <a href="{{ route('register') }}" class="border border-accent text-accent hover:bg-accent hover:text-black font-medium px-4 py-2 rounded-full transition duration-300">
                Daftar
            </a>
            <a href="{{ route('login') }}" class="bg-primary hover:bg-primaryHover text-black font-medium px-4 py-2 rounded-full transition duration-300">
                Masuk
            </a>
            <button class="md:hidden text-text">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
    </div>
</nav>
