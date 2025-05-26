<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Program Studi') }}
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

                <x-primary-button class="mb-4">
                    <div>
                        <a href="{{ route('program_studi.create') }}">
                            {{ __('Tambah Program Studi') }}
                        </a>
                    </div>
                </x-primary-button>

                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Program Studi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($programStudi as $index => $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->namaProdi }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('program_studi.show', $item->id) }}" class="text-indigo-600 hover:text-indigo-900"><b>View</b></a>
                                    <a href="{{ route('program_studi.edit', $item->id) }}" class="text-indigo-600 hover:text-indigo-900 ml-2">
                                        <b>Edit</b>
                                    </a>
                                    <form action="{{ route('program_studi.destroy', $item->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Apakah anda yakin?')" class="text-red-600 hover:text-red-900 ml-2">
                                            <b>Hapus</b>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
