<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Progress Penelitian') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 m-8 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <form method="POST" action="{{ route('progress.store', $penelitian->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="description" class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                            {{ __('Keterangan Progress') }}
                        </label>
                        <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="file_progress" class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                            {{ __('Upload Dokumen Progress') }}
                        </label>
                        <input type="file" id="file_progress" name="file_progress" required class="mt-1 block w-full">
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('penelitian.show', $penelitian->id) }}" class="text-gray-600 hover:text-gray-900 mr-4">
                            <x-secondary-button>
                                {{ __('Batal') }}
                            </x-secondary-button>  
                        </a>
                        <x-primary-button type="submit " class=" ml-4">
                            {{ __('Kirim Progress') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
