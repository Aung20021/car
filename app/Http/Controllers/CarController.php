<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Car;
use App\Models\CarReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $query = Car::where('status', 'approved')
        ->where('is_sold', false);

          // Apply filters if values are provided
    if ($request->filled('make')) {
        $query->where('make', 'like', '%' . $request->make . '%');
    }

    if ($request->filled('model')) {
        $query->where('model', 'like', '%' . $request->model . '%');
    }

    if ($request->filled('year')) {
        $query->where('year', $request->year);
    }

    if ($request->filled('min_price')) {
        $query->where('price', '>=', $request->min_price);
    }

    if ($request->filled('max_price')) {
        $query->where('price', '<=', $request->max_price);
    }


        // Get the filtered cars
        $cars = $query->get();

        return view('cars.index', compact('cars'));
    }

    public function create()
    {
        return view('admin.dashboard');
    }

    public function store(Request $request)
    {
        $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:2025',
            'mileage' => 'required|numeric',
            'fuel_type' => 'required|string|max:255',
            'transmission' => 'required|string|max:255',
            'engine_size' => 'required|string|max:255',
            'engine_power' => 'required|string|max:255',
            'body_type' => 'required|string|max:255',
            'vin' => 'required|string|max:255',
            'insurance_status' => 'required|string|max:255',
            'warranty_status' => 'required|string|max:255',
            'tire_condition' => 'required|string|max:255',
            'mechanical_health' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'seller_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'contact_information' => 'required|string|max:255',
            'photos' => 'required|array|min:1|max:10',
            'photos.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'video_walkaround' => 'nullable|file|mimes:mp4,mov,avi|max:20480',
            'test_drive_availability' => 'nullable|string|in:Yes,No',
            'test_drive_start' => 'nullable|date|required_if:test_drive_availability,Yes',
            'test_drive_end' => 'nullable|date|after_or_equal:test_drive_start|required_if:test_drive_availability,Yes',
            'registration_details' => 'nullable|string|max:255',
        ]);

        $photoPaths = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $filename = uniqid() . '-' . $photo->getClientOriginalName();
                $photoPaths[] = $photo->storeAs('car_photos', $filename, 'public');
            }
        }

        $videoPath = null;
        if ($request->hasFile('video_walkaround')) {
            $videoPath = $request->file('video_walkaround')->store('car_videos', 'public');
        }

        Car::create([
            'make' => $request->make,
            'model' => $request->model,
            'year' => $request->year,
            'mileage' => $request->mileage,
            'fuel_type' => $request->fuel_type,
            'transmission' => $request->transmission,
            'engine_size' => $request->engine_size,
            'engine_power' => $request->engine_power,
            'body_type' => $request->body_type,
            'vin' => $request->vin,
            'insurance_status' => $request->insurance_status,
            'warranty_status' => $request->warranty_status,
            'tire_condition' => $request->tire_condition,
            'mechanical_health' => $request->mechanical_health,
            'price' => $request->price,
            'seller_name' => $request->seller_name,
            'location' => $request->location,
            'contact_information' => $request->contact_information,
            'photos' => $photoPaths,
            'video_walkaround' => $videoPath,
            'test_drive_availability' => $request->test_drive_availability,
            'test_drive_start' => $request->test_drive_start,
            'test_drive_end' => $request->test_drive_end,
            'registration_details' => $request->registration_details,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Car post created successfully!');
    }

    public function edit(Car $car)
    {
        if (auth()->id() !== $car->user_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        // Authorization check
        if (auth()->id() !== $car->user_id) {
            abort(403, 'Unauthorized action.');
        }

        // Validate the input
        $request->validate([
            'make' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'year' => 'nullable|integer|min:1900|max:2025',
            'mileage' => 'nullable|integer',
            'fuel_type' => 'nullable|string|max:255',
            'transmission' => 'nullable|string|max:255',
            'engine_size' => 'nullable|string|max:255',
            'engine_power' => 'nullable|string|max:255',
            'body_type' => 'nullable|string|max:255',
            'vin' => 'nullable|string|max:255',
            'insurance_status' => 'nullable|string|max:255',
            'warranty_status' => 'nullable|string|max:255',
            'tire_condition' => 'nullable|string|max:255',
            'mechanical_health' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'seller_name' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'contact_information' => 'nullable|string|max:255',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // Validate each photo
            'video_walkaround' => 'nullable|file|mimes:mp4,mov,avi|max:20480', // Validate video (max 10MB)
            'test_drive_availability' => 'nullable|string|in:Yes,No',
            'test_drive_start' => 'nullable|date|required_if:test_drive_availability,Yes',
            'test_drive_end' => 'nullable|date|after_or_equal:test_drive_start|required_if:test_drive_availability,Yes',
            'registration_details' => 'nullable|string|max:255',
        ]);

        // Handle new photo uploads
        $updatedPhotos = $car->photos ?? [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $index => $photo) {
                if (isset($updatedPhotos[$index])) {
                    Storage::disk('public')->delete($updatedPhotos[$index]);
                }
                $updatedPhotos[$index] = $photo->store('car_photos', 'public');
            }
        }
 // Fallback if no photos exist after the update
 if (empty($updatedPhotos)) {
    // Provide a default photo or an empty array
    $updatedPhotos = ['default_photo.jpg']; // Replace 'default_photo.jpg' with your default image path
}


        if ($request->hasFile('video_walkaround')) {
            if ($car->video_walkaround) {
                Storage::disk('public')->delete($car->video_walkaround);
            }
            $car->video_walkaround = $request->file('video_walkaround')->store('car_videos', 'public');
        }

         // Update car status to "pending" before saving
    $car->status = 'pending';  // Setting the status to "pending"

        $car->update($request->except(['photos', 'video_walkaround']) + [
            'photos' => $updatedPhotos,
            'video_walkaround' => $car->video_walkaround,
        ]);

        return redirect()->route('cars.edit', $car)->with('success', 'Car post updated successfully.');
    }

    public function destroy($id)
    {
        $car = Car::findOrFail($id);

        if ($car->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            return redirect()->route('user.dashboard')->with('error', 'Unauthorized to delete this car post.');
        }

        if ($car->photos) {
            foreach ($car->photos as $photoPath) {
                $path = 'public/' . $photoPath;
                if (Storage::exists($path)) {
                    Storage::delete($path);
                }
            }
        }

        if ($car->video_walkaround) {
            $path = 'public/' . $car->video_walkaround;
            if (Storage::exists($path)) {
                Storage::delete($path);
            }
        }

        $car->delete();

        return redirect()->route('user.dashboard')->with('success', 'Car post deleted successfully!');
    }

    public function updateStatus(Request $request, $id, $status)
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('user.dashboard')->with('error', 'Unauthorized action.');
        }

        if (!in_array($status, ['approved', 'rejected'])) {
            return redirect()->route('cars.index')->with('error', 'Invalid status.');
        }

        $car = Car::findOrFail($id);

        if ($status === 'rejected') {
            $request->validate([
                'rejection_reason' => 'required|string|max:255',
            ]);

            $car->rejection_reason = $request->input('rejection_reason');
        }

        $car->status = $status;
        $car->save();

        if ($status === 'approved') {
            return redirect()->route('admin.dashboard')->with('success', 'Car post approved successfully!');
        } else {
            return redirect()->route('admin.dashboard')->with('success', 'Car post rejected with reason.');
        }
    }

    public function show($id)
    {
        // Retrieve the car by its ID
    $car = Car::findOrFail($id);

    // Load all the test drive appointments related to the car
    $appointments = $car->testDrives()->orderBy('appointment_date')->orderBy('appointment_time')->get();

    // Pass the car and its appointments to the view
    return view('cars.show', compact('car', 'appointments'));
    }


    public function placeBid(Request $request, Car $car)
{
    // Ensure the user is logged in
    if (!auth()->check()) {
        return back()->withErrors('You need to be logged in to place a bid.');
    }

    // Ensure the user has the 'user' role
    if (auth()->user()->role !== 'user') {
        return back()->withErrors('You do not have permission to place a bid.');
    }

    // Check if the car belongs to the user (prevent bidding on their own car)
    if ($car->user_id === auth()->id()) {
        return back()->withErrors("You cannot place a bid on your own car.");
    }

    // Validate the bid amount
    $request->validate([
        'bid_amount' => [
            'required',
            'numeric',
            'min:1',
            function ($attribute, $value, $fail) use ($car) {
                if ($value < $car->price) {
                    $fail("The bid amount must be at least equal to the car's starting price of USD" . number_format($car->price, 2));
                }
            },
        ],
    ]);

    // Check if the bid is higher than the current highest bid
    $highestBid = $car->bids()->max('bid_amount');
    if ($highestBid && $request->bid_amount <= $highestBid) {
        return back()->withErrors('Your bid must be higher than the current highest bid.');
    }

    // Create a new bid
    $bid = $car->bids()->create([
        'user_id' => auth()->id(),
        'bid_amount' => $request->bid_amount,

    ]);

    // Redirect to the transaction store method after placing a bid
    return back()->with('success', 'Bid placed successfully.')->withInput(['bid' => $bid->id]);

}



