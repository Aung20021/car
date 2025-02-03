<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TestDriveController;

use App\Http\Controllers\BidController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PayPalController;

use Illuminate\Support\Facades\Log;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

use App\Http\Controllers\ContactController;
// routes/web.php
use App\Http\Controllers\AboutController;

Route::delete('/dashboard/cars/{carId}', [DashboardController::class, 'destroy'])->name('dashboard.cars.destroy')->middleware('auth');

Route::delete('/cars/{id}', [CarController::class, 'destroy'])
    ->name('cars.destroy')
    ->middleware('auth'); // Ensure only logged-in users can delete

Route::post('/cars/{car}/report', [CarController::class, 'report'])->name('cars.report');

Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/contact', [ContactController::class, 'showForm'])->name('contact');
Route::post('/contact', [ContactController::class, 'submitForm']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/user', [DashboardController::class, 'userDashboard'])->name('dashboard.user');
    Route::get('/dashboard/admin', [DashboardController::class, 'adminDashboard'])->name('dashboard.admin');
    Route::post('/dashboard/admin/delete-user/{id}', [DashboardController::class, 'deleteUser'])->name('admin.deleteUser');
    Route::post('/dashboard/admin/promote-user/{id}', [DashboardController::class, 'promoteToAdmin'])->name('admin.promoteToAdmin');
});
Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])
    ->name('dashboard.admin')
    ->middleware('auth');
// Route to delete a user
Route::delete('/admin/users/{id}', [DashboardController::class, 'deleteUser'])
    ->name('admin.deleteUser')
    ->middleware('auth');

// Route to promote a user to admin
Route::put('/admin/users/{id}/promote', [DashboardController::class, 'promoteToAdmin'])
    ->name('admin.promoteToAdmin')
    ->middleware('auth');
Route::get('/test-paypal-sdk', function () {
    $paypal = new PayPalClient();
    $paypal->setApiCredentials([
        'client_id' => env('PAYPAL_CLIENT_ID'),
        'client_secret' => env('PAYPAL_CLIENT_SECRET'),
        'settings' => [
            'mode' => env('PAYPAL_MODE', 'sandbox'),
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path() . '/logs/paypal.log',
            'log.LogLevel' => 'DEBUG',
        ],
    ]);

    try {
        $response = $paypal->getAccessToken();
        return 'Access Token: ' . $response['access_token'];
    } catch (\Exception $e) {
        return 'PayPal Error: ' . $e->getMessage();
    }
});

Route::get('/test-paypal-config', function () {
    $paypal = new PayPalClient();
    $paypal->setApiCredentials(config('paypal'));
    Log::info('PayPal Config:', config('paypal'));

    try {
        $response = $paypal->getAccessToken();
        Log::info('Access Token Response:', $response);
    } catch (\Exception $e) {
        Log::error('PayPal Error: ' . $e->getMessage());
        return 'Error: ' . $e->getMessage();
    }

    return 'PayPal configuration and access token validated successfully.';
});

Route::get('/create-payment', [PayPalController::class, 'createPayment'])->name('paypal.createPayment');
Route::get('/capture-payment/{orderId}', [PayPalController::class, 'capturePayment'])->name('paypal.capturePayment');
Route::get('/test-paypal', [PayPalController::class, 'testPayPalConnection']);

Route::get('/test-paypal', [PayPalController::class, 'testPayPalConnection']);


Route::post('/transactions/{transactionId}/pay', [TransactionController::class, 'payTransaction'])->name('transactions.pay');
Route::get('/transactions/{transactionId}/success', [TransactionController::class, 'paymentSuccess'])->name('transactions.success');
Route::get('/transactions/{transactionId}/cancel', [TransactionController::class, 'paymentCancel'])->name('transactions.cancel');

// Route to create a payment
Route::get('/paypal/create-payment', [PayPalController::class, 'createPayment'])->name('paypal.create');

// Route to capture the payment (PayPal redirects here after payment)
Route::get('/paypal/capture-payment/{orderId}', [PayPalController::class, 'capturePayment'])->name('paypal.capture');


Route::post('/transactions/{transaction}/pay', [TransactionController::class, 'payTransaction'])->name('transactions.pay');




