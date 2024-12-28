<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{ __('Articles') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
              @foreach($articles as $article)
                  <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                      <a href="{{ route('articles.show', $article) }}">
                          <img src="{{ asset('storage/' . $article->image_file_name) }}" alt="{{ $article->alt_text }}" class="w-full h-48 object-cover">
                      </a>
                      <div class="p-6 text-gray-900 dark:text-gray-100">
                          <a href="{{ route('articles.show', $article) }}">
                              <h3 class="font-bold text-lg">{{ $article->title }}</h3>
                          </a>
                          <p class="text-sm text-gray-600 dark:text-gray-400">
                            By {{ $article->author->name ?? 'Unknown' }} on {{ $article->release_date->format('M d, Y') }}
                        </p>
                      </div>
                  </div>
              @endforeach
          </div>
          <div class="mt-6">
              {{ $articles->links() }}
          </div>
      </div>
  </div>
</x-app-layout>
