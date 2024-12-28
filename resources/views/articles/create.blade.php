<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Create Article') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900">
                  <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                      @csrf

                      <!-- Title -->
                      <div class="mb-4">
                          <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                          <input type="text" name="title" id="title" class="mt-1 block w-full" required>
                      </div>

                      <!-- Free Content -->
                      <div class="mb-4">
                          <label for="free_content" class="block text-sm font-medium text-gray-700">Free Content</label>
                          <textarea name="free_content" id="free_content" class="mt-1 block w-full"></textarea>
                      </div>

                      <!-- Premium Content -->
                      <div class="mb-4">
                          <label for="premium_content" class="block text-sm font-medium text-gray-700">Premium Content</label>
                          <textarea name="premium_content" id="premium_content" class="mt-1 block w-full"></textarea>
                      </div>

                      <!-- Image -->
                      <div class="mb-4">
                          <label for="image_file" class="block text-sm font-medium text-gray-700">Image</label>
                          <input type="file" name="image_file" id="image_file" class="mt-1 block w-full">
                      </div>

                      <!-- Alt Text -->
                      <div class="mb-4">
                          <label for="alt_text" class="block text-sm font-medium text-gray-700">Alt Text</label>
                          <input type="text" name="alt_text" id="alt_text" class="mt-1 block w-full">
                      </div>

                      <button type="submit" class="btn btn-primary">Save Article</button>
                  </form>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
