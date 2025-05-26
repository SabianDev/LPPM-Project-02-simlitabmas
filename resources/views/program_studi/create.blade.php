<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Program Studi') }}
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

        <form method="POST" action="{{ route('program_studi.store') }}">
            @csrf
            <div class="mb-4">
                <label for="namaProdi" class="block font-medium text-sm text-gray-700">
                    {{ __('Nama Program Studi') }}
                </label>
                <input type="text" name="namaProdi" id="namaProdi" value="{{ old('namaProdi') }}" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-secondary-button>
                    <a href="{{ route('program_studi.index') }}">
                        {{ __('Batal') }}
                    </a>
                </x-secondary-button>
                
                <x-primary-button type="submit" class="ml-2">
                    {{ __('Simpan') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
