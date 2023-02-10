<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_form()
    {
        $response = $this->get('/login');

        $response->assertOk();
        $response->assertJson([
            '_token' => csrf_token(),
            'email' => 'email',
            'password' => 'password'
        ]);
    }

    public function test_successful_login()
    {
        $user = User::factory()->create();

        $data = [
            'email' => $user->email,
            'password' => 'password'
        ];

        $response = $this->post('/login', $data);

        $response->assertRedirectToRoute('home');
        $this->assertTrue(Auth::check());
    }
}
