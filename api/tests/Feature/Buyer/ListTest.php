<?php

namespace Tests\Feature\Buyer;

use App\Models\Buyer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListTest extends TestCase
{
    use RefreshDatabase;

    /** @test * */
    public function aUserNotLoggedInCannotSeeTheBuyers()
    {
        $this
            ->getJson('api/buyer')
            ->assertStatus(401)
            ->assertJson(['message' => 'Unauthenticated.']);
    }

    /** @test * */
    public function aLoggedInUserCanSeeTheBuyers()
    {
        $user = User::factory()->create();
        $buyers = Buyer::factory(3)->create([
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
            ->getJson('api/buyer')
            ->assertStatus(200)
            ->assertJson($expectedResponse);
    }

    /** @test * */
    public function aLoggedInUserCannotSeeTheBuyersThatAreNotAssignedToHim()
    {
        $user = User::factory()->create();
        Buyer::factory(3)->create();

        $expectedResponse = [
            'success'=> true,
            'data' => [],
            'message'=> ''
        ];

        $this
            ->actingAs($user, 'api')
            ->getJson('api/buyer')
            ->assertStatus(200)
            ->assertJson($expectedResponse);
    }
}
