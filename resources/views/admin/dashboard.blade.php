<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{ __('Admin Dashboard') }}
      </h2>
  </x-slot>

  <!-- Users Section -->
  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900 dark:text-gray-100">
                  <h2 class="font-semibold text-lg">Manage Users</h2>
                  <a href="{{ route('admin.create') }}" class="btn btn-primary mt-4">Create User</a>

                  @if($users->isNotEmpty())
                      <table class="table-auto w-full mt-4">
                          <thead>
                              <tr>
                                  <th class="border px-4 py-2">ID</th>
                                  <th class="border px-4 py-2">Name</th>
                                  <th class="border px-4 py-2">Email</th>
                                  <th class="border px-4 py-2">Role</th>
                                  <th class="border px-4 py-2">Actions</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach($users as $user)
                                  <tr>
                                      <td class="border px-4 py-2">{{ $user->id }}</td>
                                      <td class="border px-4 py-2">{{ $user->name }}</td>
                                      <td class="border px-4 py-2">{{ $user->email }}</td>
                                      <td class="border px-4 py-2">{{ $user->role }}</td>
                                      <td class="border px-4 py-2">
                                          <a href="{{ route('admin.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                                          <form action="{{ route('admin.destroy', $user->id) }}" method="POST" style="display:inline;">
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
                  <h2 class="font-semibold text-lg">Manage Articles</h2>
                  <a href="{{ route('articles.create') }}" class="btn btn-primary mt-4">Create New Article</a>

                  @if($articles->isNotEmpty())
                      <table class="table-auto w-full mt-4">
                          <thead>
                              <tr>
                                  <th class="border px-4 py-2">Title</th>
                                  <th class="border px-4 py-2">Author</th>
                                  <th class="border px-4 py-2">Actions</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach ($articles as $article)
                                  <tr>
                                      <td class="border px-4 py-2">{{ $article->title }}</td>
                                      <td class="border px-4 py-2">{{ optional($article->author)->name }}</td>
                                      <td class="border px-4 py-2">
                                          <a href="{{ route('articles.edit', $article) }}" class="text-blue-500">Edit</a>
                                          <form action="{{ route('articles.destroy', $article) }}" method="POST" class="inline">
                                              @csrf
                                              @method('DELETE')
                                              <button type="submit" class="text-red-500" onclick="return confirm('Are you sure?')">Delete</button>
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

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h3 class="text-lg font-bold mb-4">Subscriptions</h3>

                @if($subscriptions->isNotEmpty())
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">User</th>
                                <th class="border px-4 py-2">Start Date</th>
                                <th class="border px-4 py-2">End Date</th>
                                <th class="border px-4 py-2">Status</th>
                                <th class="border px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subscriptions as $subscription)
                                <tr>
                                    <td class="border px-4 py-2">{{ $subscription->user->name }}</td>
                                    <td class="border px-4 py-2">{{ $subscription->start_date->format('Y-m-d') }}</td>
                                    <td class="border px-4 py-2">{{ $subscription->end_date->format('Y-m-d') }}</td>
                                    <td class="border px-4 py-2">{{ ucfirst($subscription->status) }}</td>
                                    <td class="border px-4 py-2">
                                        @if ($subscription->status === 'pending')
                                            <form action="{{ route('admin.subscriptions.approve', $subscription->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="btn btn-primary">Approve</button>
                                            </form>
                                            <form action="{{ route('admin.subscriptions.reject', $subscription->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Reject</button>
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
