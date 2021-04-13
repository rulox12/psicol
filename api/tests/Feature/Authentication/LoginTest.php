<?php

namespace Tests\Feature\Authentication;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test * */
    public function aUserCannotLoginWithoutData()
    {
        $expectedResponse = [
            'message' => 'The given data was invalid.',
            'errors' => [
                'email' => [
                    trans('validation.required',['attribute' => 'email'])
                ],
                'password' => [
                    trans('validation.required',['attribute' => 'password'])
                ]
            ]
        ];

        $this->postJson(route('auth.login'))
            ->assertStatus(422)
            ->assertJson($expectedResponse);
    }

    /** @test * */
    public function aUserCannotLoginWithoutEmail()
    {
        $expectedResponse = [
            'message' => 'The given data was invalid.',
            'errors' => [
                'email' => [
                    trans('validation.required',['attribute' => 'email'])
                ]
            ]
        ];

        $this->postJson(route('auth.login'), ['password' => 'example'])
            ->assertStatus(422)
            ->assertJson($expectedResponse);
    }

    /** @test * */
    public function aUserCannotLoginWithoutPassword()
    {
        $expectedResponse = [
            'message' => 'The given data was invalid.',
            'errors' => [
                'password' => [
                    trans('validation.required',['attribute' => 'password'])
                ]
            ]
        ];

        $this->postJson(route('auth.login'), ['email' => 'email@example.com'])
            ->assertStatus(422)
            ->assertJson($expectedResponse);
    }

    /** @test * */
    public function aUserLogsInWithAWrongPassword()
    {
        $data = [
            'email' => 'email@example.com',
            'password' => 'passwordExample'
        ];

        User::factory()->create($data);

        $this->postJson(route('auth.login'), $data)
            ->assertStatus(401)
            ->assertJson(['error' => 'Unauthorised']);
    }

    /** @test * */
    public function aUserLogsInSuccessfully()
    {
        $email = 'email@example.com';
        $password = 'passwordExample';

        User::factory()->create([
            'email' => 'email@example.com',
            'password' => bcrypt($password),
        ]);

        $data = [
            'email' => $email,
            'password' => $password,
        ];

        Artisan::call('passport:install');

        $this->postJson(route('auth.login'), $data)
            ->assertStatus(200);
    }
}