Route::middleware('auth')->group(function () {
    // Store a transaction after bidding
    Route::post('/transactions/{car}', [TransactionController::class, 'store'])->name('transactions.store');

    // View all transactions for the logged-in user
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');

    // View a single transaction
    Route::get('/transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');

    // Route to the bids page (optional, based on your current structure)
    Route::get('/bids', function () {
        return view('bids.index'); // Make sure this points to the correct view for your bids
    })->name('bids.index');
});
Route::post('transactions/{bid}', [TransactionController::class, 'store'])->name('transactions.store');

Route::put('/cars/{car}/sell', [CarController::class, 'sell'])->name('cars.sell');

Route::get('/bids', [BidController::class, 'index'])->name('bids.index');
Route::post('/cars/{car}/bid', [CarController::class, 'placeBid'])->name('cars.placeBid');


Route::get('/appointments', [TestDriveController::class, 'appointmentsPage'])->name('appointments.page');
Route::get('/appointments-page', [TestDriveController::class, 'appointmentsPage'])->name('appointments.page');


Route::get('/appointments', [TestDriveController::class, 'appointmentsPage'])->name('cars.appointments');


// Route to update the status of an appointment
Route::put('/appointments/{testDrive}/status', [TestDriveController::class, 'updateStatus'])->name('appointments.updateStatus');

// Route to edit an appointment
Route::get('/appointments/{testDrive}/edit', [TestDriveController::class, 'editAppointment'])->name('appointments.edit');

// Route to cancel an appointment
Route::delete('/appointments/{testDrive}', [TestDriveController::class, 'cancelAppointment'])->name('appointments.cancel');

Route::get('/user-dashboard', [DashboardController::class, 'userDashboard'])->name('dashboard.user');

Route::get('/test-drives/{testDrive}/edit', [TestDriveController::class, 'edit'])->name('test-drives.edit');
Route::put('/test-drives/{testDrive}', [TestDriveController::class, 'update'])->name('test-drives.update');
Route::delete('/test-drives/{testDrive}', [TestDriveController::class, 'cancel'])->name('test-drives.cancel');

Route::put('/test-drives/{testDrive}/update-status', [TestDriveController::class, 'updateStatus'])->name('test-drives.update-status');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [TestDriveController::class, 'ownerDashboard'])->name('dashboard.user');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [TestDriveController::class, 'ownerDashboard'])->name('dashboard.user');
    Route::put('/appointments/{testDrive}/status', [TestDriveController::class, 'updateStatus'])->name('test-drives.update-status');
});

Route::middleware('auth')->group(function () {
    Route::get('/cars/{car}/appointments', [TestDriveController::class, 'manageAppointments'])->name('test-drives.manage');
    Route::put('/test-drives/{testDrive}/status', [TestDriveController::class, 'updateStatus'])->name('test-drives.update-status');
});


Route::post('/cars/{car}/test-drive', [TestDriveController::class, 'book'])->name('test-drives.book');
Route::put('/test-drives/{testDrive}', [TestDriveController::class, 'update'])->name('test-drives.update');

Route::put('/cars/{car}/photos/{index}', [CarController::class, 'updatePhoto'])->name('cars.update.photo');
Route::delete('/cars/{car}/photos/{index}', [CarController::class, 'deletePhoto'])->name('cars.delete.photo');


Route::get('/cars/{car}/edit', [CarController::class, 'edit'])->name('cars.edit');
Route::put('/cars/{car}', [CarController::class, 'update'])->name('cars.update');
Route::get('/car/{id}', [CarController::class, 'show'])->name('car.show');

Route::post('/user/dashboard', [CarController::class, 'store'])->name('cars.store');



Route::put('/cars/{id}/updateStatus/{status}', [CarController::class, 'updateStatus'])->name('cars.updateStatus');



Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Default route for the authenticated dashboard
Route::get('/dashboard', function () {
    return redirect()->route(Auth::user()->role === 'admin' ? 'admin.dashboard' : 'user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Group for routes requiring authentication
Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User and Admin dashboard routes
    Route::get('/user/dashboard', [DashboardController::class, 'userDashboard'])->name('user.dashboard');
    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
});
Route::get('/cars', [CarController::class, 'index'])->name('cars.index');


require __DIR__.'/auth.php';
