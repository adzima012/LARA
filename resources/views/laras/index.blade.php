@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-12 px-6">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl title-font font-bold mb-2 text-secondary">My Digital Wills</h1>
            <p class="text-secondary/60">Manage and view your digital wills</p>
        </div>
        <a href="{{ route('laras.create') }}" class="bg-accent hover:bg-accent/90 text-primary font-medium px-6 py-3 rounded-lg transition duration-300 flex items-center">
            <i class="fas fa-plus mr-2"></i>
            Create New Will
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-green-500/10 border border-green-500 text-green-300 text-sm p-4 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if($laras->isEmpty())
        <div class="text-center py-12">
            <div class="w-24 h-24 bg-accent/10 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-scroll text-accent text-3xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-secondary mb-2">No Digital Wills Yet</h3>
            <p class="text-secondary/60 mb-6">You haven't created any digital wills yet. Start by creating your first one.</p>
            <a href="{{ route('laras.create') }}" class="bg-accent hover:bg-accent/90 text-primary font-medium px-6 py-3 rounded-lg transition duration-300 inline-flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Create Your First Will
            </a>
        </div>
    @else
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($laras as $lara)
            <div class="bg-primary/50 border border-accent/20 rounded-lg p-6 hover:border-accent/40 transition duration-300">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-lg font-semibold text-secondary">{{ $lara->title }}</h3>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $lara->is_released ? 'bg-green-500/10 text-green-400' : 'bg-accent/10 text-accent' }}">
                        {{ $lara->is_released ? 'Released' : 'Private' }}
                    </span>
                </div>
                
                <p class="text-secondary/70 text-sm mb-4 line-clamp-3">
                    {{ Str::limit($lara->content, 120) }}
                </p>
                
                <div class="flex items-center text-secondary/50 text-sm mb-4">
                    <i class="fas fa-user mr-2"></i>
                    <span>Recipient: {{ $lara->penerima->name }}</span>
                </div>
                
                <div class="flex items-center justify-between">
                    <span class="text-secondary/50 text-xs">
                        Created: {{ $lara->created_at->format('M d, Y') }}
                    </span>
                    <div class="flex space-x-2">
                        <a href="{{ route('laras.edit', $lara) }}" class="text-accent hover:text-accent/80 text-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('laras.destroy', $lara) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this digital will?')" 
                                    class="text-red-400 hover:text-red-300 text-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $laras->links() }}
        </div>
    @endif
</div>
@endsection 