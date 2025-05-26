<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Penelitian (Admin)') }}
        </h2>
    </x-slot>

    <!-- Custom CSS untuk layout flex -->
    <style>
        .container-flex {
            display: flex;
            gap: 20px;
        }
        .left-column, .middle-column, .right-column {
            background-color: #ffffff;
            padding: 16px;
            border: 1px solid #e5e7eb; /* Tailwind gray-200 */
            border-radius: 0.5rem;
        }
        .left-column {
            flex: 1;
        }
        .middle-column {
            flex: 1.5;
            overflow-y: auto;
            max-height: 500px; /* sesuaikan jika perlu */
        }
        .right-column {
            flex: 1;
        }
        .section-title {
            font-weight: 600;
            margin-bottom: 8px;
            border-bottom: 1px solid #d1d5db; /* Tailwind gray-300 */
            padding-bottom: 4px;
        }
        .detail-item {
            margin-bottom: 12px;
        }
    </style>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container-flex p-4 m-8  bg-white dark:bg-gray-800 shadow sm:rounded-lg ">
                <!-- Left Column: Detail Penelitian -->
                <div class="left-column">
                    <div class="section-title" style="font-size: 1.5rem;">
                        Detail Penelitian
                    </div>
                    <div class="detail-item">
                        <strong>Judul:</strong> {{ $penelitian->title }}
                    </div>
                    <div class="detail-item">
                        <strong>Status:</strong> {{ ucfirst($penelitian->status) }}
                    </div>
                    <div class="detail-item">
                        <strong>Tanggal Dibuat:</strong> {{ $penelitian->created_at->format('d/m/Y') }}
                    </div>
                    <div class="detail-item">
                        <strong>Tanggal Selesai:</strong>
                        @if($penelitian->status === 'selesai')
                            {{ $penelitian->updated_at->format('d/m/Y') }}
                        @else
                            -
                        @endif
                    </div>
                    <div class="detail-item">
                        <strong>Pemilik:</strong> {{ $penelitian->user->name ?? '-' }} (ID: {{ $penelitian->user_id }})
                    </div>
                </div>

                <!-- Middle Column: Daftar Progress -->
                <div class="middle-column">
                    <div class="section-title" style="font-size: 1.5rem;">Daftar Progress</div>
                    @if($penelitian->progress->isNotEmpty())
                        <ul class="list-disc pl-4">
                            @foreach($penelitian->progress as $progress)
                                <li class="mb-2">
                                    <div>
                                        <strong>{{ $progress->created_at->format('d/m/Y') }}</strong> - 
                                        {{ Str::limit($progress->description, 50) }}
                                        (<a href="{{ route('admin.progress.show', $progress->id) }}" class="text-indigo-600 hover:underline">View</a>)
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-600">Tidak ada progress.</p>
                    @endif
                </div>

                <!-- Right Column: Final Report -->
                <div class="right-column">
                    <div class="section-title" style="font-size: 1.5rem;">Final Report</div>
                    @if($penelitian->finalReport)
                        <div class="mb-2">
                            <strong>Final Article:</strong>
                            <a href="{{ asset('storage/' . $penelitian->finalReport->final_article) }}" target="_blank" class="text-indigo-600 hover:underline">
                                Download
                            </a>
                        </div>
                        <div class="mb-2">
                            <strong>Final Report:</strong>
                            <a href="{{ asset('storage/' . $penelitian->finalReport->final_report) }}" target="_blank" class="text-indigo-600 hover:underline">
                                Download
                            </a>
                        </div>
                        <div class="mb-2">
                            <strong>Final Budget:</strong>
                            <a href="{{ asset('storage/' . $penelitian->finalReport->final_budget) }}" target="_blank" class="text-indigo-600 hover:underline">
                                Download
                            </a>
                        </div>
                    @else
                        <p class="text-gray-600">Belum ada final report.</p>
                    @endif
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end m-8 space-x-2">
                <a href="{{ route('penelitian_admin.index') }}">
                    <x-secondary-button>
                        Kembali
                    </x-secondary-button>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
