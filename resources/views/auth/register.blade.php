<!-- resources/views/auth/register.blade.php -->

@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-[#12101a] px-4 py-12">
    <div class="bg-[#1d1b24] border border-[#a78bfa33] shadow-xl rounded-2xl w-full max-w-md p-8 space-y-6">
        <div class="text-center">
            <h2 class="text-2xl font-semibold text-white">Create Your Legacy</h2>
            <p class="mt-1 text-sm text-white/60">Write your message. We'll deliver it beyond time.</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <div>
                <label for="name" class="block text-sm text-white/80 mb-1">Full Name</label>
                <input id="name" type="text" name="name" required
                    class="w-full px-4 py-2 rounded bg-[#2b2937] text-white placeholder-white/30 border border-white/10 focus:outline-none focus:ring-2 focus:ring-[#a78bfa]">
            </div>

            <div>
                <label for="email" class="block text-sm text-white/80 mb-1">Email address</label>
                <input id="email" type="email" name="email" required
                    class="w-full px-4 py-2 rounded bg-[#2b2937] text-white placeholder-white/30 border border-white/10 focus:outline-none focus:ring-2 focus:ring-[#a78bfa]">
            </div>

            <div>
                <label for="password" class="block text-sm text-white/80 mb-1">Password</label>
                <input id="password" type="password" name="password" required
                    class="w-full px-4 py-2 rounded bg-[#2b2937] text-white placeholder-white/30 border border-white/10 focus:outline-none focus:ring-2 focus:ring-[#a78bfa]">
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm text-white/80 mb-1">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    class="w-full px-4 py-2 rounded bg-[#2b2937] text-white placeholder-white/30 border border-white/10 focus:outline-none focus:ring-2 focus:ring-[#a78bfa]">
            </div>

            <button type="submit"
                class="w-full py-2 rounded bg-[#a78bfa] hover:bg-[#9274ec] transition text-white font-semibold">Create Account</button>
        </form>

        <p class="text-center text-sm text-white/50 mt-6">
            Already have an account?
            <a href="{{ route('login') }}" class="text-[#a78bfa] hover:underline">Sign In</a>
        </p>
    </div>
</div>
@endsection
