<x-guest-layout>
    <style>
        /* Light Mode (Default) */
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
            border-color: #d1d5db;
            color: black;
            background-color: white;
        }
        .input-field:focus {
            border-color: #6b7280;
            box-shadow: none;
            outline: none;
        }
        .remember-label {
            color: #4b5563;
        }
        .remember-checkbox {
            border-color: #d1d5db;
            color: #4b5563;
        }
        .link-forgot {
            color: #dc2626;
        }
        .btn-submit {
            background-color: #1f2937;
            color: white;
        }
        .btn-submit:hover {
            background-color: #111827;
        }

        /* Dark Mode */
        @media (prefers-color-scheme: dark) {
            .form-container {
                background-color: #1f2937;
                border-color: #374151;
                color: #f9fafb;
            }
            .form-title {
                color: #f87171; /* red-400 */
            }
            .form-label,
            .remember-label {
                color: #d1d5db;
            }
            .input-field {
                background-color: #374151;
                color: #f9fafb;
                border-color: #4b5563;
            }
            .input-field:focus {
                border-color: #9ca3af;
                background-color: #4b5563;
            }
            .remember-checkbox {
                border-color: #6b7280;
                color: #f9fafb;
            }
            .link-forgot {
                color: #f87171;
            }
            .btn-submit {
                background-color: #374151;
                color: white;
            }
            .btn-submit:hover {
                background-color: #1f2937;
            }
        }
    </style>

    <div class="form-container p-8 rounded-xl shadow-lg ">
        <div class="text-center mb-6 ">
            <h1 class="form-title text-2xl font-bold">Game Haven</h1>
            <p class="text-sm mt-1">Masuk untuk mulai berbelanja</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4 " :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" class="form-label" />
                <x-text-input id="email" name="email" type="email" required autofocus autocomplete="username"
                    class="input-field block mt-1 w-full" :value="old('email')" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" class="form-label" />
                <x-text-input id="password" name="password" type="password" required autocomplete="current-password"
                    class="input-field block mt-1 w-full" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember & Forgot -->
            <div class="flex items-center justify-between mb-4">
                <label for="remember_me" class="remember-label flex items-center text-sm">
                    <input id="remember_me" type="checkbox" name="remember"
                        class="remember-checkbox rounded shadow-sm mr-2" />
                    {{ __('Ingat saya') }}
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="link-forgot text-sm hover:underline">
                        {{ __('Lupa password?') }}
                    </a>
                @endif
            </div>

            <!-- Submit -->
            <div>
                <x-primary-button class="btn-submit w-full justify-center">
                    {{ __('Masuk') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
