<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($articles->isNotEmpty())
                @php
                    $latestArticle = $articles->first();
                @endphp
                <!-- Featured Article -->
                <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-lg sm:rounded-lg mb-6">
                    <a href="{{ route('articles.show', $latestArticle) }}">
                        <img src="{{ asset('storage/' . $latestArticle->image_file_name) }}" 
                             alt="{{ $latestArticle->alt_text }}" 
                             class="w-full h-64 object-cover sm:rounded-t-lg">
                    </a>
                    <div class="p-6">
                        <a href="{{ route('articles.show', $latestArticle) }}">
                            <h3 class="font-bold text-2xl text-gray-800 dark:text-gray-100 mb-2">
                                {{ $latestArticle->title }}
                            </h3>
                        </a>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                            By {{ $latestArticle->author->name ?? 'Unknown' }} on {{ $latestArticle->release_date->format('M d, Y') }}
                        </p>
                        <p class="text-gray-700 dark:text-gray-300">
                            {{ Str::limit($latestArticle->free_content, 150, '...') }}
                        </p>
                        <div class="flex items-center mt-4 space-x-6">
                            <div class="flex items-center">
                                <img src="{{ asset('icons/like.png') }}" alt="Likes" class="w-6 h-6">
                                <span class="ml-2 text-gray-700 dark:text-gray-300">{{ $latestArticle->likes->count() }}</span>
                            </div>
                            <div class="flex items-center">
                                <img src="{{ asset('icons/comment.png') }}" alt="Comments" class="w-6 h-6">
                                <span class="ml-2 text-gray-700 dark:text-gray-300">{{ $latestArticle->comments->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Remaining Articles -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($articles->skip(1) as $article)
                    <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-md sm:rounded-lg">
                        <a href="{{ route('articles.show', $article) }}">
                            <img src="{{ asset('storage/' . $article->image_file_name) }}" 
                                 alt="{{ $article->alt_text }}" 
                                 class="w-full h-48 object-cover sm:rounded-t-lg">
                        </a>
                        <div class="p-6">
                            <a href="{{ route('articles.show', $article) }}">
                                <h3 class="font-bold text-lg text-gray-800 dark:text-gray-100">
                                    {{ $article->title }}
                                </h3>
                            </a>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                                By {{ $article->author->name ?? 'Unknown' }} on {{ $article->release_date->format('M d, Y') }}
                            </p>
                            <div class="flex items-center space-x-6">
                                <div class="flex items-center">
                                    <img src="{{ asset('icons/like.png') }}" alt="Likes" class="w-6 h-6">
                                    <span class="ml-2 text-gray-700 dark:text-gray-300">{{ $article->likes->count() }}</span>
                                </div>
                                <div class="flex items-center">
                                    <img src="{{ asset('icons/comment.png') }}" alt="Comments" class="w-6 h-6">
                                    <span class="ml-2 text-gray-700 dark:text-gray-300">{{ $article->comments->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $articles->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
