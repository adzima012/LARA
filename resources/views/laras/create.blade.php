@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-6">
    <div class="mb-8">
        <h1 class="text-3xl title-font font-bold mb-2 text-secondary">Create Digital Will</h1>
        <p class="text-secondary/60">Write your digital will that will be delivered to your loved ones</p>
    </div>

    @if($errors->any())
        <div class="mb-6 bg-red-500/10 border border-red-500 text-red-300 text-sm p-4 rounded-lg">
            <div class="flex items-center mb-2">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <span class="font-semibold">Please fix the following errors:</span>
            </div>
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-primary/50 border border-accent/20 rounded-lg p-8">
        <form action="{{ route('laras.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="title" class="block text-sm text-secondary/80 mb-2">Will Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                    class="w-full px-4 py-3 bg-primary border border-accent/20 rounded-lg text-secondary focus:outline-none focus:ring-2 focus:ring-accent/50 @error('title') border-red-500 @enderror"
                    placeholder="Enter a title for your digital will">
                @error('title')
                    <p class="text-red-400 text-xs mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label for="penerima_id" class="block text-sm text-secondary/80 mb-2">Recipient</label>
                <select name="penerima_id" id="penerima_id" required
                    class="w-full px-4 py-3 bg-primary border border-accent/20 rounded-lg text-secondary focus:outline-none focus:ring-2 focus:ring-accent/50 @error('penerima_id') border-red-500 @enderror">
                    <option value="">Select a recipient</option>
                    @foreach(\App\Models\User::where('id', '!=', auth()->id())->get() as $user)
                        <option value="{{ $user->id }}" {{ old('penerima_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
                @error('penerima_id')
                    <p class="text-red-400 text-xs mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label for="content" class="block text-sm text-secondary/80 mb-2">Will Content</label>
                <textarea name="content" id="content" rows="10" required
                    class="w-full px-4 py-3 bg-primary border border-accent/20 rounded-lg text-secondary focus:outline-none focus:ring-2 focus:ring-accent/50 @error('content') border-red-500 @enderror"
                    placeholder="Write your digital will content here...">{{ old('content') }}</textarea>
                @error('content')
                    <p class="text-red-400 text-xs mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="bg-accent/10 border border-accent/20 rounded-lg p-4">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-accent mt-1 mr-3"></i>
                    <div class="text-sm text-secondary/80">
                        <p class="font-semibold mb-1">Important Information:</p>
                        <ul class="list-disc list-inside space-y-1">
                            <li>Your digital will will remain private until released by an admin</li>
                            <li>Only the specified recipient can view the will after release</li>
                            <li>You can edit or delete this will at any time before release</li>
                            <li>Make sure to choose the correct recipient</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <button type="submit" class="bg-accent hover:bg-accent/90 text-primary font-medium px-8 py-3 rounded-lg transition duration-300 flex items-center">
                    <i class="fas fa-save mr-2"></i>
                    Create Digital Will
                </button>
                <a href="{{ route('laras.index') }}" class="border border-accent/30 text-accent hover:bg-accent/10 font-medium px-8 py-3 rounded-lg transition duration-300">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection 