<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 m-8 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <form method="POST" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Nama -->
                    <div>
                        <label for="name" class="block font-medium text-sm text-gray-700 dark:text-gray-200">Nama</label>
                        <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required autofocus 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <!-- Email -->
                    <div class="mt-4">
                        <label for="email" class="block font-medium text-sm text-gray-700 dark:text-gray-200">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <label for="password" class="block font-medium text-sm text-gray-700 dark:text-gray-200">Password</label>
                        <input id="password" type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <!-- Role Dropdown -->
                    <div class="mt-4">
                        <label for="role" class="block font-medium text-sm text-gray-700 dark:text-gray-200">Role</label>
                        <select id="role" name="role" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="admin" {{ (old('role', $user->getRoleNames()->first()) == 'admin') ? 'selected' : '' }}>Admin</option>
                            <option value="user" {{ (old('role', $user->getRoleNames()->first()) == 'user') ? 'selected' : '' }}>User</option>
                            <option value="reviewer" {{ (old('role', $user->getRoleNames()->first()) == 'reviewer') ? 'selected' : '' }}>Reviewer</option>
                        </select>
                    </div>

                    <!-- Tombol aksi -->
                    <div class="flex items-center justify-end mt-4 space-x-4">
                        <x-secondary-button>
                            <a href="{{ route('users.index') }}">
                                {{ __('Batal') }}
                            </a>
                        </x-secondary-button>
                        
                        <x-primary-button type="submit">
                            {{ __('Simpan') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
