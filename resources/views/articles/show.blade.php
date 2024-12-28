<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{ $article->title }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900 dark:text-gray-100">
                  <img src="{{ asset('storage/' . $article->image_file_name) }}" alt="{{ $article->alt_text }}" class="w-full h-64 object-cover mb-6">
                  <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                      By {{ $article->author->name ?? 'Unknown' }} on {{ $article->release_date->format('M d, Y') }}
                  </p>
                  <div class="mb-6">
                      <h3 class="text-lg font-bold">Free Content</h3>
                      <p>{{ $article->free_content }}</p>
                  </div>
                  @if($article->premium_content)
                      <div>
                          <h3 class="text-lg font-bold">Premium Content</h3>
                          <p>{{ $article->premium_content }}</p>
                      </div>
                  @endif
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
