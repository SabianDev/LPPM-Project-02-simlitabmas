<div class="relative">
    <!-- Tombol notifikasi -->
    <button id="notificationButton" class="relative focus:outline-none">
        <!-- Icon bell -->
        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"  xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V4a2 2 0 10-4 0v1.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1"></path>
        </svg>
        <!-- Badge notifikasi jika ada unread -->
        @if(auth()->user()->unreadNotifications->count() > 0)
            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-1 py-0.5 text-xs font-bold text-red-100 bg-red-600 rounded-full">
                {{ auth()->user()->unreadNotifications->count() }}
            </span>
        @endif
    </button>

    <!-- Dropdown notifikasi -->
    <div id="notificationDropdown" class="absolute right-0 mt-2 w-50 bg-white border border-gray-200 rounded shadow-lg hidden">
        <div class="p-4">
            <h3 class="text-lg font-semibold text-gray-700">Notifikasi</h3>
        </div>
        <ul>
            @forelse(auth()->user()->unreadNotifications->take(5) as $notification)
                <li class="px-4 py-2 border-b border-gray-200 hover:bg-gray-100">
                    <p class="text-sm text-gray-600">{{ $notification->data['message'] ?? 'Ada notifikasi baru' }}</p>
                    <small class="text-xs text-gray-400">Dari: {{ $notification->data['from'] ?? '-' }}</small>
                </li>
            @empty
                <li class="px-4 py-2 text-sm text-gray-600">Tidak ada notifikasi baru.</li>
            @endforelse
        </ul>
        <div class="px-4 py-2 border-t border-gray-200">
            <a href="{{ route('notifications.index') }}" class="block text-center text-sm text-indigo-600 hover:underline">
                Notifikasi Lain...
            </a>
        </div>
    </div>
</div>

<script>
    // Toggle dropdown ketika tombol diklik
    document.getElementById('notificationButton').addEventListener('click', function(e) {
        e.stopPropagation();
        document.getElementById('notificationDropdown').classList.toggle('hidden');
    });
    // Tutup dropdown ketika klik di luar
    document.addEventListener('click', function(e) {
        var dropdown = document.getElementById('notificationDropdown');
        if (!dropdown.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });
</script>
