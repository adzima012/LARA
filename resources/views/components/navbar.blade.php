<nav class="bg-primary border-b border-accent/20 py-4 px-6">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <i class="fas fa-feather-alt text-accent text-2xl"></i>
            <span class="title-font text-2xl font-bold text-secondary">Lara</span>
        </div>
        <div class="hidden md:flex space-x-8">
            <a href="#" class="text-secondary hover:text-accent transition duration-300">Home</a>
            <a href="#" class="text-secondary hover:text-accent transition duration-300">About</a>
            <a href="#" class="text-secondary hover:text-accent transition duration-300">How It Works</a>
            <a href="#" class="text-secondary hover:text-accent transition duration-300">Contact</a>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('login') }}" class="bg-accent hover:bg-accent/80 text-primary font-medium px-4 py-2 rounded-full transition duration-300">
                Sign In
            </a>
            <button class="md:hidden text-secondary">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
    </div>
</nav>
