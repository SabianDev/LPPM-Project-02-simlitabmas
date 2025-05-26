<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Informasi Pengguna/Dosen') }}
        </h2>
        @if(session('success'))
            <x-alert>
                {{ session('success') }}
            </x-alert>
        @endif
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 m-8 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <form action="{{ route('informasi_user.simpan') }}" method="POST">
                    @csrf

                    <!-- NIDN -->
                    <div class="mb-4">
                        <label for="nidn" class="block font-medium text-sm text-gray-700 dark:text-gray-400">NIDN</label>
                        <input type="text" name="nidn" id="nidn" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('nidn', $informasi->nidn ?? '') }}">
                    </div>

                    <!-- Nama -->
                    <div class="mb-4">
                        <label for="nama" class="block font-medium text-sm text-gray-700 dark:text-gray-400">Nama Lengkap <i>*dengan gelar (jika ada)</i></label>
                        <input type="text" name="nama" id="nama" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('nama', $informasi->nama ?? '') }}">
                    </div>

                    <!-- Program Studi -->
                    <div class="mb-4">
                        <label for="prodi" class="block font-medium text-sm text-gray-700 dark:text-gray-400">Program Studi</label>
                        <select name="prodi" id="prodi" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @foreach($programStudi as $prodi)
                                <option value="{{ $prodi->namaProdi }}" {{ (old('prodi', $informasi->prodi ?? '') == $prodi->namaProdi) ? 'selected' : '' }}>
                                    {{ $prodi->namaProdi }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <!-- Jenjang Pendidikan -->
                    <div class="mb-4">
                        <label for="jenjang_pendidikan" class="block font-medium text-sm text-gray-700 dark:text-gray-400">Jenjang Pendidikan</label>
                        <select name="jenjang_pendidikan" id="jenjang_pendidikan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @foreach(['SD', 'SMP', 'SMA', 'SMK', 'Diploma (D3/D4)', 'Sarjana (S1)', 'Magister (S2)', 'Doktor (S3)', 'Lainnya'] as $jenjang)
                                <option value="{{ $jenjang }}" {{ (old('jenjang_pendidikan', $informasi->jenjang_pendidikan ?? '') == $jenjang) ? 'selected' : '' }}>
                                    {{ $jenjang }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Jabatan Akademik -->
                    <div class="mb-4">
                        <label for="jabatan_akademik" class="block font-medium text-sm text-gray-700 dark:text-gray-400">Jabatan Akademik</label>
                        <input type="text" name="jabatan_akademik" id="jabatan_akademik" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('jabatan_akademik', $informasi->jabatan_akademik ?? '') }}">
                    </div>

                    <!-- Bidang Ilmu -->
                    <div class="mb-4">
                        <label for="bidang_ilmu" class="block font-medium text-sm text-gray-700 dark:text-gray-400">Bidang Ilmu</label>
                        <input type="text" name="bidang_ilmu" id="bidang_ilmu" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('bidang_ilmu', $informasi->bidang_ilmu ?? '') }}">
                    </div>

                    <!-- Sinta Score -->
                    <div class="mb-4">
                        <label for="sinta_score_overall" class="block font-medium text-sm text-gray-700 dark:text-gray-400">Sinta Score Overall</label>
                        <input type="number" step="0.01" name="sinta_score_overall" id="sinta_score_overall" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('sinta_score_overall', $informasi->sinta_score_overall ?? '') }}">
                    </div>

                    <div class="mb-4">
                        <label for="sinta_score_3_years" class="block font-medium text-sm text-gray-700 dark:text-gray-400">Sinta Score (3 Years)</label>
                        <input type="number" step="0.01" name="sinta_score_3_years" id="sinta_score_3_years" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('sinta_score_3_years', $informasi->sinta_score_3_years ?? '') }}">
                    </div>

                    <!-- Alamat -->
                    <div class="mb-4">
                        <label for="alamat" class="block font-medium text-sm text-gray-700 dark:text-gray-400">Alamat</label>
                        <textarea name="alamat" id="alamat" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('alamat', $informasi->alamat ?? '') }}</textarea>
                    </div>

                    <!-- TTL -->
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">Tanggal Lahir</label>
                        <div class="flex gap-2">
                            <input type="number" name="ttl_day" placeholder="Hari" class="mt-1 block border-gray-300 rounded-md shadow-sm w-1/3" value="{{ old('ttl_day', $ttl['day'] ?? '') }}">
                            <select name="ttl_month" class="mt-1 block border-gray-300 rounded-md shadow-sm w-1/3">
                                @foreach(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $bulan)
                                    <option value="{{ $bulan }}" {{ (old('ttl_month', $ttl['month'] ?? '') == $bulan) ? 'selected' : '' }}>{{ $bulan }}</option>
                                @endforeach
                            </select>
                            <input type="number" name="ttl_year" placeholder="Tahun" class="mt-1 block border-gray-300 rounded-md shadow-sm w-1/3" value="{{ old('ttl_year', $ttl['year'] ?? '') }}">
                        </div>
                    </div>

                    <!-- No KTP -->
                    <div class="mb-4">
                        <label for="no_ktp" class="block font-medium text-sm text-gray-700 dark:text-gray-400">No KTP</label>
                        <input type="text" name="no_ktp" id="no_ktp" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('no_ktp', $informasi->no_ktp ?? '') }}">
                    </div>

                    <!-- No HP -->
                    <div class="mb-4">
                        <label for="no_hp" class="block font-medium text-sm text-gray-700 dark:text-gray-400">No HP</label>
                        <input type="text" name="no_hp" id="no_hp" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('no_hp', $informasi->no_hp ?? '') }}">
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block font-medium text-sm text-gray-700 dark:text-gray-400">Email</label>
                        <input type="email" name="email" id="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('email', $informasi->email ?? '') }}">
                    </div>

                    <!-- Web Personal -->
                    <div class="mb-4">
                        <label for="web_personal" class="block font-medium text-sm text-gray-700 dark:text-gray-400">Web Personal (Opsional)</label>
                        <input type="text" name="web_personal" id="web_personal" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('web_personal', $informasi->web_personal ?? '') }}">
                    </div>

                    <div class="mt-6">
                        <x-primary-button type="submit">
                            Update Info
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
