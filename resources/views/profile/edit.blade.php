<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profil') }}
        </h2>
    </x-slot> --}}

    <div class="py-8 bg-gray-50 dark:bg-[#0f172a] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Update Profile Information -->
            <div class="p-4 sm:p-8 bg-white dark:bg-[#1e293b] shadow sm:rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password -->
            <div class="p-4 sm:p-8 bg-white dark:bg-[#1e293b] shadow sm:rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account -->
            <div class="p-4 sm:p-8 bg-white dark:bg-[#1e293b] shadow sm:rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
