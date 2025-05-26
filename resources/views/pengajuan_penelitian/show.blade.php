<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Pengajuan Penelitian') }}
        </h2>
        @if(session('success'))
            <x-alert>
                {{ session('success') }}
            </x-alert>
        @endif
        @if(session('error'))
            <x-alert>
                {{ session('error') }}
            </x-alert>
        @endif
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 m-8 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">


                <!-- -2. Judul Penelitian -->
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                        {{ __('Judul Penelitian') }}
                    </label>
                    <div class="mt-1 text-gray-900 dark:text-gray-200">
                        {{ $pengajuan->judul_penelitian }}
                    </div>
                </div>

                
                <!-- -1. Judul Penelitian -->
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                        {{ __('Tahun Penelitian') }}
                    </label>
                    <div class="mt-1 text-gray-900 dark:text-gray-200">
                        {{ $pengajuan->tahun_penelitian }}
                    </div>
                </div>

                <!-- 0. Tgl. Upload -->
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                        {{ __('Tanggal Upload Pengajuan') }}
                    </label>
                    <div class="mt-1 text-gray-900 dark:text-gray-200">
                        {{ $pengajuan->created_at }}
                    </div>
                </div>

                <!-- 1. NIDN Ketua Pengusul -->
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                        {{ __('NIDN Ketua Pengusul') }}
                    </label>
                    <div class="mt-1 text-gray-900 dark:text-gray-200">
                        {{ $pengajuan->nidn_ketua }}
                    </div>
                </div>

                <!-- 2. Pangkat/Jabatan Fungsional/Golongan -->
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                        {{ __('Pangkat/Jabatan Fungsional/Golongan') }}
                    </label>
                    <div class="mt-1 text-gray-900 dark:text-gray-200">
                        {{ $pengajuan->jabatan }}
                    </div>
                </div>

                <!-- 3. Nama Lengkap dan Gelar -->
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                        {{ __('Nama Lengkap Ketua Pengusul dan Gelar') }}
                    </label>
                    <div class="mt-1 text-gray-900 dark:text-gray-200">
                        {{ $pengajuan->nama_lengkap }}
                    </div>
                </div>

                <!-- 4. Program Studi -->
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                        {{ __('Program Studi') }}
                    </label>
                    <div class="mt-1 text-gray-900 dark:text-gray-200">
                        {{ $pengajuan->prodi }}
                    </div>
                </div>

                <!-- 5. Email -->
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                        {{ __('Email') }}
                    </label>
                    <div class="mt-1 text-gray-900 dark:text-gray-200">
                        {{ $pengajuan->email }}
                    </div>
                </div>

                <!-- 6. No. WhatsApp -->
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                        {{ __('No. WhatsApp') }}
                    </label>
                    <div class="mt-1 text-gray-900 dark:text-gray-200">
                        {{ $pengajuan->no_wa }}
                    </div>
                </div>

                <!-- 7. Skema Usulan -->
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                        {{ __('Skema Usulan') }}
                    </label>
                    <div class="mt-1 text-gray-900 dark:text-gray-200">
                        {{ $pengajuan->skema_usulan }}
                    </div>
                </div>

                <!-- 9. Status -->
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                        {{ __('Status') }}
                    </label>
                    <div class="mt-1 text-gray-900 dark:text-gray-200">
                        {{ $pengajuan->status }}
                    </div>
                </div>

                <!-- Anggota Penelitian -->
                <div class="mb-4">  
                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                        {{ __('Anggota') }}
                    </label>
                    <div class="mt-1 text-gray-900 dark:text-gray-200">
                        @if ($pengajuan->anggota->isEmpty())
                            <span><i>Tidak ada anggota dosen terdaftar.</i></span>
                        @else
                            <ul style="padding-left: 1.25rem; list-style-type: disc;">
                                @foreach ($pengajuan->anggota as $anggota)
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
                        @if($pengajuan->anggotaMahasiswa->isEmpty())
                            <i>{{ __('Tidak ada anggota mahasiswa terdaftar.') }}</i>
                        @else
                            <ul class="list-disc list-inside">
                                @foreach($pengajuan->anggotaMahasiswa as $mahasiswa)
                                    <li>{{ $mahasiswa->npm_nama_mahasiswa }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                <!-- 10. File Proposal (tombol untuk membuka dokumen) -->
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                        {{ __('File Proposal') }}
                    </label>
                    <div class="mt-1">
                        <x-primary-button>
                            <a href="{{ asset('storage/' . $pengajuan->file_proposal) }}" target="_blank">
                                {{ __('Lihat Dokumen...') }}
                            </a>
                        </x-primary-button>
                    </div>
                </div>

                <!-- Tombol Kembali -->
                <div class="flex items-center justify-end mt-4">
                    <x-secondary-button>
                        <a href="{{ route('pengajuan_penelitian.index') }}">
                            {{ __('Kembali') }}
                        </a>
                    </x-secondary-button>
                    
                    <x-primary-button class="ml-2">
                        <a href="{{ route('assign_reviewer.create', $pengajuan->id) }}">
                            {{ __('Assign Reviewer...') }}
                        </a>
                    </x-primary-button>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
