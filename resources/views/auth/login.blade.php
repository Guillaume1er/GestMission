<x-guest-layout>
    <style>
        /* Form Container Styling */
        .form-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto;
            margin-top: 50px; /* Added margin-top to center it vertically */
        }

        /* Form Heading */
        .form-container h2 {
            margin-bottom: 20px;
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
            text-align: center;
        }

        /* Input Fields Styling */
        .form-container input {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 12px;
            border-radius: 6px;
            width: 100%;
            font-size: 1rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            margin-top: 8px;
        }

        .form-container input:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 8px rgba(99, 102, 241, 0.3);
            outline: none;
        }

        /* Custom Error Message Styling */
        .mt-2 {
            color: #e11d48;
            font-size: 0.875rem;
            font-weight: 500;
        }

        /* Button Styling */
        .form-container .primary-button {
            background-color: #4f46e5;
            color: white;
            padding: 12px 20px;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            border: none;
            display: inline-block;
            text-align: center;
            width: 100%;
            margin-top: 20px;
        }

        .form-container .primary-button:hover {
            background-color: #3730a3;
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(99, 102, 241, 0.4);
        }

        .form-container .primary-button:active {
            transform: scale(0.98);
        }

        /* Remember Me Checkbox Styling */
        .inline-flex input:checked {
            border-color: #4f46e5;
        }

        /* Link Styling */
        a {
            color: #4f46e5;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #3730a3;
            text-decoration: underline;
        }
    </style>

    <div class="form-container">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <h2>{{ __('Login') }}</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full"
                              type="password"
                              name="password"
                              required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button class="primary-button ms-3">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
    </div>
   
    
</x-guest-layout>
