<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Reviewer') }}
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
                <!-- Search Form -->
                <form method="GET" action="{{ route('reviewer_management.index') }}" class="mb-4">
                    <div class="flex items-center space-x-2 gap-2">
                        <input type="text" name="search" placeholder="Ketik kata kunci..." value="{{ request('search') }}"
                            class="border border-gray-300 rounded-md shadow-sm p-2">
                        
                        <select name="filter" style="min-width: 180px;" class="border border-gray-300 rounded-md shadow-sm p-2">
                            <option value="name" {{ request('filter') == 'name' ? 'selected' : '' }}>Nama</option>
                            <option value="email" {{ request('filter') == 'email' ? 'selected' : '' }}>Email</option>
                            <option value="status" {{ request('filter') == 'status' ? 'selected' : '' }}>Status Reviewer</option>
                        </select>
                        
                        <x-primary-button type="submit" class="ml-4">
                            Cari
                        </x-primary-button>

                        <!-- Reset Button -->
                        <x-secondary-button type="reset" class="ml-4">
                            <a href="{{ route('reviewer_management.index') }}">
                                Reset
                            </a>
                        </x-secondary-button>
                        <span style="font-size: 0.8rem;" class="text-gray-600 dark:text-gray-400"><i>*Format pencarian tanggal : YYYY-MM-DD</i></span>
                    </div>
                </form>


                <!-- Tabel Data Reviewer -->
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Reviewer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($reviewers as $index => $reviewer)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $reviewers->firstItem() + $loop->index }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $reviewer->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $reviewer->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $reviewer->reviewerStatus ? ucfirst($reviewer->reviewerStatus->status) : 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('reviewer_management.show', $reviewer->id) }}" class="text-indigo-600 hover:text-indigo-900"><b>View</b></a>
                                    <a href="{{ route('reviewer_management.edit', $reviewer->id) }}" class="text-indigo-600 hover:text-indigo-900 ml-2"><b>Edit</b></a>
                                    <form action="{{ route('reviewer_management.destroy', $reviewer->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Apakah anda yakin?')" class="text-red-600 hover:text-red-900 ml-2">
                                            <b>Hapus</b>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center">Tidak ada data reviewer.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination Links -->
                <div class="mt-4">
                    {{ $reviewers->links() }}
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
