<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{ __('Subscription Summary') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900 dark:text-gray-100">
                  <h3 class="text-lg font-bold mb-4">Subscription Summary</h3>

                  <p><strong>Start Date:</strong> {{ $start_date->toFormattedDateString() }}</p>
                  <p><strong>End Date:</strong> {{ $end_date->toFormattedDateString() }}</p>
                  <p><strong>Price:</strong> ${{ $price }}</p>
                  <p><strong>Payment Method:</strong> 
                      {{ $payment_method === 'bank_transfer' ? 'Bank Transfer' : 'Online Payment' }}
                  </p>

                  <div class="mt-6">
                      <form action="{{ route('subscriptions.store') }}" method="POST">
                          @csrf
                          <input type="hidden" name="start_date" value="{{ $start_date }}">
                          <input type="hidden" name="end_date" value="{{ $end_date }}">
                          <input type="hidden" name="price" value="{{ $price }}">
                          <input type="hidden" name="payment_method" value="{{ $payment_method }}">

                          <button type="submit" class="btn btn-primary">Confirm and Submit</button>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
