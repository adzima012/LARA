@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-12 px-6">
    <h1 class="text-3xl title-font font-bold mb-6 text-accent">Your Messages</h1>

    <p class="mb-6 text-secondary/50">Login as user ID: {{ auth()->id() }}</p>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-600/20 border border-green-600 text-green-400 rounded">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('messages.create') }}" class="inline-block mb-6 bg-accent text-primary font-medium px-6 py-2 rounded-full hover:bg-accent/90 transition">
        + Create New Message
    </a>

    @if($messages->isEmpty())
        <p class="text-secondary/70">You haven’t created any messages yet.</p>
    @else
        <div class="space-y-4">
            @foreach($messages as $message)
            <div class="p-4 border border-accent/20 rounded-lg bg-primary/80">
                <h2 class="text-lg font-semibold text-secondary mb-1">{{ $message->recipient_name }} ({{ $message->recipient_email }})</h2>
                <p class="text-secondary/80 text-sm mb-2">{{ Str::limit($message->message, 100) }}</p>
                <div class="flex justify-between text-sm text-secondary/50">
                    <span>Delivery: {{ ucfirst($message->delivery_schedule) }}</span>
                    <div class="space-x-3">
                        <a href="{{ route('messages.edit', $message->id) }}" class="text-accent hover:underline">Edit</a>
                        <form action="{{ route('messages.destroy', $message->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')" class="text-red-500 hover:underline">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
