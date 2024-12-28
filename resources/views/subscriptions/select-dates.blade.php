<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{ __('Select Subscription Period') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900 dark:text-gray-100">
                  <form action="{{ route('subscriptions.create') }}" method="POST">
                      @csrf
                      <div>
                          <label for="start_date">Start Date</label>
                          <input type="date" name="start_date" id="start_date" required>
                      </div>
                      <div class="mt-4">
                          <label for="end_date">End Date</label>
                          <input type="date" name="end_date" id="end_date" required>
                      </div>
                      <button type="submit" class="btn btn-primary mt-4">Next</button>
                  </form>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
