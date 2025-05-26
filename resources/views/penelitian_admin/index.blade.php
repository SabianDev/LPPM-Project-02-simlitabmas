<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Penelitian (Admin)') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 m-8 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                
            <!-- Form filter -->
                <form method="GET" action="{{ route('penelitian_admin.index') }}" class="mb-4">
                    <div class="flex items-center space-x-2 gap-2">
                        {{-- Input Pencarian --}}
                        <input type="text" name="search" placeholder="Masukkan kata kunci..." value="{{ request('search') }}"
                            class="border border-gray-300 rounded-md shadow-sm p-2 w-64">
                        
                        {{-- Dropdown Filter --}}
                        <select name="filter" style="min-width: 180px;" class="border border-gray-300 rounded-md shadow-sm p-2 w-52">
                            <option value="title " {{ request('filter') == 'title ' ? 'selected' : '' }}>Judul Penelitian</option>
                            <option value="name" {{ request('filter') == 'name' ? 'selected' : '' }}>Nama</option>
                            <option value="email" {{ request('filter') == 'email' ? 'selected' : '' }}>Email</option>
                            <option value="status" {{ request('filter') == 'status' ? 'selected' : '' }}>Status</option>
                            <option value="created_at" {{ request('filter') == 'created_at' ? 'selected' : '' }}>Tanggal Dibuat</option>
                        </select>

                        {{-- Tombol --}}
                        <x-primary-button type="submit" class="ml-4">
                            Cari
                        </x-primary-button>
                        
                        <x-secondary-button>
                            <a href="{{ route('penelitian_admin.index') }}">
                                Reset
                            </a>
                        </x-secondary-button>
                        <span style="font-size: 0.8rem;" class="text-gray-600 dark:text-gray-400"><i>*Format pencarian tanggal : YYYY-MM-DD</i></span>
                    </div>
                </form>


                <!-- Tabel daftar penelitian -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Penelitian</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama User</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Dibuat</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($penelitians as $index => $penelitian)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $penelitians->firstItem() + $loop->index }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $penelitian->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $penelitian->user_id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $penelitian->user->name ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($penelitian->status) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $penelitian->created_at->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('penelitian_admin.show', $penelitian->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                            <b>View</b>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center">Tidak ada data penelitian.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Pagination Links -->
                <div class="mt-4">
                    {{ $penelitians->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
