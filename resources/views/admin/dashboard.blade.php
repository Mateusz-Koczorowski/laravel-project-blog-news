<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <!-- Welcome Section -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="font-semibold text-2xl mb-4">Welcome to Admin Panel, {{ Auth::user()->name }}</h2>
                    <p class="text-gray-700 dark:text-gray-300">
                        This is the Admin Panel where you can manage users, articles, and subscriptions. Use the sections below to perform various administrative tasks.
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
                        <a href="{{ route('admin.create') }}" class="px-4 py-2 bg-gray-900 text-white border border-white rounded-lg shadow-md hover:bg-gray-700 transition">
                            Create User
                        </a>
                    </div>

                    @if($users->isNotEmpty())
                        <table class="table-auto w-full bg-gray-50 dark:bg-gray-700 shadow-md rounded-lg">
                            <thead>
                                <tr class="bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-300 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left border border-gray-300 dark:border-gray-600">ID</th>
                                    <th class="py-3 px-6 text-left border border-gray-300 dark:border-gray-600">Name</th>
                                    <th class="py-3 px-6 text-left border border-gray-300 dark:border-gray-600">Email</th>
                                    <th class="py-3 px-6 text-left border border-gray-300 dark:border-gray-600">Role</th>
                                    <th class="py-3 px-6 text-center border border-gray-300 dark:border-gray-600">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 dark:text-gray-300 text-sm">
                                @foreach($users as $user)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-600 hover:text-gray-900 transition-all duration-150">
                                        <td class="py-4 px-6 border border-gray-300 dark:border-gray-600">{{ $user->id }}</td>
                                        <td class="py-4 px-6 border border-gray-300 dark:border-gray-600">{{ $user->name }}</td>
                                        <td class="py-4 px-6 border border-gray-300 dark:border-gray-600">{{ $user->email }}</td>
                                        <td class="py-4 px-6 border border-gray-300 dark:border-gray-600">{{ $user->role }}</td>
                                        <td class="py-4 px-6 border border-gray-300 dark:border-gray-600 text-center flex gap-2 justify-center">
                                            <a href="{{ route('admin.edit', $user->id) }}" class="px-3 py-2 text-yellow-500 bg-yellow-500 rounded hover:bg-yellow-600 transition hover:text-gray-900">
                                                Show data/Edit
                                            </a>
                                            <form action="{{ route('admin.destroy', $user->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-3 py-2 text-white bg-red-500 rounded hover:bg-red-600 transition">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $users->withQueryString()->links() }}
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
                        <a href="{{ route('articles.create') }}" class="px-4 py-2 bg-gray-900 text-white border border-white rounded-lg shadow-md hover:bg-gray-700 transition">
                            Create Article
                        </a>
                    </div>

                    @if($articles->isNotEmpty())
                        <table class="table-auto w-full bg-gray-50 dark:bg-gray-700 shadow-md rounded-lg">
                            <thead>
                                <tr class="bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-300 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left border border-gray-300 dark:border-gray-600">Title</th>
                                    <th class="py-3 px-6 text-left border border-gray-300 dark:border-gray-600">Author</th>
                                    <th class="py-3 px-6 text-center border border-gray-300 dark:border-gray-600">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 dark:text-gray-300 text-sm">
                                @foreach ($articles as $article)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-600 hover:text-gray-900 transition-all duration-150">
                                    <td class="py-4 px-6 border border-gray-300 dark:border-gray-600">{{ $article->title }}</td>
                                    <td class="py-4 px-6 border border-gray-300 dark:border-gray-600">{{ optional($article->author)->name }}</td>
                                    <td class="py-4 px-6 border border-gray-300 dark:border-gray-600 text-center flex gap-2 justify-center">
                                        <a href="{{ route('articles.edit', $article) }}"class="px-3 py-2 text-yellow-500 bg-yellow-500 rounded hover:bg-yellow-600 transition hover:text-gray-900">
                                            Show data/Edit
                                        </a>
                            
                                        <!-- Correct Delete Button -->
                                        <form action="{{ route('articles.destroy', $article) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-2 text-white bg-red-500 rounded hover:bg-red-600 transition" sty>
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $articles->withQueryString()->links() }}
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
                    <h3 class="text-lg font-bold mb-4">Subscriptions</h3>

                    @if($subscriptions->isNotEmpty())
                        <table class="table-auto w-full bg-gray-50 dark:bg-gray-700 shadow-md rounded-lg">
                            <thead>
                                <tr class="bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-300 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left border border-gray-300 dark:border-gray-600">User</th>
                                    <th class="py-3 px-6 text-left border border-gray-300 dark:border-gray-600">Start Date</th>
                                    <th class="py-3 px-6 text-left border border-gray-300 dark:border-gray-600">End Date</th>
                                    <th class="py-3 px-6 text-left border border-gray-300 dark:border-gray-600">Status</th>
                                    <th class="py-3 px-6 text-center border border-gray-300 dark:border-gray-600">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 dark:text-gray-300 text-sm">
                                @foreach ($subscriptions as $subscription)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-600 hover:text-gray-900 transition-all duration-150">
                                        <td class="py-4 px-6 border border-gray-300 dark:border-gray-600">{{ $subscription->user->name }}</td>
                                        <td class="py-4 px-6 border border-gray-300 dark:border-gray-600">{{ $subscription->start_date->format('Y-m-d') }}</td>
                                        <td class="py-4 px-6 border border-gray-300 dark:border-gray-600">{{ $subscription->end_date->format('Y-m-d') }}</td>
                                        <td class="py-4 px-6 border border-gray-300 dark:border-gray-600">{{ ucfirst($subscription->status) }}</td>
                                        <td class="py-4 px-6 border border-gray-300 dark:border-gray-600 text-center">
                                            @if ($subscription->status === 'pending')
                                                <form action="{{ route('admin.subscriptions.approve', $subscription->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="px-3 py-2 text-yellow-500 bg-yellow-500 rounded hover:bg-yellow-600 transition hover:text-gray-900">
                                                        Approve
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.subscriptions.reject', $subscription->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="px-3 py-2 text-white bg-red-500 rounded hover:bg-red-600 transition">
                                                        Reject
                                                    </button>
                                                </form>
                                            @elseif ($subscription->status === 'approved')
                                                <span class="text-green-500">Approved</span>
                                            @elseif ($subscription->status === 'rejected')
                                                <span class="text-red-500">Rejected</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $subscriptions->withQueryString()->links() }}
                        </div>
                    @else
                        <p class="mt-4">No subscriptions found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
