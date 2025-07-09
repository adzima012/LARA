@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-6">
    <div class="mb-8">
        <h1 class="text-3xl title-font font-bold mb-2 text-secondary">Profile Settings</h1>
        <p class="text-secondary/60">Manage your account information and preferences</p>
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

    <div class="space-y-8">
        <!-- Profile Information -->
        <div class="bg-primary/50 border border-accent/20 rounded-lg p-6">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-accent/20 rounded-full flex items-center justify-center mr-4">
                    <i class="fas fa-user text-accent text-xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-secondary">Profile Information</h2>
                    <p class="text-secondary/60 text-sm">Update your account's profile information and email address.</p>
                </div>
            </div>

            <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                @csrf
                @method('patch')

                <div>
                    <label for="name" class="block text-sm text-secondary/80 mb-2">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                        class="w-full px-4 py-3 bg-primary border border-accent/20 rounded-lg text-secondary focus:outline-none focus:ring-2 focus:ring-accent/50 @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-red-400 text-xs mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm text-secondary/80 mb-2">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                        class="w-full px-4 py-3 bg-primary border border-accent/20 rounded-lg text-secondary focus:outline-none focus:ring-2 focus:ring-accent/50 @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-red-400 text-xs mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="bg-accent hover:bg-accent/90 text-primary font-medium px-6 py-3 rounded-lg transition duration-300">
                        Save Changes
                    </button>
                    @if (session('status') === 'profile-updated')
                        <p class="text-green-400 text-sm flex items-center">
                            <i class="fas fa-check-circle mr-1"></i>
                            Profile updated successfully.
                        </p>
                    @endif
                </div>
            </form>
        </div>

        <!-- Update Password -->
        <div class="bg-primary/50 border border-accent/20 rounded-lg p-6">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-accent/20 rounded-full flex items-center justify-center mr-4">
                    <i class="fas fa-lock text-accent text-xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-secondary">Update Password</h2>
                    <p class="text-secondary/60 text-sm">Ensure your account is using a long, random password to stay secure.</p>
                </div>
            </div>

            <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                @csrf
                @method('put')

                <div>
                    <label for="current_password" class="block text-sm text-secondary/80 mb-2">Current Password</label>
                    <input type="password" name="current_password" id="current_password" required
                        class="w-full px-4 py-3 bg-primary border border-accent/20 rounded-lg text-secondary focus:outline-none focus:ring-2 focus:ring-accent/50 @error('current_password') border-red-500 @enderror"
                        placeholder="Enter your current password">
                    @error('current_password')
                        <p class="text-red-400 text-xs mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="new_password" class="block text-sm text-secondary/80 mb-2">New Password</label>
                    <input type="password" name="password" id="new_password" required
                        class="w-full px-4 py-3 bg-primary border border-accent/20 rounded-lg text-secondary focus:outline-none focus:ring-2 focus:ring-accent/50 @error('password') border-red-500 @enderror"
                        placeholder="Enter your new password">
                    @error('password')
                        <p class="text-red-400 text-xs mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm text-secondary/80 mb-2">Confirm New Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="w-full px-4 py-3 bg-primary border border-accent/20 rounded-lg text-secondary focus:outline-none focus:ring-2 focus:ring-accent/50 @error('password_confirmation') border-red-500 @enderror"
                        placeholder="Confirm your new password">
                    @error('password_confirmation')
                        <p class="text-red-400 text-xs mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="bg-accent hover:bg-accent/90 text-primary font-medium px-6 py-3 rounded-lg transition duration-300">
                        Update Password
                    </button>
                    @if (session('status') === 'password-updated')
                        <p class="text-green-400 text-sm flex items-center">
                            <i class="fas fa-check-circle mr-1"></i>
                            Password updated successfully.
                        </p>
                    @endif
                </div>
            </form>
        </div>

        <!-- Delete Account -->
        <div class="bg-red-500/10 border border-red-500/20 rounded-lg p-6">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-red-500/20 rounded-full flex items-center justify-center mr-4">
                    <i class="fas fa-exclamation-triangle text-red-400 text-xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-secondary">Delete Account</h2>
                    <p class="text-secondary/60 text-sm">Once your account is deleted, all of its resources and data will be permanently deleted.</p>
                </div>
            </div>

            <form method="post" action="{{ route('profile.destroy') }}" class="space-y-6">
                @csrf
                @method('delete')

                <div>
                    <label for="delete_password" class="block text-sm text-secondary/80 mb-2">Password</label>
                    <input type="password" name="password" id="delete_password" required
                        class="w-full px-4 py-3 bg-primary border border-accent/20 rounded-lg text-secondary focus:outline-none focus:ring-2 focus:ring-accent/50 @error('password') border-red-500 @enderror"
                        placeholder="Enter your password to confirm">
                    @error('password')
                        <p class="text-red-400 text-xs mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-medium px-6 py-3 rounded-lg transition duration-300"
                            onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.')">
                        Delete Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
