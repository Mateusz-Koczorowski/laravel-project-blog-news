<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Article') }}
        </h2>
    </x-slot>
  
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('articles.update', $article) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')
  
                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">
                                Title
                            </label>
                            <input type="text" name="title" id="title" value="{{ $article->title }}" required
                                class="mt-1 block w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
  
                        <!-- Free Content -->
                        <div>
                            <label for="free_content" class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">
                                Free Content
                            </label>
                            <textarea name="free_content" id="free_content"
                                class="mt-1 block w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $article->free_content }}</textarea>
                        </div>
  
                        <!-- Premium Content -->
                        <div>
                            <label for="premium_content" class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">
                                Premium Content
                            </label>
                            <textarea name="premium_content" id="premium_content"
                                class="mt-1 block w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $article->premium_content }}</textarea>
                        </div>
  
                        <!-- Image -->
                        <div>
                            <label for="image_file" class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">
                                Image
                            </label>
                            <input type="file" name="image_file" id="image_file"
                                class="mt-1 block w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @if ($article->image_file_name)
                                <p class="mt-2 text-gray-800 dark:text-gray-100">
                                    Current Image:
                                    <img src="{{ asset('storage/' . $article->image_file_name) }}" alt="{{ $article->alt_text }}" class="w-32 h-auto mt-2 rounded-md">
                                </p>
                            @endif
                        </div>
  
                        <!-- Alt Text -->
                        <div>
                            <label for="alt_text" class="block text-sm font-medium text-gray-800 dark:text-gray-100 mb-1">
                                Alt Text
                            </label>
                            <input type="text" name="alt_text" id="alt_text" value="{{ $article->alt_text }}"
                                class="mt-1 block w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
  
                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit"
                                class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Update Article
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </x-app-layout>
  