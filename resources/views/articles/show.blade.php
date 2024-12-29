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
                    <!-- Display Article Image -->
                    <img src="{{ asset('storage/' . $article->image_file_name) }}" alt="{{ $article->alt_text }}" class="w-full h-64 object-cover mb-6">
  
                    <!-- Author and Date -->
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                        By {{ $article->author->name ?? 'Unknown' }} on {{ $article->release_date->format('M d, Y') }}
                    </p>
  
                    <!-- Free Content -->
                    <div class="mb-6">
                        <h3 class="text-lg font-bold">Free Content</h3>
                        <p>{{ $article->free_content }}</p>
                    </div>
  
                    <!-- Premium Content Logic -->
                    @if($article->premium_content)
                        <div>
                            <h3 class="text-lg font-bold">Premium Content</h3>
                            @if(auth()->check() && (auth()->user()->isAuthor() || auth()->user()->isAdmin() || auth()->user()->hasActiveSubscription()))
                                <!-- Full Premium Content -->
                                <p>{{ $article->premium_content }}</p>
                            @elseif(auth()->check())
                                <!-- Partial Premium Content for Logged-in Reader without Subscription -->
                                <p>{{ Str::limit($article->premium_content, 100, '...') }}</p>
                                <p class="text-red-500 font-bold mt-4">
                                    To view the full premium content, please <a href="{{ route('subscriptions.index') }}" class="text-blue-500 underline">purchase a subscription</a>.
                                </p>
                            @else
                                <!-- Blurred Content for Guests -->
                                <p class="blur-sm">{{ Str::limit($article->premium_content, 100, '...') }}</p>
                                <p class="text-red-500 font-bold mt-4">
                                    To view the premium content, please <a href="{{ route('login') }}" class="text-blue-500 underline">log in</a> or <a href="{{ route('register') }}" class="text-blue-500 underline">register</a>.
                                </p>
                            @endif
                        </div>
                    @endif
                    <div id="like-section" class="mt-6 flex items-center">
                        <div id="like-icon-wrapper" class="rounded-full p-2 transition-all duration-300">
                            <img id="like-icon" 
                                 src="{{ $article->isLikedBy(auth()->user()) ? asset('icons/liked.png') : asset('icons/like.png') }}" 
                                 class="like-button">
                        </div>
                        <span id="likes-count" class="ml-2">{{ $article->likes->count() }}</span>
                    </div>
                    
                    <script>
                        const likeIconWrapper = document.getElementById('like-icon-wrapper');
                        const likeIcon = document.getElementById('like-icon');
                        const likesCount = document.getElementById('likes-count');
                    
                        likeIcon.addEventListener('click', function () {
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
                    
                                // Update the icon based on like status
                                if (data.status === 'liked') {
                                    likeIcon.src = '{{ asset('icons/liked.png') }}';
                                } else {
                                    likeIcon.src = '{{ asset('icons/like.png') }}';
                                }
                            })
                            .catch(error => console.error('Error:', error));
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
  </x-app-layout>
  