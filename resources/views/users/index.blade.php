<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Pengguna') }}
        </h2>
        @if (session('success'))
            <x-alert>
                {{ session('success') }}
            </x-alert>
        @endif
        @if (session('error'))
            <x-alert type="error">
                {{ session('error') }}
            </x-alert>
        @endif
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="p-4 m-8 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <!-- Search Form -->
                <form method="GET" action="{{ route('users.index') }}" class="mb-4">
                    <div class="flex items-center space-x-2 gap-2">
                        <input type="text" name="search" placeholder="Ketik kata kunci..." value="{{ request('search') }}"
                            class="border border-gray-300 rounded-md shadow-sm p-2">

                        <select name="filter" style="min-width: 180px;" class="border border-gray-300 rounded-md shadow-sm p-2" style="min-width: 170px;">
                            <option value="name" {{ request('filter') == 'name' ? 'selected' : '' }}>Nama</option>
                            <option value="email" {{ request('filter') == 'email' ? 'selected' : '' }}>Email</option>
                            <option value="role" {{ request('filter') == 'role' ? 'selected' : '' }}>Role</option>
                        </select>

                        <x-primary-button type="submit" class="ml-2">Cari</x-primary-button>

                        <a href="{{ route('users.index') }}" class="ml-2 text-sm text-gray-600 hover:underline">
                            <x-secondary-button>
                                Reset
                            </x-secondary-button>
                        </a>

                        <span style="font-size: 0.8rem;" class="text-gray-600 dark:text-gray-400"><i>*Format pencarian tanggal : YYYY-MM-DD</i></span>
                    </div>
                </form>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($users as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $users->firstItem() + $loop->index }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $user->getRoleNames()->implode(', ') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('users.show', $user->id) }}" class="text-indigo-600 hover:text-indigo-900"><b>View</b></a>
                                        <a href="{{ route('users.edit', $user->id) }}" class="text-indigo-600 hover:text-indigo-900 ml-2"><b>Edit</b></a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Apakah Anda yakin?')" class="text-red-600 hover:text-red-900 ml-2">
                                                <b>Hapus</b>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center">Tidak ada data pengguna.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Pagination Links -->
                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
