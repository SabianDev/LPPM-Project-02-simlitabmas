<div class="relative" x-data="{ open: false }">
    <!-- Tombol ikon notifikasi -->
    <button @click="open = !open" class="relative focus:outline-none">
        <!-- Contoh ikon menggunakan Heroicons (bell icon) -->
        <svg class="h-6 w-6 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>
        <!-- Badge notifikasi jika ada unread -->
        @if(auth()->user()->unreadNotifications->count() > 0)
            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-1 py-0.5 text-xs font-bold text-white bg-red-600 rounded-full">
                {{ auth()->user()->unreadNotifications->count() }}
            </span>
        @endif
    </button>

    <!-- Dropdown Notifikasi -->
    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 bg-white rounded-md shadow-lg overflow-hidden z-20" style="width:200px;">
        <div class="py-2">
            <!-- Ambil hanya 5 notif terakhir dari database (lewat take(5) as ....) -->
            @forelse(auth()->user()->notifications->take(5) as $notification)
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    <div class="font-semibold">{{ $notification->data['from'] ?? 'System' }}</div>
                    <div>{{ $notification->data['message'] }}</div>
                </a>
            @empty
                <div class="px-4 py-2 text-sm text-gray-700">Tidak ada notifikasi.</div>
            @endforelse
        </div>
        <div class="border-t">
            <a href="{{ route('notifications.index') }}" class="block px-4 py-2 text-sm text-center text-indigo-600 hover:text-indigo-300">
                <b>Notifikasi Lain...</b>
            </a>
        </div>
    </div>
</div>
