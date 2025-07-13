<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Lara - Digital Will</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        background: '#1A1A1D',
                        surface: '#29292D',
                        text: '#F2F2F2',
                        primary: '#BDA7F3',
                        primaryHover: '#D0BBF9',
                        accent: '#E8C9D1',
                    }
                }
            }
        }
    </script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #1A1A1D;
            color: #F2F2F2;
        }

        .title-font { font-family: 'Playfair Display', serif; }
        .sidebar { transition: all 0.3s ease; }
        .sidebar-collapsed { width: 80px; }
        .sidebar-expanded { width: 260px; }
        .main-content { transition: margin-left 0.3s ease; }
        .nav-item::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #BDA7F3, #E8C9D1);
            transition: width 0.3s ease;
        }
        .nav-item:hover::after, .active-nav::after { width: 100%; }
        .sidebar-mobile { transform: translateX(-100%); }
        .sidebar-mobile.open { transform: translateX(0); }
        .sidebar-transition { transition: transform 0.3s ease; }
    </style>
    @stack('styles')
</head>
<body x-data="{ sidebarOpen: window.innerWidth > 768, sidebarCollapsed: false }" class="min-h-screen bg-background">
<div class="flex h-screen overflow-hidden">
    @auth
    <!-- Sidebar -->
    <aside class="sidebar bg-gradient-to-b from-surface to-background text-text border-r border-accent/20 flex flex-col z-40 fixed h-full shadow-xl backdrop-blur-md"
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
                <span class="title-font text-xl text-text tracking-wide">LARA</span>
            </div>
            <button @click="sidebarCollapsed = !sidebarCollapsed" class="text-text/70 hover:text-accent">
                <i :class="sidebarCollapsed ? 'fas fa-chevron-right' : 'fas fa-chevron-left'"></i>
            </button>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto py-4 px-2 space-y-1">
            <x-nav-item icon="fas fa-home" label="Beranda" route="dashboard" />
                            <x-nav-item icon="fas fa-plus-circle" label="Buat Surat Digital" route="laras.create" />
                <x-nav-item icon="fas fa-scroll" label="Surat Digital Saya" route="laras.index" />
            <x-nav-item icon="fas fa-user" label="Profil" route="profile.edit" />
        </nav>

        <!-- Quote -->
        <div class="p-4 border-t border-accent/20 text-sm italic text-accent/60 hidden md:block" x-show="!sidebarCollapsed">
            “Warisan bukan tentang harta, tapi tentang hati yang ditinggalkan.”
        </div>

        <!-- Logout -->
        <div class="p-4 border-t border-accent/20">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center p-2 text-text hover:text-accent transition">
                    <i class="fas fa-sign-out-alt text-lg w-6 text-center"></i>
                    <span x-show="!sidebarCollapsed" class="ml-3">Keluar</span>
                </button>
            </form>
        </div>
    </aside>
    @endauth

    <!-- Main Content -->
    <div class="main-content flex-1 flex flex-col overflow-hidden"
         :class="{
            'ml-0': !@json(auth()->check()),
            'md:ml-20': sidebarOpen && sidebarCollapsed && @json(auth()->check()),
            'md:ml-64': sidebarOpen && !sidebarCollapsed && @json(auth()->check())
         }">
        <!-- Mobile Header -->
        <header class="bg-surface border-b border-accent/20 md:hidden">
            <div class="flex items-center justify-between p-4">
                @auth
                <button @click="sidebarOpen = !sidebarOpen" class="text-text hover:text-accent">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                @endauth
                <div class="flex items-center space-x-2">
                    <i class="fas fa-scroll text-accent text-xl"></i>
                    <span class="title-font text-lg text-text">LARA</span>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 overflow-y-auto w-full p-0">
            @yield('content')
        </main>
    </div>
</div>
@stack('scripts')
</body>
</html>
