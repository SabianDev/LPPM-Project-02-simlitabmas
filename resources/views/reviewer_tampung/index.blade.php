<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Assignment Proposal untuk Review') }}
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
                <!-- Search Form -->
                <form method="GET" action="{{ route('reviewer_tampung.index') }}" class="mb-4">
                    <div class="flex items-center space-x-2 gap-2">
                        <input type="text" name="search" placeholder="Masukkan kata kunci..." value="{{ request('search') }}"
                            class="border border-gray-300 rounded-md shadow-sm p-2">

                        <select name="filter" class="border border-gray-300 rounded-md shadow-sm p-2" style="min-width: 180px;" >
                            <option value="proposal_id" {{ request('filter') == 'proposal_id' ? 'selected' : '' }}>ID Proposal</option>
                            <option value="judul" {{ request('filter') == 'judul' ? 'selected' : '' }}>Judul Proposal</option>
                            <option value="status" {{ request('filter') == 'status' ? 'selected' : '' }}>Status Assignment</option>
                        </select>

                        <x-primary-button type="submit" class="ml-2">
                            Filter
                        </x-primary-button>

                        <a href="{{ route('reviewer_tampung.index') }}">
                            <x-secondary-button>
                            Reset
                            </x-secondary-button>
                        </a>
                        
                    </div>
                </form>


                <!-- Tabel Data Reviewer Assignment -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Proposal ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Proposal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Assignment</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($assignments as $index => $assignment)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $assignments->firstItem() + $index }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $assignment->proposal_id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $assignment->proposal->judul_penelitian }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($assignment->assignment_status) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('reviewer_tampung.show', $assignment->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                            <b>View</b>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center">Tidak ada data assignment.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Pagination Links -->
                <div class="mt-4">
                    {{ $assignments->links() }}
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
