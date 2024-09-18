<x-guest-layout>
    <style>
        /* Basic form styling */
        form {
            background-color: #f9fafb;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        /* Input focus styling */
        input:focus {
            border-color: #6366f1; /* Indigo color */
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.5);
            outline: none;
        }

        /* Input hover effect */
        input:hover {
            border-color: #818cf8;
        }

        /* Button styling */
        .ms-4 {
            background-color: #6366f1;
            color: white;
            transition: background-color 0.3s ease, transform 0.2s ease;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .ms-4:hover {
            background-color: #4f46e5;
            transform: scale(1.05);
        }

        .ms-4:active {
            background-color: #4338ca;
            transform: scale(0.98);
        }

        /* Link hover effect */
        a:hover {
            color: #6366f1;
            text-decoration: none;
        }

        /* Error message styling */
        .mt-2 {
            color: #b91c1c; /* Red for errors */
            font-weight: bold;
        }

        /* Form background change on hover */
        form:hover {
            background-color: #f1f5f9;
        }
    </style>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
