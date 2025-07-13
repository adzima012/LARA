<section id="create-message" class="py-16 bg-background">
    <div class="max-w-4xl mx-auto px-6">
        <div class="gradient-border p-8 rounded-xl bg-surface">
            <h2 class="title-font text-3xl font-bold mb-6 text-center text-text">Buat <span class="text-accent">Surat Digital</span> Anda</h2>

            <form action="#" method="POST" class="space-y-6">
    @csrf
    <div>
        <label for="recipientName" class="block text-text mb-2">Nama Penerima</label>
        <input type="text" name="recipient_name" id="recipientName" class="w-full bg-background border border-accent/30 rounded-lg px-4 py-3 text-text focus:border-accent focus:outline-none" placeholder="Siapa yang harus menerima surat ini?">
    </div>

    <div>
        <label for="recipientEmail" class="block text-text mb-2">Email Penerima</label>
        <input type="email" name="recipient_email" id="recipientEmail" class="w-full bg-background border border-accent/30 rounded-lg px-4 py-3 text-text focus:border-accent focus:outline-none" placeholder="Alamat email mereka">
    </div>

    <div>
        <label for="willTitle" class="block text-text mb-2">Judul Surat</label>
        <input type="text" name="title" id="willTitle" class="w-full bg-background border border-accent/30 rounded-lg px-4 py-3 text-text focus:border-accent focus:outline-none" placeholder="Judul surat digital Anda">
    </div>

    <div>
        <label for="willContent" class="block text-text mb-2">Isi Surat Anda</label>
        <textarea name="content" id="willContent" rows="6" class="w-full bg-background border border-accent/30 rounded-lg px-4 py-3 text-text focus:border-accent focus:outline-none" placeholder="Tulis isi surat digital Anda di sini..."></textarea>
    </div>

    <button type="submit" class="w-full bg-primary hover:bg-primaryHover text-black font-medium px-6 py-3 rounded-full transition duration-300">
        Buat Surat Digital
    </button>
</form>
        </div>
    </div>
</section>
