<?php

namespace Tests\Feature\Ticket;

use App\Models\Buyer;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListTest extends TestCase
{
    use RefreshDatabase;

    /** @test * */
    public function aUserNotLoggedInCannotSeeTheTicket()
    {
        $this
            ->getJson('api/ticket')
            ->assertStatus(401)
            ->assertJson(['message' => 'Unauthenticated.']);
    }

    /** @test * */
    public function aLoggedInUserCanSeeTheTickets()
    {
        $user = User::factory()->create();
        $buyers = Ticket::factory(3)->create([
            'created_by' => $user->id
        ]);

        $buyers->makeHidden('created_by');

        $expectedResponse = [
            'success'=> true,
            'data' => $buyers->toArray(),
            'message'=> ''
        ];

        $this
            ->actingAs($user, 'api')
            ->getJson('api/ticket')
            ->assertStatus(200)
            ->assertJson($expectedResponse);
    }

    /** @test * */
    public function aLoggedInUserCannotSeeTheTicketsThatAreNotAssignedToHim()
    {
        $user = User::factory()->create();
        Ticket::factory(3)->create();

        $expectedResponse = [
            'success'=> true,
            'data' => [],
            'message'=> ''
        ];

        $this
            ->actingAs($user, 'api')
            ->getJson('api/ticket')
            ->assertStatus(200)
            ->assertJson($expectedResponse);
    }
}