public function sell(Request $request, Car $car)
{
    // Ensure the logged-in user owns the car
    if ($car->user_id !== auth()->id()) {
        return back()->withErrors('You are not authorized to sell this car.');
    }

    // Prevent selling the car to the user themselves
    if ($car->user_id === $request->buyer_id) {
        return back()->withErrors("You cannot sell the car to yourself.");
    }

    // Validate the request
    $request->validate([
        'buyer_id' => 'required|exists:users,id',
    ]);

    // Update the car's status
    $car->update([
        'is_sold' => true,
        'buyer_id' => $request->buyer_id,
    ]);

    // Fetch the buyer
    $buyer = \App\Models\User::find($request->buyer_id);

    if (!$buyer) {
        return back()->with('error', 'The specified buyer does not exist.');
    }

    // Fetch the highest bid from the buyer for this car
    $highestBid = $car->bids()
        ->where('user_id', $request->buyer_id)
        ->orderByDesc('bid_amount')
        ->first();

    if (!$highestBid) {
        return back()->with('error', 'The selected buyer has not placed any bids.');
    }

    // Create the transaction with the highest bid amount
    \App\Models\Transaction::create([
        'car_id' => $car->id,
        'buyer_id' => $buyer->id,
        'owner_id' => $car->user_id,
        'amount' => $highestBid->bid_amount, // Use the highest bid amount
        'status' => 'in_process',
    ]);

    return back()->with('success', 'The car has been sold successfully.');
}



