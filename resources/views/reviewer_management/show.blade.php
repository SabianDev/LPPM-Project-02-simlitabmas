<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Reviewer') }}
        </h2>
    </x-slot>


    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 m-8 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">{{ __('Nama') }}</label>
                    <div class="mt-1 text-gray-900 dark:text-gray-200">{{ $reviewer->name }}</div>
                </div>
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">{{ __('Email') }}</label>
                    <div class="mt-1 text-gray-900 dark:text-gray-200">{{ $reviewer->email }}</div>
                </div>
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">{{ __('Status Reviewer') }}</label>
                    <div class="mt-1 text-gray-900 dark:text-gray-200">
                        {{ $reviewer->reviewerStatus ? ucfirst($reviewer->reviewerStatus->status) : 'N/A' }}
                    </div>
                </div>
                <!-- Tambahkan informasi lain jika diperlukan -->

                <div class="flex items-center justify-end mt-4">
                    <a href="{{ route('reviewer_management.index') }}" class="text-gray-600 hover:text-gray-900">
                        <x-secondary-button>
                            {{ __('Kembali') }}
                        </x-secondary-button>    
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
