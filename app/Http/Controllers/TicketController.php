<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Events\TicketCreated;
use App\Events\MessageSent;
use App\Notifications\ResendEmailNotification;
use Illuminate\Support\Facades\Notification;
use App\Services\ExpensiveDataService;
use Illuminate\Support\Facades\Cache;

class TicketController extends Controller
{
    protected $expensiveDataService;

    // Inject the ExpensiveDataService into the controller
    public function __construct(ExpensiveDataService $expensiveDataService)
    {
        $this->expensiveDataService = $expensiveDataService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Cache the results of the query for 60 minutes
        $tickets = Cache::remember('tickets', 60, function () {
            return Ticket::all();
        });
        $expensiveData = $this->expensiveDataService->getExpensiveData();
        return view('tickets.index', compact('tickets', 'expensiveData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:open,closed,in_progress',
        ]);

        // Create the ticket
        $ticket = Ticket::create($request->all());

        // Broadcast the event
        broadcast(new TicketCreated($ticket))->toOthers();

        return redirect()->route('tickets.index')
                         ->with('success', 'Ticket created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        return view('tickets.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:open,closed,in_progress',
        ]);

        $ticket->update($request->all());

        return redirect()->route('tickets.index')
                         ->with('success', 'Ticket updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect()->route('tickets.index')
                         ->with('success', 'Ticket deleted successfully.');
    }

    public function sendMessage(Request $request)
    {
        $message = $request->input('message');
        broadcast(new MessageSent($message));

        return response()->json(['status' => 'Message sent!']);
    }

    public function sendNotification()
    {
        $user = Auth::user(); // or any other user instance

        $subject = 'Welcome to Our Service';
        $message = '<h1>Thank you for joining us!</h1>';

        Notification::send($user, new ResendEmailNotification($user->email, $subject, $message));
    }

    public function sendTestEmail()
    {
        Mail::raw('This is a test email', function ($message) {
            $message->to('sivastarchandran@gmail.com')
                    ->subject('Test Email');
        });

        return 'Test email sent!';
    }

    
}
