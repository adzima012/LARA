<section id="faq" class="py-16 bg-gradient-to-b from-primary to-primary/90">
    <div class="max-w-4xl mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="title-font text-3xl md:text-4xl font-bold mb-4 text-secondary">Frequently Asked Questions</h2>
            <p class="text-secondary/80 text-lg">Everything you need to know about creating and managing your digital wills</p>
        </div>

        <div class="space-y-6">
            <!-- FAQ Item 1 -->
            <div class="bg-primary/50 border border-accent/20 rounded-lg overflow-hidden">
                <button class="w-full px-6 py-4 text-left flex justify-between items-center text-secondary hover:bg-accent/10 transition" onclick="toggleFAQ(this)">
                    <span class="font-medium">How secure are my digital wills?</span>
                    <i class="fas fa-chevron-down transition-transform"></i>
                </button>
                <div class="px-6 pb-4 text-secondary/80 hidden">
                    Your digital wills are encrypted and stored securely. Only authorized recipients can access your wills, under the conditions you specify.
                </div>
            </div>

            <!-- FAQ Item 2 -->
            <div class="bg-primary/50 border border-accent/20 rounded-lg overflow-hidden">
                <button class="w-full px-6 py-4 text-left flex justify-between items-center text-secondary hover:bg-accent/10 transition" onclick="toggleFAQ(this)">
                    <span class="font-medium">Can I edit or delete my digital wills after creating them?</span>
                    <i class="fas fa-chevron-down transition-transform"></i>
                </button>
                <div class="px-6 pb-4 text-secondary/80 hidden">
                    Yes, you can edit or delete your digital wills at any time before they're scheduled for delivery.
                </div>
            </div>

            <!-- FAQ Item 3 -->
            <div class="bg-primary/50 border border-accent/20 rounded-lg overflow-hidden">
                <button class="w-full px-6 py-4 text-left flex justify-between items-center text-secondary hover:bg-accent/10 transition" onclick="toggleFAQ(this)">
                    <span class="font-medium">When will my digital will be delivered?</span>
                    <i class="fas fa-chevron-down transition-transform"></i>
                </button>
                <div class="px-6 pb-4 text-secondary/80 hidden">
                    Digital wills are delivered when an admin marks you as deceased and triggers the release process.
                </div>
            </div>

            <!-- FAQ Item 4 -->
            <div class="bg-primary/50 border border-accent/20 rounded-lg overflow-hidden">
                <button class="w-full px-6 py-4 text-left flex justify-between items-center text-secondary hover:bg-accent/10 transition" onclick="toggleFAQ(this)">
                    <span class="font-medium">Who can access my digital wills?</span>
                    <i class="fas fa-chevron-down transition-transform"></i>
                </button>
                <div class="px-6 pb-4 text-secondary/80 hidden">
                    Only the recipients you specify can access your digital wills, and only after the release process is triggered by an admin.
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
