<x-app-layout>
  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          @if($articles->isNotEmpty())
              @php
                  $latestArticle = $articles->first();
              @endphp
              <div class="bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg mb-6">
                  <a href="{{ route('articles.show', $latestArticle) }}">
                      <img src="{{ asset('storage/' . $latestArticle->image_file_name) }}" alt="{{ $latestArticle->alt_text }}" class="w-full h-64 object-cover">
                  </a>
                  <div class="p-6 text-gray-900 dark:text-gray-100">
                      <a href="{{ route('articles.show', $latestArticle) }}">
                          <h3 class="font-bold text-2xl mb-2">{{ $latestArticle->title }}</h3>
                      </a>
                      <p class="text-sm text-gray-600 dark:text-gray-400">
                          By {{ $latestArticle->author->name ?? 'Unknown' }} on {{ $latestArticle->release_date->format('M d, Y') }}
                      </p>
                      <p class="mt-4">{{ Str::limit($latestArticle->free_content, 150, '...') }}</p>
                      <div class="flex items-center mt-6 space-x-6">
                          {{-- <div class="flex items-center">
                              <img src="{{ asset('icons/like.png') }}" class="w-6 h-6">
                              <span class="ml-2">{{ $latestArticle->likes->count() }}</span>
                          </div>
                          <div class="flex ml-3 items-center">
                              <img src="{{ asset('icons/comment.png') }}" class="w-6 h-6">
                              <span class="ml-2">{{ $latestArticle->comments->count() }}</span>
                          </div> --}}
                          <div class="flex items-center mr-4" style="margin-right: 1rem;">
                                <img src="{{ asset('icons/like.png') }}" class="w-6 h-6" style="margin-right: 0.5rem;">
                                <span class="ml-2">{{ $latestArticle->likes->count() }}</span>
                            </div>
                            <div class="flex items-center">
                                <img src="{{ asset('icons/comment.png') }}" class="w-6 h-6" style="margin-right: 0.5rem;">
                                <span class="ml-2">{{ $latestArticle->comments->count() }}</span>
                            </div>
                      </div>
                  </div>
              </div>
          @endif

          <!-- Remaining Articles -->
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($articles->skip(1) as $article)
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
                        <div class="flex items-center mt-4">
                            <div class="flex items-center mr-4" style="margin-right: 1rem;">
                                <img src="{{ asset('icons/like.png') }}" class="w-6 h-6" style="margin-right: 0.5rem;">
                                <span class="ml-2">{{ $article->likes->count() }}</span>
                            </div>
                            <div class="flex items-center">
                                <img src="{{ asset('icons/comment.png') }}" class="w-6 h-6" style="margin-right: 0.5rem;">
                                <span class="ml-2">{{ $article->comments->count() }}</span>
                            </div>
                        </div>
                      </div>
                  </div>
              @endforeach
          </div>
          <div class="mt-6 dark:text-black">
              {{ $articles->links() }}
          </div>
      </div>
  </div>
</x-app-layout>
