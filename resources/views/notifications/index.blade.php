<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Semua Notifikasi') }}
            </h2>
            <form action="{{ route('notifications.destroyAll') }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus semua notifikasi?')">
                @csrf
                @method('DELETE')
                <x-primary-button class="bg-red-600 hover:bg-red-700">
                    Hapus Semua
                </x-primary-button>
            </form>
        </div>
        @if(session('success'))
            <x-alert>
                {{ session('success') }}
            </x-alert>
        @endif
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 m-8 sm:p-8 bg-white shadow sm:rounded-lg">
                <ul>
                    @forelse($notifications as $notification)
                        <li class="px-4 py-2 border-b border-gray-200 flex justify-between items-center">
                            <div>
                                <p class="text-sm text-gray-600">
                                    {{ $notification->data['message'] ?? 'Ada notifikasi baru' }}
                                </p>
                                <small class="text-xs text-gray-400">
                                    Dari: {{ $notification->data['from'] ?? '-' }}
                                </small>
                            </div>
                            <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm">
                                    Hapus
                                </button>
                            </form>
                        </li>
                    @empty
                        <li class="px-4 py-2 text-gray-600">Tidak ada notifikasi.</li>
                    @endforelse
                </ul>

                <!-- Pagination Links -->
                <div class="mt-4">
                    {{ $notifications->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
