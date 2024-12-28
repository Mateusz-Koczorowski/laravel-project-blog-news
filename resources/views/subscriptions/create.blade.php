<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{ __('Confirm Subscription') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900 dark:text-gray-100">
                  <p>Start Date: {{ $start_date->toFormattedDateString() }}</p>
                  <p>End Date: {{ $end_date->toFormattedDateString() }}</p>
                  <p>Price: ${{ number_format($price, 2) }}</p>
                  <form action="{{ route('subscriptions.summary') }}" method="POST">
                      @csrf
                      <input type="hidden" name="start_date" value="{{ $start_date }}">
                      <input type="hidden" name="end_date" value="{{ $end_date }}">
                      <input type="hidden" name="price" value="{{ $price }}">
                      <h3>Select Payment Method</h3>
                      <div>
                          <input type="radio" name="payment_method" value="bank_transfer" id="bank_transfer" required>
                          <label for="bank_transfer">Bank Transfer</label>
                      </div>
                      <div>
                          <input type="radio" name="payment_method" value="online_payment" id="online_payment" required>
                          <label for="online_payment">Online Payment</label>
                      </div>
                      <button type="submit" class="btn btn-primary mt-4">Confirm and Pay</button>
                  </form>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
