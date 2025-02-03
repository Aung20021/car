<?php

namespace App\Http\Controllers;

use App\Models\Bid; // Assuming you have a Bid model
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;

class BidController extends Controller
{
    public function index()
    {
        // Get the logged-in user
        $user = auth()->user();


        $transactions = Transaction::where('buyer_id', Auth::id())->paginate(10); // Use pagination
        // Fetch the highest bids for cars owned by the user
        $ownedCarBids = Bid::select('car_id', 'user_id', \DB::raw('MAX(bid_amount) as highest_bid'))
            ->whereHas('car', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->groupBy('car_id', 'user_id')
            ->with(['car', 'user'])
            ->get();

        // Fetch the highest bids placed by the logged-in user, excluding the user's own cars
        $userBids = Bid::select('car_id', \DB::raw('MAX(bid_amount) as highest_bid'))
            ->where('user_id', $user->id)
            ->whereHas('car', function ($query) use ($user) {
                $query->where('user_id', '!=', $user->id); // Exclude cars owned by the user
            })
            ->groupBy('car_id')
            ->with('car')
            ->get();
            $bids = Bid::with(['car.transaction'])->get(); // Eager load the transaction

        return view('bids.index', compact('ownedCarBids', 'userBids', 'user','transactions','bids'));
    }





}
