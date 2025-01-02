<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Subscriptions') }}
        </h2>
    </x-slot>
  
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 space-y-6">
                    @auth
                        <!-- Buy Subscription Button -->
                        <a href="{{ route('subscriptions.select-dates') }}"
                           class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400">
                            Buy Subscription
                        </a>
  
                        <!-- Subscriptions Table -->
                        @if(isset($subscriptions) && $subscriptions->isNotEmpty())
                            <div class="overflow-x-auto">
                                <table class="table-auto w-full mt-4 bg-gray-50 dark:bg-gray-700 shadow-md rounded-lg">
                                    <thead class="bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-300 uppercase text-sm">
                                        <tr>
                                            <th class="px-4 py-2 text-left">Start Date</th>
                                            <th class="px-4 py-2 text-left">End Date</th>
                                            <th class="px-4 py-2 text-left">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-gray-600 dark:text-gray-300">
                                        @foreach($subscriptions as $subscription)
                                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-600 transition-all">
                                                <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">{{ $subscription->start_date->format('Y-m-d') }}</td>
                                                <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">{{ $subscription->end_date->format('Y-m-d') }}</td>
                                                <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">
                                                    <span class="font-medium">
                                                        @if ($subscription->status === 'approved')
                                                            <span class="text-green-500">Approved</span>
                                                        @elseif ($subscription->status === 'pending')
                                                            <span class="text-yellow-500">Pending Approval</span>
                                                        @elseif ($subscription->status === 'rejected')
                                                            <span class="text-red-500">Rejected</span>
                                                        @endif
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4">
                                {{ $subscriptions->links() }}
                            </div>
                        @else
                            <p class="mt-4 text-gray-700 dark:text-gray-300">No subscriptions found.</p>
                        @endif
                    @else
                        <p class="mt-4">
                            Please <a href="{{ route('login') }}" class="text-blue-500 hover:underline">log in</a>
                            to view and manage your subscriptions.
                        </p>
                    @endauth
                </div>
            </div>
        </div>
    </div>
  </x-app-layout>
  