<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 m-8 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <!-- Detail Nama -->
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                        {{ __('Nama') }}
                    </label>
                    <div class="mt-1 text-gray-900 dark:text-gray-200">
                        {{ $user->name }}
                    </div>
                </div>

                <!-- Detail Email -->
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                        {{ __('Email') }}
                    </label>
                    <div class="mt-1 text-gray-900 dark:text-gray-200">
                        {{ $user->email }}
                    </div>
                </div>

                <!-- Detail Role -->
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                        {{ __('Role') }}
                    </label>
                    <div class="mt-1 text-gray-900 dark:text-gray-200">
                        {{ $user->getRoleNames()->implode(', ') }}
                    </div>
                </div>

                <!-- Tombol kembali -->
                <div class="flex items-center justify-end mt-4 space-x-2 gap-4">
                    <!-- Tombol Kembali -->
                    
                    <a href="{{ route('users.index') }}">
                        <x-secondary-button>
                            {{ __('Kembali') }}
                        </x-secondary-button>
                    </a>
                    <!-- Tombol Lihat Detail Informasi -->
                    
                    <a href="{{ url('/users/' . $user->id . '/details') }}">
                        <x-primary-button>
                            {{ __('Lihat Detail Informasi') }}
                        </x-primary-button>
                    </a>
                    
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
