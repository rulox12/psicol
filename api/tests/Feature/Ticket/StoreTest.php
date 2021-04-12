<?php

namespace Tests\Feature\Ticket;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test * */
    public function aUserNotLoggedInCannotRegisterTickets()
    {
        $this->postJson('api/ticket')
            ->assertStatus(401)
            ->assertJson(['message' => 'Unauthenticated.']);
    }

    /** @test * */
    public function aLoggedInUserCanRegisterTicket()
    {
        $user = User::factory()->create();
        $ticketData = Ticket::factory()->make();

        $ticketData->makeHidden('created_by');

        $expectedResponse = [
            'success' => true,
            'data' => $ticketData->toArray(),
            'message' => ''
        ];

        $this->actingAs($user, 'api')->postJson('api/ticket', $ticketData->toArray())
            ->assertStatus(200)
            ->assertJson($expectedResponse);
    }

    /** @test * */
    public function aLoggedInUserCannotRegisterATicketWithoutEvent()
    {
        $user = User::factory()->create();
        $expectedResponse = [
            'message' => 'The given data was invalid.',
            'errors' => [
                'surname' => [
                    'The surname field is required.'
                ],
                'mobile' => [
                    'The mobile field is required.'
                ],
            ]
        ];

        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail
        ];

        $this->actingAs($user, 'api')->postJson('api/buyer', $data)
            ->assertStatus(422)
            ->assertJson($expectedResponse);
    }
}
