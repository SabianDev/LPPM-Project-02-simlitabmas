<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Pengguna Lanjut') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 m-8 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">

                @if ($informasi)
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">NIDN</label>
                        <div class="mt-1 text-gray-900 dark:text-gray-200">{{ $informasi->nidn }}</div>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">Nama</label>
                        <div class="mt-1 text-gray-900 dark:text-gray-200">{{ $informasi->nama }}</div>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">Program Studi</label>
                        <div class="mt-1 text-gray-900 dark:text-gray-200">{{ $informasi->prodi }}</div>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">Jenjang Pendidikan</label>
                        <div class="mt-1 text-gray-900 dark:text-gray-200">{{ $informasi->jenjang_pendidikan }}</div>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">Jabatan Akademik</label>
                        <div class="mt-1 text-gray-900 dark:text-gray-200">{{ $informasi->jabatan_akademik }}</div>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">Bidang Ilmu</label>
                        <div class="mt-1 text-gray-900 dark:text-gray-200">{{ $informasi->bidang_ilmu }}</div>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">SINTA Score (Overall)</label>
                        <div class="mt-1 text-gray-900 dark:text-gray-200">{{ $informasi->sinta_score_overall ?? '-' }}</div>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">SINTA Score (3 Tahun)</label>
                        <div class="mt-1 text-gray-900 dark:text-gray-200">{{ $informasi->sinta_score_3_years ?? '-' }}</div>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">Alamat</label>
                        <div class="mt-1 text-gray-900 dark:text-gray-200">{{ $informasi->alamat ?? '-' }}</div>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">Tempat, Tanggal Lahir</label>
                        <div class="mt-1 text-gray-900 dark:text-gray-200">{{ $informasi->ttl ?? '-' }}</div>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">No. KTP</label>
                        <div class="mt-1 text-gray-900 dark:text-gray-200">{{ $informasi->no_ktp ?? '-' }}</div>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">No. HP</label>
                        <div class="mt-1 text-gray-900 dark:text-gray-200">{{ $informasi->no_hp ?? '-' }}</div>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">Email</label>
                        <div class="mt-1 text-gray-900 dark:text-gray-200">{{ $informasi->email }}</div>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">Web Personal</label>
                        <div class="mt-1 text-gray-900 dark:text-gray-200">
                            @if($informasi->web_personal)
                                <a href="{{ $informasi->web_personal }}" class="text-blue-500 underline" target="_blank">
                                    {{ $informasi->web_personal }}
                                </a>
                            @else
                                -
                            @endif
                        </div>
                    </div>
                @else
                    <div class="text-center text-gray-700 dark:text-gray-300 py-12">
                        <p class="text-lg font-semibold">Belum ada data informasi dari pengguna ini.</p>
                    </div>
                @endif

                <div class="flex justify-end mt-6">
                    <a href="{{ route('users.show', $user->id) }}">
                        <x-secondary-button>
                            {{ __('Kembali') }}
                        </x-secondary-button>
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
