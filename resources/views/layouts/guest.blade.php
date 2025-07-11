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
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-background">
            <div>
                <a href="/" class="flex items-center space-x-2">
                    <i class="fas fa-scroll text-accent text-3xl"></i>
                    <span class="title-font text-2xl font-bold text-text">LARA</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-surface shadow-md overflow-hidden sm:rounded-lg border border-accent/20">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
