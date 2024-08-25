<?php

use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Notifications\TestResendNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use App\Models\Ticket;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::resource('tickets', TicketController::class);
});

Auth::routes();  // This includes routes for login, registration, and password resets

Route::get('/send-test-notification', function () {
    $user = User::first(); // Select a user to send the notification to
    $user->notify(new TestResendNotification());
    
    return 'Notification sent!';
});

Route::get('/send-test-email', [TicketController::class, 'sendTestEmail']);

Route::get('/send-test-email', function () {
    Mail::raw('This is a test email', function ($message) {
        $message->to('sivastarchandran@gmail.com')
                ->subject('Test Email');
    });

    return 'Test email sent!';
});


Route::get('/send-test-notification', function () {
    $user = User::first(); // Select a user to send the notification to
    $user->notify(new TestResendNotification());
    
    return 'Notification sent!';
});

// Route::get('/tickets', function () {
//     $tickets = Cache::remember('tickets', 60, function () {
//         return Ticket::all();
//     });

//     return response()->json($tickets);
// });
