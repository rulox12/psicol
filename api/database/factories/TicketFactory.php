<?php

namespace Database\Factories;

use App\Models\Buyer;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ticket::class;

    public function definition(): array
    {
        return [
            'event' => $this->faker->name,
            'event_date' => $this->faker->dateTimeBetween('now', '+2 years')->format('Y-m-d H:i:s'),
            'charge' => $this->faker->randomNumber(5),
            'available' => true,
            'buyer_id' => Buyer::factory()->create(),
            'created_by' => User::factory()->create()
        ];
    }
}
