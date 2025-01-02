<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>
  
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('admin.update', $user->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
  
                        <!-- Name Field -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">
                                Name
                            </label>
                            <input type="text" name="name" id="name" value="{{ $user->name }}" required
                                class="mt-1 block w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-500">
                        </div>
  
                        <!-- Email Field -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">
                                Email
                            </label>
                            <input type="email" name="email" id="email" value="{{ $user->email }}" required
                                class="mt-1 block w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-500">
                        </div>
  
                        <!-- Role Dropdown -->
                        <div>
                            <label for="role" class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">
                                Role
                            </label>
                            <select name="role" id="role"
                                class="mt-1 block w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-500">
                                <option value="Admin" {{ $user->role === 'Admin' ? 'selected' : '' }}>Admin</option>
                                <option value="Author" {{ $user->role === 'Author' ? 'selected' : '' }}>Author</option>
                                <option value="Reader" {{ $user->role === 'Reader' ? 'selected' : '' }}>Reader</option>
                            </select>
                        </div>
  
                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit"
                                class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-500">
                                Update User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </x-app-layout>
  