<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TicketApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_ticket_list_api()
    {
        Ticket::factory()->count(3)->create();

        $response = $this->getJson('/api/tickets');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function test_ticket_creation_api()
    {
        $data = [
            'title' => 'New API Ticket',
            'description' => 'API Ticket description',
            'status' => 'open'
        ];

        $response = $this->postJson('/api/tickets', $data);

        $response->assertStatus(201)
                 ->assertJson(['title' => 'New API Ticket']);
    }
}

