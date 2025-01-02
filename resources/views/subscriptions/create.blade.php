<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Confirm Subscription') }}
        </h2>
    </x-slot>
  
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 space-y-6">
                    <div class="text-lg">
                        <p><strong>Start Date:</strong> {{ $start_date->toFormattedDateString() }}</p>
                        <p><strong>End Date:</strong> {{ $end_date->toFormattedDateString() }}</p>
                        <p><strong>Price:</strong> ${{ number_format($price, 2) }}</p>
                    </div>
  
                    <form action="{{ route('subscriptions.summary') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="start_date" value="{{ $start_date }}">
                        <input type="hidden" name="end_date" value="{{ $end_date }}">
                        <input type="hidden" name="price" value="{{ $price }}">
  
                        <h3 class="text-lg font-semibold">Select Payment Method</h3>
  
                        <div class="flex items-center">
                            <input type="radio" name="payment_method" value="bank_transfer" id="bank_transfer" required
                                class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-400 dark:bg-gray-700 dark:border-gray-600">
                            <label for="bank_transfer" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                Bank Transfer
                            </label>
                        </div>
  
                        <div class="flex items-center">
                            <input type="radio" name="payment_method" value="online_payment" id="online_payment" required
                                class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-400 dark:bg-gray-700 dark:border-gray-600">
                            <label for="online_payment" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                Online Payment
                            </label>
                        </div>
  
                        <button type="submit"
                            class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400">
                            Confirm and Pay
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </x-app-layout>
  