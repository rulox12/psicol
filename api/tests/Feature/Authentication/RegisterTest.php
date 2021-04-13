<?php

namespace Tests\Feature\Authentication;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /** @test * */
    public function cannotRegisterAUserWithoutData()
    {
        $expectedResponse = [
            'message' => 'The given data was invalid.',
            'errors' => [
                'name' => [
                    trans('validation.required',['attribute' => 'name'])
                ],
                'email' => [
                    trans('validation.required',['attribute' => 'email'])
                ],
                'password' => [
                    trans('validation.required',['attribute' => 'password'])
                ]
            ]
        ];

        $this->postJson(route('auth.register'))
            ->assertStatus(422)
            ->assertJson($expectedResponse);
    }

    /** @test * */
    public function cannotRegisterAUserWithoutEmail()
    {
        $expectedResponse = [
            'message' => 'The given data was invalid.',
            'errors' => [
                'email' => [
                    trans('validation.required',['attribute' => 'email'])
                ],
            ]
        ];

        $data = [
            'name' => 'example',
            'password' => 'example'
        ];

        $this->postJson(route('auth.register'), $data)
            ->assertStatus(422)
            ->assertJson($expectedResponse);
    }

    /** @test * */
    public function cannotRegisterAUserWithoutPassword()
    {
        $expectedResponse = [
            'message' => 'The given data was invalid.',
            'errors' => [
                'password' => [
                    trans('validation.required',['attribute' => 'password'])
                ],
            ]
        ];

        $data = [
            'name' => 'example',
            'email' => 'email@example.com'
        ];

        $this->postJson(route('auth.register'), $data)
            ->assertStatus(422)
            ->assertJson($expectedResponse);
    }

    /** @test * */
    public function cannotRegisterAUserWithoutName()
    {
        $expectedResponse = [
            'message' => 'The given data was invalid.',
            'errors' => [
                'name' => [
                    trans('validation.required',['attribute' => 'name'])
                ],
            ]
        ];

        $data = [
            'password' => 'example',
            'email' => 'email@example.com'
        ];

        $this->postJson(route('auth.register'), $data)
            ->assertStatus(422)
            ->assertJson($expectedResponse);
    }

    /** @test * */
    public function successfulUserRegistration()
    {
        $data = [
            'name' => 'nameExample',
            'password' => 'passwordExample',
            'email' => 'email@example.com'
        ];

        Artisan::call('passport:install');

        $this->postJson(route('auth.register'), $data)
            ->assertStatus(200);
    }
}
