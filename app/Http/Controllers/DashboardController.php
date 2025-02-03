<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarReport;
use App\Models\TestDrive;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function userDashboard()
    {
        $user = Auth::user();
        $cars = $user->cars; // Ensure the 'cars' relationship is defined in the User model

        $ownedCarAppointments = TestDrive::whereIn('car_id', $cars->pluck('id'))
            ->with(['user', 'car'])
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->get();

        $userAppointments = TestDrive::where('user_id', $user->id)
            ->with(['car'])
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->get();

        return view('dashboard.user', compact('cars', 'ownedCarAppointments', 'userAppointments'));
    }

    public function adminDashboard(Request $request)
    {
        $cars = Car::where('status', 'pending')->get();
 // Get the reported cars
 $reportedCars = CarReport::with('car') // Eager load related cars
 ->join('cars', 'car_reports.car_id', '=', 'cars.id')
 ->where('cars.is_sold', false) // Only show unsold cars
 ->orderBy('car_reports.created_at', 'desc') // Specify which created_at column to use
 ->get();

        // Search functionality
        $searchQuery = $request->query('search');
        $activeTab = $request->query('activeTab', 'nav-profile'); // Default tab is 'nav-profile'
        $users = User::query()
            ->when($searchQuery, function ($query, $searchQuery) {
                $query->where('name', 'like', "%{$searchQuery}%")
                      ->orWhere('email', 'like', "%{$searchQuery}%");
            })
            ->get();

        return view('dashboard.admin', compact('cars', 'users', 'searchQuery','reportedCars'));
    }

    public function updateCarStatus($id, $status)
    {
        if (Auth::user() && Auth::user()->role !== 'admin') {
            return redirect()->route('user.dashboard')->with('error', 'Unauthorized to update car status.');
        }

        $car = Car::findOrFail($id);
        $car->status = $status;
        $car->save();

        $message = $status === 'approved' ? 'Your car post has been approved!' : 'Sorry, this post does not meet the requirements.';
        session()->flash($status === 'approved' ? 'success' : 'error', $message);

        return redirect()->route('user.dashboard');
    }

    public function deleteUser($id)
    {
        if (Auth::user() && Auth::user()->role !== 'admin') {
            return back()->with('error', 'Unauthorized action.');
        }

        $user = User::findOrFail($id);

        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot delete yourself.');
        }

        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }

    public function promoteToAdmin($id)
    {
        if (Auth::user() && Auth::user()->role !== 'admin') {
            return back()->with('error', 'Unauthorized action.');
        }

        $user = User::findOrFail($id);

        if ($user->id === Auth::id()) {
            return back()->with('error', 'You are already an admin.');
        }

        $user->role = 'admin';
        $user->save();

        return back()->with('success', 'User promoted to admin successfully.');
    }

    public function destroy($carId)
{
    // Find the car by its ID
    $car = Car::findOrFail($carId);

    // Check if the user is an admin
    if (auth()->user()->role !== 'admin') {
        return redirect()->route('dashboard')->with('error', 'Unauthorized action.');
    }

    // Delete the car
    $car->delete();

    // Optionally, delete associated reports (if needed)
    // CarReport::where('car_id', $carId)->delete(); // Uncomment if you want to delete related reports

    // Redirect back with success message
    return redirect()->route('dashboard')->with('success', 'Car post has been deleted.');
}

}
