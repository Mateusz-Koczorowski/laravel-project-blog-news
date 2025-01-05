<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Display Article Image -->
                    <img src="{{ asset('storage/' . $article->image_file_name) }}" 
                         alt="{{ $article->alt_text }}" 
                         class="w-full h-auto object-center sm:rounded-lg mb-6">

                    <!-- Article Title -->
                    <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-100 mb-4">
                        {{ $article->title }}
                    </h2>

                    <!-- Author and Date -->
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                        By {{ $article->author->name ?? 'Unknown' }} on {{ $article->release_date->format('M d, Y') }}
                    </p>

                    <!-- Free Content -->
                    <div class="mb-6">
                        <p class="text-lg text-gray-800 dark:text-gray-100 leading-relaxed">
                            {{ $article->free_content }}
                        </p>
                    </div>

                    <!-- Premium Content Logic -->
                    @if($article->premium_content)
                        <div class="mb-6">
                            @if(auth()->check() && (auth()->user()->isAuthor() || auth()->user()->isAdmin() || auth()->user()->hasActiveSubscription()))
                                <!-- Full Premium Content -->
                                <p class="text-gray-800 dark:text-gray-100">{{ $article->premium_content }}</p>
                            @elseif(auth()->check())
                                <!-- Partial Premium Content for Logged-in Reader without Subscription -->
                                <p class="text-gray-800 dark:text-gray-100">{{ Str::limit($article->premium_content, 100, '...') }}</p>
                                <p class="text-red-500 font-bold mt-4">
                                    To view the full premium content, please 
                                    <a href="{{ route('subscriptions.index') }}" class="text-blue-500 underline">purchase a subscription</a>.
                                </p>
                            @else
                                <!-- Blurred Content for Guests -->
                                <p class="blur-sm">{{ Str::limit($article->premium_content, 100, '...') }}</p>
                                <p class="text-red-500 font-bold mt-4">
                                    To view the premium content, please 
                                    <a href="{{ route('login') }}" class="text-blue-500 underline">log in</a> 
                                    or 
                                    <a href="{{ route('register') }}" class="text-blue-500 underline">register</a>.
                                </p>
                            @endif
                        </div>
                    @endif

                    <!-- Like Section -->
                    <div id="like-section" class="mt-6 flex items-center">
                        <div id="like-icon-wrapper" class="rounded-full p-2 transition-all duration-300 cursor-pointer">
                            <img id="like-icon" 
                                 src="{{ $article->isLikedBy(auth()->user()) ? asset('icons/liked.png') : asset('icons/like.png') }}" 
                                 alt="Like" 
                                 class="w-6 h-6">
                        </div>
                        <span id="likes-count" class="ml-2 text-gray-700 dark:text-gray-300">{{ $article->likes->count() }}</span>
                    </div>

                    <!-- Comments Section -->
                    <div class="mt-8">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">
                            Comments ({{ $article->comments->count() }})
                        </h3>
                        @foreach ($article->comments as $comment)
                            <div class="mt-4 p-4 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-sm">
                                <p class="text-sm text-gray-900 dark:text-gray-100">
                                    <strong>{{ $comment->user->name }}</strong> - {{ $comment->created_at->format('M d, Y H:i') }}
                                </p>
                                <p class="mt-2 text-gray-700 dark:text-gray-300">{{ $comment->content }}</p>
                                @can('delete', $comment)
                                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="mt-2 inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-slate-200 text-white rounded hover:bg-red-600 transition">
                                            <img src="{{ asset('icons/delete.png') }}" alt="Delete" class="w-6 h-6">
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        @endforeach
                    </div>

                    <!-- Add Comment Form -->
                    @if(auth()->check())
                        <form action="{{ route('comments.store', $article) }}" method="POST" class="mt-6">
                            @csrf
                            <textarea name="content" rows="3" 
                                      class="w-full border border-gray-300 rounded-lg p-2 text-gray-800 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                      placeholder="Add a comment..." required></textarea>
                            <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                                Post Comment
                            </button>
                        </form>
                    @else
                        <p class="mt-4 text-gray-500">
                            Please 
                            <a href="{{ route('login') }}" class="text-blue-500 underline">log in</a> 
                            to post a comment.
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const likeIcon = document.getElementById('like-icon');
            const likesCount = document.getElementById('likes-count');
            const likeIconWrapper = document.getElementById('like-icon-wrapper');

            likeIconWrapper.addEventListener('click', () => {
                fetch('{{ route('articles.like', $article->id) }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    likesCount.textContent = data.likes_count;
                    likeIcon.src = data.status === 'liked' 
                        ? '{{ asset('icons/liked.png') }}' 
                        : '{{ asset('icons/like.png') }}';
                })
                .catch(error => console.error('Error:', error));
            });
        });
    </script>
</x-app-layout>
