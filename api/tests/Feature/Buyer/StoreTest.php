<?php

namespace Tests\Feature\Buyer;

use App\Models\Buyer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test * */
    public function aUserNotLoggedInCannotRegisterBuyers()
    {
        $this->postJson('api/buyer')
            ->assertStatus(401)
            ->assertJson(['message' => 'Unauthenticated.']);
    }

    /** @test * */
    public function aLoggedInUserCanRegisterBuyer()
    {
        $user = User::factory()->create();
        $buyerData = Buyer::factory()->make();

        $expectedResponse = [
            'success' => true,
            'data' => $buyerData->toArray(),
            'message' => ''
        ];

        $this->actingAs($user, 'api')->postJson('api/buyer', $buyerData->toArray())
            ->assertStatus(200)
            ->assertJson($expectedResponse);
    }

    /** @test * */
    public function aLoggedInUserCannotRegisterABuyerWithoutASurnameAndMobile()
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
