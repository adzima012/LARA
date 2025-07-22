{{-- 
    View ini adalah halaman utama (landing page) aplikasi LARA
    Menampilkan informasi tentang layanan dan tombol untuk login/register
    Menggunakan:
    - TailwindCSS untuk styling
    - AlpineJS untuk interaktivitas
    - Font Awesome untuk ikon
--}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Token CSRF untuk keamanan form --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Framework dan Library CSS/JS --}}
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
</head>
<body>
    <div>
        @include('components.navbar')
        @include('components.hero')
        @include('components.features')
        @include('components.testimonials')
        @include('components.faq')
        @include('components.footer')
    </div>
</body>
</html>