public function payTransaction(Request $request, $transactionId)
{
    $transaction = \App\Models\Transaction::findOrFail($transactionId);

    // Check if the user is the buyer
    if ($transaction->buyer_id !== auth()->id()) {
        return back()->withErrors('You are not authorized to pay for this transaction.');
    }

    try {
        // Simulate a payment process (Replace with actual payment gateway integration)
        $paymentSucceeded = true; // Example: Replace with actual success condition from payment gateway response

        if ($paymentSucceeded) {
            $transaction->status = 'succeeded';
            $transaction->save();

            return redirect()->route('bids.index')->with('success', 'Payment was successful, transaction completed.');
        } else {
            $transaction->status = 'failed';
            $transaction->save();

            return redirect()->route('bids.index')->with('error', 'Payment failed, please try again.');
        }
    } catch (\Exception $e) {
        $transaction->status = 'failed';
        $transaction->save();

        return redirect()->route('bids.index')->with('error', 'An error occurred during the payment process.');
    }
}
public function report($carId, Request $request)
{
    // Check if the user is authenticated and is not an admin
    if (!auth()->check() || auth()->user()->role === 'admin') {
        // Redirect to login page if not logged in, or show a message if an admin
        return redirect()->route('login')->with('error', 'You must be logged in to report a car, and admins cannot report cars.');
    }
    // Validate the input data
    $request->validate([
        'reason' => 'required|string|max:255',
    ]);

    // Check if the car exists
    $car = Car::findOrFail($carId);

    // Create a new report
    CarReport::create([
        'car_id' => $car->id,
        'user_id' => auth()->id(),
        'reason' => $request->reason,
    ]);

    // Optionally, you can add a success message
 // Redirect the user back to the previous page with a success message
 return back()->with('success', 'Your report has been submitted.');
}

}
