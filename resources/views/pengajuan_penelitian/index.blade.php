<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Pengajuan Penelitian dan Pengabdian') }}
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

                <!-- FILTER -->
                <form action="{{ route('pengajuan_penelitian.index') }}" method="GET" class="mb-4">
                    <div class="flex items-center space-x-2 gap-2">

                        {{-- Input Pencarian --}}
                        <input type="text" name="search" placeholder="Kata kunci..." value="{{ request('search') }}"
                            class="border border-gray-300 rounded-md shadow-sm p-2">

                        {{-- Dropdown Filter --}}
                        <select name="filter_by" style="min-width: 180px;" class="border border-gray-300 rounded-md shadow-sm p-2">
                            <option value="nama_lengkap" {{ request('filter_by') == 'nama_lengkap' ? 'selected' : '' }}>Nama Lengkap</option>
                            <option value="judul_penelitian" {{ request('filter_by') == 'judul_penelitian' ? 'selected' : '' }}>Judul Proposal</option>
                            <option value="prodi" {{ request('filter_by') == 'prodi' ? 'selected' : '' }}>Program Studi</option>
                            <option value="status" {{ request('filter_by') == 'status' ? 'selected' : '' }}>Status</option>
                            <option value="created_at" {{ request('filter_by') == 'created_at' ? 'selected' : '' }}>Tanggal Upload</option>
                        </select>

                        {{-- Tombol --}}
                        <x-primary-button type="submit" class="ml-4">
                            Cari
                        </x-primary-button>  
                        
                        <a href="{{ route('pengajuan_penelitian.index') }}">
                            <x-secondary-button type="button">
                                Reset
                            </x-secondary-button>
                        </a>
                        <span style="font-size: 0.8rem;" class="text-gray-600 dark:text-gray-400"><i>*Format pencarian tanggal : YYYY-MM-DD</i></span>
                    </div>
                </form>


                <!-- Table -->
                <div class="overflow-x-auto overflow-y-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Proposal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Lengkap</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Program Studi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl. Upload</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($pengajuan as $index => $proposal)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $pengajuan->firstItem() + $index }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $proposal->judul_penelitian }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $proposal->nama_lengkap }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $proposal->prodi }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($proposal->status) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $proposal->created_at->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('pengajuan_penelitian.show', $proposal->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                            <b>View</b>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Links -->
                <div class="mt-4">
                    {{ $pengajuan->links() }}
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
