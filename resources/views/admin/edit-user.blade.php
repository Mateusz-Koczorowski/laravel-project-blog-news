<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{ __('Edit User') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900 dark:text-gray-100">
                  <form action="{{ route('admin.update', $user->id) }}" method="POST">
                      @csrf
                      @method('PUT')

                      <div class="mb-4">
                          <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                          <input type="text" name="name" id="name" class="mt-1 block w-full" value="{{ $user->name }}" required>
                      </div>

                      <div class="mb-4">
                          <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                          <input type="email" name="email" id="email" class="mt-1 block w-full" value="{{ $user->email }}" required>
                      </div>

                      <div class="mb-4">
                          <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                          <select name="role" id="role" class="mt-1 block w-full">
                              <option value="Admin" {{ $user->role === 'Admin' ? 'selected' : '' }}>Admin</option>
                              <option value="Author" {{ $user->role === 'Author' ? 'selected' : '' }}>Author</option>
                              <option value="Reader" {{ $user->role === 'Reader' ? 'selected' : '' }}>Reader</option>
                          </select>
                      </div>

                      <button type="submit" class="btn btn-primary">Update User</button>
                  </form>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
