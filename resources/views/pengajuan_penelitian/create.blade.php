<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pengajuan Penelitian dan Pengabdian Internal') }}
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
                <form method="POST" action="{{ route('pengajuan_penelitian.store') }}" enctype="multipart/form-data">
                    @csrf
                    <!-- Tahun Penelitian -->
                    <div class="mb-4">
                        <label for="tahun_penelitian" class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                            1. Tahun Penelitian
                        </label>
                        <input type="number" name="tahun_penelitian" id="tahun_penelitian" value="{{ old('tahun_penelitian', date('Y')) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <!-- Judul Penelitian -->
                    <div class="mb-4">
                        <label for="judul_penelitian" class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                            2. Judul Penelitian
                        </label>
                        <input type="text" name="judul_penelitian" id="judul_penelitian" value="{{ old('judul_penelitian') }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    
                    <!-- NIDN Ketua Pengusul -->
                    <div class="mb-4">
                        <label for="nidn_ketua" class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                            3. NIDN Ketua Pengusul
                        </label>
                        <input type="text" name="nidn_ketua" id="nidn_ketua" value="{{ old('nidn_ketua') }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <!-- Pangkat/Jabatan Fungsional/Golongan -->
                    <div class="mb-4">
                        <label for="jabatan" class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                            4. Pangkat/Jabatan Fungsional/Golongan
                        </label>
                        <input type="text" name="jabatan" id="jabatan" value="{{ old('jabatan') }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <!-- Nama Lengkap dan Gelar -->
                    <div class="mb-4">
                        <label for="nama_lengkap" class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                            5. Nama Lengkap dan Gelar
                        </label>
                        <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap') }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <!-- Program Studi -->
                    <div class="mb-4">
                        <label for="prodi" class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                            6. Program Studi
                        </label>
                        <select name="prodi" id="prodi" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">-- Pilih Program Studi --</option>
                            @foreach($program_studi as $prodi)
                                <option value="{{ $prodi->namaProdi }}" {{ old('prodi') == $prodi->namaProdi ? 'selected' : '' }}>
                                    {{ $prodi->namaProdi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                            7. Email
                        </label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <!-- No. WhatsApp -->
                    <div class="mb-4">
                        <label for="no_wa" class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                            8. No. WhatsApp
                        </label>
                        <input type="text" name="no_wa" id="no_wa" value="{{ old('no_wa') }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <!-- Skema Usulan -->
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                            9. Skema Usulan
                        </label>
                        <div class="mt-1">
                            <label class="inline-flex items-center">
                                <input type="radio" name="skema_usulan" value="Penelitian Dasar" {{ old('skema_usulan') == 'Penelitian Dasar' ? 'checked' : '' }} required class="form-radio">
                                <span class="ml-2 text-gray-900 dark:text-gray-200">Penelitian Dasar</span>
                            </label>
                            <label class="inline-flex items-center ml-4">
                                <input type="radio" name="skema_usulan" value="Penelitian Kompetitif" {{ old('skema_usulan') == 'Penelitian Kompetitif' ? 'checked' : '' }} required class="form-radio">
                                <span class="ml-2 text-gray-900 dark:text-gray-200">Penelitian Kompetitif</span>
                            </label>
                            <label class="inline-flex items-center ml-4">
                                <input type="radio" name="skema_usulan" value="PKM (Pemberdayaan Dasar)" {{ old('skema_usulan') == 'PKM (Pemberdayaan Dasar)' ? 'checked' : '' }} required class="form-radio">
                                <span class="ml-2 text-gray-900 dark:text-gray-200">PKM (Pemberdayaan Dasar)</span>
                            </label>
                            <label class="inline-flex items-center ml-4">
                                <input type="radio" name="skema_usulan" value="Subsidi" {{ old('skema_usulan') == 'Subsidi' ? 'checked' : '' }} required class="form-radio">
                                <span class="ml-2 text-gray-900 dark:text-gray-200">Subsidi</span>
                            </label>
                        </div>
                    </div>

                    <!-- Pilih Anggota Tim Peneliti -->
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-400 mb-2">
                            10. Pilih Anggota Tim Peneliti (Termasuk Ketua Pelaksana)
                        </label>
                        <div class="flex space-x-4">
                            <!-- List kiri: Daftar Pengguna + Search Bar -->
                            <div style="width: 250px;">
                                <label class="text-sm text-gray-600 dark:text-gray-300 block">Daftar Pengguna</label>
                                <select id="availableUsers" multiple
                                        style="width: 250px; height: 200px; overflow: auto; display: block; border: 1px solid #ccc; border-radius: 4px; padding: 4px;">
                                    @foreach($eligibleUsers as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                        <hr>
                                    @endforeach
                                </select>
                                <!-- Search Bar di bawah list kiri -->
                                <input type="text" id="userSearch" placeholder="Cari berdasarkan nama" 
                                    style="width: 250px; margin-top: 8px; padding: 4px; border: 1px solid #ccc; border-radius: 4px;">
                            </div>

                            <!-- Tombol panah -->
                            <div class="flex flex-col justify-center items-center space-y-2">
                                <button type="button" id="addUser" style="padding: 4px 8px; background-color: #3B82F6; color: white; border: none; border-radius: 4px;">&rarr;</button>
                                <button type="button" id="removeUser" style="padding: 4px 8px; background-color: #EF4444; color: white; border: none; border-radius: 4px;">&larr;</button>
                            </div>

                            <!-- List kanan: Anggota Terpilih -->
                            <div style="width: 250px;">
                                <label class="text-sm text-gray-600 dark:text-gray-300 block">Anggota Terpilih</label>
                                <select id="selectedUsers" name="anggota_tim[]" multiple
                                        style="width: 250px; height: 200px; overflow: auto; display: block; border: 1px solid #ccc; border-radius: 4px; padding: 4px;">
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Hidden Input (Opsional) untuk mengumpulkan data anggota terpilih sebagai string -->
                    <input type="hidden" id="anggota" name="anggota" value="">

                    <!-- Pilih Anggota Tim Mahasiswa : -->
                    <div class="mb-4" style="margin-top: 2rem;">
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                            11. Data Mahasiswa (format: NPM - Nama Lengkap) <i>*Kosongkan jika tak ada</i>
                        </label>
                        <div style="display: flex; gap: 0.5rem; margin-bottom: 1rem;">
                            <input type="text" id="mahasiswaInput" placeholder="Contoh: 12345678 - Budi Santoso"
                                style="flex: 1; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem;">
                            <button type="button" onclick="tambahMahasiswa()"
                                style="padding: 0.5rem 1rem; background-color: #2563eb; color: white; border: none; border-radius: 0.375rem;">
                                Tambah
                            </button>
                        </div>

                        {{-- Daftar Mahasiswa --}}
                        <div>
                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                                List Daftar Anggota Mahasiswa :
                            </label>
                            <select id="daftarMahasiswa" name="anggota_mahasiswa[]" multiple size="5"
                                style="width: 100%; border: 1px solid #d1d5db; padding: 0.5rem; border-radius: 0.375rem; overflow: auto;">
                            </select>
                            <button type="button" onclick="hapusMahasiswa()"
                                style="margin-top: 0.5rem; padding: 0.5rem 1rem; background-color: #ef4444; color: white; border: none; border-radius: 0.375rem;">
                                Hapus
                            </button>
                            <span class="ml-2 font-medium text-sm text-gray-700 dark:text-gray-400"><i>(Pilih file yang ingin dihapus, kemudian klik button hapus.)</i></span>
                        </div>
                    </div>

                    <!-- Submit Proposal -->
                    <div class="mb-4">
                        <label for="file_proposal" class="block font-medium text-sm text-gray-700 dark:text-gray-400">
                            12. Submit Proposal (max 1MB)
                        </label>
                        <p class="block font-small text-sm text-gray-900 dark:text-gray-200"><i>Silahkan submit proposal tanpa tanda tangan Kepala LPPM, tanda tangan akan dibubuhkan setelah proposal anda diterima dan dilakukan revisi proposal berdasar hasil review administrasi dan substansi.</i></p>
                        <input type="file" name="file_proposal" id="file_proposal" required class="mt-1 block w-full">
                        
                    </div>

                    <!-- Tombol Submit -->
                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button type="submit">
                            {{ __('Kirim Pengajuan') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script Tambah Dosen -->
    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const addButton = document.getElementById('addUser');
        const removeButton = document.getElementById('removeUser');
        const availableSelect = document.getElementById('availableUsers');
        const selectedSelect = document.getElementById('selectedUsers');
        const searchInput = document.getElementById('userSearch');
        const anggotaInput = document.getElementById('anggota');

        // Update input hidden jika diperlukan
        function updateHiddenInput() {
            const selected = Array.from(selectedSelect.options).map(option => option.value);
            anggotaInput.value = selected.join(',');
        }

        // Fungsi pindahkan opsi dari satu select ke select lain
        function moveOptions(fromSelect, toSelect) {
            Array.from(fromSelect.selectedOptions).forEach(option => {
                fromSelect.removeChild(option);
                toSelect.appendChild(option);
            });
            updateHiddenInput();
        }

        addButton.addEventListener('click', function () {
            moveOptions(availableSelect, selectedSelect);
        });


        removeButton.addEventListener('click', function () {
            moveOptions(selectedSelect, availableSelect);
        });

        // Event listener untuk filter opsi di list kiri berdasarkan input search
        searchInput.addEventListener('input', function () {
            const filter = this.value.toLowerCase();
            Array.from(availableSelect.options).forEach(option => {
                // Jika teks opsi mengandung nilai filter, tampilkan; jika tidak, sembunyikan
                if (option.text.toLowerCase().includes(filter)) {
                    option.style.display = '';
                } else {
                    option.style.display = 'none';
                }
            });
        });
    });
    </script>
    @endpush

    <!-- Script Tambah Mahasiswa -->
    <script>
        function tambahMahasiswa() {
            const input = document.getElementById('mahasiswaInput');
            const value = input.value.trim();
            const select = document.getElementById('daftarMahasiswa');

            if (!value || !value.includes('-')) {
                alert('Mohon masukkan data dengan format: NPM - Nama Lengkap');
                return;
            }

            const option = document.createElement('option');
            option.value = value;
            option.text = value;
            option.selected = true;      // ← Tandai sebagai terpilih

            select.appendChild(option);
            input.value = '';
        }
        function hapusMahasiswa() {
            const select = document.getElementById('daftarMahasiswa');
            const selected = Array.from(select.selectedOptions);

            if (selected.length === 0) {
                alert('Pilih terlebih dahulu mahasiswa yang ingin dihapus.');
                return;
            }

            selected.forEach(option => option.remove());
        }
    </script>

</x-app-layout>
