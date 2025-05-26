<x-guest-layout>
    <style>
        /* Style default (light mode) */
        .form-container {
            background-color: white;
            border: 1px solid #e5e7eb; /* gray-200 */
            color: black;
        }
        .form-title {
            color: #dc2626; /* red-600 */
        }
        .form-label {
            color: #4b5563; /* gray-700 */
        }
        .input-field {
            border-color: #d1d5db; /* gray-300 */
            color: black;
            background-color: white;
        }
        .input-field:focus {
            border-color: #6b7280; /* gray-500 */
            box-shadow: none;
            outline: none;
        }
        .link-login {
            color: #dc2626; /* red-500 */
        }
        .btn-submit {
            background-color: #1f2937; /* gray-800 */
            color: white;
        }
        .btn-submit:hover {
            background-color: #111827; /* gray-900 */
        }

        /* Style untuk dark mode */
        @media (prefers-color-scheme: dark) {
            .form-container {
                background-color: #1f2937; /* gray-800 */
                border-color: #374151; /* gray-700 */
                color: #f9fafb; /* gray-50 */
            }
            .form-title {
                color: #f87171; /* red-400 */
            }
            .form-label {
                color: #d1d5db; /* gray-300 */
            }
            .input-field {
                border-color: #4b5563; /* gray-600 */
                background-color: #374151; /* gray-700 */
                color: #f9fafb; /* gray-50 */
            }
            .input-field:focus {
                border-color: #9ca3af; /* gray-400 */
                box-shadow: none;
                outline: none;
                background-color: #4b5563; /* gray-600 */
            }
            .link-login {
                color: #f87171; /* red-400 */
            }
            .btn-submit {
                background-color: #374151; /* gray-700 */
                color: white;
            }
            .btn-submit:hover {
                background-color: #1f2937; /* gray-800 */
            }
        }
    </style>

    <div class="form-container p-8 rounded-xl shadow-lg">
        <div class="text-center mb-6">
            <h1 class="form-title text-2xl font-bold">Daftar ke Game Haven</h1>
            <p class="text-sm mt-1">Buat akun untuk mulai berbelanja</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <x-input-label for="name" :value="__('Nama Lengkap')" class="form-label text-sm" />
                <x-text-input id="name" name="name" type="text" required autofocus autocomplete="name"
                    class="input-field block mt-1 w-full" :value="old('name')" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" class="form-label" />
                <x-text-input id="email" name="email" type="email" required autocomplete="username"
                    class="input-field block mt-1 w-full" :value="old('email')" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" class="form-label" />
                <x-text-input id="password" name="password" type="password" required autocomplete="new-password"
                    class="input-field block mt-1 w-full" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="form-label" />
                <x-text-input id="password_confirmation" name="password_confirmation" type="password" required
                    autocomplete="new-password" class="input-field block mt-1 w-full" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between mt-6">
                <a href="{{ route('login') }}" class="link-login text-sm hover:underline">
                    Sudah punya akun?
                </a>

                <x-primary-button class="btn-submit w-32 justify-center">
                    {{ __('Daftar') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
