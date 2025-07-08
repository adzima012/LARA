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

    <!-- Search and Create Button Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        
        <form action="{{ route('dashboard') }}" method="GET" class="order-1 sm:order-2 w-full sm:w-96">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-secondary/50" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input 
                    type="text" 
                    name="search" 
                    class="block w-full pl-10 pr-12 py-2 border border-accent/20 rounded-full bg-primary text-secondary focus:outline-none focus:ring-2 focus:ring-accent/50" 
                    placeholder="Search by name, email or message..." 
                    value="{{ request('search') }}"
                >
                @if(request('search'))
                    <button 
                        type="button" 
                        onclick="window.location='{{ route('dashboard') }}'" 
                        class="absolute inset-y-0 right-8 flex items-center pr-2 text-secondary/50 hover:text-accent"
                        title="Clear search"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </button>
                @endif
                <button 
                    type="submit" 
                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-accent"
                    title="Search"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </form>
    </div>

    @if($messages->isEmpty())
        <div class="text-center py-12">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-secondary/30 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            <p class="text-secondary/70 text-lg">You haven't created any messages yet.</p>
            <p class="text-secondary/50 mt-2">Click "Create New Message" to get started</p>
        </div>
    @else
        <div class="space-y-4">
            @foreach($messages as $message)
            <div class="p-4 border border-accent/20 rounded-lg bg-primary/80 hover:bg-primary/70 transition">
                <div class="flex justify-between items-start">
                    <div>
                        <h2 class="text-lg font-semibold text-secondary mb-1">{{ $message->recipient_name }}</h2>
                        <p class="text-secondary/80 text-sm mb-2">{{ Str::limit($message->message, 100) }}</p>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-accent/10 text-accent">
                        {{ $message->recipient_email }}
                    </span>
                </div>
                <div class="flex justify-between items-center mt-2 text-sm">
                    <div class="flex items-center text-secondary/50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>
                            Delivery: 
                            @if($message->delivery_schedule && strtotime($message->delivery_schedule))
                                {{ \Carbon\Carbon::parse($message->delivery_schedule)->format('M d, Y') }}
                            @else
                                <span class="text-red-500 italic">Invalid date</span>
                            @endif
                        </span>
                    </div>
                    <div class="space-x-3">
                        <a href="{{ route('messages.edit', $message->id) }}" class="text-accent hover:text-accent/80 hover:underline flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit
                        </a>
                        <form action="{{ route('messages.destroy', $message->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this message?')" class="text-red-500 hover:text-red-400 hover:underline flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $messages->links() }}
        </div>
    @endif
</div>
@endsection
