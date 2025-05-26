<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Penelitian') }}
        </h2>
        @if(session('success'))
            <x-alert>
                {{ session('success') }}
            </x-alert>
        @endif
    </x-slot>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 m-8 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg overflow-x-auto">
                <!-- Tombol Buat Penelitian Baru -->
                <div class="flex justify-between items-center mb-4">

                    <!-- Search Form di sebelah kiri -->
                    <div class="flex-1">
                        <form method="GET" action="{{ route('penelitian.index') }}">
                            <div class="flex items-center space-x-2 gap-2">
                                <input type="text" name="search" placeholder="Masukkan Kata Kunci..." value="{{ request('search') }}" style="min-width: 240px;""
                                    class="border border-gray-300 rounded-md shadow-sm p-2 w-full">

                                <select name="filter" class="border border-gray-300 rounded-md shadow-sm p-2" style="min-width: 180px;">
                                    <option value="judul" {{ request('filter') == 'judul' ? 'selected' : '' }}>Judul Penelitian</option>
                                    <option value="status" {{ request('filter') == 'status' ? 'selected' : '' }}>Status</option>
                                </select>

                                <x-primary-button type="submit">
                                    Cari
                                </x-primary-button>

                                <a href="{{ route('penelitian.index') }}">
                                    <x-secondary-button type="button">
                                        Reset
                                    </x-secondary-button>
                                </a>
                            </div>
                        </form>
                    </div>


                    <!-- Tombol "Buat Penelitian Baru" di sebelah kanan -->
                    <div class="ml-4">
                        <x-primary-button>
                            <a href="{{ route('penelitian.create') }}">
                                {{ __('Buat Penelitian Baru') }}
                            </a>
                        </x-primary-button>
                    </div>
                </div>

                <!-- Tabel Data Penelitian -->
                <table class="min-w-full divide-y divide-gray-200 mt-4">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Penelitian</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-100 divide-y divide-gray-200">
                        @forelse($penelitians as $index => $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $penelitians->firstItem() + $index }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->title }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($item->status) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('penelitian.show', $item->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                        <b>Detail</b>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center">Tidak ada data penelitian.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination Links -->
                <div class="mt-4">
                    {{ $penelitians->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
