@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-12 px-6">
    <h1 class="text-3xl title-font font-bold mb-6 text-accent">Your Digital Wills</h1>

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
                    placeholder="Search by title or content..." 
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

    <div class="text-center py-12">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-secondary/30 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
        </svg>
        <p class="text-secondary/70 text-lg">You haven't created any digital wills yet.</p>
        <p class="text-secondary/50 mt-2">Create your first digital will to get started</p>
    </div>
</div>
@endsection
