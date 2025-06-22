@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-6">
    <h1 class="text-3xl title-font font-bold mb-6 text-accent">Edit Message</h1>

    <form action="{{ route('messages.update', $message->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-secondary mb-2">Recipient's Name</label>
            <input type="text" name="recipient_name" value="{{ old('recipient_name', $message->recipient_name) }}" required class="w-full bg-primary border border-accent/30 rounded-lg px-4 py-3 text-secondary focus:outline-none">
        </div>

        <div>
            <label class="block text-secondary mb-2">Recipient's Email</label>
            <input type="email" name="recipient_email" value="{{ old('recipient_email', $message->recipient_email) }}" required class="w-full bg-primary border border-accent/30 rounded-lg px-4 py-3 text-secondary focus:outline-none">
        </div>

        <div>
            <label class="block text-secondary mb-2">Delivery Schedule</label>
            <select name="delivery_schedule" class="w-full bg-primary border border-accent/30 rounded-lg px-4 py-3 text-secondary focus:outline-none">
                @foreach (['birthday', 'anniversary', 'specific', 'immediate'] as $option)
                    <option value="{{ $option }}" {{ $message->delivery_schedule === $option ? 'selected' : '' }}>
                        {{ ucfirst($option) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-secondary mb-2">Message</label>
            <textarea name="message" rows="6" required class="w-full bg-primary border border-accent/30 rounded-lg px-4 py-3 text-secondary focus:outline-none">{{ old('message', $message->message) }}</textarea>
        </div>

        <div class="flex items-center">
            <input type="checkbox" name="repeat_yearly" {{ $message->repeat_yearly ? 'checked' : '' }} class="w-4 h-4 text-accent bg-primary border-accent rounded">
            <label class="ml-2 text-sm text-secondary">Deliver every year</label>
        </div>

        <div>
            <button type="submit" class="bg-accent hover:bg-accent/90 text-primary font-medium px-6 py-3 rounded-full transition duration-300">
                Update Message
            </button>
        </div>
    </form>
</div>
@endsection
