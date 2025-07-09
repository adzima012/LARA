<section id="create-message" class="py-16 bg-gradient-to-b from-primary to-primary/90">
    <div class="max-w-4xl mx-auto px-6">
        <div class="gradient-border p-8 rounded-xl bg-primary">
            <h2 class="title-font text-3xl font-bold mb-6 text-center">Create Your <span class="text-accent">Digital Will</span></h2>

            <form action="#" method="POST" class="space-y-6">
    @csrf
    <div>
        <label for="recipientName" class="block text-secondary mb-2">Recipient's Name</label>
        <input type="text" name="recipient_name" id="recipientName" class="w-full bg-primary border border-accent/30 rounded-lg px-4 py-3 text-secondary focus:border-accent focus:outline-none" placeholder="Who should receive this will?">
    </div>

    <div>
        <label for="recipientEmail" class="block text-secondary mb-2">Recipient's Email</label>
        <input type="email" name="recipient_email" id="recipientEmail" class="w-full bg-primary border border-accent/30 rounded-lg px-4 py-3 text-secondary focus:border-accent focus:outline-none" placeholder="Their email address">
    </div>

    <div>
        <label for="willTitle" class="block text-secondary mb-2">Will Title</label>
        <input type="text" name="title" id="willTitle" class="w-full bg-primary border border-accent/30 rounded-lg px-4 py-3 text-secondary focus:border-accent focus:outline-none" placeholder="Title of your digital will">
    </div>

    <div>
        <label for="willContent" class="block text-secondary mb-2">Your Will Content</label>
        <textarea name="content" id="willContent" rows="6" class="w-full bg-primary border border-accent/30 rounded-lg px-4 py-3 text-secondary focus:border-accent focus:outline-none" placeholder="Write your digital will content here..."></textarea>
    </div>

    <button type="submit" class="w-full bg-accent hover:bg-accent/90 text-primary font-medium px-6 py-3 rounded-full transition duration-300">
        Create Digital Will
    </button>
</form>
        </div>
    </div>
</section>
