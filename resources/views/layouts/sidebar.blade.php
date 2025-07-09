<aside class="w-64 bg-primary border-r border-accent/20 fixed h-full z-40">
    <!-- Logo -->
    <div class="p-4 border-b border-accent/20">
        <div class="flex items-center space-x-2">
            <i class="fas fa-scroll text-accent text-2xl"></i>
            <span class="title-font text-xl text-secondary">LARA</span>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto py-4">
        <ul class="space-y-1 px-2">

            {{-- Tampilkan hanya jika user login --}}
            @auth
            <!-- Dashboard -->
            <li>
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center p-3 text-secondary hover:bg-accent/10 rounded-lg transition
                          {{ request()->routeIs('dashboard') ? 'bg-accent/20 text-accent' : '' }}">
                    <i class="fas fa-home text-lg w-6 text-center"></i>
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>

            <!-- Create Digital Will -->
            <li>
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center p-3 text-secondary hover:bg-accent/10 rounded-lg transition
                          {{ request()->routeIs('dashboard') ? 'bg-accent/20 text-accent' : '' }}">
                    <i class="fas fa-plus-circle text-lg w-6 text-center"></i>
                    <span class="ml-3">Create Digital Will</span>
                </a>
            </li>

            <!-- My Digital Wills -->
            <li>
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center p-3 text-secondary hover:bg-accent/10 rounded-lg transition
                          {{ request()->routeIs('dashboard') ? 'bg-accent/20 text-accent' : '' }}">
                    <i class="fas fa-scroll text-lg w-6 text-center"></i>
                    <span class="ml-3">My Digital Wills</span>
                </a>
            </li>

            <!-- Profile -->
            <li>
                <a href="{{ route('profile.edit') }}" 
                   class="flex items-center p-3 text-secondary hover:bg-accent/10 rounded-lg transition
                          {{ request()->routeIs('profile.edit') ? 'bg-accent/20 text-accent' : '' }}">
                    <i class="fas fa-user text-lg w-6 text-center"></i>
                    <span class="ml-3">Profile</span>
                </a>
            </li>
            @endauth

        </ul>
    </nav>

    <!-- Bottom Section -->
    <div class="p-4 border-t border-accent/20">
        @auth
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center p-2 text-secondary hover:text-accent transition">
                <i class="fas fa-sign-out-alt text-lg w-6 text-center"></i>
                <span class="ml-3">Logout</span>
            </button>
        </form>
        @else
        <a href="{{ route('login') }}" class="flex items-center p-2 text-secondary hover:text-accent transition">
            <i class="fas fa-sign-in-alt text-lg w-6 text-center"></i>
            <span class="ml-3">Login</span>
        </a>
        @endauth
    </div>
</aside>
