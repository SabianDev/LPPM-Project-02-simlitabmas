<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-2">
            {{ __('Progress Penelitian') }} - "{{ $penelitian->title }}"
        </h2>
        <h4 class="font-regular text-x5 text-gray-800 dark:text-gray-200">
            {{ __('Status') }} : {{ $penelitian->status }}
        </h4>
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
            <div class="p-4 m-8 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg overflow-x-auto">
                <!-- Jika penelitian sudah selesai, tampilkan pesan, kalau tidak, tombol tambah progress -->
                <div class="flex justify-between items-center mb-4">
                    <!-- Bagian kiri: tombol "Tambah Progress" atau pesan jika sudah selesai -->
                    <div class="flex-1">
                        @if($penelitian->status === 'selesai')
                            <div class="mb-0 text-gray-800 dark:text-gray-200">
                                <b>{{ __('Progress Penelitian sudah selesai') }}</b>
                            </div>
                        @else
                            <div class="mb-0">
                                <x-primary-button>
                                    <a href="{{ route('progress.create', $penelitian->id) }}">
                                        {{ __('Tambah Progress') }}
                                    </a>
                                </x-primary-button>
                            </div>
                        @endif
                    </div>

                    <!-- Bagian kanan: search form -->
                    <div class="flex-1 text-right">
                        <form method="GET" action="{{ route('progress.index', $penelitian->id) }}" class="inline-block">
                            <div class="flex items-center space-x-4 justify-end">
                                <input type="text" name="search" placeholder="Cari deskripsi progress" value="{{ request('search') }}"
                                    class="border border-gray-300 rounded-md shadow-sm p-2">
                                <x-primary-button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                    Cari
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Tabel daftar progress -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Upload</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">File Progress</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($progresses as $index => $progress)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $progresses->firstItem() + $index }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $progress->created_at->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $progress->description }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ basename($progress->file_progress) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('progress.show', $progress->id) }}" class="text-indigo-600 hover:text-indigo-900"><b>View</b></a>
                                        @if($penelitian->status !== 'selesai')
                                            <span class="text-gray-500 ml-2">-</span>
                                            <a href="{{ route('progress.edit', $progress->id) }}" class="text-indigo-600 hover:text-indigo-900 ml-2"><b>Edit</b></a>
                                            <span class="text-gray-500 ml-2">-</span>
                                            <form action="{{ route('progress.destroy', $progress->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Hapus progress ini?')" class="text-red-600 hover:text-red-900 ml-2">
                                                    <b>Hapus</b>
                                                </button>
                                            </form>
                                        @else
                                            
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center">Belum ada progress yang diunggah.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Links -->
                <div class="mt-4">
                    {{ $progresses->links() }}
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
