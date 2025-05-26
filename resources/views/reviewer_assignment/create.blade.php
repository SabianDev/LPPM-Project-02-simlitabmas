<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pilih Reviewer') }}
        </h2>
    </x-slot>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 m-8 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <form method="POST" action="{{ route('assign_reviewer.store') }}">
                    @csrf
                    <!-- Sembunyikan proposal_id -->
                    <input type="hidden" name="proposal_id" value="{{ $proposalId }}">

                    <div class="mb-4">
                        <label for="reviewer_user_id" class="block font-medium text-sm text-gray-800 dark:text-gray-400">
                            {{ __('Pilih Reviewer (Available)') }}
                        </label>
                        <select name="reviewer_user_id" id="reviewer_user_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="">-- Pilih Reviewer --</option>
                            @foreach($reviewers as $reviewer)
                                <option value="{{ $reviewer->user->id }}">
                                    {{ $reviewer->user->name }} ({{ ucfirst($reviewer->status) }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-center justify-end mt-4 gap-2">
                        <x-secondary-button>
                            <a href="{{ route('pengajuan_penelitian.index') }}">
                                {{ __('Kembali') }}
                            </a>
                        </x-secondary-button>
                        <x-primary-button type="submit">
                            {{ __('Assign Reviewer') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
