<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_form()
    {
        $response = $this->get('/register');

        $response->assertOk();
        $response->assertJson([
            '_token' => csrf_token(),
            'name' => 'name',
            'email' => 'email',
            'password' => 'password',
            'password_confirmation' => 'password_confirmation'
        ]);
    }

    public function test_successful_registration()
    {
        $user = User::factory()->makeOne();

        $password = fake()->password();
        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $password,
            'password_confirmation' => $password
        ];

        $response = $this->post('/register', $data);

        $response->assertRedirectToRoute('home');
        $this->assertTrue(Auth::check());
        $this->assertDatabaseHas('users', [
            'name' => $user->name,
            'email' => $user->email
        ]);
    }
}
