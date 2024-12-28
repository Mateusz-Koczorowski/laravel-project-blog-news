<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Author Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="font-semibold text-lg">Your Articles</h2>
                    <a href="{{ route('author.articles.create') }}" class="btn btn-primary mt-4">Create New Article</a>

                    @if ($articles->isNotEmpty())
                        <table class="table-auto w-full mt-4">
                            <thead>
                                <tr>
                                    <th class="border px-4 py-2">Title</th>
                                    <th class="border px-4 py-2">Published Date</th>
                                    <th class="border px-4 py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($articles as $article)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $article->title }}</td>
                                        <td class="border px-4 py-2">{{ $article->release_date }}</td>
                                        <td class="border px-4 py-2">
                                            <a href="{{ route('author.articles.edit', $article) }}" class="btn btn-warning">Edit</a>
                                            <form action="{{ route('author.articles.destroy', $article) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $articles->links() }}
                        </div>
                    @else
                        <p class="mt-4">No articles found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
