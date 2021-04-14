<?php

namespace App\Console\Commands;

use App\Models\Buyer;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class Configuration extends Command
{
    protected $signature = 'command:configuration';

    protected $description = 'This command is used to carry out the initial configuration of the project';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): int
    {
        Artisan::call('migrate:fresh');
        Artisan::call('passport:install');
        $user = User::factory()->create([
            'email' => env('EMAIL'),
            'password' => bcrypt(env('PASSWORD')),
        ]);

        Buyer::factory(3)->create([
            'created_by' => $user->id
        ]);

        Ticket::factory(5)->create([
            'created_by' => $user->id,
            'available' => true,
            'buyer_id' => null
        ]);

        return true;
    }
}
