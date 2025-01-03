<x-app-layout>
    <!-- Welcome Section -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="font-semibold text-2xl mb-4">Welcome to Admin Panel, {{ Auth::user()->name }}</h2>
                    <p class="text-gray-700 dark:text-gray-300">
                        This is the Admin Panel where you can manage users, articles, and subscriptions.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Section -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="font-semibold text-lg">Manage Users</h2>
                        <a href="{{ route('admin.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 transition">
                            Create User
                        </a>
                    </div>

                    @if($users->isNotEmpty())
                        <table class="table-auto w-full bg-gray-50 dark:bg-gray-700 shadow-md rounded-lg">
                            <thead>
                                <tr class="bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-300 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6">ID</th>
                                    <th class="py-3 px-6">Name</th>
                                    <th class="py-3 px-6">Email</th>
                                    <th class="py-3 px-6">Role</th>
                                    <th class="py-3 px-6 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-600 transition-all">
                                        <td class="py-4 px-6">{{ $user->id }}</td>
                                        <td class="py-4 px-6">{{ $user->name }}</td>
                                        <td class="py-4 px-6">{{ $user->email }}</td>
                                        <td class="py-4 px-6">{{ $user->role }}</td>
                                        <td class="py-4 px-6 flex justify-center space-x-4">
                                            <a href="{{ route('admin.edit', $user->id) }}" class="px-3 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.destroy', $user->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-3 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $users->links() }}
                        </div>
                    @else
                        <p class="mt-4">No users found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Articles Section -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="font-semibold text-lg">Manage Articles</h2>
                        <a href="{{ route('articles.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 transition">
                            Create Article
                        </a>
                    </div>

                    @if($articles->isNotEmpty())
                        <table class="table-auto w-full bg-gray-50 dark:bg-gray-700 shadow-md rounded-lg">
                            <thead>
                                <tr class="bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-300 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6">Title</th>
                                    <th class="py-3 px-6">Author</th>
                                    <th class="py-3 px-6 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($articles as $article)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-600 transition-all">
                                        <td class="py-4 px-6">{{ $article->title }}</td>
                                        <td class="py-4 px-6">{{ optional($article->author)->name }}</td>
                                        <td class="py-4 px-6 flex justify-center space-x-4">
                                            <a href="{{ route('articles.edit', $article) }}" class="px-3 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                                Edit
                                            </a>
                                            <form action="{{ route('articles.destroy', $article) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-3 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                                    Delete
                                                </button>
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

    <!-- Subscriptions Section -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="font-semibold text-lg mb-4">Manage Subscriptions</h2>

                    @if($subscriptions->isNotEmpty())
                        <table class="table-auto w-full bg-gray-50 dark:bg-gray-700 shadow-md rounded-lg">
                            <thead>
                                <tr class="bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-300 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6">User</th>
                                    <th class="py-3 px-6">Start Date</th>
                                    <th class="py-3 px-6">End Date</th>
                                    <th class="py-3 px-6">Status</th>
                                    <th class="py-3 px-6 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subscriptions as $subscription)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-600 transition-all">
                                        <td class="py-4 px-6">{{ $subscription->user->name }}</td>
                                        <td class="py-4 px-6">{{ $subscription->start_date->format('Y-m-d') }}</td>
                                        <td class="py-4 px-6">{{ $subscription->end_date->format('Y-m-d') }}</td>
                                        <td class="py-4 px-6">{{ ucfirst($subscription->status) }}</td>
                                        <td class="py-4 px-6 flex justify-center space-x-4">
                                            @if ($subscription->status === 'pending')
                                                <form action="{{ route('admin.subscriptions.approve', $subscription->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="px-3 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                                                        Approve
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.subscriptions.reject', $subscription->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="px-3 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                                        Reject
                                                    </button>
                                                </form>
                                            @else
                                                <span class="{{ $subscription->status === 'approved' ? 'text-green-500' : 'text-red-500' }}">
                                                    {{ ucfirst($subscription->status) }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $subscriptions->links() }}
                        </div>
                    @else
                        <p class="mt-4">No subscriptions found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
