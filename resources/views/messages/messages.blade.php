@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-12 px-6">
    <h1 class="text-3xl title-font font-bold mb-6 text-accent">Create New Message</h1>

    <form action="{{ route('messages.store') }}" method="POST" id="messageForm" class="bg-primary/80 p-6 rounded-lg gradient-border">
        @csrf
        
        <div class="mb-4">
            <label for="recipient_name" class="block text-secondary mb-2">Recipient Name</label>
            <input type="text" name="recipient_name" id="recipient_name" 
                   class="w-full px-4 py-2 bg-primary border border-accent/20 rounded-lg text-secondary focus:outline-none focus:ring-2 focus:ring-accent/50" required>
        </div>

        <div class="mb-4">
            <label for="recipient_email" class="block text-secondary mb-2">Recipient Email</label>
            <input type="email" name="recipient_email" id="recipient_email" 
                   class="w-full px-4 py-2 bg-primary border border-accent/20 rounded-lg text-secondary focus:outline-none focus:ring-2 focus:ring-accent/50" required>
        </div>

        <div class="mb-4">
            <label for="delivery_schedule" class="block text-secondary mb-2">Delivery Date</label>
            <input type="date" name="delivery_schedule" id="delivery_schedule" 
                   class="w-full px-4 py-2 bg-primary border border-accent/20 rounded-lg text-secondary focus:outline-none focus:ring-2 focus:ring-accent/50" required>
        </div>

        <div class="mb-4">
            <label for="message" class="block text-secondary mb-2">Your Message</label>
            <textarea name="message" id="message" rows="6"
                      class="w-full px-4 py-2 bg-primary border border-accent/20 rounded-lg text-secondary focus:outline-none focus:ring-2 focus:ring-accent/50 message-box" required></textarea>
        </div>

        <div class="mb-4 flex items-center">
            <input type="checkbox" name="repeat_yearly" id="repeat_yearly" 
                   class="mr-2 bg-primary border border-accent/20 rounded text-accent focus:ring-accent/50">
            <label for="repeat_yearly" class="text-secondary">Repeat this message yearly</label>
        </div>

        <button type="submit" class="bg-accent text-primary font-medium px-6 py-2 rounded-full hover:bg-accent/90 transition">
            Save Message
        </button>
    </form>
</div>
@endsection