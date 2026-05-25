<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmtastic - Sign In</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* This hides the Edge/Chrome default password eye icon so it doesn't overlap yours! */
        input[type="password"]::-ms-reveal,
        input[type="password"]::-ms-clear {
            display: none !important;
        }
        input[type="password"]::-webkit-reveal {
            display: none !important;
        }
    </style>
</head>
<body class="flex h-screen w-screen bg-[#FFFFFF]">

    <div class="hidden lg:flex flex-col justify-center items-center w-1/2 bg-[#2C4A3E] text-[#FFFFFF] p-12">
        
        <img src="{{ asset('images/logo.png') }}" alt="Farmtastic Logo" class="mb-6 h-48 w-auto object-contain drop-shadow-lg">

        <h1 class="text-5xl font-bold mb-4">Farmtastic</h1>
        <h2 class="text-xl mb-6 text-gray-200">Farm Supply Management</h2>
        
        <p class="text-center text-gray-300 max-w-sm">
            Manage your farm supply business with our comprehensive inventory, sales, and customer management system.
        </p>
    </div>

    <div class="flex flex-col justify-center w-full lg:w-1/2 p-8 sm:p-24">
        <div class="max-w-md w-full mx-auto">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Sign In</h2>
            <p class="text-gray-500 mb-8">Enter your credentials to access your account</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="off" placeholder="admin@farmtastic.com" class="pl-10 block w-full border border-gray-300 rounded-lg focus:ring-[#5A8A54] focus:border-[#5A8A54] sm:text-sm py-2">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        
                        <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Enter your password" class="pl-10 pr-10 block w-full border border-gray-300 rounded-lg focus:ring-[#5A8A54] focus:border-[#5A8A54] sm:text-sm py-2">
                        
                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3 hidden items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                            
                            <svg id="eyeSlashIcon" class="h-5 w-5 block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                            
                            <svg id="eyeIcon" class="h-5 w-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
                </div>

                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <input id="remember_me" type="checkbox" name="remember" class="h-4 w-4 text-[#5A8A54] focus:ring-[#5A8A54] border-gray-300 rounded">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-700">Remember me</label>
                    </div>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-[#5A8A54] font-medium hover:underline">Forgot password?</a>
                    @endif
                </div>

                <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-[#FFFFFF] bg-[#5A8A54] hover:bg-[#2C4A3E] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#5A8A54] transition-colors">
                    Sign In
                </button>
            </form>

            <p class="mt-8 text-center text-sm text-gray-500">
                Don't have an account? <a href="{{ route('register') }}" class="text-[#5A8A54] font-medium hover:underline">Register Here</a>
            </p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const togglePassword = document.getElementById('togglePassword');
            const password = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            const eyeSlashIcon = document.getElementById('eyeSlashIcon');

            // 1. Only show the eye icon button if there is text in the input
            password.addEventListener('input', function() {
                if (password.value.length > 0) {
                    togglePassword.classList.remove('hidden');
                    togglePassword.classList.add('flex');
                } else {
                    togglePassword.classList.add('hidden');
                    togglePassword.classList.remove('flex');
                }
            });

            // 2. Toggle logic
            togglePassword.addEventListener('click', function () {
                if (password.type === 'password') {
                    // Changing to text: show Open Eye, hide Closed Eye
                    password.type = 'text';
                    eyeSlashIcon.classList.add('hidden');
                    eyeSlashIcon.classList.remove('block');
                    eyeIcon.classList.remove('hidden');
                    eyeIcon.classList.add('block');
                } else {
                    // Changing to password: show Closed Eye, hide Open Eye
                    password.type = 'password';
                    eyeIcon.classList.add('hidden');
                    eyeIcon.classList.remove('block');
                    eyeSlashIcon.classList.remove('hidden');
                    eyeSlashIcon.classList.add('block');
                }
            });
        });
    </script>
</body>
</html>