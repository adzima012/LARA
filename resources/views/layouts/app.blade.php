<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lara - Digital Will</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#121212',
                        secondary: '#ECE6F6',
                        accent: '#8576A2',
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #121212;
            color: #ECE6F6;
        }

        .title-font { font-family: 'Playfair Display', serif; }
        .sidebar { transition: all 0.3s ease; }
        .sidebar-collapsed { width: 80px; }
        .sidebar-expanded { width: 260px; }
        .main-content { transition: margin-left 0.3s ease; }
        .gradient-border {
            position: relative;
            border-radius: 0.5rem;
        }
        .gradient-border::before {
            content: '';
            position: absolute;
            top: -2px; left: -2px; right: -2px; bottom: -2px;
            background: linear-gradient(45deg, #8576A2, #ECE6F6, #8576A2);
            z-index: -1;
            border-radius: 0.6rem;
            opacity: 0.7;
        }
        .fade-in {
            animation: fadeIn 0.8s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .floating {
            animation: floating 6s ease-in-out infinite;
        }
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
        .nav-item { position: relative; overflow: hidden; }
        .nav-item::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #8576A2, #ECE6F6);
            transition: width 0.3s ease;
        }
        .nav-item:hover::after, .active-nav::after { width: 100%; }

        .sidebar-mobile { transform: translateX(-100%); }
        .sidebar-mobile.open { transform: translateX(0); }
        .sidebar-transition { transition: transform 0.3s ease; }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen bg-primary" x-data="{ sidebarOpen: window.innerWidth > 768, sidebarCollapsed: false }">
    <div class="flex h-screen overflow-hidden">
        @auth
        <!-- Sidebar -->
        <aside 
            class="sidebar bg-primary border-r border-accent/20 flex flex-col z-40 fixed h-full"
            :class="{
                'sidebar-collapsed': sidebarCollapsed,
                'sidebar-expanded': !sidebarCollapsed,
                'sidebar-mobile': !sidebarOpen,
                'sidebar-transition': true
            }"
            x-show="sidebarOpen || window.innerWidth > 768"
            @click.away="if (window.innerWidth <= 768) sidebarOpen = false"
        >
            <div class="p-4 border-b border-accent/20 flex items-center justify-between">
                <div x-show="!sidebarCollapsed" class="flex items-center space-x-2">
                    <i class="fas fa-scroll text-accent text-2xl"></i>
                    <span class="title-font text-xl text-secondary">LARA</span>
                </div>
                <button @click="sidebarCollapsed = !sidebarCollapsed" class="text-secondary/70 hover:text-accent">
                    <i :class="sidebarCollapsed ? 'fas fa-chevron-right' : 'fas fa-chevron-left'"></i>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 overflow-y-auto py-4">
                <ul class="space-y-1 px-2">
                    <li>
                        <a href="{{ route('dashboard') }}" class="nav-item flex items-center p-3 text-secondary hover:text-accent transition"
                           :class="request()->routeIs('dashboard') ? 'active-nav text-accent' : ''">
                            <i class="fas fa-home text-lg w-6 text-center"></i>
                            <span x-show="!sidebarCollapsed" class="ml-3">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('messages') }}" class="nav-item flex items-center p-3 text-secondary hover:text-accent transition"
                           :class="request()->routeIs('messages') ? 'active-nav text-accent' : ''">
                            <i class="fas fa-plus-circle text-lg w-6 text-center"></i>
                            <span x-show="!sidebarCollapsed" class="ml-3">Create Message</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard') }}" class="nav-item flex items-center p-3 text-secondary hover:text-accent transition"
                           :class="request()->routeIs('dashboard') ? 'active-nav text-accent' : ''">
                            <i class="fas fa-envelope text-lg w-6 text-center"></i>
                            <span x-show="!sidebarCollapsed" class="ml-3">My Messages</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profile.edit') }}" class="nav-item flex items-center p-3 text-secondary hover:text-accent transition"
                           :class="request()->routeIs('profile.edit') ? 'active-nav text-accent' : ''">
                            <i class="fas fa-user text-lg w-6 text-center"></i>
                            <span x-show="!sidebarCollapsed" class="ml-3">Profile</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Bottom -->
            <div class="p-4 border-t border-accent/20">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center p-2 text-secondary hover:text-accent transition">
                        <i class="fas fa-sign-out-alt text-lg w-6 text-center"></i>
                        <span x-show="!sidebarCollapsed" class="ml-3">Logout</span>
                    </button>
                </form>
            </div>
        </aside>
        @endauth

        <!-- Main Content -->
        <div class="main-content flex-1 flex flex-col overflow-hidden"
             :class="{
                'md:ml-20': sidebarOpen && sidebarCollapsed,
                'md:ml-64': sidebarOpen && !sidebarCollapsed
             }">
            
            <!-- Mobile Header -->
            <header class="bg-primary border-b border-accent/20 md:hidden">
                <div class="flex items-center justify-between p-4">
                    @auth
                    <button @click="sidebarOpen = !sidebarOpen" class="text-secondary hover:text-accent">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    @endauth
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-scroll text-accent text-xl"></i>
                        <span class="title-font text-lg text-secondary">LARA</span>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-y-auto w-full p-0">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in');
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.fade-in').forEach(el => {
            observer.observe(el);
        });
    </script>

    @stack('scripts')
</body>
</html>
