<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Subscription Summary') }}
        </h2>
    </x-slot>
  
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 space-y-6">
                    <h3 class="text-lg font-bold">Subscription Summary</h3>
  
                    <!-- Subscription Details -->
                    <div class="space-y-2">
                        <p><strong>Start Date:</strong> {{ $start_date->toFormattedDateString() }}</p>
                        <p><strong>End Date:</strong> {{ $end_date->toFormattedDateString() }}</p>
                        <p><strong>Price:</strong> ${{ number_format($price, 2) }}</p>
                        <p><strong>Payment Method:</strong> 
                            {{ $payment_method === 'bank_transfer' ? 'Bank Transfer' : 'Online Payment' }}
                        </p>
                    </div>
  
                    <!-- Confirmation Button -->
                    <div class="mt-6 flex justify-end">
                        <form action="{{ route('subscriptions.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="start_date" value="{{ $start_date }}">
                            <input type="hidden" name="end_date" value="{{ $end_date }}">
                            <input type="hidden" name="price" value="{{ $price }}">
                            <input type="hidden" name="payment_method" value="{{ $payment_method }}">
  
                            <button type="submit" 
                                class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400">
                                Confirm and Submit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </x-app-layout>
  