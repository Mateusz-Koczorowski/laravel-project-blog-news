<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Author Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="font-semibold text-lg">Your Articles</h2>
                        <a href="{{ route('author.articles.create') }}" 
                           class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Create New Article
                        </a>
                    </div>

                    @if ($articles->isNotEmpty())
                        <table class="table-auto w-full border-collapse border border-gray-300 dark:border-gray-600">
                            <thead>
                                <tr class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100">
                                    <th class="border px-4 py-2 text-left">Title</th>
                                    <th class="border px-4 py-2 text-left">Published Date</th>
                                    <th class="border px-4 py-2 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-50 dark:bg-gray-700">
                                @foreach ($articles as $article)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-600 transition duration-150">
                                        <td class="border px-4 py-2">{{ $article->title }}</td>
                                        <td class="border px-4 py-2">{{ $article->release_date->format('M d, Y') }}</td>
                                        <td class="border px-4 py-2 text-center space-x-2">
                                            <a href="{{ route('author.articles.edit', $article) }}" 
                                               class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md shadow-md focus:outline-none focus:ring-2 focus:ring-yellow-400">
                                                Edit
                                            </a>
                                            <form action="{{ route('author.articles.destroy', $article) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-md shadow-md focus:outline-none focus:ring-2 focus:ring-red-400"
                                                        onclick="return confirm('Are you sure?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-6">
                            {{ $articles->links('pagination::tailwind') }}
                        </div>
                    @else
                        <p class="mt-6 text-gray-600 dark:text-gray-400 text-center">No articles found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
