<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Reviewer') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 m-8 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                @if($errors->any())
                    <div class="mb-4">
                        <ul class="text-red-600">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('reviewer_management.update', $reviewer->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="name" class="block font-medium text-sm text-gray-700">{{ __('Nama') }}</label>
                        <input id="name" type="text" name="name" value="{{ old('name', $reviewer->name) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block font-medium text-sm text-gray-700">{{ __('Email') }}</label>
                        <input id="email" type="email" name="email" value="{{ old('email', $reviewer->email) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div class="mb-4">
                        <label for="status" class="block font-medium text-sm text-gray-700">{{ __('Status Reviewer') }}</label>
                        <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="available" {{ old('status', $reviewer->reviewerStatus->status ?? 'available') == 'available' ? 'selected' : '' }}>Available</option>
                            <option value="not_available" {{ old('status', $reviewer->reviewerStatus->status ?? 'available') == 'not_available' ? 'selected' : '' }}>Not Available</option>
                        </select>
                    </div>
                    <div class="flex items-center justify-end">
                        <a href="{{ route('reviewer_management.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">
                            <x-secondary-button>
                            {{ __('Batal') }}
                            </x-secondary-button>    
                        </a>
                        <x-primary-button type="submit" class=" ml-4">
                            {{ __('Perbarui') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
