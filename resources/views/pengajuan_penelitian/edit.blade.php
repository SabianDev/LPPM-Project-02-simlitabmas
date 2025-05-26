<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Progress Penelitian') }}
        </h2>
    </x-slot>

    <div class="p-4 m-8 sm:p-8 bg-white shadow sm:rounded-lg">
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

            <!-- Field untuk keterangan progress -->
            <div class="mb-4">
                <label for="description" class="block font-medium text-sm text-gray-700">
                    {{ __('Keterangan Progress') }}
                </label>
                <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>{{ old('description', $progress->description) }}</textarea>
            </div>

            <!-- Field untuk upload file progress (opsional, jika ingin mengubah file) -->
            <div class="mb-4">
                <label for="file_progress" class="block font-medium text-sm text-gray-700">
                    {{ __('Upload Dokumen Progress (Opsional)') }}
                </label>
                <input type="file" id="file_progress" name="file_progress" class="mt-1 block w-full">
            </div>

            <!-- Tombol aksi -->
            <div class="flex items-center justify-end mt-4 space-x-4">
                <a href="{{ route('progress.index', $progress->penelitian_id) }}" class="text-gray-600 hover:text-gray-900">
                    {{ __('Batal') }}
                </a>
                <x-primary-button type="submit">
                    {{ __('Perbarui Progress') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
