<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{ __('My Subscriptions') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900 dark:text-gray-100">
                  @auth
                      <a href="{{ route('subscriptions.select-dates') }}" class="btn btn-primary">Buy Subscription</a>

                      @if(isset($subscriptions) && $subscriptions->isNotEmpty())
                          <table class="table-auto w-full mt-4">
                              <thead>
                                  <tr>
                                      <th>Start Date</th>
                                      <th>End Date</th>
                                      <th>Status</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach($subscriptions as $subscription)
                                      <tr>
                                          <td>{{ $subscription->start_date->format('Y-m-d') }}</td>
                                          <td>{{ $subscription->end_date->format('Y-m-d') }}</td>
                                          <td>
                                            @if ($subscription->status === 'approved')
                                                Approved
                                            @elseif ($subscription->status === 'pending')
                                                Pending Approval
                                            @elseif ($subscription->status === 'rejected')
                                                Rejected
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
                  @else
                      <p class="mt-4">Please <a href="{{ route('login') }}" class="text-blue-500">log in</a> to view and manage your subscriptions.</p>
                  @endauth
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
