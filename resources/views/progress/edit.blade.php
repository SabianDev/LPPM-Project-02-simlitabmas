<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Progress Penelitian') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 m-8 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                @if($errors->any())
                    <div class="mb-4">
                        <ul class="text-red-600">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('progress.update', $progress->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Edit Deskripsi Progress -->
                    <div class="mb-4">
                        <label for="description" class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                            {{ __('Deskripsi Progress') }}
                        </label>
                        <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>{{ old('description', $progress->description) }}</textarea>
                    </div>

                    <!-- Edit File Progress (opsional, jika ingin mengganti file) -->
                    <div class="mb-4">
                        <label for="file_progress" class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                            {{ __('Upload Dokumen Progress (Opsional, Tidak perlu upload lagi jika tidak ada perubahan.)') }}
                        </label>
                        <input type="file" id="file_progress" name="file_progress" class="mt-1 block w-full">
                    </div>

                    <!-- Tombol aksi -->
                    <div class="flex items-center justify-end mt-4 space-x-4">
                        
                        <a href="{{ route('progress.index', $progress->penelitian_id) }}">
                            <x-secondary-button>
                                {{ __('Batal') }}
                            </x-secondary-button>  
                        </a>
                        
                        
                        <x-primary-button type="submit">
                            {{ __('Perbarui Progress') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
