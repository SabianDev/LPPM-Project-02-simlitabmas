<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mulai Penelitian Baru') }}
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

                <form method="POST" action="{{ route('penelitian.store') }}">
                    @csrf

                    <!-- Text Field: Judul Penelitian (input manual) -->
                    <div class="mb-4">
                        <label for="title" class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                            {{ __('Judul Penelitian') }}
                        </label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <!-- Dropdown: Proposal yang sudah di‑approve -->
                    <div class="mb-4">
                        <label for="proposal_id" class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                            {{ __('Pilih Proposal (ID - Judul Proposal)') }}
                        </label>
                        <select name="proposal_id" id="proposal_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">-- Pilih Proposal --</option>
                            @foreach($approvedProposals as $proposal)
                                @php
                                    // Cek apakah judul valid
                                    $judulValid = trim($proposal->judul_penelitian) !== '';

                                    if ($judulValid) {
                                        $displayTitle = $proposal->judul_penelitian;
                                    } else {
                                        // Ambil nama file sebagai fallback
                                        $fullName = basename($proposal->file_proposal);
                                        if (preg_match('/^\d+_[^_]+_(.+)\.pdf$/i', $fullName, $matches)) {
                                            $displayTitle = $matches[1];
                                        } else {
                                            $displayTitle = pathinfo($fullName, PATHINFO_FILENAME);
                                        }
                                    }
                                @endphp
                                <option value="{{ $proposal->id }}">
                                    {{ $proposal->id }} - {{ $displayTitle }}
                                </option>
                            @endforeach
                        </select>

                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex items-center justify-end mt-4 space-x-4">
                        <a href="{{ route('penelitian.index') }}" class="text-gray-600 hover:text-gray-900">
                            <x-secondary-button>
                                {{ __('Batal') }}
                            </x-secondary-button>    
                        
                        </a>
                        <x-primary-button type="submit">
                            {{ __('Start Penelitian') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
