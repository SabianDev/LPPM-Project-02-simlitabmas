<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Status Pengajuan Proposal') }}
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
                <!-- Form Search -->
                <form method="GET" action="{{ route('status_pengajuan_proposal.index') }}" class="mb-4">
                    <div class="flex items-center space-x-2 gap-2">
                        <input type="text" name="search" placeholder="Masukkan kata kunci..." value="{{ request('search') }}"
                            class="border border-gray-300 rounded-md shadow-sm p-2">

                        <select name="filter" class="border border-gray-300 rounded-md shadow-sm p-2" style="min-width: 180px">
                            <option value="judul" {{ request('filter') == 'judul' ? 'selected' : '' }}>Judul Proposal</option>
                            <option value="status" {{ request('filter') == 'status' ? 'selected' : '' }}>Status</option>
                            <option value="tanggal" {{ request('filter') == 'tanggal' ? 'selected' : '' }}>Tanggal Upload</option>
                        </select>

                        <x-primary-button type="submit">
                            Cari
                        </x-primary-button>
                        <a href="{{ route('status_pengajuan_proposal.index') }}">
                            <x-secondary-button>
                            Reset
                            </x-secondary-button>
                        </a>
                        <span style="font-size: 0.8rem;" class="text-gray-600 dark:text-gray-400"><i>*Format pencarian tanggal : YYYY-MM-DD</i></span>
                    </div>
                </form>


                <!-- Tabel Data Proposal -->
                <div class=" overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Proposal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl. Upload</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($proposals as $index => $proposal)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $proposals->firstItem() + $index }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $proposal->judul_penelitian }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($proposal->status) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $proposal->created_at->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('status_pengajuan_proposal.show', $proposal->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                            <b>View</b>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center">Tidak ada data proposal.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Pagination Links -->
                <div class="mt-4">
                    {{ $proposals->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
