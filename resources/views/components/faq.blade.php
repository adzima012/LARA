<section id="faq" class="py-16 bg-background">
    <div class="max-w-4xl mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="title-font text-3xl md:text-4xl font-bold mb-4 text-text">Pertanyaan yang Sering Diajukan</h2>
                            <p class="text-text/80 text-lg">Semua yang perlu Anda ketahui tentang membuat dan mengelola surat digital Anda</p>
        </div>

        <div class="space-y-6">
            <!-- FAQ Item 1 -->
            <div class="bg-surface/80 border border-accent/20 rounded-lg overflow-hidden">
                <button class="w-full px-6 py-4 text-left flex justify-between items-center text-text hover:bg-accent/10 transition" onclick="toggleFAQ(this)">
                    <span class="font-medium">Seberapa aman surat digital saya?</span>
                    <i class="fas fa-chevron-down transition-transform"></i>
                </button>
                <div class="px-6 pb-4 text-text/80 hidden">
                    Surat digital Anda dienkripsi dan disimpan dengan aman. Hanya penerima yang berwenang yang dapat mengakses surat Anda, sesuai dengan kondisi yang Anda tentukan.
                </div>
            </div>

            <!-- FAQ Item 2 -->
            <div class="bg-surface/80 border border-accent/20 rounded-lg overflow-hidden">
                <button class="w-full px-6 py-4 text-left flex justify-between items-center text-text hover:bg-accent/10 transition" onclick="toggleFAQ(this)">
                    <span class="font-medium">Bisakah saya mengedit atau menghapus surat digital setelah membuatnya?</span>
                    <i class="fas fa-chevron-down transition-transform"></i>
                </button>
                <div class="px-6 pb-4 text-text/80 hidden">
                    Ya, Anda dapat mengedit atau menghapus surat digital Anda kapan saja sebelum dijadwalkan untuk pengiriman.
                </div>
            </div>

            <!-- FAQ Item 3 -->
            <div class="bg-surface/80 border border-accent/20 rounded-lg overflow-hidden">
                <button class="w-full px-6 py-4 text-left flex justify-between items-center text-text hover:bg-accent/10 transition" onclick="toggleFAQ(this)">
                    <span class="font-medium">Kapan surat digital saya akan disampaikan?</span>
                    <i class="fas fa-chevron-down transition-transform"></i>
                </button>
                <div class="px-6 pb-4 text-text/80 hidden">
                    Surat digital disampaikan ketika admin menandai Anda sebagai meninggal dan memicu proses pelepasan.
                </div>
            </div>

            <!-- FAQ Item 4 -->
            <div class="bg-surface/80 border border-accent/20 rounded-lg overflow-hidden">
                <button class="w-full px-6 py-4 text-left flex justify-between items-center text-text hover:bg-accent/10 transition" onclick="toggleFAQ(this)">
                    <span class="font-medium">Siapa yang dapat mengakses surat digital saya?</span>
                    <i class="fas fa-chevron-down transition-transform"></i>
                </button>
                <div class="px-6 pb-4 text-text/80 hidden">
                    Hanya penerima yang Anda tentukan yang dapat mengakses surat digital Anda, dan hanya setelah proses pelepasan dipicu oleh admin.
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleFAQ(button) {
            const content = button.nextElementSibling;
            const icon = button.querySelector('i');
            
            content.classList.toggle('hidden');
            icon.style.transform = content.classList.contains('hidden') ? 'rotate(0deg)' : 'rotate(180deg)';
        }
    </script>
</section>
