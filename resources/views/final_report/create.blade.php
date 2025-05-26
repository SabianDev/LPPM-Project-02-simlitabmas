<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Upload Final Report') }}
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

                <form method="POST" action="{{ route('final_report.store', $penelitian->id) }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Final Article / Publication -->
                    <div class="mb-4">
                        <label for="final_article" class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                            {{ __('Final Article / Publication') }}
                        </label>
                        <input type="file" name="final_article" id="final_article" required class="mt-1 block w-full">
                    </div>

                    <!-- Final Report / Laporan -->
                    <div class="mb-4">
                        <label for="final_report" class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                            {{ __('Final Report / Laporan') }}
                        </label>
                        <input type="file" name="final_report" id="final_report" required class="mt-1 block w-full">
                    </div>

                    <!-- Final Budget / Anggaran -->
                    <div class="mb-4">
                        <label for="final_budget" class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                            {{ __('Final Budget / Anggaran') }}
                        </label>
                        <input type="file" name="final_budget" id="final_budget" required class="mt-1 block w-full">
                    </div>

                    <!-- Tombol aksi -->
                    <div class="flex items-center justify-end mt-4 space-x-4">
                        <a href="{{ route('penelitian.show', $penelitian->id) }}" class="text-gray-600 hover:text-gray-900">
                            <x-secondary-button>    
                                {{ __('Kembali') }}
                            </x-secondary-button>
                        </a>
                        <x-primary-button type="submit">
                            {{ __('Kirim Final Report') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
