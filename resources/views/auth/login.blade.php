<!-- resources/views/auth/login.blade.php -->

@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-background px-4 py-12">
    <div class="bg-surface border border-accent/20 shadow-xl rounded-2xl w-full max-w-md p-8 space-y-6">
        <div class="text-center">
            <h2 class="text-2xl font-semibold text-text">Selamat Datang Kembali</h2>
            <p class="mt-1 text-sm text-text/60">Masukkan kredensial Anda untuk mengakses kenangan Anda</p>
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
                <label for="email" class="block text-sm text-text/80 mb-1">Alamat Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full px-4 py-2 rounded bg-background text-text placeholder-text/30 border border-accent/30 focus:outline-none focus:ring-2 focus:ring-accent @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm text-text/80 mb-1">Kata Sandi</label>
                <input id="password" type="password" name="password" required
                    class="w-full px-4 py-2 rounded bg-background text-text placeholder-text/30 border border-accent/30 focus:outline-none focus:ring-2 focus:ring-accent @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center text-sm text-text/60">
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="remember" class="accent-primary">
                    Ingat saya
                </label>
            </div>

            <button type="submit"
                class="w-full py-2 rounded bg-primary hover:bg-primaryHover transition text-black font-semibold">Masuk</button>
        </form>

        <p class="text-center text-sm text-text/50 mt-6">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-accent hover:underline">Buat satu</a>
        </p>
    </div>
</div>
@endsection
