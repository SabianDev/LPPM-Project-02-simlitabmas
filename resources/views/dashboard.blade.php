<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 m-8 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                @if(auth()->user()->hasRole('admin'))
                    <!-- widget buat ADMIN -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="bg-white p-4 rounded-lg shadow">
                            <h3 class="text-lg font-semibold text-gray-800">Total Proposal</h3>
                            <p class="text-2xl font-bold text-gray-900">{{ $totalProposals }}</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow">
                            <h3 class="text-lg font-semibold text-gray-800">Pending Proposal</h3>
                            <p class="text-2xl font-bold text-gray-900">{{ $pendingProposals }}</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow">
                            <h3 class="text-lg font-semibold text-gray-800">Approved Proposal</h3>
                            <p class="text-2xl font-bold text-gray-900">{{ $approvedProposals }}</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow">
                            <h3 class="text-lg font-semibold text-gray-800">Rejected Proposal</h3>
                            <p class="text-2xl font-bold text-gray-900">{{ $rejectedProposals }}</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow">
                            <h3 class="text-lg font-semibold text-gray-800">Total Penelitian</h3>
                            <p class="text-2xl font-bold text-gray-900">{{ $totalPenelitian }}</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow">
                            <h3 class="text-lg font-semibold text-gray-800">Ongoing Penelitian</h3>
                            <p class="text-2xl font-bold text-gray-900">{{ $ongoingPenelitian }}</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow">
                            <h3 class="text-lg font-semibold text-gray-800">Penelitian Selesai</h3>
                            <p class="text-2xl font-bold text-gray-900">{{ $finishedPenelitian }}</p>
                        </div>
                        <!-- Card Tambahan untuk Jumlah Pengguna -->
                        <div class="bg-white p-4 rounded-lg shadow">
                            <h3 class="text-lg font-semibold text-gray-800">Total Pengguna</h3>
                            <p class="text-2xl font-bold text-gray-900">{{ $totalUsers }}</p>
                        </div>
                        <!-- Card Tambahan untuk Jumlah Reviewer -->
                        <div class="bg-white p-4 rounded-lg shadow">
                            <h3 class="text-lg font-semibold text-gray-800">Total Reviewer</h3>
                            <p class="text-2xl font-bold text-gray-900">{{ $totalReviewers }}</p>
                        </div>
                    </div>
                @endif
                @if(auth()->user()->hasRole('user'))
                    <div class="p-4 m-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div class="bg-white p-4 rounded-lg shadow">
                                <h3 class="text-lg font-semibold text-gray-800">Proposal Saya</h3>
                                <p class="text-2xl font-bold text-gray-900">{{ $totalUserProposals }}</p>
                            </div>
                            <div class="bg-white p-4 rounded-lg shadow">
                                <h3 class="text-lg font-semibold gray-green-800">Penelitian Saya</h3>
                                <p class="text-2xl font-bold gray-green-900">{{ $totalUserPenelitian }}</p>
                            </div>
                            <div class="bg-white p-4 rounded-lg shadow">
                                <h3 class="text-lg font-semibold text-gray-800">Proposal Disetujui</h3>
                                <p class="text-2xl font-bold text-gray-900">{{ $approvedUserProposals }}</p>
                            </div>
                            <div class="bg-white p-4 rounded-lg shadow">
                                <h3 class="text-lg font-semibold text-gray-800">Progress Terbaru</h3>
                                @if(isset($userPenelitianId))
                                    <a href="{{ route('progress.index', $userPenelitianId) }}"">
                                        <x-primary-button class="shadow">
                                            Lihat Progress...
                                        </x-primary-button>    
                                    </a>
                                @else
                                    <p class="text-sm text-gray-600">Belum ada penelitian aktif.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
                @if(auth()->user()->hasRole('reviewer'))
                    <div class="p-4 m-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <!-- Widget Total Assignment Masuk -->
                            <div class="bg-white p-4 rounded-lg shadow">
                                <h3 class="text-lg font-semibold text-gray-800">Total Assignment</h3>
                                <p class="text-2xl font-bold text-gray-900">{{ $totalAssignments }}</p>
                            </div>
                            <!-- Widget Assignment Sedang Dikerjakan -->
                            <div class="bg-white p-4 rounded-lg shadow">
                                <h3 class="text-lg font-semibold text-gray-800">Sedang Dikerjakan</h3>
                                <p class="text-2xl font-bold text-gray-900">{{ $onWorkAssignments }}</p>
                            </div>
                            <!-- Widget Assignment Selesai -->
                            <div class="bg-white p-4 rounded-lg shadow">
                                <h3 class="text-lg font-semibold text-gray-800">Selesai</h3>
                                <p class="text-2xl font-bold text-gray-900">{{ $completedAssignments }}</p>
                            </div>
                        </div>

                        <!-- Daftar Assignment Terbaru -->
                        <div class="mt-6">
                            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 underline">Assignment Terbaru:</h3>
                            @if($latestAssignments->isNotEmpty())
                                <ul class="list-disc pl-4">
                                    @foreach($latestAssignments as $assignment)
                                        <li class="mb-2 disc">
                                            <span class="font-bold text-gray-800 dark:text-gray-200">• Proposal ID : {{ $assignment->proposal_id }} -</span>
                                            <a href="{{ route('reviewer_tampung.show', $assignment->id) }}" class="text-indigo-600 hover:underline">
                                                Lihat Detail
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-gray-600">Tidak ada assignment baru.</p>
                            @endif
                        </div>
                    </div>
                @endif
                <!-- Widget Activity / Notifikasi bisa ditambahkan di sini -->
                <!-- <div class="mt-6">
                    <h3 class="text-xl font-semibold text-gray-800">Activity Feed</h3>
                    <p class="text-gray-600">[Contoh Activity Feed]</p>
                </div> -->
            </div>
        </div>
    </div>
    <x-footer />
</x-app-layout>
