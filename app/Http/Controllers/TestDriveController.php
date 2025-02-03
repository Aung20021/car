<?php

namespace App\Http\Controllers;

use App\Models\TestDrive;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestDriveController extends Controller
{
    public function book(Request $request, Car $car)
    {
        // Ensure the user has the "user" role
        if (Auth::user()->role !== 'user') {
            return back()->withErrors('You are not authorized to book a test drive.');
        }

        $request->validate([
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required|date_format:H:i',
        ]);

         // Ensure the appointment date is within the test drive availability
    if ($car->test_drive_availability === 'Yes') {
        $testDriveStart = $car->test_drive_start;
        $testDriveEnd = $car->test_drive_end;

        // Check if the appointment date is within the test drive range
        if ($request->appointment_date < $testDriveStart || $request->appointment_date > $testDriveEnd) {
            return back()->withErrors('The appointment date is outside the available test drive range.');
        }
    }

    // Prevent booking if the appointment date has already passed
    $appointmentDateTime = $request->appointment_date . ' ' . $request->appointment_time;
    if (strtotime($appointmentDateTime) < now()->timestamp) {
        return back()->withErrors('You cannot book an appointment for a past date and time.');
    }

        $appointmentStart = $request->appointment_time;
        $appointmentEnd = date('H:i', strtotime('+1 hour', strtotime($appointmentStart)));

        // Check if the selected time overlaps with existing bookings
        $overlap = TestDrive::where('car_id', $car->id)
            ->where('appointment_date', $request->appointment_date)
            ->where(function ($query) use ($appointmentStart, $appointmentEnd) {
                $query->whereBetween('appointment_time', [$appointmentStart, $appointmentEnd])
                      ->orWhereRaw('? BETWEEN appointment_time AND DATE_ADD(appointment_time, INTERVAL 1 HOUR)', [$appointmentStart]);
            })->exists();

        if ($overlap) {
            return back()->withErrors('This time slot is already booked.');
        }

         // Ensure the user does not book more than 7 appointments for the same car in a month
    $bookedAppointmentsInMonth = TestDrive::where('user_id', Auth::id())
    ->where('car_id', $car->id)
    ->whereMonth('appointment_date', '=', now()->month)
    ->count();

if ($bookedAppointmentsInMonth >= 7) {
    return back()->withErrors('You cannot book more than 7 test drives for the same car in a month.');
}

        // Ensure the user does not book multiple appointments for the same car on the same day
        $existingBooking = TestDrive::where('user_id', Auth::id())
            ->where('car_id', $car->id)
            ->where('appointment_date', $request->appointment_date)
            ->exists();

        if ($existingBooking) {
            return back()->withErrors('You have already booked an appointment for this car on this date.');
        }

        // Get the car's owner (user_id from cars table)
        $ownerId = $car->user_id; // This retrieves the user_id of the car's owner

        // Check that the user is not booking an appointment for their own car
        if ($ownerId == Auth::id()) {
            return back()->withErrors('You cannot book a test drive for your own car.');
        }

        // Create the test drive appointment, setting the owner_id from the car's user_id
        TestDrive::create([
            'user_id' => Auth::id(),
            'car_id' => $car->id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $appointmentStart,
            'owner_id' => $ownerId, // Set the owner_id from the car's user_id
        ]);

        return back()->with('success', 'Test drive appointment booked successfully!');
    }

    public function update(Request $request, TestDrive $testDrive)
    {
        $request->validate([
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required|date_format:H:i',
        ]);

        // Ensure the authenticated user is the owner of the appointment
        if ($testDrive->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        // Check if the status is 'approved'
    if ($testDrive->status === 'approved') {
        // If status is 'approved', return an error or redirect back with a message
        return redirect()->back()->with('error', 'You cannot update this appointment as it is already approved.');
    }

        $appointmentStart = $request->appointment_time;
        $appointmentEnd = date('H:i', strtotime('+1 hour', strtotime($appointmentStart)));

        // Check for overlapping bookings
        $overlap = TestDrive::where('car_id', $testDrive->car_id)
            ->where('appointment_date', $request->appointment_date)
            ->where('id', '!=', $testDrive->id)
            ->where(function ($query) use ($appointmentStart, $appointmentEnd) {
                $query->whereBetween('appointment_time', [$appointmentStart, $appointmentEnd])
                      ->orWhereRaw('? BETWEEN appointment_time AND DATE_ADD(appointment_time, INTERVAL 1 HOUR)', [$appointmentStart]);
            })->exists();

        if ($overlap) {
            return back()->withErrors('This time slot is already booked.');
        }

        $testDrive->update([
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $appointmentStart,
            'status' => 'pending', // Set the status to "pending"
        ]);

        return redirect()->route('cars.appointments')->with('success', 'Appointment updated successfully!');
    }

    public function manageAppointments(Car $car)
    {
        $user = Auth::user();

        // Ensure the authenticated user is the owner of the car
        if ($car->user_id !== $user->id) {  // This ensures only the car owner can manage appointments
            abort(403, 'Unauthorized action.');
        }

        // Get all appointments for this car
        $appointments = $car->testDrives()->orderBy('appointment_date')->orderBy('appointment_time')->get();

        return view('test_drives.manage', compact('appointments', 'car'));
    }

    public function updateStatus(Request $request, TestDrive $testDrive)
    {
        // Validate the status input
        $request->validate([
            'status' => 'required|in:approved,declined',
        ]);

        // Ensure the authenticated user is the owner of the car
        if ($testDrive->car->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Update the status of the appointment
        $testDrive->update(['status' => $request->status]);

        // Log the status update
        \Log::info('Updated status for test drive: ' . $testDrive->id . ' to ' . $request->status);

        // Return success message
        return back()->with('success', 'Appointment status updated successfully!');
    }


    public function ownerDashboard()
    {
        $user = Auth::user();

        // Fetch all appointments for the cars owned by the authenticated user
        $ownedCarAppointments = TestDrive::whereHas('car', function ($query) use ($user) {
            $query->where('user_id', $user->id); // Fetch appointments for cars owned by the user
        })
        ->with(['user', 'car'])
        ->orderBy('appointment_date')
        ->orderBy('appointment_time')
        ->get();

        // Fetch all appointments made by the authenticated user
        $userAppointments = TestDrive::where('user_id', $user->id)
            ->with(['car'])
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->get();

        // Pass both variables to the view
        return view('dashboard.user', compact('ownedCarAppointments', 'userAppointments'));
    }

    public function edit(TestDrive $testDrive)
    {
        // Ensure the authenticated user is the owner of the appointment
        if ($testDrive->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('test_drives.edit', compact('testDrive'));
    }
    public function cancel(TestDrive $testDrive)
    {
        // Ensure the authenticated user is the owner of the appointment
        if ($testDrive->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
 // Check if the status is 'approved'
 if ($testDrive->status === 'approved') {
    // If status is 'approved', return an error or redirect back with a message
    return redirect()->back()->with('error', 'You cannot cancel this appointment as it is already approved.');
}
        $testDrive->delete();

        return back()->with('success', 'Appointment canceled successfully!');
    }

    public function appointmentsPage()
    {
        $user = Auth::user();

        $cars = $user->cars; // Ensure the 'cars' relationship is defined in the User model

        // Fetch appointments made by the user
        $userAppointments = TestDrive::where('user_id', $user->id)
            ->with(['car'])
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->get();

        // Fetch appointments for cars owned by the user
        $ownedCarAppointments = TestDrive::whereHas('car', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->with(['user', 'car'])
        ->orderBy('appointment_date')
        ->orderBy('appointment_time')
        ->get();

        return view('cars.appointments', compact('cars', 'ownedCarAppointments', 'userAppointments'));
    }

}
