<!-- resources/views/auth/login.blade.php -->

@extends('layouts.app') <!-- Pastikan layout utama juga sudah dark theme -->

@section('content')
<div class="min-h-screen flex items-center justify-center bg-[#12101a] px-4 py-12">
    <div class="bg-[#1d1b24] border border-[#a78bfa33] shadow-xl rounded-2xl w-full max-w-md p-8 space-y-6">
        <div class="text-center">
            <h2 class="text-2xl font-semibold text-white">Welcome Back</h2>
            <p class="mt-1 text-sm text-white/60">Enter your credentials to access your memories</p>
        </div>

        @if(session('error'))
            <div class="bg-red-500/10 border border-red-500 text-red-300 text-sm p-3 rounded">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-500/10 border border-red-500 text-red-300 text-sm p-3 rounded">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm text-white/80 mb-1">Email address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full px-4 py-2 rounded bg-[#2b2937] text-white placeholder-white/30 border border-white/10 focus:outline-none focus:ring-2 focus:ring-[#a78bfa] @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm text-white/80 mb-1">Password</label>
                <input id="password" type="password" name="password" required
                    class="w-full px-4 py-2 rounded bg-[#2b2937] text-white placeholder-white/30 border border-white/10 focus:outline-none focus:ring-2 focus:ring-[#a78bfa] @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between text-sm text-white/60">
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="remember" class="accent-[#a78bfa]">
                    Remember me
                </label>
                <a href="{{ route('password.request') }}" class="hover:underline text-[#a78bfa]">Forgot?</a>
            </div>

            <button type="submit"
                class="w-full py-2 rounded bg-[#a78bfa] hover:bg-[#9274ec] transition text-white font-semibold">Sign In</button>
        </form>

        <p class="text-center text-sm text-white/50 mt-6">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-[#a78bfa] hover:underline">Create one</a>
        </p>
    </div>
</div>
@endsection
