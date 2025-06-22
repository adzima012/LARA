<section id="create-message" class="py-16 bg-gradient-to-b from-primary to-primary/90">
    <div class="max-w-4xl mx-auto px-6">
        <div class="gradient-border p-8 rounded-xl bg-primary">
            <h2 class="title-font text-3xl font-bold mb-6 text-center">Create Your <span class="text-accent">Digital Will</span></h2>

            <form action="{{ route('messages.store') }}" method="POST" class="space-y-6">
    @csrf
    <div>
        <label for="recipientName" class="block text-secondary mb-2">Recipient's Name</label>
        <input type="text" name="recipient_name" id="recipientName" class="w-full bg-primary border border-accent/30 rounded-lg px-4 py-3 text-secondary focus:border-accent focus:outline-none" placeholder="Who should receive this message?">
    </div>

    <div>
        <label for="recipientEmail" class="block text-secondary mb-2">Recipient's Email</label>
        <input type="email" name="recipient_email" id="recipientEmail" class="w-full bg-primary border border-accent/30 rounded-lg px-4 py-3 text-secondary focus:border-accent focus:outline-none" placeholder="Their email address">
    </div>

    <div>
        <label for="deliveryDate" class="block text-secondary mb-2">Delivery Schedule</label>
        <select name="delivery_schedule" id="deliveryDate" class="w-full bg-primary border border-accent/30 rounded-lg px-4 py-3 text-secondary focus:border-accent focus:outline-none">
            <option value="birthday">Every year on their birthday</option>
            <option value="anniversary">Every year on your anniversary</option>
            <option value="specific">Specific date</option>
            <option value="immediate">Immediately after verification</option>
        </select>
    </div>

    <div>
        <label for="messageContent" class="block text-secondary mb-2">Your Message</label>
        <textarea name="message" id="messageContent" class="w-full message-box bg-primary border border-accent/30 rounded-lg px-4 py-3 text-secondary focus:border-accent focus:outline-none" placeholder="Write your heartfelt message here..."></textarea>
    </div>

    <div class="flex items-center">
        <input type="checkbox" name="repeat_yearly" id="multipleDelivery" class="w-4 h-4 text-accent bg-primary border-accent rounded focus:ring-accent">
        <label for="multipleDelivery" class="ml-2 text-sm text-secondary">Deliver this message every year</label>
    </div>

    <div class="pt-4">
        <button type="submit" class="w-full bg-accent hover:bg-accent/90 text-primary font-medium px-6 py-3 rounded-full transition duration-300 flex items-center justify-center">
            <i class="fas fa-lock mr-2"></i> Secure & Save Your Message
        </button>
    </div>
</form>

        </div>
    </div>
</section>
