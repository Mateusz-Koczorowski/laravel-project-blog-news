<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::where('user_id', auth()->id())->latest()->paginate(10);
        return view('subscriptions.index', compact('subscriptions'));
    }

    public function selectDates()
    {
        return view('subscriptions.select-dates');
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        $start_date = Carbon::parse($validated['start_date']);
        $end_date = Carbon::parse($validated['end_date']);

        // Check for overlapping subscriptions
        $overlappingSubscription = Subscription::where('user_id', auth()->id())
            ->where(function ($query) use ($start_date, $end_date) {
                $query->whereBetween('start_date', [$start_date, $end_date])
                      ->orWhereBetween('end_date', [$start_date, $end_date])
                      ->orWhere(function ($query) use ($start_date, $end_date) {
                          $query->where('start_date', '<=', $start_date)
                                ->where('end_date', '>=', $end_date);
                      });
            })->first();

        if ($overlappingSubscription) {
            return redirect()->back()->withErrors(['dates' => 'The selected dates overlap with an existing subscription.']);
        }

        $days = $start_date->diffInDays($end_date);
        $price = $days * 0.50; // $0.50 per day

        return view('subscriptions.create', compact('start_date', 'end_date', 'price'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'price' => 'required|numeric|min:0',
        ]);

        $start_date = Carbon::parse($validated['start_date']);
        $end_date = Carbon::parse($validated['end_date']);

        // Check for overlapping subscriptions
        $overlappingSubscription = Subscription::where('user_id', auth()->id())
            ->where(function ($query) use ($start_date, $end_date) {
                $query->whereBetween('start_date', [$start_date, $end_date])
                      ->orWhereBetween('end_date', [$start_date, $end_date])
                      ->orWhere(function ($query) use ($start_date, $end_date) {
                          $query->where('start_date', '<=', $start_date)
                                ->where('end_date', '>=', $end_date);
                      });
            })->first();

        if ($overlappingSubscription) {
            return redirect()->back()->withErrors(['dates' => 'The selected dates overlap with an existing subscription.']);
        }

        Subscription::create([
            'user_id' => auth()->id(),
            'start_date' => $start_date,
            'end_date' => $end_date,
            'price' => $validated['price'],
            'status' => 'pending', // Initial status is pending
        ]);

        return redirect()->route('subscriptions.thank-you')->with('success', 'Subscription request submitted. Awaiting admin approval.');
    }

    public function summary(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'price' => 'required|numeric|min:0',
            'payment_method' => 'required|string|in:bank_transfer,online_payment',
        ]);

        return view('subscriptions.summary', [
            'start_date' => Carbon::parse($validated['start_date']),
            'end_date' => Carbon::parse($validated['end_date']),
            'price' => $validated['price'],
            'payment_method' => $validated['payment_method'],
        ]);
    }

    public function thankYou()
    {
        return view('subscriptions.thank-you');
    }
}
