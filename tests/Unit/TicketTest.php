<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Ticket;

class TicketTest extends TestCase
{
    public function test_ticket_creation()
    {
        $ticket = Ticket::create([
            'title' => 'Test Ticket',
            'description' => 'This is a test description.',
            'status' => 'open'
        ]);

        $this->assertDatabaseHas('tickets', [
            'title' => 'Test Ticket'
        ]);
    }
}

