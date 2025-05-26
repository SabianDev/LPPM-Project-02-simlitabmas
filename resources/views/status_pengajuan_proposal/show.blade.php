<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Proposal') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 m-8 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <!-- Contoh menampilkan beberapa data proposal -->
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                        {{ __('Proposal ID') }}
                    </label>
                    <div class="mt-1 text-gray-900 dark:text-gray-200">
                        {{ $proposal->id }}
                    </div>
                </div>

                <!-- Tampilkan kolom lain sesuai kebutuhan -->
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                        {{ __('Judul Penelitian') }}
                    </label>
                    <div class="mt-1 text-gray-900 dark:text-gray-200">
                        {{ $proposal->judul_penelitian }}
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                        {{ __('Status') }}
                    </label>
                    <div class="mt-1 text-gray-900 dark:text-gray-200">
                        {{ $proposal->status }}
                    </div>
                </div>
                <div class="mb-4">
                    <h4 class="block font-medium text-sm text-gray-700 dark:text-gray-400">Komentar Reviewer</h4>
                    @if($proposal->komentar_review && trim($proposal->komentar_review) !== '')
                        <p class="text-gray-900 dark:text-gray-200">{{ $proposal->komentar_review }}</p>
                    @else
                        <p class="mt-1 text-gray-700 dark:text-gray-300"><i>Tidak ada komentar...</i></p>
                    @endif
                </div>
                
                <!-- Anggota Dosen -->
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                        {{ __('Anggota Dosen') }}
                    </label>
                    <div class="mt-1 text-gray-900 dark:text-gray-200">
                        @if ($proposal->anggota->isEmpty())
                            <div>Tidak ada anggota dosen.</div>
                        @else
                            <ul style="list-style-type: disc; margin-left: 20px;">
                                @foreach ($proposal->anggota as $anggota)
                                    <li>
                                        ID: {{ $anggota->user->id }} - {{ $anggota->user->name }} <i>({{ $anggota->user->email }})</i>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                <!-- Anggota Mahasiswa -->
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                        {{ __('Anggota Mahasiswa') }}
                    </label>
                    <div class="mt-1 text-gray-900 dark:text-gray-200">
                        @if ($proposal->anggotaMahasiswa->isEmpty())
                            <div><i>Tidak ada anggota mahasiswa terdaftar.</i></div>
                        @else
                            <ul style="list-style-type: disc; margin-left: 20px;">
                                @foreach ($proposal->anggotaMahasiswa as $mahasiswa)
                                    <li>{{ $mahasiswa->npm_nama_mahasiswa }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>




                <!-- Tombol untuk melihat dokumen (misal file proposal) -->
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                        {{ __('File Proposal') }}
                    </label>
                    <div class="mt-1">
                        <a href="{{ asset('storage/' . $proposal->file_proposal) }}" target="_blank" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            <x-primary-button>
                                {{ __('Lihat Dokumen...') }}
                            </x-primary-button>    
                        </a>
                    </div>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a href="{{ route('status_pengajuan_proposal.index') }}" class="text-gray-600 hover:text-gray-900">
                        <x-secondary-button>
                            {{ __('Kembali') }}
                        </x-secondary-button>    
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
