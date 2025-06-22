<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lara - Digital Will</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

        .title-font {
            font-family: 'Playfair Display', serif;
        }

        .message-box {
            min-height: 200px;
            resize: none;
        }

        .gradient-border {
            position: relative;
            border-radius: 0.5rem;
        }

        .gradient-border::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
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
    </style>
    @stack('styles')
</head>
<body class="min-h-screen bg-primary">
    @yield('content')

    <script>
        // FAQ toggle
        document.querySelectorAll('.faq-toggle').forEach(button => {
            button.addEventListener('click', () => {
                const content = button.nextElementSibling;
                const icon = button.querySelector('i');
                content.classList.toggle('hidden');
                icon.classList.toggle('rotate-180');
            });
        });

        // Form submission
        document.getElementById('messageForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Your message has been securely saved. You can edit it anytime before delivery.');
            this.reset();
        });

        // Fade in effect
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in');
                }
            });
        }, {threshold: 0.1});

        document.querySelectorAll('.fade-in').forEach(el => {
            observer.observe(el);
        });
    </script>

    @stack('scripts')
</body>
</html>
