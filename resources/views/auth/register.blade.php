<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmtastic - Register</title>
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

    <div class="flex flex-col justify-center w-full lg:w-1/2 p-8 sm:p-24 overflow-y-auto">
        <div class="max-w-md w-full mx-auto py-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Create an Account</h2>
            <p class="text-gray-500 mb-8">Register to start managing your farm supply business.</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Juan Dela Cruz" class="pl-10 block w-full border border-gray-300 rounded-lg focus:ring-[#5A8A54] focus:border-[#5A8A54] sm:text-sm py-2">
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-600" />
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="juan@example.com" class="pl-10 block w-full border border-gray-300 rounded-lg focus:ring-[#5A8A54] focus:border-[#5A8A54] sm:text-sm py-2">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        
                        <input id="password" type="password" name="password" required placeholder="Create a strong password" class="pl-10 pr-10 block w-full border border-gray-300 rounded-lg focus:ring-[#5A8A54] focus:border-[#5A8A54] sm:text-sm py-2">
                        
                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3 hidden items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                            <svg id="eyeSlashIcon" class="h-5 w-5 block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                            <svg id="eyeIcon" class="h-5 w-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
                </div>

                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                        
                        <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="Repeat your password" class="pl-10 pr-10 block w-full border border-gray-300 rounded-lg focus:ring-[#5A8A54] focus:border-[#5A8A54] sm:text-sm py-2">
                        
                        <button type="button" id="toggleConfirmPassword" class="absolute inset-y-0 right-0 pr-3 hidden items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                            <svg id="eyeSlashConfirm" class="h-5 w-5 block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                            <svg id="eyeConfirm" class="h-5 w-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600" />
                </div>

                <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-[#FFFFFF] bg-[#5A8A54] hover:bg-[#2C4A3E] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#5A8A54] transition-colors mt-2">
                    Create Account
                </button>
            </form>

            <p class="mt-8 text-center text-sm text-gray-500">
                Already have an account? <a href="{{ route('login') }}" class="text-[#5A8A54] font-medium hover:underline">Sign In Here</a>
            </p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Function to handle showing/hiding icons based on input text
            function handleInputVisibility(inputEl, btnEl) {
                inputEl.addEventListener('input', function() {
                    if (inputEl.value.length > 0) {
                        btnEl.classList.remove('hidden');
                        btnEl.classList.add('flex');
                    } else {
                        btnEl.classList.add('hidden');
                        btnEl.classList.remove('flex');
                    }
                });
            }

            // Function to handle the click toggle logic
            function setupToggle(btnEl, inputEl, iconOpen, iconClosed) {
                btnEl.addEventListener('click', function () {
                    if (inputEl.type === 'password') {
                        inputEl.type = 'text';
                        iconClosed.classList.add('hidden');
                        iconClosed.classList.remove('block');
                        iconOpen.classList.remove('hidden');
                        iconOpen.classList.add('block');
                    } else {
                        inputEl.type = 'password';
                        iconOpen.classList.add('hidden');
                        iconOpen.classList.remove('block');
                        iconClosed.classList.remove('hidden');
                        iconClosed.classList.add('block');
                    }
                });
            }

            // Setup Main Password Field
            const password = document.getElementById('password');
            const togglePassword = document.getElementById('togglePassword');
            const eyeIcon = document.getElementById('eyeIcon');
            const eyeSlashIcon = document.getElementById('eyeSlashIcon');
            
            handleInputVisibility(password, togglePassword);
            setupToggle(togglePassword, password, eyeIcon, eyeSlashIcon);

            // Setup Confirm Password Field
            const passwordConf = document.getElementById('password_confirmation');
            const toggleConf = document.getElementById('toggleConfirmPassword');
            const eyeConf = document.getElementById('eyeConfirm');
            const eyeSlashConf = document.getElementById('eyeSlashConfirm');
            
            handleInputVisibility(passwordConf, toggleConf);
            setupToggle(toggleConf, passwordConf, eyeConf, eyeSlashConf);
        });
    </script>
</body>
</html>