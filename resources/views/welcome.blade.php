<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

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
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;600&display=swap');

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
</head>
<body>
    <div>
        @include('components.navbar')
        @include('components.hero')
        @include('components.features')
        @include('components.create-message')
        @include('components.testimonials')
        @include('components.faq')
        @include('components.cta')
        @include('components.footer')
    </div>
</body>
</html>
