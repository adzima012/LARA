@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-6">
    <h1 class="text-3xl title-font font-bold mb-6 text-accent">Create New Message</h1>

    <form action="{{ route('messages.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label class="block text-secondary mb-2" for="recipient_name">Recipient's Name</label>
            <input type="text" name="recipient_name" id="recipient_name" required class="w-full bg-primary border border-accent/30 rounded-lg px-4 py-3 text-secondary focus:outline-none">
        </div>

        <div>
            <label class="block text-secondary mb-2" for="recipient_email">Recipient's Email</label>
            <input type="email" name="recipient_email" id="recipient_email" required class="w-full bg-primary border border-accent/30 rounded-lg px-4 py-3 text-secondary focus:outline-none">
        </div>

        <div>
            <label class="block text-secondary mb-2" for="delivery_schedule">Delivery Schedule</label>
            <select name="delivery_schedule" id="delivery_schedule" required class="w-full bg-primary border border-accent/30 rounded-lg px-4 py-3 text-secondary focus:outline-none">
                <option value="birthday">Every year on their birthday</option>
                <option value="anniversary">Every year on your anniversary</option>
                <option value="specific">Specific date</option>
                <option value="immediate">Immediately after verification</option>
            </select>
        </div>

        <div>
            <label class="block text-secondary mb-2" for="message">Message</label>
            <textarea name="message" id="message" rows="6" required class="w-full bg-primary border border-accent/30 rounded-lg px-4 py-3 text-secondary focus:outline-none"></textarea>
        </div>

        <div class="flex items-center">
            <input type="checkbox" name="repeat_yearly" id="repeat_yearly" class="w-4 h-4 text-accent bg-primary border-accent rounded">
            <label for="repeat_yearly" class="ml-2 text-sm text-secondary">Deliver this message every year</label>
        </div>

        <div>
            <button type="submit" class="bg-accent hover:bg-accent/90 text-primary font-medium px-6 py-3 rounded-full transition duration-300">
                Save Message
            </button>
        </div>
    </form>
</div>
@endsection
